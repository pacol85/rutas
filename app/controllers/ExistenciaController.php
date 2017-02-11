<?php
//use Phalcon\Registry;
//include 'librerias/PHPExcel-1.8/Classes/PHPExcel.php';
//include 'librerias/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

class ExistenciaController extends ControllerBase {
	
	public function indexAction(){
		$campos = [
				["f", ["archivo"], "Archivo"],
				["s", ["subir"], "Subir"]
		];
		$form = parent::multiForm($campos, "existencia/subir", "form1");
		parent::view("Agregar Productos y Colores", $form);
	}
	
	public function subirAction(){
		if($this->request->hasFiles())
		{
			foreach($this->request->getUploadedFiles() as $file)
			{
				//  Read your Excel workbook
				try {
					$inputFileType = PHPExcel_IOFactory::identify($file->getTempName());
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($file->getTempName());
				} catch(Exception $e) {
					parent::msg('Error loading file "'.$file->getTempName().'": '.$e->getMessage());
					//die('Error loading file "'.$file->getTempName().'": '.$e->getMessage());
				}
				$errores = 0;	
				//ExistenciaController.$this->tablaString =
				$errores = $this->tablaExistencia($objPHPExcel);
				if($errores > 0){
					parent::msg("Errores encontrados: $errores");
				}else{
					parent::msg("Subida de archivo sin errores", "s");
				}
			}
		}/*
		if($this->request->has("archivo")){
			$inputFileName = $this->request->get("archivo","tmp_name");
			
			//  Read your Excel workbook
			try {
				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
			} catch(Exception $e) {
				die('Error loading file $inputFileName - "'.pathinfo($inputFileName,PATHINFO_DIRNAME).'": '.$e->getMessage());
			}
			
			//ExistenciaController.$this->tablaString = 
			ExistenciaController::tablaExistencia($objPHPExcel);
				
		}*/else {
			parent::msg("No se selecciono ningun archivo");
		}
		/*
		$user = new CrUsuario();
		if ($this->request->has("uNombre") && $this->request->has("uApellido") && $this->request->has("uCodigo")
				&& $this->request->has("uPass") && $this->request->has("uPass2")){
			$uNombre = $this->request->get("uNombre");
			$uApellido = $this->request->get("uApellido");
			$uCodigo = $this->request->get("uCodigo");
			$uPass = $this->request->get("uPass");
			$uPass2 = $this->request->get("uPass2");
			$uCreacion = $this->request->get("creacion");
			
			if ($uPass != $uPass2){
				echo "Las contrase�as no concuerdan";
			}else{
				$user->u_nombre = $uNombre;
				$user->u_apellido = $uApellido;
				$user->u_codigo = $uCodigo;
				$user->u_password = $this->security->hash($uPass);
				$user->u_fcreacion = $uCreacion;
				$user->u_activo = 1;
				$user->u_admin = 0;
				$user->save();				
			}
		}else{
			echo "No se ingres� la informaci�n completa";
		}*/
		
		//$this->view->enable();
		return parent::forward("existencia", "index");
	}
	
	//Funci�n tablaExistencia recibe la hoja a leer y el documento
	function tablaExistencia($archivo){
		//contador de errores
		$error = 0;
		//  Get worksheet dimensions
		$sheets = $archivo->getAllSheets();
		set_time_limit(300);
		//$sheet = $archivo -> setActiveSheetIndex(0);
		foreach ($sheets as $sheet){
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();
			
			//variables
			//$registry = new Registry();
			
			$stringTabla = "";
			$titulo = true;
			$longitud = 0;
			$productos = array();
			$colores = array();
			$timezone  = -6; //(GMT -5:00) EST (U.S. & Canada)
			$fechaHoy = gmdate("Y-m-d H:i:s", time() + 3600*($timezone));
			$fila = 0;
			
			//Mostrar datos del Excel en una tabla
			
			for ($row = 1; $row <= $highestRow; $row++){
				//  Read a row of data into an array
				$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
						NULL,
						TRUE,
						FALSE);
			
				//$stringTabla += "<tr>";
			
				foreach ($rowData as $row2){
			
					//Imprime fila de t�tulos
					if ($titulo == true){
						$titulo = false;
						continue;
							
					}
					else{
						$pos = 0;
						//$nada = false;
			
						$stringTabla += "<tr>";
						foreach ($row2 as $columna){
							/*if($pos == 0 and $columna == ""){
								$nada = true;
								break;
							}*/
							if($pos == 0 && ($columna == "" || $columna == null) ){
								return $error;
							}
							if($pos<6){
								$productos[$pos] = $columna;
							}else{
								$colores[$pos-6]= $columna;
							}
							$stringTabla += "<td>$columna</td>";
							$pos++;
			
						}
						//if($nada == false){
							$stringTabla += "</tr>";
							$fila = $fila + 1;
							$prod = new CrProductos();
							$col = new CrColores();
							$cxp = new CrColorXProducto();
							//echo "producto_id: $productos[0]";
							//Comparar si existe el producto
							$prods = CrProductos::find("pr_codigo = '".$productos[0]."'");
							if( count($prods) < 1){
								//Guardar producto
								//echo "entro al count de productos ".count($prods);
								$prod->pr_codigo = $productos[0];
								$prod->pr_nombre = $productos[1];
								$prod->bodega = $productos[2];
								$prod->pasillo = $productos[3];
								$prod->caja = $productos[4];
								$prod->pr_existencia = $productos[5];
								$prod->pr_creacion = $fechaHoy;
								$prod->url = "http://controlruta.ml/rutas/img/$prod->pr_codigo.png";
								if(!$prod->save()){
									$error++;
									parent::msg("Ocurri&oacute; error al cargar fila $fila, producto $prod->pr_nombre");
								}
							}else{
								foreach ($prods as $prod2) {
									$prod = $prod2;
									//actualizando datos
									$prod->pr_nombre = $productos[1];
									$prod->bodega = $productos[2];
									$prod->pasillo = $productos[3];
									$prod->caja = $productos[4];
									$prod->pr_existencia = $productos[5];
									$prod->fmod = $fechaHoy;
									$prod->url = "http://controlruta.ml/rutas/img/$prod->pr_codigo.png";
									if(!$prod->update()){
										$error++;
										parent::msg("Ocurri&oacute; error al cargar fila $fila, producto $prod->pr_nombre");
									}
								}
							}
								
							//comparar si existe el color
							$cols = CrColores::find("co_codigo like '".$colores[0]."'");
							if( count($cols) < 1){
								//Guardar Color
								//echo "entro al count de cols ".count($cols);
								$col->co_codigo = $colores[0];
								$col->co_nombre = $colores[1];
								$col->co_creacion = $fechaHoy;
								if(!$col->save()){
									$error++;
									parent::msg("Ocurri&oacute; error al cargar fila $fila, color $col->co_nombre");
								}
							}else{
								foreach ($cols as $col2) {
									$col = $col2;
									$col->co_nombre = $colores[1];
									if(!$col->update()){
										$error++;
										parent::msg("Ocurri&oacute; error al cargar fila $fila, color $col->co_nombre");
									}	
								}
							}
								
								
							//Guardar relacion entre los dos
							$cxp->co_codigo = $col->co_codigo;
							$cxp->pr_codigo = $prod->pr_codigo;
							$cxp->cp_existencia = $productos[3];
							$cxp->cp_creacion = $fechaHoy;
							if(!$cxp->save()){
								$error++;
								parent::msg("Ocurri&oacute; error al cargar fila $fila, uni&oacute;n de producto ($prod->pr_nombre) con color ($col->co_nombre)");
							}
						//}
						
					}
			
				}
				//print "</tr>";
			}
			//$registry->tablaString = $stringTabla;
			//print "</table>";
		}
		return $error;
	}
	
	function fechaExcel($xl_date)
	{
		$PHPTimeStamp = PHPExcel_Shared_Date::ExcelToPHP($xl_date);
		$fechaExcel = date('Y-m-d',$PHPTimeStamp);
		//$fechaExcel = date_format((($xl_date - 25569) * 86400), "Y-m-d H:i:s");
		return $fechaExcel;
	}
	
	function fechaMySQL($xl_date)
	{
		$PHPTimeStamp = PHPExcel_Shared_Date::ExcelToPHP($xl_date);
		$fechaExcel = date('Y-m-d H:i:s',$PHPTimeStamp);
		//$fechaExcel = date_format((($xl_date - 25569) * 86400), "Y-m-d H:i:s");
		return $fechaExcel;
	}
	
	public function fotosAction(){
		$head = ["C&oacute;digo", "Nombre", "Ubicaci&oacute;n","Existencia", "URL", "Acciones"];
		$tabla = parent::thead("tfotos", $head);
		$menu = Menu::find();
		
		foreach ($menu as $m){
			$s = Seccion::findFirst("id = ".$m->seccion);
			$disp = "S&iacute;";
			if($m->disponible != 1){
				$disp = "No";
			}
			$tabla = $tabla.parent::tbody([
					$s->nombre,
					$m->codigo,
					$m->nombre,
					$m->precio,
					parent::a(1,"menu/disponible/$m->id", $disp),
					parent::a(2, "cargarDatos('".$m->id."','".$m->seccion."','".$m->codigo.
							"','".$m->nombre."','".$m->descripcion."','".$m->precio."');",
							"Editar")." | ".
					parent::a(1,"menu/eliminar/$m->id", "Eliminar")
			]);
		}
	}
}