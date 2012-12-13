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
    echo encadenar(45)."LISTADO DE MOVIMIENTOS CAJA ";
 // }
 //if ($mone == 2){
 //   echo encadenar(45)."LISTADO DE MOVIMIENTOS CAJA EN ".encadenar(2). "DOLARES";
 // } 
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(47)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>
<center>
<br><br>
<font size="0"  style="" >
	 <table border="1" width="1000">
	
	<tr>
	    <th align="center">FECHA TRANSAC.</th> 
		<th align="center">NRO. TRAN.</th>  
	   	<th align="center">APLICACION</th> 
		<th align="center">DETALLES</th>           
	    <th align="center">INGRESOS Bs.</th>     
		<th align="center">EGRESOS Bs.</th>
		<th align="center">SALDO Bs.</th>  
		<th align="center">INGRESOS $us.</th>     
		<th align="center">EGRESOS $us.</th>
		 <th align="center">SALDO $us.</th>
    </tr>		

<?php 
  //Datos del cart_det_tran	
   	$t_ing = 0;
	$t_egr = 0;
	$t_ing1 = 0;
	$t_egr1 = 0;
	$t_egr = 0;			
	$t_ing2 = 0;
	$t_egr2 = 0;
	$impo_sus = 0;
	$impo = 0;					
	$con_tpa = "Select * From caja_transac where
	            (CAJA_TRAN_FECHA between '$f_des2' and '$f_has2') 
	           	 and CAJA_TRAN_USR_BAJA is null 
				 order by  CAJA_TRAN_FECHA,CAJA_TRAN_NRO_COR ";
    $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla caja_transac')  ;
	// and CAJA_TRAN_APL_DES <> 10000
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $fec_pag = $lin_tpa['CAJA_TRAN_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CAJA_TRAN_NRO_DOC'];
			$cod_apl = $lin_tpa['CAJA_TRAN_APL_DES'];
			$mone = $lin_tpa['CAJA_TRAN_MON'];
			$impo = $lin_tpa['CAJA_TRAN_IMPORTE'];
			$impo_sus = $lin_tpa['CAJA_TRAN_IMP_EQUIV'];
			$detalle = $lin_tpa['CAJA_TRAN_DESCRIP'];
			$tip_ope = $lin_tpa['CAJA_TRAN_TIPO_OPE'];
			
			$p_ing1 = 0;
			$p_ing2 = 0;
			$p_egr1 = 0;
		    $p_egr2 = 0;			  
	if ($tip_ope <> 14){
		if ($impo <> $impo_sus){	
			if ($impo_sus > 0){ 
			    $p_ing2 =  $impo_sus;
				$p_ing1 =  0;
				} 	
			 if ($impo_sus < 0){ 
			    $p_egr2 =  $impo_sus * -1;
			    $p_egr1 =  0;
				}	
			}else{
			  if ($impo > 0){ 
			     $p_ing1 =  $impo;
			     $p_ing2 =  0;
				} 
			  if ($impo < 0){ //4a
			     $p_egr1 =  $impo * -1;
			     $p_egr2 =  0;
			 	} 	 	
			}
		}
	if ($tip_ope == 14){
	//	if ($impo <> $impo_sus){	
			if ($impo_sus > 0){ 
			    $p_ing2 =  $impo_sus;
				$p_egr1 =  $impo * -1;
				} 	
			 if ($impo_sus < 0){ 
			    $p_egr2 =  $impo_sus * -1;
			    $p_ing1 =  $impo;
				}	
			//		}
		}			
			 $con_ctble = "Select * From gral_param_propios
             where GRAL_PAR_PRO_GRP = 100 and GRAL_PAR_PRO_COD = $cod_apl "; 
             $res_ctble = mysql_query($con_ctble)or die('No pudo seleccionarse gral_param_propios');
 
             while ($lin_ctble = mysql_fetch_array($res_ctble)) {
			        $des_apl = $lin_ctble['GRAL_PAR_PRO_DESC'];
				}	
		
		?>
	
	
	<tr>
	    <td align="center" ><?php echo $f_pag; ?></td>
		<td align="right" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		<td align="left" style="font-size:10px" ><?php echo $des_apl; ?></td>	
		<td align="left" ><?php echo $detalle; ?></td>	
	<?php $t_ing1 =  $t_ing1 + $p_ing1;
		  $t_egr1 =  $t_egr1 + $p_egr1;
		  $t_ing2 =  $t_ing2 + $p_ing2;	
	      $t_egr2 =  $t_egr2 + $p_egr2;  ?>							
	    <td align="right" ><?php echo number_format($p_ing1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_egr1, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($t_ing1 - $t_egr1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_ing2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_egr2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($t_ing2 - $t_egr2, 2, '.',','); ?></td>
	</tr>
	<?php  } ?>
	<tr>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>					
	    <th align="right" ><?php echo number_format($t_ing1, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_egr1, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_ing1 - $t_egr1, 2, '.',','); ?></td>
	 	<th align="right" ><?php echo number_format($t_ing2, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_egr2, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_ing2 - $t_egr2, 2, '.',','); ?></td>
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

