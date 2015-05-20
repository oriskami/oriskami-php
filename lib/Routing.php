<?php

namespace Ubivar;

class Routing extends ApiResource
{
    /**
     * @param string $id The ID of the routing to retrieve.
     * @param array|string|null $opts
     *
     * @return Routing
     */
    public static function retrieve($id, $opts = null)
    {
        return self::_retrieve($id, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return array An array of Routings.
     */
    public static function all($params = null, $opts = null)
    {
        return self::_all($params, $opts);
    }

    /**
     * @param array|string|null $opts
     *
     * @return Routing The saved routing.
     */
    public function save($opts = null)
    {
        return $this->_save($opts);
    }
}
