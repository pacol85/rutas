<?php

class Menu extends \Phalcon\Mvc\Model
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
    public $mlabel;

    /**
     *
     * @var string
     */
    public $mhref;

    /**
     *
     * @var string
     */
    public $mdescripcion;

    /**
     *
     * @var string
     */
    public $mparent;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('mid', 'Menu', 'mparent', array('alias' => 'Menu'));
        $this->hasMany('mid', 'Mxr', 'mid', array('alias' => 'Mxr'));
        $this->belongsTo('mparent', 'Menu', 'mid', array('alias' => 'Menu'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'menu';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Menu[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Menu
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
