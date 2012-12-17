<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>SERVIMASTER</title>
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <link href="css/login.css" rel="stylesheet" type="text/css" media="all">
        <script src="script/jquery.js"></script>
        <script src="js/Login.js" type="text/javascript"></script>
    </head>
    <body>
         <div id="pagina_principal">
            <?php
                include("header.php");
                //$error = $_GET['error'];
                //if($error == 1){
            ?>
            <section id="contenido_pagina">
                <div id="LoginUsuario">    
                    <!-- <div id="error">
                        El usuario ingresado es incorrecto, verifique el Nombre
                     </div>-->
                <?php
                //	}
                ?>
                    <div id="Login">
                    
                        <!--form name="form1" method="post" action="valida_psw_tb.php" -->
							    <h4>INGRESAR AL SISTEMA </h4>
                            <hr>
                              <div id="msg_error">
                              </div>
                              <div id="fomulario_login">
                                 <table> 
                                     <tr>
                                        <td >Nombre:</td>
                                        <td >
                                            <input type="text" name="login" id="usr_name">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td >Clave:</td>
                                        <td >
                                            <input type="password" name="clave" id="usr_password">
                                        </td>
                                      </tr>
                                      <tr><td><br></td><td></td></tr>
                                   </table>
                                 <input name="enviar" type="submit" value="Ingresar" id="bt_ingresar" onClick="new Login().verifyAccount()">
                              </div>
                        <!-- /form -->
                    
                    </div>
                  
                </div>
                 
             </section>
              <?php
                    include("footer.php");
              ?>
        </div>
    </body>
</html>


