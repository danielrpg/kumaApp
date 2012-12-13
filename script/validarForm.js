// JavaScript Document
 // http://www.terra.es/personal3/davidhdezsanz/  
 // Validacion de distintos tipos de campos de formulario:  
   // Texto no nulo  
 //- Direccion de correo electronico (e-mail): alfanum@alfanum.alfanum[.alfanum], donde alfanum son caracteres alfanumericos u otros (pasados como parametro)  
  // 7. // - Direccion en Internet (URL)  
  // 8. // Para ello no se utilizan expresiones regulares.  
  // 9. //  
//  10. //Este script y otros muchos pueden  
//  11. //descarse on-line de forma gratuita  
//  12. //en El Código: www.elcodigo.com  
//  13.   
//  14. /* dice si cadena es texto no vacio o no                                     */  
 function vacio(cadena)  
   {                                   // DECLARACION DE CONSTANTES  
     var blanco = " \n\t" + String.fromCharCode(13); // blancos  
                                        // DECLARACION DE VARIABLES  
     var i;                             // indice en cadena  
     var es_vacio;                      // cadena es vacio o no  
     for(i = 0, es_vacio = true; (i < cadena.length) && es_vacio; i++) // INICIO  
         es_vacio = blanco.indexOf(cadena.charAt(i)) != - 1;  
       return(es_vacio);  
  }  
  
  
 // 27. /* dice si cadena es un email (alfanum@alfanum.alfanum[.alfanum]) o no, don- */  
 // 28. /* de alfanum son caracteres alfanumericos u otros                           */  
 function email(cadena, otros)  
   {                                    // DECLARACION-INICIALIZACION VARIABLES  
       var i, j;                          // indice en cadena  
       var es_email = 0 < cadena.length;  // cadena es email o no  
      i = salta_alfanumerico(cadena, 0, otros); // INICIO  
       if(es_email = 0 < i)               // lee "alfanum*"  
         if(es_email = (i < cadena.length))  
           if(es_email = cadena.charAt(i) == '@') // lee "alfanum@*"  
             {  
               i++;  
               j = salta_alfanumerico(cadena, i, otros);  
               if(es_email = i < j)       // lee "alfanum@alfanum*"  
                 if(es_email = j < cadena.length)  
                   if(es_email = cadena.charAt(j) == '\.')  
                     {                    // lee "alfanum@alfanum.*"  
                       j++;  
                       i = salta_alfanumerico(cadena, j, otros);  
                       if(es_email = j < i) // lee "alfanum@alfanum.alfanum*"  
                         while(es_email && (i < cadena.length))  
                           if(es_email = cadena.charAt(i) == '\.')  
                             {  
                               i++;  
                               j = salta_alfanumerico(cadena, i, otros);  
                               if(es_email = i < j) // lee "alfanum@alfanum.alfanum[.alfanum]*"  
                                 i = j;  
                             }  
                     }  
             }  
       return(es_email);  
     }  
    
     
  //61. /* dice si cadena es url (http://... ) o no                                     */  
   function url(cadena)  
     {                                    // DECLARACION DE CONSTANTES  
       var http = "http://";              // protocolo HTTP  
                                          // DECLARACION DE VARIABLES  
       var es_url;                        // cadena es url o no  
       if(cadena.length <= 7)             // INICIO  
         es_url = false;                  // no cabe "http://*"  
       else  
         es_url = http.indexOf(cadena.substring(0, 7)) != - 1; // lee "http://*"  
       return(es_url);  
     }  
  
  //75. /* salta caracteres alfanumericos y otros a partir de  cadena[i]  y  da  si- */  
  //76. /* guiente posicion                                                          */  
   function salta_alfanumerico(cadena, i, otros)  
     {                                    // DECLARACION DE VARIABLES  
       var j;                             // indice en cadena  
       var car;                           // caracter de cadena  
       var alfanum;                       // cadena[j] es alfanumerico u otros  
       for(j = i, alfanum = true; (j < cadena.length) && alfanum; j++) // INICIO  
         {  
           car = cadena.charAt(j);  
           alfanum = alfanumerico(car) || (otros.indexOf(car) != -1);  
         }  
       if(!alfanum)                       // lee "alfanumX"  
         j--;  
       return(j);  
     }  
       
  //92. /* dice si car es alfanumerico                                               */  
   function alfanumerico(car)  
     {  
       return(alfabetico(car) || numerico(car));  
     }  
     
  // /* dice si car es alfabetico                                                 */  
 function alfabetico(car)               // DECLARACION DE CONSTANTES  
    {                                    // caracteres alfabeticos  
      var alfa = "ABCDEFGHIJKLMNOPQRSTUWXYZabcdefghijklmnopqrstuvxyz";  
      return(alfa.indexOf(car) != - 1);  // INICIO  
    }  
 
 //107. /* dice si car es numerico                                                   */  
 function numerico(car)  
   {                                    // DECLARACION DE CONSTANTES  
      var num = "0123456789";            // caracteres numericos  
      return(num.indexOf(car) != - 1);   // INICIO  
   }  
   function isNum(q) {

		for ( i = 0; i < q.length; i++ ) {
		//con el for y la sentencia if( q.charAt(i) = " " ){... ..ya me queda lista para validar los espacios en blanco, de lo contrario:
			valor = parseInt(q.charAt(i)); // me permite convertir letra por letra en numero y si no es un numero entonces no regresa nada
			if (isNaN(valor)) {
				return true
			}
		}
		return false
   }
   
   
 
 //115. // ejemplo validacion formulario  
  function ValidaCampos(form)  
    { 
	 if(vacio(form.log.value) && vacio(form.nombres.value) && vacio(form.ap_pater.value) && vacio(form.ci.value) && vacio(form.fec_nac.value) && vacio(form.direc.value) && vacio(form.fono.value) && vacio(form.cel.value) && vacio(form.email.value)){
		  	ventana=confirm("Realmente quieres consultar con los Campos vacios");
			 if (ventana) {
			 //En ésta parte incluiremos las sentencias que
			 //queremos que se ejecuten al pulsar sobre
			 //el botón Aceptar
				 alert("Has pinchado sobre Aceptar");
			 }
			 else {
			 //En ésta parte incluiremos las sentencias que
			 //queremos que se ejecuten al pulsar sobre
			 //el botón Cancelar
				  alert("Has pinchado sobre Cancelar");
			 }
	  }
	
      else if(vacio(form.log.value))  
        alert("Login esta vacio.");
	  else if(vacio(form.ci.value))
	  	alert("El campo Documento de Identidad esta vacio.");
		  else if(vacio(form.nombres.value))
	  	alert("El campo Nombres esta vacio.");
	  else if(vacio(form.ap_pater.value))
	  	alert("El campo Apellido Paterno esta vacio.");
	  else if(vacio(form.ap_mater.value))
	  	alert("El campo Apellido Materno esta vacio.");
	  else if(vacio(form.fec_nac.value))
	  	alert("El campo Fec. Nacimiento esta vacio.");
	  else if(vacio(form.direc.value))
	  	alert("El campo Direccion esta vacio.");
	  else if(vacio(form.fono.value))
	    alert("El campo Telefono Fijo esta vacio.");
	  else if(isNum(form.fono.value)==true)
	  	alert("El campo Telefono Fijo tiene que ser numerico.");
	  else if(vacio(form.cel.value))
	  	alert("El campo Celular no tiene que estar vacio.");
	  else if(vacio(form.email.value))
	  	alert("El campo Email esta vacio.");
	 	else if(vacio(form.fec_nac.value))
	  	alert("El campo fecha nacimiento esta vacio.");
      else if(!email(form.email.value, "-_"))  
        alert("Dirección de correo electrónico incorrecta.");
	  else if(vacio(form.clav.value))
	  	alert("El campo Clave no tiene que estar vacio.")  
      else if(!url(form.url.value))  
        alert("Dirección del sitio incorrecta.");
	    	
      else  
// 125.       //sustituir esta linea por return(true) para hacer el submit de un formulario real  
        alert("Los datos son correctos");  
      return(false);  
   }
  function ValidarCamposUsuario(formulario){
	  	if(vacio(formulario.ci.value))
			alert("El campo Documento de Identificion esta vacio.");
		else if(vacio(formulario.fec_exp.value))
			alert("El campo Fecha de Expiracion es vacio.");
		else if(vacio(formulario.fec_nac.value))
			alert("El campo Fecha de Nacimiento esta vacio.");
		else if(vacio(formulario.nombres.value))
		    alert("El campo Nombres esta vacio.");
		else if(vacio(formulario.ap_pater.value))
			alert("El campo Apellido Paterno esta vacio.");
		else if(vacio(formulario.ap_mater.value))
			alert("El campo Apellido Materno esta vacio.");
		else if(vacio(formulario.direc.value))
			alert("El campo Direccion esta vacio.");
		else if(vacio(formulario.zona.value))
			alert("El campo Zona esta vacio.");
		else{
			
			return(true);
		}
		return(false);
  }
  
  function ValidaCamposClientes(formu){
	  	if(vacio(formu.nombres.value))
		    alert("El campo Nombres esta vacio.");
		else if(vacio(formu.direc.value))
			alert("El campo Direccion esta vacio.");		
		else if(vacio(formu.zona.value))
			alert("El campo Zona esta vacio.");	
		else{
		return(true);
		}
		return(false);
  }
  
  function ValidarCamposAdicional(formulario){
	  	if(vacio(formulario.ci.value))
			alert("El campo Documento de Identificion esta vacio.");
		else if(vacio(formulario.fec_des.value))
			alert("El campo Fecha Desembolso esta vacio.");
		else if(vacio(formulario.fec_nac.value))
			alert("El campo Fecha de Nacimiento esta vacio.");
		else if(vacio(formulario.nro_cta.value))
		    alert("El campo Numero de cuotas esta vacio.");
		else if(vacio(formulario.plz_mes.value))
			alert("El campo Plazo en meses esta vacio.");
		else if(vacio(formulario.imp_sol.value))
			alert("El campo Importe Solicitado esta vacio.");
		else if(vacio(formulario.direc.value))
			alert("El campo Direccion esta vacio.");
		else if(vacio(formulario.zona.value))
			alert("El campo Zona esta vacio.");
		else{
			
			return(true);
		}
		return(false);
  }
   function ValidarCamposSolicitud(formulario){
	  	 if(vacio(formulario.imp_sol.value))
			alert("El campo Importe Solicitado esta vacio.");
		else if(vacio(formulario.tas_int.value))
			alert("El campo Tasa interes anual esta vacio.");
		else if(formulario.tas_int.value < 20)
			alert("El campo Tasa interes anual menos del 20%");	
		else if(formulario.tas_int.value > 50)
			alert("El campo Tasa interes anual mas del 50%");
		else if(vacio(formulario.plz_mes.value))
			alert("El campo Plazo en meses esta vacio.");
		else if(vacio(formulario.nro_cta.value))
		    alert("El campo Numero de cuotas esta vacio.");	
		
		else if(formulario.aho_ini.value > 50)
			alert("El campo Fondo de Garantía Inicio mas del 50%");	
		else if(formulario.aho_dur.value > 50)
			alert("El campo Fondo de Garantía Durante Ciclo mas del 50%");		
			
		else if(vacio(formulario.fec_des.value))
			alert("El campo Fecha Orden esta vacio.");
		
		else if(vacio(formulario.fec_uno.value))
			alert("El campo Fecha Inicio Servicio esta vacio.");
		else if(formulario.fec_des.value > formulario.fec_uno.value)
			alert("El campo Fecha Inicio Servicio no puede ser menor a Fecha Orden.");	
		else if(formulario.tip_ope.value = 1)
			
			if(vacio(formulario.hra_reu.value))
			alert("El Tipo Opera Solidario Hora de reunion debe registrarse")
			if(vacio(formulario.dir_reu.value))
			alert("El Tipo Opera Solidario Lugar de reunion debe registrarse");
					
				
		else{
			
			return(true);
		}
		return(false);
  }
  
   function ValidarCamposGrupo(formu){
	  	if(vacio(formu.nom_grup.value))
			alert("El campo Nombre de Grupo esta vacio.");
			else{
			return(true);
		}
		return(false);
  }
  function ValidaCamposClientesMod(formu){
	  	if(vacio(formu.nombres.value))
		    alert("El campo Nombres esta vacio.");
		else if(vacio(formu.ap_pater.value))
			alert("El campo Apellido Paterno esta vacio.");
		else if(vacio(formu.fec_nac.value))
			alert("El campo Fecha Nacimiento esta vacio.");
		else if(vacio(formu.lu_nac.value))
			alert("El campo Lugar Nacimiento esta vacio.");	
		else if(vacio(formu.direc.value))
			alert("El campo Direccion esta vacio.");		
		else if(vacio(formu.zona.value))
			alert("El campo Zona esta vacio.");	
		else if(vacio(formu.a_eco_uno.value))
			alert("El campo Actividad Economica Principal esta vacio.");
		else if(vacio(formu.ant_tr.value))
			alert("El campo Antiguedad Actividad Economica esta vacio.");	
	    else if(isNum(formu.ant_tr.value)==true)
		  	alert("El campo Antiguedad Actividad tiene que ser numerico.");
		else if(vacio(formu.dir_tr.value))
			alert("El campo Direccion Trabajo Negocio esta vacio.");
		else if(vacio(formu.zon_tr.value))
			alert("El campo Zona de Trabajo Negocio esta vacio.");	
		else if(vacio(formu.nom_ref.value))
			alert("El campo Nombre Referencia Personal esta vacio.");		
		else if(vacio(formu.dir_ref.value))
			alert("El campo Direccion Referencia Personal esta vacio.");		
		else{
			
			return(true);
		}
		return(false);
  }
  
  function ValidarRangoFechas(formulario){
	  	if(vacio(formulario.fec_des.value))
		   alert("El campo Fecha Desde esta vacio.");
		 else if(vacio(formulario.fec_has.value))
		   alert("El campo Fecha Hasta esta vacio.");
		 else if(formulario.fec_has.value < formulario.fec_des.value) 
		   alert("El campo Fecha Hasta no debe ser mayor a Fecha Desde");
		 else{
			
			return(true);
		}
		return(false);
  }
  
   function ValidaCamposEgresos(formu){
	  	if(vacio(formu.egr_monto.value))
			alert("El campo Monto no puede estar vacio.");
		else if(vacio(formu.descrip.value))
		    alert("El campo Descripcion esta vacio.");
		else{
			return(true);
		}
		return(false);
  }
  function ValidarCamposOrden(formulario){
	  	if(vacio(formulario.fec_des.value))
			alert("El campo Fecha Solicitud de Servicio esta vacio.");
		else if(vacio(formulario.fec_uno.value))
			alert("El campo Fecha Inicio de Servicio esta vacio.");
		else if(formulario.fec_des.value > formulario.fec_uno.value)
			alert("El campo Fecha Inicio Servicio no puede ser menor a Fecha Solicitud Servicio.");	
		else if(vacio(formulario.hra_ini.value))
			alert("El campo Hora Inicio  esta vacio.");
		else if(vacio(formulario.hra_fin.value))
		    alert("El campo Hora Final esta vacio.");
		else if(isNum(formulario.can_std.value)==true)
		  	alert("El campo Cantidad Letrina STD tiene que ser numerico.");	
		else if(isNum(formulario.can_ip.value)==true)
		  	alert("El campo Cantidad Letrina IP tiene que ser numerico.");	
		else if(isNum(formulario.can_vip.value)==true)
		  	alert("El campo Cantidad Letrina VIP tiene que ser numerico.");	
		else if((formulario.can_std.value + formulario.can_ip.value + formulario.can_vip.value) > 0
				 && formulario.can_dias.value == 0 )	
		    alert("Si es alquiler de Letrinas debe ingresar el número de días ");
		else if(isNum(formulario.can_801.value)==true)
		  	alert("El campo Cantidad Duchas Portatiles tiene que ser numerico.");
		else if((formulario.can_801.value > 0) && formulario.dias_801.value == 0 )	
		    alert("Si es alquiler de Duchas Portatiles debe ingresar el número de días ");	
		else if(isNum(formulario.can_804.value)==true)
		  	alert("El campo Cantidad Urinario Portatiles tiene que ser numerico.");
		else if((formulario.can_804.value > 0) && formulario.dias_804.value == 0 )	
		    alert("Si es alquiler de Urinario Portatiles debe ingresar el número de días ");
		else if((formulario.s_vol.value > 0) && formulario.n_via.value == 0 )	
		    alert("Debe ingresar Nro. viajes ");	
		else if((formulario.s_vol.value > 0) && formulario.mon_803.value == 0 )	
		    alert("Debe ingresar Monto de servicio 803 ");	
		else if((formulario.t_806.value > 0) && formulario.mon_806.value == 0 )	
		    alert("Debe ingresar Monto de servicio 806 ");	
		else if((formulario.c_825.value > 0) && formulario.mon_825.value == 0 )	
		    alert("Debe ingresar Monto de servicio 825 ");	
		else if((formulario.c_825.value == 0) && formulario.mon_825.value > 0 )	
		    alert("Debe ingresar Numero de Camaras servicio 825 ");	
		else if((formulario.c_825.value > 0) && formulario.mon_825.value == 0 )	
		    alert("Debe ingresar Monto de servicio 825 ");	
		else if((formulario.com_826.value <> "") && formulario.mon_826.value == 0 )	
		    alert("Debe ingresar Monto de servicio 826 ");		
		else if(vacio(form.can_std.value) && vacio(form.can_ip.value) && vacio(form.can_vip.value)
			 && vacio(form.can_801.value) && vacio(form.can_804.value) && 
			 vacio(form.c_803.value) && vacio(form.c_806.value) && vacio(form.c_825.value)&& vacio(form.c_826.value))
		  	ventana=confirm("Realmente quieres consultar con los Campos vacios");
		
		else{
			
			return(true);
		}
		return(false);
  }