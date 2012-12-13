<?php
   ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
	require('funciones2.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>
	<div id="cuerpoModulo">
	<?php
				include("header.php");
			?>
            

				<?php
					 $fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='menu_s.php'>Salir</a>
  </div>

<br><br>
            
<center>
<BR>
<font  size="+2">


<br><br>
<br><br>
</font>
<?php
//echo encadenar(62). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
?>
 <?php
$nro_val = leer_nro_val_cja($log_usr);
$cod_func = $_POST['cod_cta'];
$c_agen = $_POST['cod_agencia'];
$_SESSION['cod_func'] =  $cod_func;
$cod_mon = $_POST['cod_mon'];
$_SESSION['cod_mon'] =  $cod_mon;
$fec1 = $_SESSION['fec1'];


if ($_POST['descrip'] <> ""){  
	$descrip = $_POST['descrip'];
	$descrip = strtoupper ($descrip);
	$_SESSION['descrip'] = $descrip;
	}

if ($_POST['egr_monto'] <> 0){  
   $monto_t = $_POST['egr_monto'];
   $_SESSION['monto_t'] =  $monto_t;
  }
$con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $cod_mon  ";
$res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla')  ;
while ($linea = mysql_fetch_array($res_mon)) {
    $_SESSION['des_mon'] = $linea['GRAL_PAR_INT_DESC'];
}
$con_usr  = "Select * From gral_usuario where GRAL_USR_ESTADO = 1 and GRAL_USR_LOGIN = '$cod_func'													   and GRAL_USR_USR_BAJA is null";
$res_usr = mysql_query($con_usr)or die('No pudo seleccionarse gral_usuario')  ;
 while ($lin_usr = mysql_fetch_array($res_usr)) {
 $nom_func = $lin_usr['GRAL_USR_NOMBRES'].encadenar(1).
			 $lin_usr['GRAL_USR_AP_PATERNO'].encadenar(1).
			 $lin_usr['GRAL_USR_AP_MATERNO'];
 	$_SESSION['nom_func'] = $nom_func;	 

}
	 
    echo "Vale  en ".encadenar(2).$_SESSION['des_mon'];
    echo encadenar(112). "Nro. Tran. ".encadenar(2).$nro_val;
   // echo "aqui".$c_agen.$nro_tr_caj,$descrip,$monto_t,$cta_ctbg ;
?>
<br><br>
 
 <table align="center">
    <tr>
        <th align="left"><?php echo encadenar(80); ?></th>
	</tr>
    <tr>
        <th align="left"><?php echo $descrip; ?></th>
	</tr>
	<tr>	
		<th align="left"><?php echo $_SESSION['nom_func']; ?></th>
	</tr>
		<td align="left"><?php echo number_format($_SESSION['monto_t'], 2, '.',',').encadenar(2).$_SESSION['des_mon'];?></td>
	</tr>
    
        </table>
		
<br><br>
</center>
<?php
 if ($_SESSION['monto_t'] < 0){
   	$mon_des = f_literal($_SESSION['monto_t'] * -1,1);
	}else{
	$mon_des = f_literal($_SESSION['monto_t'],1);
	}
	 echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
	 ?>		
<br><br>
<br><br>
<br><br>
<center>
 <?php
  
  echo encadenar(5)."_____________________", encadenar(15),"_____________________";
  ?>
  <br>
 <?php
  
  echo encadenar(12)."INTERESADO", encadenar(40),"     CAJERO";
  ?>	
  <br><br>
  <br><br>
 <?php

$consulta = "insert into caja_vale (CAJA_VAL_TIPO, 
                                    CAJA_VAL_AGEN,
									CAJA_VAL_FUNC,
									CAJA_VAL_NRO,
									CAJA_VAL_MON,
					                CAJA_VAL_IMPO,
					                CAJA_VAL_FECHA,
   				                    CAJA_VAL_USR_ALTA,
                                    CAJA_VAL_FCH_HR_ALTA,
									CAJA_VAL_USR_BAJA,
									CAJA_VAL_FCH_HR_BAJA
									) values (1,
									          $c_agen,
											  '$cod_func',
											   $nro_val,
											   $cod_mon,
											   $monto_t,
											   '$fec1',
											   '$log_usr',
											    null,
												null,
												'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_vale: ' . mysql_error());
	?>
	
<?php
	
//header('Location: menu_s.php');	
?>

  <?php //} ?>
	 
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