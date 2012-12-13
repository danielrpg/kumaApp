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
<title>Fusion de Cliente</title>
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
                    Fusion de Cliente
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
        <td><strong> Telefono Fijo </strong> </td>
		<td> <input type="text" name="fon_fijo" size="12" value=""> 
   	  </tr>
      
 
	  </table>
	  <center> 
	   <td><input type="submit" name="accion" value="Seleccionar"></td>
	   
   </tr>
 
</form>
</div>
<div id="FooterTable"> 
Ingrese el/los telefonos del Cliente que desea fucionar
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