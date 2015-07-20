<?php

namespace Ubivar;

class Reviewer extends ApiResource
{
    /**
     * @param string $id The ID of the account to retrieve.
     * @param array|string|null $opts
     *
     * @return Account
     */
    public static function retrieve($id, $opts = null)
    {
        return self::_retrieve($id, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return array An array of Accounts.
     */
    public static function all($params = null, $opts = null)
    {
        return self::_all($params, $opts);
    }
}
