<?php

class DetalleXForm extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $billete;

    /**
     *
     * @var string
     */
    public $cliente;

    /**
     *
     * @var integer
     */
    public $cantidad;

    /**
     *
     * @var string
     */
    public $monto;

    /**
     *
     * @var integer
     */
    public $tipo;

    /**
     *
     * @var string
     */
    public $form;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('form', 'Formulario', 'id', array('alias' => 'Formulario'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'detalle_x_form';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return DetalleXForm[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return DetalleXForm
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
