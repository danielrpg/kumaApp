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
<title>Consulta Clientes</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
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
	               	<img src="images/24x24/001_35.png" border="0" alt="" />   
                                Consulta Clientes para Cronograma Diario
                </div>
<div id="AtrasBoton">
           		<a href="cliente_con_grup.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<?php
//echo "entra a grabar";
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
$cod_cli =$_POST["cod"];
//$cod_grp = $_SESSION["cod_g"];
//echo $cod_grp;
if(isset($_POST['cod_grupo'])){
   $quecom = $_POST['cod_grupo'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_g = $quecom[$i];
    }
   }
 }
//$cod_g = $_SESSION["cod_g"];
//$nom_g = $_SESSION["nombre_g"];
$consul = 0;
$comb = 0;
//$log_usr = strtolower($log_usr);
if (empty($cod_cli)) {
    $consul = $consul + 1;
	} else {
	 $consulta  = "Select * From cliente_general where CLIENTE_COD = $cod_cli and CLIENTE_USR_BAJA is null order by 9,8";
}
$c_i = $_POST["ci"];
if (empty($c_i)) {
   $consul = $consul + 1;
   } else {
   $c_i =  "%".$c_i."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_COD_ID like '$c_i' and CLIENTE_USR_BAJA is null order by 9,8";
}
$nom = $_POST["nombres"]; 
if (empty($nom)) {
     $consul = $consul + 1;
	} else {
	 $comb = $comb + 1;
	 $nom =  "%".strtoupper($nom)."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_NOMBRES like '$nom' and CLIENTE_USR_BAJA is null order by 9,8"; 
}
$a_pat = $_POST["ap_pater"];
if (empty($a_pat)) {
    $consul = $consul + 1;
    } else {
	 $comb = $comb + 1;
	$a_pat = "%".strtoupper($a_pat)."%";
	//echo $a_pat;
	$consulta  = "Select * From cliente_general where CLIENTE_AP_PATERNO like '$a_pat' and CLIENTE_USR_BAJA is null order by 9,8 "; 
} 
if ($comb == 2){
     $nom =  "%".strtoupper($nom)."%";
	 $a_pat = "%".strtoupper($a_pat)."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_NOMBRES like '$nom' and CLIENTE_AP_PATERNO like '$a_pat'
	               and CLIENTE_USR_BAJA is null order by 9,8"; 

}



$a_mat = $_POST["ap_mater"]; 
if (empty($a_mat)) {
    $consul = $consul + 1; 
    } else {
	$a_mat = "%".strtoupper ($a_mat)."%"; 
	$consulta  = "Select * From cliente_general where CLIENTE_AP_MATERNO like '$a_mat' and CLIENTE_USR_BAJA is null order by 9,8";
} 
$a_esp = $_POST["ap_espos"]; 
if (empty($a_esp)) {
    $consul = $consul + 1; 
    } else {
	$a_esp = "%".strtoupper ($a_esp)."%"; 
	$consulta  = "Select * From cliente_general where CLIENTE_AP_ESPOSO like '$a_esp' and CLIENTE_USR_BAJA is null order by 9,8 ";
} 
if(isset($_POST["fon_fijo"])){ 
   $fon_fijo = $_POST["fon_fijo"]; 
   }
   
if (empty($fon_fijo)) {
    $consul = $consul + 1; 
    } else {
	$fon_fijo = "%".$fon_fijo."%"; 
//	echo $fon_fijo;
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
   $consulta  = "Select * From cliente_general where CLIENTE_USR_BAJA is null order by 9,8";
 }
?> 
 <?php 
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
 ?>
 <div id="GeneralManUsuarioM">
<form name="form2" method="post" action="incorp_cli_grup.php" >
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
<?php
   }
 ?>
  </table>
  <br>
  <center>
  <input type="submit" name="accion" value="Conograma">
  <input type="submit" name="accion" value="Salir">
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