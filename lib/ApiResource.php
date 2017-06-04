<?php

namespace Ubivar;

abstract class ApiResource extends Object
{
    private static $HEADERS_TO_PERSIST = array('Accept-Version' => true);

    public static function baseUrl()
    {
        return Ubivar::$apiBase;
    }

    /**
     * @return ApiResource The refreshed resource.
     */
    public function refresh()
    {
        $requestor    = new ApiRequestor($this->_opts->apiKey, static::baseUrl());
        $url          = $this->instanceUrl();

        list($response, $this->_opts->apiKey) = $requestor->request('get', $url, $this->_retrieveOptions, $this->_opts->headers);

        $this->refreshFrom($response, $this->_opts);
        return $this;
    }

    /**
     * @return string The name of the class, with namespacing and underscores
     *    stripped.
     */
    public static function className()
    {
        $class = get_called_class();
        // Useful for namespaces: Foo\Charge
        if ($postfixNamespaces = strrchr($class, '\\')) {
            $class = substr($postfixNamespaces, 1);
        }
        // Useful for underscored 'namespaces': Foo_Charge
        if ($postfixFakeNamespaces = strrchr($class, '')) {
            $class = $postfixFakeNamespaces;
        }
        if (substr($class, 0, strlen('Ubivar')) == 'Ubivar') {
            $class = substr($class, strlen('Ubivar'));
        }
        $class = str_replace('_', '', $class);
        $name = urlencode($class);
        $name = strtolower($name);
        return $name;
    }

    /**
     * @return string The endpoint URL for the given class.
     */
    public static function classUrl()
    {
        return "/" . static::path();
    }

    /**
     * @return string The full API URL for this API resource.
     */
    public function instanceUrl()
    {
        $id = $this['id'];
        if ($id === null) {
            $class = get_called_class();
            $message = "Could not determine which URL to request: "
               . "$class instance has invalid ID: $id";
            throw new Error\InvalidRequest($message, null);
        }
        $id = ApiRequestor::utf8($id);
        $base = static::classUrl();
        $extn = urlencode($id);
        return "$base/$extn";
    }

    private static function _validateParams($params = null)
    {
        if ($params && !is_array($params)) {
            $message = "Ubivar API method calls receive an array as first argument.";
            throw new Error\Api($message);
        }
    }

    protected function _request($method, $url, $params = array(), $options = null)
    {
        $opts = $this->_opts->merge($options);
        return static::_staticRequest($method, $url, $params, $opts);
    }

    protected static function _staticRequest($method, $url, $params, $options)
    {
        $opts = Util\RequestOptions::parse($options);
        $requestor = new ApiRequestor($opts->apiKey, static::baseUrl());
        list($response, $opts->apiKey) = $requestor->request($method, $url, $params, $opts->headers);
        foreach ($opts->headers as $k => $v) {
            if (!array_key_exists($k, self::$HEADERS_TO_PERSIST)) {
                unset($opts->headers[$k]);
            }
        }
        return array($response, $opts);
    }

    protected static function _retrieve($id, $options = null)
    {
        $url = static::classUrl()."/".$id;

        list($response, $opts) = static::_staticRequest('get', $url, null, $options);
        $result = Util\Util::convertToUbivarObject($response, $opts);
        return $result;
    }

    protected static function _all($params = null, $options = null)
    {
        self::_validateParams($params);
        $url = static::classUrl();

        list($response, $opts) = static::_staticRequest('get', $url, $params, $options);
        return Util\Util::convertToUbivarObject($response, $opts);
    }

    protected static function _update($id, $params = null, $options = null)
    {
        self::_validateParams($params);
        $url = static::classUrl() . "/" . $id ;

        list($response, $opts) = static::_staticRequest('post', $url, $params, $options);
        $result = Util\Util::convertToUbivarObject($response, $opts);
        return $result;
    }

    protected static function _create($params = null, $options = null)
    {
        self::_validateParams($params);
        $url = static::classUrl();

        list($response, $opts) = static::_staticRequest('post', $url, $params, $options);
        $result = Util\Util::convertToUbivarObject($response, $opts);
        return $result;
    }

    protected static function _delete($id, $params = null, $options = null)
    {
        self::_validateParams($params);
        $url = static::classUrl() . "/" . $id ;

        list($response, $opts) = static::_staticRequest('delete', $url, $params, $options);
        $result = Util\Util::convertToUbivarObject($response, $opts);
        return $result;
    }
}
