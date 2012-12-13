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
<title>Deposito - Retiro Bancos</title>
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
	 $_SESSION['egre_bs_sus'] = 0; 
	 $fec1 = cambiaf_a_mysql_2($fec);
     ?> 
</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<div id="TitleModulo">
     <img src="images/24x24/001_36.png" border="0" alt="Modulo">
     <strong>Deposito - Retiro Bancos</strong><br>
</div>
<div id="AtrasBoton">
 	<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<br><br>
<form name="form2" method="post" action="grab_retro_clim.php" >
<?php
 $_SESSION['continuar'] = 0;
$caj_hab = 0;
$caj_hab = verif_cajero_hab($fec1,$logi);
if ($caj_hab == 0){
     echo "Usuario no Habilitado como cajero ".encadenar(2)." !!!!!";
	 $_SESSION['continuar'] = 1;
	 ?> 
   <br>
   <center>
 <input type="submit" name="accion" value="Salir">

</form>
<?php }

if ($_SESSION['continuar'] == 0){
  ?> 
<div id="ListaSeleccion">
             <ul>
    			<li><a href="egre_retro.php?accion=10">Deposito Bolivianos</a></li>
                <li><a href="egre_retro.php?accion=11">Deposito Dolares</a></li>
				<li><a href="egre_retro.php?accion=12">Retiro Bolivianos</a></li>
                <li><a href="egre_retro.php?accion=13">Retiro Dolares</a></li>
                
   		    </ul>
  </div>
<div id="FooterTable"> 
<BR><B><FONT SIZE=+1><MARQUEE>Registro Ingresos / Egresos </MARQUEE></FONT></B>
</div>
 <?php
 }
		 	include("footer_in.php");
		 ?>
 </div>
</body>
</html>	
<?php
ob_end_flush();
 ?>