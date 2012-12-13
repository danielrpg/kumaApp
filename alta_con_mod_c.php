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
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		 header('Location: cliente_mante_a.php');
	   break;
      case "2":
	     // echo "Grabar"; 
	    $_SESSION['con_mod'] = 1;
		 header('Location: cliente_con_mod.php');
       break;
	   case "3":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 $_SESSION['con_mod'] = 2;
		 header('Location: cliente_con_mod.php');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		
		 header('Location: menu_s.php');
       break;
	   case "5":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 $_SESSION['con_mod'] = 4;
		 header('Location: cliente_con_fuc.php');
       break;
	   case "6":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 $_SESSION['con_mod'] = 6;
		 header('Location: cliente_con_mod.php');
       break;
}
?> 
<?php
ob_end_flush();
 ?>

