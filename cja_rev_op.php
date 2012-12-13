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
	    // $_SESSION["recal"] = 1;
		 header('Location: cja_rev_des.php');
	   break;
      case "2":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: cja_rev_cob.php');
       break;
	   case "3":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: cja_rev_bco.php');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		// header('Location: cart_rep_det.php');
		header('Location: cja_rev_fga.php');
       break;
	   case "5":
	     $_SESSION["tipo_rep"] = 2;
	     //  require('garl_grab_fec.php');
		 header('Location: cja_rev_cove.php');
       break;
	   case "6":
	     $_SESSION["tipo_rep"] = 3;
	     //  require('garl_grab_fec.php');
		 header('Location: cja_rev_val.php');
       break;
	   case "7":
	     $_SESSION["tipo_rep"] = 7;
	     //  require('garl_grab_fec.php');
		 header('Location: cja_rev_ineg.php');
       break;
	   case "8":
	      //echo "Retroceder";
	     $_SESSION["reimpre"] = 1;
		 $_SESSION["detalle"] = 1;
		 header('Location: cja_rimp_par.php');
	   break;
      case "9":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: cja_rev_cob.php');
       break;
	   case "10":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: cja_rev_bco.php');
       break;
	   case "11":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		// header('Location: cart_rep_det.php');
		header('Location: cja_rev_fga.php');
       break;
	   case "12":
	     $_SESSION["tipo_rep"] = 2;
	     //  require('garl_grab_fec.php');
		 header('Location: cja_rev_cove.php');
       break;
	   case "13":
	     $_SESSION["tipo_rep"] = 3;
	     //  require('garl_grab_fec.php');
		 header('Location: cja_rev_val.php');
       break;
	   case "14":
	     $_SESSION["tipo_rep"] = 7;
	     //  require('garl_grab_fec.php');
		 header('Location: cja_rev_ineg.php');
       break;
}
?> 
<?php
ob_end_flush();
 ?>