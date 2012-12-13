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
<title>PRODEMIC</title>
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
                	<img src="images/24x24/001_35.png" border="0" alt="" />
				        Consulta de Usuarios
        </div>
        <div id="AtrasBoton">
           		<a href="gral_man_usr.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
       <?php
        // Se realiza una consulta SQL
        $consulta  = "Select * From gral_usuario where GRAL_USR_USR_BAJA is null";
        $resultado = mysql_query($consulta);
        ?>
        <div id="TableUsuario">
            <table>
                <tr>
                    <th>Carnet identidad</th>
                    <th>Login</th>
                    <th>Nombres</th>
                    <th>Ap.Paterno</th>
                    <th>Ap.Materno</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Celular</th>
                    <th>E-Mail</th>
                    <th>Cargo</th>
                </tr>
           <?php
           while ($linea = mysql_fetch_array($resultado)) {
                 ?>
                 <tr>
                    <td><?php echo $linea['GRAL_USR_CI']; ?></td>
                    <td><?php echo $linea['GRAL_USR_LOGIN']; ?></td>
                    <td><?php echo $linea['GRAL_USR_NOMBRES']; ?></td>
                    <td><?php echo $linea['GRAL_USR_AP_PATERNO']; ?></td>
                    <td><?php echo $linea['GRAL_USR_AP_MATERNO']; ?></td>
                    <td><?php echo $linea['GRAL_USR_DIRECCION']; ?></td>
                    <td><?php echo $linea['GRAL_USR_TELEFONO']; ?></td>
                    <td><?php echo $linea['GRAL_USR_CELULAR']; ?></td>
                    <td><?php echo $linea['GRAL_USR_EMAIL']; ?></td>
                    <td><?php echo $linea['GRAL_USR_CARGO']; ?></td>
                </tr>	
                 <?php
            }
            ?>
            </table>
        </div>
        <div id="FooterTable">
	        Ingresar mas usuarios <a href='gral_man_usr_a.php'><img src="images/24x24/001_21.png" border="0" alt="" align="absmiddle"/>Continuar</a>.||
    	    Terminar consulta <a href='gral_man_usr.php'><img src="images/24x24/001_02.png" border="0" alt="" align="absmiddle"/>Terminar</a>.
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