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
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cja_reportes.php'>Salir</a>
  </div>

<br><br>
<?php
$f_des = "";
$f_has = "";
$mone = " ";
if(isset($_POST['fec_des'])){
      $f_des = $_POST['fec_des'];
      $_SESSION['f_des'] = $f_des;
	  $f_des2 = cambiaf_a_mysql($f_des);
  }
 if(isset($_POST['fec_has'])){
      $f_has = $_POST['fec_has'];
      $_SESSION['f_has'] = $f_has;
	  $f_has2 = cambiaf_a_mysql($f_has);
  } 
 // if(isset($_POST['cod_mon'])){
 //     $mone = $_POST['cod_mon'];
 //     $_SESSION['mone'] = $mone;
  //}  
?> 
<font size="+1"  style="" >
<?php
//if ($mone == 1){
    echo encadenar(55)."LISTADO DE MOVIMIENTOS INGRESOS/EGRESOS ";
 // }
 //if ($mone == 2){
 //   echo encadenar(45)."LISTADO DE MOVIMIENTOS INGRESOS/EGRESOS EN ".encadenar(2). "DOLARES";
 // } 
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(60)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>
<center>
<br><br>
<font size="0"  style="" >
	 <table border="1" width="900">
	
	<tr>
	    <th align="center">TIP.TRAN.</th> 
	    <th align="center">FECHA TRANSAC.</th> 
		<th align="center">NRO. TRAN.</th>  
	   	<th align="center">CTA CONTABLE</th> 
		<th align="center">DESCRIPCION CTBLE</th>
		<th align="center">DETALLES</th>           
	    <th align="center">INGRESOS Bs.</th>     
		<th align="center">EGRESOS Bs.</th>
		<th align="center">INGRESOS $us.</th>     
		<th align="center">EGRESOS $us.</th>
		
    </tr>		

<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	$t_ing1 = 0;
	$t_egr1 = 0;
	$t_ing2 = 0;
	$t_egr2 = 0;		
	$con_tpa = "Select * From caja_ing_egre where
	            (caja_ingegr_fecha between '$f_des2' and '$f_has2') and 
	             substr(caja_ingegr_cta,1,3) = '111' and
				 caja_ingegr_usr_baja is null 
				 order by caja_ingegr_corr ";
    $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla caja_ing_egre 1')  ;
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $p_ing1 = 0;
			$p_egr1 = 0;
		    $p_ing2 = 0;
			$p_egr2 = 0;
			$p_eqvi = 0;
			$t_tran = "";
		    $tip_tran = $lin_tpa['caja_ingegr_tipo'];
		    $fec_pag = $lin_tpa['caja_ingegr_fecha'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['caja_ingegr_corr'];
			$cta_ctble = $lin_tpa['caja_ingegr_cta'];
			$impo = $lin_tpa['caja_ingegr_impo'];
			$impo_e = $lin_tpa['caja_ingegr_impo_e'];
			$detalle = $lin_tpa['caja_ingegr_descrip'];
			$deb_hab = $lin_tpa['caja_ingegr_debhab'];
		 if ($impo == $impo_e){
			if ($tip_tran == 1){
				$t_tran = "I";
				$p_ing1 =  $impo;
				$p_ing2 =  0;
				$t_ing1 =  $t_ing1 + $p_ing1;
				}else{
				$t_tran = "E";
				$p_egr1 =  $impo*-1				;
				$p_egr2 =  0;
				$t_egr1 =  $t_egr1 + $p_egr1;
			}
		}	
			if ($impo <> $impo_e){
			  if ($tip_tran == 1){
			     $t_tran = "I";
			   	 $p_ing2 = $impo_e;
				 $p_ing1 = 0;
				 $t_ing2 =  $t_ing2 + $p_ing2;
				}else{
				 $t_tran = "E";
				 $p_egr2 = $impo_e * -1;
				 $p_egr1 = 0;
				 $t_egr2 =  $t_egr2 + $p_egr2;
				}
			}	
			
		//	echo $cod_cre;
	//Consulta Cart_maestro
			
			$con_ctble  = "Select * From contab_cuenta
             where CONTA_CTA_NRO = '$cta_ctble' "; 
             $res_ctble = mysql_query($con_ctble)or die('No pudo seleccionarse contab_cuenta');
 
             while ($lin_ctble = mysql_fetch_array($res_ctble)) {
			        $des_cta = $lin_ctble['CONTA_CTA_DESC'];
				}	
			
		?>
		<tr>
	    <td align="center" ><?php echo $t_tran; ?></td>
	    <td align="left" ><?php echo $f_pag; ?></td>
		<td align="right" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		<td align="center" ><?php echo $cta_ctble; ?></td>	
		<td align="left" ><?php echo $des_cta; ?></td>	
		<td align="left" ><?php echo $detalle; ?></td>							
	    <td align="right" ><?php echo number_format($p_ing1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_egr1, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($p_ing2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_egr2, 2, '.',','); ?></td>
		
	</tr>	
	
	<?php   } 	?>
	<tr>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>	
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>						
	    <th align="right" ><?php echo number_format($t_ing1, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_egr1, 2, '.',','); ?></th>
	 	<th align="right" ><?php echo number_format($t_ing2, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_egr2, 2, '.',','); ?></th>
		
	</tr>	
</table>
<br><br>
</center>		
<?php	
 	include("footer_in.php");
?>

</div>
</body>
</html>



<?php
ob_end_flush();
 ?>

