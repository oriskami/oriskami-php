<?php

namespace Ubivar;

class Labels extends ApiResource
{
    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Labels The created transaction.
     */
    public static function create($params = null, $opts = null)
    {
        return self::_create($params, $opts);
    }

    /**
     * @param string $id The ID of the transaction to retrieve.
     * @param array|string|null $opts
     *
     * @return Labels
     */
    public static function retrieve($id, $opts = null)
    {
        return self::_retrieve($id, $opts);
    }

    /**
     * @param array|string|null $opts
     *
     * @return Labels The saved transaction.
     */
    public function save($opts = null)
    {
        return $this->_save($opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Labels The deleted transaction.
     */
    public function delete($params = null, $opts = null)
    {
        return $this->_delete($params, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Labels[]
     */
    public static function all($params = null, $opts = null)
    {
        return self::_all($params, $opts);
    }
}
