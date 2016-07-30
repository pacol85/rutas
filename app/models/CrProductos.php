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
    
    public function initialize()
    {
    	$this->hasMany("pr_codigo", "cr_colorxproducto", "pr_codigo");
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
     * @return CrProducto[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrProducto
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
