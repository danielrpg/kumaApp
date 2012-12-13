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
<title>Consulta Cronograma Diario</title>
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
 $_SESSION['calculo'] = 1; 
?> 
	</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                         Seleccione la Hora que desea Actualizar
			</div>
            <div id="AtrasBoton">
           		<a href="crono_diario
				.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0"  alt="Regresar" align="absmiddle">Atras</a>
            </div>
<font size="+1">
<?php
$hoy = date("Y-m-d");
echo $hoy;
$log_usr = $_SESSION['login']; 
$cod_cre = 0;
$f_cal = "";
$f_has ="";
$mon="";
$cod_ope=0;
$imp_ind = 0;
$imp_cta = 0;
$_SESSION['grupo'] = "";
if(isset($_POST['nope'])){
  $nope = $_POST['nope'];
  $_SESSION['nope'] = $nope;
  }
if(isset($_SESSION['fecha'])){
   $fecha = cambiaf_a_mysql($_SESSION['fecha']);
}     

$con_ope = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD = $nope";
        $res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla')  ;
		while ($lin_ope = mysql_fetch_array($res_ope)) {
		  $nom_ope = $lin_ope['GRAL_PAR_PRO_DESC'];
		}
 //   if ($_SESSION["tip_cta"] == 1) {
//	    if (isset ($_POST['nro_ope'])){ 
  //      $cod_ope = $_POST['nro_ope'];
        $con_ope  = "Select * From ord_conograma where ord_cro_fecha = '$fecha' and 
		             ord_cro_ope = $nope"; 
        $res_ope = mysql_query($con_ope)or die('No pudo seleccionarse ord_cronograma');
   while ($lin_sol = mysql_fetch_array($res_ope)) {
          $hra_6_cc[1] = $lin_sol['ord_cro_6_ccli'];
		  $hra_6_c[1] = $lin_sol['ord_cro_6_cli'];
		  $hra_6_s[1] = $lin_sol['ord_cro_6_ser'];
		  $hra_6_co[1] = $lin_sol['ord_cro_6_com'];
		  $hra_7_cc[2] = $lin_sol['ord_cro_7_ccli'];
		  $hra_7_c[2] = $lin_sol['ord_cro_7_cli'];
		  $hra_7_s[2] = $lin_sol['ord_cro_7_ser'];
		  $hra_7_co[2] = $lin_sol['ord_cro_7_com'];
		  $hra_8_cc[3] = $lin_sol['ord_cro_8_ccli'];
		  $hra_8_c[3] = $lin_sol['ord_cro_8_cli'];
		  $hra_8_s[3] = $lin_sol['ord_cro_8_ser'];
		  $hra_8_co[3] = $lin_sol['ord_cro_8_com'];
		  $hra_9_cc[4] = $lin_sol['ord_cro_9_ccli'];
		  $hra_9_c[4] = $lin_sol['ord_cro_9_cli'];
		  $hra_9_s[4] = $lin_sol['ord_cro_9_ser'];
		  $hra_9_co[4] = $lin_sol['ord_cro_9_com'];
		  $hra_10_cc[5] = $lin_sol['ord_cro_10_ccli'];
		  $hra_10_c[5] = $lin_sol['ord_cro_10_cli'];
		  $hra_10_s[5] = $lin_sol['ord_cro_10_ser'];
		  $hra_10_co[5] = $lin_sol['ord_cro_10_com'];
		  $hra_11_cc[6] = $lin_sol['ord_cro_11_ccli'];
		  $hra_11_c[6] = $lin_sol['ord_cro_11_cli'];
		  $hra_11_s[6] = $lin_sol['ord_cro_11_ser'];
		  $hra_11_co[6] = $lin_sol['ord_cro_11_com'];
		  $hra_12_cc[7] = $lin_sol['ord_cro_12_ccli'];
		  $hra_12_c[7] = $lin_sol['ord_cro_12_cli'];
		  $hra_12_s[7] = $lin_sol['ord_cro_12_ser'];
		  $hra_12_co[7] = $lin_sol['ord_cro_12_com'];
		  $hra_13_cc[8] = $lin_sol['ord_cro_13_ccli'];
		  $hra_13_c[8] = $lin_sol['ord_cro_13_cli'];
		  $hra_13_s[8] = $lin_sol['ord_cro_13_ser'];
		  $hra_13_co[8] = $lin_sol['ord_cro_13_com'];
		  $hra_14_cc[9] = $lin_sol['ord_cro_14_ccli'];
		  $hra_14_c[9] = $lin_sol['ord_cro_14_cli'];
		  $hra_14_s[9] = $lin_sol['ord_cro_14_ser'];
		  $hra_14_co[9] = $lin_sol['ord_cro_14_com'];
		  $hra_15_cc[10] = $lin_sol['ord_cro_15_ccli'];
		  $hra_15_c[10] = $lin_sol['ord_cro_15_cli'];
		  $hra_15_s[10] = $lin_sol['ord_cro_15_ser'];
		  $hra_15_co[10] = $lin_sol['ord_cro_15_com'];
		  $hra_16_cc[11] = $lin_sol['ord_cro_16_ccli'];
		  $hra_16_c[11] = $lin_sol['ord_cro_16_cli'];
		  $hra_16_s[11] = $lin_sol['ord_cro_16_ser'];
		  $hra_16_co[11] = $lin_sol['ord_cro_16_com'];
		  $hra_17_cc[12] = $lin_sol['ord_cro_17_ccli'];
		  $hra_17_c[12] = $lin_sol['ord_cro_17_cli'];
		  $hra_17_s[12] = $lin_sol['ord_cro_17_ser'];
		  $hra_17_co[12] = $lin_sol['ord_cro_17_com'];
		  $hra_18_cc[13] = $lin_sol['ord_cro_18_ccli']; 
		  $hra_18_c[13] = $lin_sol['ord_cro_18_cli'];
		  $hra_18_s[13] = $lin_sol['ord_cro_18_ser'];
		  $hra_18_co[13] = $lin_sol['ord_cro_18_com'];
		}
 ?>
 <form name="form2" method="post" action="solic_retro_sol.php" style="border:groove" onSubmit="return ValidaCamposClientes(this)"> 
 <?php
   echo $nom_ope;
 ?>
 <div id="TableModulo">
 <table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="22%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />HORA</th>
	  <th width="25%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />CLIENTE</th>
      <th width="20%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />SERVICIO</th>
      <th width="25%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />COMENTARIO</th>
	
	  <th width="20%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />CAL</th>
	  </tr>
	
   <?php
  /* while ($lin_cli = mysql_fetch_array($res_cli)){
          $mon_pag = 0;
          $cod_ncre = $lin_cli['CART_DEU_NCRED'];
		  
		  $mon_pag = montos_recuperados($cod_ncre,$fec,1); 
	if ($_SESSION['cart_fgar'] == 1){  
	  $con_car  = "Select * From cart_maestro where CART_NRO_CRED = $cod_ncre and
	               CART_ESTADO  < 9 and CART_MAE_USR_BAJA is null";
	}	
	if ($_SESSION['cart_fgar'] == 3){  
	  $con_car  = "Select * From cart_maestro where CART_NRO_CRED = $cod_ncre and
	               CART_ESTADO  = 9 and CART_FCH_CAN is not null
				   and CART_MAE_USR_BAJA is null";
	}			    
      $res_car = mysql_query($con_car)or die('No pudo seleccionarse solicitud 2');
          
	  while ($lin_car = mysql_fetch_array($res_car)) {
	        $nom_grp = " ";
	  
	        $cod_sol = $lin_car['CART_NRO_SOL']; 
		    $impo = $lin_car['CART_IMPORTE'];
		    $mon = $lin_car['CART_COD_MON'];
		    $tint = $lin_car['CART_TASA'];
			$tope = $lin_car['CART_TIPO_OPER'];
		    $plzm = $lin_car['CART_PLZO_M'];
		    $plzd = $lin_car['CART_PLZO_D'];
		    $cuotas = $lin_car['CART_NRO_CTAS'];
		    $c_int = $lin_car['CART_CAL_INT'];
		    $est =  $lin_car['CART_ESTADO'];
			$f_pag = $lin_car['CART_FORM_PAG'];
		    $ahod = $lin_car['CART_AHO_DUR'];
		    $f_des = $lin_car['CART_FEC_DES'];
		    $f_uno = $lin_car['CART_FEC_UNO'];
		    $c_agen = $lin_car['CART_COD_AGEN'];
			$c_grup = $lin_car['CART_COD_GRUPO'];
			$t_prod = $lin_car['CART_PRODUCTO'];
			$t_cred = $lin_car['CART_TIPO_CRED'];
			$asesor = $lin_car['CART_OFIC_RESP'];
			$f_des2= cambiaf_a_normal($f_des); 
		    $nom_ases = leer_nombre_usr($t_cred,$asesor);
		     $_SESSION['mon'] = $mon;
			$con_deu  = "Select * From cart_deudor, cliente_general
             where CART_DEU_NCRED = $cod_ncre
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null "; 
             $res_deu = mysql_query($con_deu)or die('No pudo seleccionarse cart_deudor, cliente_general');
             while ($lin_deu = mysql_fetch_array($res_deu)) {
			       // $c_grup = 0;
					//$nom_ases = "";
	                $nom_cli = $lin_deu['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_deu['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_deu['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_deu['CLIENTE_NOMBRES'].encadenar(1); 
		
		}
			 
			 
	//	echo $t_cred; 
			 
			 
			 
		   if ($t_cred == 1) { 
		      $cod_sold = $lin_cli['CART_DEU_SOL'];
		      $f_uno2= cambiaf_a_normal($f_uno);
			  
		      $con_sol  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sold and CRED_DEU_INTERNO = $cod_cli
		               and CRED_DEU_USR_BAJA is null"; 
              $res_sol = mysql_query($con_sol)or die('No pudo seleccionarse cred_deudor');
		      while ($lin_csol = mysql_fetch_array($res_sol)){
		         $imp_ind = $lin_csol ['CRED_DEU_IMPORTE'];          
				 }
		      $con_cta  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sold and CRED_PLD_COD_CLI = $cod_cli
		               and CRED_PLD_NRO_CTA = 1 and CRED_PLD_USR_BAJA is null"; 
              $res_cta = mysql_query($con_cta)or die('No pudo seleccionarse cred_plandp');
		      while ($lin_cta = mysql_fetch_array($res_cta)){
		         $imp_cta = $lin_cta['CRED_PLD_CAPITAL'] + $lin_cta['CRED_PLD_INTERES'] + $lin_cta['CRED_PLD_AHORRO'];          		 } 
			 $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
             $res_cin = mysql_query($con_cin)or die('No pudo seleccionarse tabla 4')  ;
	         while ($linea = mysql_fetch_array($res_cin)) {
	               $d_cin = $linea['GRAL_PAR_INT_DESC'];
	             }
		      }
                
			 
		$con_dpro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $t_prod";
        $res_dpro = mysql_query($con_dpro)or die('No pudo seleccionarse tabla 5');
        while ($lin_dpro = mysql_fetch_array($res_dpro)) {
               $d_pro = $lin_dpro['GRAL_PAR_PRO_DESC']; 
	     }
		$con_dope  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tope";
        $res_dope = mysql_query($con_dope)or die('No pudo seleccionarse tabla 6');
        while ($lin_dope = mysql_fetch_array($res_dope)) {
               $d_ope = $lin_dope['GRAL_PAR_INT_DESC']; 
	     }
		if ($c_grup > 0){      
		$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			}	
		}	
				 
		}	
		$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $est";
        $res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla');
	      while ($linea = mysql_fetch_array($res_est)) {
	             $d_est = $linea['GRAL_PAR_PRO_DESC'];
	             $s_est =  $linea['GRAL_PAR_PRO_SIGLA'];
	         }  
			 
       $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 3')  ;
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
      
  $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 5')  ;
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
				
		  }
	//echo "aaaaquiii".$cod_ncre.$t_prod;
	*/	
	//for ($x=1; $x < 14; $x = $x + 1 ) {
	  	?>
		       <?php //if ($t_prod == 1){ ?>
			   <tr>
			        <td bgcolor="#66CCFF"><?php echo " 6 a.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_6_c[1]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_6_s[1]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_6_co[1]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 1; ?>">	</td> 
               </tr>  
               <tr>
			        <td bgcolor="#66CCFF"><?php echo " 7 a.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_7_c[2]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_7_s[2]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_7_co[2]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 2; ?>">	</td> 
               </tr>
			   <tr>
			        <td bgcolor="#66CCFF"><?php echo " 8 a.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_8_c[3]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_8_s[3]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_8_co[3]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 3; ?>">	</td> 
               </tr> 
			   <tr>
			        <td bgcolor="#66CCFF"><?php echo " 9 a.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_9_c[4]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_9_s[4]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_9_co[4]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 4; ?>">	</td> 
               </tr>
			   <tr>
			        <td bgcolor="#66CCFF"><?php echo " 10 a.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_10_c[5]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_10_s[5]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_10_co[5]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 5; ?>">	</td> 
               </tr>
			    <tr>
			        <td bgcolor="#66CCFF"><?php echo " 11 a.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_11_c[6]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_11_s[6]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_11_co[6]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 6; ?>">	</td> 
               </tr>
			   			    <tr>
			        <td bgcolor="#66CCFF"><?php echo " 12 a.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_12_c[7]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_12_s[7]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_12_co[7]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 7; ?>">	</td> 
               </tr>
			    <tr>
			        <td bgcolor="#66CCFF"><?php echo " 1 p.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_13_c[8]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_13_s[8]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_13_co[8]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 8; ?>">	</td> 
               </tr>
			    <tr>
			        <td bgcolor="#66CCFF"><?php echo " 2 p.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_14_c[9]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_14_s[9]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_14_co[9]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 9; ?>">	</td> 
               </tr>
			    <tr>
			        <td bgcolor="#66CCFF"><?php echo " 3 p.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_15_c[10]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_15_s[10]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_15_co[10]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 10; ?>">	</td> 
               </tr>
			    <tr>
			        <td bgcolor="#66CCFF"><?php echo " 4 p.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_16_c[11]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_16_s[11]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_16_co[11]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 11; ?>">	</td> 
               </tr>
			      <tr>
			        <td bgcolor="#66CCFF"><?php echo " 5 p.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_17_c[12]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_17_s[12]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_17_co[12]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 12; ?>">	</td> 
               </tr>
			      <tr>
			        <td bgcolor="#66CCFF"><?php echo " 6 p.m."; ?></td>
			       	<td bgcolor="#66CCFF"><?php echo $hra_18_c[13]; ?></td>
					<td bgcolor="#66CCFF"><?php echo $hra_18_s[13]; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $hra_18_co[13]; ?></td>
                    
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo 13; ?>">	</td> 
               </tr>
					<?php // }?>
				 <?php /* if ($t_prod == 2){ ?>
				    <td bgcolor="#FFFF33"><?php echo $cod_ncre; ?></td>
					<td bgcolor="#FFFF33"><?php echo $nom_cli; ?></td>
                    <td bgcolor="#FFFF33"><?php echo $nom_grp; ?></td>
                    <td bgcolor="#FFFF33"><?php echo number_format($impo, 2, '.',',');  ?></td>
					<td bgcolor="#FFFF33"><?php echo number_format($impo - $mon_pag, 2, '.',',');  ?></td>
					<td bgcolor="#FFFF33" ><?php echo $d_mon; ?></td>
					<td bgcolor="#FFFF33"><?php echo $s_est;  ?></td>
                    <td bgcolor="#FFFF33"><?php echo $d_ope; ?></td>
					<td bgcolor="#FFFF33" ><?php echo $nom_ases; ?></td>
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>"></td>  
					<?php }?>
					<?php if ($t_prod == 3){ ?>
					<td bgcolor="#66CC66"><?php echo $cod_ncre; ?></td>
					 <td bgcolor="#66CC66"><?php echo $nom_cli; ?></td>
                    <td bgcolor="#66CC66"><?php echo $nom_grp; ?></td>
                    <td bgcolor="#66CC66"><?php echo number_format($impo, 2, '.',',');  ?></td>
					<td bgcolor="#66CC66"><?php echo number_format($impo - $mon_pag, 2, '.',',');  ?></td>
					<td bgcolor="#66CC66" ><?php echo $d_mon; ?></td>
					<td bgcolor="#66CC66"><?php echo $s_est;  ?></td>
                    <td bgcolor="#66CC66"><?php echo $d_ope; ?></td>
					<td bgcolor="#66CC66" ><?php echo $nom_ases; ?></td>
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>"></td> 
					<?php } */
					//echo $_SESSION['cargo']."cargo";?>		
					
		</font>			
	 </tr>
                  <?php //}?>
               
                </table>
            </div id="TableModulo2">
<?php // if ($_SESSION['cargo'] == 4){ ?>			
	
	<input type="submit" name="accion" value="Alta">
	<input type="submit" name="accion" value="Modificar">
	<input type="submit" name="accion" value="Eliminar">
    <input type="submit" name="accion" value="Salir">
	  <?php //}?>
</form>			
            <?php
		 	include("footer_in.php");
		 ?>
	</div>
</body>
</html>
<?php
    ob_end_flush();
 ?>