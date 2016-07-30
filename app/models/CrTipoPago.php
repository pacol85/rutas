<?php

class CrTipoPago extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $tp_id;

    /**
     *
     * @var string
     */
    public $tp_tipo;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("'Cr_tipo_pago'");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'Cr_tipo_pago';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrTipoPago[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrTipoPago
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
