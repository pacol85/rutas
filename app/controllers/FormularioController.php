<?php
use Phalcon\Paginator\Adapter\Model;
class FormularioController extends ControllerBase {
	public function indexAction(){
		$uid = parent::gSession("usuario");
		//$rxv = CrVendedorRuta::find("u_id = $uid");
		//$rutas = [];
		$rutas = parent::query(new CrRuta(), 
				"Select * from cr_ruta r,(select ru_id, u_id from cr_vendedor_ruta) x
				where r.ru_id = x.ru_id and x.u_id = 999");
		//$rutas = CrRuta::find("ru_id = (select x.ru_id from cr_vendedor_ruta x where x.u_id = $uid)");
		$campos = [
				["lf", ["ins"], "Seleccionar ruta a ingresar"],
				["sdb", ["ruta", $rutas, ["ru_id", "ru_nombre"]], "Ruta"],
				["s", [""], "Seleccionar"]				
		];
		$action = "formulario/form";
		
		$this->view->titulo = parent::elemento("h1", ["titulo"], "Formulario de ingreso de Ruta");
		$this->view->form = parent::form($campos, $action, "form1");		
	}
	
	public function seleccionarAction(){
		parent::sSession("ruta", parent::gPost("ruta"));
		parent::forward("formulario", "form");	
	}
	
	public function formAction(){
		$ruta = CrRuta::findFirst("ru_id = ".parent::gSession("ruta"));
		$fh = parent::fechaHoy(false);
		parent::view("Formulario para Ruta: $ruta->ru_nombre con fecha: $fh");
	}
	
	public function deshabilitarAction(){
		$user = CrUsuario::findFirst($this->request->get("uid"));
		if($user->u_activo == 1){
			$user->u_activo = 0;
			$user->u_feliminacion = parent::fechaHoy(true);
		}else{
			$user->u_activo = 1;
			$user->u_feliminacion = null;
		}
		
		if($user->save()){
			$this->flash->success("Usuario: $user->u_nombre $user->u_apellido, ha sido procesado exitosamente");
		}else{
			$this->flash->error("Ocurri&oacute; un error al realizar la solicitud");
		}
		return $this->dispatcher->forward(
				array(
						"controller" => "usuarios",
						"action"     => "index"
				)
		);
		
	}
	
	public function editarAction(){
		if ($this->request->has("uNombre") && $this->request->has("uApellido")){
			$user = CrUsuario::findFirst("u_codigo = ".$this->request->getPost("uCodigo"));
			$user->u_nombre = $this->request->getPost("uNombre");
			$user->u_apellido = $this->request->getPost("uApellido");
			if($user->save()){
				$this->flash->success("Usuario guardado exitosamente");
			}else{
				$this->flash->error("Ocurri&oacute; un error al guardar el Usuario");
			}			
		}else{
			$this->flash->error("Nombre o apellido no pueden quedar en blanco");
		}
		parent::forward("usuarios", "index");	
	}
	
	public function changePassAction(){
		$pass = $this->request->getPost("pass");
		if ($this->request->has("uid") && $pass != null && $pass != ""){
			$user = CrUsuario::findFirst("u_codigo = ".$this->request->getPost("uid"));
			$user->u_password = $this->security->hash($pass);
			if($user->save()){
				$this->flash->success("Cambio de contrase&ntilde;a exitoso");
			}else{
				$this->flash->error("Ocurri&oacute; un error al guardar el Usuario");
			}
		}else{
			$this->flash->error("Contrase&ntilde;a no puede quedar en blanco");
		}
		parent::forward("usuarios", "index");
	}
}