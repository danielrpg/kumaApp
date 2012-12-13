<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
	$fec = leer_param_gral();
?>
<link href="css/estilo.css" rel="stylesheet" type="text/css"> 
<script language="javascript" src="script/validarForm.js"></script> 
</head>
<body>	
<div id="cuerpoModulo">
     <?php
	   include("header.php");
 	 ?>
<div id="UserData">
     <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />
	 </div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">			
           Cronograma Diario 
	</div>
<div id="AtrasBoton">
    <a href="crono_orden.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<center>
<div id="GeneralManSolicaa">
<font color="#0000FF"
 <br>
<?php
if(isset($_SESSION['login'])){
  $log_usr = $_SESSION['login']; 
  }
if(isset($_SESSION["impo_sol"])){ 
   $imp_sol = $_SESSION["impo_sol"];
   }
//echo $_SESSION['nro_sol'], "codigo sol";
$total = 0;
//if ( $_SESSION['continuar'] == 2) {
   $fecha = $_POST['fec_nac'];
 //  for ($i=0; $i < count($quecom); $i = $i + 1 ) {
    //   if (isset($quecom[$i]) ) {
    //      $cod_sol = $quecom[$i];
	//      $_SESSION['nro_sol'] = $nro_sol;
    //   }
  // } 
  // }else{
  // $cod_sol = $_SESSION['nro_sol'];
  // }
//Seleccion solicitud

$fec = cambiaf_a_mysql($fecha);
$nro_ope = 0;
//for ($x=1; $x < 14; $x = $x + 1 ) {
    //for ($y=1; $y < 5; $y = $y + 1 ) {
//	$nro_ope =$nro_ope + 1; 
$con_sol  = "Select * From temp_crono where tem_cro_fecha = '$fec'"; 
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse ord_cronograma');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
      	 $hora = $lin_sol['tem_cro_hra'];
		 $ccli_1 = $lin_sol['tem_cro_op_ccli_1'];
		 $cli_1 = $lin_sol['tem_cro_op_cli_1'];
		 $ser_1 = $lin_sol['tem_cro_op_ser_1'];
		 $com_1 = $lin_sol['tem_cro_op_com_1'];
		 $sta_1 = $lin_sol['tem_cro_op_sta_1'];
		
		 $ccli_2 = $lin_sol['tem_cro_op_ccli_2'];
		 $cli_2 = $lin_sol['tem_cro_op_cli_2'];
		 $ser_2 = $lin_sol['tem_cro_op_ser_2'];
		 $com_2 = $lin_sol['tem_cro_op_com_2'];
		 $sta_2 = $lin_sol['tem_cro_op_sta_2'];
		
		 $ccli_3 = $lin_sol['tem_cro_op_ccli_3'];
		 $cli_3 = $lin_sol['tem_cro_op_cli_3'];
		 $ser_3 = $lin_sol['tem_cro_op_ser_3'];
		 $com_3 = $lin_sol['tem_cro_op_com_3'];
		 $sta_3 = $lin_sol['tem_cro_op_sta_3'];
		 
	      $ccli_4 = $lin_sol['tem_cro_op_ccli_4'];
		 $cli_4 = $lin_sol['tem_cro_op_cli_4'];
		 $ser_4 = $lin_sol['tem_cro_op_ser_4'];
		 $com_4 = $lin_sol['tem_cro_op_com_4'];
		 $sta_4 = $lin_sol['tem_cro_op_sta_4'];
		  
		  
		  
		  
		  
		 } 
		  
//	}
		?>
	 <br>
	<form name="form1" method="post" action="solic_retro_sol.php" > 
	
    			
	<table border="1" width="800">
	 <?php
     
	 
	  $ope[1] = 1;
	 $ope[2] = 2;
	 $ope[3] = 3;
	 $ope[4] =4;
	 ?>
	
		
	<tr>
		<th>HORA </th>
		<?php for ($i=1; $i < 5; $i = $i + 1 ) { ?>
		<th><?php echo "OPERADOR (" ,$ope[$i], ") ";?>
		<br>
		<?php //echo  $fec_pag [$i]; ?></th>
		<?php } ?>		
	</tr>
	   <?php
	  $hora[1] = " 6 A.M";
	 $hora[2] = " 7 A.M";
	 $hora[3] = " 8 A.M";
	 $hora[4] = " 9 A.M";
	 $hora[5] = " 10 A.M";
	 $hora[6] = " 11 A.M";
	 $hora[7] = " 12 A.M";
	 $hora[8] = " 1 P.M";
	 $hora[9] = " 2 P.M";
	 $hora[10] = " 3 P.M";
	 $hora[11] = " 4 P.M";
	 $hora[12] = " 5 P.M";
	 $hora[13] = " 6 P.M"; 
	   
	 $con_sol  = "Select * From temp_crono where tem_cro_fecha = '$fec'"; 
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse ord_cronograma');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
      	 $hora = $lin_sol['tem_cro_hra'];
		 $ccli_1 = $lin_sol['tem_cro_op_ccli_1'];
		 $cli_1 = $lin_sol['tem_cro_op_cli_1'];
		 $ser_1 = $lin_sol['tem_cro_op_ser_1'];
		 $com_1 = $lin_sol['tem_cro_op_com_1'];
		 $sta_1 = $lin_sol['tem_cro_op_sta_1'];
		
		 $ccli_2 = $lin_sol['tem_cro_op_ccli_2'];
		 $cli_2 = $lin_sol['tem_cro_op_cli_2'];
		 $ser_2 = $lin_sol['tem_cro_op_ser_2'];
		 $com_2 = $lin_sol['tem_cro_op_com_2'];
		 $sta_2 = $lin_sol['tem_cro_op_sta_2'];
		
		 $ccli_3 = $lin_sol['tem_cro_op_ccli_3'];
		 $cli_3 = $lin_sol['tem_cro_op_cli_3'];
		 $ser_3 = $lin_sol['tem_cro_op_ser_3'];
		 $com_3 = $lin_sol['tem_cro_op_com_3'];
		 $sta_3 = $lin_sol['tem_cro_op_sta_3'];
		 
	      $ccli_4 = $lin_sol['tem_cro_op_ccli_4'];
		 $cli_4 = $lin_sol['tem_cro_op_cli_4'];
		 $ser_4 = $lin_sol['tem_cro_op_ser_4'];
		 $com_4 = $lin_sol['tem_cro_op_com_4'];
		 $sta_4 = $lin_sol['tem_cro_op_sta_4'];
			 
    
	//   for ($i=1; $i < 14; $i = $i + 1 ) { 
	           //   ?>
	 <tr>
	  	 	<th align="center"><?php echo  "hora"; ?></td>
			<?php //for ($x=1; $x < 5; $x = $x + 1 ) {
			  //if ($opera[$x] == 1){
			if(isset( $cli_1)){
			         
			       ?>
		          <td align="left"><?php echo number_format( $ccli_1, 0, '.',',').$i ; ?>
				  <br>
				  <?php echo  $cli_1 ; ?>
				  <br>
				  <?php echo  $ser_1 ; ?>
				   <br>
				  <?php echo  $com_1 ; ?>
				  </td>
		    <?php }
			    //  } ?>	
			<?php if(isset( $hra_7_c[$i])){?>
		          <td align="left"><?php echo number_format( $hra_7_cc[$i], 0, '.',',').$i ; ?>
				  <br>
				  <?php echo  $hra_7_c[$i] ; ?>
				  <br>
				  <?php echo  $hra_7_s[$i] ; ?>
				   <br>
				  <?php echo  $hra_7_co[$i] ; ?>
				  </td>
		    <?php } ?>	
			<?php if(isset( $hra_8_c[$i])){?>
		          <td align="left"><?php echo number_format( $hra_8_cc[$i], 0, '.',',') ; ?>
				  <br>
				  <?php echo  $hra_8_c[$i] ; ?>
				  <br>
				  <?php echo  $hra_8_s[$i] ; ?>
				   <br>
				  <?php echo  $hra_8_co[$i] ; ?>
				  </td>
		    <?php } ?>	
		<?php if(isset( $hra_9_c[$i])){?>
		          <td align="left"><?php echo number_format( $hra_9_cc[$i], 0, '.',',') ; ?>
				  <br>
				  <?php echo  $hra_9_c[$i] ; ?>
				  <br>
				  <?php echo  $hra_9_s[$i] ; ?>
				   <br>
				  <?php echo  $hra_9_co[$i] ; ?>
				  </td>
		    <?php } ?>	
		<?php if(isset( $hra_10_cc[$i])){?>
		          <td align="left"><?php echo number_format( $hra_10_cc[$i], 0, '.',',') ; ?>
				  <br>
				  <?php echo  $hra_10_c[$i] ; ?>
				  <br>
				  <?php echo  $hra_10_s[$i] ; ?>
				   <br>
				  <?php echo  $hra_10_co[$i] ; ?>
				  </td>
		    <?php } ?>	
		<?php if(isset( $hra_11_cc[$i])){?>
		          <td align="left"><?php echo number_format( $hra_11_cc[$i], 0, '.',',') ; ?>
				  <br>
				  <?php echo  $hra_11_c[$i] ; ?>
				  <br>
				  <?php echo  $hra_11_s[$i] ; ?>
				   <br>
				  <?php echo  $hra_11_co[$i] ; ?>
				  </td>
		    <?php } ?>	
		<?php if(isset( $hra_12_cc[$i])){?>
		          <td align="left"><?php echo number_format( $hra_12_cc[$i], 0, '.',',') ; ?>
				  <br>
				  <?php echo  $hra_12_c[$i] ; ?>
				  <br>
				  <?php echo  $hra_12_s[$i] ; ?>
				   <br>
				  <?php echo  $hra_12_co[$i] ; ?>
				  </td>
		    <?php } ?>	
	  <?php if(isset( $hra_13_cc[$i])){?>
		          <td align="left"><?php echo number_format( $hra_13_cc[$i], 0, '.',',') ; ?>
				  <br>
				  <?php echo  $hra_13_c[$i] ; ?>
				  <br>
				  <?php echo  $hra_13_s[$i] ; ?>
				   <br>
				  <?php echo  $hra_13_co[$i] ; ?>
				  </td>
		    <?php } ?>		
			
	 <?php if(isset( $hra_14_cc[$i])){?>
		          <td align="left"><?php echo number_format( $hra_14_cc[$i], 0, '.',',') ; ?>
				  <br>
				  <?php echo  $hra_14_c[$i] ; ?>
				  <br>
				  <?php echo  $hra_14_s[$i] ; ?>
				   <br>
				  <?php echo  $hra_14_co[$i] ; ?>
				  </td>
		    <?php } ?>	
			
	 <?php if(isset( $hra_15_cc[$i])){?>
		          <td align="left"><?php echo number_format( $hra_15_cc[$i], 0, '.',',') ; ?>
				  <br>
				  <?php echo  $hra_15_c[$i] ; ?>
				  <br>
				  <?php echo  $hra_15_s[$i] ; ?>
				   <br>
				  <?php echo  $hra_15_co[$i] ; ?>
				  </td>
		    <?php } ?>	
	 <?php if(isset( $hra_16_cc[$i])){?>
		          <td align="left"><?php echo number_format( $hra_16_cc[$i], 0, '.',',') ; ?>
				  <br>
				  <?php echo  $hra_16_c[$i] ; ?>
				  <br>
				  <?php echo  $hra_16_s[$i] ; ?>
				   <br>
				  <?php echo  $hra_16_co[$i] ; ?>
				  </td>
		    <?php } ?>	
	<?php if(isset( $hra_17_cc[$i])){?>
		          <td align="left"><?php echo number_format( $hra_17_cc[$i], 0, '.',',') ; ?>
				  <br>
				  <?php echo  $hra_17_c[$i] ; ?>
				  <br>
				  <?php echo  $hra_17_s[$i] ; ?>
				   <br>
				  <?php echo  $hra_17_co[$i] ; ?>
				  </td>
		    <?php } ?>	
	<?php if(isset( $hra_18_cc[$i])){?>
		          <td align="left"><?php echo number_format( $hra_18_cc[$i], 0, '.',',') ; ?>
				  <br>
				  <?php echo  $hra_18_c[$i] ; ?>
				  <br>
				  <?php echo  $hra_18_s[$i] ; ?>
				   <br>
				  <?php echo  $hra_18_co[$i] ; ?>
				  </td>
		    <?php } // } }?>												
				  
		<?php } //} ?>
		
		<br>
		</tr>
   </table>
</center>
<strong>
</strong>	
<center>
<input type="submit" name="accion" value="Contrato">
<input type="submit" name="accion" value="Salir">
</form>	
<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Revise los montos antes de Continuar</MARQUEE></FONT></B>
</div>
   <?php
		 	include("footer_in.php");
	 ?> 
<?php
ob_end_flush();
 ?>