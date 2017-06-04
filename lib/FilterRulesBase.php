<?php

namespace Ubivar;

class FilterRulesBase extends ApiResource
{
    /**
     * @return string path 
     */
    public static function path()
    {
        return "filter_rules_base";
    }

    /**
     * @param integer $id
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Event The created login.
     */
    public static function update($id, $params = null, $opts = null)
    {
        return self::_update($id, $params, $opts);
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
