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
<title>Saldo Final de Cajas</title>
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
                	<img src="images/24x24/001_35.png" border="0" alt="" />Saldo Final de Cajas
          </div> 
              <div id="AtrasBoton">
           		<a href="menu_s.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<div id="GeneralManCliente">

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">
<strong>
<?php

$mon = 0;
$cod_mone = 0;
$cantidad = 0;
if (isset($_SESSION['caja_bs_sus'])){
   $mon = $_SESSION['caja_bs_sus'];
 }
$estado = 0; 
$caj_hab = verif_cajero_hab($fec1,$log_usr);
if ($caj_hab == 0){
   echo "Usuario no Habilitado como cajero ".encadenar(2)." !!!!!";
   $_SESSION['detalle'] = 0;
   $_SESSION['continuar'] = 0;
   ?> 
   <br>
   <center>
 <input type="submit" name="accion" value="Salir">

</form>
<?php } ?>
<strong>
	
<?php
//echo "este";
   $estado = verif_cierre_cja($fec1,$log_usr,$mon);
   if ($estado == 1){
      echo "YA ingreso saldos Final para fecha ".encadenar(2).$fec.encadenar(2)."Cajero".
           encadenar(2).$log_usr."Moneda ".encadenar(2).$mon." !!!!!";
      $_SESSION['detalle'] = 0;
	  $_SESSION['continuar'] = 0;
    ?> 
   <br>
   <center>
 <input type="submit" name="accion" value="Salir">

</form>
<?php } ?>

<strong>	

 <?php //} //5b
 
//echo $_SESSION['msje'];
//echo "aqui";

if ($estado == 0){
if(isset($_SESSION['caja_bs_sus'])){
$mon = $_SESSION['caja_bs_sus'];
}
if (isset($mon)){
if ($mon == 1){
   $des_mon = "Bolivianos";
   }
if ($mon == 2){
   $des_mon = "Dolares Americanos";
   }
  }
 if(isset($_SESSION['detalle'])){
if ($_SESSION['detalle'] == 1){ //1a
    $saldo = saldo_fin_cja2($fec1,$log_usr,$mon);
	$_SESSION['saldo'] = $saldo;
	$vales = saldo_fin_vale($fec1,$log_usr,$mon);
	$_SESSION['vales'] = $vales;
	$banco = saldo_fin_banco($fec1,$log_usr,$mon);
	$_SESSION['banco'] = $banco;
	}
?>
    <table align="center" border="1">
    
      <tr>
	    <th align="left">Saldo Transacciones :</th>
		<td align="center"><?php echo encadenar(2); ?></td>
		<?php if (isset ($_SESSION['saldo'])){?>
		<th align="right"><?php echo number_format($_SESSION['saldo'], 2, '.',','); ?> </td>
		<?php } ?> 
	  </tr>
	  <tr>
	    <th align="left">Saldo Vales :</th>
		<td align="center"><?php echo encadenar(2); ?></td>
		<?php if (isset ($_SESSION['vales'])){?>
		<th align="right"><?php echo number_format($_SESSION['vales'], 2, '.',','); ?> </td>
		<?php } ?> 
	  </tr>
	  <tr>
	    <th align="left">Saldo Bancos :</th>
		<td align="center"><?php echo encadenar(2); ?></td>
		<?php if (isset ($_SESSION['bancos'])){?>
		<th align="right"><?php echo number_format($_SESSION['bancos'], 2, '.',','); ?> </td>
		<?php }else{
		    $_SESSION['bancos'] = 0; ?>
		<th align="right"><?php echo number_format(0, 2, '.',','); ?> </td>
		 <?php } ?> 
	  </tr>
	   <tr>
	    <th align="left">Saldo Efectivo :</th>
		<td align="center"><?php echo encadenar(2); ?></td>
		<?php if (isset ($_SESSION['bancos'])){?>
		<th align="right"><?php echo number_format($_SESSION['saldo'] - $_SESSION['vales'] - $_SESSION['bancos'] 
		                              , 2, '.',','); ?> </td>
		<?php $_SESSION['efectivo'] = $_SESSION['saldo'] - $_SESSION['vales'] - $_SESSION['bancos']; 
		 }
		    
	  }  //1b?>
	 </table>




<?php
}
if(isset($_SESSION['continuar'])){
if ($_SESSION['continuar'] == 1){ //2a
    $_SESSION['cuantos'] = 0;
    $borr_cob  = "Delete From temp_ctable "; 
    $cob_borr = mysql_query($borr_cob)or die('No pudo borrar temp_ctable');
     //2b
	
	
	
	
	$con_cortes  = "Select * From caja_cortes where CAJA_COR_FECHA = '$fec1' and 
	              CAJA_COR_CAJERO = '$log_usr' and CAJA_COR_ESTADO = 1 and CAJA_COR_MON = $mon";
	$res_cortes = mysql_query($con_cortes)or die('No pudo seleccionarse caja_cortes 1');
	while ($lin_cortes = mysql_fetch_array($res_cortes)) { 
	// echo  $lin_cortes['CAJA_COR_CANTIDAD'];
	// while ($lin_temp = mysql_fetch_array($res_temp)) {
        $tipo = $lin_cortes['CAJA_COR_TIPO'];
		$cant = $lin_cortes['CAJA_COR_CANTIDAD'];
		$mont = $lin_cortes['CAJA_COR_MONTO'];
		$cod_cor = $lin_cortes['CAJA_COR_CODIGO'];
		$mon = $lin_cortes['CAJA_COR_MON'];
	//	echo $tipo, $cod_cor;
		
		$con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = $tipo and 
	              GRAL_PAR_PRO_COD = $cod_cor";
		$res_cor = mysql_query($con_cor)or die('No pudo seleccionarse gral_param_propios xx');
		while ($lin_cor = mysql_fetch_array($res_cor)) { 
		       $sig = $lin_cor['GRAL_PAR_PRO_SIGLA'];
			   $des = $lin_cor['GRAL_PAR_PRO_DESC'];
			   $cort = $lin_cor['GRAL_PAR_PRO_CTA1'];
			}
		$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($tipo,
										   '$sig',
									       '$des',
										   $cant,
										   $mont,
										   $cod_cor,
										   $cort)";
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable uno : ' . mysql_error());	
	$_SESSION['continuar'] = 2;	
	$_SESSION['prov'] = 1;	
		}
	}	
}
	/*	*/
//}  
	   
	   
if(isset($_SESSION['detalle'])){	
if ($_SESSION['detalle'] == 1){ //4a
    if ($mon == 1){
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 110 and 
	              GRAL_PAR_PRO_COD <> 0   order by 1,2";
	}	
	if ($mon == 2){
	 $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 130  
	              and GRAL_PAR_PRO_COD <> 0   order by 1,2";
	}
	 $res_cor = mysql_query($con_cor)or die('No pudo seleccionarse gral_param_propios 1'); ?>
    <table align="center">
        <tr>
	       <th align="left"><?php echo $des_mon;?></th>
	    </tr>
		<tr>
	       <th align="left">Codigo Billete/ Moneda :</th>
	       <td> <select name="cod_cta" size="1"  >
	       <?php while ($lin_cor = mysql_fetch_array($res_cor)) {  ?>
                 <option value=<?php echo $lin_cor['GRAL_PAR_PRO_COD']; ?>>
		                       <?php echo $lin_cor['GRAL_PAR_PRO_SIGLA'].encadenar(3).$lin_cor['GRAL_PAR_PRO_DESC']; ?>
				 </option>
           <?php } ?>
		        </select></td>
        </tr>
        <tr> 
           <th align="left" >Cantidad :</th>
		   <td><input  type="text" name="egr_monto"> </td>
        </tr>
   </table>
	 <center>
	   
	 <input type="submit" name="accion" value="A�adir">
	</form>




	
<?php } 
} //4b?> 
 <form name="form2" method="post" action="con_retro_1.php" onSubmit="return">
<?php
$apli = 10000;
$_SESSION['monto_t'] = 0;
$descrip = "";
$tc_ctb = $_SESSION['TC_CONTAB'];

$m_debe_1 = 0;
$m_haber_1 = 0;
$m_debe_2 = 0;
$m_haber_2 = 0;
$mon_cta = 0;
if(isset($_SESSION['continuar'])){
  if ($_SESSION['continuar'] == 2){ //5a
?>

<table align="center" border="1">
	  <tr>
       	<td align="center"><strong>Sigla  </strong></td>
		<td align="center"><strong>Corte  </strong> </td>
		<td align="center"><strong>Cantidad </strong></td>
		<td align="center"><strong>Monto </strong></td>
		<td align="center"><strong>Mod./Eli.</strong></td>
   </tr>

<?php
if ($_SESSION['prov'] == 0){
  if (isset($_POST['cod_cta'])){
     $cod_mone = $_POST['cod_cta'];
   $_SESSION['cod_mone'] = $cod_mone;
   }
   if (isset($_POST['egr_monto'])){ 
      $cantidad = $_POST['egr_monto'];
   }
 //  echo $cod_mone. $cantidad. "aqui....."; 
 //  $cantidad = $_POST['egr_monto'];
      
   if ($mon == 1){
       $cuantos = 110;
       $con_val  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 110 and 
	                GRAL_PAR_PRO_COD = $cod_mone";
	  }
   if ($mon == 2){
       $cuantos = 130;
	   $con_val  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 130 and 
	                GRAL_PAR_PRO_COD = $cod_mone";
	  }
   $res_val = mysql_query($con_val)or die('No pudo seleccionarse gral_param_propios 2');
   while ($lin_val = mysql_fetch_array($res_val)) {
          $cod_por = $lin_val['GRAL_PAR_PRO_CTA1'];
		  $desc = $lin_val['GRAL_PAR_PRO_DESC']; 
		  $sigla = $lin_val['GRAL_PAR_PRO_SIGLA'];
		  $monto = $cantidad * $cod_por;
		  }
    $consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cuantos,
										   '$sigla',
									       '$desc',
										   $cantidad,
										   $monto,
										   $cod_mone,
										   $cod_por)";
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable 1 : ' . mysql_error());
	 }else{
	  $cod_mone = $_SESSION['cod_mone'];
  // $cod_mone = $_SESSION['caja_bs_sus'];
  $_SESSION['prov'] = 0;	 
   }
	$consulta  = "Select * From temp_ctable order by temp_debe_2";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_debe_2']; ?>">	</td> 
	     </tr>
	 <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
		  <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <?php if ($_SESSION['efectivo'] > $tot_haber_1){ ?>
		     <th align="center"><?php echo "Sobrante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] < $tot_haber_1){ ?>
		     <th align="center"><?php echo "Faltante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] == $tot_haber_1){ ?>
		     <th align="center"><?php echo "Diferencia"; ?></th>
			  <?php } ?>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($_SESSION['efectivo'] - $tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
     </table>
     <center>
	 <input type="submit" name="accion" value="Mod_cant">  
	 <input type="submit" name="accion" value="Eliminar">
	 <input type="submit" name="accion" value="Grab_cortes">
	 
    

</form>	
 <?php }
 } //5b?>
 
 <?php
 if(isset($_SESSION['eliminar'])){
 if ($_SESSION['eliminar'] == 1){
   // echo $_SESSION['entra'];
    if(isset($_POST['cmone'])){ //2a
       $cmone = $_POST['cmone'];
	   $_SESSION['cmone'] = $cmone;
	 echo $_SESSION['cmone'];?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="">
  <?php
	 $consulta  = "Delete From temp_ctable where temp_debe_2 = $cmone";
     $resultado = mysql_query($consulta);
	$consulta  = "Select * From temp_ctable order by temp_debe_2";
    $resultado = mysql_query($consulta);?>
	<table align="center" border="1">
	  <tr>
       	<td align="center"><strong>Sigla  </strong></td>
		<td align="center"><strong>Corte  </strong> </td>
		<td align="center"><strong>Cantidad </strong></td>
		<td align="center"><strong>Monto </strong></td>
		<td align="center"><strong>Mod./Eli.</strong></td>
   </tr>
   <?php
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $cod_mone; ?>">	</td> 
	     </tr>
	 <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
		  <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <?php if ($_SESSION['efectivo'] > $tot_haber_1){ ?>
		     <th align="center"><?php echo "Sobrante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] < $tot_haber_1){ ?>
		     <th align="center"><?php echo "Faltante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] == $tot_haber_1){ ?>
		     <th align="center"><?php echo "Diferencia"; ?></th>
			  <?php } ?>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($_SESSION['efectivo'] - $tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
     </table>
	 <center>
	 <input type="submit" name="accion" value="Mod_cant">  
	 <input type="submit" name="accion" value="Eliminar">
	 <input type="submit" name="accion" value="Grab_cortes">
	
     

</form>	
 <?php
 //}
 }
 }
} 
 //modificar
 
if(isset($_SESSION['modificar'])){ 
 if ($_SESSION['modificar'] == 1){
   // echo $_SESSION['entra'];
    if(isset($_POST['cmone'])){ //2a
       $cmone = $_POST['cmone'];
	   $_SESSION['cmone'] = $cmone;
	 // echo $_SESSION['cmone'];?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="">
  <?php
	 $con_modi  = "Select * From temp_ctable where temp_debe_2 = $cmone";
     $res_modi = mysql_query($con_modi);
	   while ($lin_modi = mysql_fetch_array($res_modi)) { ?>
	<table align="center" border="1">
	  <tr>
       	<td align="center"><strong>Sigla  </strong></td>
		<td align="center"><strong>Corte  </strong> </td>
		<td align="center"><strong>Monto </strong></td>
		<td align="center"><strong>Cantidad </strong></td>
		<td align="center"><strong>Nueva Cant. </strong></td>
	  </tr>
	  <tr>
	 	      <td align="left"><?php echo $lin_modi['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $lin_modi['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($lin_modi['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($lin_modi['temp_debe_1'], 0, '.',','); ?></td>
		      <td><input  type="text" name="nue_cant"> </td>	
	     </tr>
	</table>
	<input type="submit" name="accion" value="Grab_mod">

</form>		 
   <?php 
		 
	   }
	  
	 
	 
	 
	$consulta  = "Select * From temp_ctable order by temp_debe_2";
    $resultado = mysql_query($consulta);?>
	<table align="center" border="1">
	  <tr>
       	<td align="center"><strong>Sigla  </strong></td>
		<td align="center"><strong>Corte  </strong> </td>
		<td align="center"><strong>Cantidad </strong></td>
		<td align="center"><strong>Monto </strong></td>
		
   <?php
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      
	     </tr>
	 <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
		  <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		      <?php if ($_SESSION['efectivo'] > $tot_haber_1){ ?>
		     <th align="center"><?php echo "Sobrante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] < $tot_haber_1){ ?>
		     <th align="center"><?php echo "Faltante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] == $tot_haber_1){ ?>
		     <th align="center"><?php echo "Diferencia"; ?></th>
			  <?php } ?>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($_SESSION['efectivo'] - $tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
     </table>
	 <center>
 </form>	
 <?php
 //}
 }
 }
 }
 //graba modificacion
if(isset($_SESSION['grab_mod'])){  
 if ($_SESSION['grab_mod'] == 1){
   // echo $_SESSION['entra'];
    if(isset($_POST['nue_cant'])){ //2a
       $nue_cant = $_POST['nue_cant'];
	   $_SESSION['nue_cant'] = $nue_cant;
	 // echo $_SESSION['cmone'];?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="">
  <?php
     $cmone = $_SESSION['cmone']; 
	 $con_modi  = "update temp_ctable set temp_debe_1 = $nue_cant,
	                                      temp_haber_1 = temp_haber_2 * $nue_cant where temp_debe_2 = $cmone";
     $res_modi = mysql_query($con_modi);
	 //  while ($lin_modi = mysql_fetch_array($res_modi)) { ?>
	<input type="submit" name="accion" value="Mod_cant">  
	 <input type="submit" name="accion" value="Eliminar">
	 <input type="submit" name="accion" value="Grab_cortes">
	 

</form>		 
   <?php 
		 
	   //}
	  
	 
	 
	 
	$consulta  = "Select * From temp_ctable order by temp_debe_2";
    $resultado = mysql_query($consulta);?>
	<table align="center" border="1">
	  <tr>
       	<td align="center"><strong>Sigla  </strong></td>
		<td align="center"><strong>Corte  </strong> </td>
		<td align="center"><strong>Cantidad </strong></td>
		<td align="center"><strong>Monto </strong></td>
		<td align="center"><strong>Mod./Eli.</strong></td>
   </tr>
   <?php
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $cod_mone; ?>">	</td> 
	     </tr>
	 <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
		  <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		      <?php if ($_SESSION['efectivo'] > $tot_haber_1){ ?>
		     <th align="center"><?php echo "Sobrante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] < $tot_haber_1){ ?>
		     <th align="center"><?php echo "Faltante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] == $tot_haber_1){ ?>
		     <th align="center"><?php echo "Diferencia"; ?></th>
			  <?php } ?>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($_SESSION['efectivo'] - $tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
     </table>
	 <center>
 </form>	
 <?php
 //}
 }
 }
 }
 
 ?>

  <?php
		// 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
ob_end_flush();
 ?>