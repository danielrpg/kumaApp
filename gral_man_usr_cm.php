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
<title>SERVIMASTER</title>
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
 $logi = $_SESSION['login']; 
?> 
</div>
             <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div> 
				<div id="TitleModulo">
                	<img src="images/24x24/001_35.png" border="0" alt="" />   Mantenimiento Usuarios
          </div> 
              <div id="AtrasBoton">
           		<a href="gral_man_usr.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$datos = $_SESSION['form_buffer'];
$log_i = $logi;
$quecom = $_POST['cod_usr'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $log_i = $quecom[$i];
 }
}
$_SESSION['login_i']= $log_i;
//echo $log_i;
$con_usr = "Select * From gral_usuario where GRAL_USR_LOGIN = '$log_i' and GRAL_USR_USR_BAJA is null";
$res_usr = mysql_query($con_usr)or die('No pudo seleccionarse tabla 1')  ;
while ($linea = mysql_fetch_array($res_usr)){
//$datos[] = $linea[];
$cod_agen = $linea['GRAL_AGENCIA_CODIGO'];
$cod_sec = $linea['GRAL_USR_SECTOR'];
$cod_car = $linea['GRAL_USR_CARGO'];
$cod_est = $linea['GRAL_USR_ESTADO'];
$datos['log'] = $linea['GRAL_USR_LOGIN'];
$datos['ci'] = $linea['GRAL_USR_CI'];
$datos['nombres'] = $linea['GRAL_USR_NOMBRES']; 
$datos['ap_pater']  = $linea['GRAL_USR_AP_PATERNO'];
$datos['ap_mater']  = $linea['GRAL_USR_AP_MATERNO'];
$f_nac = $linea['GRAL_USR_FEC_NAC'];
//$f_nacc = cambiaf_a_normal($f_nac);
$datos['fec_nac']= cambiaf_a_normal($f_nac);
$datos['direc'] = $linea['GRAL_USR_DIRECCION'];
$datos['fono'] = $linea['GRAL_USR_TELEFONO'];
$datos['celu'] = $linea['GRAL_USR_CELULAR'];
$datos['email'] = $linea['GRAL_USR_EMAIL']; 
$datos['clav'] = $linea['GRAL_USR_CLAVE'];
//echo $log, $cod_agen, $cod_sec,$cod_car,$cod_est;
}
//echo $cod_agen;
$con_age = "Select * From gral_agencia where GRAL_AGENCIA_CODIGO = $cod_agen and GRAL_AGENCIA_USR_BAJA is null ";
$res_age = mysql_query($con_age)or die('No pudo seleccionarse tabla 2')  ;
$con_sec = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 200 and GRAL_PAR_PRO_COD = $cod_sec and GRAL_PAR_PRO_COD <> 0 ";
$res_sec = mysql_query($con_sec)or die('No pudo seleccionarse tabla 3')  ;
$con_car = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 300 and GRAL_PAR_PRO_COD = $cod_car and GRAL_PAR_PRO_COD <> 0 ";
$res_car = mysql_query($con_car)or die('No pudo seleccionarse tabla 4')  ;
$con_est = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 400 and GRAL_PAR_PRO_COD = $cod_est and GRAL_PAR_PRO_COD <> 0 ";
$res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla 5')  ;
 ?>
<div id="GeneralManUsuario">
 <form name="form2" method="post" action="grab_retro_u.php" onSubmit="return ValidaCampos(this)">
 <table align="center">
 <tr>
        <th align="left">Login  </th>
		<td> <?php echo $log_i; ?></td>
     </tr>
 <tr>
        <th align="left">Documento Identidad </th>
		<td><input type="text" name="ci" width="10" value="<?=$datos['ci'];?>"> </td>
      </tr>
 <tr>
     <th align="left">Agencia </th>
	 <td> <select name="cod_agencia" size="1"  >
	      <?php while ($linea = mysql_fetch_array($res_age)) {?>
       			    <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
						<?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
          <?php } ?>
	     </select>  	 </td>
 </tr>
 <tr>
     <th align="left">Nombres  </th>
     <td><input type="text" name="nombres" value="<?=$datos['nombres'];?>"> </td>
 </tr>
 <tr> 
    <th align="left">Apellido Paterno </th>
	<td><input  type="text" name="ap_pater" value="<?=$datos['ap_pater'];?>"> </td>
 </tr>
 <tr>
    <td align="left">Apellido Materno </td>
	<td><input type="text" name="ap_mater" value="<?=$datos['ap_mater'];?>"></td>
</tr>
 <tr>
	<th align="left">Fec Nacimiento </th>
    <td><input type= type="text" name="fec_nac" value="<?=$datos['fec_nac'];?>" > </td>
</tr>
 <tr>
   <th align="left">Direccion </th>
   <td><input type= type="text" name="direc" size="50" maxlength="50" value="<?=$datos['direc'];?>"> </td>
 </tr> 
 <tr>
   <th align="left">Tel. Fijo </th>
   <td><input type= type="text" name="fono" value="<?=$datos['fono'];?>"></td>
 </tr> 
 <tr>
	<th align="left">Tel. Celular </td>
	<td><input type= type="text" name="celu" value="<?=$datos['celu'];?>" ></td>
 </tr> 
 <tr>
    <th align="left">E-mail </th>
	<td><input type= type="text" name="email" value="<?=$datos['email'];?>"  ></td>
 </tr> 
 <tr>
    <th align="left">Sector </th>
    <td><select name="cod_sec" size="1"  > 
    	<?php  while ($l_sec = mysql_fetch_array($res_sec)) { ?>
             <option value=<?php echo $l_sec['GRAL_PAR_PRO_COD']; ?>>
			 <?php echo $l_sec['GRAL_PAR_PRO_DESC']; ?> </option>
	   <?php } ?> 
        </select></td>
 </tr> 
 <tr>
    <th align="left">Cargo </td>
    <td><select name="cod_car" size="1"  >
    	<?php while ($l_car = mysql_fetch_array($res_car)) {  ?>
             <option value=<?php echo $l_car['GRAL_PAR_PRO_COD']; ?>>
			 <?php echo $l_car['GRAL_PAR_PRO_DESC']; ?></option>
	   <?php } ?> 
       </select> </td>
 </tr> 
 <tr>
     <th align="left"> Estado </td>
     <td> <select name="cod_est" size="1"  > 
     <?php while ($l_est = mysql_fetch_array($res_est)) {  ?>
           <option value=<?php echo $l_est['GRAL_PAR_PRO_COD']; ?>>
	       <?php echo $l_est['GRAL_PAR_PRO_DESC']; ?></option>
	 <?php  }  ?> 
     </select>  </td>
 </tr>
  <tr>
      <th align="left">Clave Ingreso </td>
	  <td><input type="password"   name="clav" value="<?=$datos['clav'];?>" ></td>
  </tr>
   </table>
    <input type="submit" name="accion" value="Modificar">
    <input type="submit" name="accion" value="Salir">
</form>
<BR><B><FONT SIZE=+2><MARQUEE>Ingrese los datos generales de Usuarios del sistema</MARQUEE></FONT></B>
</body>
</html>
<?php
ob_end_flush();
 ?>