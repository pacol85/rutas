<?php

class Roles extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $rid;

    /**
     *
     * @var string
     */
    public $rnombre;

    /**
     *
     * @var string
     */
    public $rdescripcion;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('rid', 'Mxr', 'rid', array('alias' => 'Mxr'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'roles';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Roles[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Roles
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
