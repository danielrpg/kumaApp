<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
?>
<?php
switch( $_POST['accion'] ) {
      case "Salir":
	     unset ($_SESSION["tot_err"],$_SESSION["total_s"],$_SESSION["validar"],$_SESSION["$com_f"],
		 $_SESSION["cod_sol"]);
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		  //unset($_SESSION['form_buffer']);
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
		      require 'gral_man_usr_cm.php';
			 } 	  
		  if  ($_SESSION['cli_usr'] == 2) {
		      require 'cliente_man_cm.php';
			 } 
       break;
	    case "Marca-Recordatorio":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php');
	      require 'cliente_man_mar.php';
       break;
	   case "Consultar":
	   //   unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"], $_SESSION["$com_f"],$_SESSION["cod_sol"]); 
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'cliente_man_con.php';
       break;
	   case "Asignar":
	      //echo "Modificar- Grabar"; 
	      $_SESSION["validar"] = 0; 
		  $_SESSION["total_s"] = 0;
          $_SESSION["tot_err"] = 0;
		  require 'cred_montos_a.php';
       break;
	   case "Continuar":
	      if ($_SESSION['tip_comp'] == 2) {
		    // $_SESSION['continuar'] = 2 ;
		     require 'factura_ing.php';
			 } 
		  if ($_SESSION['c_estado'] == 1) {
		   //   $_SESSION['continuar'] = 2 ;
		  //    require 'cliente_con_s.php';
			  require 'factura_ing.php';
		  }
		  if ($_SESSION['c_estado'] == 3) {
		      $_SESSION['continuar'] = 2 ;
		      require 'cliente_con_s2.php';
		  }
		  if ($_SESSION['c_estado'] == 4) {
		      $_SESSION['continuar'] = 2 ;
		      require 'cred_plan_pag.php';
		  }
		  if ($_SESSION['c_estado'] == 5) {
		      $_SESSION['continuar'] = 2 ;
		      require 'cred_contrato.php';
			//require 'cred_ord_desem.php';
		  }
		   if ($_SESSION['c_estado'] == 6) {
		      $_SESSION['continuar'] = 2 ;
		      require 'cliente_con_s3.php';
		  }
		   if ($_SESSION['c_estado'] == 5) {
		      $_SESSION['continuar'] = 2 ;
		      require 'cred_contrato.php';
			//require 'cred_ord_desem.php';
		  }
		  if ($_SESSION['c_estado'] == 7) {
		      $_SESSION['continuar'] = 2 ;
		      require 'cred_est_desem.php';
		  }
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 
       break;
	  case "Seguir":
	      //echo "Modificar- Grabar"; 
	     $_SESSION['continuar'] = 1; 
		 require 'orden_mante_mod.php';
       break; 
	  case "Desembol-Prov":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'cja_des_prov.php';
       break; 
	  case "Desembolsar":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'cart_desem.php';
       break;  
	  case "Kardex":
	      // $_SESSION['continuar'] = 2 ;
		      require 'cli_imp_kar.php';
			  break; 
	   case "Fusionar":
	       $_SESSION['continuar'] = 1;
		      require 'cliente_fuc.php';
			  break; 		  
	  		   
}
?> 
<?php
ob_end_flush();
 ?>
