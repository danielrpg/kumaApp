<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	 $_SESSION["error"] = "";

switch( $_GET['accion'] ) {
      case "1":
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		// unset($_SESSION['form_buffer']);
		  header('Location: gral_man_usr_a.php');
	   break;
      case "2":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: gral_man_usr_c.php');
       break;
	   case "3":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
//		 unset($_SESSION['form_buffer']);
		 header('Location: gral_man_usr_m.php');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
//		unset($_SESSION['form_buffer']);  
		 header('Location: menu_s.php');
       break;
}
?> 
<?php
ob_end_flush();
 ?>