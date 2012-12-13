<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
	
		   

$f_uno = "2012-12-31";
$fecha_nueva = date("d-m-Y", strtotime("$f_uno"));
$hra = 18;
// Maestro Cartera
echo $fecha_nueva."A";
$nro_d = 1;
for ($i=1; $i < 500; $i = $i + 1 ) {
$fecha_nueva = date("d-m-Y", strtotime("$f_uno"));
$fecha_nueva = date("d-m-Y", strtotime("$fecha_nueva + $nro_d days"));
echo $fecha_nueva."B";
$fecha_nueva = cambiaf_a_mysql_2($fecha_nueva);
$f_uno = $fecha_nueva;

//$con_tpa = "Select DISTINCT ord_cro_fecha from ord_conograma where
 //           ord_cro_fecha > '2011-01-31' order by ord_cro_fecha ";
 //   $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla ord_conograma')  ;
	
//	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
//		    $fec_ord = $lin_tpa['ord_cro_fecha'];
$consulta = "insert into ord_conograma (ord_cro_fecha,
                                         ord_cro_ope) 
										 values ('$f_uno',
										         1)";
  $resultado = mysql_query($consulta)or die('No pudo insertar : ord_conograma 1 ' . mysql_error());
  $consulta = "insert into ord_conograma (ord_cro_fecha,
                                         ord_cro_ope) 
										 values ('$f_uno',
										         2)";
  $resultado = mysql_query($consulta)or die('No pudo insertar : ord_conograma 2 ' . mysql_error());
  
  $consulta = "insert into ord_conograma (ord_cro_fecha,
                                         ord_cro_ope) 
										 values ('$f_uno',
										         3)";
  $resultado = mysql_query($consulta)or die('No pudo insertar : ord_conograma 3 ' . mysql_error());
  $consulta = "insert into ord_conograma (ord_cro_fecha,
                                         ord_cro_ope) 
										 values ('$f_uno',
										         4)";
  $resultado = mysql_query($consulta)or die('No pudo insertar : ord_conograma 4 ' . mysql_error());
 
  $consulta = "insert into ord_conograma (ord_cro_fecha,
                                         ord_cro_ope) 
										 values ('$f_uno',
										         5)";
  $resultado = mysql_query($consulta)or die('No pudo insertar : ord_conograma 5 ' . mysql_error());
  
  $consulta = "insert into ord_conograma (ord_cro_fecha,
                                         ord_cro_ope) 
										 values ('$f_uno',
										         6)";
  $resultado = mysql_query($consulta)or die('No pudo insertar : ord_conograma 6 ' . mysql_error());
  
   $consulta = "insert into ord_conograma (ord_cro_fecha,
                                         ord_cro_ope) 
										 values ('$f_uno',
										         7)";
  $resultado = mysql_query($consulta)or die('No pudo insertar : ord_conograma 7 ' . mysql_error());

}
ob_end_flush();
 //Correlativos transaccion
/*




*/	




 ?>
 
                      