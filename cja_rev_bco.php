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
<title>Reversion Bancos</title>
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
                  Reversion Transacciones Bancos 
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
			$con_car  = "Select DISTINCT CAJA_DEP_FECHA,CAJA_DEP_NRO,CAJA_DEP_QUIEN,
			             CAJA_DEP_TIPO
			 from  caja_deposito
             where CAJA_DEP_FECHA = '$fec1' 
             and CAJA_DEP_USR_BAJA is null"; 
             $res_car = mysql_query($con_car)or die('No pudo seleccionarse caja_deposito');
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $ncre = $lin_car['CAJA_DEP_QUIEN'];
					$tipo = $lin_car['CAJA_DEP_TIPO'];
					$nro_tra = $lin_car['CAJA_DEP_NRO'];
					
					//$impo = $lin_car['CAJA_DEP_IMPO2'];
					if ($tipo == 1){
					    $desc = "Dep.";
						}
					if ($tipo == 2){
					    $desc = "Ret.";
						}	
						
		/*	 $con_cli  = "Select * From  cart_deudor, cliente_general
             where  CART_DEU_NCRED = $ncre
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null "; 
             $res_cli = mysql_query($con_cli)or die('No pudo seleccionarse cart_maestro, cart_deudor, cliente_general');
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
				 $nom_cli = $lin_cli['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_cli['CLIENTE_NOMBRES'].encadenar(1); 
				} */
		// maestro
		/*
		$con_cli  = "Select * From  cart_maestro
                     where  CART_NRO_CRED = $ncre
                     and CART_MAE_USR_BAJA is null "; 
        $res_cli = mysql_query($con_cli)or die('No pudo seleccionarse 
			 cart_maestro, cart_deudor, cliente_general');
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
				 $c_grup = $lin_cli['CART_COD_GRUPO']; 
			}
				
				
			
		//	
		if ($c_grup <> ""){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
           $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
	 		      $nom_cli = $nom_cli.encadenar(1)."/".encadenar(1).$nom_grp;		
				}	
			}
			*/	
			
?>

<option value=<?php echo $tipo.$nro_tra;?>>
             <?php echo $desc.encadenar(2); ?> 
             <?php echo $nro_tra.encadenar(2); ?>  
	          <?php echo $ncre.encadenar(2); ?> 
             
			  
<?php 
}
//}
?>

</select><br><br>
<center>
   <input type="submit" name="accion" value="Det-Bco">
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