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
<title>SERVIMASTER</title>
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
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                  Mantenimiento Clientes
			</div>
             <div id="AtrasBoton">
           		<a href="cliente_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
<?php
$_SESSION['cli_exis'] = 0;
// Se realiza una consulta SQL a tabla gral_param_propios
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla 1')  ;
$con_tper  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 22 and GRAL_PAR_PRO_COD <> 0 ";
$res_tper = mysql_query($con_tper)or die('No pudo seleccionarse tabla 2')  ;
$con_barr  = "Select * From gral_barrios order by 2 ";
$res_barr= mysql_query($con_barr)or die('No pudo seleccionarse tabla 2')  ;
if(isset($_SESSION['form_buffer'])){
	$datos = $_SESSION['form_buffer'];
}
//echo leer_nro_cliente();
 ?>
 <font color="#FF0000">
 <?php
//echo $_SESSION['error'];
$_SESSION['error'] = "";
//ValidaCamposClientes(this)
?>
 </font>
  <div id="GeneralManCliente">
<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCamposClientes(this)">
         <table align="center">
            <tr>
		        <td>Agencia  </td>
			    <td> <select name="cod_agencia" size="1"  >
		   			 <?php
				       while ($linea = mysql_fetch_array($resultado)) {
				     ?>
					 <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
					 <?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
				 	 <?php	
				       } 
					 ?>
					 </select>
		         </td>
             </tr>
             <tr>
           	    <td> Tipo Cliente </td>
				<td>
				 <select name="tip_per" size="1" size="10" >
   	    			 <?php
			           while ($linea = mysql_fetch_array($res_tper)) {
    			     ?>
				     <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
					 <?php echo $linea['GRAL_PAR_PRO_DESC']; ?></option>
				     <?php
			            } 
			         ?>
					  </select >
                </td>
            </tr>
			
            <tr>
               <td>Doc Identidad (C.I. Nit)</td>
			  <td> <input type="text" name="ci" width="10"  size="16" ></td>
         </tr>
         
 
	       <tr>
  			  <td><font color="#990033">Nombres/Empresa/Inst.</td>
              <td><input type="text" name="nombres" maxlength="40" size="40" ></td>
           </tr>
           <tr>
              <td>Apellido Paterno </td>
              <td><input type="text" name="ap_pater" maxlength="35" size="35" ></td>
           </tr>
           <tr>
 		      <td>Apellido Materno </td>
              <td><input type="text" name="ap_mater" maxlength="35" size="35" ></td>
           </tr>
           <tr>
 			  <td>Apellido Esposo </td>
              <td><input type="text" name="ap_espos" maxlength="35" size="35" ></td>
           </tr>
		   
           <tr>
              <td >Fec Nacimiento / Creacion</td>
              <td><input type="text" name="fec_nac" maxlength="10"  size="10" > <script language="JavaScript">
                  new tcal ({
                  // form name
                  'formname': 'form2',
                  // input name
                  'controlname': 'fec_nac'
                  });
                  </script>
	          </td>
            </tr>
           <tr>
           	    <td> Barrio </td>
			    <td><input type="text" name="barrio" maxlength="35" size="35" ></td>
                
            </tr>
            <tr>   
			   <td ><font color="#990033">Direccion</td>
               <td><TEXTAREA cols="30" rows="10" name="direc"></TEXTAREA> </td>
            </tr>
            <tr>
               <td>Telefono Fijo </td>
               <td><input type="text" name="fono"></td>
            </tr>
            <tr>
               <td>Telefono Celular :</td>
               <td><input type="text" name="celu"></td>
            </tr>
            <tr>
			   <td>E-mail </td>
               <td><input type="text" name="email"></td>
            </tr>
			<tr>
			   <td>Recordatorio </td>
			   <td>  <input type=checkbox name=recor ></td>
            </tr>
            <td></td>
			 <td><input type="submit" name="accion" value="Grabar"></td>
           </tr>
       </table>
    </form>
</div>
<?php	
echo $_SESSION['error'];
$_SESSION['error'] = "";
?>
	<div id="FooterTable">
		Ingrese los datos generales del Cliente
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