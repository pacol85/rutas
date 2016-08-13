<?php
class UsuariosController extends ControllerBase {
	public function indexAction(){
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
		$js = parent::jsCargarDatos($fields, ["main"], ["edit"]);
		
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
					"<a onClick=\"cargarDatos($user->u_codigo, '".$user->u_nombre."', '".$user->u_apellido."');\">Editar</a> |"
					."<a href='usuarios/deshabilitar?uid=".$user->u_codigo."'>$accion</a></td>"
			];
			$tabla = $tabla.parent::td($col);			
			$tabla = $tabla."</tr>";
		}
			
		$this->view->tabla = parent::elemento("enter", [], "").parent::ftable($tabla);
		$this->view->titulo = parent::elemento("h1", ["titulo"], "Usuarios / Vendedores");
		$this->view->form = parent::form($campos, $action);
	}
	
	public function nuevoAction(){
		$user = new CrUsuario();
		if ($this->request->has("uNombre") && $this->request->has("uApellido") && $this->request->has("uCodigo")){
				//&& $this->request->has("uPass") && $this->request->has("uPass2")){
			$uNombre = $this->request->get("uNombre");
			$uApellido = $this->request->get("uApellido");
			$uCodigo = $this->request->get("uCodigo");						
			//$timezone  = -6;
			//$fechaHoy = gmdate("Y-m-d H:i:s", time() + 3600*($timezone));
			//$uCreacion = $this->request->get("creacion");
			
			//if ($uPass != $uPass2){
			//	echo "Las contraseñas no concuerdan";
			//}else{
				$user->u_nombre = $uNombre;
				$user->u_apellido = $uApellido;
				$user->u_codigo = $uCodigo;
				$user->u_activo = 1;
				$user->u_admin = 0;
				$user->save();
				$this->session->set("mensaje", "Usuario creado exitosamente");
			//}
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
}