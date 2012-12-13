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
<title>Mantenimiento Orden de Trabajo</title>
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
     <strong>Mantenimiento Orden de Trabajo</strong><br>
</div>
<div id="AtrasBoton">
 	<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<br><br>
<div id="ListaSeleccion">
             <ul>
    			<li><a href="solic_retro_sol_1.php?accion=1">Alta</a></li>
                <li><a href="solic_retro_sol_1.php?accion=2">Modificar</a></li>
                <li><a href="solic_retro_sol_1.php?accion=3">Seguimiento</a></li>
				<li><a href="solic_retro_sol_1.php?accion=4">Crédito</a></li>
                <li><a href="solic_retro_sol_1.php?accion=5">Salir</a></li>
    
		    </ul>
  </div>
<div id="FooterTable"> 
<BR><B><FONT SIZE=+1><MARQUEE>Alta, Consulta, Modificaci&oacute;n de Orden de Trabajo</MARQUEE></FONT></B>
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