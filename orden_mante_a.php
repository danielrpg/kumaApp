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
<title>Mantenimiento Orden de Trabajo</title>
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
               Alta Orden de Trabajo
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>

<?php
$_SESSION['fech_sera']="";	
$_SESSION['servicios']="";
$_SESSION['impo_sera']=0;	
$_SESSION['com']="";
$servicios = "";
	$com = "";
	$fech_sera = "";
	$impo_sera = 0;		
if(isset($_POST['cod_cliente'])){ 
   //$quecom = $_POST['cod_cliente'];
//   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 //     if( isset($quecom[$i]) ) {
         $cod_cli = $_POST['cod_cliente'];
		 $_SESSION['cod_cli'] =  $cod_cli;
  //       }
   //   }
	}else{
         $cod_cli = $_SESSION['cod_cli']; 
}
$con_cli = "Select * From cliente_general where CLIENTE_COD = $cod_cli and CLIENTE_USR_BAJA is null";
$res_cli = mysql_query($con_cli)or die('No pudo seleccionarse tabla cliente_general')  ;
while ($linea = mysql_fetch_array($res_cli)){
$tip_viv = $linea['CLIENTE_VIVIEN'];
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
if(isset($_SESSION["continuar"])){
     if($_SESSION["continuar"] == 1){
?>
<center>
 <table width="90%"  border="2" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="8%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>CODIGO</th>
	  <th width="10%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>CLIENTE</th>
      <th width="8%" scope="col" style="font-size:10px"><border="0" alt="" align="center"/>TEL. FIJO</th>
      <th width="8%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />TEL.CELULAR</th>
	 
		 
	  </tr>
	  
	  	<td bgcolor="#66CCFF" style="top:auto" style="font-size:12px"><?php echo $_SESSION['cod_cli']; ?></td>
		<td bgcolor="#66CCFF" style="text-align:justify" style="font-size:12px" ><?php echo $_SESSION['nom_com']; ?></td>
        <td bgcolor="#66CCFF" style="top:auto" style="font-size:12px"><?php echo $_SESSION['fono']; ?></td>
        <td bgcolor="#66CCFF" style="top:auto" style="font-size:12px"><?php echo $_SESSION['celu'];  ?></td>
		
					
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
}
}

//Servicios anteriores
$fech_sera = "";
$con_sera = "Select * From ord_maestro where ORD_COD_CLI = $cod_cli
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
          $res_serv= mysql_query($con_serv)or die('No pudo seleccionarse tabla ord_detalle');	
	 while ($lin_serv = mysql_fetch_array($res_serv)){
	      $cod_serv = $lin_serv['ORD_DET_GRP'];
		  $comen = $lin_serv['ORD_DET_COMEN'];
		  $impo = $lin_serv['ORD_DET_MONTO'];
		  
		  $servicios = $servicios.encadenar(2).$cod_serv;
		  $com = $com.encadenar(1).$comen;
		  $impo_sera = $impo_sera + $impo;
		   }	  
	}
if ($impo_sera > 0){	
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


//
$con_tse  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD <> 0 order by 2 ";
$res_tse = mysql_query($con_tse)or die('No pudo seleccionarse tabla')  ;

$con_ope = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and (GRAL_PAR_PRO_COD > 0
            and GRAL_PAR_PRO_COD < 10)";
$res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla')  ;
$con_fpa  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 600 and GRAL_PAR_PRO_COD <> 0 ";
$res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla')  ;

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
 if(isset($_SESSION["continuar"])){
     if($_SESSION["continuar"] == 1){
 ?> 
 </font>
  </strong>
  
 <form name="form2" method="post" action="solic_retro_sol.php" onSubmit="return ValidarCamposOrden(this)">
 <table width="80%" align="center" border="1">
           <tr>
 		      <th align="left">Solicitado Por</th>
              <td><input type="text" name="sol_por" maxlength="35" size="30" ></td>
			  <?php if  ($tip_viv == 1){?>
			    <th align="left">Fec. Recordar</th>
              <td><input type="text" name="fec_rec" maxlength="10"  size="10" > <script language="JavaScript">
                  new tcal ({
                  // form name
                  'formname': 'form2',
                  // input name
                  'controlname': 'fec_rec'
                  });
                  </script>
	          </td>
			  <?php }?>
           </tr> 
		    <tr>
 		      <th align="left">Factura a nombre de</th>
              <td><input type="text" name="fac_a" maxlength="35" size="35" 
			       value = "<?php echo $_SESSION['nom_com']; ?>"></td>
			  <th align="left">Nit Nº</th>
              <td><input type="text" name="nit" maxlength="15" size="15" 
			      value = "<?php echo $_SESSION['ci']; ?>" ></td>
           </tr> 
           <tr>
              <th align="left">Fec. Solicitud Serv.</th>
              <td><input type="text" name="fec_des" maxlength="10"  size="10" > <script language="JavaScript">
                  new tcal ({
                  // form name
                  'formname': 'form2',
                  // input name
                  'controlname': 'fec_des'
                  });
                  </script>
	          </td>
           
              <th align="left">Fec. Inicio Serv.</th>
              <td><input type="text" name="fec_uno" maxlength="10"  size="10" > <script language="JavaScript">
                  new tcal ({
                  // form name
                  'formname': 'form2',
                  // input name
                  'controlname': 'fec_uno'
                  });
                  </script>
	          </td>
            </tr>
			<tr>
              <td align="left">Hra. Inicio</td>
			  <td><input type= type="text" name="hra_ini" maxlength="8" size="8" value="" ></td>
			  <td align="left">Hra. Final </td>
			  <td><input type= type="text" name="hra_fin" maxlength="8" size="8" value="" ></td>
			 </tr>
			 <tr>
              <td align="left"><strong>Forma de Pago </strong> </td>
			  <td align="left"><select name="cod_fpa" size="1"  >
			  <?php while ($linfpa = mysql_fetch_array($res_fpa)) { ?>
             <option value=<?php echo $linfpa['GRAL_PAR_PRO_COD']; ?>>
			 <?php echo $linfpa['GRAL_PAR_PRO_DESC']; ?> </option>
	  	     <?php } ?> 
            </select></td>
		   </tr>
		   <tr>
              <th align="left">Operador</th>
			  <td align="left"><select name="cod_ope" size="1"  >
			  <?php while ($linope = mysql_fetch_array($res_ope)) { ?>
             <option value=<?php echo $linope['GRAL_PAR_PRO_COD']; ?>>
			 <?php echo $linope['GRAL_PAR_PRO_COD'].encadenar(2).$linope['GRAL_PAR_PRO_DESC']; ?> </option>
	  	     <?php } ?> 
            </select></td>
		   </tr>
		 </table>
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
  	    <td><input type= type="text" name="can_std" maxlength="5" size="5" value="" ></td>
		<td><input type= type="text" name="dias_std" maxlength="6" size="6" value="" ></td>
		<td><input type= type="text" name="mon_std" maxlength="8" size="8" value="" ></td>
	</tr>
	<tr>
	    <td align="center"></td>	
		<td align="left"><strong>I.P.</strong></td>
  	    <td><input type= type="text" name="can_ip" maxlength="5" size="5" value="" ></td>
		<td><input type= type="text" name="dias_ip" maxlength="6" size="6" value="" ></td>
		<td><input type= type="text" name="mon_ip" maxlength="8" size="8" value="" ></td>
	</tr>
	    <td align="center"></td>		
		<td align="left"><strong>V.I.P.</strong></td>
  	    <td><input type= type="text" name="can_vip" maxlength="5" size="5" value="" ></td>
		 <td><input type= type="text" name="dias_vip" maxlength="6" size="6" value="" ></td>
		 <td><input type= type="text" name="mon_vip" maxlength="8" size="8" value="" ></td>
		 <?php  }  ?>
		 </table>
		 <table width="80%" align="center" border="1">	 
		 <?php if ($cod_ser == 801){?>
		   
    <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2)
		                              .$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		<td align="center"><strong>Cantidad</strong></td>
		<td><input type= type="text" name="can_801" maxlength="8" size="8" value="" ></td>
		<td align="center"><strong>Nro. Dias </strong></td>
		<td><input type= type="text" name="dias_801" maxlength="8" size="8" value="" ></td>
		<td><input type= type="text" name="mon_801" maxlength="8" size="8" value="" ></td>
	 </tr>
    <?php  }  ?>
	<?php if ($cod_ser == 804){?>
		    
    <tr>
        <th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2)
		                              .$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		<td align="center"><strong>Cantidad</strong></td>
		<td><input type= type="text" name="can_804" maxlength="8" size="8" value="" ></td>
		<td align="center"><strong>Nro. Dias </strong></td>
		<td><input type= type="text" name="dias_804" maxlength="8" size="8" value="" ></td>
		<td><input type= type="text" name="mon_804" maxlength="8" size="8" value="" ></td>
	 </tr>
    <?php  }  ?>
	      </table>
		  	  
	 <table width="80%" align="center" border="1">	  
		 <?php if ($cod_ser == 803){?>
		  <table width="80%" align="center" border="1">     
		    <tr>
			   <th width="40%" align="left" style="font-size:12px">
			   <?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin_tse['GRAL_PAR_PRO_DESC'];?> </td>
 		     
			  <th align="left">Volumen Succionado Mt3</th>
              <td><input type="text" name="s_vol" maxlength="10" size="5" 
			      value = "" ></td>
			  <th align="left">Nro. Viajes</th>
              <td><input type="text" name="n_via" maxlength="5" size="5" 
			      value = "" ></td>
			   <th align="left">Monto</th>
              <td><input type="text" name="mon_803" maxlength="10"  size="10" value = ""> </td>
           </tr> 
		  </table>
		<tr>
     <?php  }  ?>		
		 <?php if ($cod_ser == 806){?>
		  <table width="80%" align="center" border="1"> 
		   <th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>    
		   
 		      <th align="left">Capacidad en Litros</th>
              <td><input type="text" name="t_806" maxlength="20" size="10" 
			       value = ""></td>
			
           
              <th align="left">Monto</th>
              <td><input type="text" name="mon_806" maxlength="10"  size="10" value = ""> </td>
           
			
			</table>
		<tr>
       
		
		<?php  }  ?>
		<?php if ($cod_ser == 825){
		       $con_825 = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 150 and GRAL_PAR_PRO_COD <> 0";
             $res_825 = mysql_query($con_825)or die('No pudo seleccionarse tabla')  ;
		?>
		</table>
			<table width="80%" align="center" border="1">
		<th width="40%" align="left" style="font-size:12px"><?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		 <th align="left">Tipo Succion</th>
			  <td align="left"><select name="tipo" size="1"  >
			  <?php while ($linope = mysql_fetch_array($res_825)) { ?>
             <option value=<?php echo $linope['GRAL_PAR_PRO_COD']; ?>>
			 <?php echo $linope['GRAL_PAR_PRO_COD'].encadenar(2).$linope['GRAL_PAR_PRO_DESC']; ?> </option>
	  	     <?php } ?> 
            </select></td>
		 <th align="left">Nro. Camaras</th>
              <td><input type="text" name="c_825" maxlength="20" size="5" 
			      value = "" ></td>
			
              <th align="left">Monto</th>
              <td><input type="text" name="mon_825" maxlength="10"  size="10" value = ""> </td>
            </tr>
		</table>	
			
			
		
		
		
		
		
		
			<?php  }  ?>
			<?php if ($cod_ser == 826){?>
		<table width="80%" align="center" border="1">	
		<th width="40%" align="left" style="font-size:12px">
		<?php echo $lin_tse['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin_tse['GRAL_PAR_PRO_DESC']; ?> </td>
		       <th align="left">Comentario</th>
               <td><TEXTAREA cols="20" rows="2" name="com_826"></TEXTAREA> </td>
              <th align="left">Monto</th>
              <td><input type="text" name="mon_826" maxlength="10"  size="10" value = ""> </td>
                     
            </tr>
	  	     <?php } ?> 
      </tr>
	  </table>
	  
	  <?php  }  ?>
	  <table width="80%" align="center" border="1">	 
	  <tr>
        <th width="80%" align="left" style="font-size:14px"><?php echo "Descuento"; ?> </td>
		<td><input type= type="text" name="descuento" maxlength="12" size="15" value="0" ></td>
	 </tr>
	  <tr>
        <th width="80%" align="left" style="font-size:14px"><?php echo "Incremento"; ?> </td>
		<td><input type= type="text" name="incremento" maxlength="12" size="15" value="0" ></td>
	 </tr>
 </table>
	<tr>
              <th align="left">Comentario General</th>
              <td><input type="text" name="com_825" maxlength="70"  size="70" value = ""> </td>
            </tr>
  	<center>
	<input type="submit" name="accion" value="Calculo">
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
$_SESSION['mon_std']=0;
 $_SESSION['mon_ip']=0;
$_SESSION['mon_vip']=0; 
 $_SESSION['can_801']=0;
 $_SESSION['dias_801']=0;
 $_SESSION['mon_801']=0;
 $_SESSION['can_804']=0;
 $_SESSION['dias_804']=0;
 $_SESSION['mon_804']=0;
 $_SESSION['mon_802'] =0;
 $_SESSION['vol_803'] =0; 
 $_SESSION['via_803'] =0;
 $_SESSION['mon_803'] =0; 
 $_SESSION['vol_806'] =0;
 $_SESSION['mon_806'] =0; 
 $_SESSION['tip_825'] =0; 
 $_SESSION['cam_825'] =0;
 $_SESSION['mon_825'] =0;
 $_SESSION['com_826'] =0;
 $_SESSION['tipo'] =0;
$_SESSION['s_vol'] = 0;
$_SESSION['n_via'] = 0;
  $_SESSION['mon_826'] =0;
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
	   if(isset($_POST["fec_rec"])){
      $fec_rec = $_POST["fec_rec"]; 
	  $_SESSION['fec_rec'] = $fec_rec;
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
      $tipo= $_POST["tipo"]; 
	  $_SESSION['tipo'] = $tipo;
     //echo $fac_a;
	    
	  if(isset($_POST["mon_825"])){
         $mon_825 = $_POST["mon_825"]; 
	     $_SESSION['mon_825'] = $mon_825;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   } 
	  if(isset($_POST["c_825"])){
      $c_825 = $_POST["c_825"]; 
	  $_SESSION['c_825'] = $c_825;
    // echo $tipo ,"*";
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
	 <?php if(isset($_SESSION["fec_rec"])){?>
	  <th align="left" style="font-size:12px"> <?php echo "RECORDAR";?> </td>
	<td align="left" style="font-size:12px"> <?php echo $_SESSION['fec_rec'];?> </td>
	 <?php }else{?>
	<td align="center"> <?php echo encadenar(12);?> </td>
	<td align="center"> <?php echo encadenar(12);?> </td>
     <?php }?>	
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
 $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 1')  ; 
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
 $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 3')  ; 
 while ($lin804 = mysql_fetch_array($res_tser)) {
	    $desc1 = $lin804['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin804['GRAL_PAR_PRO_DESC'];
	    $_SESSION['desc1_804'] = $desc1;
	  }
  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 4 ";
  $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 4')  ; 
  while ($lin803 = mysql_fetch_array($res_tser)) {
  	     $desc1 = $lin803['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin803['GRAL_PAR_PRO_DESC'];
	     $_SESSION['desc1_803'] = $desc1;
	  	}
  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 5 ";
  $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 5')  ; 
  while ($lin806 = mysql_fetch_array($res_tser)) {
  	     $desc1 = $lin806['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin806['GRAL_PAR_PRO_DESC'];
	     $_SESSION['desc1_806'] = $desc1;
  	}	
  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 6 ";
  $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 6')  ; 
  while ($lin825 = mysql_fetch_array($res_tser)) {
  	     $desc1 = $lin825['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin825['GRAL_PAR_PRO_DESC'];
	     $_SESSION['desc1_825'] = $desc1;
	  	}
  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 7 ";
  $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 7')  ; 
  while ($lin826 = mysql_fetch_array($res_tser)) {
	     $desc1 = $lin826['GRAL_PAR_PRO_CTA1'].encadenar(2).$lin826['GRAL_PAR_PRO_DESC'];
	     $_SESSION['desc1_826'] = $desc1;
		}		 
		
 
  if(($_POST['mon_std']+$_POST['mon_ip']+ $_POST['mon_vip'])>0){
  //    $can_dias = $_POST['can_dias'];
//	 if ($can_dias > 0){
	//  $_SESSION['can_dias'] = $can_dias; 	  
	  $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 1 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 8')  ; 
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
	     $_SESSION['mon_802'] = $_SESSION['mon_std']+$_SESSION['mon_ip']+ $_SESSION['mon_vip'];
	//	  $_SESSION['mon_std'] =$_SESSION['mon_802']; 
	//	   $_SESSION['mon_ip'] =$_SESSION['mon_802'];
	//	    $_SESSION['mon_vip'] =$_SESSION['mon_802'];
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	  // }
	//$_SESSION['mon_802'] = $mon_std + $mon_ip + $mon_vip;
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
		 //     }        ?>
		<?php
	 if(isset($_POST['can_801'])){
	   
	  $mon_801 = 0;
	  $can_801 = $_POST['can_801'];
	 if ($can_801 > 0){    
	  $_SESSION['can_801'] = $can_801;
	  $dias_801 = $_POST['dias_801'];
	  $_SESSION['dias_801'] = $dias_801;
	   $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 801 and GRAL_PAR_PRO_COD = 1 ";
         $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 12'); 
		  while ($lin801 = mysql_fetch_array($res_tser)) {
                $imp_801 = $lin801['GRAL_PAR_PRO_CTA1'];
          }
	 // $mon_801 = ($can_801 * $imp_801) * $dias_801;
	  if(isset($_POST["mon_801"])){
         $mon_801 = $_POST["mon_801"]; 
	     $_SESSION['mon_801'] = $mon_801;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }
	  
	//	  $_SESSION['mon_801'] = $mon_801;
	   $_SESSION['total'] =$_SESSION['total'] + $_SESSION['mon_801'];
	 $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 2 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 13')  ; 
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
         $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 14'); 
		  while ($lin804 = mysql_fetch_array($res_tser)) {
                $imp_804 = $lin804['GRAL_PAR_PRO_CTA1'];
          }
		  if(isset($_POST["mon_804"])){
         $mon_804 = $_POST["mon_804"]; 
	     $_SESSION['mon_804'] = $mon_804;
	   //  $fec_fac = cambiaf_a_mysql($fec_ord);
     // echo $fec_ord;
	   }
	//  $mon_804 = ($can_804 * $imp_804) * $dias_804;
	  $_SESSION['mon_804'] = $mon_804;
	   $_SESSION['total'] =$_SESSION['total'] + $_SESSION['mon_804'];
	 $con_tser  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 800 and GRAL_PAR_PRO_COD = 3 ";
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 15')  ; 
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
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 16')  ; 
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
             $res_825 = mysql_query($con_825)or die('No pudo seleccionarse tabla 17')  ;
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
      $res_tser = mysql_query($con_tser)or die('No pudo seleccionarse tabla 18')  ; 
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
  
   <input type="submit" name="accion" value="Grabar">
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