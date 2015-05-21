<?php

namespace Ubivar;

class ApiRequestor
{
    private $_apiKey;

    private $_apiBase;

    public function __construct($apiKey = null, $apiBase = null)
    {
        $this->_apiKey = $apiKey;
        if (!$apiBase) {
            $apiBase = Ubivar::$apiBase;
        }
        $this->_apiBase = $apiBase;
    }

    /**
     * @param string|mixed $value A string to UTF8-encode.
     *
     * @return string|mixed The UTF8-encoded string, or the object passed in if
     *    it wasn't a string.
     */
    public static function utf8($value)
    {
        if (is_string($value) && mb_detect_encoding($value, "UTF-8", true) != "UTF-8") {
            return utf8_encode($value);
        } else {
            return $value;
        }
    }

    private static function _encodeObjects($d)
    {
        if ($d instanceof ApiResource) {
            return self::utf8($d->id);
        } elseif ($d === true) {
            return 'true';
        } elseif ($d === false) {
            return 'false';
        } elseif (is_array($d)) {
            $res = array();
            foreach ($d as $k => $v) {
                $res[$k] = self::_encodeObjects($v);
            }
            return $res;
        } else {
            return self::utf8($d);
        }
    }

    /**
     * @param array $arr An map of param keys to values.
     * @param string|null $prefix (It doesn't look like we ever use $prefix...)
     *
     * @return string A querystring, essentially.
     */
    public static function encode($arr, $prefix = null)
    {
        if (!is_array($arr)) {
            return $arr;
        }

        $r = array();
        foreach ($arr as $k => $v) {
            if (is_null($v)) {
                continue;
            }

            if ($prefix && $k && !is_int($k)) {
                $k = $prefix."[".$k."]";
            } elseif ($prefix) {
                $k = $prefix."[]";
            }

            if (is_array($v)) {
                $r[] = self::encode($v, $k, true);
            } else {
                $r[] = urlencode($k)."=".urlencode($v);
            }
        }

        return implode("&", $r);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array|null $params
     * @param array|null $headers
     *
     * @return array An array whose first element is the response and second
     *    element is the API key used to make the request.
     */
    public function request($method, $url, $params = null, $headers = null)
    {

        if (!$params) {
            $params = array();
        }
        if (!$headers) {
            $headers = array();
        }

        list($rbody, $rcode, $myApiKey) = $this->_requestRaw($method, $url, $params, $headers);
        $resp = $this->_interpretResponse($rbody, $rcode);
        return array($resp, $myApiKey);
    }

    /**
     * @param string $rbody A JSON string.
     * @param int $rcode
     * @param array $resp
     *
     * @throws Error\InvalidRequest if the error is caused by the user.
     * @throws Error\Authentication if the error is caused by a lack of
     *    permissions.
     * @throws Error\Api otherwise.
     */
    public function handleApiError($rbody, $rcode, $resp)
    {
        if (!is_array($resp) || !isset($resp['error'])) {
            $msg = "Invalid response object from API: $rbody "
              . "(HTTP response code was $rcode)";
            throw new Error\Api($msg, $rcode, $rbody, $resp);
        }

        $error = $resp['error'];
        $msg = isset($error['message']) ? $error['message'] : null;
        $param = isset($error['param']) ? $error['param'] : null;
        $code = isset($error['code']) ? $error['code'] : null;

        switch ($rcode) {
            case 400:
                if ($code == 'rate_limit') {
                    throw new Error\RateLimit($msg, $param, $rcode, $rbody, $resp);
                }

                // intentional fall-through
            case 404:
                throw new Error\InvalidRequest($msg, $param, $rcode, $rbody, $resp);
            case 401:
                throw new Error\Authentication($msg, $rcode, $rbody, $resp);
            default:
                throw new Error\Api($msg, $rcode, $rbody, $resp);
        }
    }

    private function _requestRaw($method, $url, $params, $headers)
    {

        $myApiKey = $this->_apiKey;
        if (!$myApiKey) {
            $myApiKey = Ubivar::$apiKey;
        }

        if (!$myApiKey) {
            $msg = 'No API key provided.  (HINT: set your API key using '
              . '"Ubivar::setApiKey(<API-KEY>)".  You can generate API keys from '
              . 'the Ubivar web interface.  See https://my.ubivar.com for '
              . 'details, or email support@ubivar.com if you have any questions.';
            throw new Error\Authentication($msg);
        }

        $absUrl       = $this->_apiBase.$url;
        $params       = json_encode($params);
        // $params       = self::_encodeObjects($params);
        $langVersion  = phpversion();
        $uname        = php_uname();
        $ua           = array(
            'bindings_version'  => Ubivar::VERSION,
            'lang'              => 'php',
            'lang_version'      => $langVersion,
            'publisher'         => 'ubivar',
            'uname'             => $uname,
        );
        $defaultHeaders = array(
            'X-Ubivar-Client-User-Agent' => json_encode($ua),
            'User-Agent'        => 'Ubivar/v1 PhpBindings/' . Ubivar::VERSION,
            'Authorization'     => 'Bearer ' . $myApiKey,
        );
        if (Ubivar::$apiVersion) {
            $defaultHeaders['Ubivar-Version'] = Ubivar::$apiVersion;
        }
        $hasFile      = false;
        $defaultHeaders['Content-Type'] = 'application/json';

        $combinedHeaders = array_merge($defaultHeaders, $headers);
        $rawHeaders = array();

        foreach ($combinedHeaders as $header => $value) {
            $rawHeaders[] = $header . ': ' . $value;
        }

        list($rbody, $rcode) = $this->_curlRequest(
            $method
          , $absUrl
          , $rawHeaders
          , $params
          , $hasFile
        );

        return array($rbody, $rcode, $myApiKey);
    }

    private function _processResourceParam($resource, $hasCurlFile)
    {
        if (get_resource_type($resource) !== 'stream') {
            throw new Error\Api(
                'Attempted to upload a resource that is not a stream'
            );
        }

        $metaData = stream_get_meta_data($resource);
        if ($metaData['wrapper_type'] !== 'plainfile') {
            throw new Error\Api(
                'Only plainfile resource streams are supported'
            );
        }

        if ($hasCurlFile) {
            // We don't have the filename or mimetype, but the API doesn't care
            return new \CURLFile($metaData['uri']);
        } else {
            return '@'.$metaData['uri'];
        }
    }

    private function _interpretResponse($rbody, $rcode)
    {
        try {
            $resp = json_decode($rbody, true);
        } catch (Exception $e) {
            $msg = "Invalid response body from API: $rbody "
              . "(HTTP response code was $rcode)";
            throw new Error\Api($msg, $rcode, $rbody);
        }

        if ($rcode < 200 || $rcode >= 300) {
            $this->handleApiError($rbody, $rcode, $resp);
        }
        return $resp;
    }

    private function _curlRequest($method, $absUrl, $headers, $params, $hasFile)
    {
        $curl                         = curl_init();
        $method                       = strtolower($method);
        $opts                         = array();
        if ($method == 'get') {
            $opts[CURLOPT_HTTPGET]    = 1;
        } elseif ($method == 'post') {
            $opts[CURLOPT_POSTFIELDS] = $params; 
            $opts[CURLOPT_POST]       = 1;
        } elseif ($method == 'delete') {
            $opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        } else {
            throw new Error\Api("Unrecognized method $method");
        }

        $opts[CURLOPT_URL]            = $absUrl;
        $opts[CURLOPT_CONNECTTIMEOUT] = 30;
        $opts[CURLOPT_TIMEOUT]        = 80;
        $opts[CURLOPT_RETURNTRANSFER] = true;
        $opts[CURLOPT_HTTPHEADER]     = $headers;
        $opts[CURLOPT_VERBOSE]        = false;

        if (!Ubivar::$verifySslCerts) {
            $opts[CURLOPT_SSL_VERIFYPEER] = false;
        }

        curl_setopt_array($curl, $opts);
        $rbody      = curl_exec($curl);

        if (!defined('CURLE_SSL_CACERT_BADFILE')) {
            define('CURLE_SSL_CACERT_BADFILE', 77);  // constant not defined in PHP
        }

        $errno = curl_errno($curl);
        if ($errno == CURLE_SSL_CACERT ||
            $errno == CURLE_SSL_PEER_CERTIFICATE ||
            $errno == CURLE_SSL_CACERT_BADFILE
        ) {
            array_push(
                $headers,
                'X-Ubivar-Client-Info: {"ca":"using Ubivar-supplied CA bundle"}'
            );
            $cert = $this->caBundle();
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_CAINFO, $cert);
            $rbody = curl_exec($curl);
        }

        if ($rbody === false) {
            $errno = curl_errno($curl);
            $message = curl_error($curl);
            curl_close($curl);
            $this->handleCurlError($errno, $message);
        }

        $rcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if($rcode === 404){
            fwrite(STDOUT, "\n* ".__METHOD__);
            fwrite(STDOUT, "\n*\t".$rcode);
            fwrite(STDOUT, "\n*\t".$rbody);
        }
        //fwrite(STDOUT, "\n".__METHOD__ . " " . print_r($rbody, true));
        curl_close($curl);
        return array($rbody, $rcode);
    }

    /**
     * @param number $errno
     * @param string $message
     * @throws ApiConnectionError
     */
    public function handleCurlError($errno, $message)
    {
        $apiBase = $this->_apiBase;
        switch ($errno) {
            case CURLE_COULDNT_CONNECT:
            case CURLE_COULDNT_RESOLVE_HOST:
            case CURLE_OPERATION_TIMEOUTED:
                $msg = "Could not connect to Ubivar ($apiBase). Please check your "
                 . "internet connection and try again.  If this problem persists, "
                 . "you should check Ubivar's service status at "
                 . "https://twitter.com/ubivarstatus, or";
                break;
            case CURLE_SSL_CACERT:
            case CURLE_SSL_PEER_CERTIFICATE:
                $msg = "Could not verify Ubivar's SSL certificate.  Please make sure "
                 . "that your network is not intercepting certificates.  "
                 . "(Try going to $apiBase in your browser.)  "
                 . "If this problem persists,";
                break;
            default:
                $msg = "Unexpected error communicating with Ubivar.  "
                 . "If this problem persists,";
        }
        $msg .= " let us know at support@ubivar.com.";

        $msg .= "\n\n(Network error [errno $errno]: $message)";
        throw new Error\ApiConnection($msg);
    }

    private function caBundle()
    {
        return dirname(__FILE__) . '/../data/ca-certificates.crt';
    }
}
