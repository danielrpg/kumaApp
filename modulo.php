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
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
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
                 ?>         	
    		</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
			<?php
			$cod_mod = 0;
			if (isset ($_GET["modulo"])){
               $cod_mod = $_GET["modulo"];
			  $_SESSION['modulo'] = $_GET['modulo'];
			}
            //echo count($quecom);
         /*   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
             if( isset($quecom[$i]) ) {
                $cod_mod = $quecom[$i];
                echo $quecom[$i];
             }
            }*/
            $consulta  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 100 and GRAL_PAR_PRO_COD = $cod_mod ";
            $resultado = mysql_query($consulta)or die('No pudo seleccionar tabla');
            $linea = mysql_fetch_array($resultado);
			?>
            <div id="TitleModulo">
				 <img src="images/24x24/001_43.png" border="0" alt="Modulos">MODULOS:<br />
                 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                 <?php
		            echo $linea['GRAL_PAR_PRO_DESC'];
        	     ?>
       	   </div>
           <div id="AtrasBoton">
           		<a href="menu_s.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Modulos</a>
           </div>
            <?php
            // Se realiza una consulta SQL a tabla gral_param_propios
            $consulta  = "Select * From gral_opciones_prg where GRAL_OPC_PRG_MOD = $cod_mod and GRAL_OPC_STAT = 1 order by 2 ";
            $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
            ?>
             <div id="TableModulo">
                <table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
                   <tr>
                    <th width="27%" scope="col"><img src="images/24x24/001_41.png" border="0" alt="" align="absmiddle" />CODIGO</th>
                    <th width="41%" scope="col"><img src="images/24x24/001_12.png" border="0" alt="" align="absmiddle" />DESCRIPCION</th>
                    <th width="32%" scope="col"><img src="images/24x24/001_38.png" border="0" alt="" align="absmiddle" />EJECUTAR</th>
                  </tr>
                   <?php
                   while ($linea = mysql_fetch_array($resultado)) {
                   ?>              
                  <tr>
                    <td height="33"><?php echo $linea['GRAL_OPC_PRG_COD']; ?></td>
                    <td><?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?></td>
                   <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                    <td><a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td> 	 
				  </tr>
                  <?php
                  } 
                  ?>
                </table>
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