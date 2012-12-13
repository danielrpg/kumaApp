<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
	$fec = leer_param_gral();
	
?>
<html>
<head>
<title>Cronograma Diario</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
</head>
<body>	
	<div id="">
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
    <a href="menu_s.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>

<div id="">

<font color="#0000FF">

<?php

//color="#0000FF"
if(isset($_SESSION['login'])){
  $log_usr = $_SESSION['login']; 
  }
//echo $fecha."Fecha";
//echo $_SESSION['nro_sol'], "codigo sol";
$total = 0;
if ($_SESSION['dia'] == 1) {
   $hoy = date("Y-m-d");
   $fecha = $hoy;
   $_SESSION['fecha'] = $fecha;
   $_SESSION['fec_nue'] = cambiaf_a_normal($fecha);
}   
if ($_SESSION['dia'] == 4) {
   $hoy = date("Y-m-d");
   $fecha = $hoy;
   $_SESSION['fecha'] = $fecha;
   $_SESSION['fec_nue'] = cambiaf_a_normal($fecha);
}   
if ($_SESSION['dia'] == 2) {
 $ndias = 1;
   $fec = cambiaf_a_normal($_SESSION['fecha']);
   $fecha = restaDia($fec,$ndias);

   //$fecha = date("d-m-Y", strtotime("$fec + $dia days"));
  // echo $fecha;
   $fecha = cambiaf_a_mysql($fecha);
   $_SESSION['fecha'] = $fecha;
   $_SESSION['fec_nue'] = cambiaf_a_normal($fecha);
} 
if ($_SESSION['dia'] == 3) {

   $ndias = 1;
   $fec = cambiaf_a_normal($_SESSION['fecha']);
   $fecha = sumaDia($fec,$ndias);

   //$fecha = date("d-m-Y", strtotime("$fec + $dia days"));
  // echo $fecha;
   $fecha = cambiaf_a_mysql($fecha);
   $_SESSION['fecha'] = $fecha;
   $_SESSION['fec_nue'] = cambiaf_a_normal($fecha);
}

//Seleccion solicitud
if ($_SESSION['dia'] == 5) {
//   $hoy = date("Y-m-d");
//   $fecha = $hoy;
    $fecha = $_SESSION['fecha'];
   $_SESSION['fec_nue'] = cambiaf_a_normal($fecha);
} 

if ($_SESSION['dia'] == 6) {
   if(isset($_POST['fec_has'])){
     if ($_POST['fec_has'] == ""){
	     echo "No selecciono una fecha especifica";
         $hoy = date("Y-m-d");
         $fecha = $hoy;
         $_SESSION['fecha'] = $fecha;
         $_SESSION['fec_nue'] = cambiaf_a_normal($fecha);
         }else{
         $fecha = $_POST['fec_has'];
	     $fecha = cambiaf_a_mysql($fecha);
	     $_SESSION['fecha'] = $fecha;
         $_SESSION['fec_nue'] = cambiaf_a_normal($fecha);
         } 
	    }  
      }
$dia = substr($fecha,8,2);
$mes = substr($fecha,5,2);
$anio = substr($fecha,0,4);
$fec = cambiaf_a_mysql($fecha);

$nro_ope = 0;
$x = 0;
//echo $fecha. " va a leer con esa fecha";
//for ($x=1; $x < 14; $x = $x + 1 ) {
    //for ($y=1; $y < 5; $y = $y + 1 ) {
	//$nro_ope =$nro_ope + 1; 
$con_sol  = "Select * From ord_conograma where ord_cro_fecha = '$fecha'"; 
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse ord_cronograma');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
        $nro_ope = 0;
 
        $nro_ope = $lin_sol['ord_cro_ope'];
		//echo "Aqui".$nro_ope;
	  if ($nro_ope == 1) {
		  $hra_6_det[$nro_ope] = $lin_sol['ord_cro_6_det'];
		  $hra_7_det[$nro_ope] = $lin_sol['ord_cro_7_det'];
		  $hra_8_det[$nro_ope] = $lin_sol['ord_cro_8_det'];
		  $hra_9_det[$nro_ope] = $lin_sol['ord_cro_9_det'];	
		  $hra_10_det[$nro_ope] = $lin_sol['ord_cro_10_det'];
		  $hra_11_det[$nro_ope] = $lin_sol['ord_cro_11_det'];
		  $hra_12_det[$nro_ope] = $lin_sol['ord_cro_12_det'];
		  $hra_13_det[$nro_ope] = $lin_sol['ord_cro_13_det']; 
		  $hra_14_det[$nro_ope] = $lin_sol['ord_cro_14_det'];
		  $hra_15_det[$nro_ope] = $lin_sol['ord_cro_15_det'];
		  $hra_16_det[$nro_ope] = $lin_sol['ord_cro_16_det']; 
		  $hra_17_det[$nro_ope] = $lin_sol['ord_cro_17_det']; 
		  $hra_18_det[$nro_ope] = $lin_sol['ord_cro_18_det'];
		  $hra_19_det[$nro_ope] = $lin_sol['ord_cro_ot_det']; 
		 //  echo $hra_ot_det[$nro_ope]."---". $lin_sol['ord_cro_ot_det'];
			}
		 if ($nro_ope == 2) {	
		    $hra_6_det[$nro_ope] = $lin_sol['ord_cro_6_det'];
		  $hra_7_det[$nro_ope] = $lin_sol['ord_cro_7_det'];
		  $hra_8_det[$nro_ope] = $lin_sol['ord_cro_8_det'];
		  $hra_9_det[$nro_ope] = $lin_sol['ord_cro_9_det'];	
		  $hra_10_det[$nro_ope] = $lin_sol['ord_cro_10_det'];
		  $hra_11_det[$nro_ope] = $lin_sol['ord_cro_11_det'];
		  $hra_12_det[$nro_ope] = $lin_sol['ord_cro_12_det'];
		  $hra_13_det[$nro_ope] = $lin_sol['ord_cro_13_det']; 
		  $hra_14_det[$nro_ope] = $lin_sol['ord_cro_14_det'];
		  $hra_15_det[$nro_ope] = $lin_sol['ord_cro_15_det'];
		  $hra_16_det[$nro_ope] = $lin_sol['ord_cro_16_det']; 
		  $hra_17_det[$nro_ope] = $lin_sol['ord_cro_17_det']; 
		  $hra_18_det[$nro_ope] = $lin_sol['ord_cro_18_det'];
		  $hra_19_det[$nro_ope] = $lin_sol['ord_cro_ot_det']; 
		  
		  
		 }
		  if ($nro_ope == 3) {	
		   $hra_6_det[$nro_ope] = $lin_sol['ord_cro_6_det'];
		  $hra_7_det[$nro_ope] = $lin_sol['ord_cro_7_det'];
		  $hra_8_det[$nro_ope] = $lin_sol['ord_cro_8_det'];
		  $hra_9_det[$nro_ope] = $lin_sol['ord_cro_9_det'];	
		  $hra_10_det[$nro_ope] = $lin_sol['ord_cro_10_det'];
		  $hra_11_det[$nro_ope] = $lin_sol['ord_cro_11_det'];
		  $hra_12_det[$nro_ope] = $lin_sol['ord_cro_12_det'];
		  $hra_13_det[$nro_ope] = $lin_sol['ord_cro_13_det']; 
		  $hra_14_det[$nro_ope] = $lin_sol['ord_cro_14_det'];
		  $hra_15_det[$nro_ope] = $lin_sol['ord_cro_15_det'];
		  $hra_16_det[$nro_ope] = $lin_sol['ord_cro_16_det']; 
		  $hra_17_det[$nro_ope] = $lin_sol['ord_cro_17_det']; 
		  $hra_18_det[$nro_ope] = $lin_sol['ord_cro_18_det'];
		  $hra_19_det[$nro_ope] = $lin_sol['ord_cro_ot_det'];   
		}
		 if ($nro_ope == 4) {	
		  $hra_6_det[$nro_ope] = $lin_sol['ord_cro_6_det'];
		  $hra_7_det[$nro_ope] = $lin_sol['ord_cro_7_det'];
		  $hra_8_det[$nro_ope] = $lin_sol['ord_cro_8_det'];
		  $hra_9_det[$nro_ope] = $lin_sol['ord_cro_9_det'];	
		  $hra_10_det[$nro_ope] = $lin_sol['ord_cro_10_det'];
		  $hra_11_det[$nro_ope] = $lin_sol['ord_cro_11_det'];
		  $hra_12_det[$nro_ope] = $lin_sol['ord_cro_12_det'];
		  $hra_13_det[$nro_ope] = $lin_sol['ord_cro_13_det']; 
		  $hra_14_det[$nro_ope] = $lin_sol['ord_cro_14_det'];
		  $hra_15_det[$nro_ope] = $lin_sol['ord_cro_15_det'];
		  $hra_16_det[$nro_ope] = $lin_sol['ord_cro_16_det']; 
		  $hra_17_det[$nro_ope] = $lin_sol['ord_cro_17_det']; 
		  $hra_18_det[$nro_ope] = $lin_sol['ord_cro_18_det'];
		  $hra_19_det[$nro_ope] = $lin_sol['ord_cro_ot_det']; 
		  
	}
	 if ($nro_ope == 5) {	
		  $hra_6_det[$nro_ope] = $lin_sol['ord_cro_6_det'];
		  $hra_7_det[$nro_ope] = $lin_sol['ord_cro_7_det'];
		  $hra_8_det[$nro_ope] = $lin_sol['ord_cro_8_det'];
		  $hra_9_det[$nro_ope] = $lin_sol['ord_cro_9_det'];	
		  $hra_10_det[$nro_ope] = $lin_sol['ord_cro_10_det'];
		  $hra_11_det[$nro_ope] = $lin_sol['ord_cro_11_det'];
		  $hra_12_det[$nro_ope] = $lin_sol['ord_cro_12_det'];
		  $hra_13_det[$nro_ope] = $lin_sol['ord_cro_13_det']; 
		  $hra_14_det[$nro_ope] = $lin_sol['ord_cro_14_det'];
		  $hra_15_det[$nro_ope] = $lin_sol['ord_cro_15_det'];
		  $hra_16_det[$nro_ope] = $lin_sol['ord_cro_16_det']; 
		  $hra_17_det[$nro_ope] = $lin_sol['ord_cro_17_det']; 
		  $hra_18_det[$nro_ope] = $lin_sol['ord_cro_18_det'];
		  $hra_19_det[$nro_ope] = $lin_sol['ord_cro_ot_det']; 
		  
	}
	
		 if ($nro_ope == 6) {	
		  $hra_6_det[$nro_ope] = $lin_sol['ord_cro_6_det'];
		  $hra_7_det[$nro_ope] = $lin_sol['ord_cro_7_det'];
		  $hra_8_det[$nro_ope] = $lin_sol['ord_cro_8_det'];
		  $hra_9_det[$nro_ope] = $lin_sol['ord_cro_9_det'];	
		  $hra_10_det[$nro_ope] = $lin_sol['ord_cro_10_det'];
		  $hra_11_det[$nro_ope] = $lin_sol['ord_cro_11_det'];
		  $hra_12_det[$nro_ope] = $lin_sol['ord_cro_12_det'];
		  $hra_13_det[$nro_ope] = $lin_sol['ord_cro_13_det']; 
		  $hra_14_det[$nro_ope] = $lin_sol['ord_cro_14_det'];
		  $hra_15_det[$nro_ope] = $lin_sol['ord_cro_15_det'];
		  $hra_16_det[$nro_ope] = $lin_sol['ord_cro_16_det']; 
		  $hra_17_det[$nro_ope] = $lin_sol['ord_cro_17_det']; 
		  $hra_18_det[$nro_ope] = $lin_sol['ord_cro_18_det'];
		  $hra_19_det[$nro_ope] = $lin_sol['ord_cro_ot_det']; 
		  
	}
		 if ($nro_ope == 7) {	
		  $hra_6_det[$nro_ope] = $lin_sol['ord_cro_6_det'];
		  $hra_7_det[$nro_ope] = $lin_sol['ord_cro_7_det'];
		  $hra_8_det[$nro_ope] = $lin_sol['ord_cro_8_det'];
		  $hra_9_det[$nro_ope] = $lin_sol['ord_cro_9_det'];	
		  $hra_10_det[$nro_ope] = $lin_sol['ord_cro_10_det'];
		  $hra_11_det[$nro_ope] = $lin_sol['ord_cro_11_det'];
		  $hra_12_det[$nro_ope] = $lin_sol['ord_cro_12_det'];
		  $hra_13_det[$nro_ope] = $lin_sol['ord_cro_13_det']; 
		  $hra_14_det[$nro_ope] = $lin_sol['ord_cro_14_det'];
		  $hra_15_det[$nro_ope] = $lin_sol['ord_cro_15_det'];
		  $hra_16_det[$nro_ope] = $lin_sol['ord_cro_16_det']; 
		  $hra_17_det[$nro_ope] = $lin_sol['ord_cro_17_det']; 
		  $hra_18_det[$nro_ope] = $lin_sol['ord_cro_18_det'];
		  $hra_19_det[$nro_ope] = $lin_sol['ord_cro_ot_det']; 
		  
		  
		  
	}


	
	}
	
	//echo "Fecha" .encadenar(2). $_SESSION['fec_nue']."--".$_SESSION['fecha'];
		?>
	 <br>
	 
	<form name="form2" method="post" action="solic_retro_sol.php" onSubmit="return ValidarRangoFechas(this)" >
	       <input type="submit" name="accion" value="Anterior"> 
		   <input type="submit" name="accion" value="Siguiente"> 
		   <input type="submit" name="accion" value="Hoy">
		   <?php if ($_SESSION['cargo'] <> 1){ ?>
	      <input type="submit" style="color:#FF0000" name="accion" value="G R A B A R">
		  <input type="submit"  style="color:#0000FF" name="accion" value="REFRESCAR"> 
		  <?php } ?> 
          <input type="submit" name="accion" value="Salir">
		   <strong>Ir a Fecha</strong>
         <input type="text" name="fec_has" maxlength="10"  size="10" > <script language="JavaScript">
            new tcal ({
                // form name
                'formname': 'form2',
                // input name
                'controlname': 'fec_has'
            });
            </script>	
             <input type="submit" style="color: #339933" name="accion" value="IR A FECHA">
    			
	<table border="1" width="800">
	<br>
	<font size="+2">
	
	 <?php
	 if ($_SESSION['cargo'] <> 1){
	     $min = copia_crono();
	 }
	 $dia_sem = dia_semana($dia, $mes, $anio);
	 //echo $dia." ".$mes." ".$anio;
	 echo "Fecha" .encadenar(2). $_SESSION['fec_nue'].encadenar(2).$dia_sem; 
	 //echo horac30();
	 ?>
	 </center>
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
	 $hora[14] = " Otra Hra.";
	 $ope[1] = 1;
	 $ope[2] = 2;
	 $ope[3] = 3;
	 $ope[4] =4;
	 $ope[5] =5;
	 $ope[6] =6;
	 $ope[7] =7;
	  for ($i=1; $i < 8; $i = $i + 1 ) { 
	    //   $hra_6_c[$i] = 0;
		//   $hra_7_c[$i] = 0;
		 //  $hra_8_c[$i] = 0;
	 
	 }
    ?>
	
		
	<tr>
		<th>HORA </th>
		<?php for ($i=1; $i < 8; $i = $i + 1 ) {
		
		$con_ope = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD = $i";
        $res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla')  ;
		while ($lin_ope = mysql_fetch_array($res_ope)) {
		  $nom_ope = $lin_ope['GRAL_PAR_PRO_DESC'];
		}
		
		 ?>
		<th><?php echo $nom_ope.encadenar(2)."(" ,$ope[$i], ") ";?>
		 
		</th>
		<?php } ?>		
	</tr>
	   <?php
	   for ($i=1; $i < 15; $i = $i + 1 ) { 
	           //   ?>
	
			<?php if($i == 1){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_6_det[1])){
			          $hra_6_det[1] = trim($hra_6_det[1]); ?>
					 
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_61"><?php echo  ltrim(htmlentities($hra_6_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_61"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
				
			<?php if (isset( $hra_6_det[2])){ ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_62"><?php echo  ltrim(htmlentities($hra_6_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
			  <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_62"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_6_det[3])){ ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_63"><?php echo  ltrim(htmlentities($hra_6_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_63"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_6_det[4])){ ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_64"><?php echo  ltrim(htmlentities($hra_6_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_64"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_6_det[5])){ ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_65"><?php echo  ltrim(htmlentities($hra_6_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_65"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
		    	<?php if (isset( $hra_6_det[6])){ ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_66"><?php echo ltrim(htmlentities($hra_6_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_66"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_6_det[7])){ ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_67"><?php echo ltrim(htmlentities($hra_6_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_67"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>			 		 
		    <?php }  ?>
		</tr>
			<?php if($i == 2){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_7_det[1])){ ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_71"><?php echo  ltrim(htmlentities($hra_7_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
       <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_71"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
				
			<?php if (isset( $hra_7_det[2])){ ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_72"><?php echo  ltrim(htmlentities($hra_7_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_72"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_7_det[3])){ ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_73"><?php echo  ltrim(htmlentities($hra_7_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_73"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_7_det[4])){ ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_74"><?php echo  ltrim(htmlentities($hra_7_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_74"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
		<?php if (isset( $hra_7_det[5])){ ?>	
        <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_75"><?php echo  ltrim(htmlentities($hra_7_det[5]));?></TEXTAREA></td>
		      <?php }else{  ?>
              <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_75"><?php echo  "";?></TEXTAREA></td>	
		<?php }  ?>	
		<?php if (isset( $hra_7_det[6])){ ?>	
        <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_76"><?php echo  ltrim(htmlentities($hra_7_det[6]));?></TEXTAREA></td>
		      <?php }else{  ?>
              <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_76"><?php echo  "";?></TEXTAREA></td>	
		<?php }  ?>	 
		<?php if (isset( $hra_7_det[7])){ ?>	
        <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_77"><?php echo  ltrim(htmlentities($hra_7_det[7]));?></TEXTAREA></td>
		      <?php }else{  ?>
              <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_77"><?php echo  "";?></TEXTAREA></td>	
		<?php }  ?>
		    <?php }  ?>
		</tr>					
			<?php if($i == 3){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_8_det[1])){ ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_81"><?php echo  ltrim(htmlentities($hra_8_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_81"><?php echo  "";?></TEXTAREA></td>	
		<?php }  ?>	
				
			<?php if (isset( $hra_8_det[2])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_82"><?php echo  ltrim(htmlentities($hra_8_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_82"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_8_det[3])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_83"><?php echo  ltrim(htmlentities($hra_8_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_83"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_8_det[4])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_84"><?php echo  ltrim(htmlentities($hra_8_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_84"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_8_det[5])){ ?>
        <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_85"><?php echo  ltrim(htmlentities($hra_8_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
			      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_85"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_8_det[6])){ ?>
        <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_86"><?php echo  ltrim(htmlentities($hra_8_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
			      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_86"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>		 
			<?php if (isset( $hra_8_det[7])){ ?>
        <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_87"><?php echo  ltrim(htmlentities($hra_8_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
	      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_87"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
		    <?php }  ?>
		</tr>					
			<?php if($i == 4){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_9_det[1])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_91"><?php echo  ltrim(htmlentities($hra_9_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_91"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
				
			<?php if (isset( $hra_9_det[2])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_92"><?php echo  ltrim(htmlentities($hra_9_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_92"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_9_det[3])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_93"><?php echo  ltrim(htmlentities($hra_9_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_93"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_9_det[4])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_94"><?php echo  ltrim(htmlentities($hra_9_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_94"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_9_det[5])){ ?>
         <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_95"><?php echo  ltrim(htmlentities($hra_9_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
			 <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_95"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>
			<?php if (isset( $hra_9_det[6])){ ?>
         <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_96"><?php echo  ltrim(htmlentities($hra_9_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
			   <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_96"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_9_det[7])){ ?>
         <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_97"><?php echo  ltrim(htmlentities($hra_9_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
		 <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_97"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>		 
		    <?php }  ?>
		</tr>					
			<?php if($i == 5){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_10_det[1])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_101"><?php echo  ltrim(htmlentities($hra_10_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_101"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
				
			<?php if (isset( $hra_10_det[2])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_102"><?php echo  ltrim(htmlentities($hra_10_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_102"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_10_det[3])){ ?>
			  <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_103"><?php echo  ltrim(htmlentities($hra_10_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_103"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_10_det[4])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_104"><?php echo  ltrim(htmlentities($hra_10_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_104"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_10_det[5])){ ?>
       <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_105"><?php echo  ltrim(htmlentities($hra_10_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
	          <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_105"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_10_det[6])){ ?>
       <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_106"><?php echo  ltrim(htmlentities($hra_10_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
	              <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_106"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	 
			<?php if (isset( $hra_10_det[7])){ ?>
       <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_107"><?php echo  ltrim(htmlentities($hra_10_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
	              <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_107"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>
		    <?php }  ?>
		</tr>					
			<?php if($i == 6){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_11_det[1])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_111"><?php echo  ltrim(htmlentities($hra_11_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_111"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
				
			<?php if (isset( $hra_11_det[2])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_112"><?php echo  ltrim(htmlentities($hra_11_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_111"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_11_det[3])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_113"><?php echo  ltrim(htmlentities($hra_11_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_113"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_11_det[4])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_114"><?php echo  ltrim(htmlentities($hra_11_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_114"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_11_det[5])){ ?>
       <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_115"><?php echo  ltrim(htmlentities($hra_11_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
	              <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_115"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_11_det[6])){ ?>
       <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_116"><?php echo  ltrim(htmlentities($hra_11_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
	              <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_116"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>
			<?php if (isset( $hra_11_det[7])){ ?>
       <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_117"><?php echo  ltrim(htmlentities($hra_11_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
	              <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_117"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>			 
		    <?php }  ?>
		</tr>					
		<?php if($i == 7){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_12_det[1])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_121"><?php echo  ltrim(htmlentities($hra_12_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_121"><?php echo  "";?></TEXTAREA></td>		
		<?php }  ?>	
				
			<?php if (isset( $hra_12_det[2])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_122"><?php echo  ltrim(htmlentities($hra_12_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_122"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_12_det[3])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_123"><?php echo  ltrim(htmlentities($hra_12_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_123"><?php echo  "";?></TEXTAREA></td>			<?php }  ?>	
			
			<?php if (isset( $hra_12_det[4])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_124"><?php echo  ltrim(htmlentities($hra_12_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_124"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_12_det[5])){ ?>
       <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_125"><?php echo  ltrim(htmlentities($hra_12_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
	       <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_125"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_12_det[6])){ ?>
       <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_126"><?php echo  ltrim(htmlentities($hra_12_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
	              <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_126"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_12_det[7])){ ?>
      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_127"><?php echo  ltrim(htmlentities($hra_12_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
	              <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_127"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?> 
			
		    <?php }  ?>
		</tr>					
			<?php if($i == 8){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_13_det[1])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_131"><?php echo  ltrim(htmlentities($hra_13_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_131"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
				
			<?php if (isset( $hra_13_det[2])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_132"><?php echo  ltrim(htmlentities($hra_13_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_132"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_13_det[3])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_133"><?php echo  ltrim(htmlentities($hra_13_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
			    <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_133"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_13_det[4])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_134"><?php echo  ltrim(htmlentities($hra_13_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_134"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_13_det[5])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_135"><?php echo  ltrim(htmlentities($hra_13_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
			      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_135"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_13_det[6])){ ?>
		          <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_136"><?php echo  ltrim(htmlentities($hra_13_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_136"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_13_det[7])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_136"><?php echo  ltrim(htmlentities($hra_13_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
			      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_137"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>		 
		    <?php }  ?>
		</tr>					
			
				<?php if($i == 9){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_14_det[1])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_141"><?php echo  ltrim(htmlentities($hra_14_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_141"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
				
			<?php if (isset( $hra_14_det[2])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_142"><?php echo  ltrim(htmlentities($hra_14_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_142"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_14_det[3])){ ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_143"><?php echo  ltrim(htmlentities($hra_14_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_143"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_14_det[4])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_144"><?php echo  ltrim(htmlentities($hra_14_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_144"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_14_det[5])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_145"><?php echo  ltrim(htmlentities($hra_14_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
	  <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_145"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_14_det[6])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_146"><?php echo  ltrim(htmlentities($hra_14_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
	              <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_146"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	 
			<?php if (isset( $hra_14_det[7])){ ?>
      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_147"><?php echo ltrim(htmlentities($hra_14_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
	              <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_147"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>
		    <?php }  ?>
		</tr>					
		 <?php if($i == 10){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_15_det[1])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_151"><?php echo  ltrim(htmlentities($hra_15_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_151"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
				
			<?php if (isset( $hra_15_det[2])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_152"><?php echo  ltrim(htmlentities($hra_15_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_152"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_15_det[3])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_153"><?php echo  ltrim(htmlentities($hra_15_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_153"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_15_det[4])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_154"><?php echo  ltrim(htmlentities($hra_15_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_154"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_15_det[5])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_155"><?php echo  ltrim(htmlentities($hra_15_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
       <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_155"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_15_det[6])){ ?>
      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_156"><?php echo ltrim(htmlentities($hra_15_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
	         <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_156"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>
			<?php if (isset( $hra_15_det[7])){ ?>
      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_157"><?php echo ltrim(htmlentities($hra_15_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
		     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_157"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	 
		    <?php }  ?>
		</tr>					
			<?php if($i == 11){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_16_det[1])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_161"><?php echo  ltrim(htmlentities($hra_16_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_161"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
				
			<?php if (isset( $hra_16_det[2])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_162"><?php echo  ltrim(htmlentities($hra_16_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
			 <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_162"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_16_det[3])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_163"><?php echo  ltrim(htmlentities($hra_16_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_163"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_16_det[4])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_164"><?php echo  ltrim(htmlentities($hra_16_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_164"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_16_det[5])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_165"><?php echo  ltrim(htmlentities($hra_16_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_165"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_16_det[6])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_166"><?php echo  ltrim(htmlentities($hra_16_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
	      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_166"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	 
			<?php if (isset( $hra_16_det[7])){ ?>
    <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_167"><?php echo  ltrim(htmlentities($hra_16_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
		      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_167"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>
		    <?php }  ?>
		</tr>					
			<?php if($i == 12){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_17_det[1])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_171"><?php echo  ltrim(htmlentities($hra_17_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_171"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
				
			<?php if (isset( $hra_17_det[2])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_172"><?php echo  ltrim(htmlentities($hra_17_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_172"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_17_det[3])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_173"><?php echo  ltrim(htmlentities($hra_17_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_173"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_17_det[4])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_174"><?php echo  ltrim(htmlentities($hra_17_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_174"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_17_det[5])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_175"><?php echo  ltrim(htmlentities($hra_17_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
			      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_175"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_17_det[6])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_176"><?php echo  ltrim(htmlentities($hra_17_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
			      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_176"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_17_det[7])){ ?>
    <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_177"><?php echo  ltrim(htmlentities($hra_17_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
			      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_177"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?> 
		    <?php }  ?>
		</tr>					
			<?php if($i == 13){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_18_det[1])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_181"><?php echo  ltrim(htmlentities($hra_18_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_181"><?php echo  "";?></TEXTAREA></td>	
		<?php }  ?>	
				
			<?php if (isset( $hra_18_det[2])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_182"><?php echo  ltrim(htmlentities($hra_18_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_182"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_18_det[3])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_183"><?php echo  ltrim(htmlentities($hra_18_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_183"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_18_det[4])){ ?>
	<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_184"><?php echo  ltrim(htmlentities($hra_18_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
			  <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_184"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_18_det[5])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_185"><?php echo  ltrim(htmlentities($hra_18_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
			      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_185"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_18_det[6])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_186"><?php echo  ltrim(htmlentities($hra_18_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
			      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_186"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	 
			<?php if (isset( $hra_18_det[7])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_187"><?php echo  ltrim(htmlentities($hra_18_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
			      <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_187"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>
		    <?php }  ?>
		</tr>	
		    <?php if($i == 14){ ?>
			 <tr>
	  	 	<th align="center"><?php echo  $hora[$i]; ?></td>
			      
			<?php if (isset( $hra_19_det[1])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_191"><?php echo  ltrim(htmlentities($hra_19_det[1]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_191"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
				
			<?php if (isset( $hra_19_det[2])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_192"><?php echo  ltrim(htmlentities($hra_19_det[2]));?></TEXTAREA></td>
		    <?php }else{  ?>
			<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_192"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_19_det[3])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_193"><?php echo  ltrim(htmlentities($hra_19_det[3]));?></TEXTAREA></td>
		    <?php }else{  ?>
		<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_193"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_19_det[4])){ ?>
<td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_194"><?php echo  ltrim(htmlentities($hra_19_det[4]));?></TEXTAREA></td>
		    <?php }else{  ?>
			 <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_194"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			
			<?php if (isset( $hra_19_det[5])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_195"><?php echo  ltrim(htmlentities($hra_19_det[5]));?></TEXTAREA></td>
		    <?php }else{  ?>
		          <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_195"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_19_det[6])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_196"><?php echo ltrim(htmlentities($hra_19_det[6]));?></TEXTAREA></td>
		    <?php }else{  ?>
		          <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_196"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>	
			<?php if (isset( $hra_19_det[7])){ ?>
     <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_197"><?php echo ltrim(htmlentities($hra_19_det[7]));?></TEXTAREA></td>
		    <?php }else{  ?>
		          <td ><TEXTAREA cols="20" rows="3" style="text-align: left " name="hra_197"><?php echo  "";?></TEXTAREA></td>
			<?php }  ?>		 
		    <?php }  ?>
		</tr>													
		<?php } 
//function suma_fechas($fecha,$ndias)
       
function sumaDia($fecha,$dia)
{list($day,$mon,$year) = explode('/',$fecha);
return date('d/m/Y',mktime(0,0,0,$mon,$day+$dia,$year));} 
		
function restaDia($fecha,$dia)
{list($day,$mon,$year) = explode('/',$fecha);
return date('d/m/Y',mktime(0,0,0,$mon,$day-$dia,$year));} 		
function horac30()
{		
$fecha = date('Y-m-j');
echo "FEcha actual".$fecha;
$nuevafecha = strtotime ( '+1 hour' , strtotime ( $fecha ) ) ;
$nuevafecha = strtotime ( '+13 minute' , strtotime ( $fecha ) ) ;
$nuevafecha = strtotime ( '+30 second' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

return $nuevafecha;		
}		
		
		
		
		?>
		
		<br>
		</tr>
   </table>
</center>
<strong>
</strong>	
<center>

</form>	
<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Cronograma Diario</MARQUEE></FONT></B>
</div>
   <?php
		 	include("footer_in.php");
	 ?> 
<?php
ob_end_flush();
 ?>