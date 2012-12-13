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
<title>Reversion Ingresos - Egresos</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
</head>
<body>	
	 <div id="GeneralManUsuarioM">
	<?php
				include("header.php");
			?>
            <div id="UserData">
                 <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />
				<?php
                 $fec = leer_param_gral();
				 $fec1 = cambiaf_a_mysql_2($fec);
				 $logi = $_SESSION['login']; 
                ?> 
			</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                  Reversion Ingresos - Egresos
            </div>
<div id="AtrasBoton">
 	<a href="cja_reversion.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
 <center>

<?php
 $_SESSION['continuar'] = 0;
/* */
/*
 */
//$cod_es = 7;
/* */
  ?> 
 <?php
/*
	*/
	   
?>
 <center>
 <div id="TableModulo2" >
<form name="form2" method="post" action="grab_retro_cja.php" >
<strong><font size="-1">
<?php
 //  echo "Trans.".encadenar(1)."Operacion".encadenar(22)."Cliente / Grupo";
 ?>
 </strong></font>
<?php
//$_SESSION['f_tra'] = $fec_pag;
//$_SESSION['nro_tran'] = $nro_tran;
//			$_SESSION['tipo'] = $tipo;
if (isset($_SESSION['tipo'])){
   $tipo = $_SESSION['tipo'];
}
if (isset($_SESSION['f_tra'])){
   $f_tran = $_SESSION['f_tra'];
}
if (isset($_SESSION['nro_tran'])){
   $nro_tran = $_SESSION['nro_tran'];
}
if (isset($_SESSION['tran_cja'])){
  $tran_cja = $_SESSION['tran_cja'];
}

$hoy = date("Y-m-d H:i:s");
echo $tipo, $f_tran,$nro_tran;
//reversion caja_transac
echo "Trans.".encadenar(1).$nro_tran.encadenar(1)."Revertida";

$act_tabla  = "update caja_ing_egre set caja_ingegr_usr_baja = '$logi',
                                        caja_ingegr_fch_hra_baja = '$hoy'
               where (caja_ingegr_fecha between '$f_tran' and '$f_tran') and
				 caja_ingegr_tipo = $tipo and
				 caja_ingegr_corr = $nro_tran  and
	             caja_ingegr_usr_baja is null ";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar caja_ing_egre: ' . mysql_error());

$act_tabla  = "update caja_transac set CAJA_TRAN_USR_BAJA = '$logi',
                                       CAJA_TRAN_FCH_HR_BAJA = '$hoy'
               where CAJA_TRAN_FECHA = '$f_tran'
			   and CAJA_TRAN_TIPO_OPE = 13 and CAJA_TRAN_NRO_COR =$tran_cja";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar caja_transac : ' . mysql_error());

$act_tabla  = "update ope_trans set ope_tra_usr_baja = '$logi',
                                       ope_tra_fec_hr_baja = '$hoy'
               where ope_tra_ingegr= $nro_tran";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar ope_tra_fec_hr_baja : ' . mysql_error());
			 
//reversion cart_maestro
/*
	*/		 
//reversion cart_deudor
/*$act_tabla  = "update cart_deudor set CART_DEU_USR_BAJA = '$logi',
                                      CART_DEU_FCH_HR_BAJA = '$hoy'
               where CART_DEU_NCRED = $ncre";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar cart_deudor : ' . mysql_error());	
			 */
//reversion cart_plandp
/*
$act_tabla  = "update cart_plandp set CART_PLD_USR_BAJA = '$logi',
                                      CART_PLD_FCH_HR_BAJA = '$hoy'
               where CART_PLD_NCRE = $ncre";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar cart_plandp : ' . mysql_error());			 
			 */
//reversion fond_maestro
 
	/*		 
$act_tabla  = "update fond_maestro set FOND_MAE_USR_BAJA = '$logi',
                                       FOND_MAE_FCH_HR_BAJA = '$hoy'
               where FOND_NRO_CRED = $ncre";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar fond_maestro : ' . mysql_error());			 
*/

			 
			 			 
//Actualizacion de cred_solicitud
  /* $act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=7  where
    CRED_SOL_NRO_CRED = $ncre and CRED_SOL_USR_BAJA is null";
   $res_act_s = mysql_query($act_cred_solic) or die('No pudo actualizar cred_solicitud : ' . mysql_error());
*/









 	
	
?>

</select><br><br>
<center>
   
   <input type="submit" name="accion" value="Salir">
  </form>
<div id="FooterTable">
Elija la Transaccion 
</div>
<?php
//}
		 	include("footer_in.php");
		 ?>

</div>
</body>
</html>
<?php
    ob_end_flush();
 ?>