<?php
ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
require('configuracion.php');
require('funciones.php');
if(!isset($_POST['login']))
{
	$_SESSION['user']= "NO ESTAS LOGUEADO";
	// AQUI SEGUIRIA EL FORMULARIO
}
else
{
	if($_POST['login'] != "" && $_POST['clave']!=""){
	   $_SESSION['login']=$_POST['login'];
	   $_SESSION['clave']=$_POST['clave'];
	   $log = $_POST['login'];
	   $pass = $_POST['clave'];
	   // Se realiza una consulta SQL a tabla cliente
	   $consulta = "Select * From gral_usuario where GRAL_USR_LOGIN='$log' and GRAL_USR_CLAVE='$pass'";
	   $resultado = mysql_query($consulta) or die('No pudo seleccionarse tabla.');
	   $linea = mysql_fetch_array($resultado)or die('No pudo leer registro') ;
   if (($_POST['login'] == "super") && ($_POST['clave'] == $linea['GRAL_USR_CLAVE'])){
		   $_POST['nombres'] = $linea['GRAL_USR_NOMBRES'];
		   $_SESSION['nombres']=$_POST['nombres'];
		    $_SESSION['cargo']=$linea['GRAL_USR_CARGO'];
		   header('Location: menu_s.php');
		  }else{
	  if(($_POST['login']==$linea['GRAL_USR_LOGIN'])&&($_POST['clave']==$linea['GRAL_USR_CLAVE'])){
			 $_POST['nombres'] = $linea['GRAL_USR_NOMBRES'];
			 $_SESSION['nombres']=$_POST['nombres'];
			 $_SESSION['login']=$_POST['login'];
			 $_SESSION['cargo']=$linea['GRAL_USR_CARGO']; 
			 header('Location: menu_s.php');
			 // echo "Esta como cliente";
		 }else{
			 header('Location: index.php?error=1');
	//		 echo "Usuario Incorrecto <a href='index.php'>volver a intentar</a>";
			 //echo"Campos de texto blancos <a href='prac_comprar.php'>Probar que pasa!!</a>";
	     }
  	   }
   }else{
   		header('Location: index.php?error=1');
//	   echo "Usuario Incorrecto <a href='index.php'>volver a intentar</a>";
	   //echo"Campos de texto blancos <a href='prac_comprar.php'>Probar que pasa!!</a>";
   }
}
ob_end_flush();
?>

