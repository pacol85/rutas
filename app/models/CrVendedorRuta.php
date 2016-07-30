<?php

class CrVendedorRuta extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $u_id;

    /**
     *
     * @var integer
     */
    public $ru_id;

    /**
     *
     * @var string
     */
    public $vr_creacion;

    /**
     * Initialize method for model.
     */
    
    public function initialize()
    {
    	$this->belongsTo("u_id", "cr_usuario", "u_codigo");
    	$this->belongsTo("ru_id", "cr_ruta", "ru_id");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cr_vendedor_ruta';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrVendedorRuta[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrVendedorRuta
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
