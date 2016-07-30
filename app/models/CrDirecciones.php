<?php

class CrDirecciones extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $di_id;

    /**
     *
     * @var string
     */
    public $di_direccion;

    /**
     *
     * @var integer
     */
    public $di_ruta;

    /**
     *
     * @var integer
     */
    public $di_cliente;
    
    /**
     *
     * @var string
     */
    public $di_ubicacion;

    /**
     *
     * @var string
     */
    public $di_otros;

    /**
     *
     * @var integer
     */
    public $di_orden;

    /**
     *
     * @var string
     */
    public $di_creacion;
    
    public function initialize()
    {
    	$this->belongsTo("di_cliente", "cr_clientes", "cl_codigo");
    	$this->belongsTo("di_ruta", "cr_ruta", "ru_id");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cr_direcciones';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrDirecciones[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrDirecciones
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
