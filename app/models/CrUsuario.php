<?php

class CrUsuario extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $u_nombre;

    /**
     *
     * @var string
     */
    public $u_apellido;

    /**
     *
     * @var integer
     */
    public $u_codigo;

    /**
     *
     * @var integer
     */
    public $u_admin;

    /**
     *
     * @var string
     */
    public $u_password;

    /**
     *
     * @var string
     */
    public $u_fcreacion;

    /**
     *
     * @var string
     */
    public $u_feliminacion;

    /**
     *
     * @var integer
     */
    public $u_activo;

    /**
     *
     * @var string
     */
    public $rid;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cr_usuario';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrUsuario[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CrUsuario
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
