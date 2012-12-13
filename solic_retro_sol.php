<?php
 ob_start();
   if (!isset ($_SESSION)){
	   session_start();
	}
	require('configuracion.php');
    //require('funciones.php');
?>
<?php
switch( $_POST['accion'] ) {
      case "Salir":
	       unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"],$_SESSION["cod_sol"]);
		  // unset($_SESSION['form_buffer']);
		   require 'menu_s.php';
	       break;
      case "Clientes":
	       require 'cliente_con_m_sol.php';
           break;
	  case "Anterior":
	       $_SESSION['dia'] = 2;
	       require 'crono_diario.php';
           break;
	  case "Siguiente":
	       $_SESSION['dia'] = 3;
	       require 'crono_diario.php';
           break;
	  case "Hoy":
	       $_SESSION['dia'] = 4;
	       require 'crono_diario.php';
           break;
	  
	   case "Calculo":
	       $_SESSION["continuar"] = 2; 
	       require 'orden_mante_a.php';
		   break; 
	   	case "Grab-Modi":
	       $_SESSION["continuar"] = 2; 
	       require 'orden_mante_mod.php';
		   break;    
	  case "Consultar":
	   unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"], $_SESSION["$com_f"],$_SESSION["cod_sol"]);
	       require 'solic_con_m.php';
           break;
	  case "Graba-Fac":
	       $_SESSION['continuar'] = 2;
		   require 'factura_ing.php';
           break;
	  case "Graba-Complemento":
	       $_SESSION['continuar'] = 3;
		   require 'factura_ing.php';
           break;	   
	  case "Registrar Cambios":
	        $_SESSION['continuar'] = 2 ;
	       require 'grab_sol_com_m.php';
           break;
	  case "Siguiente Paso":
		   $_SESSION['continuar'] = 1 ;
	       if ($_SESSION['cod_tipo'] == 1) {
              require 'cliente_con_s2.php';
	          break;
			  }
           if ($_SESSION['cod_tipo'] == 2) {
              require 'cliente_con_s2.php';
	          break;
			  }
	       if ($_SESSION['cod_tipo'] == 3) {
              require 'cliente_con_s2.php';
	          break;
			  }
	     case "Elegir Otro Grupo":
	     	  $_SESSION["continuar"] = 1; 
	    	  require 'grupo_con_m_sol.php';
		 case "Siguiente-Paso":
		     require 'cred_val_m.php';
              break;
		 case "Plan de Pagos":
		      require 'cred_plan_pag.php';
              break;
	     case "Plan_Pag_Completo":
		      $_SESSION['continuar'] = 1;
		      require 'cred_grab_plan_p.php';
              break;
		 case "Contrato":	  
		      $_SESSION['continuar'] = 1 ;
		      require 'cred_contrato.php'; 	  
		      break;
	     case "Impresion Contrato":
		      $cod_sol = $_SESSION['nro_sol'];
			  $act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=6 where CRED_SOL_CODIGO = $cod_sol and                                  CRED_SOL_USR_BAJA is null";
              $res_act_s = mysql_query($act_cred_solic) or die('No pudo actualizar cred_solicitud : ' . mysql_error());
		      require 'cred_imp_cont1.php';
              break;
	       case "REFRESCAR":
			  $_SESSION['dia'] = 5;
	       require 'crono_diario.php';
           break; 
	       case "IR A FECHA":
			  $_SESSION['dia'] = 6;
	       require 'crono_diario.php';
           break; 
			  
		 case "G R A B A R":
			  require 'crono_graba.php';
              break;
		case "Grabar":
			  require 'imp_orden.php';
              break; 	  
		 case "Impr_mod":
			  require 'imp_orden_mod.php';
              break;	  
		case "Registrar Acople":
	        $_SESSION['continuar'] = 2 ;
	       require 'grab_sol_adi.php';
           break;
		case "Consulta Cliente":
	        $_SESSION['continuar'] = 2 ;
	       require 'cliente_con_c.php';
           break;   
		 case "Graba-Credito":
		  $_SESSION["detalle"] =0;  
	       $_SESSION['continuar'] = 2;
		   require 'reg_credito.php';
           break;   
	}
?>  
<?php
ob_end_flush();
 ?>