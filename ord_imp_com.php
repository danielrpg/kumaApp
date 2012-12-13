<?php
	  ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='solic_con_m.php'>Salir</a>
  </div>

<br><br>
<?php
$cod_ord = $_SESSION['cod_ord'];
$con_cli = "Select * From ord_maestro, cliente_general  where ORD_NUMERO = $cod_ord  and CLIENTE_COD = ORD_COD_CLI
	             and ORD_MAE_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
        $res_deu= mysql_query($con_cli)or die('No pudo seleccionarse tabla deudores');
   	    while ($linea = mysql_fetch_array($res_deu)){
  	         
			  $_SESSION['cod_cli']= $linea['CLIENTE_COD'];
$_SESSION['tip_doc']= $linea['CLIENTE_TIP_ID'];
$_SESSION['nom_com']=$linea['CLIENTE_NOMBRES'].encadenar(2).$linea['CLIENTE_AP_PATERNO'].
                     encadenar(2).$linea['CLIENTE_AP_MATERNO'].encadenar(2).
					 $linea['CLIENTE_AP_ESPOSO'];
					 
$_SESSION['direc']=$linea['CLIENTE_DIRECCION'];
$_SESSION['ci'] = $linea['CLIENTE_COD_ID'];
$_SESSION['fono'] = $linea['CLIENTE_FONO'];
$_SESSION['celu'] = $linea['CLIENTE_CELULAR'];
$_SESSION['fpag'] = $linea['ORD_FORM_PAG'];
$_SESSION['cope'] = $linea['ORD_OPE_RESP'];
$_SESSION['q_sol'] = $linea['ORD_QUIEN_SOL'];
$_SESSION['n_fac'] = $linea['ORD_NOM_FAC'];
$_SESSION['nit_f'] = $linea['ORD_NIT_FAC'];
$_SESSION['descuento'] = $linea['ORD_IMP_DES'];
$_SESSION['monto_t'] = $linea['ORD_IMPORTE'];
$f_ord = $linea['ORD_FEC_SOL'];
$_SESSION['f_ord'] = cambiaf_a_normal_2($f_ord);
$f_ini = $linea['ORD_FEC_INI'];
$_SESSION['f_ini'] = cambiaf_a_normal_2($f_ini);
$_SESSION['h_ini'] = $linea['ORD_HR_INI'];
$_SESSION['h_fin'] = $linea['ORD_HR_FIN'];
$f_pag = $linea['ORD_FORM_PAG'];
$con_fpa1  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 600 and GRAL_PAR_PRO_COD = $f_pag";
$res_fpa1 = mysql_query($con_fpa1)or die('No pudo seleccionarse tabla 2');
while ($lin_fpa1 = mysql_fetch_array($res_fpa1)) {
      $_SESSION['for_pag'] = $lin_fpa1['GRAL_PAR_PRO_DESC'];
}
$c_opera = $linea['ORD_OPE_RESP'];
$con_ope1  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD =$c_opera";
$res_ope1 = mysql_query($con_ope1)or die('No pudo seleccionarse tabla');
while ($linope1 = mysql_fetch_array($res_ope1)) {
    $_SESSION['nom_ope'] = $linope1['GRAL_PAR_PRO_DESC'];
}
$cod_barr1 = $linea['CLIENTE_COD_BARR'];
$con_bar1  = "Select * From gral_barrios where gral_barr_codigo = $cod_barr1";
$res_bar1= mysql_query($con_bar1)or die('No pudo seleccionarse tabla 2')  ;
 while ($lin_barr = mysql_fetch_array($res_bar1)) {
    $_SESSION['barrio'] =  $lin_barr['gral_barr_nombre']; 
	$_SESSION['det_barr'] = $lin_barr['gral_barr_detalles'];
 } 
//Monto total
$con_det  = "Select sum(ORD_DET_MONTO) From ord_detalle where ORD_DET_ORD = $cod_ord and ORD_DET_USR_BAJA is null";
$res_det= mysql_query($con_det)or die('No pudo seleccionarse tabla 2')  ;
          while ($lin_det = mysql_fetch_array($res_det)){
               $_SESSION['monto'] = $lin_det['sum(ORD_DET_MONTO)'];
			   
          }

//if(isset($_SESSION["continuar"])){
//     if($_SESSION["continuar"] == 1){
?>

 <center>
  <table border="1" width="800">
   <tr>
      <th width="8%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>CODIGO</th>
	  <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>CLIENTE</th>
      <th width="8%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>TEL. FIJO</th>
      <th width="8%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />TEL.CELULAR</th>
	  </tr>
     	<td  style="top:auto" style="font-size:12px"><?php echo $_SESSION['cod_cli'];?></td>
		<td  style="text-align:justify" style="font-size:12px"> <?php echo $_SESSION['nom_com'];?></td>
        <td  style="top:auto" style="font-size:12px"><?php echo $_SESSION['fono']; ?> </td>
        <td  style="top:auto" style="font-size:12px"> <?php echo $_SESSION['celu']; ?></td>
</table>
 <table border="1" width="800">
	
	<tr>
	    <th align="left" style=" font-size:10px">FEC. SOLICITUD</th> 
		<td align="center"><?php echo $_SESSION['f_ord']; ?></td>  
	   	<th align="left" style=" font-size:10px">FEC. ATENCION</th> 
		<td align="center"><?php echo $_SESSION['f_ini']; ?></td>           
	    <th align="left" style=" font-size:10px">Hra. INICIO</th> 
		<td align="center"><?php echo $_SESSION['h_ini']; ?></td>  
	   	<th align="left" style=" font-size:10px">Hra. FIN</th> 
		<td align="center"><?php echo $_SESSION['h_fin']; ?></td>    
		
    </tr>		
</table>
<table border="1" width="800">
	
	<tr>
	    <th align="left" style=" font-size:10px">OPERADOR</th> 
		<td align="center"><?php echo $_SESSION['nom_ope']; ?></td>  
	   	<th align="left" style=" font-size:10px">FORM. PAGO</th> 
		<td align="center"><?php echo $_SESSION['for_pag'] ; ?></td>           
	 </tr>	
	<tr>
	    <th align="left" style=" font-size:12px">Importe Total</th> 
		<td align="center"><?php echo number_format($_SESSION['monto'],2,'.',','); ?></td>  
	   	<th align="left" style=" font-size:12px">Importe Descuento</th> 
		<td align="center"><?php echo number_format($_SESSION['descuento'],2,'.',','); ?></td>    
		
    </tr>		
</table>
<?php  
}
?> 
<font size="+1"  style="" >
<?php
//if ($mone == 1){
    echo encadenar(10)."DETALLE ORDEN Nro.".encadenar(2).$_SESSION['cod_ord'];
 // }
 //if ($mone == 2){
 //   echo encadenar(45)."LISTADO DE MOVIMIENTOS CAJA EN ".encadenar(2). "DOLARES";
 // } 
?>
</font>

<font size="+1"  style="" >
<?php
//echo encadenar(47)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>
<center>
 <table border="1" width="800">
	
	<tr>
	    <th align="left" style=" font-size:14px">Importe Total Servicio</th> 
		<td align="center"><?php echo number_format($_SESSION['monto']
		                                            - $_SESSION['descuento'],2,'.',','); ?></td>  
	   	          
	 </tr>	
</table>
<?php 
  //Datos del cart_det_tran	
   /*	$t_ing = 0;
	$t_egr = 0;
	$t_ing1 = 0;
	$t_egr1 = 0;
	$t_egr = 0;			
	$t_ing2 = 0;
	$t_egr2 = 0;
	$impo_sus = 0;
	$impo = 0;
*/						
	$con_serv = "Select * From ord_detalle where ORD_DET_ORD = $cod_ord
	              and  ORD_DET_USR_BAJA is null
	             order by ORD_DET_GRP";
    $res_serv= mysql_query($con_serv)or die('No pudo seleccionarse tabla ord_detalle');
    
   // $res_serv = mysql_query($con_serv)or die('No pudo seleccionarse tabla caja_transac')  ;
	// and CAJA_TRAN_APL_DES <> 10000
	    while ($lin_serv = mysql_fetch_array($res_serv)) { // 1a
		    $cod_serv = $lin_serv['ORD_DET_GRP'];
			$cod_tipo = $lin_serv['ORD_DET_TIPO'];
			$cant = $lin_serv['ORD_DET_CANT'];
			$dias = $lin_serv['ORD_DET_DIAS'];
			$monto = $lin_serv['ORD_DET_MONTO'];
			$vol_t = $lin_serv['ORD_DET_VOLT'];
			$vol_a = $lin_serv['ORD_DET_VOLP'];
			$otro = $lin_serv['ORD_DET_OTRO'];
			$comen = $lin_serv['ORD_DET_COMEN'];
			 $cod_serv = $lin_serv['ORD_DET_GRP'];
		  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = $cod_serv
				        and GRAL_PAR_PRO_COD = 0 order by 2";
          $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ;
		  while ($lin_tser = mysql_fetch_array($res_tser)) {
	             $desc1 = $lin_tser['GRAL_PAR_PRO_DESC'];
				 }
		 ?>	  
 <table border="1" width="800">	
	
	
	<?php if ($cod_serv == 802) {
	          $con_t802  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 802
				        and GRAL_PAR_PRO_COD = $cod_tipo ";
          $res_t802 = mysql_query($con_t802)or die('No pudo seleccionarse tabla 2')  ; ?>
		  
		<tr>
	    <th align="left" ><?php echo $cod_serv; ?></td>
		<th align="left" ><?php echo $desc1; ?></td>	
		<th align="center" ><?php echo "Cant."; ?></td>	
		<th align="center" ><?php echo "Dias"; ?></td>	
		<th align="center" ><?php echo "Monto"; ?></td>	
	</tr>
		  
		<?php	  while ($lin_t802 = mysql_fetch_array($res_t802)) {
	             $desc802 = $lin_t802['GRAL_PAR_PRO_DESC'];
				// } ?>	
				
	<tr>
	    <td align="left" ><?php echo $cod_serv; ?></td>
		<td align="left" ><?php echo $desc802; ?></td>	
		<td align="right" ><?php echo number_format($cant, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($dias, 0, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($monto, 2, '.',','); ?></td>
		
	<?php  } ?>
	<?php  } ?>
    <?php if ($cod_serv == 803) { ?>
		  
		<tr>
	    <th align="left" ><?php echo $cod_serv; ?></td>
		<th align="left" ><?php echo $desc1; ?></td>	
		<th align="center" ><?php echo "mt3 Tot."; ?></td>	
		<th align="center" ><?php echo "mt3 Succ."; ?></td>	
		<th align="center" ><?php echo "Monto"; ?></td>	
	</tr>
	<tr>
	    <td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>	
		<td align="right" ><?php echo number_format($vol_t, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($vol_a, 0, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($monto, 2, '.',','); ?></td>
		
	
	<?php  } ?>
    <?php if ($cod_serv == 806) { ?>
		  
		<tr>
	    <th align="left" ><?php echo $cod_serv; ?></td>
		<th align="left" ><?php echo $desc1; ?></td>
		<th align="center" ><?php echo  encadenar(6); ?></td>		
		<th align="center" ><?php echo "Capacidad"; ?></td>	
		<th align="center" ><?php echo "Monto"; ?></td>	
	</tr>
	<tr>
	    <td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>	
		<td align="right" ><?php echo  encadenar(6); ?></td>
		<td align="right" ><?php echo number_format($vol_t, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($monto, 2, '.',','); ?></td>
		
	
	<?php  } ?>
<?php if ($cod_serv == 825) {
          $con_ope = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 150 and GRAL_PAR_PRO_COD = $dias";
          $res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla');
		  while ($linope = mysql_fetch_array($res_ope)) { 
	            $t_succ = $linope['GRAL_PAR_PRO_DESC'];	  
		         }
          ?>
		  
		<tr>
	    <th align="left" ><?php echo $cod_serv; ?></td>
		<th align="left" ><?php echo $desc1; ?></td>
		<th align="center" ><?php echo "Tipo Succion"; ?></td>		
		<th align="center" ><?php echo "Nro.Camaras"; ?></td>	
		<th align="center" ><?php echo "Monto"; ?></td>	
	</tr>
	<tr>
	    <td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>	
		<td align="left" ><?php echo $t_succ; ?></td>
		<td align="right" ><?php echo number_format($vol_t, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($monto, 2, '.',','); ?></td>
		
	
	<?php  } ?>
<?php if ($cod_serv == 826) { ?>
 </table>
<table border="1" width="800">			  
	<tr>
	    <th align="left" ><?php echo $cod_serv; ?></td>
		<th align="left" ><?php echo $desc1.encadenar(30); ?></td>
		<th align="center" ><?php echo "Servicio"; ?></td>	
		<th align="center" ><?php echo "Monto"; ?></td>	
	</tr>
	<tr>
	    <td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>	
		<td align="left" ><?php echo  $otro; ?></td>
		<td align="right" ><?php echo number_format($monto, 2, '.',','); ?></td>
</table>		
	<?php  } ?>
	<?php  } ?>
<table border="1" width="800">		
	<tr>
	    <th align="left" style=" font-size:14px">Importe Calculado</th> 
		<td align="right"><?php echo number_format($_SESSION['monto_t'],2,'.',','); ?></td>  
	 </tr>
	<tr>
	    <th align="left" style=" font-size:14px">Importe Descuento</th> 
		<td align="right"><?php echo number_format($_SESSION['descuento'],2,'.',','); ?></td>  
	 	 </tr>
	 <tr>
	    <th align="left" style=" font-size:14px">Importe a Cobrar</th> 
		<td align="right"><?php echo number_format($_SESSION['monto_t']
		                                            - $_SESSION['descuento'],2,'.',','); ?></td>  
	   	          
	 </tr>
</table>
<br><br>
</center>		
<?php	
 	include("footer_in.php");
?>

</div>
</body>
</html>



<?php
ob_end_flush();
 ?>

