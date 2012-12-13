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
<title>Verificar cierre de Modulos</title>

<link href="css/estilo.css" rel="stylesheet" type="text/css">
</head>

<body>
	 <div id="cuerpoModulo">
        <?php 
	   	 include("header.php");
	   ?>
        <div id="UserData">
                     <img src="images/24x24/001_20.png" border="0" align="absmiddle">
					<?php
                     $fec = leer_param_gral();
                     $logi = $_SESSION['login'];
					 $ag_usr = $_SESSION['COD_AGENCIA'];
                     ?>
         </div>
         <div id="Salir">
                        <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
         </div> 
     	    <div id="AtrasBoton">
           		<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
 		<div id="CueproVerMod">
                          Verificando cierre de Módulos
				<?php
               $f_proc1 = cambiaf_a_mysql_2($fec);
			   $consulta  = "SELECT * FROM gral_cierre_mod where GRAL_CIERR_MOD_AGEN=$ag_usr and GRAL_CIERR_MOD_FCH_CIERRE='$f_proc1'";
                    $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
                    $cart = 0;
                    $caja = 0;
                    $fgar = 0;
					$_SESSION['cart'] = 0;
					$_SESSION['caja'] = 0;
					$_SESSION['fgar'] = 0;
                while ($linea = mysql_fetch_array($resultado)) {
                  switch( $linea ['GRAL_CIERR_MOD_APL'] ) {
                     case 6000:
                          $cart = 1;
						  $_SESSION['cart'] = 1;
                          break;
                     case 10000:
                          $caja = 1;
						  $_SESSION['caja'] = 1;
                          break;
                     case 11000:
                          $fgar = 1;
						  $_SESSION['fgar'] = 1;
                          break;
                     }
                   }
                   $t_mod = $cart + $caja + $fgar;
                  if ($t_mod == 3) {
                    // $va = 'gral_cam_fec.php'; 
                    echo "<br />Cambiar Fecha <a href='gral_cam_fec.php'><img src='images/24x24/001_45.png' border='0' align='absmiddle'' alt=''/>Cambiar</a>";
                    // include $va; 
                     } else {
                     //$va = 'gral_mod_sin.php';
                     echo "<br />Ver que Módulo(s) no cerraron<a href='gral_mod_sin.php'><img src='images/24x24/001_18.png' border='0' align='absmiddle'' alt='' />Verificar</a>"; 
                     //include $va;  
                   }
                  ?>
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