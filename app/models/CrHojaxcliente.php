<?php

class CrHojaxcliente extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $hc_id;

    /**
     *
     * @var string
     */
    public $hc_fecha_ruta;

    /**
     *
     * @var integer
     */
    public $hc_cargo;

    /**
     *
     * @var string
     */
    public $hc_monto;

    /**
     *
     * @var integer
     */
    public $hc_tipopago;

    /**
     *
     * @var integer
     */
    public $cl_codigo;

    /**
     *
     * @var string
     */
    public $hc_factura;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("'Cr_hojaxcliente'");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'Cr_hojaxcliente';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrHojaxcliente[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrHojaxcliente
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
