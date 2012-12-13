<?php
   ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
	require('funciones2.php');
?>
<html>
<head>
<link href="../financiera/css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="../financiera/css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>
	<div id="cuerpoModulo">
	<?php
		//		include("header.php");
			?>
            

				<?php
			//		 $fec = leer_param_gral();
			//		 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='menu_s.php'>Salir</a>
  </div>


<font  size="+1">


<?php
if(isset($_SESSION['fec_proc'])){ 
   $fec = $_SESSION['fec_proc']; 
   $fec1 = cambiaf_a_mysql_2($fec);
 }
 		
 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp)or die('No pudo seleccionarse tabla gral_empresa');
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
//$nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
   // $nro_tr_ingegr = leer_nro_co_ingegr(2); 		  

?>
<table border="0" width="900">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(90); ?></th> 
		
		
		
		
		
   </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cbte.Caja"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$_SESSION['nro_tra']; ?></th> 
	</tr>	
	
	</table>
	<font size="+3">
<?php
echo encadenar(8)."Saldo Inicial Caja";
?>
<font size="+1">
<?php
//echo encadenar(20).$_SESSION['des_mon'].encadenar(70).$_SESSION['des_mon'];
?>
</font>
 <?php
//if ($_SESSION['detalle'] == 3){
 // echo $_SESSION['monto_t']."+".$_SESSION['monto_eq']."*".$_SESSION['egre_bs_sus']."//".$_SESSION['t_fac_fis'];
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   if (isset($_SESSION['c_agen'])){
   $c_agen = $_SESSION['c_agen'];
    }
	if (isset($_SESSION['descrip'])){
   $descrip = $_SESSION['descrip'];
   }
 //  $importe = $_SESSION['monto_t'];
 //  $imp_or = $_SESSION['monto_t'];
 //  $cta_ctbg = $_SESSION['cta_ctbg'];
 //  $dec_ctag = leer_cta_des($cta_ctbg);
  // $cta_ctb = $_SESSION['cta_ctb'];
   $deb_hab = 2;
  // if ($_SESSION['egre_bs_sus'] == 2){
 //  echo $_SESSION['monto_eq'];
   // $impo_sus = $_SESSION['monto_eq'];
//	$imp_or = $_SESSION['monto_t'];
 //   }else{
	
//	$imp_or = $_SESSION['monto_t'];		 
 //  	$impo_sus = $_SESSION['monto_t'];
	//echo "Aquiiiii ..... ".$impo_sus.$imp_or;
//	} 
      	
   
   
   $tipo = 2;
   //echo encadenar(112). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
 //   echo "aqui".$impo_sus;
?>
<br><br>
<table border="0" width="900">
<tr>
	    <th align="left"><?php echo "Cajero"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nombres']; ?></th> 
		<th align="left"><?php echo encadenar(10); ?></th>  
	   	<td align="left"><?php echo encadenar(10); ?></th> 
		 
			
    </tr>	
</table>
 <br>
 <table border="0" width="900">
  <tr>
	
	 <tr>
       	<tr>
	    <th align="left"><?php echo "Bolivianos"; ?> </th> 
		<th align="right"><?php echo number_format($_SESSION['efectivo'], 2, '.',','); ?></th>
		
   </tr>
	 <tr>
       	<tr>
	    <th align="left"><?php echo "Dolares"; ?> </th> 
		<th align="right"><?php echo number_format($_SESSION['efectivo2'], 2, '.',','); ?></th>
		
   </tr>
	
	
     </tr>
	  <tr>
	 <th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(2); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<td align="left"><?php echo encadenar(1); ?></th> 
		 <th align="left"><?php echo encadenar(8); ?> </th>
		<th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(2); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<td align="left"><?php echo encadenar(1); ?></th>   
		</tr>
	 
	
		
      </table>

</center>
<?php
	//  if ($_SESSION['egre_bs_sus'] == 1){
	   //  echo $_SESSION['monto_t']*-1;
	    $mon_des = f_literal($_SESSION['efectivo'],1);
//		}else{
		$mon_des2 = f_literal($_SESSION['efectivo2'],1);
//		}
	// echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
			
//$mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(8).$mon_des.encadenar(3).$s_mon;
	 ?>
	 <table border="0" width="900"> 
	<tr>
	    <th align="left"><?php echo encadenar(3).$mon_des.encadenar(3)."Bs."; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
	 </tr>
    <tr>	
		
		<th align="left"><?php echo encadenar(3).$mon_des2.encadenar(3)."Dol."; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		
	 </tr>
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		
	 </tr>
	
   <tr>
	    <th align="left"><?php  echo encadenar(45)."_____________________"; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
	</tr>	
    <tr>
	    <th align="left"><?php  echo encadenar(60),"CAJERO"; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
   </tr>
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
	  </table>

 <?php
  
  
  ?>	
  
 <?php
// echo $_SESSION['egre_bs_sus'].$importe;

	 
	//header('Location: egre_mante.php');
	?>
	
<?php
//}	
//header('Location: egre_mante.php');	
?>

  <?php //} ?>
	 
</div>
  <?php
		// 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
ob_end_flush();
 ?>