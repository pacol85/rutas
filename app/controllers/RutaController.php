<?php
class RutaController extends ControllerBase {
	public function indexAction(){
		$this->session->set("clear", "1");
	}
	
	public function nuevoAction(){
		$ruta = new CrRuta();
		if ($this->request->has("ruNombre") && $this->request->has("ruId")){
			$ruId = $this->request->get("ruId");
			$ruNombre = $this->request->get("ruNombre");
			$ruDescripcion = $this->request->get("ruDescripcion");
			$timezone  = -6;
			$fechaHoy = gmdate("Y-m-d H:i:s", time() + 3600*($timezone));
			//$uCreacion = $this->request->get("creacion");
			
			$ruta->ru_id = $ruId;				
			$ruta->ru_nombre = $ruNombre;
			$ruta->ru_descripcion = $ruDescripcion;
			$ruta->ru_creacion = $fechaHoy;
			if($ruta->save()){
				$this->flash->success("Ruta creada exitosamente");
			}else{
				$this->flash->error("Ruta fallo en la creacion (".$ruta->readAttribute('ru_id').", "
						.$ruta->readAttribute('ru_nombre').", ".$ruta->readAttribute('ru_descripcion')
						.", ".$ruta->readAttribute('ru_creacion').")");
			}
			
			
		}else{
			$this->flash->error("No se ingresó la información completa");
		}
		
		$this->dispatcher->forward(
    				array(
    						"controller" => "ruta",
    						"action"     => "index"
    				)
    		);
		
	}
}