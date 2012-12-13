<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
?>
<?php
switch( $_GET['accion'] ) {
      case "1":
	      //echo "Retroceder";
	     $_SESSION["tipo_rep"] = 1;
		 header('Location: rep_param.php');
	   break;
      case "2":
	     // echo "Grabar"; 
	      $_SESSION["tipo_rep"] = 2;
		  header('Location: rep_param.php');
       break;
	   case "3":
	     // echo "Grabar"; 
	      $_SESSION["tipo_rep"] = 3;
		  header('Location: rep_param.php');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 $_SESSION["tipo_rep"] = 4;
		  header('Location: rep_param.php');
       break;
	   case "5":
	     $_SESSION["tipo_rep"] = 5;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param.php');
       break;
	   case "6":
	     $_SESSION["tipo_rep"] = 3;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param.php');
       break;
}
?> 
<?php
ob_end_flush();
 ?>