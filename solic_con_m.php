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
<title>Mantenimiento Ordenes de Trabajo</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
</head>
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
     <strong>Mantenimiento Ordenes de Trabajo</strong><br>
</div>
<div id="AtrasBoton">
 	<a href="solic_mante.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<br><br>
<?php
 $consulta  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 910 and GRAL_PAR_PRO_COD <> 0 and GRAL_PAR_PRO_USR_BAJA is null order by 2";
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
 ?>
<div id="ListaSeleccion">
              <?php   
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
         <ul>
			<li><a href="solic_man_cm_1.php?accion=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>"><?php echo $linea['GRAL_PAR_PRO_DESC']; ?></a></li>
              <?php
   }
 ?>	     
   </ul>
  </div>
<div id="FooterTable"> 
<BR><B><FONT SIZE=+1><MARQUEE>Factura, Servicios Variables, Cerrar Ordenes de Trabajo</MARQUEE></FONT></B>
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