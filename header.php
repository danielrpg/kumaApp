<?php
require('configuracion.php');

$consulta  = "Select GRAL_EMP_NOMBRE From gral_empresa ";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
$linea = mysql_fetch_array($resultado);
   $_SESSION['COD_EMPRESA']=$linea['GRAL_EMP_NOMBRE'];
?> 

<div id="HeraderTitle">

                   <img src="images/servi2.jpg" border="0" alt="" align="absmiddle" />
                    
                  
<?php
     // echo $linea['GRAL_EMP_NOMBRE'];
?>	  
</div> 

 