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
<title>Tipo Reporte</title>
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
				 $con_ope  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 700 and GRAL_PAR_PRO_COD > 0
				             and GRAL_PAR_PRO_COD < 10 
             ORDER BY GRAL_PAR_PRO_COD";
$res_ope = mysql_query($con_ope)or die('No pudo seleccionarse tabla')  ;
                ?> 
			</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                 Parametros del Reporte
			</div>
             <div id="AtrasBoton">
           		<a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
  <div id="GeneralManUsuario">
	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="ope_rep_det.php" onSubmit="return ValidarCamposUsuario(this)">
	
	 <table align="left">
        <strong>Fecha Desde</strong>
         <input type="text" name="fec_des" maxlength="10"  size="10" > <script language="JavaScript">
            new tcal ({
                // form name
                'formname': 'form2',
                // input name
                'controlname': 'fec_des'
            });
            </script>
			 <BR><br>
		 <strong>Fecha Hasta</strong>
         <input type="text" name="fec_has" maxlength="10"  size="10" > <script language="JavaScript">
            new tcal ({
                // form name
                'formname': 'form2',
                // input name
                'controlname': 'fec_has'
            });
            </script>		
			
			 <th align="left">Operador</th>
			  <td align="left"><select name="cod_ope" size="1"  >
			  <?php while ($linope = mysql_fetch_array($res_ope)) { ?>
             <option value=<?php echo $linope['GRAL_PAR_PRO_COD']; ?>>
			 <?php echo $linope['GRAL_PAR_PRO_COD']; ?>
			 <?php echo $linope['GRAL_PAR_PRO_DESC']; ?> </option>
	  	     <?php } ?> 
            </select></td>
			
       <tr> 
			  <BR><br>
			 
			  <tr>
                 <th align="left" ><?php echo "Produccion-Gastos"; ?></th>
			     <td ><INPUT NAME="ctot" TYPE=RADIO VALUE="S"></td>
			  </tr>
			   <tr>
                 <th align="left" ><?php echo "Produccion"; ?></th>
			     <td ><INPUT NAME="cpro" TYPE=RADIO VALUE="S"></td>
			  </tr>
			  <tr>
                 <th align="left" ><?php echo "Gastos"; ?></th>
			     <td ><INPUT NAME="cgas" TYPE=RADIO VALUE="S"></td>
			  </tr>
			 
			   <tr>
                 <th > <input type="submit" name="accion" value="Procesar"></th>
			    
			  </tr>
			  
			  
			  
			</table>
			
  <BR><br>
  <BR><br>
	
    </form>
   <BR><br> 
</div>
	<div id="FooterTable">
		Ingrese los Parametros del Reporte
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