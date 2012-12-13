<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
?>
<?php
switch( $_POST['accion'] ) {
      case "Salir":
	       require 'con_mante.php';
	       break;
      case "Adicionar":
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 2;
		   require 'con_asiento.php';
	       break;
	  case "Grabar":
	      // echo "aqui detalle 34";
	       $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'con_asiento.php';
	       break;
	  case "Imprimir":
    	   require 'con_asin_grab.php';
	       break;
	  case "Contabilizar":
		   require 'con_ciedia_grab.php';
		   break;
	 case "Procesar":
	       $_SESSION['continuar'] = 2;
		  // $_SESSION['detalle'] = 3;
		   require 'con_mayor.php';
		   break; 	
	case "Generar":
	       $_SESSION['continuar'] = 2;
		  // $_SESSION['detalle'] = 3;
		   require 'con_diario.php';
		   break;	      
	   case "Modificar":
	      // echo "aqui detalle 34";
	       $_SESSION['continuar'] = 4;
	      // $_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'con_asiento.php';
	       break;
	   case "Recibo":
	      $_SESSION['detalle'] = 3 ;
		 require 'com_ven_grab.php';
		 
       break;
	   case "Grab_modi":
	      // echo "aqui detalle 5 Grab_modi";
	       $_SESSION['continuar'] = 5;
	       //$_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'con_asiento.php';
	       break;
	   case "Añadir":
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 2;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['prov'] = 0;
		   require 'cja_fin_saldo.php';
	       break;
	   case "Eliminar":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'cja_fin_saldo.php';
	       break; 
		case "Mod_cant":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'cja_fin_saldo.php';
	       break; 
		 case "Grab_mod":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['grab_mod'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'cja_fin_saldo.php';
	       break;  
		  case "Grab_cortes":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 0;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['grab_mod'] = 0;
		   $_SESSION['grab_def_prov'] = 2;
		   $_SESSION['prov'] = 0;
		   require 'cortes_grab.php';
	       break;  
		   case "Otra_transac":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 0;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['grab_mod'] = 1;
		   $_SESSION['grab_def_prov'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'cortes_grab.php';
	       break; 
		    case "Corriga":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	        $_SESSION['detalle'] = 1 ;
		 $_SESSION['continuar'] = 1;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['grab_mod'] = 0;
		   $_SESSION['grab_def_prov'] = 0;
		   $_SESSION['prov'] = 0;
		   $_SESSION['caja_bs_sus'] = $_SESSION['caja_bs_sus'];
		   require 'cja_fin_saldo.php';
	       break;  
		 case "Consulta":
	       require 'consulta_asi.php';
	       break;      
		 case "Impreso":
	       require 'imprimir_asi.php';
	       break; 
		  case "Imp_Mayor":
	       require 'imprimir_may.php';
	       break; 
		    case "Imp_Diario":
	       require 'imprimir_dia.php';
	       break;             
}
?> 
<?php
ob_end_flush();
 ?>