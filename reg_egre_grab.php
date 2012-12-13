<?php
   ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
	require('funciones2.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>
	<div id="cuerpoModulo">
	<?php
		//		include("header.php");
			?>
            

				<?php
					 $fec = leer_param_gral();
			//		 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='egre_mante.php'>Salir</a>
  </div>


<font  size="+1">


<?php
if(isset($_SESSION['fec_proc'])){ 
   $fec = $_SESSION['fec_proc']; 
   $fec1 = cambiaf_a_mysql_2($fec);
 }	
 $c_agen = 30;	
 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp)or die('No pudo seleccionarse tabla gral_empresa');
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
$apli = 10000;
	  
$apli = 10000;
$_SESSION['c_agen'] = 0;
$_SESSION['cod_ope'] = 0;
$_SESSION['cod_gas'] = 0;
$_SESSION['monto_t'] = 0;
$_SESSION['descrip'] = 0;
//echo encadenar(32)."Gastos Operador".encadenar(2).$_SESSION['nom_ope'];
?>
<br><br>
<?php
//echo encadenar(130). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
?>

<br><br>
<?php
echo encadenar(3). "Fecha".encadenar(2).$fec.encadenar(100)."Moneda".encadenar(2).$_SESSION['des_mon']; 
?>


<table border="0" width="900">
<tr>
	    <th align="left"><?php echo "Cajero"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nombres']; ?></th> 
		<th align="left"><?php echo encadenar(10); ?></th>  
	   	<td align="left"><?php echo encadenar(10); ?></th> 
		<th align="center"><?php echo encadenar(10); ?></th>
		
			
    </tr>	
</table>
<table align="center" border="1">
	  <tr>
       	<td align="center"><strong>Nro.  </strong></td>
		<td align="center"><strong>Grupo </strong> </td>
		<td align="center"><strong>Descripcion </strong></td>
		<td align="center"><strong>Monto </strong></td>
		<td align="center"><strong>Monto Equiv.</strong></td>
		
   </tr>

<?php
$consulta  = "Select * From temp_ctable order by temp_debe_2";
    $resultado = mysql_query($consulta);
	$tipo = 2;
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	$imp_su = 0;
    while ($linea = mysql_fetch_array($resultado)) {
	      $cod_ope = $linea['temp_tip_tra'];
		  $cod_gas = $linea['temp_nro_cta'];
		  $imp_or = $linea['temp_haber_1'];
		  $imp_su = $linea['temp_debe_2'];
		  $descrip =  $linea['temp_des_cta'];
		  $mon = $_SESSION['egre_bs_sus'];
		  $con_ope  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD = $cod_ope";
       $res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla');
	   while ($linope = mysql_fetch_array($res_ope)) {
	         $nom_ope = $linope['GRAL_PAR_PRO_DESC'];
	   }
	   $con_cga  = "Select * From gral_cta_ingegre where gral_ingegre_cta = $cod_gas and gral_ingegre_tip = 2 ";
	$res_cga = mysql_query($con_cga)or die('No pudo seleccionarse tabla gral_ingegre_tip')  ;
	while ($lincga = mysql_fetch_array($res_cga)) {
	         $nom_cga = $lincga['gral_ingegre_desc'];
	   }
	
		
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
		  
		<?php  if ($_SESSION['egre_bs_sus'] == 1){?>
	      <tr>
		       <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
	 	      <td align="left"><?php echo $nom_cga; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
			   <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',','); ?></td>
		     
	     </tr>
		<?php  }?>
		<?php  if ($_SESSION['egre_bs_sus'] == 2){?>
	      <tr>
		       <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
	 	      <td align="left"><?php echo $nom_cga; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',','); ?></td>
			   <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		     
	     </tr>
		<?php  }?>
	 <?php
	 $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
    $nro_tr_ingegr = leer_nro_co_ingegr(); 	
	 
	 
	 
	 
	
if ($_SESSION['egre_bs_sus'] == 2){
    $importe =$imp_or*-1;
    $impo_sus = $imp_su*-1;
	$cta_ctb = "111002101";
	
    }else{		 
  	$importe =$imp_or*-1;
	$impo_sus = $imp_or*-1;
    $cta_ctb = "111001101";
	} 
	$tc_ctb = 0;
												 
$con_icaj = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
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
									             $c_agen,
												 $c_agen,
												 0,
												 '$fec1',
												 '$log_usr',
												 10000,
												 13,
												 $nro_tr_caj,
												 0,
												 0,
												 '$log_usr',
												 13000,
												 null,
												 null,
 											     null,
												 null,
												 '$cta_ctb',
												 $importe,
										         $impo_sus,
												 1,
												 $tc_ctb,
												 '$descrip',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$res_icaj = mysql_query($con_icaj)or die('No pudo insertar caja_transac : ' . mysql_error());
$con_ingegr = "insert into caja_ing_egre (caja_ingegr_corr, 
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
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 2,
												 '$cod_gas',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												  $importe,
										         $impo_sus,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$res_ingegr = mysql_query($con_ingegr)or die('No pudo insertar caja_ing_egre  2: ' . mysql_error());  

 /*if ($cod_ope < 9)	 {
	     
	 if ($_SESSION['egre_bs_sus'] == 2){
	      $imp_or =  $imp_su;
	 }
	 $con_iope = "insert into ope_trans(ope_tra_cod, 
	                                      ope_tra_ingegr,
	                                      ope_tra_fec,
                                          ope_tra_tipo,
										  ope_tra_cgas,
									      ope_tra_orden,
										  ope_tra_mon,
									      ope_tra_impo,
									      ope_tra_usr_alta,
					                      ope_tra_fec_hr_alta,
					                      ope_tra_usr_baja,
										  ope_tra_fec_hr_baja
   				                          ) values ($cod_ope,
										            $nro_tr_ingegr,
									                '$fec1',
									                2,
													$cod_gas,
												    0,
													$mon,
												    $imp_or * -1,
												   '$log_usr',
												    null,
												    null,
												   '0000-00-00 00:00:00')";
$res_iope = mysql_query($con_iope)or die('No pudo insertar caja_ing_egre  1: ' . mysql_error()); 
}

*/



	  } 
	  ?>
	 <?php  if ($_SESSION['egre_bs_sus'] == 1){?> 
	    <tr>
		       <td align="right"><?php echo encadenar(2) ; ?></td>
	 	      <th align="center"><?php echo "TOTAL"; ?></td>
		      <td align="left"><?php echo encadenar(2); ?></td>
		      <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></td>
		      <th align="right"><?php echo number_format($tot_debe_2, 2, '.',','); ?></td>
	     </tr>
	<?php  }?>
	 <?php  if ($_SESSION['egre_bs_sus'] == 2){?> 
	    <tr>
		       <td align="right"><?php echo encadenar(2) ; ?></td>
	 	      <th align="center"><?php echo "TOTAL"; ?></td>
		      <td align="left"><?php echo encadenar(2); ?></td>
		      <th align="right"><?php echo number_format($tot_debe_2, 2, '.',','); ?></td>
		      <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></td>
	     </tr>
	<?php  }?>
		 </table>
		 <?php
/*     $nom_ope = "";
   if ($cod_ope < 10){
       $con_ope  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD = $cod_ope";
       $res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla');
	   while ($linope = mysql_fetch_array($res_ope)) {
	         $nom_ope = $linope['GRAL_PAR_PRO_DESC'];
	   }
	   $consulta = "insert into ope_trans(ope_tra_cod, 
	                                      ope_tra_ingegr,
	                                      ope_tra_fec,
                                          ope_tra_tipo,
										  ope_tra_cgas,
									      ope_tra_orden,
										  ope_tra_mon,
									      ope_tra_impo,
									      ope_tra_usr_alta,
					                      ope_tra_fec_hr_alta,
					                      ope_tra_usr_baja,
										  ope_tra_fec_hr_baja
   				                          ) values ($cod_ope,
										            $nro_tr_ingegr,
									                '$fec1',
									                2,
													$cod_gas,
												    0,
													$mon,
												    $imp_or * -1,
												   '$log_usr',
												    null,
												    null,
												   '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  1: ' . mysql_error()); 
    }
     	
  */ 
   
   $tipo = 2;
   
 //   echo "aqui".$impo_sus;
?>


 <?php
  
  
  ?>	
  <br><br>
  <br><br>
  <br><br>
  <br><br>
 <?php
// echo $_SESSION['egre_bs_sus'].$importe;
 
	//header('Location: egre_mante.php');
	?>
	
<?php
//}	
//header('Location: egre_mante.php');	
?>

  <?php //} ?>
	 
</div>
  <?php
		 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
ob_end_flush();
 ?>