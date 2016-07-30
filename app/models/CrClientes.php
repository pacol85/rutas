<?php

class CrClientes extends \Phalcon\Mvc\Model
{

	/**
	 *
	 * @var integer
	 */
	public $cl_codigo;
	
    /**
     *
     * @var string
     */
    public $cl_nombre;

    /**
     *
     * @var string
     */
    public $cl_comentarios;

    /**
     *
     * @var double
     */
    public $cl_saldo;

    /**
     *
     * @var string
     */
    public $cl_creacion;

    /**
     *
     * @var double
     */
    public $cl_saldoini;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cr_clientes';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrClientes[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrClientes
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
