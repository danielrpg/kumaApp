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
<script language="javascript" src="script/validarForm.js" type="text/javascript"></script>
</head>
<body>
	<div id="cuerpoModulo">
    	<?php
				include("header.php");
				//echo "aqui";
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
                    Modificacion datos Clientes
			</div>
             <div id="AtrasBoton">
           		<a href="cliente_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
<?php
//if(isset($_SESSION['form_buffer']))	{
//	$datos = $_SESSION['form_buffer'];
//}
 ?>
 <div id="GeneralManUsuarioM">
<!--<form name="form2" method="post" action="cliente_con_m.php"   onSubmit="return ValidaCamposClientes(this)">
 Esta parte es igual que la anterior ya que no se quiere quu se quiere colsultar apesar de que no se ponga dato entonces se tiene que desabilitar el script para mas convenencia-->  
 
<form name="form2" method="post" action="cliente_con_m.php">
    <table align="center">
    <tr>
	<td><strong>Codigo</strong></td>
	<td><?php if(isset($datos['cod'])){ ?><input type="text" name="cod" size="10" value="<?=$datos['cod'];?>"><?php }else{?><input type="text" name="cod" size="10" value=""><?php }?> </td>
    </tr>
    <tr>
		<td><strong>Documento Identidad</strong>  </td>
		<td><?php if(isset($datos['ci']))	{ ?>
		<input type="text" name="ci" size="10" value="<?=$datos['ci'];?>" >
		<?php }else{?>
		<input type="text" name="ci" size="10" value="">
		<?php }?> </td>
    </tr>
	<tr>
    <tr>
	   <td><strong>  Nombres </strong>  </td>
	   <td><?php if(isset($datos['nombres']))	{ ?>
	   <input type= type="text" name="nombres" size="35" value="<?=$datos['nombres'];?>">
	   <?php }else{?>
	   <input type="text" name="nombres" size="35" value=""><?php }?></td>
   </tr>
	   <td><strong>  Apellido Paterno </strong>  </td>
	   <td><?php if(isset($datos['ap_pater']))	{ ?>
	   <input type= type="text" name="ap_pater" size="35" value="<?=$datos['ap_pater'];?>" >
	   <?php }else{?>
	   <input type="text" name="ap_pater" size="35" value="">
	   <?php }?> </td>
   </tr>
   <tr> 
	  <td><strong>  Apellido Materno </strong>  </td>
	  <td> <?php if(isset($datos['ap_mater']))	{ ?>
	  <input type= type="text" name="ap_mater" size="35" value="<?=$datos['ap_mater'];?>"  >
	  <?php }else{?>
	  <input type="text" name="ap_mater" size="35" value=""><?php }?></td>
   </tr>
   <tr>
	   <td><strong>Apellido Esposo </strong>  </td>
	   <td> <?php if(isset($datos['ap_espos']))	{ ?>
	   <input type= type="text" name="ap_espos" size="35" value="<?=$datos['ap_espos'];?>"  >
	   <?php }else{?>
	   <input type="text" name="ap_espos" size="35 value=""><?php }?></td>
   </tr>
      
       <tr>
        <td><strong> Telefono Fijo </strong> </td>
		<td> <input type="text" name="fon_fijo" size="12" value=""> 
   	  </tr>
       <tr>
        <td><strong> Celular  </strong> </td>
		
		<td align="left"><input type="text" name="fon_celu" size="12" value=""> 
   	  </tr>
 
	  </table>
	  <center> 
	  <?php  if ($_SESSION['con_mod'] == 1){   ?>
	   <td><input type="submit" name="accion" value="Consultar"></td>
	   <?php  } ?>
    <?php  if ($_SESSION['con_mod'] == 2){   ?>
	 <input type="submit" name="accion" value="Modificar">
   <?php  } ?>
   <?php  if ($_SESSION['con_mod'] == 6){   ?>
	 <input type="submit" name="accion" value="Marcar">
   <?php  } ?>
   </tr>
 
</form>
</div>
<div id="FooterTable"> 
Ingrese los datos generales del Cliente que desea modificar
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