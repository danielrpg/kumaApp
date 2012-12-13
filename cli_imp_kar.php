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
	    <a href='menu_s.php'>Salir</a>
  </div>

<br><br>
<?php
$cod_cli = 0;
//echo " aqui",$_SESSION['cod_cli2'],$_SESSION['consul'];
if(isset($_POST['cod_cliente'])){ 
   $cod_cli = $_POST['cod_cliente'];
  // for( $i=0; $i < count($quecom); $i = $i + 1 ) {
     // if( isset($quecom[$i]) ) {
      //   $cod_cli = $quecom[$i];
		 $_SESSION['cod_cli'] =  $cod_cli;
       //  }
     // }
	}else{
         $cod_cli = $_SESSION['cod_cli']; 
}
//if ($_SESSION['consul'] == 1){
 //  $cod_cli = $_SESSION['cod_cli2']; 
//   }

?> 
<font size="+2"  style="" >
<?php
echo encadenar(35)."KARDEX DE SERVICIOS CLIENTE";
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(60)."COD. CLIENTE ".encadenar(3).$cod_cli;
?>
</font>
<br>
<?php
$con_cli = "Select * From cliente_general where CLIENTE_COD = $cod_cli and CLIENTE_USR_BAJA is null";
$res_cli = mysql_query($con_cli)or die('No pudo seleccionarse tabla cliente_general')  ;
while ($linea = mysql_fetch_array($res_cli)){

/*$cod_barr1 = $linea['CLIENTE_COD_BARR'];
$con_bar1  = "Select * From gral_barrios where gral_barr_codigo = $cod_barr1";
$res_bar1= mysql_query($con_bar1)or die('No pudo seleccionarse tabla 2')  ;
 while ($lin_barr = mysql_fetch_array($res_bar1)) {
       $_SESSION['barrio'] =  $lin_barr['gral_barr_nombre']; 
	   $_SESSION['det_barr'] = $lin_barr['gral_barr_detalles'];
	  } 
*/
$tip_cli = $linea['CLIENTE_TIP_PER'];
$con_tper  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 22 and GRAL_PAR_PRO_COD =  $tip_cli ";
$res_tper = mysql_query($con_tper)or die('No pudo seleccionarse tabla 2')  ;
while ($lin_tper = mysql_fetch_array($res_tper)) {
    $tper_r =  $lin_tper['GRAL_PAR_PRO_DESC']; 
 } 
$_SESSION['barrio'] = $linea['CLIENTE_ZONA'];
$_SESSION['cod_cli']= $linea['CLIENTE_COD'];
$_SESSION['tip_doc']= $linea['CLIENTE_TIP_ID'];
$_SESSION['nom_com']=$linea['CLIENTE_NOMBRES'].encadenar(2).$linea['CLIENTE_AP_PATERNO'].
                     encadenar(2).$linea['CLIENTE_AP_MATERNO'].encadenar(2).
					 $linea['CLIENTE_AP_ESPOSO'];
					 
$_SESSION['direc']=$linea['CLIENTE_DIRECCION'];
$_SESSION['ci'] = $linea['CLIENTE_COD_ID'];
$_SESSION['fono'] = $linea['CLIENTE_FONO'];
$_SESSION['celu'] = $linea['CLIENTE_CELULAR'];
}
?>
<center>
 <table width="90%"  border="2" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="8%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>CODIGO</th>
 <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>TIPO CLIENTE</th>
	  <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>CLIENTE</th>
      <th width="8%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>TEL. FIJO</th>
      <th width="8%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />TEL.CELULAR</th>
	 
		 
	  </tr>
	  
	  	<td style="top:auto" style="font-size:12px"><?php echo $_SESSION['cod_cli']; ?></td>
		<td style="top:auto" style="font-size:12px"><?php echo $tper_r; ?></td>
		<td style="text-align:justify" style="font-size:12px" ><?php echo $_SESSION['nom_com']; ?></td>
        <td style="top:auto" style="font-size:12px"><?php echo $_SESSION['fono']; ?></td>
        <td style="top:auto" style="font-size:12px"><?php echo $_SESSION['celu'];  ?></td>
		
					
</table>
<table width="90%"  border="2" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />BARRIO</th> 
	  <th width="45%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />DIRECCION</th>
		 
	  </tr>
	  
	  	
		<td style="top:auto" style="font-size:12px"><?php echo $_SESSION['barrio'];  ?></td>
		<td style="text-align:justify" style="font-size:11px"> <?php echo $_SESSION['direc'];  ?></td>
					
</table>

	 <table border="1" width="900">
	<tr>
		<th align="center">NRO. ORDEN</th> 
	    <th align="center">FEC. TRANS.</th>
		<th align="center">OPERA</th> 
	   	<th align="center">SERVICIOS</th>           
	    <th align="center">VOLUMEN</th>
		<th align="center">IMPORTE TOTAL</th>
		<th align="center">COMENTARIOS</th>
		
		
		
  </tr>		
		  
<?php
$con_sera = "Select * From ord_maestro where ORD_COD_CLI = $cod_cli
            and ORD_MAE_USR_BAJA is null ORDER BY ORD_FEC_SOL DESC";
$res_sera= mysql_query($con_sera)or die('No pudo seleccionarse tabla ord_maestro');
  while ($lin_sera = mysql_fetch_array($res_sera)){
         $nroord = $lin_sera['ORD_NUMERO'];
		 $fech_sera = cambiaf_a_normal($lin_sera['ORD_FEC_SOL']);
		 $ope = $lin_sera['ORD_OPE_RESP'];
		 $operador = "";
	if (($ope <> 0) or ($ope <> "")){
		 $con_ope = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD = $ope";
        $res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla')  ;
		while ($lin_ope = mysql_fetch_array($res_ope)) {
		  $operador = $lin_ope['GRAL_PAR_PRO_DESC'];
		}
	}	 
		 
	 	 $con_serv = "Select * From ord_detalle  where ORD_DET_ORD = $nroord 
		              and ORD_DET_USR_BAJA is null";
	     $servicios = "";
	     $com = "";
	     $impo_sera = 0;
		 $volt = 0;
		 				  
         $res_serv= mysql_query($con_serv)or die('No pudo seleccionarse tabla ord_detalle');
		  while ($lin_serv = mysql_fetch_array($res_serv)){
	             $cod_serv = $lin_serv['ORD_DET_GRP'];
		         $comen = $lin_serv['ORD_DET_COMEN'];
		         $impo = $lin_serv['ORD_DET_MONTO'];
				 $volt = $volt + $lin_serv['ORD_DET_VOLT'];
				 
		         $servicios = $servicios.encadenar(2).$cod_serv;
		         $com = $com.encadenar(1).$comen;
		         $impo_sera = $impo_sera + $impo;
		      }
			  ?>
			 <tr>
	    <td align="left" ><?php echo $nroord; ?></td>
		<td align="left" ><?php echo $fech_sera; ?></td>
		<td align="left"  style="font-size:9px""><?php echo $operador; ?></td>
		<td align="right" ><?php echo $servicios; ?></td>							
	    <td align="right" ><?php echo $volt; ?></td>
	 	<td align="right" ><?php echo number_format($impo_sera, 2, '.',','); ?></td>
		<td align="left" ><?php echo $com; ?></td>	
		
	</tr>	 
<?php			  
			  
			  
			  
			  	  
	}

	 ?>
	</table>	
	
<?php
		 	include("footer_in.php");
		 ?>

</div>
</body>
</html>



<?php
ob_end_flush();
 ?>

