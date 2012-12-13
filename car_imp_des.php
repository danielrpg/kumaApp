<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
require('configuracion.php');
    require('funciones.php');
	require('funciones2.php');
	$tc_ctb  = $_SESSION['TC_CONTAB'];	
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='menu_s.php'>Salir</a>
  </div>

<br><br>

<?php	
	
	//Datos empresa		  
		 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp)or die('No pudo seleccionarse tabla gral_empresa');
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
		  
?>
<br><br>
<strong> 
<?php
if(isset($_SESSION['fec_proc'])){ 
  $fec_p = $_SESSION['fec_proc']; 
  }
if(isset($_SESSION['login'])){   
   $log_usr = $_SESSION['login']; 
   }
if(isset($_SESSION["impo_sol"])){  
   $imp_sol = $_SESSION["impo_sol"];
}
if(isset($_SESSION['nro_sol'])){ 
   $cod_sol = $_SESSION['nro_sol'];
}
$total = 0;
$f_tra = cambiaf_a_mysql_2($fec_p);
//echo $fec_p, $f_tra;
$_SESSION['msg_err'] = " ";
//$log_usr = $_SESSION['login'];
if(isset($_POST['cod_cta1'])){  
   $cod_cta1 = $_POST['cod_cta1'];
   }
if(isset($_POST['cod_cta1'])){    
   $cod_cta2 = $_POST['cod_cta2'];
   }
$error_d = 0;
$cod_sol = $_SESSION['nro_sol'];
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 1');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $grupo = $lin_sol['CRED_SOL_COD_GRUPO'];
		 $agen = $lin_sol['CRED_SOL_COD_AGE'];
		 $hr_reu = $lin_sol['CRED_SOL_HRA_REU'];
		 $dia_reu = $lin_sol['CRED_SOL_DIA_REU'];
		 $dir_reu = $lin_sol['CRED_SOL_DIR_REU'];
		 $f_des  = $lin_sol['CRED_SOL_FEC_DES'];
		 $f_uno  = $lin_sol['CRED_SOL_FEC_UNO'];
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER'];
		 $cod_grupo = $lin_sol['CRED_SOL_COD_GRUPO'];
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $imp_c = $lin_sol['CRED_SOL_IMP_COM'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $imp_sc = $impo + $imp_c;
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $orgf = $lin_sol['CRED_SOL_ORG_FON'];
		 $plzm  = $lin_sol['CRED_SOL_PLZO_M'];
		 $plzd  = $lin_sol['CRED_SOL_PLZO_D'];
		 $cuotas = $lin_sol['CRED_SOL_NRO_CTA'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $f_pag  = $lin_sol['CRED_SOL_FORM_PAG']; 
		 $tint  = $lin_sol['CRED_SOL_TASA'];
		 $c_int = $lin_sol['CRED_SOL_CAL_INT']; 
		 $com_f  = $lin_sol['CRED_SOL_COM_F'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $prod = $lin_sol['CRED_SOL_PRODUCTO'];
		 $aho_f  = $lin_sol['CRED_SOL_AHO_F'];
		 $aho_fm  = $lin_sol['CRED_SOL_AHO_DM'];
		 $f_des2= cambiaf_a_normal($f_des); 
		 $f_uno2= cambiaf_a_normal($f_uno); 
		 $dia = saca_dia($f_uno2);
		 $mes = saca_mes($f_uno2);
		 $ano = saca_anio($f_uno2);
		 $dia_p = dia_semana ($dia, $mes, $ano);
   }
  //Lectura Parametros
	   $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
       $res_cin = mysql_query($con_cin)or die('No pudo seleccionarse tabla 2');
	   while ($linea = mysql_fetch_array($res_cin)) {
	        $d_cin = $linea['GRAL_PAR_INT_DESC'];
	   }
       $con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_op";
       $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla 3');
	   while ($linea = mysql_fetch_array($res_top)) {
	        $d_top = $linea['GRAL_PAR_INT_DESC'];
	   }
	   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 4');
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
			$s_mon = $linea['GRAL_PAR_INT_SIGLA'];
	   }
         $con_ahod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 912 and                     GRAL_PAR_PRO_COD = $ahod ";
         $res_ahod = mysql_query($con_ahod)or die('No pudo seleccionarse tabla 5');
		  while ($lin_ahod = mysql_fetch_array($res_ahod)) {
		        $aho_d = $lin_ahod['GRAL_PAR_PRO_DESC'];
		  } 
          $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 6');
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
		  } 
if ($comi < 3){
    $con_comf  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD = $com_f ";
    $res_comf = mysql_query($con_comf)or die('No pudo seleccionarse tabla 7');
	while ($lin_comf = mysql_fetch_array($res_comf)) {
	      $comi_f  = $lin_comf['GRAL_PAR_PRO_CTA1'];
	}
  }
 if ($ahod == 1){
    $con_ahof  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 914 and GRAL_PAR_PRO_COD = $aho_f ";
    $res_ahof = mysql_query($con_ahof)or die('No pudo seleccionarse tabla 8');
	while ($lin_ahof = mysql_fetch_array($res_ahof)) {
	      $aho_fa  = $lin_ahof['GRAL_PAR_PRO_CTA1'];
		  $aho_fd  = $lin_ahof['GRAL_PAR_PRO_DESC'];
	}
  }
  //leer grupo
   if ($t_op < 3){
       $con_grup  = "Select * From cred_grupo where CRED_GRP_CODIGO = $cod_grupo and CRED_GRP_USR_BAJA is null";
       $res_grup = mysql_query($con_grup)or die('No pudo seleccionarse cred_grupo');
	   while ($lin_grup = mysql_fetch_array($res_grup)) {
	          $nom_grup  = $lin_grup['CRED_GRP_NOMBRE'];
	   }
	   $con_pdte  = "Select * From cred_grupo_mesa where CRED_GRP_MES_COD = $cod_grupo and  CRED_GRP_MES_REL = 1 and CRED_GRP_MES_USR_BAJA is null";
       $res_pdte = mysql_query($con_pdte)or die('No pudo seleccionarse cred_grupo_mesa');
	   while ($lin_pdte = mysql_fetch_array($res_pdte)) {
	          $cod_pdte  = $lin_pdte['CRED_GRP_MES_CLI'];
	   }
if(isset($cod_pdte)){  	   
	  $consulta  = "Select CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general  where  CLIENTE_COD = $cod_pdte and CLIENTE_USR_BAJA is null";
      $resultado = mysql_query($consulta)or die('No pudo seleccionarse pdte_grupo'); 
	  while ($linea = mysql_fetch_array($resultado)) {
    	    $nom_pdte = $linea['CLIENTE_NOMBRES']." ".$linea['CLIENTE_AP_PATERNO']." ".$linea['CLIENTE_AP_MATERNO'];
	     }
   	  }
	}
//Correlativos transaccion

$r = "";
$nro_cre = leer_nro_credito($agen);

$n = strlen($nro_cre);
$n2 = 4 - $n;
$nro_c = "";
$nro_cred = 0;
$nro_ctaf = 0;
$nro_ctf = 0;

if(isset($r)){ 
   for ($i = 1; $i <= $n2; $i++) {
    $r = $r."0";
    }
$nro_cred = "9".$agen."0".$t_op.$r.$nro_cre;
//echo $nro_c," ",$agen," ", $t_op," ",$r," ",$nro_cre;

$r = ""; 
$nro_ctf = leer_nro_ctafon($agen);
$n = strlen($nro_ctf);
$n2 = 4 - $n;
for ($i = 1; $i <= $n2; $i++) {
    $r = $r."0";
    }  
$nro_ctaf = "7".$agen.$r.$nro_ctf;
}
//echo $nro_ctf," ",$agen," ",$r," ",$nro_cre," ",$nro_ctaf;
//echo $agen;
 $apli = 10000;
 $nro_tr_caj = leer_nro_co_cja($apli,$agen);
 $nro_tr_cart = leer_nro_co_car(1,$agen); 
 if ($ahoi > 0){
     $nro_tr_fond = leer_nro_co_fon(1,$agen); 
	 }else{
	 $nro_tr_fond = 0;
	 } 
 $imp = 0;
 $eqv = 0;
 //Grabar Tablas
 //Caja
 $sum_debe_1 = 0;
 $sum_haber_1 =0;
 $sum_debe_2 = 0;
 $sum_haber_2 = 0;
 $cons_131  = "Select * From temp_ctable where SUBSTRING(temp_nro_cta,1,3) = 111 ";
 $resu_131  = mysql_query($cons_131);
 while ($lin_131 = mysql_fetch_array($resu_131)) {
       $sum_debe_1 = $lin_131['temp_debe_1'];
       $sum_haber_1 = $lin_131['temp_haber_1'];
	   $sum_debe_2 = $lin_131['temp_debe_2'];
       $sum_haber_2 = $lin_131['temp_haber_2'];
 
 if ($sum_haber_1 > 0){
     $sum_haber_1 = $sum_haber_1 * -1;
	 $sum_haber_2 = $sum_haber_2 * -1;
	 }
 // for ($i=1; $i < 3; $i = $i + 1 ) {
  //if ($i == 1){
     $imp = $sum_debe_1 + $sum_haber_1;
	 $eqv = $sum_debe_2 + $sum_haber_2;
//	 } 	 
 // if ($i == 2){
 //    $imp = $sum_haber_1;
//	 $eqv = $sum_haber_2;
//	 }
//}	  	
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
												 $nro_cred,
												 '$f_tra',
												 '$log_usr',
												 10000,
												 1,
												 $nro_tr_caj,
												 $nro_tr_cart,
												 $nro_tr_fond,
												 '$log_usr',
												 6000,
												 null,
												 null,
 											     null,
												 null,
												 null,
												 $imp,
												 $eqv,
												 $mon,
												 $tc_ctb,
												 'DESEMBOLSO CREDITO',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());

}
//Fondo Garantia
 if ($ahoi > 0){
 $consulta = "insert into fond_cabecera (FOND_CAB_NCTA, 
                                         FOND_CAB_AGEN,
									     FOND_CAB_NRO_TRAN,
									     FOND_CAB_TRAN_CAJ,
										 FOND_CAB_TRAN_CAR,
									     FOND_CAB_FECHA,
					                     FOND_CAB_TIP_TRAN,
					                     FOND_CAB_EST_ANT,
   				                         FOND_CAB_EST_ACT,
					                     FOND_CAB_TIP_CAM, 
									     FOND_CAB_FEC_TRAN, 
									     FOND_CAB_FEC_VTO, 
									     FOND_CAB_FEC_SUS,
                                         FOND_CAB_USR_ALTA,
                                         FOND_CAB_FCH_HR_ALTA,
                                         FOND_CAB_USR_BAJA,
                                         FOND_CAB_FCH_HR_BAJA
									    ) values ($nro_ctaf,
									             $agen,
												 $nro_tr_fond,
												 $nro_tr_caj,
												 $nro_tr_cart,
												 '$f_tra',
												 1,
												 null,
												 null,
 											     $tc_ctb,
												 '$f_tra',
												 null,
												 null,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar fon_cabecera : ' . mysql_error());
$con_fon  = "Select * From temp_ctable where temp_tip_tra = 212 and SUBSTRING(temp_nro_cta,1,3) = 212 ";
 $res_fon = mysql_query($con_fon)or die('No pudo selecionar temp_ctable 212 : ' . mysql_error());    ;
 while ($lin_fon = mysql_fetch_array($res_fon)) {
       $imp_debe_1 = $lin_fon['temp_debe_1'];
       $imp_haber_1 = $lin_fon['temp_haber_1'];
	   $imp_debe_2 = $lin_fon['temp_debe_2'];
       $imp_haber_2 = $lin_fon['temp_haber_2'];
	   $cta = $lin_fon['temp_nro_cta'];
 //echo $cta, "cta";
if ($mon == 1){
 if ($imp_debe_1 > 0){
     $imp = $imp_debe_1;
	 $eqv = $imp_debe_1;
	 $d_h = 1;
	 }
 if ($imp_haber_1 > 0){
     $imp = $imp_haber_1;
	 $eqv = $imp_haber_1;
	 $d_h = 2;
	 }
}	
if ($mon == 2){
 if ($imp_debe_1 > 0){
     $imp = $imp_debe_1;
	 $eqv = $imp_debe_1 * $_SESSION['TC_CONTAB'];
	 $d_h = 1;
	 }
 if ($imp_haber_1 > 0){
     $imp = $imp_haber_1;
	 $eqv = $imp_haber_1 * $_SESSION['TC_CONTAB'];
	 $d_h = 1;
	 }
}	

 
	// echo $nro_tr_cart, "tra_c" ,$f_tra, "f_tra",$cta;
	$consulta = "insert into fond_det_tran(FOND_DTRA_NCTA, 
                                           FOND_DTRA_AGEN,
										   FOND_DTRA_NCRE,
									       FOND_DTRA_NRO_TRAN,
										   fOND_DTRA_NRO_CTA,
									       FOND_DTRA_FECHA,
					                       FOND_DTRA_TIP_TRAN,
   				                           FOND_DTRA_CCON,
					                       FOND_DTRA_DEB_CRE, 
									       FOND_DTRA_CTA_CBT, 
									       FOND_DTRA_IMPO, 
									       FOND_DTRA_IMPO_BS,
                                           FOND_DTRA_FEC_TRAN,
                                           FOND_DTRA_FEC_INI2,
                                           FOND_DTRA_FEC_FIN,
                                           FOND_DTRA_TASA,
										   FOND_DTRA_EST_ANT,
										   FOND_DTRA_VIA,
										   FOND_DTRA_TIP_CAM,
										   FOND_DTRA_USR_ALTA,
										   FOND_DTRA_FCH_HR_ALTA,
										   FOND_DTRA_USR_BAJA,
										   FOND_DTRA_FCH_HR_BAJA
									       ) values ($nro_ctaf,
									                 $agen,
													 $nro_cred,
												     $nro_tr_fond,
													 1,
													 '$f_tra',
												     1,
												     212,
													 $d_h,
												     '$cta',
													 $imp,
													 $eqv,
 											     	 '$f_tra',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar fon_cabecera : ' . mysql_error()); 
 }
}
//Cartera
// if ($ahoi > 0){
 $consulta = "insert into cart_cabecera (CART_CAB_NCRE, 
                                         CART_CAB_AGEN,
									     CART_CAB_NRO_TRAN,
									     CART_CAB_TRAN_CAJ,
										 CART_CAB_TRAN_FON,
									     CART_CAB_FECHA,
					                     CART_CAB_TIP_TRAN,
					                     CART_CAB_EST_ANT,
   				                         CART_CAB_EST_ACT,
					                     CART_CAB_TIP_CAM, 
									     CART_CAB_FEC_TRAN, 
									     CART_CAB_FEC_VTO, 
									     CART_CAB_FEC_SUS,
                                         CART_CAB_USR_ALTA,
                                         CART_CAB_FCH_HR_ALTA,
                                         CART_CAB_USR_BAJA,
                                         CART_CAB_FCH_HR_BAJA
									    ) values ($nro_cred,
									             $agen,
												 $nro_tr_cart,
												 $nro_tr_caj,
												 $nro_tr_fond,
												 '$f_tra',
												 1,
												 null,
												 3,
 											     $tc_ctb,
												 '$f_tra',
												 null,
												 null,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar fon_cabecera : ' . mysql_error());
$con_car  = "Select * From temp_ctable ";
$res_car = mysql_query($con_car)or die('No pudo selecionar temp_ctable 212 : ' . mysql_error());    ;
 while ($lin_car = mysql_fetch_array($res_car)) {
       $imp_debe_1 = $lin_car['temp_debe_1'];
       $imp_haber_1 = $lin_car['temp_haber_1'];
	   $imp_debe_2 = $lin_car['temp_debe_2'];
       $imp_haber_2 = $lin_car['temp_haber_2'];
	   $cta = $lin_car['temp_nro_cta'];
	   $tip = $lin_car['temp_tip_tra'];
	   
	       $ccon = substr($cta, 0, 3);  
		   
 //echo $cta, "cta";
if ($mon == 1){
 if ($imp_debe_1 > 0){
     $imp = $imp_debe_1;
	 $eqv = $imp_debe_1;
	 $d_h = 1;
	 }
 if ($imp_haber_1 > 0){
     $imp = $imp_haber_1;
	 $eqv = $imp_haber_1;
	 $d_h = 2;
	 }
} 
if ($mon == 2){
 if ($imp_debe_1 > 0){
     $imp = $imp_debe_1;
	 $eqv = $imp_debe_2;
	 $d_h = 1;
	 }
 if ($imp_haber_1 > 0){
     $imp = $imp_haber_1;
	 $eqv = $imp_haber_2;
	 $d_h = 2;
	 }
} 
	// echo $nro_tr_cart, "tra_c" ,$f_tra, "f_tra",$cta;
	$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($nro_cred,
									                 $agen,
												     $nro_tr_cart,
													 0,
													 '$f_tra',
												     1,
												     $ccon,
													 $d_h,
												     '$cta',
													 $imp,
													 $eqv,
 											     	 '$f_tra',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar fon_cabecera : ' . mysql_error()); 
 }
// Maestro Cartera
  $consulta = "insert into cart_maestro (CART_NRO_CRED,
                                         CART_NUMERICO,
                                         CART_NRO_CRED_ANT,
										 CART_NRO_SOL,
										 CART_COD_AGEN, 
										 CART_COD_GRUPO, 
										 CART_HR_REU,
										 CART_DIA_REU,
										 CAR_DIR_REU,
										 CART_TIPO_CRED,
										 CART_TIPO_OPER,
										 CART_FEC_DES,
										 CART_FEC_UNO,
										 CART_IMPORTE,
										 CART_IMP_COM,
										 CART_COD_MON,
										 CART_AHO_INI, 
										 CART_AHO_DUR, 
										 CART_ORG_FON, 
										 CART_NRO_CTAS, 
										 CART_PLZO_M, 
										 CART_PLZO_D, 
										 CART_FORM_PAG, 
										 CART_NRO_LINEA, 
										 CART_TASA, 
										 CART_TIP_COM, 
										 CART_PER_GRA, 
										 CART_PRODUCTO, 
										 CART_SECTOR, 
										 CART_SUB_SECTOR, 
										 CART_DEPTO, 
										 CART_PROV, 
										 CART_CAL_INT, 
										 CART_OFIC_RESP, 
										 CART_USR_AUT, 
										 CART_FCH_AUT, 
										 CART_FCH_CAN, 
										 CART_QUIEN_PAG, 
										 CART_DEST_CRED, 
										 CART_ESTADO,
										 CART_MAE_USR_ALTA, 
										 CART_MAE_FCH_HR_ALTA, 
										 CART_MAE_USR_BAJA, 
										 CART_MAE_FCH_HR_BAJA) 
										 values ($nro_cred,
										         $nro_cre,
										         null,
												 $cod_sol,
												 $agen, 
										         '$grupo', 
                                                 '$hr_reu',
                                                 '$dia_reu',
                                                 '$dir_reu',
												 1,
												 $t_op,
                                                 '$f_des',
                                                 '$f_uno',
                                                 $impo, 
                                                 $imp_c,
                                                 $mon,
												 $ahoi,
		                                         $ahod,
												 $orgf,
												 $cuotas,
												 $plzm,
                                                 $plzd,	
												 $f_pag,
												 null,
												 $tint,
												 $com_f,
												 null,
												 $prod,
												 null,
												 null,
												 null,
												 null,
												 $c_int,
												 '$log_usr',
												 null,
												 null,
												 null,
												 null,
												 null,
												 3,
												 '$log_usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar : cart_maestro ' . mysql_error());
// Maestro Fondo Garantia
$consulta = "insert into fond_maestro (FOND_NRO_CTA,
                                         FOND_NUMERICO,
                                         FOND_NRO_CTA_ANT,
										 FOND_NRO_SOL,
										 FOND_NRO_CRED, 
										 FOND_COD_AGEN, 
										 FOND_COD_GRUPO, 
										 FOND_TIPO_OPER,
										 FOND_COD_MON,
										 FOND_PLZO_M, 
										 FOND_PLZO_D, 
										 FOND_TASA, 
										 FOND_TIP_COM, 
										 FOND_PRODUCTO, 
										 FOND_OFIC_RESP, 
										 FOND_FCH_CAN, 
										 FOND_ESTADO,
										 FOND_MAE_USR_ALTA, 
										 FOND_MAE_FCH_HR_ALTA, 
										 FOND_MAE_USR_BAJA, 
										 FOND_MAE_FCH_HR_BAJA) 
										 values ($nro_ctaf,
										         $nro_ctf,
										         null,
												 $cod_sol,
												 $nro_cred,
												 $agen, 
										         '$grupo', 
                                                 $t_op,
                                                 $mon,
                                                 $plzm,
                                                 $plzd,	
												 null,
												 null,
												 $prod,
												 '$log_usr',
												 null,
												 3,
												 '$log_usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar : fond_maestro ' . mysql_error()); 
 //cart_deudor, fond_deudor
$con_deu  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null ";
    $res_deu = mysql_query($con_deu);
while ($lin_deu = mysql_fetch_array($res_deu)) {
      $dsol = $lin_deu['CRED_SOL_CODIGO'];
      $drel = $lin_deu['CRED_DEU_RELACION'];
	  $dint = $lin_deu['CRED_DEU_INTERNO'];
	  $did  = $lin_deu['CRED_DEU_ID'];
	  $imp  = $lin_deu['CRED_DEU_IMPORTE'];
	  $com  = $lin_deu['CRED_DEU_COMISION'];
	  $ini  = $lin_deu['CRED_DEU_AHO_INI'];
	  $dur  = $lin_deu['CRED_DEU_AHO_DUR'];
	  $cta  = $lin_deu['CRED_DEU_INT_CTA'];
//cart_deudor	
      
	  $con_cdeu = "insert into cart_deudor (CART_DEU_NCRED, 
                                         CART_DEU_SOL,
										 CART_DEU_RELACION,
										 CART_DEU_INTERNO, 
										 CART_DEU_ID,
										 CART_DEU_IMPORTE,
										 CART_DEU_COMI,
										 CART_DEU_AHO_INI,
										 CART_DEU_AHO_DUR,
										 CART_DEU_INT_CTA,
										 CART_DEU_USR_ALTA, 
										 CART_DEU_FCH_HR_ALTA, 
										 CART_DEU_USR_BAJA, 
										 CART_DEU_FCH_HR_BAJA) 
										 values ($nro_cred,
										         $cod_sol,
												 '$drel',
												 $dint,
												 '$did',
												 $imp,
												 $com,
												 $ini,
												 $dur,
												 $cta,
												 '$log_usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$res_cdeu = mysql_query($con_cdeu)or die('No pudo insertar : cart_deudor ' . mysql_error()); 
//fond_cliente
if ($drel == "C"){
	$drel = "T";
	}  	  
  $con_ccli = "insert into fond_cliente (FOND_CLI_NCTA, 
                                         FOND_CLI_SOL,
										 FOND_CLI_RELACION,
										 FOND_CLI_INTERNO, 
										 FOND_CLI_ID, 
										 FOND_CLI_USR_ALTA, 
										 FOND_CLI_FCH_HR_ALTA, 
										 FOND_CLI_USR_BAJA, 
										 FOND_CLI_FCH_HR_BAJA) 
										 values ($nro_ctaf,
										         $cod_sol,
												 '$drel',
												 $dint,
												 '$did',
												 '$log_usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$res_ccli = mysql_query($con_ccli)or die('No pudo insertar : cart_deudor ' . mysql_error()); 
}
//cart_plandp
  $nro_cta  = 0;
  $con_pld  = "Select CRED_PLD_FECHA, sum(CRED_PLD_CAPITAL), sum(CRED_PLD_INTERES), sum(CRED_PLD_AHORRO) From
              cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null group by CRED_PLD_FECHA";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
    $res_pld = mysql_query($con_pld)or die('No pudo leer : cred_plandp ' . mysql_error()) ;
	while ($lin_pld = mysql_fetch_array($res_pld)) {
	      $nro_cta = $nro_cta + 1;
	      $fec_pld = $lin_pld['CRED_PLD_FECHA'];
		  $cap_pld = $lin_pld['sum(CRED_PLD_CAPITAL)'];
		  $int_pld = $lin_pld['sum(CRED_PLD_INTERES)'];
		  $aho_pld = $lin_pld['sum(CRED_PLD_AHORRO)'];
		  //echo $fec_pld, $cap_pld,$int_pld,$aho_pld;
  $ins_pldp = "insert into cart_plandp(CART_PLD_NCRE, 
                                       CART_PLD_SOL,
									   CART_PLD_CTA,
									   CART_PLD_FECHA,
									   CART_PLD_CAPITAL, 
									   CART_PLD_INTERES, 
									   CART_PLD_AHORRO,
									   CART_PLD_STAT,
									   CART_PLD_USR_ALTA, 
									   CART_PLD_FCH_HR_ALTA, 
									   CART_PLD_USR_BAJA,
									   CART_PLD_FCH_HR_BAJA) 
										 values ($nro_cred,
										         $cod_sol,
												 $nro_cta,
												 '$fec_pld',
												 $cap_pld,
												 $int_pld,
												 $aho_pld,
												 'P', 
												 '$log_usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$res_pldp = mysql_query($ins_pldp)or die('No pudo insertar : cart_plandp ' . mysql_error()); 
	}
 //Actualizacion de cred_solicitud
   $act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=8, CRED_SOL_NRO_CRED =$nro_cred  where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null";
   $res_act_s = mysql_query($act_cred_solic) or die('No pudo actualizar cred_solicitud : ' . mysql_error());
 // Impresion Comprobante Cartera
 echo encadenar(2).$emp_nom.encadenar(41)."Cochabamba".encadenar(3).$_SESSION['fec_proc'];
     ?>
<br>
<?php
echo encadenar(2).$emp_dir.encadenar(40)."Cbte  Caja  Nro.".encadenar(8).$nro_tr_caj;
?>
<br>
<?php
echo encadenar(76)."Cbte Cartera Nro.".encadenar(6).$nro_tr_cart;
?>
<br><br>
<?php
echo encadenar(25)."DESEMBOLSO  DE  CREDITO"; 
?>
<br><br>
 <?php  
     echo encadenar(2)."Solicitud".encadenar(2).$cod_sol.encadenar(50)."Nro. Credito".encadenar(2).$nro_cred;  
 ?>
<br>
_____________________________________________________
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
  if ($comif == 2){
    	$impsc = $imp_sc ;
		}
	if ($comif == 1){
    	$impsc = $impo ;
		}	
	$imposc = number_format($impsc, 2, '.',',');  
  
     echo encadenar(2)."Desembolso a Capital".encadenar(50).$imposc.encadenar(3).$s_mon;   
 ?> 
	<br>
	 <?php 
	 $impc = $imp_c ;
	$impoc = number_format($impc, 2, '.',','); 
	 echo encadenar(2)."Comision".encadenar(71)."(".$impoc.")".encadenar(3).$s_mon; 
	
	?>
	<br>
	 <?php 
	//$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
    //$resultado = mysql_query($consulta);
   // while ($linea = mysql_fetch_array($resultado)) {
   //        $imp_fg = $imp_fg + $linea['CRED_DEU_AHO_INI'];
	//  }
	// $impfg = number_format($imp_fg, 2, '.',',');  
	//echo encadenar(2)."Fondo Garantia Inicio".encadenar(51)."(".$impfg.")".encadenar(3).$s_mon; 	
	
	?>
	<br>
	<?php 
	echo encadenar(80)."_______________ ";
	?>
	<BR><strong>
	 <?php 
	 $mon_desem = $impsc - $imp_c;
	 $mon_dese = number_format($mon_desem, 2, '.',','); 
	 echo encadenar(8)." MONTO A DESEMBOLSAR EFECTIVO ".encadenar(5).$mon_dese.encadenar(3).$s_mon;
	 ?>
	 <br><br>
	 <?php
	 $mon_des = f_literal($mon_desem,1);
	 echo encadenar(8).$mon_des.encadenar(3).$s_mon;
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
  ?>


<br><br><br><br><br>
<strong>Nota:</strong> No valido como Credito Fiscal
<br>
 <?php
  
  echo encadenar(10)."Antes de firmar verifique los datos";
  ?>
<br><br>
<strong> 
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
*/
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
  ?>


<br><br><br><br><br>
<strong>Nota:</strong> No valido como Credito Fiscal
<br>
 <?php
  
  echo encadenar(10)."Antes de firmar verifique los datos";
  ?>
<?php
ob_end_flush();
 ?>
 
                      