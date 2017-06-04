<?php

namespace Ubivar;

class EventLastId extends ApiResource
{
    /**
     * @return string path 
     */
    public static function path()
    {
        return "event_last_id";
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return array An array of Events.
     */
    public static function all($params = null, $opts = null)
    {
        return self::_all($params, $opts);
    }
}
