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
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 $fec = leer_param_gral();
 $f_des = cambiaf_a_mysql($fec);
// echo $f_des;
 $logi = $_SESSION['login']; 
?>
  <html>
<head>
<title>Detalle de Transaccion Ingreso / Egreso a revertir</title>
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
                 Detalle de Transaccion Compra/Venta a revertir
            </div>
<div id="AtrasBoton">
 	<a href="cja_reversion.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
 <center>
<div id="GeneralManUsuarioM">
<form name="form2" method="post" action="grab_retro_cja.php" >
<strong><font size="-1">
<?php
//$f_des = "";
//$f_has = "";
$mone = " ";
//echo $_POST['nro_tra'];
if(isset($_POST['nro_tra'])){
   $quecom = $_POST['nro_tra'];
   //echo $quecom;
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $nro_tra = $_POST['nro_tra'];
		//  echo $nro_tra." --- ";
	      }
   }
    //  $n_des = $_POST['nro_desem'];
   //   $_SESSION['nro_desem'] = $n_des;
	 // $f_des2 = cambiaf_a_mysql($f_des);
  }

?> 
<font size="+1"  style="" >
<?php
//if ($mone == 1){
//echo $nro_tra;
$tipo = substr($nro_tra,0,1);
$tran = substr($nro_tra,1,3);
if ($tipo == 1){
    $desc = "INGRESO";
	}
if ($tipo == 2){
    $desc = "EGRESO";
	}
    
    echo encadenar(20)."DETALLE DE".encadenar(1).$desc.encadenar(2).
	" NRO.".encadenar(2). $tran;
 // }
// if ($mone == 2){
 //   echo encadenar(45)."LISTADO DE DESEMBOLSOS DE CARTERA EN ".encadenar(2). "DOLARES";
 // } 
?>
</font>
<br><br>
<font size="+1"  style="" >
<?php
//echo encadenar(2).$desc;
?>
</font>
<center>
<br><br>
<font size="0"  style="" >
 <table border="1" width="550">
	<tr>
	    <th align="center"><font size="-1">DETALLE</th>
		<th align="center"><font size="-1"></th>
		<th align="center"><font size="-1"></th>
		<th align="center"><font size="-1"></th>
		
	</tr>
	
	<tr>
	    <th align="center"><font size="-1">CUENTA</th>
		<th align="center"><font size="-1">DESCRIPCION</th>
		<th align="center"><font size="-1">MONTO Bs.</th>
		<th align="center"><font size="-1">MONTO $us.</th>
		
	</tr>		 		

<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	 $t_deb = 0;
	 $t_hab = 0;
	 $t_deb2 = 0;
	 $t_hab2 = 0;				
	//echo $tipo." ".$tran;
	$con_tpa = "Select *
	            From caja_ing_egre where
	            (caja_ingegr_fecha between '$f_des' and '$f_des') and
				 caja_ingegr_tipo = $tipo and
				 caja_ingegr_corr = $tran  and
	             caja_ingegr_usr_baja is null
				 order by caja_ingegr_fecha, caja_ingegr_corr";
    $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla caja_com_ven')  ;
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $p_deb = 0;
			$p_hab = 0;
		    $p_deb2 = 0;
		    $p_hab2 = 0;
		    $fec_pag = $lin_tpa['caja_ingegr_fecha'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['caja_ingegr_corr'];
			$tran_cja = $lin_tpa['caja_ingegr_corr_cja'];
			
			$impo =  $lin_tpa['caja_ingegr_impo'];
			$impo2 =  $lin_tpa['caja_ingegr_impo_e'];
			$cta_ctb =  $lin_tpa['caja_ingegr_cta'];
			$descri =  $lin_tpa['caja_ingegr_descrip'];
			$deb_hab =  $lin_tpa['caja_ingegr_debhab'];
			$des_cta = leer_cta_des($cta_ctb);
			$_SESSION['f_tra'] = $fec_pag;
			$_SESSION['nro_tran'] = $nro_tran;
			$_SESSION['tran_cja'] = $tran_cja;
		//	echo $_SESSION['tran_cja'];
			$_SESSION['tipo'] = $tipo;
			if ($impo < 0){
			    $impo = $impo * -1;
				$impo2 = $impo2 * -1;
			}
			if ($impo <> $impo2){
			  //  echo $impo;
			    $p_hab = $impo2;
				$p_deb = $impo;
				$t_deb = $t_deb + $p_deb;
				$t_hab = $t_hab + $p_hab;
			//	echo $p_hab." *** ";
				}else{
				$p_deb = $impo;
				$p_hab = 0;
				$t_deb = $t_deb + $p_deb;
				$t_hab = $t_hab + $p_hab;
			}	
				
		?>
				<?php	
		//echo $f_des2.encadenar(2).$f_has2.encadenar(2).$nro_tran.encadenar(2).$cod_cre;	
			
			
		/*	
				 if ($t_ccon == 212){//8a
				    $p_aho =  $p_imp;
					$t_aho =  $t_aho + $p_aho;
					} //8b
				 if ($t_ccon == 242){ //9a
				    $p_otro =  $p_imp;
					$t_otro =  $t_otro + $p_otro;
					}	//9b
				}*/ // 4b	
			//	$p_tot  = $p_cap ;	
				
			// // 2b	
		//	$t_tot = $t_tot + $p_tot;
		
	
//	if ($deb_hab == 1){
	   	//$t_cap = $t_cap + $p_impe;
	?>
	<tr>
	    <td align="center" ><?php echo $cta_ctb; ?></td>
	 	<td align="left" > <?php echo $descri; ?></td>
		<td align="right" ><?php echo number_format($p_deb, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_hab, 2, '.',','); ?></td>
		
		
	</tr>	
	
			    	
		
	
	             
	 
		<?php
		//}		 
			}	 
				 
	          // } // 1b
		
			   			
	?>
	<tr>
	    <th align="left" ><?php echo encadenar(5); ?></th>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="right" ><?php echo number_format($t_deb, 2, '.',','); ?></th>
	 	<th align="right" ><?php echo number_format($t_hab, 2, '.',','); ?></th>
		
	</tr>	
</table>
<br><br>
</center>
<center>
   <input type="submit" name="accion" value="Rev-IngEgr">
   <input type="submit" name="accion" value="Salir">
  </form>
<div id="FooterTable">
Elija la Transaccion 
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

