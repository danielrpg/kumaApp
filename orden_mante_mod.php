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
</center>
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
$_SESSION['barrio'] = $linea['CLIENTE_ZONA'];					 
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
//$cod_barr1 = $linea['CLIENTE_COD_BARR'];
//$con_bar1  = "Select * From gral_barrios where gral_barr_codigo = $cod_barr1";
//$res_bar1= mysql_query($con_bar1)or die('No pudo seleccionarse tabla 2')  ;
// while ($lin_barr = mysql_fetch_array($res_bar1)) {
//    $_SESSION['barrio'] =  $lin_barr['gral_barr_nombre']; 
//	$_SESSION['det_barr'] = $lin_barr['gral_barr_detalles'];
 //} 





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
	  <th width="45%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />DIRECCION</th>
		 
	  </tr>
	  
	  	
		<td bgcolor="#66CCFF" style="top:auto" style="font-size:12px"><?php echo $_SESSION['barrio'];  ?></td>
		<td bgcolor="#66CCFF" style="text-align:justify" style="font-size:11px"> <?php echo $_SESSION['direc'];  ?></td>
					
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
 if($_SESSION["continuar"] == 1){
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
              <td><input type="text" name="fec_uno" maxlength="10"  size="10" value = "<?php echo $_SESSION['f_ini']; ?>"> 
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
         $_SESSION['dias_std']=0;
         $_SESSION['dias_ip']=0;
          $_SESSION['dias_vip']=0; 
          $_SESSION['can_801']=0;
          $_SESSION['dias_801']=0;
          $_SESSION['mon_801']=0;
          $_SESSION['can_804']=0;
          $_SESSION['dias_804']=0;
          $_SESSION['mon_804']=0;
          $_SESSION['mon_802'] =0;
          $_SESSION['c_803_n'] ="";
          $_SESSION['c_806_n'] ="";
          $_SESSION['c_825_n']="";
          $_SESSION['c_826_n']="";
		  $_SESSION['c_803'] ="NO";
          $_SESSION['c_806'] ="NO";
          $_SESSION['c_825']="NO";
          $_SESSION['c_826']="NO";
          $_SESSION['mon_std'] =0; 
          $_SESSION['mon_ip'] =0; 
          $_SESSION['mon_vip'] =0;
		  $_SESSION['vol_803'] =0; 
 $_SESSION['via_803'] =0;
 $_SESSION['m_803'] =0; 
 $_SESSION['vol_806'] =0;
 $_SESSION['m_806'] =0; 
 $_SESSION['tip_825'] =0; 
 $_SESSION['cam_825'] =0;
 $_SESSION['m_825'] =0;
 $_SESSION['serv_825'] = ""; 
 $_SESSION['com_826'] =0;
 $_SESSION['com_825'] =0;
  $_SESSION['n_cam'] = 0;
$_SESSION['s_vol'] = 0;
$_SESSION['n_via'] = 0;
  $_SESSION['m_826'] =0;
 $_SESSION['c_803'] ="";
 $_SESSION['c_806'] ="";
 $_SESSION['c_825']="";
 $_SESSION['c_826']="";
 $_SESSION['mon_std'] =0; 
 $_SESSION['mon_ip'] =0; 
 $_SESSION['mon_vip'] =0;
 $_SESSION['descuento'] =0;
 $_SESSION['incremento'] =0;
 $_SESSION['total'] = 0;
 $_SESSION['m_850'] =0;
 $_SESSION['m_860'] =0;
 $_SESSION['v_vol'] = 0;
 
		  $con_det  = "Select * From ord_detalle where ORD_DET_ORD = $cod_ord and ORD_DET_USR_BAJA is null";
          $res_det= mysql_query($con_det)or die('No pudo seleccionarse tabla 2')  ;
          while ($lin_det = mysql_fetch_array($res_det)){
		        $det_grup =  $lin_det['ORD_DET_GRP']; 
	            if ($det_grup == 802){
				    
				    $tipo = $lin_det['ORD_DET_TIPO']; 
					if ($tipo == 3){
				        $_SESSION['can_std']=$lin_det['ORD_DET_CANT'];
						$_SESSION['dias_std']=$lin_det['ORD_DET_DIAS'];
						$_SESSION['mon_std']=$lin_det['ORD_DET_MONTO'];
					}
					if ($tipo == 1){
                        $_SESSION['can_ip']=$lin_det['ORD_DET_CANT'];
						$_SESSION['dias_ip']=$lin_det['ORD_DET_DIAS'];
						$_SESSION['mon_ip']=$lin_det['ORD_DET_MONTO'];
					}
					if ($tipo == 2){
                       $_SESSION['can_vip']=$lin_det['ORD_DET_CANT'];
					   $_SESSION['dias_vip']=$lin_det['ORD_DET_DIAS'];
					   $_SESSION['mon_vip']=$lin_det['ORD_DET_MONTO'];
                    }
					
				  } 
				    if ($det_grup == 801){
				       $_SESSION['can_801']=$lin_det['ORD_DET_CANT'];
					   $_SESSION['dias_801']=$lin_det['ORD_DET_DIAS'];
					    $_SESSION['mon_801']=$lin_det['ORD_DET_MONTO'];
					   } 
				    if ($det_grup == 804){
				       $_SESSION['can_804']=$lin_det['ORD_DET_CANT'];
					   $_SESSION['dias_804']=$lin_det['ORD_DET_DIAS'];
					    $_SESSION['mon_804']=$lin_det['ORD_DET_MONTO'];
					   } 
			if ($det_grup == 803){
			    $s_vol= $lin_det['ORD_DET_VOLT'];
	            $_SESSION['s_vol'] = $s_vol;
				$n_via= $lin_det['ORD_DET_CANT'];
				$_SESSION['n_via'] = $n_via;
				$m_803= $lin_det['ORD_DET_MONTO'];
				$_SESSION['m_803'] = $m_803;
			  } 
			if ($det_grup == 806){
			    $v_tot = $lin_det['ORD_DET_VOLT'];
	            $_SESSION['v_vol'] = $v_tot;
				$m_806= $lin_det['ORD_DET_MONTO'];
				$_SESSION['m_806'] = $m_806;      
			   } 
			if ($det_grup == 825){
			    $tipo = $lin_det['ORD_DET_VOLT'];
			
			    $con_825 = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 150 and GRAL_PAR_PRO_COD = $tipo";
                $res_825 = mysql_query($con_825)or die('No pudo seleccionarse tabla')  ;
	            while ($lin825 = mysql_fetch_array($res_825)) {
	  	               $desc1 = $lin825['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin825['GRAL_PAR_PRO_DESC'];
		     $_SESSION['serv_825'] = $desc1;
	  	}
				$n_cam= $lin_det['ORD_DET_DIAS'];
	            $_SESSION['n_cam'] = $n_cam;
				$m_825= $lin_det['ORD_DET_MONTO'];
				$_SESSION['m_825'] = $m_825; 
				 } 
			if ($det_grup == 826){
			    $m_826= $lin_det['ORD_DET_MONTO'];
			    $_SESSION['m_826'] = $m_826;
			    $com_826 = $lin_det['ORD_DET_COMEN'];
				$_SESSION['com_826'] = $com_826;
			   }  
			if ($det_grup == 860){
				$m_860= $lin_det['ORD_DET_MONTO'];
			    $_SESSION['m_860'] = $m_860;
				} 
			if ($det_grup == 850){
				$m_850= $lin_det['ORD_DET_MONTO'];
			    $_SESSION['m_850'] = $m_850;
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
		<td align="center"><strong>Nro. Días </strong></td>
		<td align="center"><strong>Monto </strong></td>
	</tr>	
	 <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2)
		                                   .$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		<td align="left"><strong>STD</strong></td>
  	    <td><input type= type="text" name="can_std" maxlength="5" size="5"
		 value="<?php echo $_SESSION['can_std']; ?>" ></td>
		<td><input type= type="text" name="dias_std" maxlength="6" size="6"
		 value="<?php echo $_SESSION['dias_std']; ?>" ></td>
		<td><input type= type="text" name="mon_std" maxlength="8" size="8" 
		 value="<?php echo $_SESSION['mon_std']; ?>" ></td>
	</tr>	
		
	<tr>	
		<td align="left"></td>
		<td align="left"><strong>I.P.</strong></td>
  	     <td><input type= type="text" name="can_ip" maxlength="5" size="5"
		 value="<?php echo $_SESSION['can_ip']; ?>" ></td>
		<td><input type= type="text" name="dias_ip" maxlength="6" size="6"
		 value="<?php echo $_SESSION['dias_ip']; ?>" ></td>
		<td><input type= type="text" name="mon_ip" maxlength="8" size="8" 
		 value="<?php echo $_SESSION['mon_ip']; ?>" ></td>
	</tr>	
	
	
	<tr>	
		<td align="left"></td>
		<td align="left"><strong>V.I.P.</strong></td>
  	     <td><input type= type="text" name="can_vip" maxlength="5" size="5"
		 value="<?php echo $_SESSION['can_vip']; ?>" ></td>
		<td><input type= type="text" name="dias_vip" maxlength="6" size="6"
		 value="<?php echo $_SESSION['dias_vip']; ?>" ></td>
		<td><input type= type="text" name="mon_vip" maxlength="8" size="8" 
		 value="<?php echo $_SESSION['mon_vip']; ?>" ></td>
	</tr>
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
		 <td><input type= type="text" name="mon_802" maxlength="8" size="8" value="<?php echo  $_SESSION['mon_801']; ?>" ></td>
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
		 <td><input type= type="text" name="mon_804" maxlength="8" size="8" value="<?php echo  $_SESSION['mon_804']; ?>" ></td>
	 </tr>
    <?php  }  ?>
	      </table>	  
	<table width="80%" align="center" border="1">	 	  
		 <?php if ($cod_ser == 803){?>
		 
		<tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		   	  <th align="left">Volumen Succionado Mt3</th>
              <td><input type="text" name="s_vol" maxlength="10" size="5" 
			      value ="<?=$_SESSION['s_vol'];?>"></td>
			  <th align="left">Nro. Viajes</th>
              <td><input type="text" name="n_via" maxlength="5" size="5" 
			      value = "<?=$_SESSION['n_via'];?>" ></td>
			   <th align="left">Monto</th>
              <td><input type="text" name="mon_803" maxlength="10"  size="10" value = "<?=$_SESSION['m_803'];?>"> </td>
			   <td><input type= type="text" name="mon_803" maxlength="8" size="8" value="<?php echo  $_SESSION['mon_803']; ?>" ></t
           ></tr> 
		  </table>
		
		<?php  }  ?>		
		 <?php if ($cod_ser == 806){?>
		   <table width="80%" align="center" border="1"> 
		<tr>
		
        <th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		<th align="left">Capacidad en Litros</th>
              <td><input type="text" name="t_806" maxlength="20" size="10" 
			       value = "<?=$_SESSION['v_vol'];?>"></td>
			
           
              <th align="left">Monto</th>
              <td><input type="text" name="mon_806" maxlength="10"  size="10" value = "<?=$_SESSION['m_806'];?>"> </td>
           
			
			</table>
		<?php  }  ?>
		<?php if ($cod_ser == 825){?>
		 <table width="80%" align="center" border="1"> 
		<tr>
		<th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		 <th align="left"> <?php echo "Tipo Succion";?><br><font color="#FF0000">
		                    <?php echo $_SESSION['serv_825'];?> </font></th>
			  <td align="left"><select name="cod_ope" size="1"  >
			  <?php
			   $con_825 = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 150 and GRAL_PAR_PRO_COD <> 0";
             $res_825 = mysql_query($con_825)or die('No pudo seleccionarse tabla');
			   while ($linope = mysql_fetch_array($res_825)) { ?>
             <option value=<?php echo $linope['GRAL_PAR_PRO_COD']; ?>>
			 <?php echo $linope['GRAL_PAR_PRO_COD'].encadenar(2)
			       .$linope['GRAL_PAR_PRO_DESC']; ?> </option>
	  	     <?php } ?> 
            </select></td>
		 <th align="left">Nro. Camaras</th>
              <td><input type="text" name="c_825" maxlength="20" size="5" 
			      value = "<?=$_SESSION['n_cam'];?>" ></td>
			
              <th align="left">Monto</th>
              <td><input type="text" name="mon_825" maxlength="10"  size="10" value = "<?=$_SESSION['m_825'];?>"> </td>
            </tr>
		</table>	
		
			<?php  }  ?>
			<?php if ($cod_ser == 826){?>
			<table width="80%" align="center" border="1">
			 <tr>
		      <th width="40%" align="left" style="font-size:12px">
			  <?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		       <th align="left">Comentario</th>
               <td><input type="text" name="com_826" maxlength="70" size="20" 
			      value = "<?=$_SESSION['com_826'];?>" ></td>
              <th align="left">Monto</th>
              <td><input type="text" name="mon_826" maxlength="10"  size="10" value = "<?=$_SESSION['m_826'];?>"> </td>
                     
            </tr>
	  	     <?php } ?> 
			 <?php }  ?>		 
      <table width="80%" align="center" border="1">	 
	  <tr>
        <th width="80%" align="left" style="font-size:14px"><?php echo "Descuento"; ?> </td>
		<td align="right"><input type= type="text" name="descuento" maxlength="12" size="15" 
		    value = "<?=$_SESSION['m_860']*-1;?>" ></td>
	 </tr>
	  <tr>
        <th width="80%" align="left" style="font-size:14px"><?php echo "Incremento"; ?> </td>
		<td align="right"><input type= type="text" name="incremento" maxlength="12" size="15"
		 value="<?=$_SESSION['m_850'];?>" ></td>
	 </tr>
 </table>
	<tr>
              <th align="left">Comentario General</th>
              <td><input type="text" name="com_825" maxlength="70"  size="70" value = ""> </td>
            </tr>
	 
	</table>
  	<center>
	<input type="submit" name="accion" value="Grab-Modi">
    <input type="submit" name="accion" value="Salir">
</form>

 <?php  } 
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
         $_SESSION['dias_std']=0;
         $_SESSION['dias_ip']=0;
          $_SESSION['dias_vip']=0; 
          $_SESSION['can_801']=0;
          $_SESSION['dias_801']=0;
          $_SESSION['mon_801']=0;
          $_SESSION['can_804']=0;
          $_SESSION['dias_804']=0;
          $_SESSION['mon_804']=0;
          $_SESSION['mon_802'] =0;
          $_SESSION['c_803_n'] ="";
          $_SESSION['c_806_n'] ="";
          $_SESSION['c_825_n']="";
          $_SESSION['c_826_n']="";
		  $_SESSION['c_803'] ="NO";
          $_SESSION['c_806'] ="NO";
          $_SESSION['c_825']="NO";
          $_SESSION['c_826']="NO";
          $_SESSION['mon_std'] =0; 
          $_SESSION['mon_ip'] =0; 
          $_SESSION['mon_vip'] =0;
		  $_SESSION['vol_803'] =0; 
 $_SESSION['via_803'] =0;
 $_SESSION['m_803'] =0; 
 $_SESSION['vol_806'] =0;
 $_SESSION['m_806'] =0; 
 $_SESSION['tip_825'] =0; 
 $_SESSION['cam_825'] =0;
 $_SESSION['m_825'] =0;
 $_SESSION['serv_825'] = ""; 
 $_SESSION['com_826'] =0;
 $_SESSION['com_825'] =0;
  $_SESSION['n_cam'] = 0;
$_SESSION['s_vol'] = 0;
$_SESSION['n_via'] = 0;
  $_SESSION['m_826'] =0;
 $_SESSION['c_803'] ="";
 $_SESSION['c_806'] ="";
 $_SESSION['c_825']="";
 $_SESSION['c_826']="";
 $_SESSION['mon_std'] =0; 
 $_SESSION['mon_ip'] =0; 
 $_SESSION['mon_vip'] =0;
 $_SESSION['descuento'] =0;
 $_SESSION['incremento'] =0;
 $_SESSION['total'] = 0;
 $_SESSION['m_850'] =0;
 $_SESSION['m_860'] =0;
 $_SESSION['v_vol'] = 0;
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
	if(isset($_POST["n_via"])){
         $n_via = strtoupper($_POST["n_via"]); 
	     $_SESSION['n_via'] = $n_via;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }     
	 } 
	//806
if(isset($_POST["t_806"])){
      $t_806= $_POST["t_806"]; 
	  $_SESSION['t_806'] = $t_806;
     //echo $fac_a;
	    
	  if(isset($_POST["mon_806"])){
         $mon_806 = $_POST["mon_806"]; 
	     $_SESSION['mon_806'] = $mon_806;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   } 
	}  	  
	
	//825
if(isset($_POST["mon_825"])){
      $t_825= $_POST["cod_ope"]; 
	  $_SESSION['cod_ope'] = $t_825;
     //echo $fac_a;
	    
	  if(isset($_POST["mon_825"])){
         $mon_825 = $_POST["mon_825"]; 
	     $_SESSION['mon_825'] = $mon_825;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   } 
	  if(isset($_POST["cod_ope"])){
      $tipo = $_POST["cod_ope"]; 
	  $_SESSION['tipo'] = $tipo;
     echo $tipo ,"*";
	  } 
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
	}
}	
//Incremento
 if ($_POST["incremento"] > 0){
    $incre = $_POST["incremento"]; 
	$_SESSION['incremento'] = $incre;
   } 
//Descuento
 if ($_POST["descuento"] > 0){
    $descue = $_POST["descuento"]; 
	$_SESSION['descuento'] = $descue;
   }
     
	  
   ?>
 <form name="form2" method="post" action="solic_retro_sol.php" onSubmit="">
<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
   
 <?php
 $consulta  = "Select * From gral_empresa ";
 $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
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
 	$cod_fpa = $_POST["cod_fpa"];
 $con_fpa  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 600 and
              GRAL_PAR_PRO_COD = $cod_fpa";
 $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla');
 while ($linfpa = mysql_fetch_array($res_fpa)) {
       $for_pag = $linfpa['GRAL_PAR_PRO_DESC'];
	   $_SESSION['for_pag'] = $for_pag;
	   $_SESSION['cod_fpa'] = $cod_fpa;
       }    
	//echo "Forma de Pago" .encadenar(2).$for_pag;    
 //operador
 $oper = $_POST["cod_ope"];
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
   	<th align="left" style="font-size:12px" style="top:auto"> <?php echo "CLIENTE/EMPRESA";?> </td>
	<td align="left" style="font-size:12px" style="top:auto"> <?php echo $_SESSION['nom_com'];?> </td>
	<th align="left" style="font-size:12px"> <?php echo "TELEFONO(S)";?> </td>
	<td align="left" style="font-size:12px"> <?php echo $_SESSION['fono']
	                       .encadenar(2).$_SESSION['celu'];?> </td>
	<th align="left" style="font-size:12px"> <?php echo "FEC.INICIO".encadenar(2). $_SESSION['fec_ini'];?> </td>
  </tr>
  <tr>
    <th align="left"> <?php echo "Factura a Nombre";?> </td>
	<td align="left" style="font-size:12px" > <?php echo $_SESSION['fac_a'];?> </td>
    <th align="left" style="font-size:12px"> <?php echo "C.I. / NIT";?> </td>
	<td align="left" style="font-size:12px"> <?php echo $_SESSION['nit'];?> </td>
	<th align="left" style="font-size:12px"> <?php echo "Hora Inicio".encadenar(6).$_SESSION['hra_ini'];?> </td>
  </tr> 
   <tr>
    <th align="left" style="font-size:12px"> <?php echo "SOLICITADO POR";?> </td>
	<td align="left" style="font-size:12px"> <?php echo $_SESSION['sol_por'];?> </td>
	<td align="center"> <?php echo encadenar(12);?> </td>
	<td align="center"> <?php echo encadenar(12);?> </td>
	<th align="left" style="font-size:12px"> <?php echo "Hora Conclu.".encadenar(3).$_SESSION['hra_fin'];?> </td>
  </tr>                                
   <tr>
    <th align="left" style="font-size:12px"> <?php echo "OPERADOR";?> </td>
	<td align="left" style="font-size:12px"> <?php echo $_SESSION['nom_ope'];?> </td>
	<td align="center"> <?php echo encadenar(12);?> </td>
	<td align="center"> <?php echo encadenar(12);?> </td>
	<td align="center"> <?php echo encadenar(12);?> </td>
  </tr>  
  <tr>
    <th align="left" style="font-size:12px"> <?php echo "AUTORIZADO POR ";?> </td>
	<td align="left" style="font-size:12px"> <?php echo encadenar(3);?> </td>
	<td align="center"> <?php echo encadenar(12);?> </td>
	<th align="left" style="font-size:12px"> <?php echo "FORMA DE PAGO";?> </td>
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
		
 
  if(($_POST['mon_std']+$_POST['mon_ip']+ $_POST['mon_vip'])>0){
     // $can_dias = $_POST['can_dias'];
	 //if ($can_dias > 0){
	 // $_SESSION['can_dias'] = $can_dias; 	  
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
		<td align="center"><strong>Nro Dias </strong></td>
		<td align="center"><strong>Monto </strong></td>
		
	 </tr>
	 <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_802']; ?> </th>  
	
	  
 <?php 
 $mon_std = 0;
  $mon_ip = 0;
   $mon_vip = 0;  
   if(isset($_POST['can_std'])){
          $can_std = $_POST['can_std'];
	      $_SESSION['can_std'] = $can_std;
	    } 
		if(isset($_POST['dias_std'])){
          $dias_std = $_POST['dias_std'];
	      $_SESSION['dias_std'] = $dias_std;
	    }    
		if(isset($_POST['mon_std'])){
          $mon_std = $_POST['mon_std'];
	      $_SESSION['mon_std'] = $mon_std;
	    } else {
		 $_SESSION['mon_std'] = 0;
		}
		
		
	  if(isset($_POST['can_ip'])){
	     $can_ip = $_POST['can_ip'];
	     $_SESSION['can_ip'] = $can_ip;
		} 
	    if(isset($_POST['dias_ip'])){
          $dias_ip = $_POST['dias_ip'];
	      $_SESSION['dias_ip'] = $dias_ip;
	    } 
		if(isset($_POST['mon_ip'])){
          $mon_ip = $_POST['mon_ip'];
	      $_SESSION['mon_ip'] = $mon_ip;
	    } 
	   if(isset($_POST['can_vip'])){
	     $can_vip = $_POST['can_vip'];
	     $_SESSION['can_vip'] = $can_vip;
		} 
	    if(isset($_POST['dias_vip'])){
          $dias_vip = $_POST['dias_vip'];
	      $_SESSION['dias_vip'] = $dias_vip;
	    } 
		if(isset($_POST['mon_vip'])){
          $mon_vip = $_POST['mon_vip'];
	      $_SESSION['mon_vip'] = $mon_vip;
	     } else {
		 $_SESSION['mon_vip'] = 0;
		}
		 
	 //if(isset($_POST["mon_802"])){
      //   $mon_802 = $_POST["mon_802"]; 
	     $_SESSION['mon_802'] = $mon_std+$mon_ip+ $mon_vip;
	//	  $_SESSION['mon_std'] =$_SESSION['mon_802']; 
	 $_SESSION['total'] =$_SESSION['total'] + $_SESSION['mon_802'];
	?> 
		<td align="left"><strong>STD</strong></td>
		<td align="center"> <?php echo  $_SESSION['can_std'];?></td>
		<td align="center"> <?php echo  $_SESSION['dias_std'];?></td>
		<?php if ($_SESSION['mon_std'] > 0){?>
		<td align="right"> <?php echo number_format($_SESSION['mon_std'], 2, '.',',') ;?></td>
		<?php  }  ?>
	</tr>	
	<tr>
	<?php if ($_SESSION['mon_ip'] > 0){?>
		<td align="left"></td>
		<td align="left"><strong>I.P.</strong></td>
  	    <td align="center"> <?php echo  $_SESSION['can_ip'];?></td>
		<td align="center"> <?php echo  $_SESSION['dias_ip'];?></td>
		<td align="right"> <?php echo number_format($_SESSION['mon_ip'], 2, '.',',') ;?></td>
		
	</tr>
	<?php  }  ?>
	<?php if ($_SESSION['mon_vip'] > 0){?>
	<tr>
	   <td align="left"></td>	
		<td align="left"><strong>V.I.P.</strong></td>
  	    <td align="center"> <?php echo  $_SESSION['can_vip'];?></td>
		<td align="center"> <?php echo  $_SESSION['dias_vip'];?></td>
		<td align="right"> <?php echo number_format($_SESSION['mon_vip'], 2, '.',',') ;?></td>
	</tr>
	<?php  }  ?>	
	 </table>
		 <?php  } 
		//      }        ?>
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
	   $_SESSION['total'] =$_SESSION['total'] + $_SESSION['mon_801'];
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
	   $_SESSION['total'] =$_SESSION['total'] + $_SESSION['mon_804'];
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
	 if ($_POST['mon_803'] > 0){
        $mon_803 = $_POST['mon_803'];
	    $_SESSION['mon_803'] = $mon_803;
	   $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 4 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
	  while ($lin803 = mysql_fetch_array($res_tser)) {
	  	     $desc1 = $lin803['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin803['GRAL_PAR_PRO_DESC'];
		     $_SESSION['desc1_803'] = $desc1;
	  	} 
		if(isset($_POST["s_vol"])){
         $s_vol= $_POST["s_vol"]; 
	     $_SESSION['s_vol'] = $s_vol;
    //  echo $sol_por;
	   }  
	    
	if(isset($_POST["n_via"])){
         $n_via = strtoupper($_POST["n_via"]); 
	     $_SESSION['n_via'] = $n_via;
	    } 
		$_SESSION['total'] =$_SESSION['total'] + $_SESSION['mon_803'];
	?>
	<table width="80%" align="center" border="1">
	  <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_803']; ?> </th>
		<th align="left">Vol. Succio.</th>
		<td width="20%" align="center" style="font-size:14px"><?php echo number_format( $_SESSION['s_vol'], 0, '.',',');?> </th>  
		 <th align="left">Nro. Viajes</th>
		<td width="20%" align="center" style="font-size:14px"><?php echo number_format( $_SESSION['n_via'], 0, '.',',');?> </th> 
		<th align="left">Monto</th>
		<td width="20%" align="right" style="font-size:14px"><?php 
		echo number_format( $_SESSION['mon_803'], 2, '.',',');?> </th>
	</tr>
	
	 <?php	
	 	 	 }   
	if($_POST['t_806'] > 0){
	  $_SESSION['total'] =$_SESSION['total'] + $_SESSION['mon_806'];
	  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 5 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
	  while ($lin806 = mysql_fetch_array($res_tser)) {
	  	     $desc1 = $lin806['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin806['GRAL_PAR_PRO_DESC'];
		     $_SESSION['desc1_806'] = $desc1;
	  	} ?>
	
	<table width="80%" align="center" border="1">
	  <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_806']; ?> </th> 
	    <th align="left">Capacidad en Litros</th>
		<td width="20%" align="right" style="font-size:14px"><?php echo number_format( $_SESSION['t_806'], 0, '.',',');?> </th> 
		<th align="left">Monto</th>
		<td width="20%" align="right" style="font-size:14px"><?php echo number_format( $_SESSION['mon_806'], 2, '.',',');?> </th>
	  </tr>
	 <?php	
	 } 
	if($_POST['mon_825'] > 0){
     $c_825 = $_POST['c_825'];
	  $_SESSION['c_825'] = $c_825;
	  $_SESSION['tipo'] = $tipo;
	//  echo $_POST['mon_825']. "c_825";
	 $con_825 = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 150 and GRAL_PAR_PRO_COD = $tipo";
             $res_825 = mysql_query($con_825)or die('No pudo seleccionarse tabla')  ;
	  while ($lin825 = mysql_fetch_array($res_825)) {
	  	     $desc1 = $lin825['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin825['GRAL_PAR_PRO_DESC'];
		     $_SESSION['serv_825'] = $desc1;
	  	}
	 $_SESSION['total'] =$_SESSION['total'] + $_SESSION['mon_825'];
	 ?>
	<table width="80%" align="center" border="1">
	  <tr>
       <th width="40%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_825']; ?> </th> 
		<th align="left">Tipo Succ.</th>
		<th width="20%" align="left" style="font-size:12px"><?php echo $_SESSION['serv_825']; ?> </th> 
	 <th align="left">Nro. Camaras</th>
              <th width="20%" align="center" style="font-size:12px"><?php echo $_SESSION['c_825']; ?> </th> 
	   <th align="left">Monto</th>
       <td width="20%" align="right" style="font-size:12px">
			 <?php echo number_format($_SESSION['mon_825'], 2, '.',','); ?> </th> 
      </tr>
	</table>
	 <?php	
	 }  
	 if ($_POST['mon_826'] > 0){
         $mon_826 = $_POST['mon_826'];
	     $_SESSION['mon_826'] = $mon_826;
		$com_826= strtoupper($_POST["com_826"]); 
	  $_SESSION['com_826'] = $com_826;
 
	 // echo $c_806. "c_826";
	 $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 7 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 2')  ; 
	  while ($lin826 = mysql_fetch_array($res_tser)) {
	  	     $desc1 = $lin826['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin826['GRAL_PAR_PRO_DESC'];
		     $_SESSION['desc1_826'] = $desc1;
	  	} 
		$_SESSION['total'] =$_SESSION['total'] + $_SESSION['mon_826'];

		?>
	<table width="80%" align="center" border="1">
	  <tr>
        <th width="30%" align="left" style="font-size:12px"><?php echo $_SESSION['desc1_826']; 
		?> </th> 
		     
             <td width="30%" align="left" style="font-size:12px">
			 <?php echo  $_SESSION['com_826'] ; ?> </th> 
		 <th width="6%" align="left">Monto</th>
             <td width="10%" align="right" style="font-size:14px">
			 <?php echo number_format($_SESSION['mon_826'], 2, '.',','); ?> </th> 
	 </tr>
	 </table>	
	 <?php	
	 	 } ?> 
	<table width="80%" align="center" border="1">	 
	  <tr>
        <th width="40%" align="left" style="font-size:14px"><?php echo "Descuento"; ?> </td>
		<td width="40%" align="right" style="font-size:14px"><?php 
		        echo number_format($_SESSION['descuento'], 2, '.',',');?> </th>
	 </tr>
	  <tr>
        <th width="40%" align="left" style="font-size:14px"><?php echo "Incremento"; ?> </td>
		<td width="40%" align="right" style="font-size:14px"><?php 
		        echo number_format( $_SESSION['incremento'], 2, '.',',');?> </th>
	 </tr>
	  <tr>
        <th width="40%" align="left" style="font-size:14px"><?php echo "Monto Total"; ?> </td>
		<td width="40%" align="right" style="font-size:14px"><?php 
		     echo number_format(( $_SESSION['total'] - $_SESSION['descuento'] + $_SESSION['incremento']), 2, '.',',');?> </th>
	 </tr>
	 
	 
 </table>
 
  <?php
 if ($_POST['com_825'] <> ""){
    $com_825= strtoupper($_POST["com_825"]); 
	$_SESSION['com_825'] = $com_825;
	?>
	<table width="80%" align="center" border="1">	 
	  <tr>
        <th width="10%" align="left" style="font-size:14px"><?php echo "Comentario"; ?> </td>
		<td width="70%" align="left" style="font-size:14px"><?php 
		        echo $_SESSION['com_825'];?> </th>
	 </tr>
<?php	
	   
  }  ?>
  </table>
   <center>
  
   <input type="submit" name="accion" value="Impr_mod">
   <input type="submit" name="accion" value="Salir">
</form>
 <?php
 
 }
          } ?>
		 
  <div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Modificar Orden de Trabajo </MARQUEE></FONT></B>
   </div>
   <?php
		 	include("footer_in.php");
		 ?> 
</body>
</html>
<?php
ob_end_flush();
 ?>