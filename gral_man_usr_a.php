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
                	<img src="images/24x24/001_35.png" border="0" alt="" />   Mantenimiento Usuarios
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
//$datos = $_SESSION['form_buffer'];
 ?>
 <div id="GeneralManUsuario">
 <form name="form2" method="post" action="grab_retro_u.php" onSubmit="return ValidaCampos(this)">
 <table align="center">
    <tr>
        <td>Login :  </td><td>  <input type="text" name="log" size="20"></td>
     </tr>
     <tr>
        <td>Documento Identidad :</td><td><input type="text" name="ci" width="10"> </td>
      </tr>
      <tr>
    	    <td>Agencia :</td>
	        <td>   <select name="cod_agencia" size="1"  >
	              <?php
    	            while ($linea = mysql_fetch_array($resultado)) {
        	      ?>
        			    <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>><?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
             	   <?php
			          } 
          			?>
		          </select>
        	 </td>
       </tr>
       <tr>
	        <td>Nombres : </td><td><input type="text" name="nombres"> </td>
       </tr>
       <tr> 
            <td>Apellido Paterno :</td><td><input  type="text" name="ap_pater"> </td>
       </tr>
       <tr>
            <td>Apellido Materno :</td><td><input type="text" name="ap_mater"></td>
        </tr>
		<tr>
	        <td>Fec Nacimiento :</td>
            <td>
          <input  type="text"  name="fec_nac"><script language="JavaScript">
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
	         <td>Direccion :</td><td><input type= type="text" name="direc" size="50" maxlength="50"  > </td>
		 </tr>
         <tr>
	        <td>Tel. Fijo :</td><td><input type= type="text" name="fono"></td>
         </tr>
         <tr>
		     <td>Tel. Celular :</td><td><input type= type="text" name="celu"></td>
         </tr>
         <tr>
		      <td>E-mail :</td><td><input type= type="text" name="email"></td>
         </tr>
         <tr>
	          <td>Sector :</td><td><select name="cod_sec" size="1"  >
        		    	  <?php
                			while ($l_sec = mysql_fetch_array($res_sec)) {
		        	      ?>
				            <option value=<?php echo $l_sec['GRAL_PAR_PRO_COD']; ?>><?php echo $l_sec['GRAL_PAR_PRO_DESC']; ?> </option>
             
			              <?php
					          }
				          ?> 
					          </select>
               </td>
         </tr>
         <tr>
		       <td>Cargo :</td><td><select name="cod_car" size="1"  >
              <?php
                while ($l_car = mysql_fetch_array($res_car)) {
              ?>
            <option value=<?php echo $l_car['GRAL_PAR_PRO_COD']; ?>><?php echo $l_car['GRAL_PAR_PRO_DESC']; ?></option>
              <?php
          }
          ?> 
          </select>
          </td>
         </tr>
         <tr>
           <td> Estado :</td><td> <select name="cod_est" size="1"  >
              <?php
                while ($l_est = mysql_fetch_array($res_est)) {
              ?>
          		  <option value=<?php echo $l_est['GRAL_PAR_PRO_COD']; ?>><?php echo $l_est['GRAL_PAR_PRO_DESC']; ?></option>
             <?php
		          }
        	  ?> 
		          </select>
             </td>
         </tr>
         <tr>
	          <td>Clave Ingreso :</td><td><input type="password"   name="clav"></td>
         </tr>
         <tr>
               <td></td><td><input type="submit" name="accion" value="Grabar"></td>
         </tr>
     </table>
</form>
    <?php
	echo  $_SESSION["error"];  
    ?>
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