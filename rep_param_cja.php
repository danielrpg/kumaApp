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
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla')  ;
                ?> 
			</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
				 <?php
				  if ($_SESSION["tipo_rep"] == 1) {
				      echo "Reporte de Vencimientos";
					}
				  if ($_SESSION["tipo_rep"] == 2) {
				      echo "Detalle de Recuperaciones";
					}
				   if ($_SESSION["tipo_rep"] == 3) {
				      echo "Detalle de Desembolsos";
					}	
				   if ($_SESSION["tipo_rep"] == 4) {
				      echo "Movimientos Fondos Garantia";
					}	
					if ($_SESSION["tipo_rep"] == 5) {
				      echo "Detalle Ingresos / Egresos";
					}	
				    if ($_SESSION["tipo_rep"] == 6) {
				      echo "Detalle Movimientos Caja";
					}					
				 ?>
			</div>
    
	<?php if ($_SESSION["tipo_rep"] == 1) {  ?>
			 <div id="AtrasBoton">
           	<a href="cred_cobros.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
		  <div id="GeneralManUsuario">
	          <form name="form2" method="post" action="cart_prox_vto.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>
	<?php if ($_SESSION["tipo_rep"] == 2) {  ?>
			 <div id="AtrasBoton">
           	<a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
		  <div id="GeneralManUsuario">
	          <form name="form2" method="post" action="cart_det_rec.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>			 
  <?php if ($_SESSION["tipo_rep"] == 3) {  ?>
			 <div id="AtrasBoton">
           	<a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
		  <div id="GeneralManUsuario">
	          <form name="form2" method="post" action="cart_det_des.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>	
<?php if ($_SESSION["tipo_rep"] == 4) {  ?>
			 <div id="AtrasBoton">
           	<a href="fgar_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
		  <div id="GeneralManUsuario">
	          <form name="form2" method="post" action="fgar_det_mov.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>	
<?php if ($_SESSION["tipo_rep"] == 5) {  ?>
			 <div id="AtrasBoton">
           	<a href="cja_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
		  <div id="GeneralManUsuario">
	          <form name="form2" method="post" action="ingegr_mov_det.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>	
<?php if ($_SESSION["tipo_rep"] == 6) {  ?>
			 <div id="AtrasBoton">
           	<a href="cja_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
		  <div id="GeneralManUsuario">
	          <form name="form2" method="post" action="caja_mov_det.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>						
	<br><br>
	<?php
	if(isset($_SESSION['msj_error'])){	
	   echo $_SESSION['msj_error']; 
	   }
	?>	
	<br><br>		
	
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
	  <BR><br>
  
  
  
      <br /> <br />
	  <input type="submit" name="accion" value="Procesar">
    </form>
   <BR><br> 
</div>
	<div id="FooterTable">
		Ingrese la fecha de vencimiento
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