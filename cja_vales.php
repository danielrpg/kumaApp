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
<title>Registro de Vales</title>
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
					 $_SESSION['fec1'] = $fec1;
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
             </div>
             <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div> 
				<div id="TitleModulo">
                	<img src="images/24x24/001_35.png" border="0" alt="" />Registro Egresos
          </div> 
              <div id="AtrasBoton">
           		<a href="menu_s.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<div id="GeneralManCliente">
<!-- <form name="form2" method="post" action="egre_retro_1.php" style="border:groove" onSubmit="return"> >-->
  <form name="form2" method="post" action="egre_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios


//if ($_SESSION['detalle'] == 1){
   $consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
   $cod_mon = 0;
   $des_mon = "";
$con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
$res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla')  ;
$con_usr  = "Select * From gral_usuario where GRAL_USR_ESTADO = 1													   and GRAL_USR_USR_BAJA is null order by 5";
$res_usr = mysql_query($con_usr)or die('No pudo seleccionarse gral_usuario')  ;

//$datos = $_SESSION['form_buffer'];
 ?>
  <table align="center">
  <tr>
        <th align="left">Agencia </th>
	    <td> <select name="cod_agencia" size="1"  >
	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
			              <?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
            <?php } ?>
		    </select></td>
       </tr>
    <tr>
		 <td><strong>Moneda  </strong></td>
		 <td align="left"><select name="cod_mon" size="1"  >
   	         <?php while ($linea = mysql_fetch_array($res_mon)) {?>
             <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
			 <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	         <?php } ?>
		     </select></td>
		</tr> 
     
        <th align="left">Funcionario</th>
	    <td> <select name="cod_cta" size="1"  >
	        <?php while ($lin_usr = mysql_fetch_array($res_usr)) { ?>
            <option value=<?php echo $lin_usr['GRAL_USR_LOGIN']; ?>>
			              <?php echo $lin_usr['GRAL_USR_NOMBRES'].encadenar(1).
						             $lin_usr['GRAL_USR_AP_PATERNO'].encadenar(1).
									 $lin_usr['GRAL_USR_AP_MATERNO'];?></option>
            <?php } ?>
		    </select></td>
       </tr>
      
    <tr> 
         <th align="left" >Monto </th>
		 <td><input  type="text" name="egr_monto"> </td>
       </tr>
         <tr>
	         <th align="left">Descripcion </th>
			 <td><input type= type="text" name="descrip" size="50" maxlength="70"  >             </td>
		 </tr>
		 
		 
        </table>
	 <center>
	    
	 <input type="submit" name="accion" value="Grab_vale">
     <input type="submit" name="accion" value="Salir">

</form>
    <?php //} ?>
<?php
/*if ($_SESSION['detalle'] == 2){  //1a?>

<?php
$apli = 10000;
$_SESSION['monto_t'] = 0;
$_SESSION['monto_p'] = 0;
$_SESSION['monto_i'] = 0;
$_SESSION['monto_125'] = 0;
$_SESSION['monto_3'] = 0;
$_SESSION['t_fac_fis'] = 0;
$tc_ctb = $_SESSION['TC_CONTAB'];
$c_agen = $_POST['cod_agencia'];
$_SESSION['c_agen'] = $c_agen;
 $nro_tr_caj = leer_nro_co_cja($apli,$c_agen);
 
if ($_POST['descrip'] <> ""){  
	$descrip = $_POST['descrip'];
	$descrip = strtoupper ($descrip);
	$_SESSION['descrip'] = $descrip;
	}

 if ($_POST['egr_monto'] > 0){  
    if ($_SESSION['egre_bs_sus'] == 2){
	   $_SESSION['monto_eq'] = $_POST['egr_monto'];
         $monto_t = (($_POST['egr_monto'] * $_SESSION['TC_CONTAB'])* -1);
      }else{
	            $monto_t = ($_POST['egr_monto']* -1);
	  }			
				$_SESSION['monto_t'] =  $monto_t;
	}
$cta_ctbg = $_POST['cod_cta'];
$_SESSION['cta_ctbg'] =  $cta_ctbg;
//Factura
if(isset($_POST['cre_fac'])){
  $_SESSION['t_fac_fis'] = 2;
  
  $_SESSION['monto_i'] = $monto_t * .13 ;
  
  $_SESSION['monto_p'] = $monto_t - $_SESSION['monto_i'];
  $cta_f13 = 14306101;
  $_SESSION['cta_f13'] = $cta_f13;
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_f13'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctaf13 = $lin_ctable['CONTA_CTA_DESC'];
		 }	 
 }
 //Factura excenta
 if(isset($_POST['cre_fex'])){
  $_SESSION['t_fac_fis'] = 3;
  ?>
 <center>
   <tr> 
         <th align="left" >Importe Sujeto a Crédito Fiscal :</th>
		 <td><input  type="text" name="imp_exe"> </td>
       </tr>
<br><br>	   
 <input type="submit" name="accion" value="Recalcular">
 <input type="submit" name="accion" value="Salir">	
<br><br>	    
 <?php 
 
 }
 //Pago Servicios
 if(isset($_POST['cre_ser'])){
    $_SESSION['t_fac_fis'] = 4;
    $monto_imp = $monto_t * .1550;
    $monto_neto = $monto_t - $monto_imp;
	$monto_fis = ($monto_t * $monto_t) / $monto_neto;
	$cta_iue = 24203105; //
	$cta_it = 24203104;  // 
  $_SESSION['cta_iue'] = $cta_iue;
   $_SESSION['cta_it'] = $cta_it;
  $_SESSION['monto_fis'] = $monto_fis;
  $_SESSION['monto_125'] = $monto_fis * 0.125;
  $_SESSION['monto_3'] = $monto_fis * 0.03;
 // $cta_f13 = 14306101;
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_iue'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctaiue = $lin_ctable['CONTA_CTA_DESC'];
			     }	 
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_it'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctait = $lin_ctable['CONTA_CTA_DESC'];
			     }	 				 
 }
  if(isset($_POST['cre_bie'])){
    $_SESSION['t_fac_fis'] = 5;
    $monto_imp = $monto_t * .08;
    $monto_neto = $monto_t - $monto_imp;
	$monto_fis = ($monto_t * $monto_t) / $monto_neto;
	$cta_iue = 24203105; //
	$cta_it = 24203104;  // 
  $_SESSION['cta_iue'] = $cta_iue;
   $_SESSION['cta_it'] = $cta_it;
  $_SESSION['monto_fis'] = $monto_fis;
  $_SESSION['monto_125'] = $monto_fis * 0.05;
  $_SESSION['monto_3'] = $monto_fis * 0.03;
 // $cta_f13 = 14306101;
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_iue'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctaiue = $lin_ctable['CONTA_CTA_DESC'];
			     }	 
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_it'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctait = $lin_ctable['CONTA_CTA_DESC'];
			     }	 				 
 }

 
 
if ($_SESSION['t_fac_fis'] <> 3){ 
 
echo "Detalle Contable";

?>

 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr>
	
	
	
	
		           

<?php	
if ($_SESSION['egre_bs_sus'] == 1){
		      $imp_or = $_POST['egr_monto'];
			  $_SESSION['imp_or'] = $imp_or;
		      $importe = $monto_t;
			  $cta_ctb = 11101101;
			  $_SESSION['cta_ctb'] = $cta_ctb;
			  $importe_e =0;
			  $deb_hab = 2;
	 } else {
	         $imp_or = $_POST['egr_monto'] * $_SESSION['TC_CONTAB'];
			  $_SESSION['imp_or'] = $imp_or;
		      $importe = $monto_t;
			  $cta_ctb = 11101201;
			  $_SESSION['cta_ctb'] = $cta_ctb;
			  $importe_e =$_SESSION['monto_eq'];
			  $deb_hab = 2;
	 }		  
			  $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctb'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctable = $lin_ctable['CONTA_CTA_DESC'];
			     }
			  $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctableg = $lin_ctable['CONTA_CTA_DESC'];
			     }	 
	?>
	 
		<?php if(empty($_POST['cre_fac'])){
		       if(empty($_POST['cre_ser'])){ 
			     if(empty($_POST['cre_bie'])){ ?>
			      
        <tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format(($imp_or + $_SESSION['monto_i']), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		 <tr>
		 <td align="left" ><?php echo $cta_ctb; ?></td> 
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($importe_e, 2, '.',','); ?></td>
		</tr>
		 <?php } ?>
		 <?php } ?>
		 <?php } ?>
		<?php if(isset($_POST['cre_fac'])){ ?>
		
		<tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format(($imp_or + $_SESSION['monto_i']), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		 <tr>
		 <td align="left" ><?php echo $cta_f13; ?></td> 
		 <td align="left" ><?php echo $des_ctaf13; ?></td> 
		 <td align="right" ><?php echo number_format( ($_SESSION['monto_i'] * -1), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		<tr>
		 <td align="left" ><?php echo $cta_ctb; ?></td> 
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($importe_e, 2, '.',','); ?></td>
		</tr>
         <?php } ?>
		 <?php if(isset($_POST['cre_ser'])){ ?>
		 <tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_fis']* -1),2), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		 <tr>
		 <td align="left" ><?php echo $cta_ctb; ?></td> 
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($importe_e, 2, '.',','); ?></td>
		</tr>
		<tr>
		 <td align="left" ><?php echo $cta_iue; ?></td> 
		 <td align="left" ><?php echo $des_ctaiue; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_125'] * -1),2), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>	
		<tr>
		 <td align="left" ><?php echo $cta_it; ?></td> 
		 <td align="left" ><?php echo $des_ctait; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_3'] * -1),2), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
			
         <?php } ?>
	<?php if(isset($_POST['cre_bie'])){ ?>
		 <tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_fis']* -1),2), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		 <tr>
		 <td align="left" ><?php echo $cta_ctb; ?></td> 
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($importe_e, 2, '.',','); ?></td>
		</tr>
		<tr>
		 <td align="left" ><?php echo $cta_iue; ?></td> 
		 <td align="left" ><?php echo $des_ctaiue; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_125'] * -1),2), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>	
		<tr>
		 <td align="left" ><?php echo $cta_it; ?></td> 
		 <td align="left" ><?php echo $des_ctait; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_3'] * -1),2), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
			
         <?php } ?>	 
 </table> 
 	
<center>
 <input type="submit" name="accion" value="Imprimir">
     <input type="submit" name="accion" value="Salir">



 <?php } ?>
 <?php } ?>
 
 <?php 
 if ($_SESSION['detalle'] == 4){
    $imp_or = $_SESSION['monto_t'] * -1;
	//	      $importe = $monto_t;
	 $cta_ctb = 11101101;
	 $_SESSION['cta_ctb'] = $cta_ctb;
	// $importe_e =$monto_t;
	 $deb_hab = 2;
			  
	 $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctb'";
     $res_ctable = mysql_query($con_ctable);
	  while ($lin_ctable = mysql_fetch_array($res_ctable)) {
	        $des_ctable = $lin_ctable['CONTA_CTA_DESC'];
	     }
$cta_ctbg = $_SESSION['cta_ctbg'];
$con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctableg = $lin_ctable['CONTA_CTA_DESC'];
			     }	 		 
$_SESSION['t_fac_fis'] = 3;
 if(isset($_POST['imp_exe'])){
		    //echo "entra aqui?";
            $_SESSION['imp_exe'] = $_POST['imp_exe'];
			}
 if(isset($_SESSION['imp_exe'])){ 
  
  $monto_t = $_SESSION['imp_exe'];
  $_SESSION['monto_i'] = $monto_t * .13 ;
  
  $_SESSION['monto_p'] = $imp_or - $_SESSION['monto_i'];
  $cta_f13 = 14306101;
  $_SESSION['cta_f13'] = $cta_f13;
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_f13'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctaf13 = $lin_ctable['CONTA_CTA_DESC'];
		 }	 
     }
	 ?>
 	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr> 
	<tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format($_SESSION['monto_p'], 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		 <tr>
		 <td align="left" ><?php echo $cta_f13; ?></td> 
		 <td align="left" ><?php echo $des_ctaf13; ?></td> 
		 <td align="right" ><?php echo number_format( ($_SESSION['monto_i'] ), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		<tr>
		 <td align="left" ><?php echo $cta_ctb; ?></td> 
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
	</table> 	
<center>	
     <input type="submit" name="accion" value="Imprimir">
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
  <?php } ?>
	 
</div>
  <?php
  */
		 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
ob_end_flush();
 ?>