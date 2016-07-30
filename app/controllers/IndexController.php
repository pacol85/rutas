<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {

    }
    
    public function entrarAction(){
    	$user = new CrUsuario();
    	$usuario = $this->request->get("usuario");
    	$pass = $this->security->hash($this->request->get("pass"));
    	
    	
    	// Ver si existe el usuario y contraseña
    	$success = $user->find(array("u_codigo ='$usuario'", "u_password = '$pass'"));
    	
    	if (count($success) == 1) {
    		//echo "Usuario existente";
    		foreach ($success as $cr_usuario){
    			$this->session->set("usuario", $cr_usuario->u_codigo);
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
    		echo "Usuario no fue encontrado";    		
    	}
    	
    	//$this->view->disable();
    }

}

