<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
?>
<?php
switch( $_POST['accion'] ) {
      case "Salir":
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		  require 'gral_man_usr.php';
	   break;
      case "Grabar":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'gral_grab_usr.php';
       break;
	    case "Modificar":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'gral_grab_usr_m.php';
       break;
}
?> 
<?php
ob_end_flush();
 ?>