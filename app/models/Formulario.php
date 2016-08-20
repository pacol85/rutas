<?php

class Formulario extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $id;

    /**
     *
     * @var string
     */
    public $fecha;

    /**
     *
     * @var string
     */
    public $vendedor;

    /**
     *
     * @var string
     */
    public $ruta;

    /**
     *
     * @var string
     */
    public $correlativo;

    /**
     *
     * @var integer
     */
    public $estado;

    /**
     *
     * @var string
     */
    public $revisadopor;

    /**
     *
     * @var string
     */
    public $frevision;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'DetalleXForm', 'form', array('alias' => 'DetalleXForm'));
        $this->hasMany('id', 'OtrosXForm', 'form', array('alias' => 'OtrosXForm'));
        $this->hasMany('id', 'TransaccionesXForm', 'formulario', array('alias' => 'TransaccionesXForm'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'formulario';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Formulario[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Formulario
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
