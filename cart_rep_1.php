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
<title>Resumen de Cartera</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
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
 $logi = $_SESSION['login']; 
?> 
</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                  Resumen de Cartera
            </div>
<div id="AtrasBoton">
 	<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<?php
//$_SESSION['form_buffer'] = $_POST;
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
 ?>  
  
  <table border="1" width="820">
	
	<tr>
	    <th align="center">Moneda</th> 
		<th align="center">Nro. Opera.</th> 
	   	<th align="center">Imp. Aprobado</th>
		<th align="center">Vigente</th>
		<th align="center">Vencido</th>
		<th align="center">Ejecucion</th>
		<th align="center">Total</th>
    </tr>	
     
 <?php  
$con_car  = "Select * From cart_maestro where CART_ESTADO < 8 and CART_MAE_USR_BAJA is null"; 
$res_car = mysql_query($con_car)or die('No pudo seleccionarse cart_maestro');
$nro_1 = 0;
$nro_2 = 0;
$mon_impo_1 = 0;
$mon_impo_2 = 0;


$mon_vig_1 = 0;
$mon_ven_1 = 0; 
$mon_eje_1 = 0;

$mon_vig_2 = 0;
$mon_ven_2 = 0; 
$mon_eje_2 = 0;

   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $mon = $lin_car['CART_COD_MON'];
		 $est = $lin_car['CART_ESTADO'];
		 $nom_grp = "";
		 $d_est = "";
		 
		 $tot_tpa  = 0;
		 $tot_tde = 0;
		   
   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_mon)) {
	      if ($mon == 1){
	        $d_mon_1 = $linea['GRAL_PAR_INT_DESC'];
			}
		   if ($mon == 2){	
			$d_mon_2 = $linea['GRAL_PAR_INT_DESC'];
			}
	   }
  
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $est";
      $res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla');
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  }  	
		
	//Datos del cart_det_tran						
	$con_tde = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 1 
	           AND CART_DTRA_FECHA < '2009-11-10' and CART_DTRA_USR_BAJA is null";
    $res_tde = mysql_query($con_tde)or die('No pudo seleccionarse tabla cart_det_tran')  ;
	    while ($lin_tde = mysql_fetch_array($res_tde)) {
	        $mon_tde = $lin_tde['CART_DTRA_IMPO'];
			$tot_tde = $tot_tde + $mon_tde;
			//$tot_cta = $tot_cta + 1;
			}		
	$con_tpa = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 2 
	            and CART_DTRA_CCON = 131 AND CART_DTRA_FECHA < '2009-11-10' and CART_DTRA_USR_BAJA is null";
    $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla cart_det_tran')  ;
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
			$tot_tpa = $tot_tpa + $mon_tpa;
			//$tot_cta = $tot_cta + 1;
			}		
	if ($mon == 1){
		
		if ($est == 3){
		    $mon_vig_1 = $mon_vig_1 + ($tot_tde - $tot_tpa);
			}
		 if ($est == 6){
		    $mon_ven_1 = $mon_ven_1 + ($tot_tde - $tot_tpa);
			}
		 if ($est == 7){
		    $mon_eje_1 = $mon_eje_1 + ($tot_tde - $tot_tpa);
			}
		 if ($tot_tde > 0){
		 	$mon_impo_1 = $mon_impo_1 + $impo;
			$nro_1 = $nro_1 + 1;	
			}
	}	
	if ($mon == 2){
		
		if ($est == 3){
		    $mon_vig_2 = $mon_vig_2 + ($tot_tde - $tot_tpa);
			}
		 if ($est == 6){
		    $mon_ven_2 = $mon_ven_2 + ($tot_tde - $tot_tpa);
			}
		 if ($est == 7){
		    $mon_eje_2 = $mon_eje_2 + ($tot_tde - $tot_tpa);
			}
		  if ($tot_tde > 0){
		     $mon_impo_2 = $mon_impo_2 + $impo;	
			 $nro_2 = $nro_2 + 1;
			 }
	   }	
	}
		 if ($mon_eje_1 <> 0){
		    $mon_eje_1 = 0;
			}		
			?>
	<center>
	<tr>
	    <td align="left" ><?php echo $d_mon_1; ?></td>
		<td align="right" ><?php echo number_format($nro_1, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_impo_1, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($mon_vig_1, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mon_ven_1, 2, '.',','); ?></td>
       	<td align="right" ><?php echo number_format($mon_eje_1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_vig_1+$mon_ven_1+$mon_eje_1, 2, '.',','); ?></td>
	</tr>	
	<tr>
	    <td align="left" ><?php echo $d_mon_2; ?></td>
		<td align="right" ><?php echo number_format($nro_2, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_impo_2, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($mon_vig_2, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mon_ven_2, 2, '.',','); ?></td>
       	<td align="right" ><?php echo number_format($mon_eje_2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_vig_2+$mon_ven_2+$mon_eje_2, 2, '.',','); ?></td>
	</tr>	
	<?php
       
    ?>	  
</table>		  
<br>
 

<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Resumen de Cartera por moneda</MARQUEE></FONT></B>
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

