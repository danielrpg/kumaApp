<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
	
		   

$f_uno = "2011-06-05";
$fecha_nueva = date("d-m-Y", strtotime("$f_uno"));
$ope = 4;
// Maestro Cartera
echo $fecha_nueva."A";
$nro_d = 1;
for ($i=1; $i < 300; $i = $i + 1 ) {
$fecha_nueva = date("d-m-Y", strtotime("$f_uno"));
$fecha_nueva = date("d-m-Y", strtotime("$fecha_nueva + $nro_d days"));
echo $fecha_nueva."B";
$fecha_nueva = cambiaf_a_mysql_2($fecha_nueva);
$f_uno = $fecha_nueva;
  $consulta = "insert into ord_conograma (ord_cro_fecha,
                                         ord_cro_ope) 
										 values ('$fecha_nueva',
										         $ope)";


$resultado = mysql_query($consulta)or die('No pudo insertar : cart_maestro ' . mysql_error());

}
ob_end_flush();
 //Correlativos transaccion
/*$agen = 32
$r = "";
$nro_cre = leer_nro_credito($agen);

$n = strlen($nro_cre);
$n2 = 4 - $n;
$nro_c = "";
$nro_cred = 0;
$nro_ctaf = 0;
$nro_ctf = 0;

if(isset($r)){ 
   for ($i = 1; $i <= $n2; $i++) {
    $r = $r."0";
    }
$nro_cred = "9".$agen."0".$t_op.$r.$nro_cre;

values ($cre_cta,
										         $nro,
										         '$cre_cta',
												 null,
												 '$agen', 
										         '$cre_cgru', 
                                                 null',
                                                 null,
                                                 null,
												 null,
												 $t_oper,
                                                 '$cre_fdes',
                                                 null,
                                                 $cre_impo, 
                                                 $cre_imco,
                                                 $cre_mone,
												 null,
		                                         null,
												 1,
												 $cre_plaz,
												 null,
                                                 null,	
												 $forma,
												 null,
												 $cre_tasa,
												 null,
												 null,
												 $t_oper,
												 null,
												 null,
												 null,
												 null,
												 null,
												 '$cre_ofic',
												 null,
												 null,
												 null,
												 null,
												 null,
												 $cre_estado,
												 '$usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";




*/	




 ?>
 
                      