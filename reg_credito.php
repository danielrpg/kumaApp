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
<title>Registro de Credito</title>
</head>
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
                 $logi = $_SESSION['login']; 
                ?> 
			</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">	 
               Registro de Credito
</div>
<div id="AtrasBoton">
    <a href="menu_s.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
</center>
<?php
/*if(isset($_POST['cod_ord'])){ 
   $quecom = $_POST['cod_ord'];
   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
      if( isset($quecom[$i]) ) {
         $cod_ord = $quecom[$i];
		 $_SESSION['cod_ord'] =  $cod_ord;
         }
      }
	}else{
         $cod_ord = $_SESSION['cod_ord']; 
}
echo encadenar(85)."Orden Nro.".encadenar(2).$_SESSION['cod_ord'];
$con_cli = "Select * From ord_maestro, cliente_general  where ORD_NUMERO = $cod_ord  and CLIENTE_COD = ORD_COD_CLI
	             and ORD_MAE_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
        $res_deu= mysql_query($con_cli)or die('No pudo seleccionarse tabla deudores');
   	    while ($linea = mysql_fetch_array($res_deu)){
  	         
			  $_SESSION['cod_cli']= $linea['CLIENTE_COD'];
$_SESSION['tip_doc']= $linea['CLIENTE_TIP_ID'];
$_SESSION['nom_com']=$linea['CLIENTE_NOMBRES'].encadenar(2).$linea['CLIENTE_AP_PATERNO'].
                     encadenar(2).$linea['CLIENTE_AP_MATERNO'].encadenar(2).
					 $linea['CLIENTE_AP_ESPOSO'];
					 
$_SESSION['direc']=$linea['CLIENTE_DIRECCION'];
$_SESSION['ci'] = $linea['CLIENTE_COD_ID'];
$_SESSION['fono'] = $linea['CLIENTE_FONO'];
$_SESSION['celu'] = $linea['CLIENTE_CELULAR'];
$_SESSION['fpag'] = $linea['ORD_FORM_PAG'];
$_SESSION['cope'] = $linea['ORD_OPE_RESP'];
$_SESSION['q_sol'] = $linea['ORD_QUIEN_SOL'];
$_SESSION['n_fac'] = $linea['ORD_NOM_FAC'];
$_SESSION['nit_f'] = $linea['ORD_NIT_FAC'];
$fec_u = $linea['ORD_FEC_SOL'];
$_SESSION['descuento'] = $linea['ORD_IMP_DES'];
$_SESSION['monto'] = 0;
$f_ord = $linea['ORD_FEC_SOL'];
//$_SESSION['f_ord'] = cambiaf_a_normal_2($f_ord);
$f_ini = $linea['ORD_FEC_INI'];
//$_SESSION['f_ini'] = cambiaf_a_normal_2($f_ini);
$_SESSION['h_ini'] = $linea['ORD_HR_INI'];
$_SESSION['h_fin'] = $linea['ORD_HR_FIN'];
$f_pag = $linea['ORD_FORM_PAG'];
$con_fpa1  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 600 and GRAL_PAR_PRO_COD = $f_pag";
$res_fpa1 = mysql_query($con_fpa1)or die('No pudo seleccionarse tabla 2');
while ($lin_fpa1 = mysql_fetch_array($res_fpa1)) {
      $_SESSION['for_pag'] = $lin_fpa1['GRAL_PAR_PRO_DESC'];
}
$c_opera = $linea['ORD_OPE_RESP'];
$con_ope1  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD =$c_opera";
$res_ope1 = mysql_query($con_ope1)or die('No pudo seleccionarse tabla');
while ($linope1 = mysql_fetch_array($res_ope1)) {
    $_SESSION['nom_ope'] = $linope1['GRAL_PAR_PRO_DESC'];
}
$cod_barr1 = $linea['CLIENTE_COD_BARR'];
$con_bar1  = "Select * From gral_barrios where gral_barr_codigo = $cod_barr1";
$res_bar1= mysql_query($con_bar1)or die('No pudo seleccionarse tabla 2')  ;
 while ($lin_barr = mysql_fetch_array($res_bar1)) {
    $_SESSION['barrio'] =  $lin_barr['gral_barr_nombre']; 
	$_SESSION['det_barr'] = $lin_barr['gral_barr_detalles'];
 } 
//Monto total
$con_det  = "Select sum(ORD_DET_MONTO) From ord_detalle where ORD_DET_ORD = $cod_ord and ORD_DET_USR_BAJA is null";
$res_det= mysql_query($con_det)or die('No pudo seleccionarse tabla 2')  ;
          while ($lin_det = mysql_fetch_array($res_det)){
               $_SESSION['monto'] = $lin_det['sum(ORD_DET_MONTO)'];
			   
          }

//if(isset($_SESSION["continuar"])){
//     if($_SESSION["continuar"] == 1){
?>

 <center>
 <table width="90%"  border="2" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="8%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>CODIGO</th>
	  <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>CLIENTE</th>
      <th width="8%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>TEL. FIJO</th>
      <th width="8%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />TEL.CELULAR</th>
	 
		 
	  </tr>
	  
	  	<td bgcolor="#66CCFF" style="top:auto" style="font-size:12px"><?php echo $_SESSION['cod_cli'];?></td>
		<td bgcolor="#66CCFF" style="text-align:justify" style="font-size:12px"> <?php echo $_SESSION['nom_com'];?></td>
        <td bgcolor="#66CCFF" style="top:auto" style="font-size:12px"><?php echo $_SESSION['fono']; ?> </td>
        <td bgcolor="#66CCFF" style="top:auto" style="font-size:12px"> <?php echo $_SESSION['celu']; ?></td>
		
					
</table>
<table width="90%"  border="2" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />BARRIO</th> 
	  <th width="35%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />DET. BARRIO</th> 
	  <th width="45%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />DIRECCION</th>
		 
	  </tr>
	  <td bgcolor="#66CCFF" style="top:auto" style="font-size:12px"> <?php echo $_SESSION['barrio'];?></td>
	  <td bgcolor="#66CCFF" style="text-align:justify" style="font-size:12px"><?php echo $_SESSION['det_barr'];?></td>
	  <td bgcolor="#66CCFF" style="text-align:justify" style="font-size:12px"> <?php echo $_SESSION['direc'];?></td>
					
</table>


<?php 
 //Servicios anteriores
 $cod_cli = $_SESSION['cod_cli'];
$con_sera = "Select * From ord_maestro where ORD_COD_CLI = $cod_cli and ORD_FEC_SOL < '$fec_u'
            and ORD_MAE_USR_BAJA is null ORDER BY ORD_FEC_SOL
			DESC LIMIT 0,1 ";
$res_sera= mysql_query($con_sera)or die('No pudo seleccionarse tabla ord_maestro');
  while ($lin_sera = mysql_fetch_array($res_sera)){
         $nroord = $lin_sera['ORD_NUMERO'];
		 $fech_sera = cambiaf_a_normal($lin_sera['ORD_FEC_SOL']);
		       
       //  echo $lin_sera	['ORD_NUMERO'].encadenar(2). 
       //       $lin_sera	['ORD_FEC_SOL'].encadenar(2).
	//		  $lin_sera	['ORD_IMPORTE'];
		$con_serv = "Select * From ord_detalle
		              where ORD_DET_ORD = $nroord 
		              and  ORD_DET_USR_BAJA is null";
	$servicios = "";
	$com = "";
	$impo_sera = 0;				  
          $res_serv= mysql_query($con_serv)or die('No pudo seleccionarse tabla ord_detalle');			  while ($lin_serv = mysql_fetch_array($res_serv)){
	      $cod_serv = $lin_serv['ORD_DET_GRP'];
		  $comen = $lin_serv['ORD_DET_COMEN'];
		  $impo = $lin_serv['ORD_DET_MONTO'];
		  $servicios = $servicios.encadenar(2).$cod_serv;
		  $com = $com.encadenar(1).$comen;
		  $impo_sera = $impo_sera + $impo;
		   }	  
	}
if (isset($_SESSION['fech_sera'])){	
$_SESSION['fech_sera']=$fech_sera;	
$_SESSION['servicios']=$servicios;
$_SESSION['impo_sera']=$impo_sera;	
$_SESSION['com']=$com;	
echo "Ultimo Servicio Anterior";
?>
</table>
<table width="90%"  border="2" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />Nro Orden</th> 
	  <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />Fecha</th> 
	  <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />Servicio</th>
<th width="20%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />Importe</th>
<th width="45%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />Comentario</th>	  
		 
	  </tr>
	  
	  	
	<td bgcolor="#66CCFF" style="top:auto" style="font-size:12px" ><?php echo $nroord;  ?></td>
	<td bgcolor="#66CCFF" style="text-align:justify" style="font-size:12px"><?php echo  $fech_sera;?></td>
	<td bgcolor="#66CCFF" style="text-align:justify" style="font-size:11px"> <?php echo $servicios;  ?></td>
    <td bgcolor="#66CCFF" style="top:auto" style="font-size:12px"><?php echo number_format($impo_sera, 2, '.',',');  ?></td>
    <td bgcolor="#66CCFF" style="text-align:justify" style="font-size:11px"> <?php echo $com;  ?></td>					
</table>

<?php

}
//}
//}
*/
$con_tse  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD <> 0 order by 2 ";
$res_tse = mysql_query($con_tse)or die('No pudo seleccionarse tabla 1');

$con_ope  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD <> 0
             order by GRAL_PAR_PRO_COD";
$res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla');
$con_fpa  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 600 and GRAL_PAR_PRO_COD <> 0 ";
$res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 2');
 ?>
 <strong>
 <?php
//$_SESSION["detalle"] =1; 
// if(isset($_SESSION["continuar"])){
 //if($_SESSION["continuar"] == 1){
  // if ($_SESSION['tip_comp'] == 2){
 ?> 
 </font>
  </strong>
  
 <form name="form2" method="post" action="solic_retro_sol.php" onSubmit="return">
 <table width="80%" align="center" border="1">
            
            <tr>
 		      <th align="left">Cliente</th>
              <td><input type="text" name="clie" maxlength="60" size="35" 
			       value = ""></td>
			  <th align="left">Servicios</th>
              <td><input type="text" name="serv" maxlength="15" size="15" 
			      value = "" ></td>
           </tr>
		    <tr>
 		      <th align="left">Factura a nombre de</th>
              <td><input type="text" name="fac_a" maxlength="35" size="35" 
			       value = ""></td>
			  <th align="left">Nit Nº</th>
              <td><input type="text" name="nit" maxlength="15" size="15" 
			      value = "" ></td>
           </tr> 
           <tr>
              <th align="left">Fecha Factura</th>
              <td><input type="text" name="fec_des" maxlength="10"  size="10" > <script language="JavaScript">
                  new tcal ({
                  // form name
                  'formname': 'form2',
                  // input name
                  'controlname': 'fec_des'
                  });
                  </script>
	          </td>
	          <th align="left">Nro. Orden Fac.</th>
              <td><input type="text" name="nro_ord" maxlength="20"  size="20" value = ""> </td>
            </tr>
			
			 <tr>
              <th align="left">Nro. Factura</th>
              <td><input type="text" name="nro_fac" maxlength="20"  size="20" value = ""> </td>
			  <th align="left">Orden Servicio</th>
              <td><input type="text" name="orden" maxlength="20"  size="20" value = ""> </td> 
			 </tr>
			  <tr>
              <th align="left"><strong><?php echo "Fecha Servicio";?> </strong> </td>
			  <td><input type="text" name="fec_serv" maxlength="10"  size="10" > <script language="JavaScript">
                  new tcal ({
                  // form name
                  'formname': 'form2',
                  // input name
                  'controlname': 'fec_serv'
                  });
                  </script>
	          </td>
			  <th align="left"><strong><?php echo "Fecha Cobro";?> </strong> </td>
			  <td><input type="text" name="fec_uno" maxlength="10"  size="10" > <script language="JavaScript">
                  new tcal ({
                  // form name
                  'formname': 'form2',
                  // input name
                  'controlname': 'fec_uno'
                  });
                  </script>
	          </td>
			  <tr>
              <th align="left"><strong><?php echo "Monto";?> </strong> </td>
			  <td><input type="text" name="monto" maxlength="20"  size="20" value = ""> </td>
			   <th align="left">Operador</th>
			  <td align="left"><select name="cod_ope" size="1"  >
			  <?php while ($linope = mysql_fetch_array($res_ope)) { ?>
             <option value=<?php echo $linope['GRAL_PAR_PRO_COD']; ?>>
			 <?php echo $linope['GRAL_PAR_PRO_COD'].encadenar(2).$linope['GRAL_PAR_PRO_DESC']; ?> </option>
	  	     <?php } ?> 
            </select></td> 
			 </tr>
		  
		 </table>
	
  	<center>
	<input type="submit" name="accion" value="Graba-Credito">
    <input type="submit" name="accion" value="Salir">
</form>

 <?php // } 
 
 // }
//  }
 if($_SESSION["continuar"] == 2){
  // echo "Aqui";
     if(isset($_POST["clie"])){
      $clie = strtoupper($_POST["clie"]); 
	  $_SESSION['clie'] = $clie;
     //echo $fac_a;
	  } 
	  if(isset($_POST["serv"])){
      $serv = strtoupper($_POST["serv"]); 
	  $_SESSION['serv'] = $serv;
     //echo $fac_a;
	  } 
	  
  	 if(isset($_POST["fac_a"])){
      $fac_a= strtoupper($_POST["fac_a"]); 
	  $_SESSION['fac_a'] = $fac_a;
     //echo $fac_a;
	  }  
	  if(isset($_POST["nit"])){
         $nit= strtoupper($_POST["nit"]); 
	     $_SESSION['nit'] = $nit;
    //  echo $sol_por;
	   }  
	  if(isset($_POST["fec_des"])){
         $fec_ord = $_POST["fec_des"]; 
	     $_SESSION['fec_ord'] = $fec_ord;
	     $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }  
	 if(isset($_POST["fec_uno"])){
       $fec_ini = $_POST["fec_uno"]; 
	   $_SESSION['fec_ini'] = $fec_ini;
	   $fec_pag = cambiaf_a_mysql($fec_ini);
     // echo $fec_ord;
	  } 
	   if(isset($_POST["fec_serv"])){
       $fec_serv = $_POST["fec_serv"]; 
	   $_SESSION['fec_serv'] = $fec_serv;
	   $fec_serv = cambiaf_a_mysql($fec_serv);
     // echo $fec_ord;
	  }   
	if(isset($_POST["nro_ord"])){
      $nro_ord = $_POST["nro_ord"]; 
	  $_SESSION['nro_ord'] = $nro_ord;
      //echo $hra_ini;
	  } 
	 if(isset($_POST["orden"])){
      $orden = $_POST["orden"]; 
	  $_SESSION['orden'] = $orden;
      //echo $hra_ini;
	  }  
	if(isset($_POST["nro_fac"])){
      $nro_fac = $_POST["nro_fac"]; 
	  $_SESSION['nro_fac'] = $nro_fac;
   //   echo $hra_fin;
	  }else{
	   $nro_fac = 0;
	  }
	if(isset($_POST["monto"])){
      $monto = $_POST["monto"]; 
	  $_SESSION['monto'] = $monto;
   //   echo $hra_fin;
	  }
if(isset($_POST["cod_ope"])){	  
	$oper = $_POST["cod_ope"];  
	//$cod_ord = $_SESSION['cod_ord'];
}	
	$nro_tran = leer_nro_co_cred();
if ($nro_fac > 0){	
	$consulta = "insert into factura(FACTURA_AGEN, 
                                     FACTURA_TALON,
									 FACTURA_ORDEN,
									 FACTURA_ALFA,
									 FACTURA_LLAVE,
					                 FACTURA_NUMERICO,
					                 FACTURA_ENLACE,
   				                     FACTURA_NOMBRE,
					                 FACTURA_NIT, 
									 FACTURA_MONTO, 
									 FACTURA_ESTADO, 
									 FACTURA_FECHA,
									 FACTURA_FEC_H,
                                     FACTURA_COD_CTRL,
                                     FACTURA_USR_ALTA,
									 FACTURA_FCH_HR_ALTA,
									 FACTURA_USR_BAJA,
                                     FACTURA_FCH_HR_BAJA
									 ) values (30,
									           null,
											   $nro_ord,
											   null,
											   null,
											   $nro_fac,
											   0,
											   '$fac_a',
											   $nit,
 											   $monto,
											   1,
											   '$fec_fac',
											   '$fec_pag',
											   null,
											   '$logi',
											    null,
											    null,
											    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar factura : ' . mysql_error());  
}
$consulta = "insert into ord_credito(ord_cre_nro, 
                                     ord_cre_fserv,
									 ord_cre_fcob,
									 ord_cre_impo,
									 ord_cre_clie,
									 ord_cre_nord,
					                 ord_cre_serv,
					                 ord_cre_ope,
   				                     ord_cre_stat,
					                 ord_cre_usr_alta, 
									 ord_cre_fch_hr_alta, 
									 ord_cre_usr_baja, 
									 ord_cre_fch_hr_baja
									  ) values ($nro_tran,
									           '$fec_serv',
											   '$fec_pag',
											    $monto,
												'$clie',
											    $orden,
											    '$serv',
											    $oper,
											    1,
											   '$logi',
											    null,
											    null,
											    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_credito : ' . mysql_error());  

 $con_iope = "insert into ope_trans(ope_tra_cod, 
	                                      ope_tra_ingegr,
	                                      ope_tra_fec,
                                          ope_tra_tipo,
										  ope_tra_cgas,
									      ope_tra_orden,
										  ope_tra_mon,
									      ope_tra_impo,
									      ope_tra_usr_alta,
					                      ope_tra_fec_hr_alta,
					                      ope_tra_usr_baja,
										  ope_tra_fec_hr_baja
   				                          ) values ($oper,
										            $nro_tran,
									                '$fec_serv',
									                3,
													120,
												    $orden,
													1,
												    $monto,
												   '$logi',
												    null,
												    null,
												   '0000-00-00 00:00:00')";
$res_iope = mysql_query($con_iope)or die('No pudo insertar ope_trans  1: ' . mysql_error()); 




/*	  
 */
header('Location: solic_mante.php');	 
          }
	  
		  
		 
//Servicios variables

 /*if ($_SESSION['tip_comp'] == 1){
 //   $con_serv = "Select * From ord_detalle
//		              where ORD_DET_ORD = $cod_ord 
//		              and (ORD_DET_GRP = 803 or ORD_DET_GRP > 805)
//					  and  ORD_DET_USR_BAJA is null";
 //         $res_serv= mysql_query($con_serv)or die('No pudo seleccionarse tabla ord_detalle');
    
	 
	      //echo $cod_serv;
	 
 
 
 ?> 
 </font>
  </strong>
  
 <form name="form2" method="post" action="solic_retro_sol.php" onSubmit="return ValidarCamposOrden(this)">
 <table width="80%" align="center" border="1"> 
 <tr>
 		      <th align="left">Descuento</th>
              <td><input type="text" name="desc" maxlength="20" size="20" 
			       value = " <?php echo $_SESSION['descuento'] ; ?>"></td>
			  <th align="left"><?php echo encadenar(2); ?></th>
              <th align="left"><?php echo encadenar(2); ?></th>
           </tr> 
 <tr>
 		      <th align="left">Hora Inicio</th>
              <td><input type="text" name="h_ini" maxlength="20" size="20" 
			       value = " <?php echo $_SESSION['h_ini']; ?>"></td>
			  <th align="left">Hora Fin</th>
              <td><input type="text" name="h_fin" maxlength="20" size="20" 
			      value = "<?php echo $_SESSION['h_fin']; ?>" ></td>
           </tr> 
     
  <?php
      
  
 ?> 
 </table> 
   <?php
  while ($lin_serv = mysql_fetch_array($res_serv)){
	      $cod_serv = $lin_serv['ORD_DET_GRP'];
		  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = $cod_serv
				        and GRAL_PAR_PRO_COD = 0 order by 2";
          $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ;
		  while ($lin_tser = mysql_fetch_array($res_tser)) {
	             $desc1 = $lin_tser['GRAL_PAR_PRO_DESC'];
	 if ($cod_serv == 803){
       echo $cod_serv.encadenar(2).$desc1;   ?> 
	      <table width="80%" align="center" border="1">     
		    <tr>
 		      <th align="left">Total Volumen Mt3</th>
              <td><input type="text" name="t_vol" maxlength="20" size="20" 
			       value = ""></td>
			  <th align="left">Volumen Succionado Mt3</th>
              <td><input type="text" name="s_vol" maxlength="20" size="20" 
			      value = "" ></td>
			  <th align="left">Nro. Viajes</th>
              <td><input type="text" name="n_via" maxlength="5" size="5" 
			      value = "1" ></td>
           </tr> 
		  </table>
		   <table width="80%" align="center" border="1">   
           <tr>
              <th align="left">Monto</th>
              <td><input type="text" name="mon_803" maxlength="20"  size="20" value = ""> </td>
            </tr>
			<tr>
              <th align="left">Comentario</th>
              <td><input type="text" name="com_803" maxlength="70"  size="70" value = ""> </td>
            </tr>
			</table>
	<?php  } ?>
	<?php if ($cod_serv == 806){
	     echo $cod_serv.encadenar(2).$desc1;  ?> 
		 <br> 
		   <table width="80%" align="center" border="1">     
		    <tr>
 		      <th align="left">Capacidad en Litros</th>
              <td><input type="text" name="t_806" maxlength="20" size="20" 
			       value = ""></td>
			 </tr> 
           <tr>
              <th align="left">Monto</th>
              <td><input type="text" name="mon_806" maxlength="20"  size="20" value = ""> </td>
            </tr>
			<tr>
              <th align="left">Comentario</th>
              <td><input type="text" name="com_806" maxlength="70"  size="70" value = ""> </td>
            </tr>
			</table>
	<?php  } ?>
	<?php if ($cod_serv == 825){
	
	         $con_ope = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 150 and GRAL_PAR_PRO_COD <> 0";
             $res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla')  ;
	
	         echo $cod_serv.encadenar(2).$desc1; ?>  
		     <br> 
		  <table width="80%" align="center" border="1">
			   <tr>
              <th align="left">Tipo Succion</th>
			  <td align="left"><select name="cod_ope" size="1"  >
			  <?php while ($linope = mysql_fetch_array($res_ope)) { ?>
             <option value=<?php echo $linope['GRAL_PAR_PRO_COD']; ?>>
			 <?php echo $linope['GRAL_PAR_PRO_COD'].encadenar(2).$linope['GRAL_PAR_PRO_DESC']; ?> </option>
	  	     <?php } ?> 
            </select></td>
		   	  <th align="left">Nro. Camaras</th>
              <td><input type="text" name="c_825" maxlength="20" size="20" 
			      value = "1" ></td>
			</tr>
			</table>
			<table width="80%" align="center" border="1">
           <tr>
              <th align="left">Monto</th>
              <td><input type="text" name="mon_825" maxlength="20"  size="20" value = ""> </td>
            </tr>
			<tr>
              <th align="left">Comentario</th>
              <td><input type="text" name="com_825" maxlength="70"  size="70" value = ""> </td>
            </tr>
			</table>
	<?php  } } ?>
	
	<?php $con_tse  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 826
				        and GRAL_PAR_PRO_COD = 0 order by 2";
          $res_tse = mysql_query($con_tse)or die('No pudo seleccionarse tabla 2')  ;
		  while ($lin_tse = mysql_fetch_array($res_tse)) {
	             $desc1 = $lin_tse['GRAL_PAR_PRO_DESC'];
				 }
	 echo "826".encadenar(2).$desc1;  ?> 
		    <br>
			 <table width="80%" align="center" border="1">      
		    <tr>
 		      <th align="left">Servicio Adicional</th>
              <td><input type="text" name="t_826" maxlength="30" size="30" 
			       value = ""></td>
			 </tr> 
			 <tr>
              <th align="left">Monto</th>
              <td><input type="text" name="mon_826" maxlength="20"  size="20" value = ""> </td>
            </tr>
			<tr>
              <th align="left">Comentario</th>
              <td><input type="text" name="com_826" maxlength="70"  size="70" value = ""> </td>
            </tr>
	
	</table>
	
  	<center>
	<input type="submit" name="accion" value="Graba-Complemento">
    <input type="submit" name="accion" value="Salir">
</form>

 <?php  
 } }
 if($_SESSION["continuar"] == 3){
    $cod_ord = $_SESSION['cod_ord'];
	$h_ini = $_POST["h_ini"];
	$h_fin = $_POST["h_fin"];
	$desc = $_POST["desc"];
	
   // 803
  if(isset($_POST["t_vol"])){
      $t_vol= $_POST["t_vol"]; 
	  $_SESSION['t_vol'] = $t_vol;
     //echo $fac_a;
	    
	  if(isset($_POST["s_vol"])){
         $s_vol= $_POST["s_vol"]; 
	     $_SESSION['s_vol'] = $s_vol;
    //  echo $sol_por;
	   }  
	  if(isset($_POST["mon_803"])){
         $mon_803 = $_POST["mon_803"]; 
	     $_SESSION['mon_803'] = $mon_803;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }  
	 if(isset($_POST["com_803"])){
         $com_803 = strtoupper($_POST["com_803"]); 
	     $_SESSION['com_803'] = $com_803;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }    
	if(isset($_POST["n_via"])){
         $n_via = strtoupper($_POST["n_via"]); 
	     $_SESSION['n_via'] = $n_via;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }    
	
	
	$consulta = "update ord_detalle set ORD_DET_VOLT = $t_vol,
	                                    ORD_DET_VOLP = $s_vol,
										ORD_DET_MONTO = $mon_803,
										ORD_DET_COMEN = '$com_803',
										ORD_DET_CANT = $n_via
										where ORD_DET_ORD = $cod_ord 
										  and ORD_DET_GRP = 803"; 
$resultado = mysql_query($consulta)or die('No pudo actualizar ord_detalle 803 : ' . mysql_error()); 
    
}
//806
if(isset($_POST["t_806"])){
      $t_806= $_POST["t_806"]; 
	  $_SESSION['t_806'] = $t_806;
     //echo $fac_a;
	    
	  if(isset($_POST["mon_806"])){
         $mon_803 = $_POST["mon_806"]; 
	     $_SESSION['mon_806'] = $mon_806;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }  
	 if(isset($_POST["com_806"])){
         $com_806 = strtoupper($_POST["com_806"]); 
	     $_SESSION['com_806'] = com_806;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }    
//	$cod_ord = $_SESSION['cod_ord'];
	$consulta = "update ord_detalle set ORD_DET_VOLT = $t_806,
	                                    ORD_DET_MONTO = $mon_806,
										ORD_DET_COMEN = '$com_806'
										where ORD_DET_ORD = $cod_ord 
										  and ORD_DET_GRP = 806"; 
$resultado = mysql_query($consulta)or die('No pudo actualizar ord_detalle 806 : ' . mysql_error()); 
}
//825
if(isset($_POST["cod_ope"])){
      $t_825= $_POST["cod_ope"]; 
	  $_SESSION['cod_ope'] = $t_825;
     //echo $fac_a;
	    
	  if(isset($_POST["mon_825"])){
         $mon_825 = $_POST["mon_825"]; 
	     $_SESSION['mon_825'] = $mon_825;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }  
	 if(isset($_POST["com_825"])){
         $com_825= strtoupper($_POST["com_825"]); 
	     $_SESSION['com_825'] = $com_825;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }  
	   if(isset($_POST["c_825"])){
         $c_825= $_POST["c_825"]; 
	     $_SESSION['c_825'] = $c_825;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }      
	// $cod_ord = $_SESSION['cod_ord'];
	$consulta = "update ord_detalle set ORD_DET_DIAS = '$t_825',
	                                    ORD_DET_MONTO = $mon_825,
										ORD_DET_COMEN = '$com_825',
										ORD_DET_VOLT = $c_825
										where ORD_DET_ORD = $cod_ord 
										  and ORD_DET_GRP = 825"; 
$resultado = mysql_query($consulta)or die('No pudo actualizar ord_detalle 825 : ' . mysql_error()); 
}
//826
if(isset($_POST["t_826"])){
if ($_POST["t_826"] <> ""){
      $t_826= strtoupper($_POST["t_826"]); 
	  $_SESSION['t_826'] = $t_826;
     //echo $fac_a;
	    
	  if(isset($_POST["mon_826"])){
         $mon_826 = $_POST["mon_826"]; 
	     $_SESSION['mon_826'] = $mon_826;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }  
	 if(isset($_POST["com_826"])){
         $com_826= strtoupper($_POST["com_826"]); 
	     $_SESSION['com_826'] = $com_826;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }    
//	$cod_ord = $_SESSION['cod_ord'];


  $hay = 0;
 $con_826 = "Select * From ord_detalle
		              where ORD_DET_ORD = $cod_ord 
		              and ORD_DET_GRP = 826
					  and  ORD_DET_USR_BAJA is null";
     $res_826= mysql_query($con_826)or die('No pudo seleccionarse tabla ord_detalle');
     while ($lin_826 = mysql_fetch_array($res_826)){
	        $hay = $hay  + 1;
	      }


 if ($hay > 0){
	$consulta = "update ord_detalle set ORD_DET_OTRO = '$t_826',
	                                    ORD_DET_MONTO = $mon_826,
										ORD_DET_COMEN = '$com_826'
										where ORD_DET_ORD = $cod_ord 
										  and ORD_DET_GRP = 826"; 
$resultado = mysql_query($consulta)or die('No pudo actualizar ord_detalle 826 : ' . mysql_error()); 
}else{
 $consulta = "insert into ord_detalle (ORD_DET_ORD, 
                                            ORD_DET_NRO,
									        ORD_DET_GRP,
									        ORD_DET_TIPO,
										    ORD_DET_CANT,
									        ORD_DET_DIAS,
					                        ORD_DET_MONTO,
					                        ORD_DET_VOLT,
   				                            ORD_DET_VOLP,
					                        ORD_DET_MED, 
											ORD_DET_OTRO,
									        ORD_DET_COMEN, 
									        ORD_DET_ESTADO, 
									        ORD_DET_USR_ALTA,
                                            ORD_DET_FCH_HR_ALTA,
                                            ORD_DET_USR_BAJA,
                                            ORD_DET_FCH_HR_BAJA
									        ) values ($cod_ord,
									                  2,
												      826,
												      1,
												      0,
												      0,
												      $mon_826,
												      0,
												      0,
													  0,
 											          '$t_826',
												  	   '$com_826',
												      1,
												      '$log_usr',
												      null,
												      null,
												     '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar ord_detalle 826 1 : ' . mysql_error());


}

}
}
$importe = 0;
$con_imp = "SELECT sum(ORD_DET_MONTO) FROM ord_detalle where ORD_DET_ORD = $cod_ord";
				
 $res_imp = mysql_query($con_imp)or die('No pudo seleccionarse ord_detalle suma');
 while ($lin_imp = mysql_fetch_array($res_imp)) {
      $importe =  $lin_imp['sum(ORD_DET_MONTO)'];
       }
	echo $importe, $h_ini,$h_fin,$desc;
    $consulta = "update ord_maestro set ORD_ESTADO = 2,
	                                    ORD_HR_INI = '$h_ini',
										ORD_HR_FIN = '$h_fin',
										ORD_IMP_DES = $desc,
										ORD_IMPORTE = $importe
	                                    where ORD_NUMERO = $cod_ord"; 
$resultado = mysql_query($consulta)or die('No pudo actualizar ord_mestro estado : ' . mysql_error()); 
//}
 
/*	  
 */
//header('Location: ord_imp_com.php');	 
 //         }
	  
		  
		  		  
		   ?>
		 
  <div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Registro  de  Crédito</MARQUEE></FONT></B>
   </div>
   <?php
		 	include("footer_in.php");
		 ?> 
</body>
</html>
<?php
ob_end_flush();
 ?>