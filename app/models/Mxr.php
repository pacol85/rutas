<?php

class Mxr extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $mid;

    /**
     *
     * @var string
     */
    public $rid;

    /**
     *
     * @var string
     */
    public $mrfecha;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('mid', 'Menu', 'mid', array('alias' => 'Menu'));
        $this->belongsTo('rid', 'Roles', 'rid', array('alias' => 'Roles'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mxr';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Mxr[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Mxr
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
