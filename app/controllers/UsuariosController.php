<?php
class UsuariosController extends ControllerBase {
	public function indexAction(){
		//limpiar campos
		$this->tag->resetInput();
		$this->session->set("clear", "1");
		$campos = [
				["t", ["uNombre"], "Nombre"],
				["t", ["uApellido"], "Apellido"],
				["t", ["uCodigo"], "C&oacute;digo"],
				["s", [""], "Agregar"]				
		];
		$action = "usuarios/nuevo";
		
		//js
		$fields = ["uNombre", "uApellido", "uCodigo"];
		$otros = [["uCodigo", "'disabled', true"]];		
		
		//armar tabla
		$head = ["C&oacute;digo", "Nombre", "Apellido", "Creaci&oacute;n", "Acciones"];
		$tabla = parent::thead("usuarios", $head);
		$userList = CrUsuario::find();
		foreach ($userList as $user){
			$tabla = $tabla."<tr>";
			$accion = "Deshabilitar";
			if($user->u_activo == 0) $accion = "Habilitar";
			$col = [
					$user->u_codigo,
					$user->u_nombre,
					$user->u_apellido,
					$user->u_fcreacion,
					"<a onClick=\"cargarDatos('".$user->u_nombre."', '".$user->u_apellido."', '$user->u_codigo');\">Editar</a> |"
					."<a href='usuarios/deshabilitar?uid=".$user->u_codigo."'>$accion</a></td>"
			];
			$tabla = $tabla.parent::td($col);			
			$tabla = $tabla."</tr>";
		}
		
		$this->view->js = parent::jsCargarDatos($fields, ["main"], ["edit"], $otros);
		$this->view->tabla = parent::elemento("enter", [], "").parent::ftable($tabla);
		$this->view->titulo = parent::elemento("h1", ["titulo"], "Usuarios / Vendedores");
		$this->view->form = parent::form($campos, $action, "form1");
		$this->view->botones = parent::elemento("bg", [["edit", "guardarCambio()", "Editar"],["cancel", "cancelar()", "Cancelar"]], "");
	}
	
	public function nuevoAction(){
		$user = new CrUsuario();
		if ($this->request->has("uNombre") && $this->request->has("uApellido") && $this->request->has("uCodigo")){			
			$uNombre = $this->request->get("uNombre");
			$uApellido = $this->request->get("uApellido");
			$uCodigo = $this->request->get("uCodigo");						
			$user->u_nombre = $uNombre;
			$user->u_apellido = $uApellido;
			$user->u_codigo = $uCodigo;
			$user->u_password = $this->security->hash("fakePass");
			$user->u_activo = 1;
			$user->u_admin = 0;
			$user->u_fcreacion = parent::fechaHoy(true);
			if($user->save()){
				$this->flash->success("Usuario creado exitosamente");
			}else{
				$this->flash->error("Ocurri&oacute; un error durante la creaci&oacute;n");
			}
		}else{
			echo "No se ingresó la información completa";
		}
		
		$this->dispatcher->forward(
    				array(
    						"controller" => "usuarios",
    						"action"     => "index"
    				)
    		);
		
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
				
			}else{
	
			}			
		}else{
			
		}
		parent::forward("usuarios", "index");
	}
}