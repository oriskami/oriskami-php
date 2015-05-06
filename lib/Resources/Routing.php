<?php

namespace Ubivar;

class Routings extends ApiResource
{
    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Routings The created routing.
     */
    public static function create($params = null, $opts = null)
    {
        return self::_create($params, $opts);
    }

    /**
     * @param string $id The ID of the routing to retrieve.
     * @param array|string|null $opts
     *
     * @return Routings
     */
    public static function retrieve($id, $opts = null)
    {
        return self::_retrieve($id, $opts);
    }

    /**
     * @param array|string|null $opts
     *
     * @return Routings The saved routing.
     */
    public function save($opts = null)
    {
        return $this->_save($opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Routings The deleted routing.
     */
    public function delete($params = null, $opts = null)
    {
        return $this->_delete($params, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Routings[]
     */
    public static function all($params = null, $opts = null)
    {
        return self::_all($params, $opts);
    }
}
