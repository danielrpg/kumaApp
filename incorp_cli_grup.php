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
		  unset($_SESSION['form_buffer']);
		  require 'menu_s.php';
	   break;
      case "Agregar-Cliente":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'grab_cli_grup.php';
       break;
	    case "Alta-Cliente":
		   $_SESSION['volver'] = 1;
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'cliente_mante_a.php';
       break;
	    case "Orden":
		   $_SESSION["continuar"] = 1; 
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'orden_mante_a.php';
       break;
	   case "Cobro":
	      //echo "Modificar- Grabar"; 
	      $_SESSION['continuar'] = 2;
		 require 'cobro_pag_det.php';
       break;
	   case "Cob_Directo":
	      //echo "Modificar- Grabar"; 
	      $_SESSION['continuar'] = 2;
		 require 'cobro_pag_det.php';
       break;
	    case "Kardex":
	      //echo "Modificar- Grabar"; 
	      $_SESSION['continuar'] = 2;
		 require 'cli_imp_kar.php';
       break;
	     case "Detalle":
	      //echo "Modificar- Grabar"; 
	      $_SESSION['continuar'] = 1;
		 require 'crono_alta.php';
       break;
}     
?> 
<?php
ob_end_flush();
 ?>
