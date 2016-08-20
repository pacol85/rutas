<?php

class OtrosXForm extends \Phalcon\Mvc\Model
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
    public $razon;

    /**
     *
     * @var string
     */
    public $monto;

    /**
     *
     * @var string
     */
    public $form;

    /**
     *
     * @var integer
     */
    public $tipo;

    /**
     *
     * @var string
     */
    public $cliente;

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
        return 'otros_x_form';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return OtrosXForm[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return OtrosXForm
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
