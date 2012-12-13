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
<title>Cambio de fecha del sistema</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
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
 //verif_cierre($fec);
?> 
</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
<strong>Ingrese la fecha de Proceso</strong><br>
</div>
<div id="AtrasBoton">
 	<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<?php
//verif_cierre($fec);
// Se realiza una consulta SQL a tabla gral_param_propios
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
//verif_cierre($fec);
 ?>
<form name="form2" method="post" action="grab_retro.php">
<table width="40%"  border="0" cellspacing="1" cellpadding="1" align="center">
<tr>
 <th align="left">Tipo de Cambio Contable</th>
 <td align="center"><?php echo number_format($_SESSION['TC_CONTAB'], 2, '.',','); ?><td>
</tr> 
<tr> 
  <th align="left">Tipo de Cambio Compra</th>
  <td align="center"><?php echo number_format($_SESSION['TC_COMPRA'], 2, '.',','); ?><td>
</tr> 
<tr>
  <th align="left" >Tipo de Cambio Venta </th>
  <td align="center" ><?php echo number_format($_SESSION['TC_VENTA'], 2, '.',','); ?><td> 
</tr> 
<tr>  
  <th align="left"> Fecha  </th>
  <td align="left"><input type="text" name="fecha" maxlength="10"  size="10" > <script language="JavaScript">
            new tcal ({
                // form name
                'formname': 'form2',
                // input name
                'controlname': 'fecha'
            });
            </script><td> 
</tr> 			
 <br><br>
 </table> 
    <input type="submit" name="accion" value="Salir">
    <input type="submit" name="accion" value="Grabar">
</form>
</div>
<div id="FooterTable"> 
<BR><B><FONT SIZE=+2><MARQUEE>Atenci&oacute;n la fecha que ingrese afectara a todos los modulos</MARQUEE></FONT></B>
<center>
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