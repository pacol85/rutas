<?php

class CrColores extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $co_codigo;

    /**
     *
     * @var string
     */
    public $co_nombre;

    /**
     *
     * @var string
     */
    public $co_rgb;

    /**
     *
     * @var string
     */
    public $co_hex;

    /**
     *
     * @var string
     */
    public $co_creacion;
    
    public function initialize()
    {
    	$this->hasMany("co_codigo", "cr_colorxproducto", "co_codigo");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cr_colores';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrColores[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrColores
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
