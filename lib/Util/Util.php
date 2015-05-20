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
        $types = array(
            'me'          => 'Ubivar\\Me',
            'account'     => 'Ubivar\\Account',
            'login'       => 'Ubivar\\Login',
            'logout'      => 'Ubivar\\Logout',
            'items'       => 'Ubivar\\Item',
            'orders'      => 'Ubivar\\Order',
            'transactions'=> 'Ubivar\\Transaction',
            'routing'     => 'Ubivar\\Routing',
            'labels'      => 'Ubivar\\Label',
        );
        if($resp->status === "200" && !!$resp->data){
          return self::convertToUbivarObject($resp->data, $opts);
        } elseif (self::isList($resp)) {
            $mapped = array();
            foreach ($resp as $i) {
                array_push($mapped, self::convertToUbivarObject($i, $opts));
            }
            return $mapped;
        } elseif (is_array($resp)) {
            if (isset($resp['object']) && is_string($resp['object']) && isset($types[$resp['object']])) {
                $class = $types[$resp['object']];
            } else {
                $class = 'Ubivar\\Object';
            }
            return $class::constructFrom($resp, $opts);
        } else {
            return $resp;
        }
    }
}
