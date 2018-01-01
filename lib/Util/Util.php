<?php

namespace Oriskami\Util;

use Oriskami\Object;

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

      // TODO: generally incorrect, but it's correct given Oriskami's response
        foreach (array_keys($array) as $k) {
            if (!is_numeric($k)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Recursively converts the PHP Oriskami object to an array.
     *
     * @param array $values The PHP Oriskami object to convert.
     * @return array
     */
    public static function convertOriskamiObjectToArray($values)
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
                $results[$k] = self::convertOriskamiObjectToArray($v);
            } else {
                $results[$k] = $v;
            }
        }
        return $results;
    }

    /**
     * Converts a response from the Oriskami API to the corresponding PHP object.
     *
     * @param array $resp The response from the Oriskami API.
     * @param array $opts
     * @return Object|array
     */
    public static function convertToOriskamiObject($resp, $opts)
    {
        if (isset($resp["object"])) {
            $types = array(
                'events'                     => 'Oriskami\\Event'
              , 'event_labels'               => 'Oriskami\\EventLabel'
              , 'event_notifications'        => 'Oriskami\\EventNotification'
              , 'event_queues'               => 'Oriskami\\EventQueue'
              , 'event_reviews'              => 'Oriskami\\EventReview'
              , 'event_last_id'              => 'Oriskami\\EventLastId'

              , 'filter_whitelists'          => 'Oriskami\\FilterWhitelist'
              , 'filter_blacklists'          => 'Oriskami\\FilterBlacklist'
              , 'filter_rules_custom'        => 'Oriskami\\FilterRulesCustom'
              , 'filter_rules_base'          => 'Oriskami\\FilterRulesBase'
              , 'filter_rules_ai'            => 'Oriskami\\FilterRulesAI'
              , 'filter_scorings_dedicated'  => 'Oriskami\\FilterScoringsDedicated'

              , 'notifier_emails'            => 'Oriskami\\NotifierEmail'
              , 'notifier_sms'               => 'Oriskami\\NotifierSms'
              , 'notifier_ecommerce'         => 'Oriskami\\NotifierECommerce'
              , 'notifier_slack'             => 'Oriskami\\NotifierSlack'
              , 'notifier_webhooks'          => 'Oriskami\\NotifierWebhook'
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
