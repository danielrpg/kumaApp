<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
?>
<html>
<head>
<title> <?php $_SESSION['COD_EMPRESA'];?></title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"></script>
</head>
<body>
	<div id="cuerpoModulo">
    	<?php
				include("header.php");
			?>
            <div id="UserData">
                 <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />
				<?php
                 $fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
                ?> 
			</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                 Lista de Usuarios
            </div>
			 <div id="AtrasBoton">
           		<a href="gral_man_usr.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
<?php
$consul = 0;
$log_usr =$_POST["log"];

if (empty($log_usr)) {
    $consul = $consul + 1;
	} else {
	 $consulta  = "Select * From gral_usuario where GRAL_USR_LOGIN = '$log_usr' and GRAL_USR_USR_BAJA is null";
}


/*$log_usr = strtolower($log_usr);
if (empty($log_usr)) {
    $consul = $consul + 1;
	} else {
	 $consulta  = "Select * From gral_usuario where GRAL_USR_LOGIN = '$log_usr' and GRAL_USR_USR_BAJA is null";
}*/
$c_i = $_POST["ci"];

if (empty($c_i)) {
   $consul = $consul + 1;
   } else {
   $c_i =  "%".$c_i."%";
	 $consulta  = "Select * From gral_usuario where GRAL_USR_CI like '$c_i' and GRAL_USR_USR_BAJA is null";
}
/*if (empty($c_i)) {
   $consul = $consul + 1;
   } else {
	 $consulta  = "Select * From gral_usuario where GRAL_USR_CI = '$c_i' and GRAL_USR_USR_BAJA is null";
 
}*/
$nom = $_POST["nombres"]; 
if (empty($nom)) {
     $consul = $consul + 1;
	} else {
	 $nom =  "%".strtoupper($nom)."%";
	 $consulta  = "Select * From gral_usuario where GRAL_USR_NOMBRES like '$nom' and GRAL_USR_USR_BAJA is null"; 
}
/*if (empty($nom)) {
     $consul = $consul + 1;
	} else {
	 $nom = strtoupper($nom);
	 $consulta  = "Select * From gral_usuario where GRAL_USR_NOMBRES = '$nom' and GRAL_USR_USR_BAJA is null"; 
}*/
$a_pat = $_POST["ap_pater"];
if(isset($_POST["ap_pater"])){ 
   $a_pat = $_POST["ap_pater"];
   }
if (empty($a_pat)) {
    $consul = $consul + 1;
    } else {
	$a_pat = "%".strtoupper($a_pat)."%";
	
	$consulta  = "Select * From gral_usuario where GRAL_USR_AP_PATERNO like '$a_pat' and GRAL_USR_USR_BAJA is null"; 
} 
/*if (empty($a_pat)) {
    $consul = $consul + 1;
    } else {
	$a_pat = strtoupper($a_pat);
	$consulta  = "Select * From gral_usuario where GRAL_USR_AP_PATERNO = '$a_pat' and GRAL_USR_USR_BAJA is null"; 
}*/ 
$a_mat = $_POST["ap_mater"];
if (empty($a_mat)) {
    $consul = $consul + 1; 
    } else {
	$a_mat = "%".strtoupper ($a_mat)."%"; 
	$consulta  = "Select * From gral_usuario where GRAL_USR_AP_MATERNO like '$a_mat' and GRAL_USR_USR_BAJA is null";
} 
/*if (empty($a_mat)) {
    $consul = $consul + 1; 
    } else {
	$a_mat = strtoupper ($a_mat); 
	$consulta  = "Select * From gral_usuario where GRAL_USR_AP_MATERNO = '$a_mat' and GRAL_USR_USR_BAJA is null";
}*/ 
if ($consul == 5) {
 //  echo "Consultara todos";
   $consulta  = "Select * From gral_usuario where GRAL_USR_USR_BAJA is null";
}
?>  
 <?php  
   $resultado = mysql_query($consulta);
?>
 <div id="GeneralManUsuarioM">
<form name="form2" method="post" action="grab_retro_clim.php" >
<select name="cod_usr[]" size="12" multiple>
  <?php 
  
  while ($linea = mysql_fetch_array($resultado)) {
      $_SESSION['cli_usr'] = 1;
   ?>
	 <option value=<?php echo $linea['GRAL_USR_LOGIN']; ?>>
		<?php echo $linea['GRAL_USR_AP_PATERNO']; ?>
		<?php echo $linea['GRAL_USR_AP_MATERNO']; ?>
		<?php echo $linea['GRAL_USR_NOMBRES']; ?></option>
 <?php
   }
 ?>
  </select><br><br>
  <input type="submit" name="accion" value="Modificar">
  </form>
  </div>

<div id="TableModulo">

</table>
</div>
 <?php
		 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
ob_end_flush();
 ?>