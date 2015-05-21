<?php

namespace Ubivar;

class Label extends ApiResource
{
    /**
     * @param string $id The ID of the label to retrieve.
     * @param array|string|null $opts
     *
     * @return Label
     */
    public static function retrieve($id, $opts = null)
    {
        return self::_retrieve($id, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return array An array of Labels.
     */
    public static function all($params = null, $opts = null)
    {
        return self::_all($params, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Label The created label.
     */
    public static function create($params = null, $opts = null)
    {
        
        return self::_create($params, $opts);
    }

    /**
     * @param array|string|null $opts
     *
     * @return Label The saved label.
     */
    public function save($opts = null)
    {
        return $this->_save($opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Label The deleted label.
     */
    public function delete($params = null, $opts = null)
    {
        return $this->_delete($params, $opts);
    }
}
