<?php

namespace Oriskami;

class EventNotification extends ApiResource
{
    /**
     * @return string path 
     */
    public static function path()
    {
        return "event_notifications";
    }

    /**
     * @param string $id The ID of the login to retrieve.
     * @param array|string|null $opts
     *
     * @return EventNotification
     */
    public static function retrieve($id, $opts = null)
    {
        return self::_retrieve($id, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return array An array of EventNotifications.
     */
    public static function all($params = null, $opts = null)
    {
        return self::_all($params, $opts);
    }
}
