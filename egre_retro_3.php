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
		  require 'egre_mante.php';
	   break;
      case "Grabar":
	     $_SESSION['detalle'] = 2 ;
		 require 'reg_ingresos.php';
	   //  header('Location: reg_egresos.php');
	    //   require 'solic_con_m.php';
           break;
	   case "Detalle":
	     $_SESSION['continuar'] = 1;
	     $_SESSION['detalle'] = 2 ;
		 require 'reg_ingresos.php';
	  
           break;
		 case "Transacciones":
	     $_SESSION['continuar'] = 1;
	     $_SESSION['detalle'] = 2 ;
		 require 'reg_ingr_egre.php';
	  
           break;   
	   	case "Detalle_Ing":
	     $_SESSION['continuar'] = 1;
	     $_SESSION['detalle'] = 2 ;
		 require 'reg_ingresos.php';
	  
           break;   
	  case "A�adir":
	     $_SESSION['detalle'] = 3 ;
		 require 'reg_ingresos.php';
	             break; 
	 case "Agregar":
	      $_SESSION['eliminar'] = 0;
	     $_SESSION['detalle'] = 3 ;
		 require 'reg_ingr_egre.php';
	             break; 
	 case "Ingresar":
	     $_SESSION['eliminar'] = 0; 
	     $_SESSION['detalle'] = 4 ;
		 require 'reg_ingr_egre.php';
	             break;			 			 
	 case "Mod_Monto":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 2;
		   $_SESSION['continuar'] = 2;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'reg_ingresos.php';
	       break; 			 	   
	  case "Grab_Ingresos":
	      require 'reg_ingr_grab.php';
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
		 require 'reg_ing_grab.php';
		 
       break;
	   case "Calcular":
	     $_SESSION['detalle'] = 4;
		 //$_SESSION['t_fac_fis'] = 10;
		
		 require 'reg_com_ven.php';
	   case "Recibo":
	      $_SESSION['detalle'] = 3 ;
		 require 'com_ven_grab.php';
		 
       break;
	   case "Grab_mod":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	        $_SESSION['detalle'] = 2;
		   $_SESSION['continuar'] = 2;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['grab_mod'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'reg_ingresos.php';
	       break; 
		case "Eliminar":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 2;
		   $_SESSION['continuar'] = 2;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'reg_ingresos.php';
	       break; 
		case "Grab_Planilla":
		   $_SESSION['eliminar'] = 0;
	      require 'reg_planilla.php';
	      break;
		case "Grab_Egresos":
		 $_SESSION['eliminar'] = 0;
	     $_SESSION['detalle'] = 5 ;
		 echo "aqui";
		 require 'reg_ingr_egre.php';
	             break;	
		case "Eliminar_Ingreso":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 2;
		   $_SESSION['continuar'] = 2;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'reg_ingr_egre.php';
	       break; 	
		 case "Eliminar_Credito":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 2;
		   $_SESSION['continuar'] = 2;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 3;
		   $_SESSION['prov'] = 0;
		   require 'reg_ingr_egre.php';
	       break; 
		  case "Eliminar_Egresos":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 2;
		   $_SESSION['continuar'] = 2;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 2;
		   $_SESSION['prov'] = 0;
		   require 'reg_ingr_egre.php';
	       break; 		  	 		    
}
?> 
<?php
ob_end_flush();
 ?>