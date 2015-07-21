<?php

namespace Ubivar\Util;

use Ubivar\Object;

abstract class Util
{
    /**
     * Whether the provided array (or other) is a list rather than a dictionary.
     *
     * @param array|mixed $array
     * @return boolean True if the given object is a list.
     */
    public static function isList($array)
    {
        if (!is_array($array)) {
            return false;
        }

      // TODO: generally incorrect, but it's correct given Ubivar's response
        foreach (array_keys($array) as $k) {
            if (!is_numeric($k)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Recursively converts the PHP Ubivar object to an array.
     *
     * @param array $values The PHP Ubivar object to convert.
     * @return array
     */
    public static function convertUbivarObjectToArray($values)
    {
        $results = array();
        foreach ($values as $k => $v) {
            // FIXME: this is an encapsulation violation
            if ($k[0] == '_') {
                continue;
            }
            if ($v instanceof Object) {
                $results[$k] = $v->__toArray(true);
            } elseif (is_array($v)) {
                $results[$k] = self::convertUbivarObjectToArray($v);
            } else {
                $results[$k] = $v;
            }
        }
        return $results;
    }

    /**
     * Converts a response from the Ubivar API to the corresponding PHP object.
     *
     * @param array $resp The response from the Ubivar API.
     * @param array $opts
     * @return Object|array
     */
    public static function convertToUbivarObject($resp, $opts)
    {
        if (isset($resp["object"])) {
            $types = array(
                'me'                    => 'Ubivar\\Me'
              , 'accounts'              => 'Ubivar\\Account'
              , 'addresses'             => 'Ubivar\\Address'
              , 'login'                 => 'Ubivar\\Login'
              , 'logout'                => 'Ubivar\\Logout'
              , 'items'                 => 'Ubivar\\Item'
              , 'orders'                => 'Ubivar\\Order'
              , 'transactions'          => 'Ubivar\\Transaction'
              , 'routing'               => 'Ubivar\\Routing'
              , 'reviewqueues'          => 'Ubivar\\ReviewQueue'
              , 'reviewers'             => 'Ubivar\\Reviewer'
              , 'reviewerqueuebindings' => 'Ubivar\\ReviewerQueueBinding'
              , 'labels'                => 'Ubivar\\Label'
            );

            $class            = $types[$resp["object"]];
            $data             = $resp["data"];
            $mapped           = array();

            foreach ($data as $i) {
                array_push($mapped, $class::constructFrom($i, $opts));
            }

            return $mapped;
        }
        return $resp;
    }
}
