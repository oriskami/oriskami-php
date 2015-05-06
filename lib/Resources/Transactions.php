<?php

namespace Ubivar;

class Transactions extends ApiResource
{
    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Transactions The created transaction.
     */
    public static function create($params = null, $opts = null)
    {
        return self::_create($params, $opts);
    }

    /**
     * @param string $id The ID of the transaction to retrieve.
     * @param array|string|null $opts
     *
     * @return Transactions
     */
    public static function retrieve($id, $opts = null)
    {
        return self::_retrieve($id, $opts);
    }

    /**
     * @param array|string|null $opts
     *
     * @return Transactions The saved transaction.
     */
    public function save($opts = null)
    {
        return $this->_save($opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Transactions The deleted transaction.
     */
    public function delete($params = null, $opts = null)
    {
        return $this->_delete($params, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Transactions[]
     */
    public static function all($params = null, $opts = null)
    {
        return self::_all($params, $opts);
    }
}
