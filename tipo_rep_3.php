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
                 Fecha 
			</div>
             <div id="AtrasBoton">
           		<a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
  <div id="GeneralManUsuario">
	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
	
	
<?php if ($_SESSION["tip_rep"] == 1) {  ?>
    <form name="form2" method="post" action="cart_rep_1.php" onSubmit="return ValidarCamposUsuario(this)">
<?php	}  ?>
<?php if ($_SESSION["tip_rep"] == 2) {  ?>
    <form name="form2" method="post" action="cart_rep_2.php" onSubmit="return ValidarCamposUsuario(this)">
<?php	}  ?>
<?php //if ($_SESSION["tip_rep"] == 3) {  ?>
    <form name="form2" method="post" action="cart_rep_3.php" onSubmit="return ValidarCamposUsuario(this)">
<?php//	}  ?>
	
        <strong>Fecha </strong>
         <input type="text" name="fec_nac" maxlength="10"  size="10" > <script language="JavaScript">
            new tcal ({
                // form name
                'formname': 'form2',
                // input name
                'controlname': 'fec_nac'
            });
            </script>
			 <BR><br>
			
				
  <BR><br>
  <BR><br>
	  <input type="submit" name="accion" value="Procesar">
    </form>
   <BR><br> 
</div>
	<div id="FooterTable">
		Ingrese la fecha 
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