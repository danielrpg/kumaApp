<?php
ob_start();
session_start();
require('configuracion.php');
$usr_name = $_POST['usr_name'];
$usr_password = $_POST['usr_password'];
$consulta = "Select * From gral_usuario where GRAL_USR_LOGIN='$usr_name' and GRAL_USR_CLAVE='$usr_password'";
$resultado = mysql_query($consulta) or die('No pudo seleccionarse tabla.');
$linea = mysql_fetch_array($resultado);
if (($usr_name == "super") && ($usr_password == $linea['GRAL_USR_CLAVE'])){
	   $_POST['nombres'] = $linea['GRAL_USR_NOMBRES'];
	   $_SESSION['nombres']=$_POST['nombres'];
	   $_SESSION['cargo']=$linea['GRAL_USR_CARGO'];
	   $msg = array('msg' => 'menu_s');
	   echo json_encode($msg);
	//   header('Location: menu_s.php');
}else{
	  if(($usr_name==$linea['GRAL_USR_LOGIN'])&&($usr_password==$linea['GRAL_USR_CLAVE'])){
			 $_POST['nombres'] = $linea['GRAL_USR_NOMBRES'];
			 $_SESSION['nombres']=$_POST['nombres'];
			 $_SESSION['login']=$_POST['usr_name'];
			 $_SESSION['cargo']=$linea['GRAL_USR_CARGO']; 
             $msg = array('msg' => 'menu_s');
	         echo json_encode($msg);
			// header('Location: menu_s.php');
			 // echo "Esta como cliente";
      }else{
	  	   $msg = array('msg' => 'no');
		   echo json_encode($msg);
			 //header('Location: index.php?error=1');
	//		 echo "Usuario Incorrecto <a href='index.php'>volver a intentar</a>";
			 //echo"Campos de texto blancos <a href='prac_comprar.php'>Probar que pasa!!</a>";
	  }
 }
ob_end_flush();
?>

