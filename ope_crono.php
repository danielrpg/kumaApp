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
<title>Cronograma diario Operador</title>
</head>
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
                ?> 
			</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">	 
               Cronograma diario Operador
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
</center>
 <form name="form2" method="post" action="solic_retro_sol.php" onSubmit="">
<?php
if(isset($_POST['cod_ope'])){ 
   $quecom = $_POST['cod_ope'];
   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
      if( isset($quecom[$i]) ) {
         $cod_cod_ope = $quecom[$i];
		 $_SESSION['cod_cod_ope'] =  $cod_cod_ope;
         }
      }
	}else{
         $cod_cod_ope = $_SESSION['cod_cod_ope']; 
}
$fecha = $_POST['fec_des'];
$f_des = cambiaf_a_mysql($fecha);

$con_ope1  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD =$cod_cod_ope";
$res_ope1 = mysql_query($con_ope1)or die('No pudo seleccionarse tabla x');
while ($linope1 = mysql_fetch_array($res_ope1)) {
    $_SESSION['nom_ope'] = $linope1['GRAL_PAR_PRO_DESC'];
	echo $_SESSION['nom_ope'];
}

//echo $cod_cod_ope,$f_des;
$con_crono  = "Select * From ope_crono where ope_cro_opera = $cod_cod_ope and 
               ope_cro_fecha = '$f_des' and ope_cro_usr_baja is null";
$res_crono = mysql_query($con_crono)or die('No pudo seleccionarse ope_crono');
?>
 <center>
 <table width="90%"  border="2" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" 
	      align="center"/>Hora Inicio</th>
	  <th width="10%" scope="col" style="font-size:10px"><border="0" alt=""
	   align="center"/>Hora Fin</th>
      <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" 
	  align="center"/>Nro. Orden</th>
      <th width="30%" scope="col" style="font-size:10px"><border="0" alt=""
	   align="absmiddle" />Nombre Cliente</th>
	  <th width="20%" scope="col" style="font-size:10px"><border="0" alt=""
	   align="absmiddle" />Servicios</th> 
	   <th width="10%" scope="col" style="font-size:10px"><border="0" alt=""
	   align="absmiddle" />Estado</th> 
	  </tr>
<?php

while ($lin_crono = mysql_fetch_array($res_crono)) {
      $estado =0;
      $h_ini = $lin_crono['ope_cro_hr_ini'];
	  $h_fin = $lin_crono['ope_cro_hr_fin'];
	  $nroord = $lin_crono['ope_cro_nroord'];
//	echo $h_ini.encadenar(2).$h_fin.encadenar(2).$nroord."aqui";
$con_cli = "Select * From ord_maestro, cliente_general  where ORD_NUMERO = $nroord
            and CLIENTE_COD = ORD_COD_CLI and ORD_MAE_USR_BAJA is null
			and CLIENTE_USR_BAJA is null ";
            $res_deu= mysql_query($con_cli)or die('No pudo seleccionarse tabla deudores');
   	        while ($linea = mysql_fetch_array($res_deu)){
  	         	   $_SESSION['cod_cli']= $linea['CLIENTE_COD'];
                   $_SESSION['tip_doc']= $linea['CLIENTE_TIP_ID'];
				   $estado = $linea['ORD_ESTADO'];
                   $_SESSION['nom_com']=$linea['CLIENTE_NOMBRES'].
				   encadenar(2).$linea['CLIENTE_AP_PATERNO'].
                   encadenar(2).$linea['CLIENTE_AP_MATERNO'].
				   encadenar(2).$linea['CLIENTE_AP_ESPOSO'];
             }
         $con_serv = "Select * From ord_detalle
		              where ORD_DET_ORD = $nroord 
		              and  ORD_DET_USR_BAJA is null";
	$servicios = "";				  
          $res_serv= mysql_query($con_serv)or die('No pudo seleccionarse tabla ord_detalle');			  while ($lin_serv = mysql_fetch_array($res_serv)){
	      $cod_serv = $lin_serv['ORD_DET_GRP'];
		  $servicios = $servicios.encadenar(2).$cod_serv;
		  }
?>
  <tr>
	<th align="center"><?php echo $h_ini; ?></th>
    <th align="center"><?php echo $h_fin; ?></th>
    <th align="center"><?php echo $nroord; ?></th>
    <th align="left"><?php echo $_SESSION['nom_com']; ?></th>
	 <th align="left"><?php echo $servicios; ?></th>
	  <th align="left"><?php echo $estado; ?></th>
  </tr> 
<?php } ?>
 </table>
  <input type="submit" name="accion" value="Salir">
</form>
 
 <?php


		  		  
		   ?>
		 
  <div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Cronograma Diario Operador</MARQUEE></FONT></B>
   </div>
   <?php
		 	include("footer_in.php");
		 ?> 
</body>
</html>
<?php
ob_end_flush();
 ?>