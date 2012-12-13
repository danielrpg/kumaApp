<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
?>
<?php
switch( $_POST['accion'] ) {
      case "Salir":
	       require 'menu_s.php';
	       break;
      case "Grabar":
	       require 'grab_sal_cja.php';
           break;
	  case "Detalle":
	       require 'cja_det_rev.php';
           break;
	  case "Revertir":
	       require 'cja_des_rev.php';
           break;
	  case "Det-cobro":
	       require 'cja_det_revc.php';
           break;
	  case "Rev-Cobro":
	       require 'cja_cob_rev.php';
           break;
	   case "Det-Bco":
	       require 'cja_det_bco.php';
           break;
	   case "Rev-Bco":
	       require 'cja_bco_rev.php';
           break;
	   case "Det-tran":
	       require 'cja_det_fga.php';
           break;
	   	case "Rev-Transac":
	       require 'cja_fga_rev.php';
           break;  
		case "Det-ComVen":
	       require 'cja_det_cove.php';
           break; 
		 case "Rev-ComVen":
	       require 'cja_cove_rev.php';
           break; 
		 case "Rev-IngEgr":
	       require 'cja_ineg_rev.php';
           break;   
		case "Det-IngEgr":
	       require 'cja_det_ineg.php';
           break; 
		case "Det-Val":
	       require 'cja_det_val.php';
           break;
		case "Rev-Val":
	       require 'cja_val_rev.php';
           break;
        case "Reimpresion":
	       require 'car_rimp_des.php';
           break;
    }
?> 
<?php
ob_end_flush();
 ?>