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
                'events'                     => 'Ubivar\\Event'
              , 'event_labels'               => 'Ubivar\\EventLabel'
              , 'event_notifications'        => 'Ubivar\\EventNotification'
              , 'event_queues'               => 'Ubivar\\EventQueue'
              , 'event_reviews'              => 'Ubivar\\EventReview'
              , 'event_last_id'              => 'Ubivar\\EventLastId'

              , 'filter_whitelists'          => 'Ubivar\\FilterWhitelist'
              , 'filter_blacklists'          => 'Ubivar\\FilterBlacklist'
              , 'filter_rules_custom'        => 'Ubivar\\FilterRulesCustom'
              , 'filter_rules_base'          => 'Ubivar\\FilterRulesBase'
              , 'filter_rules_ai'            => 'Ubivar\\FilterRulesAI'
              , 'filter_scorings_dedicated'  => 'Ubivar\\FilterScoringsDedicated'

              , 'notifier_emails'            => 'Ubivar\\NotifierEmail'
              , 'notifier_sms'               => 'Ubivar\\NotifierSms'
              , 'notifier_ecommerce'         => 'Ubivar\\NotifierECommerce'
              , 'notifier_slack'             => 'Ubivar\\NotifierSlack'
              , 'notifier_webhooks'          => 'Ubivar\\NotifierWebhook'
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
