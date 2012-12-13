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
<title>Reportes de Ordenes</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
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
                         Reportes de Ordenes
			</div>
            <div id="AtrasBoton">
           		<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
//$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
 ?>
  <div id="ListaSeleccion">
             <ul>
			    <li><a href="cart_rep_op.php?accion=1">Resumen Por Operador</a></li>
    			<li><a href="cart_rep_op.php?accion=2">Resumen Por Servicio</a></li>
                <li><a href="cart_rep_op.php?accion=3">Detalle de Ordenes</a></li>
				<li><a href="cart_rep_op.php?accion=4">Detalle Servicios Pendientes Pago</a></li>
				<li><a href="cart_rep_op.php?accion=5">Detalle Ultimos Servicios</a></li>
			 </ul>
  </div>
<div id="FooterTable"> 
Reportes de Cartera
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