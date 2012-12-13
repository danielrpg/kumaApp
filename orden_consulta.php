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
<title>Modificacion Orden de Trabajo</title>
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
               Modificacion Orden de Trabajo
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>

<?php
if(isset($_POST['cod_ord'])){ 
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
echo $_SESSION['cod_ord'];
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
$f_ord = $linea['ORD_FEC_SOL'];
$_SESSION['f_ord'] = cambiaf_a_normal_2($f_ord);
$f_ini = $linea['ORD_FEC_INI'];
$_SESSION['f_ini'] = cambiaf_a_normal_2($f_ini);
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





//if(isset($_SESSION["continuar"])){
//     if($_SESSION["continuar"] == 1){
?>
<center>
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
	  <td bgcolor="#66CCFF" style="text-align:justify" style="font-size:10px"> <?php echo $_SESSION['direc'];?></td>
					
</table>


<?php  
//}
//}
$con_tse  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD <> 0 order by 2 ";
$res_tse = mysql_query($con_tse)or die('No pudo seleccionarse tabla 1')  ;

$con_ope  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD <> 0 ";
$res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla')  ;
$con_fpa  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 600 and GRAL_PAR_PRO_COD <> 0 ";
$res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 2')  ;

if(isset($_SESSION['form_buffer'])){
	$datos = $_SESSION['form_buffer'];
}
 ?>
 <strong>
 <?php
 if(isset($_SESSION['msg_err'])){
 ?> 
 <font color="#FF0000"> 
  <?php
	 echo $_SESSION['msg_err'];
	 $_SESSION['msg_err'] = "";
 } 
 ?>
 <?php
// if(isset($_SESSION["continuar"])){
 //    if($_SESSION["continuar"] == 1){
 ?> 
 </font>
  </strong>
  
 <form name="form2" method="post" action="solic_retro_sol.php" onSubmit="return ValidarCamposOrden(this)">
 <table width="80%" align="center" border="1">
           <tr>
 		      <th align="left">Solicitado Por</th>
              <td><input type="text" name="sol_por" maxlength="35" size="35"
			  value = "<?php echo $_SESSION['q_sol']; ?>" ></td>
			  
           </tr> 
		    <tr>
 		      <th align="left">Factura a nombre de</th>
              <td><input type="text" name="fac_a" maxlength="35" size="35" 
			       value = "<?php echo $_SESSION['n_fac']; ?>"></td>
			  <th align="left">Nit Nº</th>
              <td><input type="text" name="nit" maxlength="15" size="15" 
			      value = "<?php echo $_SESSION['nit_f']; ?>" ></td>
           </tr> 
           <tr>
              <th align="left">Fec. Solicitud Serv.</th>
              <td><input type="text" name="fec_des" maxlength="10" size="10" value = "<?php echo $_SESSION['f_ord']; ?>">
	          </td>
           
              <th align="left">Fec. Inicio Serv.</th>
              <td><input type="text" name="fec_uno" maxlength="10"  size="10" value = "<?php echo $_SESSION['f_ord']; ?>"> 
	          </td>
            </tr>
			<tr>
              <td align="left">Hra. Inicio</td>
			  <td><input type= type="text" name="hra_ini" maxlength="8" size="8" value="<?php echo $_SESSION['h_ini']; ?>" >
			  </td>
			  <td align="left">Hra. Final </td>
			  <td><input type= type="text" name="hra_fin" maxlength="8" size="8" value="<?php echo $_SESSION['h_fin']; ?>" ></td>
			 </tr>
			 <tr>
              <td align="left"><strong><?php echo "Forma de Pago";?> </strong> </td>
			  <td align="left"> <font color="#FF0000"> <?php echo $_SESSION['for_pag'].encadenar(2);?></font>
			     <select name="cod_fpa" size="1">
			  <?php while ($linfpa = mysql_fetch_array($res_fpa)) { ?>
             <option value=<?php echo $linfpa['GRAL_PAR_PRO_COD']; ?>>
			 <?php echo $linfpa['GRAL_PAR_PRO_DESC']; ?> </option>
	  	     <?php } ?> 
            </select></td>
		   </tr>
		   <tr>
              <th align="left">Operador</th>
			  <td align="left"><font color="#FF0000"> <?php echo $_SESSION['nom_ope'].encadenar(2);?> </font>
			   <select name="cod_ope" size="1"  >
			  <?php while ($linope = mysql_fetch_array($res_ope)) { ?>
             <option value=<?php echo $linope['GRAL_PAR_PRO_COD']; ?>>
			 <?php echo $linope['GRAL_PAR_PRO_DESC']; ?> </option>
	  	     <?php } ?> 
            </select></td>
		   </tr>
		 </table>
		  <?php 
		  $_SESSION['can_std']=0;
          $_SESSION['can_ip']=0;
          $_SESSION['can_vip']=0;
          $_SESSION['can_dias']=0;
          $_SESSION['can_801']=0;
          $_SESSION['dias_801']=0;
          $_SESSION['mon_801']=0;
          $_SESSION['can_804']=0;
          $_SESSION['dias_804']=0;
          $_SESSION['mon_804']=0;
          $_SESSION['mon_802'] =0;
          $_SESSION['c_803'] ="NO";
          $_SESSION['c_806'] ="NO";
          $_SESSION['c_825']="NO";
          $_SESSION['c_826']="NO";
          $_SESSION['mon_std'] =0; 
          $_SESSION['mon_ip'] =0; 
          $_SESSION['mon_vip'] =0;
		  $con_det  = "Select * From ord_detalle where ORD_DET_ORD = $cod_ord and ORD_DET_USR_BAJA is null";
          $res_det= mysql_query($con_det)or die('No pudo seleccionarse tabla 2')  ;
          while ($lin_det = mysql_fetch_array($res_det)){
		        $det_grup =  $lin_det['ORD_DET_GRP']; 
	            if ($det_grup == 802){
				    $_SESSION['can_dias']=$lin_det['ORD_DET_DIAS'];
				    $tipo = $lin_det['ORD_DET_TIPO']; 
					if ($tipo == 3){
				        $_SESSION['can_std']=$lin_det['ORD_DET_CANT'];
					}
					if ($tipo == 1){
                        $_SESSION['can_ip']=$lin_det['ORD_DET_CANT'];
					}
					if ($tipo == 2){
                       $_SESSION['can_vip']=$lin_det['ORD_DET_CANT'];
                    }
				  } 
				    if ($det_grup == 801){
				       $_SESSION['can_801']=$lin_det['ORD_DET_CANT'];
					   $_SESSION['dias_801']=$lin_det['ORD_DET_DIAS'];
					   } 
				    if ($det_grup == 804){
				       $_SESSION['can_804']=$lin_det['ORD_DET_CANT'];
					   $_SESSION['dias_804']=$lin_det['ORD_DET_DIAS'];
					   } 
					if ($det_grup == 803){
				       $_SESSION['c_803']="SI";
					   } 
					if ($det_grup == 806){
				       $_SESSION['c_806']="SI";
					   } 
					if ($det_grup == 825){
				       $_SESSION['c_825']="SI";
					   } 
					if ($det_grup == 826){
				       $_SESSION['c_826']="SI";
					   }             	   
           } 
		  
		  
		  
		  
		  
		   ?> 
		 
		 
		 
		 
		 <strong>Servicios  </strong>
	
   
   	<?php while ($lin_tse = mysql_fetch_array($res_tse)) {
	            $cod_ser = $lin_tse['GRAL_PAR_PRO_CTA1'];
				$con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = $cod_ser
				              and GRAL_PAR_PRO_COD <> 0 order by 2";
                $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; ?>
  	<tr>
	  	
		<?php if ($cod_ser == 802){?>
		<table width="80%" align="center" border="1">	    
    <tr>
        <td align="center">Servicio</td>
		<td align="center"><strong>Tipo  </strong></td>
		<td align="center"><strong>Cant. </strong></td>
		<td align="center"><strong>Tipo  </strong></td>
		<td align="center"><strong>Cant. </strong></td>
		<td align="center"><strong>Tipo  </strong></td>
		<td align="center"><strong>Cant. </strong></td>
		<td align="center"><strong>Nro. Dias </strong></td>
	 </tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2)
		                                   .$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		<td align="left"><strong>STD</strong></td>
  	    <td><input type= type="text" name="can_std" maxlength="5" size="5" value="<?php echo $_SESSION['can_std']; ?>" ></td>
		<td align="left"><strong>I.P.</strong></td>
  	    <td><input type= type="text" name="can_ip" maxlength="5" size="5" value="<?php echo $_SESSION['can_ip']; ?>" ></td>
		<td align="left"><strong>V.I.P.</strong></td>
  	    <td><input type= type="text" name="can_vip" maxlength="5" size="5" value="<?php echo $_SESSION['can_vip']; ?>" ></td>
		 <td><input type= type="text" name="can_dias" maxlength="5" size="6" value="<?php echo $_SESSION['can_dias']; ?>" ></td>
		 <?php  }  ?>
		 </table>
		 <table width="80%" align="center" border="1">	 
		 <?php if ($cod_ser == 801){?>
		   
    <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2)
		                              .$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		<td align="center"><strong>Cantidad</strong></td>
		<td><input type= type="text" name="can_801" maxlength="8" size="8" value="<?php echo $_SESSION['can_801'];?>" ></td>
		<td align="center"><strong>Nro. Dias </strong></td>
		<td><input type= type="text" name="dias_801" maxlength="8" size="8" value="<?php echo $_SESSION['dias_801'];?>" ></td>
	 </tr>
    <?php  }  ?>
	<?php if ($cod_ser == 804){?>
		    
    <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2)
		                              .$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		<td align="center"><strong>Cantidad</strong></td>
		<td><input type= type="text" name="can_804" maxlength="8" size="8" value="<?php echo $_SESSION['dias_804'];?>" ></td>
		<td align="center"><strong>Nro. Dias </strong></td>
		<td><input type= type="text" name="dias_804" maxlength="8" size="8" value="<?php echo $_SESSION['dias_804'];?>" ></td>
	 </tr>
    <?php  }  ?>
	      </table>	  
	 <table width="80%" align="center" border="1">	  
		 <?php if ($cod_ser == 803){?>
		 
		<tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		<td><?php echo $_SESSION['c_803'].encadenar(2);?></td> 
		<td><?php echo "Marcar".encadenar(5);?><INPUT NAME="c_803" TYPE=RADIO VALUE="<?php echo "c803"; ?>">	</td> 
		<td><?php echo "Desmarcar".encadenar(2);?><INPUT NAME="c_803" TYPE=RADIO VALUE="<?php echo "c803"; ?>">	</td>
		<?php  }  ?>		
		 <?php if ($cod_ser == 806){?>
		 
		<tr>
		
        <th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		<td><?php echo $_SESSION['c_806'].encadenar(2);?></td> 
		<td><?php echo "Marcar".encadenar(5);?><INPUT NAME="c_806" TYPE=RADIO VALUE="<?php echo "c806"; ?>">	</td> 
		<td><?php echo "Desmarcar".encadenar(2);?><INPUT NAME="c_806" TYPE=RADIO VALUE="<?php echo "c806"; ?>">	</td>
		<?php  }  ?>
		<?php if ($cod_ser == 825){?>
		<th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		<td><?php echo $_SESSION['c_825'].encadenar(2);?></td> 
		<td><?php echo "Marcar".encadenar(5);?><INPUT NAME="c_825" TYPE=RADIO VALUE="<?php echo "c825"; ?>">	</td>
		 <td><?php echo "Desmarcar".encadenar(5);?><INPUT NAME="c_825" TYPE=RADIO VALUE="<?php echo "c825"; ?>">	</td> 
			<?php  }  ?>
			<?php if ($cod_ser == 826){?>
		<th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		<td><?php echo $_SESSION['c_826'].encadenar(2);?></td>
		<td><?php echo "Marcar".encadenar(5);?><INPUT NAME="c_826" TYPE=RADIO VALUE="<?php echo "c826"; ?>">	</td> 
		<td><?php echo "Desmarcar".encadenar(5);?><INPUT NAME="c_826" TYPE=RADIO VALUE="<?php echo "c826"; ?>">	</td>
	  	     <?php } ?> 
      </tr>
	  <?php }  ?>
	</table>
  	<center>
	<input type="submit" name="accion" value="Calculo">
    <input type="submit" name="accion" value="Salir">
</form>

 <?php // } 
 if($_SESSION["continuar"] == 2){
 //$_SESSION['fec_proc'] = "";
 $_SESSION['fec_ord'] = "";
 $_SESSION['NOM_EMPRESA']="";
 $_SESSION['TIPO_SERVIC']="";
 $_SESSION['DIRECCION']="";
 $_SESSION['GERENTE']="";
 $_SESSION['TELEFONOS']="";
 $_SESSION['CASILLA']="";
 $_SESSION['fec_ini']="";
 //$_SESSION['cod_cli'] = 0;
 $_SESSION['ci']=0;
 $_SESSION['fac_a'] = "";
 $_SESSION['hra_ini']="";
 $_SESSION['sol_por']="";
 $_SESSION['hra_fin']="";
 $_SESSION['nom_ope']="";
 $_SESSION['for_pag']="";
 $_SESSION['fac_a'] = "";
 $_SESSION['nit'] = "";
 $_SESSION['can_std']=0;
 $_SESSION['can_ip']=0;
 $_SESSION['can_vip']=0;
 $_SESSION['can_dias']=0;
 $_SESSION['can_801']=0;
 $_SESSION['dias_801']=0;
 $_SESSION['mon_801']=0;
 $_SESSION['can_804']=0;
 $_SESSION['dias_804']=0;
 $_SESSION['mon_804']=0;
 $_SESSION['mon_802'] =0;
 $_SESSION['c_803'] ="";
 $_SESSION['c_806'] ="";
 $_SESSION['c_825']="";
 $_SESSION['c_826']="";
 $_SESSION['mon_std'] =0; 
 $_SESSION['mon_ip'] =0; 
 $_SESSION['mon_vip'] =0;
 $cant = 0;
 $t_cost = 0;
 

 // echo $_SESSION['nom_com'];
   if(isset($_POST["sol_por"])){
      $sol_por = strtoupper($_POST["sol_por"]); 
	  $_SESSION['sol_por'] = $sol_por;
    //  echo $sol_por;
	  }
	 if(isset($_POST["fac_a"])){
      $fac_a= strtoupper($_POST["fac_a"]); 
	  $_SESSION['fac_a'] = $fac_a;
    //  echo $sol_por;
	  }  
	  if(isset($_POST["nit"])){
      $nit= strtoupper($_POST["nit"]); 
	  $_SESSION['nit'] = $nit;
    //  echo $sol_por;
	  }  
	if(isset($_POST["fec_des"])){
      $fec_ord = $_POST["fec_des"]; 
	  $_SESSION['fec_ord'] = $fec_ord;
     // echo $fec_ord;
	  }  
	 if(isset($_POST["fec_uno"])){
      $fec_ini = $_POST["fec_uno"]; 
	  $_SESSION['fec_ini'] = $fec_ini;
     // echo $fec_ord;
	  }   
	if(isset($_POST["hra_ini"])){
      $hra_ini = $_POST["hra_ini"]; 
	  $_SESSION['hra_ini'] = $hra_ini;
      //echo $hra_ini;
	  }  
	if(isset($_POST["hra_fin"])){
      $hra_fin = $_POST["hra_fin"]; 
	  $_SESSION['hra_fin'] = $hra_fin;
   //   echo $hra_fin;
	  }
	  if(isset($_POST["c_803"])){
      $c_803 = $_POST["c_803"]; 
	  $_SESSION['c_803'] = "SI";
     // echo $c_806;
	  } 
	  if(isset($_POST["c_806"])){
      $c_806 = $_POST["c_806"]; 
	  $_SESSION['c_806'] = "SI";
     // echo $c_806;
	  }
	 if(isset($_POST["c_825"])){
      $c_825 = $_POST["c_825"]; 
	  $_SESSION['c_825'] = "SI";
     // echo $c_806;
	  }
	  if(isset($_POST["c_826"])){
      $c_825 = $_POST["c_826"]; 
	  $_SESSION['c_826'] = "SI";
     // echo $c_806;
	  } 
   ?>
 <form name="form2" method="post" action="solic_retro_sol.php" onSubmit="">
<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
  <tr>
      <th width="25%" scope="col" style="font-size:10px"><border="0" alt="" align="center" />CODIGO</th>
	  <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="center" />CLIENTE</th>
      <th width="25%" scope="col" style="font-size:10px"><border="0" alt="" align="center" />TEL. FIJO</th>
      <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />TEL.CELULAR</th>
	  <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />DIRECCION</th>
		 
	  </tr>
  
 <?php
 $consulta  = "Select * From gral_empresa ";
 $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla 3');
 while ($linea = mysql_fetch_array($resultado)) {
          $_SESSION['NOM_EMPRESA']=$linea['GRAL_EMP_NOMBRE'];
          $_SESSION['TIPO_SERVIC']=$linea['GRAL_EMP_DIRECTOR'];
		  $_SESSION['DIRECCION']=$linea['GRAL_EMP_DIREC'];
		  $_SESSION['GERENTE']=$linea['GRAL_EMP_GERENTE'];
		  $_SESSION['TELEFONOS']=$linea['GRAL_EMP_FONOS'];
		  $_SESSION['CASILLA']=$linea['GRAL_EMP_CASILLA'];
		  $_SESSION['EMAIL']=$linea['GRAL_EMP_LOGO'];
 }
 //  echo $can_dias. "can_dias";
		// }  
	
 //forma pago
 	$cod_fpa = $_SESSION['fpag'];
 $con_fpa  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 600 and
              GRAL_PAR_PRO_COD = $cod_fpa";
 $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 4');
 while ($linfpa = mysql_fetch_array($res_fpa)) {
       $for_pag = $linfpa['GRAL_PAR_PRO_DESC'];
	   $_SESSION['for_pag'] = $for_pag;
	   $_SESSION['cod_fpa'] = $cod_fpa;
       }    
	//echo "Forma de Pago" .encadenar(2).$for_pag;    
 //operador
 $oper = $_SESSION['cope'];
 $con_ope  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and
              GRAL_PAR_PRO_COD = $oper";
 $res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla');
 while ($linope = mysql_fetch_array($res_ope)) {
       $nom_ope = $linope['GRAL_PAR_PRO_DESC'];
	   $_SESSION['nom_ope'] = $nom_ope;
	   $_SESSION['oper'] = $oper;
       }
 //echo "Operador" .encadenar(2).$nom_ope;
 ?>
  
  <tr>
    <th align="center"> <?php echo $_SESSION['NOM_EMPRESA'];?> </th>
	<td align="left" style="font-size:12px" style="top:auto"> <?php echo "CLIENTE/EMPRESA";?> </td>
	<td align="left" style="font-size:12px" style="top:auto"> <?php echo $_SESSION['nom_com'];?> </td>
	<td align="left" style="font-size:10px"> <?php echo "TELEFONO(S)".encadenar(1).$_SESSION['fono']
	                       .encadenar(2).$_SESSION['celu'];?> </td>
	<td align="left" style="font-size:12px"> <?php echo "FEC.INICIO".encadenar(2). $_SESSION['fec_ini'];?> </td>
  </tr>
  <tr>
    <td align="center" style="font-size:9px"> <?php echo $_SESSION['TIPO_SERVIC'];?> </td>
	<td align="left" style="font-size:12px"> <?php echo "C.I. / NIT";?> </td>
	<td align="left" style="font-size:12px"> <?php echo $_SESSION['nit'];?> </td>
	<td align="center"> <?php echo encadenar(12);?> </td>
	<td align="left" style="font-size:12px"> <?php echo "Hora Inicio".encadenar(6).$_SESSION['hra_ini'];?> </td>
  </tr> 
   <tr>
    <td align="center" style="font-size:10px"> <?php echo "De:" .encadenar(2).$_SESSION['GERENTE'];?> </td>
	<td align="left" style="font-size:12px"> <?php echo "SOLICITADO POR";?> </td>
	<td align="left" style="font-size:12px"> <?php echo $_SESSION['sol_por'];?> </td>
	<td align="center"> <?php echo encadenar(12);?> </td>
	<td align="left" style="font-size:12px"> <?php echo "Hora Conclu.".encadenar(3).$_SESSION['hra_fin'];?> </td>
  </tr>                                
   <tr>
    <th align="center" style="font-size:12px"> <?php echo "Telefonos".encadenar(2).$_SESSION['TELEFONOS'];?> </th>
	<td align="left" style="font-size:12px"> <?php echo "OPERADOR";?> </td>
	<td align="left" style="font-size:12px"> <?php echo $_SESSION['nom_ope'];?> </td>
	<td align="center"> <?php echo encadenar(12);?> </td>
	<td align="center"> <?php echo encadenar(12);?> </td>
  </tr>  
  <tr>
    <td align="center" style="font-size:12px"> <?php echo "Casilla".encadenar(2).$_SESSION['CASILLA'];?> </td>
	<td align="left" style="font-size:12px"> <?php echo "AUTORIZADO POR ";?> </td>
	<td align="left" style="font-size:12px"> <?php echo encadenar(3);?> </td>
	<td align="left" style="font-size:12px"> <?php echo "FORMA DE PAGO";?> </td>
	<td align="left" style="font-size:12px"> <?php echo $_SESSION['for_pag'];?> </td>
  </tr>  
 
  </table> 
  <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
  <tr>
        <th  width="26%" scope="col" style="font-size:12px">Direccion </th>
		<td  width="74%" scope="col" style="font-size:10px"> <?php echo $_SESSION['direc'];?> </td>
		
   </tr>
  </table> 
 <?php
 $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 1 ";
 $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
 while ($lin802 = mysql_fetch_array($res_tser)) {
        $desc1 = $lin802['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin802['GRAL_PAR_PRO_DESC'];
		$_SESSION['desc1_802'] = $desc1;
	   }
 $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 2 ";
 $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
 while ($lin801 = mysql_fetch_array($res_tser)) {
  	     $desc1 = $lin801['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin801['GRAL_PAR_PRO_DESC'];
	     $_SESSION['desc1_801'] = $desc1;
	   }
 $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 3 ";
 $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
 while ($lin804 = mysql_fetch_array($res_tser)) {
	    $desc1 = $lin804['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin804['GRAL_PAR_PRO_DESC'];
	    $_SESSION['desc1_804'] = $desc1;
	  }
  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 4 ";
  $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
  while ($lin803 = mysql_fetch_array($res_tser)) {
  	     $desc1 = $lin803['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin803['GRAL_PAR_PRO_DESC'];
	     $_SESSION['desc1_803'] = $desc1;
	  	}
  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 5 ";
  $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
  while ($lin806 = mysql_fetch_array($res_tser)) {
  	     $desc1 = $lin806['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin806['GRAL_PAR_PRO_DESC'];
	     $_SESSION['desc1_806'] = $desc1;
  	}	
  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 6 ";
  $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
  while ($lin825 = mysql_fetch_array($res_tser)) {
  	     $desc1 = $lin825['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin825['GRAL_PAR_PRO_DESC'];
	     $_SESSION['desc1_825'] = $desc1;
	  	}
  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 7 ";
  $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
  while ($lin826 = mysql_fetch_array($res_tser)) {
	     $desc1 = $lin826['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin826['GRAL_PAR_PRO_DESC'];
	     $_SESSION['desc1_826'] = $desc1;
		}		 
		
 
  if(isset($_POST['can_dias'])){
      $can_dias = $_POST['can_dias'];
	 if ($can_dias > 0){
	  $_SESSION['can_dias'] = $can_dias; 	  
	  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 1 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
	  while ($lin802 = mysql_fetch_array($res_tser)) {
	  	     $desc1 = $lin802['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin802['GRAL_PAR_PRO_DESC'];
		     $_SESSION['desc1_802'] = $desc1;
		   } ?>
	<table width="80%" align="center" border="1">	    
    <tr>
        <th align="center">Servicio</th>
		<td align="center"><strong>Tipo  </strong></td>
		<td align="center"><strong>Cant. </strong></td>
		<td align="center"><strong>Tipo  </strong></td>
		<td align="center"><strong>Cant. </strong></td>
		<td align="center"><strong>Tipo  </strong></td>
		<td align="center"><strong>Cant. </strong></td>
		<td align="center"><strong>Nro. Dias</strong></td>
		<td align="center"><strong>Monto </strong></td>
	 </tr>
	 <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_802']; ?> </th>  
	
	  
 <?php if(isset($_POST['can_std'])){
          $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 802 and GRAL_PAR_PRO_COD = 3 ";
          $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2'); 
		  while ($lin802 = mysql_fetch_array($res_tser)) {
                $imp_std = $lin802['GRAL_PAR_PRO_CTA1'];
          }
         $can_std = $_POST['can_std'];
	     $_SESSION['can_std'] = $can_std;
	     $mon_std = ($can_std * $imp_std) * $can_dias;
		 $_SESSION['mon_std'] =$mon_std;  
	 // echo $mon_std. "mon_std";
	    }    
	  if(isset($_POST['can_ip'])){
	     $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 802 and GRAL_PAR_PRO_COD = 1 ";
         $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2'); 
		  while ($lin802 = mysql_fetch_array($res_tser)) {
                $imp_ip = $lin802['GRAL_PAR_PRO_CTA1'];
          }
         $can_ip = $_POST['can_ip'];
	     $_SESSION['can_ip'] = $can_ip;
	     $mon_ip = ($can_ip * $imp_ip) * $can_dias;
		 $_SESSION['mon_ip'] =$mon_ip;  
	//	 echo $mon_ip. "mon_ip";
	 }  
	   if(isset($_POST['can_vip'])){
	     $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 802 and GRAL_PAR_PRO_COD = 2 ";
         $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2'); 
		  while ($lin802 = mysql_fetch_array($res_tser)) {
                $imp_vip = $lin802['GRAL_PAR_PRO_CTA1'];
          }
	      $can_vip = $_POST['can_vip'];
	      $_SESSION['can_vip'] = $can_vip;
	      $mon_vip = ($can_vip * $imp_vip) * $can_dias;
		  $_SESSION['mon_vip'] =$mon_vip; 
		//  echo $mon_vip. "mon_vip";
	 } 
	$_SESSION['mon_802'] = $mon_std + $mon_ip + $mon_vip;
	?> 
	
		<td align="left"><strong>STD</strong></td>
  	    <td align="center"> <?php echo  $_SESSION['can_std'];?></td>
		<td align="left"><strong>I.P.</strong></td>
  	    <td align="center"> <?php echo  $_SESSION['can_ip'];?></td>
		<td align="left"><strong>V.I.P.</strong></td>
  	    <td align="center"> <?php echo  $_SESSION['can_vip'];?></td>
		<td align="center"> <?php echo  $_SESSION['can_dias'];?></td>
		<td align="right"> <?php echo number_format($_SESSION['mon_802'], 2, '.',',') ;?></td>
	 </table>
		 <?php  } 
		      }        ?>
	
	
	 
	<?php
	 if(isset($_POST['can_801'])){
	   
	  $mon_801 = 0;
	  $can_801 = $_POST['can_801'];
	 if ($can_801 > 0){    
	  $_SESSION['can_801'] = $can_801;
	  $dias_801 = $_POST['dias_801'];
	  $_SESSION['dias_801'] = $dias_801;
	   $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 801 and GRAL_PAR_PRO_COD = 1 ";
         $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2'); 
		  while ($lin801 = mysql_fetch_array($res_tser)) {
                $imp_801 = $lin801['GRAL_PAR_PRO_CTA1'];
          }
	  $mon_801 = ($can_801 * $imp_801) * $dias_801;
	  $_SESSION['mon_801'] = $mon_801;
	 $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 2 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
	  while ($lin801 = mysql_fetch_array($res_tser)) {
	  	     $desc1 = $lin801['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin801['GRAL_PAR_PRO_DESC'];
		     $_SESSION['desc1_801'] = $desc1;
		   } ?>
	  <table width="80%" align="center" border="1">
	  <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_801']; ?> </th> 
		<td align="center"><strong>Cantidad</strong></td>
		<td align="center"><?php echo $_SESSION['can_801']; ?></td>
		<td align="center"><strong>Nro. Dias </strong></td>
		<td><?php echo $_SESSION['dias_801']; ?></td>
		<td align="center"><strong>Monto  </strong></td>
		<td align="right"><?php echo number_format($_SESSION['mon_801'], 2, '.',','); ?></td>
	  </tr>
	  	   
	  <?php	
	 //	  echo $can_801. "can_801".$dias_801;
	    }
	 }
	  ?>
	 <?php 
	if(isset($_POST['can_804'])){
	  $mon_804 = 0;
      $can_804 = $_POST['can_804'];
	if ($can_804 > 0){    
	  $_SESSION['can_804'] = $can_804;
	  $dias_804 = $_POST['dias_804'];
	  $_SESSION['dias_804'] = $dias_804;
	   $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 804 and GRAL_PAR_PRO_COD = 1 ";
         $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2'); 
		  while ($lin804 = mysql_fetch_array($res_tser)) {
                $imp_804 = $lin804['GRAL_PAR_PRO_CTA1'];
          }
	  $mon_804 = ($can_804 * $imp_804) * $dias_804;
	  $_SESSION['mon_804'] = $mon_804;
	 $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 3 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
	  while ($lin804 = mysql_fetch_array($res_tser)) {
	  	     $desc1 = $lin804['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin804['GRAL_PAR_PRO_DESC'];
		     $_SESSION['desc1_804'] = $desc1;
	  	
	 }?>
	  <table width="80%" align="center" border="1">
	  <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_804']; ?> </th> 
		<td align="center"><strong>Cantidad</strong></td>
		<td align="center"><?php echo $_SESSION['can_804']; ?></td>
		<td align="center"><strong>Nro. Dias </strong></td>
		<td><?php echo $_SESSION['dias_804']; ?></td>
		<td align="center"><strong>Monto  </strong></td>
		<td align="right"><?php echo number_format($_SESSION['mon_804'], 2, '.',','); ?></td>
	  </tr>
	  </table>	   
	  <?php	
	  }
	  }
	 if(isset($_POST['c_803'])){
     // $c_806 = $_POST['c_803'];
	 //  $_SESSION['c_803'] = 1;
	   $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 4 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
	  while ($lin803 = mysql_fetch_array($res_tser)) {
	  	     $desc1 = $lin803['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin803['GRAL_PAR_PRO_DESC'];
		     $_SESSION['desc1_803'] = $desc1;
	  	} ?>
	
	<table width="80%" align="center" border="1">
	  <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_803']; ?> </th> 
	
	
	 <?php	
	  
	 // echo $c_803. "c_803";
	 }   
	if(isset($_POST['c_806'])){
	  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 5 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
	  while ($lin806 = mysql_fetch_array($res_tser)) {
	  	     $desc1 = $lin806['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin806['GRAL_PAR_PRO_DESC'];
		     $_SESSION['desc1_806'] = $desc1;
	  	} ?>
	
	<table width="80%" align="center" border="1">
	  <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_806']; ?> </th> 
	 </tr>
	
	 <?php	
	
     // $c_806 = $_POST['c_806'];
	//  $_SESSION['c_806'] = 1;
	 // echo $c_806. "c_806";
	 } 
	if(isset($_POST['c_825'])){
    //  $c_825 = $_POST['c_825'];
	//  $_SESSION['c_825'] = 1;
	//  echo $c_806. "c_825";
	$con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 6 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
	  while ($lin825 = mysql_fetch_array($res_tser)) {
	  	     $desc1 = $lin825['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin825['GRAL_PAR_PRO_DESC'];
		     $_SESSION['desc1_825'] = $desc1;
	  	} ?>
	<table width="80%" align="center" border="1">
	  <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_825']; ?> </th> 
	   </tr>
	 <?php	
	 }  
	 if(isset($_POST['c_826'])){
    //  $c_826 = $_POST['c_825'];
	//  $_SESSION['c_826'] = 1;
	 // echo $c_806. "c_826";
	 $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 7 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
	  while ($lin826 = mysql_fetch_array($res_tser)) {
	  	     $desc1 = $lin826['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin826['GRAL_PAR_PRO_DESC'];
		     $_SESSION['desc1_826'] = $desc1;
	  	} ?>
	<table width="80%" align="center" border="1">
	  <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_826']; ?> </th> 
	 </tr>
	 </table>	
	 <?php	
	 	 } ?> 
	<table width="80%" align="center" border="1">	 
	  <tr>
        <th width="40%" align="left" style="font-size:14px"><?php echo "Descuento"; ?> </td>
		<td><input type= type="text" name="descuento" maxlength="12" size="15" value="" ></td>
	 </tr>
 </table>
  <?php
 
 //echo "Calculo monto";
 
   ?>
   
  </table>
   <center>
  
   <input type="submit" name="accion" value="Imprimir">
   <input type="submit" name="accion" value="Salir">
</form>
 <?php
 
 }
          } ?>
		 
  <div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Alta Orden de Trabajo</MARQUEE></FONT></B>
   </div>
   <?php
		 	include("footer_in.php");
		 ?> 
</body>
</html>
<?php
ob_end_flush();
 ?>