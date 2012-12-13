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
<title>Mantenimiento Clientes</title>
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
                    Consulta de Clientes
            </div>
             <div id="AtrasBoton">
           		<a href="cliente_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$datos = $_SESSION['form_buffer'];
$ciiu_r = 0;
$cod_c = $_POST['cod_cliente'];
//for( $i=0; $i < count($quecom); $i = $i + 1 ) {
// if( isset($quecom[$i]) ) {
 //   $cod_c = $quecom[$i];
// }
//}

//echo $_SESSION['cod_cli'],$_SESSION['consul'];
$con_cli = "Select * From cliente_general where CLIENTE_COD = $cod_c and CLIENTE_USR_BAJA is null";
$res_cli = mysql_query($con_cli)or die('No pudo seleccionarse tabla 1')  ;
while ($linea = mysql_fetch_array($res_cli)){
$_SESSION['nro_cli']= $linea['CLIENTE_NUMERICO'];
$_SESSION['tip_doc']= $linea['CLIENTE_TIP_ID'];
$cod_agen = $linea['CLIENTE_AGENCIA'];
$cod_ant = $linea['CLIENTE_COD_ANT'];
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
$datos['nombres'] = $linea['CLIENTE_NOMBRES']; 
$datos['ap_pater']  = $linea['CLIENTE_AP_PATERNO'];
$datos['ap_mater']  = $linea['CLIENTE_AP_MATERNO'];
$datos['ap_espos']  = $linea['CLIENTE_AP_ESPOSO'];
$datos['lug_nac']  = $linea['CLIENTE_LUG_NAC'];
$f_nac = $linea['CLIENTE_FCH_NAC'];
$datos['fec_nac']= cambiaf_a_normal($f_nac);
$datos['direc'] = $linea['CLIENTE_DIRECCION'];
$datos['barrio'] = $linea['CLIENTE_ZONA'];
$datos['fono'] = $linea['CLIENTE_FONO'];
$datos['celu'] = $linea['CLIENTE_CELULAR'];
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
$datos['ocu_con'] = $linea['CLIENTE_CARGO'];
}
//$con_age = "Select * From gral_agencia where GRAL_AGENCIA_CODIGO = $cod_agen and GRAL_AGENCIA_USR_BAJA is null ";
//$res_age = mysql_query($con_age)or die('No pudo seleccionarse tabla 2')  ;
// while ($linea = mysql_fetch_array($res_age)) {
 //      $age_r = $linea['GRAL_AGENCIA_NOMBRE'];
 //   } 
$con_age = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$res_age = mysql_query($con_age)or die('No pudo seleccionarse tabla 2')  ;
$con_tper  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 22 and GRAL_PAR_PRO_COD = $cod_tper ";
$res_tper = mysql_query($con_tper)or die('No pudo seleccionarse tabla 2')  ;
while ($linea = mysql_fetch_array($res_tper)) {
    $tper_r =  $linea['GRAL_PAR_PRO_DESC']; 
 } 
//$con_bar1  = "Select * From gral_barrios where gral_barr_codigo = $cod_barr1";
//$res_bar1= mysql_query($con_bar1)or die('No pudo seleccionarse tabla 2')  ;
// while ($linea = mysql_fetch_array($res_bar1)) {
  $barrio =  $datos['barrio']; 
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
    <td width="25%"><strong><?php echo "Codigo ".encadenar(10); ?> </strong></td>
	<td width="1%"><?php echo encadenar(1); ?></td>
    <td width="45%"align="left" ><font  color="#000099"><?php echo $cod_c;?></font></td>	 
   	</tr>	
	<tr>
    <td width="25%"><strong><?php echo "Codigo Anterior".encadenar(10); ?> </strong></td>
	<td width="1%"><?php echo encadenar(1); ?></td>
    <td width="45%"align="left" ><font  color="#000099"><?php echo $cod_ant;?></font></td>	 
   	</tr>	
	 <tr>
    <td width="25%"><strong><?php echo "Doc. Identificacion".encadenar(10); ?> </strong></td>
	<td width="1%"><?php echo encadenar(1); ?></td>
    <td width="45%"align="left" ><font  color="#000099"><?php echo $datos['ci'];?></font></td>	 
   	</tr>	
	<tr>
    <td width="25%"><strong><?php echo "Tipo Cliente".encadenar(10); ?> </strong></td>
	<td width="1%"><?php echo encadenar(1); ?></td>
    <td width="45%"align="left" ><font  color="#000099"><?php echo $tper_r;?></font></td>	 
   
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
      <td><strong>Fec Nacimiento</strong></td>
	  <td><?php echo encadenar(1); ?></td>
      <td><font color="#000099"><?php echo $datos['fec_nac'];?></td>
	  </tr>
	  <tr>
	   <td><strong>Barrio </strong></td>
	   <td><?php echo encadenar(1); ?></td>
      <td align="left" <font color="#000099"><?php echo $barrio;?></font></td>	 
	 </tr>
	 <tr>
	    <td><strong>Direccion</strong></td>
		 <td><?php echo encadenar(1); ?></td>
		 <td align="right" width="250" style="text-align:justify" ><font color="#000099">
		 <?php echo $datos['direc'];?>
		 </td>	
		 </tr>
	   <tr>
         <td><strong>Tel. Fijo</strong></td>
		 <td><?php echo encadenar(1); ?></td>
         <td align="right" width="30" style="text-align:justify" ><font color="#000099">
		    <?php echo $datos['fono'];?></td>
	  </tr>
	  <tr>	 
        <td><strong>Tel. Celular</strong></td>
		<td><?php echo encadenar(1); ?></td>
        <td align="right" width="30" style="text-align:justify" ><font color="#000099">
		    <?php echo $datos['celu'];?></td>
      </tr>
	  <tr>
        <td><strong>E-mail</strong></td>
		<td><?php echo encadenar(1); ?></td>
       <td align="right" width="30" style="text-align:justify" ><font color="#000099">
		    <?php echo $datos['email'];?></td>
	  </tr>
	 <tr>
        <td><strong>Recordatorio</strong></td> 
		<td><?php echo encadenar(1); ?></td>
	 <?php if  ($tip_viv == 1){?>
	<td width="3%"><img src="img/check.jpg"></td>
	<?php }else{?>
	<td width="3%"><?php echo encadenar(2);?></td>
	<?php }?>
	</tr>
	  </table>
	 <?php
 $nroord = 0;
$_SESSION['consul'] = 1;
$_SESSION['cod_cli2']= $cod_c;	 
	  //Servicios anteriores
$con_sera = "Select * From ord_maestro where ORD_COD_CLI = $cod_c
            and ORD_MAE_USR_BAJA is null ORDER BY ORD_FEC_SOL
			DESC LIMIT 0,1 ";
$res_sera= mysql_query($con_sera)or die('No pudo seleccionarse tabla ord_maestro');
  while ($lin_sera = mysql_fetch_array($res_sera)){
         $nroord = $lin_sera['ORD_NUMERO'];
		 $fech_sera = cambiaf_a_normal($lin_sera['ORD_FEC_SOL']);
		       
       //  echo $lin_sera	['ORD_NUMERO'].encadenar(2). 
       //       $lin_sera	['ORD_FEC_SOL'].encadenar(2).
	//		  $lin_sera	['ORD_IMPORTE'];
if ($nroord > 0 ){	
		$con_serv = "Select * From ord_detalle
		              where ORD_DET_ORD = $nroord 
		              and  ORD_DET_USR_BAJA is null";
	$servicios = "";
	$com = "";
	$impo_sera = 0;				  
          $res_serv= mysql_query($con_serv)or die('No pudo seleccionarse tabla ord_detalle');			  while ($lin_serv = mysql_fetch_array($res_serv)){
	      $cod_serv = $lin_serv['ORD_DET_GRP'];
		  $comen = $lin_serv['ORD_DET_COMEN'];
		  $impo = $lin_serv['ORD_DET_MONTO'];
		  $servicios = $servicios.encadenar(2).$cod_serv;
		  $com = $com.encadenar(1).$comen;
		  $impo_sera = $impo_sera + $impo;
		   }	  
	}
$_SESSION['fech_sera']=$fech_sera;	
$_SESSION['servicios']=$servicios;
$_SESSION['impo_sera']=$impo_sera;	
$_SESSION['com']=$com;	
?>
<strong style="font-size:18px">
 <?php 
echo "Ultimo Servicio Anterior";
?>
</table>
<table width="90%"  border="2" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />Nro Orden</th> 
	  <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />Fecha</th> 
	  <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />Servicio(s)</th>
<th width="20%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />Importe</th>
<th width="45%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />Comentario</th>	  
		 
	  </tr>
	  
	  	
	<td bgcolor="#66CCFF" style="top:auto" style="font-size:12px" ><?php echo $nroord;  ?></td>
	<td bgcolor="#66CCFF" style="text-align:justify" style="font-size:12px"><?php echo  $fech_sera;?></td>
	<td bgcolor="#66CCFF" style="text-align:justify" style="font-size:11px"> <?php echo $servicios;  ?></td>
    <td bgcolor="#66CCFF" style="top:auto" style="font-size:12px" align="right"><?php echo number_format($impo_sera, 2, '.',',');  ?></td>
    <td bgcolor="#66CCFF" style="text-align:justify" style="font-size:11px"> <?php echo $com;  ?></td>					
 </table>
	  
	<?php  
	  }
	 ?> 
	 <center>
	   <td><input type="submit" name="accion" value="Kardex"></td>
	  <td> <input type="submit" name="accion" value="Salir"></td>
     </tr> 
 
    
	
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