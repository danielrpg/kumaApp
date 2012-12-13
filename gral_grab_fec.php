<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
?>
<?php
$agen = $_POST["cod_agencia"];
$fec_proc = $_POST['fecha'];
$logi = $_SESSION['login']; 
 
// if (valida_fecha($fec_proc)) {
    $f_proc = cambiaf_a_mysql($fec_proc);
    $consulta  = "Insert into gral_control_fecha (GRAL_AGENCIA_CODIGO, GRAL_CTRL_FECHA_ACT, GRAL_CTRL_FECHA_USR_ALTA, GRAL_CTRL_FECHA_FEC_HR_ALTA,GRAL_CTRL_FECHA_USR_BAJA,GRAL_CTRL_FECHA_FEC_HR_BAJA) values 
(32,'$f_proc','$logi',null,null,'0000-00-00 00:00:00')";

$resultado = mysql_query($consulta)or die('No pudo insertar : ' . mysql_error());
//require ('menu_s.php');
//header(”Location: menu_s.php”);
 header('Location: menu_s.php');
//echo "Se cambió la Fecha <a href='menu_s.php'>volver a Menu Principal</a>";
//} else {
//echo "Error en la fecha <a href='gral_cam_fec.php'>volver a Intentar</a>";
//}
ob_end_flush();
?>


