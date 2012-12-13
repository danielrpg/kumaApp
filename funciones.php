<?php
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
?>
<?php
function leer_param_gral()
{
 ?>
 <b>Usuario:  </b>
 <?php
  echo $_SESSION['nombres'];
  $log = $_SESSION['login']; 
  ?> 
  <b> Oficina:  </b> 
  <?php
   echo leer_agencia_usr ($log);
   ?>
   <b> Fecha Proceso:  </b>
   <?php
   $ag_usr = $_SESSION['COD_AGENCIA'];
	$fecha = leer_fecha_proc($ag_usr);
	$_SESSION['fec_proc'] = $fecha;
	$tc_cont = leer_tipo_cam();
	echo $fecha. encadenar(35)."TC Contable ".number_format($_SESSION['TC_CONTAB'], 2, '.',',');     
	return $fecha;
}	
   ?>
<?php
function leer_agencia_usr ($usr) 
{
$consulta  = "Select GRAL_AGENCIA_NOMBRE, gral_agencia.GRAL_AGENCIA_CODIGO From gral_agencia, gral_usuario where GRAL_USR_LOGIN = '$usr' and gral_agencia.GRAL_AGENCIA_CODIGO = gral_usuario.GRAL_AGENCIA_CODIGO";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
   $_SESSION['COD_AGENCIA']=$linea['GRAL_AGENCIA_CODIGO'];
   return $linea['GRAL_AGENCIA_NOMBRE'];
}
?> 
<?php
function leer_nombre_usr($tcre,$usr) 
{
if($tcre == 1) {
   $consulta  = "Select GRAL_USR_NOMBRES From gral_usuario
                where GRAL_USR_LOGIN = '$usr'";
}
if($tcre == 2) {
   $consulta  = "Select GRAL_USR_NOMBRES From gral_usuario
                where GRAL_USR_CODIGO = $usr";
}			
	  
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
    return $linea['GRAL_USR_NOMBRES'];
}
?> 
<?php
function leer_fecha_proc($ag_u) 
{
  $consulta  = "SELECT GRAL_CTRL_FECHA_ACT FROM gral_control_fecha 
                ORDER BY GRAL_CTRL_FECHA_ACT DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
    $f_proc = $linea['GRAL_CTRL_FECHA_ACT'];
//	$dia_l = leer_dia($f_proc);
	//echo $dia_l;
	$f_procc = cambiaf_a_normal($f_proc);
    return $f_procc;
}
?> 
<?php
function cambiaf_a_normal($f_proc){
   //echo $f_proc;
   $anio =  substr($f_proc, 0,4);
   $mes = substr($f_proc, 5,2);
   $dia = substr($f_proc, -2);
   $lafecha=$dia."/".$mes."/".$anio; 
  /* if ( ereg( "([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $f_proc, $regs ) ) {
   $f_norm = "$regs[3]/$regs[2]/$regs[1]";
   return $f_norm;
   //echo "$regs[3]/$regs[2]/$regs[1]";
  } else {
    echo "Formato de fecha no valido: $date";
}
*/
   // ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $f_proc, $mifecha); 
  //  $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 
?> 
<?php
function cambiaf_a_normal_2($f_proc){
   //echo $f_proc;
   $anio =  substr($f_proc, 0,4);
   $mes = substr($f_proc, 5,2);
   $dia = substr($f_proc, -2);
   $lafecha=$dia."-".$mes."-".$anio; 
  /* if ( ereg( "([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $f_proc, $regs ) ) {
   $f_norm = "$regs[3]/$regs[2]/$regs[1]";
   return $f_norm;
   //echo "$regs[3]/$regs[2]/$regs[1]";
  } else {
    echo "Formato de fecha no valido: $date";
}
*/
   // ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $f_proc, $mifecha); 
  //  $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Convierte fecha de normal a mysql 
//////////////////////////////////////////////////// 
function cambiaf_a_mysql($fecha){ 
   $anio =  substr($fecha, -4);
   $mes = substr($fecha, 3,2);
   $dia = substr($fecha, 0,2);
   $lafecha=$anio."-".$mes."-".$dia; 
   /* ereg( "([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
	 */
    return $lafecha; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Convierte fecha de normal a mysql 
//////////////////////////////////////////////////// 
function cambiaf_a_mysql_2($fecha){
   $anio =  substr($fecha, -4);
   $mes = substr($fecha, 3,2);
   $dia = substr($fecha, 0,2);
   $lafecha=$anio."-".$mes."-".$dia; 
/*    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
	*/ 
    return $lafecha; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Convierte fecha de normal a mysql con guiones
//////////////////////////////////////////////////// 
function cambiaf_a_mysql2($fecha){ 
    ereg( "([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
    return $lafecha; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Separa el mes
//////////////////////////////////////////////////// 
function saca_mes($fec){ 
    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fec, $mifecha); 
    $elmes=$mifecha[2]; 
    return $elmes; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Separa el dia
//////////////////////////////////////////////////// 
function saca_dia($fec){ 
    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fec, $mifecha); 
    $eldia=$mifecha[1]; 
    return $eldia; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Separa anio
//////////////////////////////////////////////////// 
function saca_anio($fec){ 
    ereg( "([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})", $fec, $mifecha); 
    $elanio=$mifecha[3]; 
    return $elanio; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Separa el mes 2
//////////////////////////////////////////////////// 
function saca_mes_2($fec){ 
    ereg( "([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})", $fec, $mifecha); 
    $elmes=$mifecha[2]; 
    return $elmes; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Separa el dia 2
//////////////////////////////////////////////////// 
function saca_dia_2($fec){ 
    ereg( "([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})", $fec, $mifecha); 
    $eldia=$mifecha[1]; 
    return $eldia; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Separa anio 2
//////////////////////////////////////////////////// 
function saca_anio_2($fec){ 
    ereg( "([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})", $fec, $mifecha); 
    $elanio=$mifecha[3]; 
    return $elanio; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Valida fecha normal separada por -   
//////////////////////////////////////////////////// 
function valida_fecha($fecha){ 
 $mes = saca_mes($fecha);
 $dia = saca_dia($fecha);
 $anio = saca_anio($fecha);
 if (checkdate($mes,$dia,$anio)) {
   	return true;
    } else {
	 msgError(__FILE__,__LINE__, "Fecha Incorrecta!!!");
    return false;
    }
} 
?><?php
//////////////////////////////////////////////////// 
//Valida fecha normal separada por /  
//////////////////////////////////////////////////// 
function valida_fecha_2($fecha){ 
 $mes = saca_mes_2($fecha);
 $dia = saca_dia_2($fecha);
 $anio = saca_anio_2($fecha);
 if (checkdate($mes,$dia,$anio)) {
   	return true;
    } else {
	 msgError(__FILE__,__LINE__, "Fecha Incorrecta!!!");
    return false;
    }
} 
?>

<?php
	function msgError($file, $line, $message) {
		echo "<b>ERROR</b><br>";
		echo "<b>Archivo:</b> $file<br>";
		echo "<b>Linea:</b> $line<br>";
		echo "<b>Mensaje:</b> $message";
	}
?>
<?php
	function msgError2($message) {
			echo "<b>Mensaje:</b> $message<br><br>";
	}
?>
<?php
function leer_nro_cliente() 
{
$consulta  = "SELECT CLIENTE_NUMERICO FROM cliente_general where CLIENTE_USR_BAJA is null ORDER BY CLIENTE_NUMERICO DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
$nro_cliente = $linea['CLIENTE_NUMERICO'];
if ($nro_cliente == 0) {
   	$nro_cliente = $nro_cliente + 1;
	} else {
	$nro_cliente = $linea['CLIENTE_NUMERICO'] + 1;
	}
   return $nro_cliente; 
}
?> 	
<?php
function validar_usuario($loginn)
{
$con_usr = "Select * From gral_usuario where GRAL_USR_LOGIN = '$loginn' and GRAL_USR_USR_BAJA is null";
$res_usr = mysql_query($con_usr)or die('No pudo seleccionarse tabla 1');
$linea = mysql_fetch_array($res_usr);
$log_con = $linea[GRAL_USR_LOGIN];
if (empty($log_con)) {
   return false;
   }else{
   return true;
	}
}
?>
<?php
function validar_cliente($nom,$a_pat,$a_mat,$tper)
{
$cli_con = 0; 
$_SESSION['cli_exis'] = 0;
//echo $nom, $a_pat,$a_mat;
if ($tper == 1){
    $con_cli = "Select * From cliente_general where CLIENTE_NOMBRES = '$nom'                                                and CLIENTE_AP_PATERNO = '$a_pat'
		   									    and CLIENTE_AP_MATERNO = '$a_mat'
											    and CLIENTE_USR_BAJA is null";
    $res_cli = mysql_query($con_cli)or die('No pudo seleccionarse tabla 1');
	while ($linea = mysql_fetch_array($res_cli)) {
	      $_SESSION['cli_exis'] = $linea['CLIENTE_COD'];
   // $linea = mysql_fetch_array($res_cli);
    $cli_con = $cli_con + 1;
	 } 
    if ($cli_con == 0) {
       return false;
       }else{
       return true;
   	}
}
if ($tper == 2){
    $con_cli = "Select * from cliente_general where CLIENTE_NOMBRES = '$nom'
                                                and CLIENTE_USR_BAJA is null";
    $res_cli = mysql_query($con_cli)or die('No pudo seleccionarse tabla 1');
    while ($linea = mysql_fetch_array($res_cli)) {
	      $_SESSION['cli_exis'] = $linea['CLIENTE_COD'];
          $cli_con = $cli_con + 1;
		  }
    if ($cli_con == 0) {
       return $cli_con;
       }else{
       return $cli_con;
   	}
}	
}
?>
<?php
function validar_deu_solic($cod_cli,$nro_s)
{
$con_sdeu = "Select * From cred_deudor where CRED_DEU_INTERNO = '$cod_cli' and CRED_SOL_CODIGO = $nro_s and CRED_DEU_USR_BAJA is null";
$res_sdeu = mysql_query($con_sdeu)or die('No pudo seleccionarse tabla 1');
$linea = mysql_fetch_array($res_sdeu);
$cli_con = $linea[CRED_DEU_INTERNO];
if (empty($cli_con)) {
   return false;
   }else{
   return true;
	}
}
?>
 <?php
function validar_grupo($grup_nom)
{
$con_grp = "Select * From cred_grupo where CRED_GRP_NOMBRE = '$grup_nom' and CRED_GRP_USR_BAJA is null";
$res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla 1');
$linea = mysql_fetch_array($res_grp);
$nom_g = $linea[CRED_GRP_NOMBRE];
if (empty($nom_g)) {
   return false;
   }else{
   return true;
	}
}
?> 
<?php
function leer_nro_grupo() 
{
$consulta  = "SELECT CRED_GRP_NUMERICO FROM cred_grupo where CRED_GRP_USR_BAJA is null ORDER BY CRED_GRP_NUMERICO DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
$nro_grupo = $linea['CRED_GRP_NUMERICO'];
if ($nro_grupo == 0){
   	$nro_grupo =$nro_grupo + 1;
	} else {
	$nro_grupo = $linea['CRED_GRP_NUMERICO'] + 1;
	}
	echo $nro_grupo;
   return $nro_grupo; 
}
?> 
<?php
function verif_cierre_cja($fec_ult,$log_usr,$mone) 
{
//echo "aqui".$log_usr,$fec_ult;
if ($mone == 1){
   $con_trc = "SELECT CAJERO_FIN1 FROM cajero where CAJERO_LOGIN = '$log_usr'
              and CAJERO_FECHA = '$fec_ult'";
   $res_trc = mysql_query($con_trc)or die('No pudo seleccionarse tabla cajero');
   while ($lin_trc = mysql_fetch_array($res_trc)) {
      $estad =  $lin_trc['CAJERO_FIN1'];
      }
 } 
 if ($mone == 2){
   $con_trc = "SELECT CAJERO_FIN2 FROM cajero where CAJERO_LOGIN = '$log_usr'
              and CAJERO_FECHA = '$fec_ult'";
   $res_trc = mysql_query($con_trc)or die('No pudo seleccionarse tabla cajero');
   while ($lin_trc = mysql_fetch_array($res_trc)) {
      $estad =  $lin_trc['CAJERO_FIN2'];
      }
 } 
if (isset($estad)){
    }else{
	$estad = 0;
	}   
return  $estad;
}
?>	
<?php
function leer_nro_solic() 
{
	$consulta  = "SELECT CRED_SOL_NUMERICO FROM cred_solicitud where CRED_SOL_USR_BAJA is null ORDER BY CRED_SOL_NUMERICO  DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
$nro_soli = 0;

$nro_solic = $linea['CRED_SOL_NUMERICO'];
if (empty($nro_solic)) {
   	$nro_solic = nro_soli + 1;
	} else {
	$nro_solic = $linea['CRED_SOL_NUMERICO'] + 1;
	}
   return $nro_solic; 
}
?> 	
<?php
function verif_deu_sol($n_sol)
{
$con_sdeu = "Select * From cred_deudor where CRED_SOL_CODIGO = $n_sol and CRED_DEU_USR_BAJA is null";
$res_sdeu = mysql_query($con_sdeu)or die('No pudo seleccionarse tabla 1');
$linea = mysql_fetch_array($res_sdeu);
$cli_con = $linea[CRED_DEU_INTERNO];
if (empty($cli_con)) {
   return false;
   }else{
   return true;
	}
}
?>
<?php
function validar_deu_grupo($cod_cli,$nro_g)
{
$con_gdeu = "Select * From cred_grupo_mesa where CRED_GRP_MES_CLI = '$cod_cli' and CRED_GRP_MES_COD = $nro_g and CRED_GRP_MES_USR_BAJA is null";
$res_gdeu = mysql_query($con_gdeu)or die('No pudo seleccionarse tabla 1');
$linea = mysql_fetch_array($res_gdeu);
$cli_con = $linea[CRED_GRP_MES_REL];
if (empty($cli_con)) {
   return false;
   }else{
   return true;
	}
}
?>

<?php
function verif_saldo_fin_cja($fec_ult,$ag_u) 
{
//echo $fec_ult,$ag_u;
$con_trc = "SELECT CAJA_TRAN_FECHA FROM caja_transac where CAJA_TRAN_CAJERO1 = '$ag_u' and CAJA_TRAN_TIPO_OPE = 2  and CAJA_TRAN_FECHA = '$fec_ult'";
 $res_trc = mysql_query($con_trc)or die('No pudo seleccionarse tabla caja xx');
 $nro_tra = 0;
 while ($lin_trc = mysql_fetch_array($res_trc)) {
       $nro_tra = $nro_tra + 1;
       }
return  $nro_tra;
}
?>
<?php
function saldo_fin_cja2($fec_ult,$log_usr,$mon) 
{
if ($mon == 1) {
$con_trc = "SELECT sum(CAJA_TRAN_IMPORTE) FROM caja_transac where CAJA_TRAN_CAJERO1 = '$log_usr'
            and CAJA_TRAN_MON = $mon and CAJA_TRAN_FECHA = '$fec_ult' and CAJA_TRAN_TIPO_OPE <> 2";
}	
if ($mon == 2) {
$con_trc = "SELECT sum(CAJA_TRAN_IMP_EQUIV) FROM caja_transac where CAJA_TRAN_CAJERO1 = '$log_usr'
            and CAJA_TRAN_IMPORTE <> CAJA_TRAN_IMP_EQUIV and CAJA_TRAN_FECHA = '$fec_ult' and CAJA_TRAN_TIPO_OPE <> 2";
}				
 $res_trc = mysql_query($con_trc)or die('No pudo seleccionarse tabla caja 2');
 $nro_tra = 0;
if ($mon == 1) { 
 while ($lin_trc = mysql_fetch_array($res_trc)) {
      $sald =  $lin_trc['sum(CAJA_TRAN_IMPORTE)'];
       }
	 }  
if ($mon == 2) { 
 while ($lin_trc = mysql_fetch_array($res_trc)) {
      $sald =  $lin_trc['sum(CAJA_TRAN_IMP_EQUIV)'];
       }
	 }  	 
return  $sald;
}
?>
<?php
function saldo_fin_vale($fec_ult,$log_usr,$mon) 
{
$con_trc = "SELECT sum(CAJA_VAL_IMPO) FROM caja_vale where CAJA_VAL_USR_ALTA = '$log_usr'
            and CAJA_VAL_MON = $mon and CAJA_VAL_FECHA = '$fec_ult'";
$res_trc = mysql_query($con_trc)or die('No pudo seleccionarse tabla caja_vale');
  while ($lin_trc = mysql_fetch_array($res_trc)) {
      $sald =  $lin_trc['sum(CAJA_VAL_IMPO)'];
       }
return  $sald;
}
?>
<?php
function saldo_fin_banco($fec_ult,$log_usr,$mon) 
{
$con_trc = "SELECT sum(CAJA_DEP_MON) FROM caja_deposito where CAJA_DEP_USR_ALTA = '$log_usr'
            and CAJA_DEP_MON = $mon and CAJA_DEP_FECHA = '$fec_ult'";
$res_trc = mysql_query($con_trc)or die('No pudo seleccionarse tabla caja_deposito');
  while ($lin_trc = mysql_fetch_array($res_trc)) {
      $sald =  $lin_trc['sum(CAJA_DEP_MON)'];
       }
return  $sald;
}
?>
<?php
function verif_cajero_hab($fec_ult,$log_usr) 
{
//echo "aqui".$log_usr,$fec_ult;
//if ($mone == 1){
   $con_trc = "SELECT count(*) FROM cajero where CAJERO_LOGIN = '$log_usr'
              and CAJERO_FECHA = '$fec_ult'";
   $res_trc = mysql_query($con_trc)or die('No pudo seleccionarse tabla cajero');
   while ($lin_trc = mysql_fetch_array($res_trc)) {
         $estad =  $lin_trc['count(*)'];
      }
 //} 
 
if (isset($estad)){
    }else{
	$estad = 0;
	}   
return  $estad;
}
?>

<?php
function leer_nro_corre($apli,$agen) 
{
$consulta  = "SELECT GRAL_CORRE_NRO_DOC FROM gral_correlativo where GRAL_CORRE_AGEN = $agen 
              and GRAL_CORRE_APL = $apli and GRAL_CORRE_USR_BAJA is null ORDER BY GRAL_CORRE_NRO_DOC 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['GRAL_CORRE_NRO_DOC'] + 1;
return $nro_tran; 
}
?>
<?php
function verif_saldo_ini_cja($fec_act,$cajero,$c_age) 
{
$fec_a = cambiaf_a_mysql_2($fec_act);
$con_trc = "SELECT CAJA_TRAN_FECHA FROM caja_transac where CAJA_TRAN_AGE_ORG = $c_age and CAJA_TRAN_TIPO_OPE = 1
 and CAJA_TRAN_FECHA = '$fec_a' and CAJA_TRAN_CAJERO1 = '$cajero'";
 $res_trc = mysql_query($con_trc)or die('No pudo seleccionarse tabla caja 2');
 $nro_tra = 0;
 while ($lin_trc = mysql_fetch_array($res_trc)) {
       $nro_tra = $nro_tra + 1;
       }
return  $nro_tra;
}
?>
<?php
function leer_nro_co_cja($apli,$cajero) 
{
$consulta  = "SELECT CAJA_TRAN_NRO_DOC FROM caja_transac where CAJA_TRAN_CAJERO1 = '$cajero' 
              and CAJA_TRAN_USR_BAJA is null ORDER BY CAJA_TRAN_NRO_DOC 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla corr caja');
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CAJA_TRAN_NRO_DOC'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
/*  Función dia_semana by PaToRoCo (www.patoroco.net)
Se permite la distribución total y modificación de la función, siempre que se nombre al autor */

function dia_semana ($dia, $mes, $ano) {
    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    return $dias[date("w", mktime(0, 0, 0, $mes, $dia, $ano))];
}
?>
<?php
function mes_anio ($mes) {
//echo $mes;
    $meses = array('Nada', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Noviembre', 'Diciembre' );
    return $meses[$mes];
}
?>
<?php
function encadenar($nespacios){ 
  $espacios = "";
  $solo = "&nbsp;";
  for($i=0;$i<$nespacios;$i++){ 
    $espacios=$espacios.$solo;//voy sumando espacios... 
  } 
  return $espacios;//devuelvo la cadena con todos los espacios 
} 
?>
<?php
function leer_tipo_cam() 
{
$cod_agen = $_SESSION['COD_AGENCIA'];
$consulta  = "SELECT * FROM gral_tipo_cambio where GRAL_TIP_CAM_AGEN = $cod_agen ORDER BY GRAL_TIP_CAM_FECHA DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla tipo_cambio');
//$linea = mysql_fetch_array($resultado);
    while ($linea = mysql_fetch_array($resultado)) {
//	echo $linea['GRAL_TIP_CAM_CONTAB']."contab";
//	echo $linea['GRAL_TIP_CAM_COMPRA']."compra";
//	echo $linea['GRAL_TIP_CAM_VENTA']."venta";
    $_SESSION['TC_CONTAB'] = $linea['GRAL_TIP_CAM_CONTAB'];
	$_SESSION['TC_COMPRA'] = $linea['GRAL_TIP_CAM_COMPRA'];
	$_SESSION['TC_VENTA'] = $linea['GRAL_TIP_CAM_VENTA'];
	$tc_contab = $_SESSION['TC_CONTAB'];
	//echo $tc_contab;
	}
    return $tc_contab;
}
?>
<?php
function leer_cta_car($tip,$top,$est,$mon) 
{

 $con_cartc = "Select * From cart_via_cta where CART_VIA_CTA_GRP = $tip and CART_VIA_TIP_OP = $top and CART_VIA_CTA_NRO = $est and CART_VIA_MON = $mon and CART_VIA_CTA_USR_BAJA is null ";
 $res_cartc = mysql_query($con_cartc)or die('No pudo seleccionarse tabla caja_transac 1')  ;
	while ($lin_cartc = mysql_fetch_array($res_cartc)) {
	       $cta_cart = $lin_cartc['CART_VIA_CTA_CTB']; 
		   $cta_tip = $lin_cartc['CART_VIA_CTA_COD']; 	
	      }
//echo $cta_cart, "cta cart";		  
 return $cta_cart;
 }		  
?>
<?php
function leer_cta_tip($tip,$top,$est,$mon) 
{
//echo $tip,$top,$est,$mon,"llega";
 $con_cartc = "Select * From cart_via_cta where CART_VIA_CTA_GRP = $tip and CART_VIA_TIP_OP = $top and CART_VIA_CTA_NRO = $est and CART_VIA_MON = $mon and CART_VIA_CTA_USR_BAJA is null ";
 $res_cartc = mysql_query($con_cartc)or die('No pudo seleccionarse tabla caja_transac 1')  ;
	while ($lin_cartc = mysql_fetch_array($res_cartc)) {
	      $cta_tip = $lin_cartc['CART_VIA_CTA_COD']; 	
	      }
 return $cta_tip;
 }		  
?>
<?php
function leer_cta_des($cta){
    $des_cta = 0;		  
	$con_ctad  = "Select * From contab_cuenta where CONTA_CTA_NRO = $cta and CONTA_CTA_NIVEL = 'A' ";
    $res_ctad = mysql_query($con_ctad)or die('No pudo seleccionarse tabla aqui')  ;
	while ($lin_ctad = mysql_fetch_array($res_ctad)) {
	      $des_cta = $lin_ctad['CONTA_CTA_DESC'];
          }
	return $des_cta;
}	  
?>
<?php
function leer_nro_co_fon($top,$agen) 
{

$consulta  = "SELECT FOND_CAB_NRO_TRAN FROM fond_cabecera where FOND_CAB_USR_BAJA is null
              ORDER BY FOND_CAB_NRO_TRAN DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse correlativo fond_cabecera');
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['FOND_CAB_NRO_TRAN'];
if (empty($nro_tran)) {
$nro_tran = 1;
}else{
$nro_tran = $nro_tran + 1;
}
return $nro_tran; 
}
?>
<?php
function leer_nro_co_car($top,$agen) 
{

$consulta  = "SELECT CART_CAB_NRO_TRAN FROM cart_cabecera where CART_CAB_AGEN = $agen 
              and CART_CAB_TIP_TRAN = $top and CART_CAB_USR_BAJA is null ORDER BY CART_CAB_NRO_TRAN DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse correlativo cart_cabecera');
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CART_CAB_NRO_TRAN'];
if (empty($nro_tran)) {
$nro_tran = 1;
}else{
$nro_tran = $nro_tran + 1;
}
return $nro_tran; 
}
?>
<?php
function leer_nro_credito($agen) 
{
$consulta  = "SELECT CART_NUMERICO FROM cart_maestro where 
              CART_MAE_USR_BAJA is null ORDER BY CART_NUMERICO DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse correlativo cart_maestro');
$linea = mysql_fetch_array($resultado);
$nro_cta = 0;
$nro_ctaf = $linea['CART_NUMERICO'];
if (empty($nro_ctaf)) {
   $nro_ctaf = $nro_cta + 1;
   }else{
   $nro_ctaf = $nro_ctaf + 1;
   }
   return $nro_ctaf; 
}
?>
<?php
function leer_nro_ctafon($agen) 
{

$consulta  = "SELECT FOND_NUMERICO FROM fond_maestro where 
              FOND_MAE_USR_BAJA is null ORDER BY FOND_NUMERICO DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse correlativo fond_maestro');
$linea = mysql_fetch_array($resultado);
$nro_cta = 0;
$nro_ctaf = $linea['FOND_NUMERICO'];
if (empty($nro_ctaf)) {
   $nro_ctaf = $nro_cta + 1;
   }else{
   $nro_ctaf = $nro_ctaf + 1;
   }
   return $nro_ctaf; 
}
?>
<?php
function montos_recuperados($cred,$fec,$tip) 
{
$fec_r = cambiaf_a_mysql_2($fec);
//echo $fec_r, $cred,$tip;
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
 
if ($tip == 1){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               (CART_DTRA_CCON between 131 and 133) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 }
 if ($tip == 5){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               (CART_DTRA_CCON between 513 and 515) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 }
  if ($tip == 2){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               (CART_DTRA_CCON between 212 and 215) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 }
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	              $monto = $lin_dtra['sum(CART_DTRA_IMPO)'];
		     }
             return $monto;		  
}
	
?>
<?php
function montos_recupera_dos($cred,$fec,$tip) 
{
$fec_r = $fec;
//echo $fec_r, $cred,$tip;
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
 
if ($tip == 1){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               (CART_DTRA_CCON between 131 and 133) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 }
 if ($tip == 5){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               (CART_DTRA_CCON between 513 and 515) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 }
  if ($tip == 2){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               (CART_DTRA_CCON between 212 and 215) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 }
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	              $monto = $lin_dtra['sum(CART_DTRA_IMPO)'];
		     }
             return $monto;		  
}
	
?>
 <?php
function montos_dep_fgar($cred,$fec,$tip) 
{
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
  $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran, fond_maestro where FOND_NRO_CRED = $cred and  FOND_DTRA_FECHA <= '$fec' and FOND_DTRA_TIP_TRAN = $tip and FOND_DTRA_USR_BAJA is null and FOND_MAE_USR_BAJA is null ";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(FOND_DTRA_IMPO)'];
		  }
  return $monto;		  
	}
	
?>
 <?php
function monto_deuda_c($cred,$fec) 
{
$f_has = $fec;
//echo $f_has;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CART_PLD_CAPITAL) From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_FECHA <= '$f_has' and CART_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CART_PLD_CAPITAL)'];
		  }
  return $monto;		  
	}
	
?>
 <?php
function monto_deuda_i($cred,$fec) 
{
//echo $fec;
$f_has = $fec;
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CART_PLD_INTERES) From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_FECHA <= '$f_has' and CART_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CART_PLD_INTERES)'];
		  }
  return $monto;		  
	}
	
?>
 <?php
function monto_deuda_a($cred,$fec) 
{
$f_has = $fec;
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CART_PLD_AHORRO) From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_FECHA <= '$f_has' and CART_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CART_PLD_AHORRO)'];
		  }
  return $monto;		  
	}
	
?>
 <?php
function monto_deuda_t($cred,$fec) 
{
 //$f_has = cambiaf_a_mysql($fec);
 $f_has = $fec;
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CART_PLD_CAPITAL),sum(CART_PLD_INTERES),sum(CART_PLD_AHORRO)
                From cart_plandp where CART_PLD_NCRE=$cred 
				and CART_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CART_PLD_CAPITAL)']+
		           $lin_dtra['sum(CART_PLD_INTERES)'];
//				   $lin_dtra['sum(CART_PLD_AHORRO)'];
		  }
  return $monto;		  
	}
	
?>
<?php
function monto_deuda_tf($cred,$fec) 
{
 //$f_has = cambiaf_a_mysql($fec);
 $f_has = $fec;
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CART_PLD_CAPITAL),sum(CART_PLD_INTERES),sum(CART_PLD_AHORRO)
                From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_FECHA <='$f_has' and  CART_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CART_PLD_CAPITAL)']+
		           $lin_dtra['sum(CART_PLD_INTERES)'];
//				   $lin_dtra['sum(CART_PLD_AHORRO)'];
		  }
  return $monto;		  
	}
	
?>
 <?php
function monto_deu_cs($sol,$cli,$fec) 
{
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CRED_PLD_CAPITAL) From cred_plandp where CRED_PLD_COD_SOL=$sol and CRED_PLD_COD_CLI=$cli  and CRED_PLD_FECHA <= '$fec' and CRED_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CRED_PLD_CAPITAL)'];
		  }
  return $monto;		  
	}
	
?>
<?php
function monto_deu_is($sol,$cli,$fec) 
{
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CRED_PLD_INTERES) From cred_plandp where CRED_PLD_COD_SOL=$sol and CRED_PLD_COD_CLI=$cli  and CRED_PLD_FECHA <= '$fec' and CRED_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CRED_PLD_INTERES)'];
		  }
  return $monto;		  
	}
	
?>
<?php
function monto_deu_as($sol,$cli,$fec) 
{
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CRED_PLD_AHORRO) From cred_plandp where CRED_PLD_COD_SOL=$sol and CRED_PLD_COD_CLI=$cli  and CRED_PLD_FECHA <= '$fec' and CRED_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CRED_PLD_AHORRO)'];
		  }
  return $monto;		  
	}
	
?>
 <?php
function monto_deu_ts($sol,$cli,$fec) 
{
//$f_has = cambiaf_a_mysql($fec);
$f_has = $fec;
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CRED_PLD_CAPITAL),sum(CRED_PLD_INTERES), sum(CRED_PLD_AHORRO) From cred_plandp where CRED_PLD_COD_SOL=$sol and CRED_PLD_COD_CLI=$cli  and CRED_PLD_FECHA <= '$f_has' and CRED_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $monto + ($lin_dtra['sum(CRED_PLD_CAPITAL)']+
		                     $lin_dtra['sum(CRED_PLD_INTERES)']+
							 $lin_dtra['sum(CRED_PLD_AHORRO)']);
		  }
  return $monto;		  
	}
	
?>
<?php
function  montos_recu_cli($sol,$fec,$cli,$tip) 
//monto_deu_a($sol,$cli,$fec) 
{
$f_has = cambiaf_a_mysql($fec);
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto_c = 0;
  $monto_i = 0;
  $monto_f = 0;
  $monto_t = 0; 
  $con_dtra  = "Select sum(CRED_PLP_MONTO), sum(CRED_PLP_CAPITAL),sum(CRED_PLP_INTERES), sum(CRED_PLP_AHORRO)  From cred_plandp_pag where CRED_PLP_COD_SOL=$sol and CRED_PLP_COD_CLI=$cli  and CRED_PLP_FECHA <= '$f_has' and CRED_PLP_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto_t = $lin_dtra['sum(CRED_PLP_MONTO)'];
	      $monto_c = $lin_dtra['sum(CRED_PLP_CAPITAL)'];
		  $monto_i = $lin_dtra['sum(CRED_PLP_INTERES)'];
		  $monto_f = $lin_dtra['sum(CRED_PLP_AHORRO)'];
		  }
	//echo $monto_c,$monto_i,$monto_f;	  
	if ($tip == 1){
	   return $monto_c;
	 } 
	 if ($tip == 2){
	   return $monto_i;
	 } 
	 if ($tip == 3){
	   return $monto_f;
	 } 
	 if ($tip == 4){
	   return $monto_t;
	 } 
	  		  
	}
	
?>

<?php
function validar_deu_cred($cod_cli,$nro_c)
{
$con_sdeu = "Select * From cart_deudor where CART_DEU_INTERNO = '$cod_cli' and CART_DEU_NCRED = $nro_c and CART_DEU_USR_BAJA is null";
$res_sdeu = mysql_query($con_sdeu)or die('No pudo seleccionarse tabla 1');
$linea = mysql_fetch_array($res_sdeu);
$cli_con = $linea[CART_DEU_INTERNO];
if (empty($cli_con)) {
   return false;
   }else{
   return true;
	}
}
?>
 <?php
function saldo_c($cred,$fec,$f_tra) 
{
$f_has = $fec;
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $saldo = 0;
  $deuda = 0;
  $pago = 0;
  $con_dtra  = "Select sum(CART_PLD_CAPITAL) From cart_plandp where CART_PLD_NCRE=$cred 
                and CART_PLD_USR_BAJA is null";
 
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $deuda = $lin_dtra['sum(CART_PLD_CAPITAL)'];
		  }
 $con_ptra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$f_tra' and    SUBSTRING(CART_DTRA_CTA_CBT,1,2) = 13 and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_ptra = mysql_query($con_ptra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_ptra = mysql_fetch_array($res_ptra)) {
	      $pago = $lin_ptra['sum(CART_DTRA_IMPO)'];
		  }		  
		  
  $saldo = $deuda - $pago;	  
  return $saldo;		  
	}
	
?>
 <?php
function ult_cta_pag($cred,$fec_p) 
{
$f_has = $fec;
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $saldo = 0;
  $deuda = 0;
  $pago = 0;
  $con_dtra  = "Select sum(CART_PLD_CAPITAL) From cart_plandp where CART_PLD_NCRE=$cred 
                and CART_PLD_USR_BAJA is null";
 
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $deuda = $lin_dtra['sum(CART_PLD_CAPITAL)'];
		  }
 $con_ptra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$f_tra' and    SUBSTRING(CART_DTRA_CTA_CBT,1,2) = 13 and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_ptra = mysql_query($con_ptra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_ptra = mysql_fetch_array($res_ptra)) {
	      $pago = $lin_ptra['sum(CART_DTRA_IMPO)'];
		  }		  
		  
  $saldo = $deuda - $pago;	  
  return $saldo;		  
	}
?>	
<?php
function cta_pag($cred) {
  $saldo = 0;
  $deuda = 0;
  $pago = 0;
  $con_dtra  = "Select * From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_STAT= 'C' and CART_PLD_USR_BAJA is null";
 
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_plandp ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $deuda = $deuda + 1;
		  }
    return $deuda;		  
}
	
?>
<?php
function vto_fin($cred) {
  $fec_f = "";
  $con_dtra  = "Select CART_PLD_FECHA From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_USR_BAJA is null
                 ORDER BY CART_PLD_FECHA DESC LIMIT 0,1";
 
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_plandp ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $fec_f = $lin_dtra['CART_PLD_FECHA'];
		  }
    return $fec_f;		  
}
	
?>
<?php
function ult_pag($cred) {
  $fec_f = "";
  $con_dtra  = "Select CART_DTRA_FECHA From cart_det_tran where CART_DTRA_NCRE=$cred
                and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null
                 ORDER BY CART_DTRA_FECHA DESC LIMIT 0,1";
 
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $fec_f = $lin_dtra['CART_DTRA_FECHA'];
		  }
    return $fec_f;		  
}
	
?>
<?php
function cta_ven($cred) {
   $deuda = 0;
   $con_dtra  = "Select * From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_STAT= 'M' and CART_PLD_USR_BAJA is null";
 
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_plandp ' . mysql_error());
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $deuda = $deuda + 1;
		  }
    return $deuda;		  
}
?>
<?php
function cta_venf($cred) {
  $fec_f = "";
  $con_dtra  = "Select CART_PLD_FECHA From cart_plandp where CART_PLD_NCRE=$cred 
                 and CART_PLD_STAT <> 'C' and CART_PLD_USR_BAJA is null
                ORDER BY CART_PLD_FECHA ASC LIMIT 0,1";
 
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_plandp ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $fec_f = $lin_dtra['CART_PLD_FECHA'];
		  }
    return $fec_f;	
}
?>
 <?php
function monto_aho_cta($cred,$f_fec) 
{
$cta_aho = 0;
  $con_dtra  = "Select CART_PLD_AHORRO From cart_plandp where CART_PLD_NCRE=$cred 
                 and CART_PLD_FECHA ='$f_fec'
                 and CART_PLD_USR_BAJA is null";
 
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_plandp ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $cta_aho = $lin_dtra['CART_PLD_AHORRO'];
		  }
    return $cta_aho;	
}
?>
<?php
function montos_condonados($cred,$fec,$tip) 
{
$fec_r = cambiaf_a_mysql_2($fec);
//echo $fec_r.encadenar(2). $cred.encadenar(2).$tip;
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
 
//if ($tip == 1){  
//  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
 //              (CART_DTRA_CCON between 131 and 133) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
// }
 if ($tip == 5){  
  $con_dtra  = "Select sum(CART_DET_CON_IMPO_N) From cart_det_cond where CART_DET_CON_NCRE = $cred 
                and CART_DET_CON_FCH_PRO <= '$fec_r' and 
               (CART_DET_CON_CODIGO between 513 and 515) and CART_DET_CON_TIP_TRAN = 1 and CART_DET_CON_USR_BAJA is null ";
 }
 // if ($tip == 2){  
 // $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
  //             (CART_DTRA_CCON between 212 and 215) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 //}
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	              $monto = $lin_dtra['sum(CART_DET_CON_IMPO_N)'];
		     }
             return $monto;		  
}
	
?>
<?php
function leer_nro_co_ingegr() 
{
$consulta  = "SELECT caja_ingegr_corr FROM caja_ing_egre where 
              caja_ingegr_usr_baja is null ORDER BY caja_ingegr_corr 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['caja_ingegr_corr'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
function leer_nro_co_comven() 
{
$consulta  = "SELECT caja_comven_corr FROM caja_com_ven where 
              caja_comven_usr_baja is null ORDER BY caja_comven_corr 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['caja_comven_corr'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
function leer_nro_orden() 
{

$consulta  = "SELECT ORD_NUMERO FROM ord_maestro where ORD_MAE_USR_BAJA is null
              ORDER BY ORD_NUMERO DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse correlativo ord_maestro');
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['ORD_NUMERO'];
if (empty($nro_tran)) {
$nro_tran = 1;
}else{
$nro_tran = $nro_tran + 1;
}
return $nro_tran; 
}
?>
<?php
function leer_nro_tr_banco() 
{
$consulta  = "SELECT CAJA_DEP_NRO FROM caja_deposito where 
              CAJA_DEP_USR_BAJA is null ORDER BY CAJA_DEP_NRO
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CAJA_DEP_NRO'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
function leer_nro_co_con() 
{
$consulta  = "SELECT CONTA_TRS_NRO FROM contab_trans where  
              CONTA_TRS_USR_BAJA is null ORDER BY CONTA_TRS_NRO
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CONTA_TRS_NRO'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
function leer_nombre_ope($cod_ope) 
{
//echo $cod_ope;
$con_ope  = "Select GRAL_PAR_PRO_DESC From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD = $cod_ope";
$res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla ope')  ;
$lin_ope = mysql_fetch_array($res_ope);
$nom_ope = $lin_ope['GRAL_PAR_PRO_DESC'];


return $nom_ope; 
}
?>
<?php
function leer_nro_co_cred() 
{
$consulta  = "SELECT ord_cre_nro FROM ord_credito where 
              ord_cre_usr_baja is null ORDER BY ord_cre_nro 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['ord_cre_nro'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
function copia_crono() 
{
$minseg = date("i:s");
$fec_cop = date("Y-m-d");
$fec_copia = date("Y-m-d", strtotime("$fec_cop - 30 days"));
$fec_copia2 = date("Y-m-d", strtotime("$fec_copia + 90 days"));
//echo $fec_copia."--".$fec_copia2."--".$minseg;
if (($minseg >= "30:00" and $minseg <= "32:00") or ($minseg >= "00:00" and $minseg <= "02:00")){
   $con_bor  = "delete From ord_conobck"; 
   $res_bor = mysql_query($con_bor)or die('No pudo borrar ord_cronobck');
   $con_bck  = "Select * From ord_conograma where ord_cro_fecha >= '$fec_copia' and ord_cro_fecha <= '$fec_copia2'"; 
   $res_bck = mysql_query($con_bck)or die('No pudo seleccionarse ord_cronograma');
   while ($lin_bck = mysql_fetch_array($res_bck)) { 
          $bck_fecha = $lin_bck['ord_cro_fecha'];
		  $bck_opera = $lin_bck['ord_cro_ope'];
          $hra_6_det = $lin_bck['ord_cro_6_det'];
		  $hra_7_det = $lin_bck['ord_cro_7_det'];
		  $hra_8_det = $lin_bck['ord_cro_8_det'];
		  $hra_9_det = $lin_bck['ord_cro_9_det'];	
		  $hra_10_det = $lin_bck['ord_cro_10_det'];
		  $hra_11_det = $lin_bck['ord_cro_11_det'];
		  $hra_12_det = $lin_bck['ord_cro_12_det'];
		  $hra_13_det = $lin_bck['ord_cro_13_det']; 
		  $hra_14_det = $lin_bck['ord_cro_14_det'];
		  $hra_15_det = $lin_bck['ord_cro_15_det'];
		  $hra_16_det = $lin_bck['ord_cro_16_det']; 
		  $hra_17_det = $lin_bck['ord_cro_17_det']; 
		  $hra_18_det = $lin_bck['ord_cro_18_det'];
		  $hra_19_det = $lin_bck['ord_cro_ot_det'];  
		  $act_bck= "insert into ord_conobck (ord_bck_fecha, 
                                       ord_bck_ope,
									   ord_bck_6_det,
									   ord_bck_7_det,
									   ord_bck_8_det,
									   ord_bck_9_det,
									   ord_bck_10_det,
					                   ord_bck_11_det,
   				                       ord_bck_12_det, 
									   ord_bck_13_det, 
									   ord_bck_14_det,
                                       ord_bck_15_det,
									   ord_bck_16_det,
                                       ord_bck_17_det,
                                       ord_bck_18_det,
                                       ord_bck_ot_det
                                       ) values ('$bck_fecha',
									             $bck_opera,
												 '$hra_6_det',
												 '$hra_7_det',
												 '$hra_8_det',
												 '$hra_9_det',
												 '$hra_10_det',
												 '$hra_11_det',
												 '$hra_12_det',
												 '$hra_13_det',
												 '$hra_14_det',
												 '$hra_15_det',
												 '$hra_16_det',
												 '$hra_17_det',
												 '$hra_18_det',
												 '$hra_19_det')";
$bck_res = mysql_query($act_bck)or die('No pudo insertar ord_maestro : ' . mysql_error());
		  
		  
		       
   
   }
   // echo "dentro".$minseg;
}
return $minseg;
}
?>