<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
require('configuracion.php');
    require('funciones.php');
	require('funciones2.php');
	$tc_ctb  = $_SESSION['TC_CONTAB'];
	$fec = leer_param_gral();
 $logi = $_SESSION['login']; 	
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='solic_mante.php'>Salir</a>
  </div>
<?php	
	
	//Datos empresa		  
		
?>
<br>
<strong> 
<?php
if(isset($_SESSION['fec_proc'])){ 
  $fec_p = $_SESSION['fec_proc']; 
  }
if(isset($_SESSION['login'])){   
   $log_usr = $_SESSION['login']; 
   }

$total = 0;
$f_tra = cambiaf_a_mysql_2($fec_p);
//echo $fec_p, $f_tra;
$_SESSION['msg_err'] = " ";
//$log_usr = $_SESSION['login'];
$error_d = 0;
$nro_ord = $_SESSION['cod_ord'];

echo "Fecha".encadenar(2).$_SESSION['fec_ord'].encadenar(70)."ORDEN DE TRABAJO".encadenar(70);

?>
<br><br>


 
	  
 <?php
$nro_ord = $_SESSION['cod_ord'];
$hoy = date("Y-m-d H:i:s");
$act_tabla  = "update ord_maestro set ORD_MAE_USR_BAJA = '$logi',
                                        ORD_MAE_FCH_HR_BAJA = '$hoy'
               where  ORD_NUMERO = $nro_ord ";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar fond_cabecera: ' . mysql_error());
$act_tabla  = "update ord_detalle set ORD_DET_USR_BAJA = '$logi',
                                      ORD_DET_FCH_HR_BAJA = '$hoy'
               where  ORD_DET_ORD = $nro_ord ";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar fond_cabecera: ' . mysql_error());

$act_tabla  = "update ope_crono set ope_cro_usr_baja = '$logi',
                                      ope_cro_fec_hr_baja = '$hoy'
               where  ope_cro_nroord = '$nro_ord' ";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar fond_cabecera: ' . mysql_error());







$cod_cli = $_SESSION['cod_cli'];
$fec_ord = $_SESSION['fec_ord'];
$fac_a = $_SESSION['fac_a'];
if ($_SESSION['nit'] > 0){
    $nit = $_SESSION['nit'];
	}else{
	$nit = 0;
	}
$agen = 30;
$hra_ini = $_SESSION['hra_ini'];
$hra_fin = $_SESSION['hra_fin'];
//$fec_ord = $_SESSION['fec_ord'];
$anio =  substr($fec_ord, -4);
$mes = substr($fec_ord, 3,2);
$dia = substr($fec_ord, 0,2);
$fec_ord2 = cambiaf_a_mysql($fec_ord);
$fec_ini = $_SESSION['fec_ini'];
$fec_ini2 = cambiaf_a_mysql($fec_ini);
$importe = 0;
$descuento = 0;
$cod_mon = 0;
$plzo_m = 0;
$plzo_d = 0;
$cod_fpa = $_SESSION['cod_fpa'];
$tasa = 0;
$oper = $_SESSION['oper'];
$sol_por =  $_SESSION['sol_por'];
//$_SESSION['descuento'] = 0;
echo $_SESSION['total'],"*";
$total = $_SESSION['total'];
$_SESSION['recomen'] = "NOTA: Cualquier daño, perdida o problema que sufran las cabinas seran de exclusiva responsabilidad por  parte de la PERSONA, EMPRESA U ORGANIZACIONA que alquile las mismas.";
	
 $incremento = $_SESSION['incremento'];
 $descuento = $_SESSION['descuento'];   
/*
*/
//echo $nro_ord, $nro_ord,$cod_cli,$fac_a,$nit,$hra_ini,$hra_fin,$fec_ord2,
//	 $fec_ini2,$cod_fpa,$oper,$sol_por,$log_usr;
 $consulta = "insert into ord_maestro (ORD_NUMERO, 
                                       ORD_NUMERICO,
									   ORD_COD_CLI,
									   ORD_NOM_FAC,
									   ORD_NIT_FAC,
									   ORD_COD_AGEN,
									   ORD_HR_INI,
					                   ORD_HR_FIN,
   				                       ORD_FEC_SOL, 
									   ORD_FEC_INI, 
									   ORD_IMPORTE,
                                       ORD_IMP_DES,
									   ORD_IMP_INC,
                                       ORD_COD_MON,
                                       ORD_PLZO_M,
                                       ORD_PLZO_D,
                                       ORD_FORM_PAG,
									   ORD_TASA,
                                       ORD_OPE_RESP,
                                       ORD_USR_AUT,
                                       ORD_FCH_AUT,
                                       ORD_FCH_CAN,
                                       ORD_QUIEN_SOL,
									   ORD_ESTADO,
                                       ORD_MAE_USR_ALTA,
                                       ORD_MAE_FCH_HR_ALTA,
									   ORD_MAE_USR_BAJA,
									   ORD_MAE_FCH_HR_BAJA
									   ) values ($nro_ord,
									             $nro_ord,
												 $cod_cli,
												 '$fac_a',
												 $nit,
												 '30',
												 '$hra_ini',
												 '$hra_fin',
												 '$fec_ord2',
												 '$fec_ini2',
												 $total,
												 $descuento,
												 $incremento,
												 1,
												 0,
												 0,
												 $cod_fpa,
 											     0,
												 '$oper',
												 null,
												 null,
												 null,
												 '$sol_por',
												 1,
	 											 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_maestro : ' . mysql_error());
//Grabar Cronograma
$consulta = "insert into ope_crono (ope_cro_opera, 
                                    ope_cro_fecha,
									ope_cro_hr_ini,
									ope_cro_hr_fin,
									ope_cro_nroord,
									ope_cro_usr_alta,
									ope_cro_fec_hr_alta,
					                ope_cro_usr_baja,
   				                    ope_cro_fec_hr_baja)
									    values ('$oper',
									            '$fec_ini2',
												'$hra_ini',
												'$hra_fin',
												 $nro_ord,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ope_crono : ' . mysql_error());
//Grabar detalle   
$dias_std = $_SESSION['dias_std'];
 $can_std = $_SESSION['can_std'];
 $mon_std = $_SESSION['mon_std'];
 $dias_ip = $_SESSION['dias_ip'];
 $can_ip =  $_SESSION['can_ip'];
 $mon_ip = $_SESSION['mon_ip'];
 $dias_vip = $_SESSION['dias_vip']; 
 $can_vip = $_SESSION['can_vip'];
 $mon_vip = $_SESSION['mon_vip'];
 $can_801 = $_SESSION['can_801'];
 $dias_801 = $_SESSION['dias_801'];
 $mon_801 = $_SESSION['mon_801'];
 $can_804 = $_SESSION['can_804'];
 $dias_804 = $_SESSION['dias_804'];
 $mon_804 = $_SESSION['mon_804'];
 $mon_803 = $_SESSION['mon_803'];
 $s_vol = $_SESSION['s_vol'];
 $n_via = $_SESSION['n_via'];
 $mon_806 = $_SESSION['mon_806'];
 $t_806 = $_SESSION['t_806'];
 $tipo = $_SESSION['tipo'];
 $mon_825 = $_SESSION['mon_825'];
 $c_825 = $_SESSION['c_825'];
 $mon_826 = $_SESSION['mon_826'];
 $com_826 = $_SESSION['com_826'];
 $com_825 = $_SESSION['com_825'];
// $incremento = $_SESSION['incremento'];
 //$descuento = $_SESSION['descuento'];
 /*$c_803 = $_SESSION['c_803'];
 $c_806 = $_SESSION['c_806'];
 $c_825 = $_SESSION['c_825'];
 $c_826 = $_SESSION['c_826'];
 */
 $nro = 0;
 
//802 
if ($_SESSION['mon_std']+$_SESSION['mon_ip']+$_SESSION['mon_vip'] > 0) {
   if ( $_SESSION['can_std'] > 0) {
      $nro = $nro + 1;
      $consulta = "insert into ord_detalle (ORD_DET_ORD, 
                                            ORD_DET_NRO,
									        ORD_DET_GRP,
									        ORD_DET_TIPO,
										    ORD_DET_CANT,
									        ORD_DET_DIAS,
					                        ORD_DET_MONTO,
					                        ORD_DET_VOLT,
   				                            ORD_DET_VOLP,
					                        ORD_DET_MED, 
									        ORD_DET_COMEN, 
									        ORD_DET_ESTADO, 
									        ORD_DET_USR_ALTA,
                                            ORD_DET_FCH_HR_ALTA,
                                            ORD_DET_USR_BAJA,
                                            ORD_DET_FCH_HR_BAJA
									        ) values ($nro_ord,
									                  $nro,
												      802,
												      3,
												      $can_std,
												      $dias_std,
												      $mon_std,
												      0,
												      0,
 											          1,
												  	 '$com_825',
												      2,
												      '$log_usr',
												      null,
												      null,
												     '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_detalle 802 3 : ' . mysql_error());
//$_SESSION['total'] = $_SESSION['total'] + $mon_std;
 }
  if ( $_SESSION['can_ip'] > 0) {
      $nro = $nro + 1;
      $consulta = "insert into ord_detalle (ORD_DET_ORD, 
                                            ORD_DET_NRO,
									        ORD_DET_GRP,
									        ORD_DET_TIPO,
										    ORD_DET_CANT,
									        ORD_DET_DIAS,
					                        ORD_DET_MONTO,
					                        ORD_DET_VOLT,
   				                            ORD_DET_VOLP,
					                        ORD_DET_MED, 
									        ORD_DET_COMEN, 
									        ORD_DET_ESTADO, 
									        ORD_DET_USR_ALTA,
                                            ORD_DET_FCH_HR_ALTA,
                                            ORD_DET_USR_BAJA,
                                            ORD_DET_FCH_HR_BAJA
									        ) values ($nro_ord,
									                  $nro,
												      802,
												      1,
												      $can_ip,
												      $dias_ip,
												      $mon_ip,
												      0,
												      0,
 											          1,
												  	 '$com_825',
												      2,
												      '$log_usr',
												      null,
												      null,
												     '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_detalle 802 1 : ' . mysql_error());
//$_SESSION['total'] = $_SESSION['total'] + $mon_ip;
 }
if ( $_SESSION['can_vip'] > 0) {
      $nro = $nro + 1;
      $consulta = "insert into ord_detalle (ORD_DET_ORD, 
                                            ORD_DET_NRO,
									        ORD_DET_GRP,
									        ORD_DET_TIPO,
										    ORD_DET_CANT,
									        ORD_DET_DIAS,
					                        ORD_DET_MONTO,
					                        ORD_DET_VOLT,
   				                            ORD_DET_VOLP,
					                        ORD_DET_MED, 

									        ORD_DET_COMEN, 
									        ORD_DET_ESTADO, 
									        ORD_DET_USR_ALTA,
                                            ORD_DET_FCH_HR_ALTA,
                                            ORD_DET_USR_BAJA,
                                            ORD_DET_FCH_HR_BAJA
									        ) values ($nro_ord,
									                  $nro,
												      802,
												      2,
												      $can_vip,
												      $dias_vip,
												      $mon_vip,
												      0,
												      0,
 											          1,
												  	  '$com_825',
												      2,
												      '$log_usr',
												      null,
												      null,
												     '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_detalle 802 2 : ' . mysql_error());
//$_SESSION['total'] = $_SESSION['total'] + $mon_vip;
   }
}
//801
if ($_SESSION['can_801'] > 0) {
      $nro = $nro + 1;
      $consulta = "insert into ord_detalle (ORD_DET_ORD, 
                                            ORD_DET_NRO,
									        ORD_DET_GRP,
									        ORD_DET_TIPO,
										    ORD_DET_CANT,
									        ORD_DET_DIAS,
					                        ORD_DET_MONTO,
					                        ORD_DET_VOLT,
   				                            ORD_DET_VOLP,
					                        ORD_DET_MED, 
									        ORD_DET_COMEN, 
									        ORD_DET_ESTADO, 
									        ORD_DET_USR_ALTA,
                                            ORD_DET_FCH_HR_ALTA,
                                            ORD_DET_USR_BAJA,
                                            ORD_DET_FCH_HR_BAJA
									        ) values ($nro_ord,
									                  $nro,
												      801,
												      1,
												      $can_801,
												      $dias_801,
												      $mon_801,
												      0,
												      0,
 											          1,
												  	  '$com_825',
												      2,
												      '$log_usr',
												      null,
												      null,
												     '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_detalle 801 1 : ' . mysql_error());
//$_SESSION['total'] = $_SESSION['total'] + $mon_801;
   }
//804
if ( $_SESSION['can_804'] > 0) {
      $nro = $nro + 1;
      $consulta = "insert into ord_detalle (ORD_DET_ORD, 
                                            ORD_DET_NRO,
									        ORD_DET_GRP,
									        ORD_DET_TIPO,
										    ORD_DET_CANT,
									        ORD_DET_DIAS,
					                        ORD_DET_MONTO,
					                        ORD_DET_VOLT,
   				                            ORD_DET_VOLP,
					                        ORD_DET_MED, 
									        ORD_DET_COMEN, 
									        ORD_DET_ESTADO, 
									        ORD_DET_USR_ALTA,
                                            ORD_DET_FCH_HR_ALTA,
                                            ORD_DET_USR_BAJA,
                                            ORD_DET_FCH_HR_BAJA
									        ) values ($nro_ord,
									                  $nro,
												      804,
												      1,
												      $can_804,
												      $dias_804,
												      $mon_804,
												      0,
												      0,
 											          1,
												  	  '$com_825',
												      2,
												      '$log_usr',
												      null,
												      null,
												     '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_detalle 804 1 : ' . mysql_error());
//$_SESSION['total'] = $_SESSION['total'] + $mon_804;
   }
//803
if ( $_SESSION['mon_803'] > 0 ) {
      $nro = $nro + 1;
      $consulta = "insert into ord_detalle (ORD_DET_ORD, 
                                            ORD_DET_NRO,
									        ORD_DET_GRP,
									        ORD_DET_TIPO,
										    ORD_DET_CANT,
									        ORD_DET_DIAS,
					                        ORD_DET_MONTO,
					                        ORD_DET_VOLT,
   				                            ORD_DET_VOLP,
					                        ORD_DET_MED, 
									        ORD_DET_COMEN, 
									        ORD_DET_ESTADO, 
									        ORD_DET_USR_ALTA,
                                            ORD_DET_FCH_HR_ALTA,
                                            ORD_DET_USR_BAJA,
                                            ORD_DET_FCH_HR_BAJA
									        ) values ($nro_ord,
									                  $nro,
												      803,
												      1,
												      $n_via,
												      0,
												      $mon_803,
												      $s_vol,
												      0,
 											          1,
												  	  '$com_825',
												      2,
												      '$log_usr',
												      null,
												      null,
												     '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_detalle 803 1 : ' . mysql_error());
   }
 if ($_SESSION['mon_806'] >0) {
      $nro = $nro + 1;
      $consulta = "insert into ord_detalle (ORD_DET_ORD, 
                                            ORD_DET_NRO,
									        ORD_DET_GRP,
									        ORD_DET_TIPO,
										    ORD_DET_CANT,
									        ORD_DET_DIAS,
					                        ORD_DET_MONTO,
					                        ORD_DET_VOLT,
   				                            ORD_DET_VOLP,
					                        ORD_DET_MED, 
									        ORD_DET_COMEN, 
									        ORD_DET_ESTADO, 
									        ORD_DET_USR_ALTA,
                                            ORD_DET_FCH_HR_ALTA,
                                            ORD_DET_USR_BAJA,
                                            ORD_DET_FCH_HR_BAJA
									        ) values ($nro_ord,
									                  $nro,
												      806,
												      1,
												      0,
												      0,
												      $mon_806,
												      $t_806,
												      0,
 											          1,
												  	  '$com_825',
												      2,
												      '$log_usr',
												      null,
												      null,
												     '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_detalle 803 1 : ' . mysql_error());
   }  
   
//825
if ($_SESSION['mon_825'] > 0){
      $nro = $nro + 1;
      $consulta = "insert into ord_detalle (ORD_DET_ORD, 
                                            ORD_DET_NRO,
									        ORD_DET_GRP,
									        ORD_DET_TIPO,
										    ORD_DET_CANT,
									        ORD_DET_DIAS,
					                        ORD_DET_MONTO,
					                        ORD_DET_VOLT,
   				                            ORD_DET_VOLP,
					                        ORD_DET_MED, 
									        ORD_DET_COMEN, 
									        ORD_DET_ESTADO, 
									        ORD_DET_USR_ALTA,
                                            ORD_DET_FCH_HR_ALTA,
                                            ORD_DET_USR_BAJA,
                                            ORD_DET_FCH_HR_BAJA
									        ) values ($nro_ord,
									                  $nro,
												      825,
												      1,
												      0,
												      $c_825,
												      $mon_825,
												      $tipo,
												      0,
 											          1,
												  	  '$com_825',
												      2,
												      '$log_usr',
												      null,
												      null,
												     '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_detalle 825 1 : ' . mysql_error());
   }
//826
if ( $_SESSION['mon_826'] > 0) {
      $nro = $nro + 1;
      $consulta = "insert into ord_detalle (ORD_DET_ORD, 
                                            ORD_DET_NRO,
									        ORD_DET_GRP,
									        ORD_DET_TIPO,
										    ORD_DET_CANT,
									        ORD_DET_DIAS,
					                        ORD_DET_MONTO,
					                        ORD_DET_VOLT,
   				                            ORD_DET_VOLP,
					                        ORD_DET_MED, 
									        ORD_DET_COMEN, 
									        ORD_DET_ESTADO, 
									        ORD_DET_USR_ALTA,
                                            ORD_DET_FCH_HR_ALTA,
                                            ORD_DET_USR_BAJA,
                                            ORD_DET_FCH_HR_BAJA
									        ) values ($nro_ord,
									                  $nro,
												      826,
												      1,
												      0,
												      0,
												      $mon_826,
												      0,
												     0,
 											          0,
												  	  '$com_826',
												      2,
												      '$log_usr',
												      null,
												      null,
												     '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_detalle 826 1 : ' . mysql_error());
   }
   
  if ( $_SESSION['incremento'] > 0) {
      $nro = $nro + 1;
      $consulta = "insert into ord_detalle (ORD_DET_ORD, 
                                            ORD_DET_NRO,
									        ORD_DET_GRP,
									        ORD_DET_TIPO,
										    ORD_DET_CANT,
									        ORD_DET_DIAS,
					                        ORD_DET_MONTO,
					                        ORD_DET_VOLT,
   				                            ORD_DET_VOLP,
					                        ORD_DET_MED, 
									        ORD_DET_COMEN, 
									        ORD_DET_ESTADO, 
									        ORD_DET_USR_ALTA,
                                            ORD_DET_FCH_HR_ALTA,
                                            ORD_DET_USR_BAJA,
                                            ORD_DET_FCH_HR_BAJA
									        ) values ($nro_ord,
									                  $nro,
												      850,
												      1,
												      0,
												      0,
												      $incremento,
												      0,
												      null,
 											          0,
												  	  null,
												      2,
												      '$log_usr',
												      null,
												      null,
												     '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_detalle 826 1 : ' . mysql_error());
   } 
  if ( $_SESSION['descuento'] > 0) {
      $nro = $nro + 1;
	  $descuento =$descuento * -1;
      $consulta = "insert into ord_detalle (ORD_DET_ORD, 
                                            ORD_DET_NRO,
									        ORD_DET_GRP,
									        ORD_DET_TIPO,
										    ORD_DET_CANT,
									        ORD_DET_DIAS,
					                        ORD_DET_MONTO,
					                        ORD_DET_VOLT,
   				                            ORD_DET_VOLP,
					                        ORD_DET_MED, 
									        ORD_DET_COMEN, 
									        ORD_DET_ESTADO, 
									        ORD_DET_USR_ALTA,
                                            ORD_DET_FCH_HR_ALTA,
                                            ORD_DET_USR_BAJA,
                                            ORD_DET_FCH_HR_BAJA
									        ) values ($nro_ord,
									                  $nro,
												      860,
												      1,
												      0,
												      0,
												      $descuento,
												      0,
												      null,
 											          0,
												  	  null,
												      2,
												      '$log_usr',
												      null,
												      null,
												     '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_detalle 826 1 : ' . mysql_error());
   }   
     
   
   

 ?>
<table width="120%"  border="1" cellspacing="1" cellpadding="1" align="center">	 
<tr>
    <th align="center" width="25%" style="font-size:32px"> <?php echo $_SESSION['NOM_EMPRESA'];?> </th>
	<td align="left" width="40%" style="font-size:12px"><?php echo "SOLICITADO POR :".encadenar(2).$_SESSION['sol_por'];?> </td>
	<td align="left" width="20%"  style="font-size:12px"> <?php echo "CONTRATO";?> </td>
	<td align="center" width="35%" style="font-size:20px"> <?php echo "Nº ".encadenar(2).$nro_ord;?> </td>
</tr>
</table>
<table width="120%"  border="1" cellspacing="1" cellpadding="1" align="center">	 
  <tr>
    <td align="center" width="26%" style="font-size:14px"> <?php echo $_SESSION['TIPO_SERVIC'];?> </td>
	<td align="left" width="21%" style="font-size:10px"> <?php echo "TELEFONO DOM/CEL".encadenar(1).$_SESSION['fono'];?> </td>
	<td align="left" width="22%" style="font-size:10px"> <?php echo "TELEFONO OFI".encadenar(1).$_SESSION['celu'];?> </td>
	<td align="center" width="5%"style="font-size:12px"> <?php echo "DIA";?><br><strong><?php echo $dia;?></strong> </td>
	<td align="center" width="5%"style="font-size:12px"> <?php echo "MES";?><br><strong><?php echo $mes;?></strong> </td>
	<td align="center" width="5%"style="font-size:12px"> <?php echo "AÑO";?><br><strong><?php echo $anio;?></strong> </td>
	<td align="center" width="5%"style="font-size:10px"> <?php echo "AM";?><br><br><?php echo "PM";?></td>
	<td align="center" width="6%"style="font-size:9px"> <?php echo "EQUIPO";?><br><?php echo encadenar(2);?> </td>
	<td align="center" width="10%"style="font-size:9px"> <?php echo "TRABAJO Nº";?><br><?php echo encadenar(2);?> </td>
	<td align="center" width="15%"style="font-size:9px"> <?php echo "TIEMPO DE VIAJE";?><br> </td>
</table>
<table width="120%"  border="1" cellspacing="1" cellpadding="1" align="center">	 	
  </tr> 
   <tr>
    <td align="center" width="25%" style="font-size:12px" > <?php echo "De:" .encadenar(2).$_SESSION['GERENTE'];?>
	                                                            <br><?php echo $_SESSION['DIRECCION'];?>
														<br><?php echo "Telefonos".encadenar(2).$_SESSION['TELEFONOS'];?>
														<br><?php echo "Casilla".encadenar(2).$_SESSION['CASILLA'];?> </td>
    <td align="left" width="41%" style="font-size:12px" style="top:auto"> <?php echo "NOMBRE: CLIENTE/EMPRESA";?>
	                                       <br><strong><?php echo $_SESSION['nom_com'];?></strong><br><br><br></td>
	<td align="left" width="22%" style="font-size:12px"> <?php echo "AUTORIZADO POR:";?><br><br><br><br></td>
	<td align="left" width="6%" style="font-size:12px"> <?php echo "INICIO";?></td>
	<td align="left" width="24%" style="font-size:12px"> <?php echo "Hra. ".encadenar(1).$_SESSION['hra_ini'];?>
	                                                                                          <br><br><br><br></td>
	
  </tr> 
</table>  
<table width="120%"  border="1" cellspacing="1" cellpadding="1" align="center">	 	
  <tr>	
    <td align="center" width="25%" style="font-size:14px"> <?php echo $_SESSION['EMAIL'];?><BR>
	                                                      <?php echo "Cochabamba - Bolivia";?> </td>
	<td align="left" width="10%" style="font-size:10px"> <?php echo "FACTURA A:";?><br> </td>
	<td align="left" width="32%" style="font-size:12px"> <?php echo $_SESSION['fac_a'];?><br><BR><br></td>
	<td align="left" width="10%" style="font-size:12px"> <?php echo "NIT Nº:";?><br> </td>
	<td align="left" width="12%" style="font-size:12px"> <?php echo $_SESSION['nit'];?><br><br><br> </td>
	<td align="left" width="5%" style="font-size:12px"> <?php echo "CONCLU-";?><br>
	                                                   <?php echo "SION";?></td>
	<td align="left" width="24%" style="font-size:12px"> <?php echo "Hra. ".encadenar(1).$_SESSION['hra_fin'];?>
	                                                                                   <br><br><br><br></td>
  </tr>
  </table>  
<table width="120%"  border="1" cellspacing="1" cellpadding="1" align="center">	 	
                                 
   <tr>
    <td align="left" width="25%" style="font-size:10px" "text-align:justify"><strong><?php echo "ZONA ";?></strong>
	<?php echo encadenar(2).$_SESSION['barrio'].encadenar(2).$_SESSION['det_barr'];?><br> </td>
	<td align="left" width="51%" scope="col" style="font-size:10px"> <?php echo "DIRECCION:".
	                           encadenar(3).$_SESSION['direc'];?><br><br><br> </td>
	<td align="left" width="44%" style="font-size:12px"> <?php echo "CONFORMIDAD:";?><br><br><br></td>
	
  </tr> 
   </table>  
<table width="120%"  border="1" cellspacing="1" cellpadding="1" align="center">	 	 
  <tr>
    <td align="left" width="25%" style="font-size:14px"><?php echo "OPERADOR:".encadenar(2).$_SESSION['nom_ope'];?> </td>
	<td align="left" width="10%" style="font-size:10px"> <?php echo "FORMA DE PAGO:";?></td>
	<td align="left" width="15%" style="font-size:12px"> <?php echo $_SESSION['for_pag'];?> </td>
	<td align="center" width="26%"> <?php echo encadenar(12);?> </td>
	<td align="center" width="35%"> <?php echo encadenar(12);?> </td>
  </tr>  
 
  </table> 
  <?php
      $can_dias = $_SESSION['can_dias']; 	  
	  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 1 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
	  while ($lin802 = mysql_fetch_array($res_tser)) {
	  	     $desc1 = $lin802['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin802['GRAL_PAR_PRO_DESC'];
		     $_SESSION['desc1_802'] = $desc1;
		   } ?>
	<table width="120%" align="center" border="1">	    
    <tr>
        <th align="center">Servicio</th>
		<td align="center"><strong>Tipo  </strong></td>
		<td align="center"><strong>Cant. </strong></td>
		<td align="center"><strong>Tipo  </strong></td>
		<td align="center"><strong>Cant. </strong></td>
		<td align="center"><strong>Tipo  </strong></td>
		<td align="center"><strong>Cant. </strong></td>
		<td align="center"><strong>Nro. Dias</strong></td>
		<td align="center"><strong>Monto </strong></td>
	 </tr>
	 <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_802']; ?> </th>  
	    <td align="left"><strong>STD</strong></td>
  	    <td align="center"> <?php echo  $_SESSION['can_std'];?></td>
		<td align="left"><strong>I.P.</strong></td>
  	    <td align="center"> <?php echo  $_SESSION['can_ip'];?></td>
		<td align="left"><strong>V.I.P.</strong></td>
  	    <td align="center"> <?php echo  $_SESSION['can_vip'];?></td>
		<td align="center"> <?php echo  $_SESSION['can_dias'];?></td>
		<td align="right"> <?php echo number_format($_SESSION['mon_802'], 2, '.',',') ;?></td>
	 </tr>
	 </table>
     <table width="120%" align="center" border="1">
	  <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_801']; ?> </th> 
		<td align="center"><strong>Cantidad</strong></td>
		<td align="center"><?php echo $_SESSION['can_801']; ?></td>
		<td align="center"><strong>Nro. Dias </strong></td>
		<td align="center"><?php echo $_SESSION['dias_801']; ?></td>
		<td align="center"><strong>Monto  </strong></td>
		<td align="right"><?php echo number_format($_SESSION['mon_801'], 2, '.',','); ?></td>
	  </tr>
	  <table width="120%" align="center" border="1">
	  <tr>
	    <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_804']; ?> </th> 
		<td align="center"><strong>Cantidad</strong></td>
		<td align="center"><?php echo $_SESSION['can_804']; ?></td>
		<td align="center"><strong>Nro. Dias </strong></td>
		<td align="center"  ><?php echo $_SESSION['dias_804']; ?></td>
		<td align="center"><strong>Monto  </strong></td>
		<td align="right"><?php echo number_format($_SESSION['mon_804'], 2, '.',','); ?></td>
	  </tr>
	  </table>
	  <table width="120%" align="center" border="1">
	  <tr>
        <th width="40%" align="left" style="font-size:12px">
		<?php echo $_SESSION['desc1_803'].encadenar(47).$_SESSION['c_803_s']; ?> </th>
		<td width="15%" align="right"><?php echo encadenar(20). "mt3"; ?></td> 
		<td width="27%" ><?php echo"Succión de".encadenar(40)."mt3"; ?></td> 
		<td width="27%"><?php echo"A Bs.".encadenar(10); ?></td> 
	  </tr>
	 </table>
	 <table width="120%" align="center" border="1">
	  	<tr>
        <th width="40%" align="left" style="font-size:12px">
		<?php echo $_SESSION['desc1_806'].encadenar(45).$_SESSION['c_806_s']; ?> </th>
		<td width="80%" align="left" style="font-size:10px"><?php echo "CAPACIDAD EN LITROS:"; ?></td>  
	 </tr>	
	 </table>   
     <table width="120%" align="center" border="1">
       <tr>
        <th width="40%" align="left" style="font-size:12px">
		<?php echo $_SESSION['desc1_825'].encadenar(37).$_SESSION['c_825_s']; ?> </th>
		 <td width="25%" align="left" style="font-size:10px" ><?php echo "DEPENDIENDO DEL SISTEMA A SER USADO Bs."; ?></td>
		 <td width="10%" align="center"> <?php echo encadenar(12);?> </td>
		 <th width="10%" align="left" style="font-size:12px"><?php echo "Nº CAMARAS"; ?> </th>
		  <td width="5%" align="center"> <?php echo encadenar(5);?> </td>
		 <td width="20%" align="left"> <?php echo "Bs.".encadenar(15);?> </td>
	   </tr>
	   </table>   
     <table width="120%" align="center" border="1">
	 <tr>
        <th width="40%" align="left" style="font-size:12px">
		<?php echo $_SESSION['desc1_826'].encadenar(52).$_SESSION['c_826_s']; ?> </th> 
		<td width="80%" align="center"> <?php echo encadenar(12);?> </td>
	 </tr>
	 <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo "BK"; ?> </th> 
		<td width="80%" align="center"> <?php echo encadenar(12);?> </td>
	    </tr>
	 <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo "DESCUENTOS"; ?> </th> 
		<td width="80%" align="right"><?php echo number_format($_SESSION['descuento'], 2, '.',','); ?></td>
	 </tr>
	 <tr>
        <th width="40%" align="center" style="font-size:12px"><?php echo "T O T A L"; ?> </th> 
		<th width="80%" align="right"> <?php echo number_format
		                    ($_SESSION['total'] - $_SESSION['descuento'], 2, '.',',');?> </td>
	    </tr>
	<tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo "SERVICIOS ANTERIORES"; ?>
		    <br><br><br><br> </th> 
		<th width="80%" align="left" style="font-size:12px" style="text-align:justify">
		    <?php echo $_SESSION['recomen'];?><br><br><br><br> </td>
	    </tr>
		
		
	 </table>


 <?php
 // Impresion Comprobante Fondo Garantia
 /*
 $apli = 10000;
 $nro_tr_caj = leer_nro_co_cja($apli,$agen);
 $sum_debe_1 = 0;
 $sum_haber_1 = 0;
 $sum_debe_2 = 0;
 $sum_haber_2 = 0;
 
 $cons_212  = "Select * From temp_ctable where SUBSTRING(temp_nro_cta,1,3) = 111 and temp_tip_tra = 212";
 $resu_212  = mysql_query($cons_212);
 while ($lin_212 = mysql_fetch_array($resu_212)) {
       $sum_debe_1 = $sum_debe_1 + $lin_212['temp_debe_1'];
       $sum_haber_1 = $sum_haber_1 + $lin_212['temp_haber_1'];
	   $sum_debe_2 = $sum_debe_2 + $lin_212['temp_debe_2'];
       $sum_haber_2 = $sum_haber_2 + $lin_212['temp_haber_2'];
 }
 if ($sum_haber_1 > 0){
     $sum_haber_1 = $sum_haber_1 * -1;
	 $sum_haber_2 = $sum_haber_2 * -1;
	 }
  for ($i=1; $i < 3; $i = $i + 1 ) {
  if ($i == 1){
     $imp = $sum_debe_1;
	 $eqv = $sum_debe_2;
	 } 	 
  if ($i == 2){
     $imp = $sum_haber_1;
	 $eqv = $sum_haber_2;
	 } 	
 $consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
                                       CAJA_TRAN_AGE_CJRO,
									   CAJA_TRAN_AGE_ORG,
									   CAJA_TRAN_COD_SC,
									   CAJA_TRAN_FECHA,
					                   CAJA_TRAN_CAJERO1,
					                   CAJA_TRAN_APL_ORG,
   				                       CAJA_TRAN_TIPO_OPE,
					                   CAJA_TRAN_NRO_DOC, 
									   CAJA_TRAN_NRO_CAR, 
									   CAJA_TRAN_NRO_FON, 
									   CAJA_TRAN_CAJERO2,
                                       CAJA_TRAN_APL_DES,
                                       CAJA_TRAN_DOC_EQUIV,
                                       CAJA_TRAN_VIA_PAG,
                                       CAJA_TRAN_REL_FAC,
                                       CAJA_TRAN_DEB_CRED,
									   CAJA_TRAN_CTA_CONT,
                                       CAJA_TRAN_IMPORTE,
                                       CAJA_TRAN_IMP_EQUIV,
                                       CAJA_TRAN_MON,
                                       CAJA_TRAN_TIP_CAMB,
                                       CAJA_TRAN_DESCRIP,
                                       CAJA_TRAN_USR_ALTA,
                                       CAJA_TRAN_FCH_HR_ALTA,
									   CAJA_TRAN_USR_BAJA,
									   CAJA_TRAN_FCH_HR_BAJA
									   ) values ($nro_tr_caj,
									             $agen,
												 $agen,
												 $nro_ctaf,
												 '$f_tra',
												 '$log_usr',
												 10000,
												 1,
												 $nro_tr_caj,
												 $nro_tr_cart,
												 $nro_tr_fond,
												 '$log_usr',
												 11000,
												 null,
												 null,
 											     null,
												 null,
												 null,
												 $imp,
												 $eqv,
												 $mon,
												 $tc_ctb,
												 'DEPOSITO FONDO GARANTIA INICIO',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());

}

$nro_tr_ingegr = leer_nro_co_ingegr($agen); 
$cons_519  = "Select * From temp_ctable where temp_tip_tra = 519";
$resu_519  = mysql_query($cons_519);
  
 while ($lin_519 = mysql_fetch_array($resu_519)) {
       if ($lin_519['temp_debe_1'] > 0){
	       $deb_hab = 1;
		   }	
	  if ($lin_519['temp_haber_1'] > 0){
	       $deb_hab = 2;
		   } 
	$tipo = 3;
	$cta_ctbg = $lin_519['temp_nro_cta'];
    $imp_or = $lin_519['temp_debe_1'] + $lin_519['temp_haber_1'];
		   
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$f_tra',
												 'COMISION DESEMBOLSO',
												 1,
												 $imp_or,
												 $imp_or,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  2: ' . mysql_error()); 
   
	   
 }
 
 
 
 
 	 
 echo encadenar(2).$emp_nom.encadenar(41)."Cochabamba".encadenar(3).$_SESSION['fec_proc'];
	 
     ?>
<br>
<?php

echo encadenar(2).$emp_dir.encadenar(40)."Cbte  Caja  Nro.".encadenar(8).$nro_tr_caj;
?>
<br>
<?php

echo encadenar(76)."Cbte Fondo Gar. Nro.".encadenar(5).$nro_tr_fond;
?>
<br><br>
<?php



echo encadenar(15)."DEPOSITO DE GARANTIA INICIO"; 
?>
<br><br>
 <?php  
     echo encadenar(2)."Solicitud".encadenar(2).$cod_sol.encadenar(50)."Nro. Cuenta".encadenar(2).$nro_ctaf;  
 ?>
<br>
__________________________________________________________
 </strong><br>
	 
	 <?php 
	 echo encadenar(2)."Cajero".encadenar(9).$_SESSION['nombres'].encadenar(35)."Asesor ".encadenar(3).$_SESSION['nombres'];
	 ?>
	 <br>
	 
	 <?php
	 if ($t_op < 3){
	    echo encadenar(2)."Grupo".encadenar(9).$nom_grup;
	 
	 ?>
	 <br>
	  <?php 
	 echo encadenar(2)."Presidente".encadenar(3).$nom_pdte;
	 }
	 ?>
	 <br>
     __________________________________________________________
  	 <br>
	 <?php
 // if ($comif == 2){
 //   	$impsc = $imp_sc ;
//		}
//	if ($comif == 1){
 //   	$impsc = $impo ;
//		}	
//	$imposc = number_format($impsc, 2, '.',',');  
  
    // echo encadenar(2)."Deposito Inicio ".encadenar(50).$imposc.encadenar(3).$s_mon;   
 ?> 
	<br>
	 <?php 
//	 $impc = $imp_c ;
//	$impoc = number_format($impc, 2, '.',','); 
//	 echo encadenar(2)."Comision".encadenar(71)."(".$impoc.")".encadenar(3).$s_mon; 
	
	?>
	<br>
	 <?php 
	$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	$imp_fg = 0;
    while ($linea = mysql_fetch_array($resultado)) {
           $imp_fg = $imp_fg + $linea['CRED_DEU_AHO_INI'];
	  }
	 $impfg = number_format($imp_fg, 2, '.',',');  
	echo encadenar(2)."Fondo Garantia Inicio".encadenar(51).$impfg.encadenar(3).$s_mon; 	
	
	?>
	<br>
	<?php 
	echo encadenar(80)."_______________ ";
	?>
	<BR><strong>
	 <?php 
	// $mon_desem = $impsc - $imp_c - $imp_fg;
	// $mon_dese = number_format($mon_desem, 2, '.',','); 
	// echo encadenar(8)." MONTO A DESEMBOLSAR EFECTIVO ".encadenar(5).$mon_dese.encadenar(3).$s_mon;
	 ?>
	 <br><br>
	 <?php
	 echo encadenar(8)." MONTO DEPOSITO FONDO GARANTIA".encadenar(5);
	 ?>
	 <br><br>
	 <?php
	 $mon_fond = f_literal($impfg,1);
	 echo encadenar(8).$mon_fond.encadenar(3).$s_mon;
	 ?>
	<BR>
    </strong>
  
  <br><br><br><br>
  <?php
  
  echo encadenar(5)."_____________________", encadenar(15),"_____________________";
  ?>
  <br>
 <?php
  
  echo encadenar(12)."INTERESADO", encadenar(40),"     CAJERO";
  */
  ?>



<?php
ob_end_flush();
 ?>
 
                      