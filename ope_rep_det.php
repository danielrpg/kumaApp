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

$f_has ="";
$f_cal ="";
$t_cuo = 0;
$saldo = 0;
$tot_des = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
$est1 = 3;
$est2 = 8;
$cas = "";
if(isset($_POST['ctot'])){  
	 $est1 = 1;
	 $est2 = 3;
	 $cual = 3;
	 $tit = "Produccion - Gastos";
      }
if(isset($_POST['cpro'])){
   $est1 = 1;
   $est2 = 1;
   $cual = 1;
    $tit = "Produccion ";
   }
if(isset($_POST['cgas'])){
   $est1 = 2;
   $est2 = 2;
   $cual = 2;
   $tit = "Gastos"; 
   }  
  
$cod_ope = 	$_POST['cod_ope'] ;
$fec_des = $_POST['fec_des'] ; 
$fec_has = $_POST['fec_has'] ; 
$f_des = cambiaf_a_mysql($fec_des); 
$f_has = cambiaf_a_mysql($fec_has); 
$con_ope  = "Select GRAL_PAR_PRO_DESC From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD = $cod_ope";
$res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla')  ;
$lin_ope = mysql_fetch_array($res_ope);
$nom_ope = $lin_ope['GRAL_PAR_PRO_DESC'];
?> 
 <font size="+2"  style="" >

<?php
echo encadenar(55)."Detalle de ".encadenar(3).$tit;
?>
<br>
<?php
echo encadenar(45)."Desde ".encadenar(3).$fec_des.encadenar(2)."Hasta".encadenar(2).$fec_has;
?>
</font>
<br><br>
<strong>
<?php
//if ($cod_mon == 1){
   echo "Operador".encadenar(3).$nom_ope;
 //  }
 //if ($cod_mon == 2){
 //  echo "Moneda Dolares Americanos";
 //  }   
 ?> 
 </strong> 
 
  <table border="1" width="900">
	
	<tr>
	    <th align="center">Tipo</th> 
	    <th align="center">Nro. Recibo</th> 
		<th align="center">Fecha </th>  
	   	<th align="center">Descripcion</th> 
		<th align="center">Monto</th>           
	</tr>	
     
 <?php  
$con_car  = "Select * From ope_trans, caja_ing_egre
             where (ope_tra_tipo between $est1 and $est2) and ope_tra_cod = $cod_ope
             and caja_ingegr_corr = ope_tra_ingegr 
			 and (ope_tra_fec between '$f_des' and '$f_has') 
			 and ope_tra_usr_baja is null and  caja_ingegr_usr_baja is null 
	         order by  ope_tra_fec,ope_tra_tipo"; 
$res_car = mysql_query($con_car)or die('No pudo seleccionarsepe_trans, caja_ing_egre');
$nro = 0;
$tot_ing = 0;
$tot_gas = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
         $nro_rec = $lin_car['ope_tra_ingegr']; 
		 $fec = $lin_car['ope_tra_fec'];
		 $desc = $lin_car['caja_ingegr_descrip'];
		 $impo = $lin_car['ope_tra_impo'];
         $tipo = $lin_car['ope_tra_tipo'];
		 $f_trans = cambiaf_a_normal($fec);
		 if ($tipo == 1){
		     $tot_ing = $tot_ing + $impo;
			 $tip = "P";
			 }
		if ($tipo == 3){
		     $tot_ing = $tot_ing + $impo;
			 $tip = "C";
			 $con_cre  = "Select * From ord_credito
             where ord_cre_ope = $cod_ope
             and ord_cre_nro = $nro_rec
			 and (ord_cre_fserv between '$f_des' and '$f_has') 
			 and ord_cre_usr_baja is null"; 
             $res_cre = mysql_query($con_cre)or die('No pudo seleccionarsepe_trans, caja_ing_egre');
			  while ($lin_cre = mysql_fetch_array($res_cre)) {
			          $desc = $lin_cre['ord_cre_clie'];
			 	}	 
			 }	 
         if ($tipo == 2){
		     $tip = "G";
		     $tot_gas = $tot_gas + ($impo * -1);
			  $impo = $impo * -1; 
			 }	
			 
			 

			?>
	<center>
	<tr>
	     <td align="center" ><?php echo $tip; ?></td>
	    <td align="center" ><?php echo $nro_rec; ?></td>
		<td align="center" ><?php echo $f_trans; ?></td>
	 	<td align="left" ><?php echo $desc; ?></td>
	   	<td align="right" ><?php echo number_format($impo, 2, '.',','); ?></td>
	</tr>	
	 <?php	} ?>
	<?php if ($cual == 3 ){ ?>	 
	<tr>
	     <th align="left" ><?php echo encadenar(2)."Total"; ?></td>
	    <th align="left" ><?php echo encadenar(2)."Produccion"; ?></td>
	 	<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
	   <th align="right" ><?php echo number_format($tot_ing, 2, '.',','); ?></td>
		
	</tr>  
	<tr>
	     <th align="left" ><?php echo encadenar(2)."Total"; ?></td>
	    <th align="left" ><?php echo encadenar(2)."Gastos"; ?></td>
	 	<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
	    <th align="right" ><?php echo number_format($tot_gas, 2, '.',','); ?></td>
		
	</tr> 
	<tr>
	     <th align="left" ><?php echo encadenar(2)."Total"; ?></td>
	    <th align="left" ><?php echo encadenar(2)."Neto"; ?></td>
	 	<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
	    <th align="right" ><?php echo number_format($tot_ing - $tot_gas, 2, '.',','); ?></td>
		
	</tr>   
	 <?php	} ?>
	<?php if ($cual == 1 ){ ?>	 
	<tr>
	     <th align="left" ><?php echo encadenar(2)."Total"; ?></td>
	    <th align="left" ><?php echo encadenar(2)."Produccion"; ?></td>
	 	<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
	   <th align="right" ><?php echo number_format($tot_ing, 2, '.',','); ?></td>
		
	</tr> 
	 <?php	} ?>
	 <?php if ($cual == 2 ){ ?>	
	 <tr>
	     <th align="left" ><?php echo encadenar(2)."Total"; ?></td>
	    <th align="left" ><?php echo encadenar(2)."Gastos"; ?></td>
	 	<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
	    <th align="right" ><?php echo number_format($tot_gas, 2, '.',','); ?></td>
		
	</tr> 
	 
	  <?php	} ?>  
</table>		  
<br>
 
<?php
		 	include("footer_in.php");
		 ?>

</div>
</body>
</html>



<?php
ob_end_flush();
 ?>

