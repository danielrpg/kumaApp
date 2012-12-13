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
<title>Fusion de Datos de Cliente</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"></script>
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
                 $logi = $_SESSION['login']; 
                ?> 
			</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                    Fusion de Datos de Cliente
            </div>
             <div id="AtrasBoton">
           		<a href="cliente_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$datos = $_SESSION['form_buffer'];
$ciiu_r = 0;
if ($_SESSION['continuar'] == 1){
$cod_c = $_POST['cod_cliente'];
$_SESSION['cod_cli']= $cod_c;
}else{
$cod_c = $_SESSION['cod_cli'];
}
//for( $i=0; $i < count($quecom); $i = $i + 1 ) {
// if( isset($quecom[$i]) ) {
 //   $cod_c = $quecom[$i];
// }
//}

//echo $_SESSION['cod_cli'],$_SESSION['consul'];
$con_cli = "Select *  From cliente_general where CLIENTE_COD = $cod_c and CLIENTE_USR_BAJA is null";
$res_cli = mysql_query($con_cli)or die('No pudo seleccionarse tabla 1')  ;
while ($linea = mysql_fetch_array($res_cli)){
$cod_ant = $linea['CLIENTE_COD_ANT'];
$fono = $linea['CLIENTE_FONO'];
$_SESSION['fono'] = $fono;
$datos['nombres'] = $linea['CLIENTE_NOMBRES']; 
$datos['ap_pater']  = $linea['CLIENTE_AP_PATERNO'];
$datos['ap_mater']  = $linea['CLIENTE_AP_MATERNO'];
$datos['ap_espos']  = $linea['CLIENTE_AP_ESPOSO'];
$datos['direc'] = $linea['CLIENTE_DIRECCION'];
$datos['fono'] = $linea['CLIENTE_FONO'];
$datos['celu'] = $linea['CLIENTE_CELULAR'];
/*$_SESSION['nro_cli']= $linea['CLIENTE_NUMERICO'];
$_SESSION['tip_doc']= $linea['CLIENTE_TIP_ID'];
$cod_agen = $linea['CLIENTE_AGENCIA'];

$cod_tper = $linea['CLIENTE_TIP_PER'];
$cod_tid = $linea['CLIENTE_TIP_ID'];
$cod_sex = $linea['CLIENTE_SEXO'];
$cod_civ = $linea['CLIENTE_EST_CIVIL'];
$cod_ana = $linea['CLIENTE_ALFAB'];
$cal_int = $linea['CLIENTE_CAL_INT'];
$cod_barr = $linea['CLIENTE_ZONA'];
$tip_viv = $linea['CLIENTE_VIVIEN'];
$datos['cod'] = $linea['CLIENTE_COD'];
$datos['ci'] = $linea['CLIENTE_COD_ID'];
$_SESSION['ci'] = $linea['CLIENTE_COD_ID'];
$_SESSION['cod_ant'] =$cod_ant;

$datos['lug_nac']  = $linea['CLIENTE_LUG_NAC'];
$f_nac = $linea['CLIENTE_FCH_NAC'];
$datos['fec_nac']= cambiaf_a_normal($f_nac);

$datos['barrio'] = $linea['CLIENTE_ZONA']; */
//
/*
$datos['email'] = $linea['CLIENTE_EMAIL'];
$datos['dir_tr'] = $linea['CLIENTE_DIR_TRAB'];
$datos['fon_t'] = $linea['CLIENTE_FONO_TRAB'];
$datos['eco_uno'] = $linea['CLIENTE_SECTOR1'];
$datos['eco_dos'] = $linea['CLIENTE_SECTOR2'];
$datos['ant_tr'] = $linea['CLIENTE_ANT_ACT'];
$datos['zon_tr'] = $linea['CLIENTE_ZON_TRAB'];
$datos['nom_ref'] = $linea['CLIENTE_NOM_REF'];
$datos['dir_ref'] = $linea['CLIENTE_DIR_REF'];
$datos['fon_ref'] = $linea['CLIENTE_FON_REF'];
$datos['nom_con'] = $linea['CLIENTE_NOM_CONYUGE'];
$datos['ci_con'] = $linea['CLIENTE_CI_CONYUGE'];
$datos['ocu_con'] = $linea['CLIENTE_CARGO']; */
}
//$con_age = "Select * From gral_agencia where GRAL_AGENCIA_CODIGO = $cod_agen and GRAL_AGENCIA_USR_BAJA is null ";
//$res_age = mysql_query($con_age)or die('No pudo seleccionarse tabla 2')  ;
// while ($linea = mysql_fetch_array($res_age)) {
 //      $age_r = $linea['GRAL_AGENCIA_NOMBRE'];
 //   } 
/*$con_age = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$res_age = mysql_query($con_age)or die('No pudo seleccionarse tabla 2')  ;
$con_tper  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 22 and GRAL_PAR_PRO_COD = $cod_tper ";
$res_tper = mysql_query($con_tper)or die('No pudo seleccionarse tabla 2')  ;
while ($linea = mysql_fetch_array($res_tper)) {
    $tper_r =  $linea['GRAL_PAR_PRO_DESC']; 
 } */
//$con_bar1  = "Select * From gral_barrios where gral_barr_codigo = $cod_barr1";
//$res_bar1= mysql_query($con_bar1)or die('No pudo seleccionarse tabla 2')  ;
// while ($linea = mysql_fetch_array($res_bar1)) {
 // $barrio =  $datos['barrio']; 
//	$det_barr = $linea['gral_barr_detalles'];
 //} 

//$con_barr  = "Select * From gral_barrios order by 2 ";
//$res_barr= mysql_query($con_barr)or die('No pudo seleccionarse tabla 2')  ;

 ?>
 <div id="GeneralManCliente">
 
 
 </strong>
<!--<form name="form2" method="post" action="grab_retro_cli.php" target="_self" >-->
<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCamposClientesMod(this)">
                                                                             
<strong style="font-size:18px">
<?php // echo "Codigo".encadenar(3).$cod_c.encadenar(3)."Doc. Identificacion".encadenar(3).$datos['ci'];?>
</strong>
<br>
<table width="90%" border="2" cellspacing="1" cellpadding="1" align="center">
    <tr>
    <td width="25%"><strong><?php echo "Codigos ".encadenar(10); ?> </strong></td>
	<td width="1%"><?php echo encadenar(1); ?></td>
    <td width="45%"align="left" ><font  color="#000099"><?php echo "Cod. Anterior".
	   encadenar(2).$cod_ant.encadenar(2)."Cod. Actual".
	   encadenar(2).$cod_c;?></font></td>	 
   	</tr>	
    <tr>
      <td><strong>  Nombres Completo   </strong></td>
	  <td><?php echo encadenar(1); ?></td>
      <td><font color="#000099"><?php echo $datos['nombres'].encadenar(2).
	                                       $datos['ap_pater'].encadenar(2).
										   $datos['ap_mater'].encadenar(2).
										   $datos['ap_espos'];?></font></td>
	</tr>
	 <tr>
	    <td><strong>Direccion</strong></td>
		 <td><?php echo encadenar(1); ?></td>
		 <td align="right" width="30" style="text-align:justify" ><font color="#000099">
		 <?php echo $datos['direc'];?>
		 </td>	
		 </tr>
	   <tr>
         <td><strong>Telefonos </strong></td>
		 <td><?php echo encadenar(1); ?></td>
         <td align="right" width="30" style="text-align:justify" ><font color="#000099">
		    <?php echo $datos['fono'].encadenar(2)."-".encadenar(2).$datos['celu'];?></td>
	  </tr>
	 
	  </table>
	 <?php
	 
	 
	 
 $nroord = 0;
$_SESSION['consul'] = 1;
$_SESSION['cod_cli2']= $cod_c;	 
	  //Servicios anteriores
$fon_fijo = "%".$fono."%"; 
	//echo $fon_fijo;
	$consulta  = "Select * From cliente_general where CLIENTE_FONO like '$fon_fijo'
	              and  CLIENTE_COD <> $cod_c
	              and CLIENTE_USR_BAJA is null order by 9,8";
    $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
	 ?>
 
Otros Clientes con el mismo Telefono
<br>
	   <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
	 <strong>
	  <tr>
	  <th style="font-size:14px">Codigo </th>
	   <th style="font-size:14px">Nombre Cliente</th>
	   <th style="font-size:14px">Direccion</th>
	   <th style="font-size:14px">Telefono</th> 
	  </tr>
  <?php 
  
  while ($linea = mysql_fetch_array($resultado)) {
     $_SESSION['cli_usr'] = 2;
	 $nombre = $linea['CLIENTE_AP_PATERNO'].encadenar(1).
	           $linea['CLIENTE_AP_MATERNO'].encadenar(1).  
			   $linea['CLIENTE_AP_ESPOSO'].encadenar(1).
			   $linea['CLIENTE_NOMBRES']; 
	 $direc = substr($linea['CLIENTE_DIRECCION'],0,30);
	 $telef = $linea['CLIENTE_FONO']."-".$linea['CLIENTE_CELULAR'];?>
	  
 <tr>	  
 
	<td align="center" style="font-size:10px"><?php echo $linea['CLIENTE_COD_ANT'];?> </td>
	<td style="font-size:11px"><?php echo  $nombre;?> </td>
	<td style="font-size:11px"><?php echo  $direc;?> </td>
	<td style="font-size:11px"><?php echo $telef;?> </td>
	 

</tr>			
  	  <?php // }
	  } 
  
  ?>
 
  </table>
 
 <?php 	
if ($_SESSION['continuar'] == 1){
 ?>	  
	 <center>
	   <td><input type="submit" name="accion" value="Fusionar"></td>
	  <td> <input type="submit" name="accion" value="Salir"></td>
     </tr> 
 
   <?php  }  ?>  
	
</form>
 <?php
if ($_SESSION['continuar'] == 2){
 ?>
    <form name="form2" method="post" action="grab_retro_clim.php" onSubmit="return ValidaCamposClientesMod(this)">
 <?php	
    $codigo = $_SESSION['cod_cli'];
	$_SESSION['cod_cli'] =  $codigo;
	$telefono = $_SESSION['fono'];
	//echo "Cambiar";
	$consulta  = "Select * From cliente_general where CLIENTE_FONO like '$fon_fijo'
	              and  CLIENTE_COD <> $codigo
	              and CLIENTE_USR_BAJA is null order by 9,8";
    $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
	while ($linea = mysql_fetch_array($resultado)) {
	      $cod  =$linea['CLIENTE_COD'];
		  $cod_ant = $linea['CLIENTE_COD_ANT'];
		  $act_cli_orden  = "update ord_maestro set ORD_COD_CLI=$codigo,ORD_COD_CLIA ='$cod_ant'
		                     where ORD_COD_CLI =$cod and ORD_MAE_USR_BAJA is null";
          $res_cli_orden = mysql_query($act_cli_orden) or die('No pudo actualizar ord_maestro : ' . mysql_error()); 
		  $act_cli_baja  = "update cliente_general set CLIENTE_USR_BAJA='$logi'
		                     where CLIENTE_COD =$cod and CLIENTE_USR_BAJA is null";
          $res_cli_baja = mysql_query($act_cli_baja) or die('No pudo actualizar cliente_general : ' . mysql_error());
		  
	
	}
	 
	} 
 ?>	
 <?php 	
if ($_SESSION['continuar'] == 2){
 ?>	 
 <center> 
     <input type="submit" name="accion" value="Kardex">
 <?php  }  ?>  	 
</form>	 
</div>
<div id="FooterTable"> 
Modifique los datos generales del Cliente
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