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
<?php
if(isset($_SESSION['form_buffer'])){
   $datos = $_SESSION['form_buffer'];
}
$cod_es = $_GET['accion'];
$_SESSION['c_estado'] = $cod_es;

$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 910 and GRAL_PAR_PRO_COD = $cod_es ";
$res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla')  ;
while ($linea = mysql_fetch_array($res_est)){
      if ($cod_es == 2){
	      $con_cli = "Select * From ord_maestro, cliente_general  where ORD_ESTADO = 2 
		              and ORD_FORM_PAG >  2
					  and CLIENTE_COD = ORD_COD_CLI
	                  and ORD_MAE_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
          $res_deu= mysql_query($con_cli)or die('No pudo seleccionarse tabla ord_maestro');
		  $_SESSION['tip_comp'] = 2;
		  $_SESSION["continuar"] = 1;
	   }  
	  if ($cod_es == 1){
	      $con_cli = "Select * From ord_maestro, cliente_general
		              where ORD_ESTADO = 1 
		              
					  and CLIENTE_COD = ORD_COD_CLI
	                  and ORD_MAE_USR_BAJA is null and CLIENTE_USR_BAJA is null
					  ";
          $res_deu= mysql_query($con_cli)or die('No pudo seleccionarse tabla ord_maestro');
		  $_SESSION['tip_comp'] = 1;
		  $_SESSION["continuar"] = 1;
	   }   
//}	   
?>
<strong style="font-size:20px">Tipo de Complemento </strong>
<?php
   echo encadenar(2).$linea['GRAL_PAR_PRO_DESC'];
   }
  ?> 
 <?php

   	    
?>
<form name="form2" method="post" action="grab_retro_clim.php" >
<select name="cod_ord[]" size="12" multiple>
<?php
while ($linea = mysql_fetch_array($res_deu)){ ?>
    <option value= <?php echo $linea['ORD_NUMERO'];?>>
       <?php 
	   echo $linea['ORD_NUMERO'].encadenar(2);
	   echo $linea['CLIENTE_AP_PATERNO'].encadenar(2).
            $linea['CLIENTE_AP_MATERNO'].encadenar(2).
            $linea['CLIENTE_NOMBRES'];
     }

?>
</select><br><br>
  <input type="submit" name="accion" value="Continuar">
  <input type="submit" name="accion" value="Salir">
  </form>
 <BR><B><FONT SIZE=+2><MARQUEE>Elija la Orden para Consultar</MARQUEE></FONT></B>
</body>
</html>
 <?php
		 	include("footer_in.php");
	 ?> 
<?php
ob_end_flush();
 ?>