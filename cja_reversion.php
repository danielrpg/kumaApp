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
<title>Reversion de Transacciones </title>
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
                         Reversion de Transacciones
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
			    <li><a href="cja_rev_op.php?accion=2">Cobros</a></li>
                <li><a href="cja_rev_op.php?accion=3">Bancos</a></li>
               	<li><a href="cja_rev_op.php?accion=5">Compra Venta de Divisas</a></li>
				<li><a href="cja_rev_op.php?accion=6">Vales</a></li>
				<li><a href="cja_rev_op.php?accion=7">Ingresos/Egresos</a></li>
    
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