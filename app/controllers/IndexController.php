<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
		
    }
    
    public function entrarAction(){
    	$user = new CrUsuario();
    	$usuario = $this->request->getPost("usuario");
    	$pass = $this->request->getPost("pass");
    	
    	
    	// Ver si existe el usuario y contraseña
    	$success = $user->find(array("u_codigo =$usuario"));
    	
    	if (count($success) == 1) {
    		//echo "Usuario existente";
    		foreach ($success as $cr_usuario){
    			if($this->security->checkHash($pass, $cr_usuario->u_password)){
    				$this->session->set("usuario", $cr_usuario->u_codigo);
    			}else{
    				parent::msg("Usuario o contrase&ntilde;a incorrectos");
    				parent::forward("inicio", "salir");
    			}
    			
    		}
    		
    		//$this->persistent->usuario = $success;
    		// Forward flow to another action
    		$this->dispatcher->forward(
    				array(
    						"controller" => "inicio",
    						"action"     => "index"
    				)
    		);
    	} else {
    		parent::msg("No se encontr&oacute; el usuario");
    		parent::forward("inicio", "salir");    		
    	}
    	
    	//$this->view->disable();
    }

}

