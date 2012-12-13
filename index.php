<?php
session_start();
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
	//$error = $_GET['error'];
	//if($error == 1){
?>
	<!-- <div id="error">
     	El usuario ingresado es incorrecto, verifique el Nombre
     </div>-->
<?php
//	}
?>
    <div id="Login">
    
        <form name="form1" method="post" action="valida_psw_tb.php">
            <table width="80" border="0" align="left" cellpadding="1" cellspacing="1">
              <tr>
                <td class="TitleTable">Ingresar al Sistema</td>      
              </tr>
               <tr> 
                 <td>
                 <table> 
                     <tr>
                        <td width="30%" class="subtitle">Nombre:</td>
                        <td width="80%" >
                            <input type="text" name="login">
                        </td>
                      </tr>
                      <tr>
                        <td width="20%" class="subtitle">Clave:</td>
                        <td width="80%">
                            <input type="password" name="clave">
                        </td>
                      </tr>
                   </table>
                  </td>
               </tr>
              <tr>
                <td colspan="2" align="center"><input name="enviar" type="submit" value="Ingresar"></td>
              </tr>
         </table>
        </form>
    
    </div>
    <?php
		include("footer.php");
	?>
</div>
</body>
</html>


