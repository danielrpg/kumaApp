<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
?>
<?php
echo "entra a grabar";
$_SESSION['form_buffer'] = $_POST;
$logi = $_SESSION['login']; 
$log_i = $_SESSION['login_i'];

//$log_usr = strtolower($log_usr);
echo "Entra a Grabar  ".$log_i,$logi;
/* if (empty($log_usr)) {
    echo "Error en Login no puede estar vacia <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
//	return;
} */

$agen = $_POST["cod_agencia"];
$c_i = $_POST["ci"];
/*
if (empty($c_i)) {
    echo "Error en Carnet de Identidad no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
//	return;
} */
$nom = $_POST["nombres"]; 
$nom = strtoupper($nom);
$a_pat = $_POST["ap_pater"];
$a_pat = strtoupper($a_pat);
$a_mat = $_POST["ap_mater"]; 
$a_mat = strtoupper ($a_mat);
$fec_nac = $_POST['fec_nac'];
$f_nac = cambiaf_a_mysql($fec_nac);
$dir = $_POST["direc"]; 
$dir = strtoupper ($dir);
$fon = $_POST["fono"];
 $cel = $_POST["celu"]; 
 $pass =$_POST["clav"]; 
$sec = $_POST["cod_sec"]; 
$car = $_POST["cod_car"]; 
$e_m = $_POST["email"]; 
$est = $_POST["cod_est"];
$marca_baja = "update gral_usuario set GRAL_USR_USR_BAJA='$logi', GRAL_USR_FEC_HR_BAJA=null where GRAL_USR_LOGIN= '$log_i' ";
$res_mbaja = mysql_query($marca_baja)or die('No pudo marcar baja : ' . mysql_error());

$consulta  = "Insert into gral_usuario (GRAL_USR_LOGIN,GRAL_AGENCIA_CODIGO,GRAL_USR_CI, GRAL_USR_NOMBRES,GRAL_USR_AP_PATERNO,GRAL_USR_AP_MATERNO,GRAL_USR_CLAVE,GRAL_USR_FEC_NAC,GRAL_USR_SECTOR,GRAL_USR_CARGO,GRAL_USR_DIRECCION,GRAL_USR_TELEFONO,GRAL_USR_CELULAR,GRAL_USR_EMAIL,GRAL_USR_ESTADO,GRAL_USR_USR_ALTA,GRAL_USR_FEC_HR_ALTA,GRAL_USR_USR_BAJA,GRAL_USR_FEC_HR_BAJA) values 
('$log_i',$agen, '$c_i', '$nom','$a_pat','$a_mat','$pass','$f_nac',$sec, $car, '$dir', $fon, $cel, '$e_m', $est, '$logi',null,null,'0000-00-00 00:00:00')";

$resultado = mysql_query($consulta)or die('No pudo insertar : ' . mysql_error());
header('Location: gral_man_usr.php');




  
/*
if (empty($nom)) {
    echo "Error en Nombres no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
	//return;
}


if (empty($a_pat)) {
    echo "Error en Apellido Paterno no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
	//return;
} 

//echo $a_pat;
$a_mat = $_POST["ap_mater"]; 
$a_mat = strtoupper ($a_mat);
$fec_nac = $_POST['fec_nac']; 
if (empty($fec_nac)) {
    echo "Error en Fecha Nacimiento no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
	//return;
} 

if (empty($dir)) {
    echo "Error en Direccion no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
	//return;
} 

if (empty($fon)) {
    echo "Error en Telefono no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
	//return;
}

if (empty($cel)) {
    echo "Error en Celular no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
//	return;
}


if (empty($pass)) {
    echo "Error en Clave no puede estar vacia <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
//	return;
}

$logi = $_SESSION['login']; 
$log_usr = $_SESSION['login_i'];
//$_SESSION['form_buffer'] = $_POST;
//$datos = $_SESSION['form_buffer'];
 if (valida_fecha($fec_nac)) {
   
	
	
    
//require 'gral_man_usr.php';
header('Location: gral_man_usr_cm.php');
//echo "Usuario Registrado <a href='gral_man_usr.php'>volver a Menu Mantenimiento Usuarios</a>";
//} else {
//echo "Error algun Dato <a href='gral_man_usr_cm.php'>volver a Intentar</a>";
//}
?>
<?php
ob_end_flush();
*/
 ?>


