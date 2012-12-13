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
<title>Consulta de Cliente </title>
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
					Consulta Clientes para Cronograma
                </div>
               <div id="AtrasBoton">
           		<a href="menu_s.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<br>
<?php
if(isset($_SESSION['form_buffer'])){
   $datos = $_SESSION['form_buffer'];
}
 ?>
 <div id="GeneralManUsuarioM">
<!--<<form name="form2" method="post" action="cliente_retro_grup.php" target="_self" onSubmit="return ValidaCamposClientes(this)">-->
<form name="form2" method="post" action="cliente_con_cro.php">
 <strong>  Criterios de Seleccion de Cliente  </strong>
 <table align="center">
      <tr>
        <td><strong>Codigo</strong> </td>
		<td><?php echo encadenar(10);?></td>
		<td align="left"><input type="text" name="cod" size="8" value=""> 
   	  </tr>
      <tr>
        <td><strong>Documento Identidad</strong> </td>
		<td><?php echo encadenar(10);?></td>
		<td align="left"><input type="text" name="ci" size="12" value=""> 
   	  </tr>
      <tr>
        <td><strong>Nombres</strong> </td>
		<td><?php echo encadenar(10);?></td>
		<td align="left"><input type="text" name="nombres" size="35" value=""> 
   	  </tr>
      <tr>
        <td><strong>Apellido Paterno </strong> </td>
		<td><?php echo encadenar(10);?></td>
		<td align="left"><input type="text" name="ap_pater" size="35" value=""> 
   	  </tr>
	  <tr>
        <td><strong>Apellido Materno </strong> </td>
		<td><?php echo encadenar(10);?></td>
		<td align="left"><input type="text" name="ap_mater" size="35" value=""> 
   	  </tr>
      <tr>
        <td><strong>Apellido Esposo  </strong> </td>
		<td><?php echo encadenar(10);?></td>
		<td align="left"><input type="text" name="ap_espos" size="35" value=""> 
   	  </tr>
      <tr>
        <td><strong>Telefono Fijo  </strong> </td>
		<td><?php echo encadenar(10);?></td>
		<td align="left"><input type="text" name="fon_fijo" size="10" value=""> 
   	  </tr>
       <tr>
        <td><strong> Celular  </strong> </td>
		<td><?php echo encadenar(10);?></td>
		<td align="left"><input type="text" name="fon_celu" size="10" value=""> 
   	  </tr>
 
  
  
  
  </table> 
  <BR><br>
    <input type="submit" name="accion" value="Consultar">
</form>
</div>
<div id="FooterTable">
Consulta de Cliente
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