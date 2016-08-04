<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Control de Rutas</title>
        <base href="/rutas/">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="css/menu-1.css">
        <link rel="stylesheet" href="css/reset.css">
		<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
        <link rel="stylesheet" type="text/css" href="css/w3.css">
        <link rel="stylesheet" type="text/css" href="css/classic.css">
        <link rel="stylesheet" type="text/css" href="css/classic.date.css">
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!-- old plugin: <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
        <!-- Javascript para menu -->
        <script type="text/javascript" src="js/menu.js"></script>
        <!-- jQuery Mask -->
        <script type="text/javascript" language="javascript" src="js/jquery.mask.min.js"></script>
        <!-- Noty -->
        <script type="text/javascript" src="js/jquery.noty.packaged.min.js"></script>
        <!-- PickADate -->
        <script type="text/javascript" src="js/picker.js"></script>
        <script type="text/javascript" src="js/picker.date.js"></script>
        <script type="text/javascript" language="javascript" src="js/es_ES.js"></script>
        <!-- ReactJS -->
        <script src="https://npmcdn.com/react@15.3.0/dist/react.min.js"></script>
		<script src="https://npmcdn.com/react-dom@15.3.0/dist/react-dom.min.js"></script>
        <script src="https://npmcdn.com/babel-core@5.8.38/browser.min.js"></script> 
    </head>
    <body>
    <?php
    	/*$texto = 
'<div id="sse3">
  <div id="sses3">
    <ul>
      <li><a href="inicio/index">Inicio</a></li>
      <li><a href="usuarios/index">Usuarios</a></li>
      <li><a href="clientes/index">Clientes</a></li>
      <li><a href="ruta/index">Rutas</a></li>
      <li><a href="inicio/salir">Cerrar Sesi&oacute;n</a></li>      
    </ul>
  </div>
</div>';	*/
    	$usuario = $this->session->get("usuario");
		$user_time = $this->session->get("user_time");
		if($usuario != null && $usuario != ""){
			$texto = armaMenu($usuario);
			$u = CrUsuario::findFirst($usuario);
			//if(!$this->security->checkHash('Sistema09s', $u->u_contrasena)){
				echo $texto;
			//}
						
		}else{
			$homepage = "/rutas/";
			$currentpage = $_SERVER['REQUEST_URI'];
			if(!($homepage==$currentpage)) {
				//echo $currentpage;
				//$this->flashSession->output();
				header("Location: /rutas/");
			}
			//window.location.replace("./inicio/salir");	
		}
		
		function armaMenu($uid) {
			$user = CrUsuario::findFirst("u_codigo = $uid");
				
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
		
		function auto_logout($field)
		{
		    $t = time();
		    $t0 = $_SESSION[$field];
		    $diff = $t - $t0;
		    if ($diff > 10 || !isset($t0))
		    {          
		        return true;
		    }
		    else
		    {
		        $_SESSION[$field] = time();
		    }
		}
		
		if($user_time != null && $user_time != ""){
		
			if(auto_logout("user_time"))
		    {
		    	
		        /*session_unset();
		        session_destroy();
		        //location("/activoFijo/");
		        header("Location: /activoFijo/");          
		        exit;*/
		    }
		}
	?>    	
        <div class="container">
            {{ content() }}
        </div>
        
        
    </body>
</html>
