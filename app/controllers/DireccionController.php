<?php
class DireccionController extends ControllerBase {
	public function indexAction(){
		$this->session->set("clear", "1");
		if($this->request->has("cli")){	
			$this->session->set("cli", $this->request->get("cli"));		
			//$this->view->cliente = $this->request->get("cli");
		}		
		
	}
	
	public function nuevaAction(){
		if($this->request->getPost("direccion") != ""){
			$direccion = $this->request->getPost("direccion");
			$ubicacion = $this->request->getPost("ubicacion");
			$ruta = $this->request->getPost("ruta");
			$otros = $this->request->getPost("otros");
			
			$direc = new CrDirecciones();
			$direc->di_cliente = $this->session->get("cli");
			$direc->di_creacion = parent::fechaHoy(true);
			$direc->di_direccion = $direccion;
			$direc->di_otros = $otros;
			$direc->di_ruta = $ruta;
			$direc->di_ubicacion = $ubicacion;
			if($direc->save()){
				$this->flash->success("Direcci&oacute;n creada exitosamente");
			}else{
				$this->flash->error("Se produjo un error al momento de guardar la direcci&oacute;n");
			}
		}else{
			$this->flash->error("Direcci&oacute;n no puede quedar vac&iacute;a");	
		}
		$this->dispatcher->forward(
    				array(
    						"controller" => "direccion",
    						"action"     => "index"
    				)
    		);
		
	}
	
	public function delDirAction(){
		$id = $this->request->getPost("dirid");
		$dir = CrDirecciones::findFirst("di_id = $id");
		if($dir->delete()){
			$this->flash->success("Direcci&oacute;n borrada con &eacute;xito");
		}else{
			$this->flash->error("Ocurri&oacute; un error al querer eliminar la direcci&oacute;n");
		}
		$this->dispatcher->forward(
				array(
						"controller" => "direccion",
						"action"     => "index"
				)
		);
	}
	
	public function editarAction(){
		$id = $this->request->getPost("did");
		$dir = CrDirecciones::findFirst("di_id = $id");
		if($this->request->getPost("direccion") == ""){
			$this->flash->error("La direcc&oacute;n no puede quedar en blanco");
		}else{
			$dir->di_direccion = $this->request->getPost("direccion");
			$dir->di_ubicacion = $this->request->getPost("ubicacion");
			$dir->di_otros = $this->request->getPost("otros");
			$dir->di_ruta = $this->request->getPost("ruta");
			if($dir->save()){
				$this->flash->success("Modificaci&oacute;n exitosa");				
			}else{
				$this->flash->error("Fall&oacute; la actualizaci&oacute;n");
			}
		}
		$this->dispatcher->forward(
				array(
						"controller" => "direccion",
						"action"     => "index"
				)
		);
	}
}