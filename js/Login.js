// JavaScript Document
$(document).ready(function(){
	var login = new Login();
	login.init(login);
});
// Esta es la clase en java script 

function Login(){
	/*
	 * Este es le metodo constructor de la clase	
	 */
	this.init = function(login){
		$('#msg_error').hide();
		$('#usr_name').keypress(function(){
			$('#msg_error').hide(500);
			$('#usr_name').css({
				'border':'1px solid #A8A8A5'
			});
		});
		$('#usr_password').keypress(function(){
			$('#msg_error').hide(500);
			$('#usr_password').css({
				'border':'1px solid #A8A8A5'
			});

		});

		/// Estos son los eventos de teclado

		$('#usr_name').keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13'){
				//var login = new Login();
				login.verifyAccount();
			}
		});

		$('#usr_password').keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13'){
				//var login = new Login();
				login.verifyAccount();
			}
		});


		//$('#bt_ingresar').click(new Login().verifyAccount);
	}
	/**
	 * Metodo encargado de verificar la cuenta
	 */
	this.verifyAccount= function(){
		if($('#usr_name').val() == ''){
			$('#msg_error').hide();
			$('#msg_error').empty();
			$('#msg_error').html('<p><img src="images/24x24/notawarning.png" align="absmiddle">El campo <b>Nombre</b> no puede estar vacio por favor complete la informaci&oacute;n.</p>');
			$('#msg_error').show(500);
			$('#usr_name').css('border', '1px solid red');
		}else if($('#usr_password').val() == ''){
			$('#msg_error').hide();
			$('#msg_error').empty();
			$('#msg_error').html('<p><img src="images/24x24/notawarning.png" align="absmiddle">El campo <b>Clave</b> no puede estar vacio por favor complete la informaci&oacute;n.</p>');
			$('#msg_error').show(500);
			$('#usr_password').css('border', '1px solid red');
		}else{
			var dataString = new FormData();
			dataString.append('usr_name', $('#usr_name').val());
			dataString.append('usr_password', $('#usr_password').val());
			$.ajax({
				url:'valida_psw_tb.php',
				type:'POST',
				dataType:"json",
				data:dataString,
				processData:false,
				contentType:false,
				cache: false,
				beforeSend: function(data){
					if(data && data.overrideMimeType) {
						data.overrideMimeType("application/json;charset=UTF-8");
					}
					$('#fomulario_login').hide();
					$('#fomulario_login').empty();
					$('#fomulario_login').html('<p><br><br><img src="img/loading.gif"></p>');
					$('#fomulario_login').show(100);
				},
				success: function(data){
				   if(data.msg == 'menu_s'){
						$(location).attr('href', 'menu_s.php');
						//console.log('Esta dirigiendo a menu_s.php');
				   }else if(data.msg == 'no'){
				   	    $('#msg_error').hide();
						$('#msg_error').empty();
						$('#msg_error').html('<p><img src="images/24x24/notawarning.png" align="absmiddle">Usted no es usuario del sistema intente con otra cuenta por favor.</p>');
						$('#msg_error').show(500);
						var dataForm = ' <table> <tr><td >Nombre:</td><td ><input type="text" name="login" id="usr_name"></td></tr><tr><td >Clave:</td><td ><input type="password" name="clave" id="usr_password"></td></tr><tr><td><br></td><td></td></tr></table><input name="enviar" type="submit" value="Ingresar" id="bt_ingresar" onClick="new Login().verifyAccount()"> ';
						$('#fomulario_login').hide();
						$('#fomulario_login').empty();
						$('#fomulario_login').html(dataForm);
						$('#fomulario_login').show(500);
						$('#usr_name').keypress(function(){
							$('#msg_error').hide(500);
							$('#usr_name').css({
								'border':'1px solid #A8A8A5'
							});
						});
						$('#usr_password').keypress(function(){
							$('#msg_error').hide(500);
							$('#usr_password').css({
								'border':'1px solid #A8A8A5'
							});

						});
						$('#usr_name').keypress(function(event){
							var keycode = (event.keyCode ? event.keyCode : event.which);
							if(keycode == '13'){
								var login = new Login();
								login.verifyAccount();
							}
						});

						$('#usr_password').keypress(function(event){
							var keycode = (event.keyCode ? event.keyCode : event.which);
							if(keycode == '13'){
								var login = new Login();
								login.verifyAccount();
							}
						});



				   }	
				},
				error: function(data){
					$('#msg_error').hide();
					$('#msg_error').empty();
					$('#msg_error').html('<p><img src="images/24x24/notawarning.png" align="absmiddle">Ocurrio un error en el sistema por favor vuelva a intentarlo.</p>');
					$('#msg_error').show(500);
				}
			});
		}
	}
}