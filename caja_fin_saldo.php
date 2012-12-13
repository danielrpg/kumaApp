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
<title>Saldo Final Cajas</title>
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
	 $fec1 = cambiaf_a_mysql_2($fec);
     $logi = $_SESSION['login'];
	 $_SESSION['egre_bs_sus'] = 0; 
	 
	
     ?> 
</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<div id="TitleModulo">
     <img src="images/24x24/001_36.png" border="0" alt="Modulo">
     <strong>Saldo Final Cajas</strong><br>
</div>
<div id="AtrasBoton">
 	<a href="menu_s.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<br><br>
<div id="ListaSeleccion">

             <ul>
    			<li><a href="caja_retro.php?accion=1">Saldo final Bolivianos</a></li>
                <li><a href="caja_retro.php?accion=2">Saldo final Dolares</a></li>
				<li><a href="caja_retro.php?accion=3">Salir</a></li>
   		    </ul>
  </div>
<div id="FooterTable"> 
<BR><B><FONT SIZE=+1><MARQUEE>Saldo Final Cajas</MARQUEE></FONT></B>
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