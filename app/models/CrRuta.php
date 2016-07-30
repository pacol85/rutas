<?php

class CrRuta extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $ru_id;

    /**
     *
     * @var string
     */
    public $ru_nombre;

    /**
     *
     * @var string
     */
    public $ru_descripcion;

    /**
     *
     * @var string
     */
    public $ru_creacion;

    public function getSource()
    {
        return 'cr_ruta';
    }
    
    public function initialize()
    {
    	$this->hasMany("ru_id", "cr_vendedor_ruta", "ru_id");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrRuta[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrRuta
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
