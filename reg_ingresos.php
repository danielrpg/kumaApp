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
<title>Registro de Ingresos</title>
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
                	<img src="images/24x24/001_35.png" border="0" alt="" />Registro Ingresos
          </div> 
              <div id="AtrasBoton">
           		<a href="egre_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<div id="GeneralManCliente">
<!-- <form name="form2" method="post" action="egre_retro_1.php" style="border:groove" onSubmit="return"> >-->
  <form name="form2" method="post" action="egre_retro_3.php" onSubmit="return ValidaCamposEgresos(this)">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios


if ($_SESSION['detalle'] == 1){
   $borr_cob  = "Delete From temp_ctable "; 
    $cob_borr = mysql_query($borr_cob)or die('No pudo borrar temp_ctable');
   $consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
   $cod_mon = 0;
  // $nro = 0; 
   $des_mon = "";
   if (isset($_SESSION['egre_bs_sus'])){
       if ($_SESSION['egre_bs_sus'] == 1){
          $cod_mon = 1;
	      $des_mon = "Bolivianos";
		  $mon_des = "Monto en Bolivianos:";
        }	
       if ($_SESSION['egre_bs_sus'] == 2){
          $cod_mon = 2;
	      $des_mon = "Dolares";
		  $mon_des = "Monto en Dolares:";
       }
	   $_SESSION['des_mon'] = $des_mon;
	   $_SESSION['cre_nor'] = "SI";
   }
$con_tse  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 40 and GRAL_PAR_PRO_COD <> 0 order by 2 ";
$res_tse = mysql_query($con_tse)or die('No pudo seleccionarse tabla')  ;



$con_ope  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD <> 0
             ORDER BY GRAL_PAR_PRO_COD DESC LIMIT 0,10";
$res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla')  ;


$con_ctas  = "Select * From contab_cuenta where CONTA_CTA_MONE = $cod_mon													   and CONTA_CTA_NIVEL = 'A'";
$res_ctas = mysql_query($con_ctas)or die('No pudo seleccionarse tabla2')  ;

//$datos = $_SESSION['form_buffer'];
 ?>
  <table align="center">
    <tr>
        <th align="left">Moneda  </th>
		<th align="left" style="font-size:19px" ><?php echo $des_mon; ?></td>
     </tr>
     <tr>
        <th align="left">Agencia :</th>
	    <td> <select name="cod_agencia" size="1"  >
	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
			              <?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
            <?php } ?>
		    </select></td>
       </tr>
	  
			
     
	    </table>
		<center>
	   <input type="submit" name="accion" value="Detalle">
	     
	</form>
	<center>
	<strong>
	<?php } 
	if ($_SESSION['detalle'] == 2){
	//$nro = 1;
	   
	?>
	</strong>
	
	<?php	
	$con_cga  = "Select * From gral_cta_ingegre where gral_ingegre_tip = 1  order by 3 ";
	$res_cga = mysql_query($con_cga)or die('No pudo seleccionarse tabla gral_ingegre_tip')  ;	
	
/*if ($_SESSION['continuar'] == 1){	
if(isset($_POST['cod_ope'])){ 
   $quecom = $_POST['cod_ope'];
   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
      if( isset($quecom[$i]) ) {
         $cod_ope = $quecom[$i];
		 $_SESSION['cod_ope'] =  $cod_ope;
         }
      }
	}	
	$con_ope  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD = $cod_ope
             ORDER BY GRAL_PAR_PRO_COD DESC LIMIT 0,10";
$res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla')  ;	
	while ($linope = mysql_fetch_array($res_ope)) { 	
		$nom_ope = $linope['GRAL_PAR_PRO_DESC'];
		$_SESSION['nom_ope'] = $nom_ope;
		 $_SESSION['cod_ope'] =  $cod_ope;
	}
		
	}else{
	$nom_ope = $_SESSION['nom_ope'];
	} */
	 echo "Moneda".encadenar(2).$_SESSION['des_mon']; 
	?>
	<strong>
	<center>
	<?php
	 //echo $nom_ope;
	 ?>
	 </strong>
	 <form name="form2" method="post" action="egre_retro_3.php" onSubmit="return ValidaCamposEgresos(this)">
	 
	  <table align="center">
	    <tr> 
        <th align="left">Cuenta Egresos :</th>
	    <td> <select name="cod_cta" size="1"  >
	        <?php while ($lin_cga = mysql_fetch_array($res_cga)) { ?>
            <option value=<?php echo $lin_cga['gral_ingegre_cta']; ?>>
			              <?php echo $lin_cga['gral_ingegre_cta']; ?>
			              <?php echo $lin_cga['gral_ingegre_desc']; ?></option>
            <?php } ?>
		    </select></td>
       </tr>
	   <tr> 
         <th align="left" ><?php echo "Monto"; ?></th>
		 <td><input  type="text" name="egr_monto" value="0"> </td>
       </tr>
    <?php if ($_SESSION['egre_bs_sus'] == 2){ ?>
	    <tr> 
         <th align="left" ><?php echo "Tipo Cambio"; ?></th>
		 <td><input  type="text" name="t_c" value="<?php echo $_SESSION['TC_CONTAB']; ?>"> </td>
       </tr>
	<?php } ?>
         <tr>
	         <th align="left">Descripcion :</th>
			 <td><input type= type="text" name="descrip" size="50" maxlength="70" value="-" > </td>
		 </tr>
		 
		 
        </table>
	 <center>
	    
	 <input type="submit" name="accion" value="Añadir">
    

</form>

<table align="center" border="1">
	 <tr>
       	<td align="center"><strong>Nro.  </strong></td>
		<td align="center"><strong>Grupo </strong> </td>
		<td align="center"><strong>Descripcion </strong></td>
		<td align="center"><strong>Monto Bs. </strong></td>
		<td align="center"><strong>Monto Dol.</strong></td>
		<td align="center"><strong>Mod./Eli.</strong></td>
   </tr>
<?php
$consulta  = "Select * From temp_ctable order by temp_debe_2";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
	      $tip_gas = $linea['temp_nro_cta'];
		  $con_cga1  = "Select * From gral_cta_ingegre where gral_ingegre_tip = 1 and 
		                gral_ingegre_cta =  $tip_gas";
	      $res_cga1 = mysql_query($con_cga1)or die('No pudo seleccionarse tabla gral_ingegre_tip 2');
		   while ($lin_cga1 = mysql_fetch_array($res_cga1)) { 
		  $desc_gas = $lin_cga1['gral_ingegre_desc'];
		   }
		  	
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
		       <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
	 	      <td align="left"><?php echo  $desc_gas; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
			  <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',','); ?></td>
		      <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_debe_1']; ?>">	</td> 
	     </tr>
	 <?php }
     ?>
	     <tr>
		       <td align="right"><?php echo encadenar(2) ; ?></td>
	 	      <th align="center"><?php echo "TOTAL"; ?></td>
		      <td align="left"><?php echo encadenar(2); ?></td>
		      <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></td>
		       <th align="right"><?php echo number_format($tot_debe_2, 2, '.',','); ?></td>
	     </tr>
		 
	 <input type="submit" name="accion" value="Mod_Monto">  
	 <input type="submit" name="accion" value="Eliminar">
	 <input type="submit" name="accion" value="Grab_Ingresos">
	 <?php }
	 if(isset($_SESSION['modificar'])){ 
 if ($_SESSION['modificar'] == 1){
   // echo $_SESSION['entra'];
    if(isset($_POST['cmone'])){ //2a
       $cmone = $_POST['cmone'];
	   $_SESSION['cmone'] = $cmone;
	 // echo $_SESSION['cmone'];?>
	 <form name="form2" method="post" action="egre_retro_3.php" onSubmit="">
  <?php
	 $con_modi  = "Select * From temp_ctable where temp_debe_1 = $cmone";
     $res_modi = mysql_query($con_modi);
	   while ($lin_modi = mysql_fetch_array($res_modi)) { ?>
	<table align="center" border="1">
	   <tr>
       	<td align="center"><strong>Nro.  </strong></td>
		<td align="center"><strong>Grupo </strong> </td>
		<td align="center"><strong>Descripcion </strong></td>
		<td align="center"><strong>Monto Bs.</strong></td>
		<td align="center"><strong>Monto Dol.</strong></td>
		<td align="center"><strong>Nuevo Monto</strong></td>
   </tr>
	  <tr>
	          <td align="right"><?php echo number_format($lin_modi['temp_debe_1'], 0, '.',',') ; ?></td>
	 	      <td align="left"><?php echo $lin_modi['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $lin_modi['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($lin_modi['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($lin_modi['temp_debe_2'], 2, '.',','); ?></td>
		      <td><input  type="text" name="nue_cant"> </td>	
	     </tr>
	</table>
	<input type="submit" name="accion" value="Grab_mod">

</form>		 
   <?php 
		 
	   }
	 }
	 }
	 }
	 
    ?>
<?php
if ($_SESSION['detalle'] == 3){  //1a
    $con_trc = "SELECT count(*) FROM temp_ctable";
   $res_trc = mysql_query($con_trc)or die('No pudo seleccionarse tabla cajero');
   while ($lin_trc = mysql_fetch_array($res_trc)) {
         $nro =  $lin_trc['count(*)'];
      }
    if (isset ($nro )){
	     $nro = $nro + 1;
	      }else{
	      $nro = 1;
		 }
   
   // $nro = $nro + 1;
	
$apli = 10000;
$_SESSION['c_agen'] = 0;
//$_SESSION['cod_ope'] = 0;
$_SESSION['cod_gas'] = 0;
$_SESSION['monto_eq'] = 0;
$_SESSION['monto_t'] = 0;
$_SESSION['descrip'] = 0;
$monto_eq = 0;
if ($_POST['t_c'] <> ""){  
	$tc_ctb = $_POST['t_c'];
	//$descrip = strtoupper ($descrip);
	$_SESSION['tc_ctb'] = $tc_ctb;
	}else{
	$tc_ctb = 0;
	}
//$tc_ctb = $_SESSION['TC_CONTAB'];
//$c_agen = $_POST['cod_agencia'];
//$_SESSION['c_agen'] = $c_agen;
 $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
 
if ($_POST['descrip'] <> ""){  
	$descrip = $_POST['descrip'];
	$descrip = strtoupper ($descrip);
	$_SESSION['descrip'] = $descrip;
	}

 if ($_POST['egr_monto'] > 0){  
    if ($_SESSION['egre_bs_sus'] == 2){
	   $_SESSION['monto_eq'] = $_POST['egr_monto'];
	     $monto_eq = $_SESSION['monto_eq'];
         $monto_t = (($_POST['egr_monto'] * $_SESSION['tc_ctb']));
      }else{
	            $monto_t = ($_POST['egr_monto']);
	  }			
				$_SESSION['monto_t'] =  $monto_t;
	}
$cta_ctbg = $_POST['cod_cta'];
$_SESSION['cta_gas'] =  $cta_ctbg;
echo $nro."nro aqui".$_SESSION['cod_ope']."ope";
$cod_ope = $_SESSION['cod_ope'];

$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cod_ope,
										   '$cta_ctbg',
									       '$descrip',
										   $nro,
										   $monto_t,
										   $monto_eq,
										   $tc_ctb)";
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable uno : ' . mysql_error());	
?>
<table align="center" border="1">
	  <tr>
       	<td align="center"><strong>Nro.  </strong></td>
		<td align="center"><strong>Grupo </strong> </td>
		<td align="center"><strong>Descripcion </strong></td>
		<td align="center"><strong>Monto </strong></td>
		<td align="center"><strong>Monto Equiv.</strong></td>
		<td align="center"><strong>Mod./Eli.</strong></td>
   </tr>

<?php
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
		       <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
			   <td align="right"><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		      <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_debe_1']; ?>">	</td> 
	     </tr>
		
		 
		 <input type="submit" name="accion" value="Mod_cant">  
	 <input type="submit" name="accion" value="Eliminar">
	 <input type="submit" name="accion" value="Grab_Ingresos">
	 
    

</form>
	 <?php } ?>	 
<?php		 
 $_SESSION['continuar'] = 2;
 $_SESSION['detalle'] = 2 ;
header('Location: reg_ingresos.php');
}
if(isset($_SESSION['grab_mod'])){  
 if ($_SESSION['grab_mod'] == 1){
   // echo $_SESSION['entra'];
    if(isset($_POST['nue_cant'])){ //2a
       $nue_cant = $_POST['nue_cant'];
	   $_SESSION['nue_cant'] = $nue_cant;
	  echo $_SESSION['cmone']."aqui".$nue_cant;?>
	 <form name="form2" method="post" action="egre_retro_3.php" onSubmit="">
  <?php
     $cmone = $_SESSION['cmone']; 
	 
	  if ($_SESSION['egre_bs_sus'] == 1){
	 $con_modi  = "update temp_ctable set temp_haber_1 = $nue_cant
	                                      where temp_debe_1 = $cmone";
	  }else{
	  $con_modi  = "update temp_ctable set temp_haber_1 = $nue_cant * temp_haber_2,
	                                       temp_debe_2 = $nue_cant 
	                                      where temp_debe_1 = $cmone";
	  
	  }
     $res_modi = mysql_query($con_modi);
 
$_SESSION['continuar'] = 2;
 $_SESSION['detalle'] = 2 ;
header('Location: reg_ingresos.php');
	 
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
		       <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
			   <td align="right"><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		      <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_debe_1']; ?>">	</td> 
	     </tr>
		
		 
		 <input type="submit" name="accion" value="Mod_cant">  
	 <input type="submit" name="accion" value="Eliminar">
	 <input type="submit" name="accion" value="Grab_Ingresos">
	 
    

</form>
	 <?php } 
	 
   }
}
}
?>
	
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
	 $consulta  = "Delete From temp_ctable where temp_debe_1 = $cmone";
     $resultado = mysql_query($consulta);
	 
	$consulta  = "Select * From temp_ctable ";
    $resultado = mysql_query($consulta); 
	$nro = 0;
	 while ($linea = mysql_fetch_array($resultado)) {
	 $nro = $nro + 1;
	 $nro1 = $linea['temp_debe_1'];
	  $con_modi  = "update temp_ctable set temp_debe_1 = $nro
	                                      where temp_debe_1 = $nro1";
     $res_modi = mysql_query($con_modi);
	 
	        
	}
$_SESSION['continuar'] = 2;
 $_SESSION['detalle'] = 2 ;
header('Location: reg_ingresos.php');
}
}
}
//Factura
/*if(isset($_POST['cre_fac'])){
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
 */
 //Factura excenta
 /*
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
 
 }*/
 //Pago Servicios
 /*
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
 <input type="submit" name="accion" value="Imprimir 2">
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
 
 
 
 
 
 
 
/*if ($_SESSION['detalle'] == 3){
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
  <?php } */ ?>
	 
</div>
  <?php
		 //	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
ob_end_flush();
 ?>