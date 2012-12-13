<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
			  
?>
 
<?php
$nro = 0;
$con_mcli  = "Select * From wcustod1 where numero > 16797"; 
$res_mcli = mysql_query($con_mcli)or die('No pudo seleccionarse migracre');
   while ($lin_mcli = mysql_fetch_array($res_mcli)) {
         $cod_ant = $lin_mcli['CUSTNO'];
	//	 $ci = $lin_mcli['ci'];
	//	 $t_ci = $lin_mcli['tipo_ci'];
		 $nombres = strtoupper($lin_mcli['CONTACT']);
		 $paterno = strtoupper($lin_mcli['COMPANY']);
	//	 $materno = $lin_mcli['materno'];
		 $dir1 = $lin_mcli['ADDRESS1'];
		 $dir2 = $lin_mcli['ADDRESS2'];
		 $dir3 = $lin_mcli['COMMENT'];
		 $fono_d = $lin_mcli['PHONE'];
		 $celu = $lin_mcli['BPHONE'];
		// $nro = $lin_mcli['NUMERO'];
		 $tipo = $lin_mcli['TYPE'];
		 $agen = 30;
		 $direccion = strtoupper($dir1." ".$dir2." ".$dir3);
		 
  $usr = "super";
  if ($tipo == "R"){
    $per = 1;
  }  
 if ($tipo == "C"){
    $per = 2;
  } 
$r = "";  
$nro = leer_nro_cliente();
$n = strlen($nro);
$n2 = 5 - $n;
echo $nro," * ",$n," * ",$n2;
for ($i = 1; $i <= $n2; $i++) {
    $r = $r."0";
    }  
$ccli = $agen.$r.$nro; 
 
 
 echo $nro.encadenar(2).$ccli.encadenar(2).$nombres.encadenar(2).
       $paterno.encadenar(2).$direccion;	

// Maestro Cartera
  $consulta  = "Insert into cliente_general (CLIENTE_COD,
	                                           CLIENTE_NUMERICO,
	                                           CLIENTE_COD_ANT,
											   CLIENTE_TIP_PER,
                                               CLIENTE_TIP_ID,
											   CLIENTE_COD_ID,
											   CLIENTE_COD_BARR,
											   CLIENTE_NOMBRES,	
											   CLIENTE_AP_PATERNO,
											   CLIENTE_AP_MATERNO,
											   CLIENTE_AP_ESPOSO,
											   CLIENTE_FCH_NAC,
											   CLIENTE_LUG_NAC,
											   CLIENTE_SEXO,
											   CLIENTE_EST_CIVIL, 
											   CLIENTE_TRABAJO, 
											   CLIENTE_DIR_TRAB,
											   CLIENTE_ZON_TRAB,
											   CLIENTE_FONO_TRAB,
											   CLIENTE_PROFESION,
											   CLIENTE_ANT_ACT,
											   CLIENTE_CARGO,
											   CLIENTE_VIVIEN,
											   CLIENTE_ALFAB,
											   CLIENTE_CIIU,
											   CLIENTE_DIRECCION,
											   CLIENTE_ZONA,
											   CLIENTE_FONO,
											   CLIENTE_CELULAR,
											   CLIENTE_EMAIL,
											   CLIENTE_RUBRO,
											   CLIENTE_SECTOR1,
											   CLIENTE_SECTOR2,
											   CLIENTE_AGENCIA,
											   CLIENTE_CAL_INT,
											   CLIENTE_NOM_CONYUGE,
											   CLIENTE_CI_CONYUGE,
											   CLIENTE_NOM_REF,
											   CLIENTE_DIR_REF,
											   CLIENTE_FON_REF,
											   CLIENTE_USR_ALTA,
											   CLIENTE_FCH_HR_ALTA,
											   CLIENTE_USR_BAJA,
											   CLIENTE_FCH_HR_BAJA) values
											   ($ccli,
											    $nro,
											    '$cod_ant',
											    $per,
											    1,
											    null,
											    null,
											    '$nombres',
											    '$paterno',
											    null,
											    null,
											    null,
												null,
											    null,
											    null,
											    null,
												null,
												null,
											    null,
											    null,
												null,
											    null,
											   null,
											    null,
											    null,
											    '$direccion', 
											   null,
											     '$fono_d',
											    '$celu',
											    null,
											    null,
											     null,
											     null,
											    $agen,
											    null,
											    null,
											    null,
											    null,
											    null,
											    null,
											    null,
											     null,
											     null,
											     '0000-00-00 00:00:00')";

$resultado = mysql_query($consulta)or die('No pudo insertar : cliente_general ' . mysql_error());

}
ob_end_flush();
 //Correlativos transaccion
/*($nro,
											    $nro,
											    '$codigo',
											    1,
											    1,
											    '$ci',
											    null,
											    '$nombres',
											    '$paterno',
											    '$materno',
											    '$esposo',
											    '$fec_nac',
												null,
											    $sex,
											    $est_c,
											    '$activ',
											    '$vende',
												null,
											    null,
											    null,
												null,
											    null,
											    $tip_v,
											    null,
											    null,
											    '$direc', 
											    '$zona',
											    $fono_d,
											    $celu,
											    null,
											    null,
											     null,
											     null,
											    $agen,
											    null,
											    '$conyuge',
											    null,
											    null,
											    null,
											    null,
											    '$usr',
											     null,
											     null,
											     '0000-00-00 00:00:00')";
*/	




 ?>
 
                      