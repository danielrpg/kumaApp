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
<title>Mantenimiento Clientes</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
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
                 	Lista de clientes para Modificar
            </div>
            <div id="AtrasBoton">
           		<a href="cliente_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
<?php
$consul = 0;
$comb = 0;

if(isset($_POST["cod"])){
   $cod_cli =$_POST["cod"];
   }
if(isset($log_usr)){ 
  $log_usr = strtolower($log_usr);
  }
if (empty($cod_cli)) {
    $consul = $consul + 1;
	} else {
	 $consulta  = "Select * From cliente_general where CLIENTE_COD = $cod_cli and CLIENTE_USR_BAJA is null order by 9,8";
}
if(isset($_POST["ci"])){ 
  $c_i = $_POST["ci"];
  }
if (empty($c_i)) {
   $consul = $consul + 1;
   } else {
   $c_i =  "%".$c_i."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_COD_ID like '$c_i' and CLIENTE_USR_BAJA is null order by 9,8";
}
if(isset($_POST["nombres"])){ 
   $nom = $_POST["nombres"];
   $comb = $comb + 1;
 }
if (empty($nom)) {
     $consul = $consul + 1;
	} else {
	 $nom =  "%".strtoupper($nom)."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_NOMBRES like '$nom' and CLIENTE_USR_BAJA is null order by 9,8"; 
}
if(isset($_POST["ap_pater"])){ 
   $a_pat = $_POST["ap_pater"];
   $comb = $comb + 1;
   }
if (empty($a_pat)) {
    $consul = $consul + 1;
    } else {
	$a_pat = "%".strtoupper($a_pat)."%";
	
	$consulta  = "Select * From cliente_general where CLIENTE_AP_PATERNO like '$a_pat' and CLIENTE_USR_BAJA is null order by 9,8"; 
} 
if ($comb == 2){
     $nom =  "%".strtoupper($nom)."%";
	 $a_pat = "%".strtoupper($a_pat)."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_NOMBRES like '$nom' and CLIENTE_AP_PATERNO like '$a_pat'
	               and CLIENTE_USR_BAJA is null order by 9,8"; 

}
if(isset($_POST["ap_mater"])){ 
  $a_mat = $_POST["ap_mater"]; 
  }
if (empty($a_mat)) {
    $consul = $consul + 1; 
    } else {
	$a_mat = "%".strtoupper ($a_mat)."%"; 
	$consulta  = "Select * From cliente_general where CLIENTE_AP_MATERNO like '$a_mat' and CLIENTE_USR_BAJA is null order by 9,8 ";
} 
if(isset($_POST["ap_espos"])){ 
   $a_esp = $_POST["ap_espos"]; 
   }
if (empty($a_esp)) {
    $consul = $consul + 1; 
    } else {
	$a_esp = "%".strtoupper ($a_esp)."%"; 
	$consulta  = "Select * From cliente_general where CLIENTE_AP_ESPOSO like '$a_esp' and CLIENTE_USR_BAJA is null order by 9,8";
} 
if(isset($_POST["fon_fijo"])){ 
   $fon_fijo = $_POST["fon_fijo"]; 
   }
   
if (empty($fon_fijo)) {
    $consul = $consul + 1; 
    } else {
	$fon_fijo = "%".$fon_fijo."%"; 
	//echo $fon_fijo;
	$consulta  = "Select * From cliente_general where CLIENTE_FONO like '$fon_fijo' and CLIENTE_USR_BAJA is null order by 9,8";
} 
if(isset($_POST["fon_celu"])){ 
   $fon_celu = $_POST["fon_celu"]; 
   }
   
if (empty($fon_celu)) {
    $consul = $consul + 1; 
    } else {
	$fon_celu = "%".$fon_celu."%"; 
	//echo $fon_celu;
	$consulta  = "Select * From cliente_general where CLIENTE_CELULAR like '$fon_celu' and CLIENTE_USR_BAJA is null order by 9,8";
} 
if ($consul == 8) {
   //echo "Consultara todos";
   $consulta  = "Select * From cliente_general where CLIENTE_USR_BAJA is null order by 9";
}
?>  
 <?php  
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
 ?>
  <div id="GeneralManUsuarioM">
<form name="form2" method="post" action="grab_retro_clim.php" >

<br>
	   <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
	 <strong>
	  <tr>
	  <th style="font-size:14px">Codigo </th>
	   <th style="font-size:14px">Nombre Cliente</th>
	   <th style="font-size:14px">Direccion</th>
	   <th style="font-size:14px">Telefono</th> 
	  </tr>
  <?php 
  
  while ($linea = mysql_fetch_array($resultado)) {
     $_SESSION['cli_usr'] = 2;
	 $nombre = $linea['CLIENTE_AP_PATERNO'].encadenar(1).
	           $linea['CLIENTE_AP_MATERNO'].encadenar(1).  
			   $linea['CLIENTE_AP_ESPOSO'].encadenar(1).
			   $linea['CLIENTE_NOMBRES']; 
	 $direc = substr($linea['CLIENTE_DIRECCION'],0,30);
	 $telef = $linea['CLIENTE_FONO']."-".$linea['CLIENTE_CELULAR'];?>
	  
 <tr>	  
 
	<td align="center" style="font-size:10px"><?php echo $linea['CLIENTE_COD_ANT'];?> </td>
	<td style="font-size:11px"><?php echo  $nombre;?> </td>
	<td style="font-size:11px"><?php echo  $direc;?> </td>
	<td style="font-size:11px"><?php echo $telef;?> </td>
	<td ><INPUT NAME="cod_cliente" TYPE=RADIO VALUE=<?php echo $linea['CLIENTE_COD'];?>></td>  

</tr>			
  	  <?php // }
	  } 
  
  ?>
 
  </table>
 <?php
   //}
 ?>
 
<center>
  <?php  if ($_SESSION['con_mod'] == 1){   ?>
  <input type="submit" name="accion" value="Consultar">
  <input type="submit" name="accion" value="Kardex">
   <?php  } ?>
    <?php  if ($_SESSION['con_mod'] == 2){   ?>
  <input type="submit" name="accion" value="Modificar">
   <input type="submit" name="accion" value="Kardex">
   <?php  } ?>
    <?php  if ($_SESSION['con_mod'] == 4){ 
	       $_SESSION['fono'] =  $fon_fijo; 
		  // echo $fon_fijo;  ?>
  <input type="submit" name="accion" value="Fusionar">
   <input type="submit" name="accion" value="Kardex">
  
   <?php  } ?>
    <?php  if ($_SESSION['con_mod'] == 6){   ?>
  <input type="submit" name="accion" value="Marca-Recordatorio">
   <input type="submit" name="accion" value="Kardex">
   <?php  } ?>
  </form>
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