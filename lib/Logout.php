<?php

namespace Ubivar;

class Logout extends ApiResource
{
    /**
     * @param string $id The ID of the logout to retrieve.
     * @param array|string|null $opts
     *
     * @return Logout
     */
    public static function retrieve($id, $opts = null)
    {
        return self::_retrieve($id, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return array An array of Logouts.
     */
    public static function all($params = null, $opts = null)
    {
        return self::_all($params, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Logout The created logout.
     */
    public static function create($params = null, $opts = null)
    {
        return self::_create($params, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Logout The deleted logout.
     */
    public function delete($params = null, $opts = null)
    {
        return $this->_delete($params, $opts);
    }
}
