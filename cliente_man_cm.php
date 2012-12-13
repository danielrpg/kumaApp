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
                    Mantenimiento Clientes
            </div>
             <div id="AtrasBoton">
           		<a href="cliente_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$datos = $_SESSION['form_buffer'];
$ciiu_r = 0;
$cod_c = $_POST['cod_cliente'];
/*$quecom = $_POST['cod_cliente'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_c = $quecom[$i];
 }
}*/
$_SESSION['cod_cli']= $cod_c;
$con_cli = "Select * From cliente_general where CLIENTE_COD = $cod_c and CLIENTE_USR_BAJA is null";
$res_cli = mysql_query($con_cli)or die('No pudo seleccionarse tabla 1')  ;
while ($linea = mysql_fetch_array($res_cli)){
$_SESSION['nro_cli']= $linea['CLIENTE_NUMERICO'];
$_SESSION['tip_doc']= $linea['CLIENTE_TIP_ID'];
$cod_ant = $linea['CLIENTE_COD_ANT'];
$_SESSION['cod_ant'] =$cod_ant;
$cod_agen = $linea['CLIENTE_AGENCIA'];
$cod_tper = $linea['CLIENTE_TIP_PER'];
$cod_tid = $linea['CLIENTE_TIP_ID'];
$cod_sex = $linea['CLIENTE_SEXO'];
$cod_civ = $linea['CLIENTE_EST_CIVIL'];
$cod_ana = $linea['CLIENTE_ALFAB'];
$cal_int = $linea['CLIENTE_CAL_INT'];
$cod_barr1 = $linea['CLIENTE_COD_BARR'];
$tip_viv = $linea['CLIENTE_VIVIEN'];
$datos['cod'] = $linea['CLIENTE_COD'];
$datos['ci'] = $linea['CLIENTE_COD_ID'];
$_SESSION['ci'] = $linea['CLIENTE_COD_ID'];
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
$con_age = "Select * From gral_agencia where GRAL_AGENCIA_CODIGO = $cod_agen and GRAL_AGENCIA_USR_BAJA is null ";
$res_age = mysql_query($con_age)or die('No pudo seleccionarse tabla 1')  ;
 while ($linea = mysql_fetch_array($res_age)) {
     $age_r = $linea['GRAL_AGENCIA_NOMBRE'];
    } 
$con_age = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$res_age = mysql_query($con_age)or die('No pudo seleccionarse tabla 2')  ;
$con_tper  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 22 and GRAL_PAR_PRO_COD = $cod_tper";
$res_tper = mysql_query($con_tper)or die('No pudo seleccionarse tabla 3')  ;
while ($linea = mysql_fetch_array($res_tper)) {
    $tper_r =  $linea['GRAL_PAR_PRO_DESC']; 
 } 
/*$con_bar1  = "Select * From gral_barrios where gral_barr_codigo = $cod_barr1";
$res_bar1= mysql_query($con_bar1)or die('No pudo seleccionarse tabla 4')  ;
 while ($linea = mysql_fetch_array($res_bar1)) {
    $barrio =  $linea['gral_barr_nombre']; 
	$det_barr = $linea['gral_barr_detalles'];
 } 
*/
$con_tper  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 22 and GRAL_PAR_PRO_COD <> 0 ";
$res_tper = mysql_query($con_tper)or die('No pudo seleccionarse tabla 5')  ;

$con_barr  = "Select * From gral_barrios order by 2 ";
$res_barr= mysql_query($con_barr)or die('No pudo seleccionarse tabla 6')  ;

 ?>
 <div id="GeneralManCliente">
 
 
 </strong>
<!--<form name="form2" method="post" action="grab_retro_cli.php" target="_self" >-->
<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCamposClientesMod(this)">
                                                                             
<strong style="font-size:18px">
<?php echo "Codigo".encadenar(3).$cod_c.encadenar(3)."Doc. Identificacion".encadenar(3).$datos['ci'];?>
</strong>
<br>
 <table align="center">
   <tr>
    <td><strong>Agencia</strong></td>
	<td align="right"><font color="#FF0000"><?php echo $age_r;?></font></td>	 
    <td><select name="cod_agencia" size="1">
   	  <?php while ($linea = mysql_fetch_array($res_age)) {?>
      <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
	  <?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
	  <?php } ?>   </select></td>
   </tr>
  <tr>
           	    <td><strong>Tipo Persona </strong></td>
    <td align="right" ><font color="#FF0000"><?php echo $tper_r;?></font></td>	 
				<td>
				 <select name="tip_per" size="1" size="10" >
   	    			 <?php
			           while ($linea = mysql_fetch_array($res_tper)) {
    			     ?>
				     <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
					 <?php echo $linea['GRAL_PAR_PRO_DESC']; ?></option>
				     <?php
			            } 
			         ?>
					  </select >
                </td>
            </tr> 
	
  <tr>
      <td><font color="#990033"><strong>  Nombres   </strong></td>
	  <td><?php echo encadenar(20); ?></td>
      <td><input type="text" name="nombres" size="30"
	      value="<?=$datos['nombres'];?>"></td>
	</tr>
	 <tr>
      <td><font color="#990033"><strong>  Apellido Paterno</strong></td>
	  <td><?php echo encadenar(20); ?></td>
      <td><input type= type="text" name="ap_pater" 
	      value="<?=$datos['ap_pater'];?>"></td>
	</tr>
	<tr>
      <td><strong>Apellido Materno</strong></td>
	  <td><?php echo encadenar(20); ?></td>
      <td><input type= type="text" name="ap_mater"
	      value="<?=$datos['ap_mater'];?>"></td>
     <tr>
      <td><strong>Apellido Esposo</strong></td>
	   <td><?php echo encadenar(20); ?></td>
       <td><input type= type="text" name="ap_espos" maxlength="35" 
	       value="<?=$datos['ap_espos'];?>"></td>
	 </tr>
	 <tr>
      <td><strong>Fec Nacimiento</strong></td>
	  <td><?php echo encadenar(20); ?></td>
      <td><input type= type="text" name="fec_nac"
	      value="<?=$datos['fec_nac'];?>"></td>
	  </tr>
	  <tr>
	      
           	   <td><strong>Barrio </strong></td>
      <td><?php echo encadenar(20); ?></td>
      <td><input type= type="text" name="barrio"
	      value="<?=$datos['barrio'];?>"></td>
	  </tr>
		
	  
	  <tr>
	    <td><font color="#990033"><strong>Direccion</strong></td>
		 <td><?php echo encadenar(20); ?></td>
		<?php if(isset($datos['direc'])){ ?>
        <td > <TEXTAREA cols="30" rows="10" style="text-align:justify" name="direc" ><?=$datos['direc'];?></TEXTAREA></td>
		<?php } ?>
		 </td>	
		 </tr>
	   <tr>
         <td><strong>Tel. Fijo</strong></td>
		 <td><?php echo encadenar(20); ?></td>
         <td><input type= type="text" name="fono" 
		     value="<?=$datos['fono'];?>" ></td>
	  </tr>
	  <tr>	 
        <td><strong>Tel. Celular</strong></td>
		<td><?php echo encadenar(20); ?></td>
        <td><input type= type="text" name="celu"
		    value="<?=$datos['celu'];?>"></td>
      </tr>
	  <tr>
        <td><strong>E-mail</strong></td>
		<td><?php echo encadenar(20); ?></td>
        <td><input type= type="text" name="email" 
		    value="<?=$datos['email'];?>" ></td>
	  </tr>
	 
	  <tr></tr> 
	 <tr>
        <td></td>
		<td></td>
		<td> <input type="submit" name="accion" value="Modificar"></td>
     </tr> 
 
    
	 </table>
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