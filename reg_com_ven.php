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
<title>Registro de Compra / Venta Divisas</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
</head>
<body>
	<div id="cuerpoModulo">
	<?php
				include("header.php");
			?>
            <div id="UserData">
                 <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />

				<?php
					 $fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
             </div>
             <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div> 
				<div id="TitleModulo">
                	<img src="images/24x24/001_35.png" border="0" alt="" />
					Compra / Venta Divisas
          </div> 
              <div id="AtrasBoton">
           		<a href="menu_s.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<div id="GeneralManCliente">
<!-- <form name="form2" method="post" action="egre_retro_1.php" style="border:groove" onSubmit="return"> >-->
  <form name="form2" method="post" action="egre_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios


if ($_SESSION['detalle'] == 1){
   $consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
   $cod_mon = 0;
   $des_mon = "";
   if (isset($_SESSION['c_com_ven'])){
       if ($_SESSION['c_com_ven'] == 1){
          $cod_tran = 1;
	      $des_tran = "Compra de divisas";
		  
		  
        }	
       if ($_SESSION['c_com_ven'] == 2){
           $cod_tran = 2;
	      $des_tran = "Venta de divisas";
       }
	   
	   $_SESSION['des_tran'] = $des_tran;	
   }

//$datos = $_SESSION['form_buffer'];
 ?>
 
 
 
 
 <table width="80%"  align="center">
    <tr>
        <th align="left">Transaccion  </th>
		<td><?php echo $des_tran; ?></td>
     </tr>
     <tr>
        
        <th align="left">Tipo de Cambio Contable:</th>
	    <td align="left"> <?php echo number_format($_SESSION['TC_CONTAB'], 2, '.',',') ; ?>
	   </tr>
	   
	   <?php if ($_SESSION['c_com_ven'] == 1){  ?>
	    </tr>
        <th align="left">Tipo de Cambio Compra:</th>
	    <td align="left"> <?php echo number_format($_SESSION['TC_COMPRA'], 2, '.',','); ?>
	   </tr>
	   <tr> 
         <th align="left" >Tipo de Cambio Especial:</th>
		 <td align="left" ><input  type="text" name="egr_tcesp"
		     value = <?php echo number_format($_SESSION['TC_COMPRA'], 2, '.',','); ?>>
		  </td>
       </tr>
	   
       <tr> 
         <th align="left" >Monto en Dolares :</th>
		 <td><input  type="text" name="egr_monto"> </td>
       </tr>
        <?php } ?>
		 <?php if ($_SESSION['c_com_ven'] == 2){  ?>
	    </tr>
        <th align="left">Tipo de Cambio Venta:</th>
	    <td align="left"> <?php echo number_format($_SESSION['TC_VENTA'], 2, '.',','); ?>
	   </tr>
	   <tr> 
         <th align="left" >Tipo de Cambio Especial:</th>
		 <td><input  type="text" name="egr_tcesp" 
		      value = <?php echo number_format($_SESSION['TC_VENTA'], 2, '.',','); ?>> </td>
       </tr>
	   
       <tr> 
         <th align="left" >Monto en Dolares :</th>
		 <td><input  type="text" name="egr_monto"> </td>
       </tr>
        <?php } ?>
         <tr>
	         <th align="left">Descripcion :</th>
			 <td><input type= type="text" name="descrip" size="50" maxlength="70"  > </td>
		 </tr>
		
		 
        </table>
	 <center>
	    
	 <input type="submit" name="accion" value="Calcular">
     <input type="submit" name="accion" value="Salir">

</form>
    <?php } ?>
<?php

 
 if ($_SESSION['detalle'] == 4){
    if (isset($_POST['egr_tcesp'])){
        $tc_com = $_POST['egr_tcesp'];
		$_SESSION['tc_com'] = $tc_com;
	}
	if (isset($_POST['descrip'])){
        $des_quien = $_POST['descrip'];
		$_SESSION['descrip'] = $des_quien;
	}
	if (isset($_POST['egr_monto'])){
	   if ($_SESSION['c_com_ven'] == 1){
           $imp_sus = $_POST['egr_monto'];
		   $_SESSION['imp_sus'] = $imp_sus;
		}
		if ($_SESSION['c_com_ven'] == 2){
           $imp_bs = $_POST['egr_monto'];
		   $_SESSION['imp_bs'] = $imp_bs;
		}   
	}
	    $cta_ctbs = 11101101;
		$cta_ctus = 11101201;
		$des_ctabs = leer_cta_des($cta_ctbs);
		$des_ctaus = leer_cta_des($cta_ctus);
	    $_SESSION['cta_ctbs'] = $cta_ctbs;
		$_SESSION['cta_ctus'] = $cta_ctus;
		$_SESSION['des_ctabs'] = $des_ctabs;
	    $_SESSION['des_ctaus'] = $des_ctaus;	
	
	if ($_SESSION['c_com_ven'] == 1){
	   
	    $monto_com = round(($imp_sus * $tc_com),2);
		$monto_ctb = round(($imp_sus * $_SESSION['TC_CONTAB']),2);
		$_SESSION['monto_com'] = $monto_com;
		$_SESSION['monto_ctb'] = $monto_ctb;
		$_SESSION['dif_tc'] = $monto_ctb - $monto_com;
		$_SESSION['imp_equiv'] = $monto_ctb;
		$_SESSION['imp_sus'] = $imp_sus;
		 echo $_SESSION['c_com_ven']."1".$_SESSION['monto_com'].$_SESSION['monto_ctb'].$_SESSION['dif_tc'].
		 $_SESSION['imp_equiv'].$_SESSION['imp_sus'];
	  }
	if ($_SESSION['c_com_ven'] == 2){
	   echo $_SESSION['c_com_ven']."2";
	    $monto_ven = $imp_bs * $tc_com;
	    $monto_ctb = $imp_bs * $_SESSION['TC_CONTAB'];
		$_SESSION['monto_ven'] = $monto_ven;
		$_SESSION['monto_ctb'] = $monto_ctb;
		$_SESSION['dif_tc'] = $monto_ven - $monto_ctb;
		$_SESSION['imp_sus'] = $imp_bs;
			
	 }
	
if ($_SESSION['dif_tc'] <> 0){
   if ($_SESSION['dif_tc'] < 0){
      $cta_dtc = "44201101";
      $des_ctadi = leer_cta_des($cta_dtc);
	  $deb_hab = 1; 
	  $importe = ($_SESSION['dif_tc'] * -1);
	  $_SESSION['cta_dtc'] = $cta_dtc;
      $importe_e = $importe;	 
       }
   	 if ($_SESSION['dif_tc'] > 0){
	    $cta_dtc = "54201101";
		$des_ctadi = leer_cta_des($cta_dtc);
        $deb_hab = 2; 
	    $importe = $_SESSION['dif_tc'];
		$importe_e = $importe;
		//if ($mon == 2) {
		  // $importe_e = 0;
		// }
       } 
	   $_SESSION['des_ctadi'] = $des_ctadi;
	   $_SESSION['cta_dtc'] = $cta_dtc;
	}
	
	
//	$imp_equiv = $tc_com * $imp_sus;
  //  
	 ?>
	 <?php echo encadenar(20).$descrip; ?>
	  
 	<table width="80%"  border="1" cellspacing="1" cellpadding="1" align="center">
	<tr>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
      <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DEBE</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />HABER</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />IMP. DOLARES</th>
	</tr> 
	
   <?php if ($_SESSION['c_com_ven'] == 1){  ?> 
	
	<tr>
	  <td align="center" ><?php echo $cta_ctus; ?></td>
	  <td align="left" ><?php echo $des_ctaus; ?></td>
	  <td align="right" ><?php echo number_format($monto_ctb, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	  <td align="right" ><?php echo number_format($_SESSION['imp_sus'], 2, '.',','); ?></td>
	</tr>
	<tr>
	  <td align="center" ><?php echo $cta_ctbs; ?></td>
	  <td align="left" ><?php echo $des_ctabs; ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($monto_com, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	</tr>
	<tr>
	  <td align="center" ><?php echo $cta_dtc; ?></td>
	  <td align="left" ><?php echo $des_ctadi; ?></td> 
	  <td align="right" ><?php echo number_format($_SESSION['dif_tc'] * -1, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	</tr>
	<?php } ?>
	 <?php if ($_SESSION['c_com_ven'] == 2){  ?> 
	<tr>
	  <td align="center" ><?php echo $cta_ctus; ?></td>
	  <td align="left" ><?php echo $des_ctaus; ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($monto_ctb, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['imp_sus'], 2, '.',','); ?></td>
	</tr>
	<tr>
	  <td align="center" ><?php echo $cta_ctbs; ?></td>
	  <td align="left" ><?php echo $des_ctabs; ?></td>
	   <td align="right" ><?php echo number_format($monto_ven, 2, '.',','); ?></td> 
	   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	</tr>
	<tr>
	  <td align="center" ><?php echo $cta_dtc; ?></td>
	  <td align="left" ><?php echo $des_ctadi; ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['dif_tc'] , 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	</tr>
	<?php } ?>
	
	
	
</table> 	
<center>	
     <input type="submit" name="accion" value="Recibo">
     <input type="submit" name="accion" value="Salir">
 </form>
	<?php  
	 
	 
  //echo $_SESSION['monto_i'].encadenar.$_SESSION['monto_p'].encadenar(2).$_SESSION['cta_f13'];
  
 }
?>

 
	 
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