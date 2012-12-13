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
<title>Deposito - Retiro Bancos</title>
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
					Deposito - Retiro Bancos
          </div> 
              <div id="AtrasBoton">
           		<a href="cja_bancos.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<div id="GeneralManCliente">
<!-- <form name="form2" method="post" action="egre_retro_1.php" style="border:groove" onSubmit="return"> >-->
  <form name="form2" method="post" action="bco_retro.php" onSubmit="return ValidaCamposEgresos(this)">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios


if ($_SESSION['detalle'] == 1){
   
   $cod_mon = 0;
   $des_mon = "";
   if (isset($_SESSION['b_dep_ret'])){
       if ($_SESSION['b_dep_ret'] == 1){
          $cod_tran = 1;
	      $des_tran = "Deposito ";
		  }	
       if ($_SESSION['b_dep_ret'] == 2){
           $cod_tran = 2;
	      $des_tran = "Retiro";
       }
	}
	 if (isset($_SESSION['bco_bs_sus'])){
       if ($_SESSION['bco_bs_sus'] == 1){
          $cod_mon = 1;
	      $des_mon = "Bolivianos";
		  }	
       if ($_SESSION['bco_bs_sus'] == 2){
           $cod_mon = 2;
	      $des_mon = "Dolares";
       }
	}
	$_SESSION['des_tran'] = $des_tran;	
	$_SESSION['des_mon'] = $des_mon;
    $consulta  = "Select * From gral_cta_banco where GRAL_CTA_BAN_MON = $cod_mon and
	              GRAL_CTA_BAN_USR_BAJA is null ";
    $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla gral_cta_banco');
    $con_ctas  = "Select * From contab_cuenta where substr(CONTA_CTA_NRO,1,2) = '11'													                  and CONTA_CTA_NIVEL = 'A' and substr(CONTA_CTA_NRO,6,1) = '$cod_mon'";
    $res_ctas = mysql_query($con_ctas)or die('No pudo seleccionarse tabla2')  ;
  //$datos = $_SESSION['form_buffer'];
 ?>
 <table width="80%" align="center">
     <tr>
        <th align="left">Transaccion  </th>
		<th align="left"><?php echo encadenar(2).$_SESSION['des_tran']. "en".encadenar(2).$_SESSION['des_mon']; ?></th>
     </tr>
      <tr>
        <th align="left">Cuenta Banco:</th>
	    <td> <select name="cod_bco" size="1"  >
	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['GRAL_CTA_BAN_COD']; ?>>
			              <?php echo $linea['GRAL_CTA_BAN_CTA_CTE'].encadenar(2); ?>
			              <?php echo $linea['GRAL_CTA_BAN_DESC']; ?></option>
            <?php }
			
			 ?>
		    </select></td>
       </tr>
	  <tr> 
	    <th align="left">Contra Cuenta:</th>
	    <td> <select name="cod_cta" size="1"  >
	        <?php while ($lin_cta = mysql_fetch_array($res_ctas)) { ?>
            <option value=<?php echo $lin_cta['CONTA_CTA_NRO']; ?>>
			              <?php echo $lin_cta['CONTA_CTA_NRO']; ?>
			              <?php echo $lin_cta['CONTA_CTA_DESC']; ?></option>
            <?php } ?>
		    </select></td>
       </tr>
	  
	   
       <tr> 
         <th align="left" ><?php echo "Monto en".encadenar(2).$_SESSION['des_mon'];?></th>
		 <td><input  type="text" name="egr_monto"> </td>
       </tr>
          <tr>
	         <th align="left">Hace la Transaccion :</th>
			 <td><input type= type="text" name="descrip" size="50" maxlength="70"  > </td>
		 </tr>
		
		 
        </table>
	 <center>
	    
	 <input type="submit" name="accion" value="Aplicar">
     <input type="submit" name="accion" value="Salir">

</form>
    <?php } ?>
<?php

 
 if ($_SESSION['detalle'] == 2){
    if (isset($_POST['descrip'])){
        $descrip = $_POST['descrip'];
		$_SESSION['descrip'] = $descrip;
	}
	if (isset($_POST['egr_monto'])){
	   $importe = $_POST['egr_monto'];
	}
	    $cta_bco = $_POST['cod_bco'];
		$cta_otra = $_POST['cod_cta'];
		$_SESSION['cta_bco'] =$cta_bco;  
	$consulta  = "Select * From gral_cta_banco where GRAL_CTA_BAN_COD = $cta_bco and
	              GRAL_CTA_BAN_USR_BAJA is null ";
    $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla gral_cta_banco');
	while ($linea = mysql_fetch_array($resultado)) {
	      $cta_banco = $linea['GRAL_CTA_BAN_CTBL'];
		  $_SESSION['cod_bco'] =  $linea['GRAL_CTA_BAN_COD']; 
	      $_SESSION['cta_bco'] =  $linea['GRAL_CTA_BAN_CTA_CTE']; 
	      $_SESSION['nom_cta'] =  $linea['GRAL_CTA_BAN_DESC']; 
	
	}
	
				
		
		$des_banco = leer_cta_des($cta_banco);
		$des_otra = leer_cta_des($cta_otra);
	    $_SESSION['cta_otra'] = $cta_otra;
		$_SESSION['cta_banco'] = $cta_banco;
		$_SESSION['des_otra'] = $des_otra;
	    $_SESSION['des_banco'] = $des_banco;
		$mon_otra = substr($cta_otra,5,1);
	
	if ($_SESSION['bco_bs_sus'] == 2){
	    $impo_bs1  = round(($importe * $_SESSION['TC_CONTAB']),2);
		$impo_eqv1 = $importe;
		$_SESSION['impo_bs1'] = $impo_bs1;
		$_SESSION['impo_eqv1'] = $impo_eqv1;
	  }
	if ($_SESSION['bco_bs_sus'] == 1){
	    $impo_bs1 = $importe ;
	    $impo_eqv1 = 0;
		$_SESSION['impo_bs1'] = $impo_bs1;
		$_SESSION['impo_eqv1'] = $impo_eqv1;
		}
	if ($mon_otra == 2){
	    $impo_bs2  = round(($importe * $_SESSION['TC_CONTAB']),2);
		$impo_eqv2 = $importe ;
		$_SESSION['impo_bs2'] = $impo_bs2;
		$_SESSION['impo_eqv2'] = $impo_eqv2;
	  }	
	if ($mon_otra == 1){
	    $impo_bs2 = $importe;
	    $impo_eqv2 = 0;
		$_SESSION['impo_bs2'] = $impo_bs2;
		$_SESSION['impo_eqv2'] = $impo_eqv2;
		}

	
//	$imp_equiv = $tc_com * $imp_sus;
  //  
	 ?>
	 <strong>
 <?php echo $_SESSION['des_tran'].encadenar(2)."a cta.".encadenar(2).
 $_SESSION['cta_bco'].encadenar(2).$_SESSION['nom_cta']; ?>
  <br>
  <?php echo "Transaccion de".encadenar(2).$_SESSION['des_tran'].encadenar(2)."por".encadenar(2).
 $_SESSION['descrip']; ?>
	</strong>  
 	<table width="80%"  border="1" cellspacing="1" cellpadding="1" align="center">
	<tr>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
      <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	</tr> 
	
   <?php if ($_SESSION['b_dep_ret'] == 1){ ?> 
	
	<tr>
	  <td align="center" width="10" ><?php echo $_SESSION['cta_banco']; ?></td>
	  <td align="left" ><?php echo $_SESSION['des_banco']; ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_bs1'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	  <td align="right" ><?php echo number_format($_SESSION['impo_eqv1'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	</tr>
	<tr>
	  <td align="center" width="10" ><?php echo $_SESSION['cta_otra']; ?></td>
	  <td align="left" ><?php echo $_SESSION['des_otra']; ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_bs2'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_eqv2'], 2, '.',','); ?></td>
	</tr>
	<?php } ?>
	 <?php if ($_SESSION['b_dep_ret'] == 2){  ?> 
	<tr>
	  <td align="center" width="10" ><?php echo $_SESSION['cta_banco']; ?></td>
	  <td align="left" ><?php echo $_SESSION['des_banco']; ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	  <td align="right" ><?php echo number_format($_SESSION['impo_bs1'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	  <td align="right" ><?php echo number_format($_SESSION['impo_eqv1'], 2, '.',','); ?></td>
	</tr>
	<tr>
	  <td align="center" width="10" ><?php echo $_SESSION['cta_otra']; ?></td>
	  <td align="left" ><?php echo $_SESSION['des_otra']; ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_bs2'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_eqv2'], 2, '.',','); ?></td>
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
 
 
 
 
 
 
 
if ($_SESSION['detalle'] == 3){
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['c_agen'];
   $descrip = $_SESSION['descrip'];
   $monto_t = $_SESSION['monto_t'] * -1;
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $cta_ctb = 
   $nro_tr_caj = leer_nro_co_cja($apli,$c_agen);
   
    echo "aqui".$c_agen.$nro_tr_caj,$descrip,$monto_t,$cta_ctbg ;
 
			 

	header('Location: egre_mante.php');
	?>
	
<?php
//}	
//header('Location: egre_mante.php');	
?>

  <?php } ?>
	 
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