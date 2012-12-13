<?php
require('configuracion.php');

$consulta  = "Select GRAL_EMP_NOMBRE From gral_empresa ";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
   $_SESSION['COD_EMPRESA']=$linea['GRAL_EMP_NOMBRE'];
?> 
<div id="FooterIn">
<?php
      echo "Todos los derechos reservados".encadenar(2).$linea['GRAL_EMP_NOMBRE'];
?>	  
 
</div>