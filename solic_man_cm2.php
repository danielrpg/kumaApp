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
<title>Modificacion de Orden</title>
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
<center>
</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<div id="TitleModulo">
     <img src="images/24x24/001_36.png" border="0" alt="Modulo">
     <strong>Modificacion de Orden</strong><br>
</div>
<div id="AtrasBoton">
 	<a href="solic_mante.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<br><br>
<?php
 $cod_es = 1;
$con_sol = "Select * From ord_maestro where ORD_ESTADO = $cod_es and ORD_MAE_USR_BAJA is null ";
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse tabla solicitud xx')  ;
?>
<form name="form2" method="post" action="grab_retro_clim.php" >
<select name="cod_ord[]" size="12" multiple>
<?php
while ($linea = mysql_fetch_array($res_sol)){
$cod_es =$linea['ORD_ESTADO'];  
$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 801 and GRAL_PAR_PRO_COD = $cod_es ";
$res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla')  ;
while ($lin_est = mysql_fetch_array($res_est)){
      $_SESSION['estado'] = $lin_est['GRAL_PAR_PRO_SIGLA'];
   }
  if ($cod_es == 1) {
     $cod_ord = $linea['ORD_NUMERO'];
	
     $con_cli = "Select ORD_NUMERO, CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,CLIENTE_NOMBRES From ord_maestro, cliente_general                 where ORD_NUMERO = $cod_ord  and CLIENTE_COD = ORD_COD_CLI
	             and ORD_MAE_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
        $res_deu= mysql_query($con_cli)or die('No pudo seleccionarse tabla deudores');
   	    while ($lin_deu = mysql_fetch_array($res_deu)){
  	          $linea['CLIENTE_AP_PATERNO'] = $lin_deu['CLIENTE_AP_PATERNO'];
              $linea['CLIENTE_AP_MATERNO'] = $lin_deu['CLIENTE_AP_MATERNO'];
              $linea['CLIENTE_NOMBRES'] = $lin_deu['CLIENTE_NOMBRES'];
        }
    }   
/*if ($linea['CRED_SOL_TIPO_OPER'] < 3){
   $con_deu = "Select CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,CLIENTE_NOMBRES From cred_deudor, cliente_general where   cred_deudor.CRED_SOL_CODIGO = $cod_cre and  CRED_DEU_RELACION = 'C' and CLIENTE_COD = CRED_DEU_INTERNO and   CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
   $res_deu= mysql_query($con_deu)or die('No pudo seleccionarse tabla deudores');
   while ($lin_deu = mysql_fetch_array($res_deu)){
         $linea['CLIENTE_AP_PATERNO'] = $lin_deu['CLIENTE_AP_PATERNO'] ;
         $linea['CLIENTE_AP_MATERNO'] = $lin_deu['CLIENTE_AP_MATERNO'];
         $linea['CLIENTE_NOMBRES'] = $lin_deu['CLIENTE_NOMBRES'];
    } 
   } 
  } */
?>
<option value=<?php echo $linea['ORD_NUMERO']; ?>>
              <?php echo $linea['ORD_NUMERO']; ?> 
		      <?php echo $linea['CLIENTE_AP_PATERNO']; ?> 
			  <?php echo $linea['CLIENTE_AP_MATERNO']; ?> 
			  <?php echo $linea['CLIENTE_NOMBRES']; ?> 
<?php 
}
?>
</select><br><br>
  <input type="submit" name="accion" value="Seguir">
  <input type="submit" name="accion" value="Salir">
  </form>
<div id="FooterTable"> 
<BR><B><FONT SIZE=+1><MARQUEE>Modificaci&oacute;n de Ordenes</MARQUEE></FONT></B>
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