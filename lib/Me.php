<?php

namespace Ubivar;

class Me extends ApiResource
{
    /**
     * @param string $id The ID of the account to retrieve.
     * @param array|string|null $opts
     *
     * @return Me
     */
    public static function retrieve($id = null, $opts = null)
    {
        return self::_retrieve($id, $opts);
    }

    /**
     * @param array|string|null $opts
     *
     * @return Me The saved account.
     */
    public function save($opts = null)
    {
        return $this->_save($opts);
    }
}
