<?php

class CrColorXProducto extends \Phalcon\Mvc\Model
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
    public $co_codigo;

    /**
     *
     * @var integer
     */
    public $cp_existencia;

    /**
     *
     * @var string
     */
    public $cp_creacion;
     
    public function initialize()
    {
    	$this->belongsTo("pr_codigo", "cr_productos", "pr_codigo");
    	$this->belongsTo("co_codigo", "cr_colores", "co_codigo");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cr_colorxproducto';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrColorXProducto[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrColorXProducto
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
