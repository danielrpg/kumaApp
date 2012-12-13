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
<title>Reversion Vales</title>
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
				 $fec1 = cambiaf_a_mysql_2($fec);
				 $logi = $_SESSION['login']; 
                ?> 
			</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                  Reversion Transacciones Vales 
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
<font size="2">
 <strong>
 <?php
   echo "Trans.".encadenar(4)."Descripcion".encadenar(42)."Monto".encadenar(45);
 ?>
 </strong>
 <center>
 <div id="GeneralManUsuarioM">
<form name="form2" method="post" action="grab_retro_cja.php" >

<?php
 //  echo "Trans.".encadenar(4)."Descripcion ".encadenar(22)."Monto";
 ?>
 </strong></font>
<select name="nro_tra" size="12" >


<?php
 	//Consulta Cart_maestro
			echo $fec1;
			$con_car  = "Select DISTINCT CAJA_VAL_FECHA,CAJA_VAL_NRO,CAJA_VAL_FUNC,
			             CAJA_VAL_DESCRIP,CAJA_VAL_IMPO
			 from  caja_vale
             where CAJA_VAL_FECHA = '$fec1' 
             and CAJA_VAL_USR_BAJA is null"; 
             $res_car = mysql_query($con_car)or die('No pudo seleccionarse caja_vale');
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $ncre = $lin_car['CAJA_VAL_DESCRIP'];
					$tipo = $lin_car['CAJA_VAL_FUNC'];
					$nro_tra = $lin_car['CAJA_VAL_NRO'];
					$monto = $lin_car['CAJA_VAL_IMPO'];
					//$impo = $lin_car['CAJA_DEP_IMPO2'];
					//if ($tipo == 1){
					//    $desc = "Dep.";
				//		}
				//	if ($tipo == 2){
				//	    $desc = "Ret.";
				//		}	
						
		/*	  */
		// maestro
		/*
		
				
			
		//	
	
			*/	
			
?>

<option value=<?php echo $nro_tra;?>>
              <?php echo $nro_tra.encadenar(2); ?>  
	          <?php echo $tipo.encadenar(2); ?> 
              <?php echo $ncre.encadenar(2); ?>
			  <?php echo number_format($monto, 2, '.',','); ?>
			  
<?php 
}
//}
?>

</select><br><br>
<center>
   <input type="submit" name="accion" value="Det-Val">
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