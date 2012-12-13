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
		  require 'cja_bancos.php';
	   break;
      case "Aplicar":
	     $_SESSION['detalle'] = 2 ;
		 require 'bco_dep_ret.php';
	   //  header('Location: reg_egresos.php');
	    //   require 'solic_con_m.php';
           break;
	  case "Grab_vale":
	      require 'cja_val_grab.php';
	      break;	   
	  case "Recalcular":
	     $_SESSION['detalle'] = 4;
		 //$_SESSION['t_fac_fis'] = 10;
		
		 require 'reg_egresos.php';
	   //  header('Location: reg_egresos.php');
	    //   require 'solic_con_m.php';
           break;	   
	    case "Imprimir":
	      $_SESSION['detalle'] = 3 ;
		 require 'reg_egre_grab.php';
		 
       break;
	   case "Calcular":
	     $_SESSION['detalle'] = 4;
		 //$_SESSION['t_fac_fis'] = 10;
		
		 require 'reg_com_ven.php';
	   case "Recibo":
	      $_SESSION['detalle'] = 3 ;
		 require 'banco_grab.php';
		 
       break;
}
?> 
<?php
ob_end_flush();
 ?>