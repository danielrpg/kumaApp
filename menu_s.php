<?php
ob_start();
   if (!isset ($_SESSION)){
	  session_start();
	  }
	if(!isset($_SESSION['login'])){
		header("Location: index.php?error=1");
	} else { 
		require('configuracion.php');
	    require('funciones.php');
?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
  "http://www.w3.org/TR/html4/loose.dtd">       	
        <html>
        <head>
        <title>SERVIMASTER</title>  
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        </head>
        <body>
        <div id="LoginUsuario">
            <?php
				include("header.php");
			?>
           <div id="UserData">
             <img src="images/24x24/001_20.png" border="0" align="absmiddle">
		   <?php
               $fec = leer_param_gral();
              // echo $_SESSION['login'];
              ?> 
           </div>
           <div id="Salir">
              		<a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
           <div id="TitleModulo">
				 <img src="images/24x24/001_43.png" border="0" alt="Modulos">MODULOS:
       	   </div>
        <?php
        $log = $_SESSION['login'];
		if ($log == "super"){
           $consulta  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 100 and GRAL_PAR_PRO_COD <> 0 ";
           $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
		   }else{
		   $consulta  = "Select GRAL_PAR_PRO_COD, GRAL_PAR_PRO_DESC From gral_permiso_usuario, gral_param_propios where GRAL_USR_LOGIN = '$log' and GRAL_USR_ESTADO = 1 and GRAL_PAR_PRO_GRP = 100 and GRAL_PAR_PRO_COD = GRAL_PER_COD_MOD GROUP BY GRAL_PER_COD_MOD ";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
}
         ?>
      <!--   <form name="form2" method="post" action="grab_retro1.php" >
           <select name="cod_modulo[]" size="12" multiple> -->
           <div id="ListaSeleccion">
             <ul>
           <?php
           while ($linea = mysql_fetch_array($resultado)) {
		        if ($linea['GRAL_PAR_PRO_COD'] == 6000){
				    $_SESSION['dia'] = 1;
		    ?>
			<li><a href="crono_diario.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>" title="Modulo"><?php echo $linea['GRAL_PAR_PRO_DESC']; ?></a></li>
			 <?php 
           } else {
           ?> 
           <!-- <option value= --><li><a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>" title="Modulo"><?php echo $linea['GRAL_PAR_PRO_DESC']; ?></a></li> <!--/option-->
           <?php 
           } } 
           ?> 
          <!---/select><br><br>
          <input type="submit" name="accion" value="Elegir Modulo">
       
          </form>-->
            </ul>
          </div>
          <?php
		 	include("footer_in.php");
		 ?>
         </div>
        </body>
        </html>
<?php
}
?>