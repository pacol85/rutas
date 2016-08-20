<?php

class TransaccionesXForm extends \Phalcon\Mvc\Model
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
    public $cliente;

    /**
     *
     * @var string
     */
    public $valorfacturado;

    /**
     *
     * @var string
     */
    public $valorextra;

    /**
     *
     * @var string
     */
    public $pagoefectivo;

    /**
     *
     * @var string
     */
    public $pagocheque;

    /**
     *
     * @var string
     */
    public $devolucion;

    /**
     *
     * @var string
     */
    public $error;

    /**
     *
     * @var string
     */
    public $formulario;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('formulario', 'Formulario', 'id', array('alias' => 'Formulario'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'transacciones_x_form';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TransaccionesXForm[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TransaccionesXForm
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
