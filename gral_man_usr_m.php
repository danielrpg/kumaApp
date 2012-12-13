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
<script language="javascript" src="script/validarForm.js" type="text/javascript"></script>
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
		            Modificacion datos Usuarios
            </div>
            <div id="AtrasBoton">
           		<a href="gral_man_usr.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
        <?php
        // Se realiza una consulta SQL a tabla gral_param_propios
        $consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
        $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
        $con_sec  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 200 and GRAL_PAR_PRO_COD <> 0 ";
        $res_sec = mysql_query($con_sec)or die('No pudo seleccionarse tabla')  ;
        $con_car  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 300 and GRAL_PAR_PRO_COD <> 0 ";
        $res_car = mysql_query($con_car)or die('No pudo seleccionarse tabla')  ;
        $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 400 and GRAL_PAR_PRO_COD <> 0 ";
        $res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla')  ;
      //  $datos = $_SESSION['form_buffer'];
         ?>
         <div id="GeneralManUsuarioM">
        <form name="form2" method="post" action="gral_con_m.php"  onSubmit="">
        <table align="center">
	          <tr>
              		<td>Login : </td><td><input type="text" name="log" width="10" ></td>
               </tr>
               <tr>
                    <td>Documento Identidad :</td><td><input type="text" name="ci" width="10" > </td>
               <tr>
               <tr>
			        <td>Nombres :</td><td><input type= type="text" name="nombres"> </td>
               </tr>
               <tr>
		            <td>Apellido Paterno :</td><td><input type= type="text" name="ap_pater" > </td>
               </tr>
               <tr>
                    <td>Apellido Materno :</td><td> <input type= type="text" name="ap_mater"></td>
               </tr>
               <tr>
					<td></td><td><input type="submit" name="accion" value="Consultar"></td>
               </tr>
        </table>
        </form>
       </div>
       <div id="FooterTable"> 
	        Ingrese los datos generales del Usuario que desea modificar.
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