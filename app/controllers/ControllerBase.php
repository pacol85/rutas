<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
	/**
	 * Main init function
	 */
	public function initialize() {
		#code ...
		$this->flash->output();
	}
	
	public function fechaExcel($xl_date)
	{
		$PHPTimeStamp = PHPExcel_Shared_Date::ExcelToPHP($xl_date);
		$fechaExcel = date('Y-m-d',$PHPTimeStamp);
		//$fechaExcel = date_format((($xl_date - 25569) * 86400), "Y-m-d H:i:s");
		return $fechaExcel;
	}
	
	public function fechaMySQLx($xl_date)
	{
		$PHPTimeStamp = PHPExcel_Shared_Date::ExcelToPHP($xl_date);
		$fechaExcel = date('Y-m-d',$PHPTimeStamp);
		return $fechaExcel;
	}
	
	public function fechaHoraMySQLx($xl_date)
	{
		$PHPTimeStamp = PHPExcel_Shared_Date::ExcelToPHP($xl_date);
		$fechaExcel = date('Y-m-d H:i:s',$PHPTimeStamp);
		return $fechaExcel;
	}
	
	public function fechaHoy($conHora){
		$timezone  = -6;
		if($conHora == true){
			return gmdate("Y-m-d H:i:s", time() + 3600*($timezone));
		}else{
			return gmdate("Y-m-d", time() + 3600*($timezone));
		}
	
	}
	
	// Sends the json response
	public function sendJson($data) {
		$this->view->disable();
		$this->response->setContentType('application/json', 'UTF-8');
		$this->response->setContent(json_encode($data));
		return $this->response;
	}
	
	public function elemento($t, $n, $l){
		$elem = "";
		if ($t == "h"){
			$elem = $elem.$this->tag->hiddenField(array("$n", "value" => $l));
		}else{
			$elem = '<div class="form-group"><label for="';
			//agregamos el nombre
			$elem = $elem.$n.'" class="col-sm-2 control-label">';
			//agrega label
			$elem = $elem.$l.'</label><div class="col-sm-10">';
			//agrega nombre campo
			switch ($t){
				case "t" :
					$elem = $elem.$this->tag->textField(array("$n", "size" => 30, "class" => "form-control", "id" => "$n"));
					break;
				case "p" :
					$elem = $elem.$this->tag->passwordField(array("$n", "size" => 30, "class" => "form-control", "id" => "$n"));
					break;
			}
			
			$elem = $elem.'</div></div>';
		}		
		return $elem;
	}
	
	public  function form($campos){
		$form = "";
		foreach ($campos as $c){
			$elem = ControllerBase::elemento($c[0], $c[1], $c[2]);
			$form = $form.$elem;
		}
		return $form;
	}
		
}
