<?php

class CrProductos extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $pr_codigo;

    /**
     *
     * @var string
     */
    public $pr_nombre;

    /**
     *
     * @var string
     */
    public $pr_ubicacion;

    /**
     *
     * @var integer
     */
    public $pr_existencia;

    /**
     *
     * @var string
     */
    public $pr_creacion;

    /**
     *
     * @var string
     */
    public $bodega;

    /**
     *
     * @var string
     */
    public $pasillo;

    /**
     *
     * @var string
     */
    public $estilo;

    /**
     *
     * @var string
     */
    public $caja;

    /**
     *
     * @var string
     */
    public $fmod;

    /**
     *
     * @var string
     */
    public $url;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('pr_codigo', 'CrColorxproducto', 'pr_codigo', array('alias' => 'CrColorxproducto'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cr_productos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrProductos[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrProductos
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
