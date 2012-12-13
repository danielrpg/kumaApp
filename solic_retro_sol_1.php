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
	    //    $_SESSION['continuar'] = 2 ;
		 //    require 'solic_consulta.php';
	       header('Location: cliente_con_grup.php');
	       break;
	   case "2":
	       header('Location: solic_man_cm2.php');
	      // require 'solic_man_cm2.php';
           break;
	   case "3":
	      //  unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"], $_SESSION["$com_f"],$_SESSION["cod_sol"]);
	       header('Location: solic_con_m.php');
	    //   require 'solic_con_m.php';
           break;
		case "4":
		   $_SESSION["continuar"] = 1;
	       header('Location: reg_credito.php');
	       break;   
      case "5":
	       unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"], $_SESSION["$com_f"],$_SESSION["cod_sol"]);
		   header('Location: menu_s.php');
	       break;
      case "5":
	       header('Location: solic_mante_aa.php');
	       break;
      case "10":
	    //    $_SESSION['continuar'] = 2 ;
		 //    require 'solic_consulta.php';
	       header('Location: tipo_rep.php');
	       break;

	}
?>
 <?php
ob_end_flush();
 ?>