<?php
class InicioController extends ControllerBase {
	public function indexAction(){
		if (!($this->session->has("usuario"))){
			$this->dispatcher->forward(
					array(
							"controller" => "index",
							"action"     => "index"
					)
			);
		}
		//$usuario = $this->session->get("usuario");
		//echo "Bienvenido/a $usuario";
	}
	
	public function salirAction(){
		$usuario = $this->session->destroy(true);
		$this->dispatcher->forward(
				array(
						"controller" => "index",
						"action"     => "index"
				)
		);
		
	}
}
?>