<?php
class ClientesController extends ControllerBase {
	public function indexAction(){
		$this->session->set("clear", "1");
	}
	
	public function nuevoAction(){
		$cliente = new CrClientes();
		if ($this->request->has("clNombre") && $this->request->has("clCodigo")){
			$clNombre = $this->request->get("clNombre");
			$clCodigo = $this->request->get("clCodigo");
			if($clCodigo != "" && $clNombre != ""){
				$clComentarios = $this->request->get("clComentarios");
				$clSaldoIni = $this->request->get("clSaldoIni");
				$timezone  = -6;
				$fechaHoy = gmdate("Y-m-d H:i:s", time() + 3600*($timezone));
				//$uCreacion = $this->request->get("creacion");
				
				$cliente->cl_codigo = $clCodigo;
				$cliente->cl_comentarios = $clComentarios;
				$cliente->cl_creacion = $fechaHoy;
				$cliente->cl_nombre = $clNombre;
				$cliente->cl_saldoini = $clSaldoIni;
				$cliente->save();
				$this->flash->success("Cliente creado exitosamente");
			}else{
				$this->flash->error("No se ingres&oacute; la informaci&oacute;n completa");
			}		
		}else{
			$this->flash->error("No se encontraron los campos en la solicitud");
		}
		
		$this->dispatcher->forward(
    				array(
    						"controller" => "clientes",
    						"action"     => "index"
    				)
    		);
		
	}
}