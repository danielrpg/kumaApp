<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
?>
<?php
$_SESSION['error'] = "";
$r = 0;
$cuantos = 0;
$log_usr = $_SESSION['login']; 
$agen = $_POST["cod_agencia"];
$agen = 30;
$tper = $_POST["tip_per"];
$c_i = $_POST["ci"];
$nom = $_POST["nombres"];
$nom = strtoupper($nom);
$a_pat = $_POST["ap_pater"];
$a_pat = strtoupper($a_pat);
$barr = $_POST["barrio"];
$barr = strtoupper($barr);
if(isset($_POST["ap_mater"])){ 
   $a_mat = $_POST["ap_mater"]; 
   $a_mat = strtoupper ($a_mat);
   }else{
   $a_mat = "nela ";
   }
if(isset($_POST["ap_espos"])){ 
  $a_esp = $_POST["ap_espos"]; 
  $a_esp = strtoupper ($a_esp);
  }else{
   $a_esp = "nela ";
   }
$fec_nac = $_POST['fec_nac']; 
$f_nac = cambiaf_a_mysql($fec_nac);
$dir = $_POST["direc"];
$dir = strtoupper ($dir);
//$barr = $_POST["cod_barr"]; 


if(isset($_POST["fono"])){ 
   $fon = $_POST["fono"];
   }else{
   $fon = 999;
   }

 if(isset($_POST["celu"])){ 
   $cel = $_POST["celu"]; 
   }else{
   $cel = 999;
   }   
if(isset($_POST["email"])){ 
   $e_m = $_POST["email"];
    }else{
	$e_m = "nela";
	}

$r = "";  
$nro = leer_nro_cliente();
$n = strlen($nro);
$n2 = 4 - $n;
for ($i = 1; $i <= $n2; $i++) {
    $r = $r."0";
    }  
$ccli = $agen.$r.$nro;
if(isset($a_mat)){
   }else{ 
   $a_mat = "";
  }
if(isset($a_esp)){ 
   }else{ 
   $a_esp = "";
   }
if(isset($f_tr)){ 
   }else{ 
   $f_tr = 0;
  }
 if($fon == ""){
    $fon = 0;}   
//if(isset($fon)){ 
  // }else{ 
 //  $fon = 0;
 // }
 if($cel == ""){
    $cel = 0;}  
/*if(isset($cel)){ 
   }else{ 
   $cel = 0;
  }*/ 
if(isset($e_m)){ 
   }else{ 
   $e_m = "";
  } 
 if(isset($ae_dos)){ 
   }else{ 
   $ae_dos = "";
  }  
  
  
  
  if(isset($f_tr)){ 
   }else{ 
   $f_tr = "";
  }
  
//  if($f_ref == ""){
 //   $f_ref = 0;} 
  /*if(isset($f_ref)){
   }else{
   $f_ref = 0;
  }*/
 if(isset($n_con )){ 
   }else{ 
   $n_con  = "";
  } 
   if(isset($c_con )){ 
   }else{ 
   $c_con  = "";
  } 
   if(isset($_POST["recor"])){
      $recor= 1; 
	  }else{
	   $recor= 0;
	  }   
//echo $ccli."ccli".$nro."nro".$tper."tper".$tdoc."tdoc".$c_i."c_i".$nom."nom".$a_pat."a_pat".
//    $a_mat."a_mat".$a_esp,"a_esp".$f_nac.$l_nac."l_nac".$csex."csex".$cciv."cciv".$d_tr."d_tr".
//	$z_tr."z_tr".$f_tr."f_tr".$a_tr."a_tr".$t_viv."t_viv".$cciiu."cciuu".$dir."dir".$zon."zon".
//	$fon."fon".$cel."cel".$e_m."e_m".$ae_uno."ae_uno".$ae_dos."ae_dos".$agen."agen".$cint."cint".
//	$n_con."n_con".$c_con."c_con".$n_ref."n_ref".$d_ref."d_ref".$f_ref."f_ref".$log_usr."log_usr";
$cuantos = (validar_cliente($nom,$a_pat,$a_mat,$tper));
if ($cuantos > 0){
    echo $_SESSION['cli_exis']." ".$cuantos;
	header('Location: cliente_con_dup.php');
//header('Location: cliente_mante_a.php');
//      $_SESSION['error'] = "Documento de identificacion ya existe".encadenar(2).$c_i;
   echo "Cliente ya existe <a href='cliente_mante_a.php'>volver a Intentar</a><br>";
//  return;
}else{

    $consulta  = "Insert into cliente_general (CLIENTE_COD,
	                                           CLIENTE_NUMERICO,
	                                           CLIENTE_COD_ANT,
											   CLIENTE_TIP_PER,
                                               CLIENTE_COD_ID,
											   CLIENTE_NOMBRES,
											   CLIENTE_AP_PATERNO,
											   CLIENTE_AP_MATERNO,
											   CLIENTE_AP_ESPOSO,
											   CLIENTE_FCH_NAC,
											   CLIENTE_VIVIEN,
                                               CLIENTE_DIRECCION,
											   CLIENTE_ZONA,
											   CLIENTE_FONO,
											   CLIENTE_CELULAR,
											   CLIENTE_EMAIL,
											   CLIENTE_AGENCIA,
								   			   CLIENTE_USR_ALTA,
											   CLIENTE_FCH_HR_ALTA,
											   CLIENTE_USR_BAJA,
											   CLIENTE_FCH_HR_BAJA) values
											   ($ccli,
											    $nro,
											    null,
											    $tper,
											    '$c_i',
											    '$nom',
											    '$a_pat',
											    '$a_mat',
											    '$a_esp',
												'$f_nac',
												$recor,
											    '$dir', 
											    '$barr ',
											    $fon,
											    $cel,
											    '$e_m',
												30,
											    '$log_usr',
											     null,
											     null,
											     '0000-00-00 00:00:00')";

$resultado = mysql_query($consulta)or die('No pudo insertar : ' . mysql_error());
//if ($_SESSION['volver'] == 1){
  $_SESSION["continuar"] = 1; 
  $_SESSION['cod_cli'] =  $ccli;
//header('Location: orden_mante_a.php');
//}else{
echo $cuantos; 
 header('Location: cliente_mante.php');

}
?>
<?php
ob_end_flush();
 ?>