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
      case "Grabar":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'gral_grab_cli.php';
       break;
	    case "Modificar":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 if  ($_SESSION['cli_usr'] == 1) {
		      require 'gral_grab_usr_m.php';
		   } 
		 if  ($_SESSION['cli_usr'] == 2) {
		      require 'gral_grab_cli_m.php';
		   }   
       break;
	    case "Kardex":
	      // $_SESSION['continuar'] = 2 ;
		      require 'cli_imp_kar.php';
			  break; 
		case "Fusionar":
	       $_SESSION['continuar'] = 2;
		      require 'cliente_fuc.php';
			  break;  	    
		case "Marcar":
	       $_SESSION['continuar'] = 2;
		      require 'cliente_marca.php';
			  break;   
}
?> 
<?php
ob_end_flush();
 ?>

