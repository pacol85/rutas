<?php
class VprController extends ControllerBase {
	public function indexAction(){
		$this->session->set("clear", "1");
	}
	
	public function modAction(){
		//variable para acumular mensajes:
		$mensaje = "";
		
		$rutaId2 = $this->session->get("srid");
		//$mensaje = $mensaje + "RutaID es $rutaId2";
		
		$userList = CrUsuario::find();
		if($rutaId2 > 0){
			
			$timezone  = -6;
			$fechaHoy = gmdate("Y-m-d H:i:s", time() + 3600*($timezone));
			$asoc = $this->request->get("asoc");
			//$mensaje = $mensaje."Asoc: ".json_encode($asoc)." ";
			//$this->session->set("mensaje", "entro y asoc: $asoc");
			
			//obten asociaciones guardadas en vendedor x ruta
			$vprs = CrVendedorRuta::find(
					array(
							"ru_id = $rutaId2",							
					));
			
			//obtener usuarios en vendedor por ruta
			$upr = array();
			foreach ($vprs as $uvpr){
				array_push($upr, $uvpr->u_id);
				//$mensaje = $mensaje + " usuario: ". $uvpr->u_id . " ";
			}
			//$mensaje = $mensaje." UPR: ".json_encode($upr);
			
			if(sizeof($asoc) < 1){
				foreach ($vprs as $elimina){
					$elimina->delete();					
				}
				$mensaje = $mensaje."Se eliminaron todas las asociaciones";
			}else{
				foreach ($userList as $user){
					if(in_array($user->u_codigo, $asoc)){
						if(!in_array($user->u_codigo, $upr)){
							//hacer union
							$vpr = new CrVendedorRuta();
							$vpr->ru_id = $rutaId2;
							$vpr->u_id = $user->u_codigo;
							$vpr->vr_creacion = $fechaHoy;
							if(!$vpr->save()){
								$mensaje = $mensaje."Fallo en la creacion de union ruta $rutaId2 con usuario ".$vpr->u_id."";
							}
						}
					}else{
						if(in_array($user->u_codigo, $upr)){
							$borraVpr = CrVendedorRuta::findFirst(array("ru_id = $rutaId2 and u_id = ".$user->u_codigo.""));
							$borraVpr->delete();
						}
					}					
				}	
			}
			$this->session->set("mensaje", $mensaje);
			
		}else{
			$this->session->set("mensaje", "No se encontr&oacute; rid2");
		}
		
			
		$this->dispatcher->forward(
    				array(
    						"controller" => "ruta",
    						"action"     => "index"
    				)
    		);
		
	}
	
	function armaMenu($uid) {
		$user = Usuarios::findFirst("u_codigo = $uid");
			
		$titulos = Menu::find(array("mparent is null and mid in (select x.mid from mxr x where x.rid = $user->rid)", "order" => "mid"));
		$lia = '<li><a href="';
		$liaf = '">';
		$endLi = '</a></li>';
		$html = '
				<div id="sse3">
  					<div id="sses3">
    					<ul>';
		foreach ($titulos as $t){
			$html = $html.$lia.$t->mhref.$liaf.$t->mlabel.$endLi;			
		}
		$html = $html.'</ul></div></div>';
		return $html;
	}
}