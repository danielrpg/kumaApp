<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    //require('funciones.php');
?>
<?php
switch( $_GET['accion'] ) {
       case "1":
	     $_SESSION['detalle'] = 1 ;
		 $_SESSION['continuar'] = 1 ;
	     $_SESSION['egre_bs_sus'] = 1 ;
		 //    require 'solic_consulta.php';
	       header('Location: reg_egresos.php');
	       break;
	   case "2":
	    $_SESSION['continuar'] = 1 ;
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['egre_bs_sus'] = 2 ;
	       header('Location: reg_egresos.php');
	      // require 'solic_man_cm2.php';
           break;
	   case "3":
         $_SESSION['detalle'] = 2 ;
		 $_SESSION['egre_bs_sus'] = 1 ;
	     header('Location: reg_egresos.php');
	    //   require 'solic_con_m.php';
           break;
      case "4":
	       unset ($_SESSION['egre_bs_sus']);
		   $_SESSION['egre_bs_sus'] = 2 ;
		   header('Location: menu_s.php');
	       break;
      case "5":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['c_com_ven'] = 1 ;
		 //    require 'solic_consulta.php';
	       header('Location: reg_com_ven.php');
	       break;
      case "6":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['c_com_ven'] = 2 ;
		 //    require 'solic_consulta.php';
	       header('Location: reg_com_ven.php');
	       break;
	  case "7":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['egre_bs_sus'] = 1 ;
		 //    require 'solic_consulta.php';
	       header('Location: reg_ingresos.php');
	       break;
	   case "8":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['egre_bs_sus'] = 2 ;
	       header('Location: reg_ingresos.php');
	      // require 'solic_man_cm2.php';
           break;
	    case "9":
	       //unset ($_SESSION['egre_bs_sus']);
		   //$_SESSION['egre_bs_sus'] = 2 ;
		   header('Location: menu_s.php');
	       break;	
		case "10":
	         $_SESSION['detalle'] = 1 ;
	         $_SESSION['b_dep_ret'] = 1;
		     $_SESSION['bco_bs_sus'] = 1;
		     header('Location: bco_dep_ret.php');
	         break;
	  case "11":
	         $_SESSION['detalle'] = 1 ;
	         $_SESSION['b_dep_ret'] = 1;
		     $_SESSION['bco_bs_sus'] = 2;
		     header('Location: bco_dep_ret.php');
	         break;
	   case "12":
	         $_SESSION['detalle'] = 1 ;
	         $_SESSION['b_dep_ret'] = 2;
		     $_SESSION['bco_bs_sus'] = 1;
		     header('Location: bco_dep_ret.php');
	         break;
	    case "13":
	         $_SESSION['detalle'] = 1 ;
	         $_SESSION['b_dep_ret'] = 2;
		     $_SESSION['bco_bs_sus'] = 2;
		     header('Location: bco_dep_ret.php');
	         break;	  
		 case "14":
	         $_SESSION['detalle'] = 1 ;
	       //  $_SESSION['b_dep_ret'] = 2;
		       $_SESSION['egre_bs_sus'] = 1;
		       header('Location: reg_ingr_egre.php');
	         break;	    
	}
?>
 <?php
ob_end_flush();
 ?>