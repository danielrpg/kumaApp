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
/*
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
*/
$fec_des = $_POST['fec_des'] ; 
$fec_has = $_POST['fec_has'] ; 
$f_des = cambiaf_a_mysql($fec_des); 
$f_has = cambiaf_a_mysql($fec_has); 

?> 
 <font size="+2"  style="" >

<?php
echo encadenar(55)."Detalle de Servicios a Credito";
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
  // echo "Operador".encadenar(3).$nom_ope;
 //  }
 //if ($cod_mon == 2){
 //  echo "Moneda Dolares Americanos";
 //  }   
 ?> 
 </strong> 
 
  <table border="1" width="900">
	
	<tr>
	    <th align="center">Operador</th> 
	    <th align="center">Nro. Orden</th> 
		<th align="center">Fecha Servicio</th>  
		<th align="center">Fecha Servicio</th> 
	   	<th align="center">Cliente</th> 
		<th align="center">Servicio</th> 
		<th align="center">Monto</th>           
	</tr>	
     
 <?php  
 $t_impo = 0;
 $con_cre  = "Select * From ord_credito
             where  (ord_cre_fserv between '$f_des' and '$f_has') 
			 and ord_cre_usr_baja is null"; 
 $res_cre = mysql_query($con_cre)or die('No pudo seleccionarsepe_trans, caja_ing_egre');
  while ($lin_cre = mysql_fetch_array($res_cre)) {
$nro = 0;
$impo = 0;
//$tot_gas = 0;
  // while ($lin_car = mysql_fetch_array($res_car)) {
         $nro_rec = $lin_cre['ord_cre_nro']; 
		 $fec_s = $lin_cre['ord_cre_fserv'];
		 $fec_c = $lin_cre['ord_cre_fcob'];
		 $clie = $lin_cre['ord_cre_clie'];
		 $impo = $lin_cre['ord_cre_impo'];
         $nro_or = $lin_cre['ord_cre_nord'];
		 $serv = $lin_cre['ord_cre_serv'];
		 $cod_ope = $lin_cre['ord_cre_ope'];
		 
		 $f_serv = cambiaf_a_normal($fec_s);
		 $f_cob = cambiaf_a_normal($fec_c);
		 
		 $t_impo = $t_impo + $impo;
		 $con_ope  = "Select GRAL_PAR_PRO_DESC From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD = $cod_ope";
$res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla')  ;
$lin_ope = mysql_fetch_array($res_ope);
$nom_ope = $lin_ope['GRAL_PAR_PRO_DESC'];
			?>
	<center>
	<tr>
	     <td align="center" ><?php echo $nom_ope; ?></td>
	    <td align="center" ><?php echo  $nro_or ; ?></td>
		<td align="center" ><?php echo  $f_serv; ?></td>
		<td align="center" ><?php echo   $f_cob; ?></td>
	 	<td align="left" ><?php echo  $clie; ?></td>
		<td align="left" ><?php echo   $serv; ?></td>
	   	<td align="right" ><?php echo number_format($impo, 2, '.',','); ?></td>
	</tr>	
	 <?php	} ?>
	 <tr>
	     <td align="center" ><?php echo encadenar(2); ?></td>
	    <td align="center" ><?php echo encadenar(2) ; ?></td>
		<th align="center" ><?php echo  "Total"; ?></td>
		<td align="center" ><?php echo  encadenar(2); ?></td>
	 	<td align="left" ><?php echo  encadenar(2); ?></td>
		<td align="left" ><?php echo   encadenar(2); ?></td>
	   	<th align="right" ><?php echo number_format($t_impo, 2, '.',','); ?></td>
	</tr>	
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

