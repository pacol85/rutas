<?php
class UsuariosController extends ControllerBase {
	public function indexAction(){
		$this->session->set("clear", "1");
	}
	
	public function nuevoAction(){
		$user = new CrUsuario();
		if ($this->request->has("uNombre") && $this->request->has("uApellido") && $this->request->has("uCodigo")
				&& $this->request->has("uPass") && $this->request->has("uPass2")){
			$uNombre = $this->request->get("uNombre");
			$uApellido = $this->request->get("uApellido");
			$uCodigo = $this->request->get("uCodigo");
			$uPass = $this->request->get("uPass");
			$uPass2 = $this->request->get("uPass2");
			$timezone  = -6;
			$fechaHoy = gmdate("Y-m-d H:i:s", time() + 3600*($timezone));
			//$uCreacion = $this->request->get("creacion");
			
			if ($uPass != $uPass2){
				echo "Las contraseñas no concuerdan";
			}else{
				$user->u_nombre = $uNombre;
				$user->u_apellido = $uApellido;
				$user->u_codigo = $uCodigo;
				$user->u_password = $this->security->hash($uPass);
				$user->u_fcreacion = $fechaHoy; //$uCreacion;
				$user->u_activo = 1;
				$user->u_admin = 0;
				$user->save();
				$this->session->set("mensaje", "Usuario creado exitosamente");
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
		if($this->request->get("d") == 1){
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