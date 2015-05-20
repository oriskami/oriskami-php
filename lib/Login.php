<?php

namespace Ubivar;

class Login extends ApiResource
{
    /**
     * @param string $id The ID of the login to retrieve.
     * @param array|string|null $opts
     *
     * @return Login
     */
    public static function retrieve($id, $opts = null)
    {
        return self::_retrieve($id, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return array An array of Logins.
     */
    public static function all($params = null, $opts = null)
    {
        return self::_all($params, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Login The created login.
     */
    public static function create($params = null, $opts = null)
    {
        return self::_create($params, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Login The deleted login.
     */
    public function delete($params = null, $opts = null)
    {
        return $this->_delete($params, $opts);
    }
}
