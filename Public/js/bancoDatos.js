sumaDiasFaseNegociacionComecial();
function comercial() {
	var n = $('#estadoUsuariocom').val();
	if (n.toLowerCase() == 'comercial' | n.toLowerCase() == 'administrador') {
		$('#noPermisos').hide('slow');
		$("#comercial").show();
		$("#detallePais").html('Comercial')
		$("#rolesDetalles").hide('slow');
		$("#ventas").hide('slow');
	   $("#emsivoz").hide('slow');
	   $("#telefonia").hide('slow');
	   $("#pais").hide('slow');
	   $('#banco').hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#dreamDetallePBX").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#canalesT").hide('slow');
		$("#canalesContratados").hide('slow');
		$("#serviciosNube").hide('slow');
		$("#licenciaNube").hide('slow')
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow')
		$('#MetaMes').hide('slow');
		$("#internet").hide('slow');
	}else{
		$('#noPermisos').show('slow');
		$('.imgBanco').hide();

		$("#rolesDetalles").hide('slow');
		$("#ventas").hide('slow');
	   $("#emsivoz").hide('slow');
	   $("#telefonia").hide('slow');
	   $("#pais").hide('slow');
	   $('#banco').hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#dreamDetallePBX").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#canalesT").hide('slow');
		$("#canalesContratados").hide('slow');
		$("#serviciosNube").hide('slow');
		$("#licenciaNube").hide('slow')
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow')
		$('#MetaMes').hide('slow');
		$("#internet").hide('slow');

	}
}



	// funcion para sumar los dias de cada una de las fase de negociacion en el area comercial
	function sumaDiasFaseNegociacionComecial() {
		var param ={'Funcion':'diasFinalesComercial'}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data + ' kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk' )
			}
		});
	}

	function contactosComercial() {
		$("#contactos_Comercial").show('slow')
		sumaDiasFaseNegociacionComecial();
		setTimeout(function(){
			selectContactosGestion();
		},1500);
	}

	function registroContComercial() {
		$("#tableComercial").hide();
		$('#btn-regis-comercial').hide();
		$('#titleComercial').hide();
		$('#con_comercial').hide();
		$('#ContenRegistroContComercial').show('slow');
	}
	function volverComercial() {
		$('#reset_form_Contacto').click(); // reseteamos el formulario para que no hayan cruce de datos
		sumaDiasFaseNegociacionComecial(); // actualizamos datos de en la DB
		setTimeout(function(){
			selectContactosGestion(); // ejecutamos la funcion para que nos muestre los datos verdaderos de la DB
		},1500);
		$("#contactos_Comercial").show('slow');
		$("#tableComercial").show('slow');
		$('#btn-regis-comercial').show('slow');
		$('#ContenRegistroContComercial').hide();
		$('#ContenUpdateContComercial').hide();
		$('#content_agregarTarea').hide();
		$('#agregar_tarea').show(); // cuando se abren detalles para agregar tareas, se oculta el boton , lo que hacemos aca es que cuando cerramos el contenido de actualizar usuario, le volvemos a dar la opcion de que aparesca.

	}
		function selectContactosGestion() {
			var param ={'Funcion':'selectContactosGestion'}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data )
					var json = JSON.parse(data)	
					// tabla vista general
					htm = "";
					for ( i = 0; i< json.length; i++ ) {

					   htm=htm + '<tr>' + 
					    '<td>' + 
					    '<a style=" font-size:20px; color: blue;" id="del_Free" onclick="verContactoGestion('+json[i]['id']+')">' + 
					        '<i class=\"fa fa-low-vision\" aria-hidden=\"true\"></i>' + 
					    '</a>' + 
					    '</td>' +
					    '<td>' + json[i]['nombre_cliente'] + '</td>' + 
					    '<td>' + json[i]['tipo_cliente'] + '</td>' + 
					    '<td>' + json[i]['sector_economico'] + '</td>' + 
					    '<td>' + json[i]['servicio'] + ',' + json[i]['subservicio'] + '</td>' + 
					    '<td>' + json[i]['competencia'] + '</td>' + 
					    '<td>' + json[i]['asesor_comercial'] + '</td>' + 
					    '<td>' + json[i]['confianza'] + '</td>' + 
					    '<td>' + json[i]['comunicacion'] + '</td>' + 
					    '<td>' + json[i]['cooperacion'] + '</td>' + 

					    '<td>' + 
					    '<a style=" font-size:20px; color: green;" id="del_Free" onclick="detalleGestion('+json[i]['id']+')">' + 
					        '<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
					    '</a>' + 
					    '</td>' + 
					    '<td>' + 
					        '<a style=" font-size:20px; color: red;" id="del_Free" onclick="dDeteleGestion('+json[i]['id']+')">' + 
					            '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
					        '</a>' + 
				        '</td>' + 
				        '</tr>'  ;
					}
					$('#cuerpoGestionCo').html(htm);  

				}
			});
		}
		function verContactoGestion(id) {
			var param ={'Funcion':'verInformacionContactos', 'id':id, 'variable':'1'};
			$.ajax({
			   data: JSON.stringify (param),
			   //async: false,
			   type:"JSON",
			   url: 'ajax.php',
			   success:function(data){
			      console.log(data + ' detalles tareas')
			      var json = JSON.parse(data)
			      
			      	var conf = "";
			      	var comun = "";
			      	var coop = "";
						for (var i = 0; i< json.length; i++ ) {
							var estado = json[i].estado;
							if(json[i].archivo == null){
									archivo = "";
								}else{
									archivo = '<a href="App/Controllers/Archives/' + json[i].archivo + '" target="_blank">Ver </a>';
								}

							if (estado == "Confianza") {
								
								conf = conf + '<tr>' +
									'<td>' + json[i].fecha + '</td>' +
									'<td>' + json[i].descripcion + '</td>' +
									'<td>' + json[i].actividad + '</td>' +
									'<td>' + json[i].resultado + '</td>' +
									'<td>' + json[i].estado + '</td>' +
									'<td>' +archivo+'</td>' + 
								'<tr>';	
							}else{
								if (estado == "Comunicacion") {
									comun = comun + '<tr>' +
										'<td>' + json[i].fecha + '</td>' +
										'<td>' + json[i].descripcion + '</td>' +
										'<td>' + json[i].actividad + '</td>' +
										'<td>' + json[i].resultado + '</td>' +
										'<td>' + json[i].estado + '</td>' +
										'<td>' + archivo + '</td>' + 
									'<tr>';	
								}else{
									if (estado == "Cooperacion") {
										coop = coop + '<tr>' +
											'<td>' + json[i].fecha + '</td>' +
											'<td>' + json[i].descripcion + '</td>' +
											'<td>' + json[i].actividad + '</td>' +
											'<td>' + json[i].resultado + '</td>' +
											'<td>' + json[i].estado + '</td>' +
											'<td>' + archivo + '</td>' + 
										'<tr>';	
									}
								}
							}					
						}
						$('#detaConfianza').html(conf)
						$('#detaComunicacion').html(comun)
						$('#detaCooperacion').html(coop)
						console.log(conf + ' confianza')
						console.log(comun + ' comunicacion')
						console.log(coop + ' cooperacion')

			     

			      var param ={'Funcion':'verInformacionContactos', 'id':id, 'variable':'2'};
					$.ajax({
					   data: JSON.stringify (param),
					   //async: false,
					   type:"JSON",
					   url: 'ajax.php',
					   success:function(data){
					      console.log(data + ' detalles tareas')

					      var usu = JSON.parse(data);
					      var monto = usu[0].monto;
					      var negocio = usu[0].negocio_exitoso;
					      if (monto == null ) {
					      	monto = '-';
					      }else{
					      	monto= monto;
					      }

					      if (negocio == null ) {
					      	negocio = 'En proceso...';
					      }else{
					      	negocio= negocio;
					      }

					      $('#verContactos').click();

					      $('#nombInfo').val(usu[0].nombre_cliente)
					      $('#tpInfo').val(usu[0].tipo_cliente)
					      $('#s_eInfo').val(usu[0].sector_economico)
					      $('#sgInfo').val(usu[0].servicio)
					      $('#compInfo').val(usu[0].competencia)
					      $('#asesInfo').val(usu[0].asesor_comercial)

					      var comunicacion = usu[0].comunicacion
					      var cooperacion = usu[0].cooperacion

					      if (comunicacion == false ) {
					      	fase = 'Confianza';
					      }else{
					      	if (cooperacion == false ) {
					      		fase = 'Comunicacion';
					      	}else{
					      		fase = 'Cooperacion';
					      	}
					      }

					      var fcomun = usu[0].comunicacion;
					      if (fcomun == false ) {
					      	fcomun = ' - ';
					      }else{
					      	fcomun = fcomun;
					      }

					      var fcoop = usu[0].cooperacion;
					      if (fcoop == false ) {
					      	fcoop = ' - ';
					      }else{
					      	fcoop = fcomun;
					      }
					      var fdias = usu[0].totalDias;
					      if (fdias == 0 ) {
					      	fdias = ' - ';
					      }else{
					      	fdias = fdias;
					      }

					      $('#faseInfo').val(fase)
					      $('#negInfo').val(negocio)
					     	$('#montoInfo').val(monto)
					      $('#fconfianza').html(usu[0].confianza)
					      $('#fcomunicacion').html(fcomun)
					      $('#fcooperacion').html(fcoop)
					     	$('#fdias').html(fdias)



					      
					      var usu = JSON.parse(data);

					      htm = "";
							for ( i = 0; i< json.length; i++ ) {
					      	htm = htm;
					      }
					   }
					});
			   }
			});
		}
		var nav4 = window.Event ? true : false; 
		function acceptNum(evt){  
		// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57  
		var key = nav4 ? evt.which : evt.keyCode;  
		return (key <= 13 || (key >= 48 && key <= 57) || key==46); 
		} 

		function detalleGestion(id){
			var param ={'Funcion':'detalleGestion', 'id':id};
			$.ajax({
			   data: JSON.stringify (param),
			   //async: false,
			   type:"JSON",
			   url: 'ajax.php',
			   success:function(data){
			      //console.log(data)
			      var datos = JSON.parse(data)

			      $("#tableComercial").hide();
					$('#btn-regis-comercial').hide();
					$('#titleComercial').hide();
					$('#ContenUpdateContComercial').show('slow');

					var id = datos[0].id;

					
					$('#id_codGestion').val(datos[0]['id'])
			      $('#nomb_gestU').val(datos[0]['nombre_cliente'])
			      $('#tipo_clienteU').val(datos[0].tipo_cliente);
			      //console.log('paso 1')
					        
					$('#sector_economicoU').val(datos[0]['sector_economico'])
					ser = datos[0]['servicio'];
					ser = ser.split(",");
					console.log(ser)
					num_ser = $('#num_servicesU').val();
					for(i = 1;i<=num_ser;i++){
						document.getElementById('servicio'+i+'U').checked = false;
					}

					for(j = 0; j < ser.length;j++){
						for(i = 1;i<=num_ser;i++){

							tipo_ser = $('#tiposervicio'+i+'U').val();
							console.log(tipo_ser)
							if(ser[j] == tipo_ser){
								document.getElementById('servicio'+i+'U').checked = true;
							}
						}
					}
					subser = datos[0]['subservicio'];
					subser = subser.split(",");
					console.log(subser + ' subservicios')
					num_subs = $('#num_subservicesU').val();
					for(i = 1;i<=num_subs;i++){
						document.getElementById('subservicio'+i+'U').checked = false;
					}

					for(j = 0; j < subser.length;j++){
						for(i = 1;i<=num_subs;i++){


							tipo_subs = $('#nomSubservicio'+i+'U').val();
							console.log(tipo_subs)
							if(subser[j] == tipo_subs){
								document.getElementById('subservicio'+i+'U').checked = true;
							}
						}
					}

					$('#positive').val(datos[0]['cosas_positivas'])
					$('#dudas').val(datos[0]['dudas'])

					$('#competecia_gestionU').val(datos[0]['competencia'])
					$('#asesor_comercialU').val(datos[0]['asesor_comercial'])
					

					var conf = datos[0]['fecha_registro'];
					var com = datos[0]['comunicacion'];
					var coop = datos[0]['cooperacion'];
					console.log(conf + ' confianza')
					console.log(com + ' comunicacion')
					console.log( coop + ' cooperacion')

					// si cooperacion trae fecha quiere decir que el negocio ha sido exitoso
					if (coop != false ) {
						$('#val_update').val('Cooperacion');

						var opcion = '<option value="Cooperacion" >Cooperacion</option>'; // una sola opcion ...no puede retroceder fase
						$('#fase_atencionU').html(opcion); // abrimos opcion de fase
						$('#optCooperacion').show(); // mostramos opcion de negocio exitoso! si-no
						$('#negocioExitoU').val(datos[0].negocio_exitoso)
						$('#fecha_registroU').val(coop); // imprimimos fecha de registro de cooperacion
						//var monto = formatearNumero(datos[0]['monto'])
						var monto = datos[0]['monto'];
						//console.log(monto + ' monto')
						$('#monto_gestionU').val(monto)
						//console.log('entro a cooperacion') 

						var rTarea = '<option value="0" selected></option>' + 
							'<option value="Entrega Propuesta" >Entrega Propuesta</option>' +
							'<option value="Firma Contrato" >Firma Contrato</option>' + 
							'<option value="Rechaza Oferta" >Rechaza Oferta</option>' + 
							'<option value="Instalada" >Instalada</option>';
							$('#resultadoTarea').html(rTarea);

						var fase = 'Cooperacion';
						selectTareas(id,fase)

					}else{
						// si comunicacion trae fecha quiere decir que solo puede avanzar a cooperacion
						if (com != false) {
							$('#val_update').val('Comunicacion');

							var opcion = '<option value="Comunicacion" >Comunicacion</option>' + '<option value="Cooperacion" >Cooperacion</option>';
							$('#fase_atencionU').html(opcion);
							$('#fecha_registroU').val(com); // imprimimos fecha de registro de comunicacion
							$('#optCooperacion').hide();
							
							var fase = 'Comunicacion';
							selectTareas(id,fase);
							//console.log('entro a Comunicacion')

						}else{
							if (conf != false ) {
								$('#val_update').val('Confianza');

								var opcion = '<option value="Confianza" >Confianza</option>' + '<option value="Comunicacion" >Comunicacion</option>';
								$('#fase_atencionU').html(opcion);
								$('#fecha_registroU').val(conf); // imprimimos fecha de registro de confianza
								$('#optCooperacion').hide();

								var fase = 'Confianza';
								selectTareas(id,fase)


								//console.log('entro a confianza')
							}
						}
					}
			   }
			});
		}
		function selectTareas(id,fase) {
			var param ={'Funcion':'selectTareas', 'id':id, 'fase':fase};
			$.ajax({
				data: JSON.stringify (param),
				//async: false,
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data );
					var json = JSON.parse(data);
					ht = "";
					for ( i = 0; i< json.length; i++ ) {
						console.log(json[i].archivo)
						if(json[i].archivo == null){
							archivo = "";
						}else{
							archivo = '<a href="App/Controllers/Archives/' + json[i].archivo + '" target="_blank">Ver </a>';
						}
						ht = ht + ' <tr> ' + 
							'<td>' + json[i].fecha + ' </td>' + 
							'<td>' + json[i].hora + ' </td>' + 
							'<td>' + json[i].descripcion + ' </td>' + 
							'<td>' + json[i].actividad + ' </td>' + 
							'<td>' + json[i].resultado + ' </td>' + 
							'<td>' + archivo + '</td>' + 
							'</tr>';
					}
					$('#cuerpoTareas').html(ht);
				}
			});  
		}

		function agregarTarea() {
			$('#content_agregarTarea').show('slow');
			$('#agregar_tarea').hide()
		}

		function selectSubservicio($servicio){
			var param = {'Funcion': 'ComercialSubServicios', 'servicio': $servicio}
			$.ajax({
			   data: JSON.stringify (param),
			   type:"JSON",
			   url: 'ajax.php',
			   success:function(data){
			   	console.log(data);
			   	var json = JSON.parse(data);
			if(json != 0){
				htm = "";
				ht="";
				for ( i = 1; i< json.length; i++ ) {
			   		htm = htm +  
							'<input type="hidden" name="nomSubservicio'+i+'" id="nomSubservicio'+i+'" value="'+json[i]['nombre_subservicio']+'">' +
							'<br><div class="form-group col-xs-12" style="float:left;text-align:left;margin-top:5px"> ' +
							'<input type="checkbox" name="subservicio'+i+'" id="subservicio'+i+'" value="'+json[i]['nombre_subservicio']+'">' +
                            '<label for="subservicio'+i+'">'+json[i]['nombre_subservicio']+'</label>' + 
                            '</div>';  
							
			   	}
			   	i=i-1;
			   	ht= ht + '<input type="hidden" name="num_subservices" id="num_subservices" value="'+i+'">';
			   	$('#verSubservicios').click();
			   	$('#prod').html(htm);
			   	$('#totsser').html(ht);
			
		}else{
			console.log($servicio);
		}
	}

});

		}

		function updateSubservicio($servicio){
			var param = {'Funcion': 'ComercialSubServicios', 'servicio': $servicio}
			$.ajax({
			   data: JSON.stringify (param),
			   type:"JSON",
			   url: 'ajax.php',
			   success:function(data){
			   	//console.log(data);
			   	var json = JSON.parse(data);
			if(json != 0){
				htm = "";
				ht="";
				for ( i = 1; i< json.length; i++ ) {
			   		htm = htm +  
							'<input type="hidden" name="nomSubservicio'+i+'U" id="nomSubservicio'+i+'U" value="'+json[i]['nombre_subservicio']+'">' +
							'<br><div class="form-group col-xs-12" style="float:left;text-align:left;margin-top:5px"> ' +
							'<input type="checkbox" name="subservicio'+i+'U" id="subservicio'+i+'U" value="'+json[i]['nombre_subservicio']+'">' +
                            '<label for="subservicio'+i+'U">'+json[i]['nombre_subservicio']+'</label>' + 
                            '</div>';  
							
			   	}
			   	i=i-1;
			   	ht= ht + '<input type="hidden" name="num_subservicesU" id="num_subservicesU" value="'+i+'">';
			   	$('#updateSubs').click();
			   	$('#prod2').html(htm);
			   	$('#totsser2').html(ht);

			   	}else{
			console.log($servicio);
		}
	}

});

		}

		function updateGestion(){
			
			var id = $('#id_codGestion').val()
			var id_val = $('#val_update').val()
			var nombre = $('#nomb_gestU').val()
			var tipo_c = $('#tipo_clienteU').val()
			var sector_e = $('#sector_economicoU').val()
			var num_services = $('#num_servicesU').val()
			var services = [];
			for(i = 1; i <= num_services;i++){
				servicio = $('#servicio'+i+'U').is(':checked');
				tipo_ser = $('#tiposervicio'+i+'U').val();
				services.push({'servicio': servicio,'tipo_ser':tipo_ser});
			}
			//console.log(services)
			var num_subservices = $('#num_subservicesU').val();
			var subservices = [];
			for(i = 1; i <= num_subservices;i++){
				subservicio = $('#subservicio'+i+'U').is(':checked');
				tipo_subser = $('#nomSubservicio'+i+'U').val();
				subservices.push({'subservicio': subservicio,'tipo_subservicio':tipo_subser});
			}
			console.log(subservices)

			var competencia = $('#competecia_gestionU').val()
			var asesor = $('#asesor_comercialU').val()
			var fase = $('#fase_atencionU').val()
			var monto = $('#monto_gestionU').val()
			var negocio = $('#negocioExitoU').val()

			var fechaTarea = $('#fecha_Tarea').val()
			var horaTarea = $('#hora_Tarea').val()
			var descripcionTarea = $('#descripcionTarea').val()
			var actividadTarea = $('#actividadTarea').val()
			var resultadoTarea = $('#resultadoTarea').val()

			var cosas_positivas = $('#positive').val();
			var dudas = $('#dudas').val();
			//console.log(cosas_positivas + ' ' + dudas)

			var param ={'Funcion':'updateGestion', 'id':id, 'id_val':id_val, 'fechaTarea':fechaTarea,'horaTarea':horaTarea, 'descripcionTarea':descripcionTarea, 'actividadTarea':actividadTarea, 'resultadoTarea':resultadoTarea,  'nombre':nombre, 'tipo_c':tipo_c, 'sector_e':sector_e, 'servicio':services, 'subservicio':subservices, 'cosas_positivas':cosas_positivas, 'dudas':dudas, 'competencia':competencia, 'asesor':asesor, 'fase':fase, 'negocio':negocio, 'monto':monto }
			console.log(param);
			$.ajax({
			   data: JSON.stringify (param),
			   type:"JSON",
			   url: 'ajax.php',
			   success:function(data){
			   	data = JSON.parse(data);

			      console.log(data + ' actualizado Gestion ')
			      if ( data != 0 ) {
			      	var file_data = $('#file').prop('files')[0];
			      	//if (file_data.length>0) {
						console.log(file_data) 
					    var form_data = new FormData();                  
					    form_data.append('file', file_data);
					    form_data.append('cod', data);
					                      
					    $.ajax({
					                url: 'App/Controllers/uploadFile.php', // point to server-side PHP script 
					                cache: false,
					                contentType: false,
					                processData: false,
					                data: form_data,                         
					                type: 'POST',
					                success: function(php_script_response){
					                    console.log(php_script_response); // display response from the PHP script, if any
					                }  
					     });
					//}
			      	toastr["success"]("Se ha actualizado Contacto !", {timeOut: 10})
			      	sumaDiasFaseNegociacionComecial();
			      	$("#contactos_Comercial").hide()
			      	setTimeout(function(){
							contactosComercial();
							$("#contactos_Comercial").show('slow')
						},3000);
						//$('#reset_Update_Contacto').click();
						$('#reset_Update_Contacto').click();
						$('#content_agregarTarea').hide();
						detalleGestion(id);
						$('#agregar_tarea').show()
					}else{
						toastr.error('No se puede actulizar Contacto !', 'Error', {timeOut: 15})
					}
				}
			});
		}
		function dDeteleGestion(id) {
			var param ={'Funcion':'detalleGestion', 'id':id};
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data)
					var datos = JSON.parse(data)
					var d = datos[0]['id']
					$('#delete-gestion').click();
					$('#iddelldGest').val(datos[0]['id']);
					$('#nombre_Del_Gestion').html(datos[0]['nombre_cliente']);
						
				}
			});
		}
		function deleteGestion() {
			var id = $('#iddelldGest').val()
			var param ={'Funcion':'deleteGestion', 'id':id }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data + ' eliminado')
					if ( data > 0 ) {
						toastr["success"]("Se ha eliminado Contacto!", {timeOut: 10000})
						selectContactosGestion();
						$('#NodeleteGestion').click()
					}else{
						toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
					}
				}
			});
		}
		function insertGestionContacComercia() {
			var nombre = $('#nomb_gest').val()
			var tipo_c = $('#tipo_cliente').val()
			var sector_e = $('#sector_economico').val()
			var competencia = $('#competecia_gestion').val()
			var asesor = $('#asesor_comercial').val()
			var fase = $('#fase_atencion').val()
			var fecha = $('#fecha_registro').val()
			var num_services = $('#num_services').val();
			var services = [];
			for(i = 1; i <= num_services;i++){
				servicio = $('#servicio'+i).is(':checked');
				tipo_ser = $('#tiposervicio'+i).val();
				services.push({'servicio': servicio,'tipo_ser':tipo_ser});
			}
			var num_subservices = $('#num_subservices').val();
			var subservices = [];
			for(i = 1; i <= num_subservices;i++){
				subservicio = $('#subservicio'+i).is(':checked');
				tipo_subser = $('#nomSubservicio'+i).val();
				subservices.push({'subservicio': subservicio,'tipo_subser':tipo_subser});
			}
			//console.log(services)
			var param ={'Funcion':'insertGestion','nombre':nombre, 'tipo_c':tipo_c, 'sector_e':sector_e, 'servicio':services, 'subservicio':subservices, 'competencia':competencia, 'asesor':asesor, 'fase':fase,'fecha':fecha }
			console.log(param);
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data)
					if (data > 0) {
						toastr["success"]("Se ha Registrado un nuevo Contacto!", {timeOut: 100})
						selectContactosGestion()
						$('#reset_insert_Contacto').click()
						volverComercial()
					}else{
						toastr.error('Vuelve a intentarlo ! ...', 'Error!', {timeOut: 150})
					}
				}
			});
		}



function servicios() {

	var n = $('#estadoUsuarioser').val();
	if (n.toLowerCase() == 'servicios' | n.toLowerCase() == 'administrador') {
		$('#noPermisos').hide('slow');
		$("#serviciosNube").show();
		$("#comercial").hide('slow');
		$("#TbalanceComercial").hide('slow')
		$("#contactos_Comercial").hide('slow')
		$("#rolesDetalles").hide('slow');
		$("#ventas").hide('slow');
	   $("#emsivoz").hide('slow');
	   $("#telefonia").hide('slow');
	   $("#pais").hide('slow');
	   $('#banco').hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#dreamDetallePBX").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#canalesT").hide('slow');
		$("#canalesContratados").hide('slow');
		$("#detallePais").html('Servicios')
		$("#TablaUsuariosClienteNube").hide('slow')
		$('#MetaMes').hide('slow');
		// ejecutamos funciones en servicio nube para actualalizar 
		// espacio diponible y usado en cliente y usuarios
		selectConRetenRespaldo(); // seleccionamos espacio de usado en Grupos de repado y actualizamos en usuarios
		selectConRetenUsuarios(); // seleccionamos espacio utilizado en usuarios y lo actualizamos en clientes.
	}else{
		$('#noPermisos').show('slow');
		$('.imgBanco').hide();

		$("#comercial").hide('slow');
		$("#TbalanceComercial").hide('slow')
		$("#contactos_Comercial").hide('slow')
		$("#rolesDetalles").hide('slow');
		$("#ventas").hide('slow');
	   $("#emsivoz").hide('slow');
	   $("#telefonia").hide('slow');
	   $("#pais").hide('slow');
	   $('#banco').hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#dreamDetallePBX").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#canalesT").hide('slow');
		$("#canalesContratados").hide('slow');
		$("#detallePais").html('Servicios')
		$("#TablaUsuariosClienteNube").hide('slow')
		$('#MetaMes').hide('slow');
	}
}
	var espacioDisCliente = 0;
	var espacioUsadoCliente = 0;
	var espacioUsadoUsuarios = 0;
	var espacioDisUsuarios = 0;
	// funciones para saber el espacio disponible de cliente y usuario 
	// bien sea para registrar o para actualizar
	function valEspacioDispCliente(cod){
		var param ={'Funcion':'select_EspacioDispClientes', 'cod':cod }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data + ' ********************')
				var json = JSON.parse(data);
				var usado = json[0].totaUsado;
				var disponible = json[0].disponible;
				espacioDisCliente = parseFloat(disponible)
				espacioUsadoCliente = parseFloat(usado)

				//console.log(usado + ' usado')
				//console.log(disponible + ' disponible ')
				$('#infoEspaDisClienteInsert').html('*Espacio Disponible: ' + espacioDisCliente + ' GB' );
			}
		});
	}
	function valEspacioDispUsuarios(cod) {
		//console.log(cod + ' oooiiiiiiiii')
		var param ={'Funcion':'select_EspacioDispUsuarios', 'cod':cod }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data + ' ________________________-')
				var json = JSON.parse(data);
				var usado = json[0].totaUsado;
				var disponible = json[0].disponible;
				espacioDisUsuarios = parseFloat(disponible)
				espacioUsadoUsuarios = parseFloat(usado)

				//console.log(usado + ' usado')
				//console.log(disponible + ' diponible')
				$('#infoEsp_disponibleInsert').html('*Espacio Disponible: ' + espacioDisUsuarios + ' GB' );
				$('#espacRetencion').val(espacioDisUsuarios);
			}
		});
	}
	// funciones de actualizacion del espacio usado 
	function selectConRetenRespaldo() {
		var param ={'Funcion':'selectConRetenRespaldo' }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data )
				var json = JSON.parse(data);
				console.log(json)
				for ( i = 0; i< json.length; i++ ) {

					var cod = json[i].id_us;
					var consumido = json[i].capacidad;
					var retencion = json[i].retencion;
					var param ={'Funcion':'consRetenUsuarios', 'cod':cod, 'consumido':consumido, 'retencion':retencion, }
					$.ajax({
						data: JSON.stringify (param),
						type:"JSON",
						url: 'ajax.php',
						success:function(data){
							//console.log(data )
						}
					});
				}
			}
		});
	}
	function selectConRetenUsuarios() {
		var param ={'Funcion':'selectConRetenUsuarios' }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data + ' aaaaaaaaa')
				var json = JSON.parse(data);
				for ( i = 0; i< json.length; i++ ) {

					var cod = json[i].id_cli;
					var consumido = json[i].cosumido;
					
					var param ={'Funcion':'consRetenClientes', 'cod':cod, 'consumido':consumido }
					$.ajax({
						data: JSON.stringify (param),
						type:"JSON",
						url: 'ajax.php',
						success:function(data){
							//console.log(data + ' ooooooo')
						}
					});
				}
			}
		});
	}

	// funciones de licencia de Nube
	function licenciaNube() {
		$("#licenciaNube").show()
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$('#TablaUsuariosClienteNube').hide('slow')
		var param ={'Funcion':'selectLicenciaNube' }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data)
				var json = JSON.parse(data);
				htm = "";

				for ( i = 0; i< json.length; i++ ) {
					var cod = json[i].lic_id;
					var saldo = formatearNumero(json[i].monto)
					htm = htm + '<tr>' +
					'<td>'+json[i].fechaCa+'</td>' +
					'<td>'+json[i].fechaUl+'</td>' +
					'<td>'+ '$ '+ saldo +'</td>' +
					'<td>' + 
					   '<a style=" font-size:20px; color: green;" id="del_Free" onclick="detalleLicencia('+cod+')">' + 
					      '<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
					   '</a>' + 
					'</td>' + 
					'</tr>';
				}
				$('#cuerpoLicenciaNubes').html(htm);
			}
		});
	}
	function detalleLicencia(cod) {
		var param ={'Funcion':'selectLicenciaDetalle', 'cod':cod }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data)
				var datos = JSON.parse(data)
				$('#estado-licenciaNube').click();		        

				$('#fechaCaduLicencia').val(datos[0]['fechaCa']);
				$('#ultimoPago').val(datos[0]['fechaUl']);
				$('#montoLicencia').val(datos[0]['monto']);
			}
		});
	}
	function updateLicenciaNube(){
		var fechaCaducidad = $('#fechaCaduLicencia').val()
		var montoLicencia = $('#montoLicencia').val()
		var ultimoPago = $('#ultimoPago').val()
		//console.log(fechaCaducidad)
		//console.log(montoLicencia)
		var param ={'Funcion':'updateLicenciaNube', 'fechaCaducidad':fechaCaducidad, 'ultimoPago':ultimoPago, 'montoLicencia':montoLicencia }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				toastr["success"]("Se ha actualizado Licencia!", {timeOut: 10000})
				licenciaNube();
				$('#cerrarLicencia').click()
			}
		});
	}

	// funcion mostrar datos cliente
	function clienteNube() {
		$("#TablaClientesNube").show(); // mostramos tabla cliente
		$("#TablaGrespaldoNube").hide('slow'); // ocultamos tabla usuarios si esta abierta

		$('#TablaGrespaldoNube').hide();	
		$('#TablaUsuariosClienteNube').hide();
		
		$("#TablaUsuariosNube").hide('slow') // ocultamos tabla usuarios si esta abierta
		$("#TablaGrespaldoNube").hide('slow') // ocultamos tabla usuarios si esta abierta
		$("#licenciaNube").hide('slow') // ocultamos tabla licencia nube si esta abierta
		selectConRetenUsuarios();
		setTimeout(function(){
			var param ={'Funcion':'selectServiciosNube'}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(dataT){
					//console.log(dataT)
					var json = JSON.parse(dataT);
					htm = "";

					for ( i = 0; i< json.length; i++ ) {
						// armamos tabla de nombre, consumido, capacidad
						// opcion de eliminar, actualizar y eliminar cliente
						// opcion de ver usuarios, insertar, borrar y actualiar
						var cod = json[i].cli_id;

						htm = htm + '<tr>' +
						'<td>'+json[i].cli_nombre+'</td>' +
						'<td>'+json[i].cli_capacidad+'</td>' +
						'<td>'+json[i].consumido+'</td>' +
						'<td>'+json[i].consuUsuarios+'</td>' +
						'<td>'+
							'<a style=" font-size:20px; color: green;" id="detaCliente" onclick="detalleUsuarios('+cod+')">' + 
						            '<i class=\"fa fa-low-vision\" aria-hidden=\"true\"></i>' + 
						   '</a>' +
						'</td>'+
						'<td>' + 
						   '<a style=" font-size:20px; color: green;" id="UpCliente" onclick="detalleCliente('+cod+')">' + 
						      '<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
						   '</a>' + 
						'</td>' + 
						'<td>' + 
						   '<a style=" font-size:20px; color: red;" id="deleteCliente" onclick="detalleDeleteCliente('+cod+')">' + 
						      '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
						   '</a>' + 
					   '</td>' + 
						'</tr>';
					}
					$('#cuerpoClientesServNube').html(htm);
					
				}
			});
		},500);
	}
	function detalleUsuarios(cod) {
		$('#detalleRegreso').val(cod);

		$('#TablaClientesNube').hide('slow'); // ocultamos tabla clientes
		$("#TablaUsuariosClienteNube").show(); // mostramos tabla usuarios - informacion para clientes
		$('#id_ClienteInsert').val(cod); // al insertar usuario este pertenece a un cliente, este es el codigo del cliente insertado
		valEspacioDispCliente(cod); // ejecutamos para saber espacio disponible del cliente por si hace un insert o un actualizar
		setTimeout(function(){
			var param ={'Funcion':'selecUsuariosClienteNube', 'cod':cod }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data)
					//console.log(espacioDisCliente + ' espacio disponible cliente')
					var json = JSON.parse(data)	

					$('#clienteDetalle').html(json[0].nomCliente);
					$('#valOptDetalleUsuario').val(0);
					var num = 1; 
					htm = "";
					for ( i = 0; i< json.length; i++ ) {
						htm=htm + '<tr>' + 
							'<td>' + json[i]['nombreUsuario'] + '</td>' + 
							'<td>' + json[i]['cuotaUsuario'] + '</td>' + 
							'<td>' + json[i]['consumido'] + '</td>' + 
							'<td>' + json[i]['retencion'] + '</td>' +
							'<td>' + json[i]['totalUtilizado'] + '</td>' +
							'<td>' + 
								'<a style=" font-size:20px; color: green;" id="del_Free" onclick="detalleGrRespaldo('+json[i]['cod']+')">' + 
						        '<i class=\"fa fa-low-vision\" aria-hidden=\"true\"></i>' + 
						    	'</a>' + 
							'</td>' +

							'<td>' + 
						    	'<a style=" font-size:20px; color: green;" id="del_Free" onclick="detalleUsuarioNube('+json[i]['cod']+ ','+ num + ' )">' + 
						        '<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
						    	'</a>' + 
						   '</td>' + 
						   '<td>' + 
						      '<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalleDeteleUsuario('+json[i]['cod']+','+ num + ' )">' + 
						         '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
						      '</a>' + 
					      '</td>' + 
					   '</tr>'  ;
					}
					$('#cuerpoUsuariosClienteServNube').html(htm); 
				}
			});
		},500);
	}
		function insertUsuarioNube() {
			var id_cli = $('#id_ClienteInsert').val()
			var nombreUs = $('#nombreClienteinsert').val()
			var cuotaUs = $('#cuotaClienteinsert').val()
			if (cuotaUs > espacioDisCliente) {
				toastr.warning('No tienes suficiente espacio ! <br> Disponible:' + espacioDisCliente + ' GB ', 'Error !' , {timeOut: 5000})
			}else{
				var param ={'Funcion':'insertUsuarioNube', 'id_cli':id_cli, 'nombreUs':nombreUs, 'cuotaUs':cuotaUs  }
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						if (data > 0) {
							valEspacioDispCliente(id_cli); // ejecutamos funcion para actualizar DB sobre espacio disponible
							toastr["success"]("Se ha Registrado un nuevo Usuario!", {timeOut: 10000})
							$('#reset_insert_UsuarioNube').click()
							$('#cerrarModalUsuario').click()	
							setTimeout(function(){ // damos tiempo de que se actualicen los datos de cliente
								selectConRetenUsuarios(); // ejecutamos funcion para actualizar espacio disponible de cliente
								detalleUsuarios(id_cli) // ejecutamos funcion con el codigo de usuario que se acaba de insertar
							},2000);
						}else{
							toastr.error('Vuelve a intentarlo ! ...', 'Error!', {timeOut: 15000})
						}
					}
				});				
			}
		}
		function detalleUsuarioNube(cod, num){
			//console.log(cod + ' ---------------')
			//console.log(num + ' ------+++++++++---------')
			//console.log(espacioDisCliente + ' espacio disponible cliente')
			var param ={'Funcion':'detalleUsuarioNube', 'cod':cod }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data + ' ==================000')
					var datos = JSON.parse(data)
						
					$('#estado-usuarioNube').click();		        
					// mostramos informacion sobre le espacio disponible
					$('#infoEspaDisClienteUpdate').html('*Espacio Disponible: ' + espacioDisCliente + ' GB' );

					$('#id_userNu').val(datos[0]['us_id']);
					$('#idClienteUsuario').val(datos[0]['id_cli']);
					$('#detalleDesde').val(num);
					$('#nombre_user').val(datos[0]['us_nombre']);
					$('#cuotaUser').val(datos[0]['us_cuota']);
					$('#cuotaAlmacenada').val(datos[0]['us_cuota']);
				}
			});
		}
		function updateUsuarioNube() {
			var idU = $('#id_userNu').val()
			var idclienteUsu = $('#idClienteUsuario').val()
			var nombreU = $('#nombre_user').val()
			var cuotaU = $('#cuotaUser').val()
			var cuotaAlm = $('#cuotaAlmacenada').val()
			var detalleDesde = $('#detalleDesde').val()

			var tCuota = parseInt(cuotaAlm) + parseInt(espacioDisCliente);

			if (cuotaU > tCuota) {
				toastr.warning('No tienes suficiente espacio ! <br> Disponible:' + espacioDisCliente + ' GB ', 'Error !' , {timeOut: 5000})
			}else{
				var param ={'Funcion':'updateUsuarioNube', 'idU':idU, 'nombreU':nombreU, 'cuotaU':cuotaU }
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						toastr["success"]("Se ha actualizado Usuario!", {timeOut: 10000})
						if (detalleDesde == 1) {
							detalleUsuarios(idclienteUsu)
						}else{
							usuariosNube();
						}
						setTimeout(function(){
							selectConRetenUsuarios(); // ejecutamos funcion para actualizar espacio disponible de cliente
							valEspacioDispCliente(idclienteUsu);
						},1700);
						$('#cerrarUsuario').click()
					}
				});
			}
		}
		function detalleDeteleUsuario(cod, num){
			//console.log(cod)
			var param ={'Funcion':'detalleUsuarioNube', 'cod':cod }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data)
					var datos = JSON.parse(data)
					

					$('#delete-usuarioNube').click();	        
					$('#deleteDesde').val(num);
					$('#id_clienteUs').val(datos[0]['id_cli']);
					$('#idUsuarioN').val(datos[0]['us_id']);
					$('#nombUsuarionube').html(datos[0]['us_nombre']);
				}
			});
		}
		function deleteUsuarioNube() {
				var cod = $('#idUsuarioN').val()
				var idclienteUs = $('#id_clienteUs').val()
				var deleteDesde = $('#deleteDesde').val()
				var param ={'Funcion':'deleteUsuarioNube', 'cod':cod }
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						console.log(data + ' eliminado')
						if ( data > 0 ) {
							toastr["success"]("Se ha eliminado Usuario!", {timeOut: 10000})
							if (deleteDesde == 1) {
								detalleUsuarios(idclienteUs)
							}else{
								usuariosNube();
							}
							setTimeout(function(){
								selectConRetenUsuarios(); // ejecutamos funcion para actualizar espacio disponible de cliente
								valEspacioDispCliente(idclienteUs);
							},1700);

							$('#NodeleteUsuario').click()
						}else{
							toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
						}
					}
				});
		}
	
	function detalleCliente(cod) {
		valEspacioDispCliente(cod);
		var param ={'Funcion':'selecClientesNube', 'cod':cod }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data)
				var datos = JSON.parse(data)
				$('#estado-clienteNube').click();		        

				$('#infoEspaDisClienteUpdate').html('*Espacio Disponible: ' + espacioDisCliente + ' GB' );
				$('#idclienteU').val(datos[0]['cli_id']);
				$('#nombre_clienteU').val(datos[0]['cli_nombre']);
				$('#capacidadClienteU').val(datos[0]['cli_capacidad']);
			}
		});
	}
	function updateClienteNube(){
		var idclic = $('#idclienteU').val()
		var nombrecli = $('#nombre_clienteU').val()
		var capacidadcli = $('#capacidadClienteU').val()
		//console.log(idclic)
		//console.log(nombrecli)
		//console.log(capacidadcli)
		var param ={'Funcion':'updateClienteNube', 'idclic':idclic, 'nombrecli':nombrecli, 'capacidadcli':capacidadcli }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				toastr["success"]("Se ha actualizado Cliente!", {timeOut: 10000})
				selectConRetenRespaldo();
				selectConRetenUsuarios();
				setTimeout(function(){
					clienteNube();
					$('#cerrarCliente').click()
				},500);
			}
		});
	}
	function detalleDeleteCliente(cod){
		//console.log(cod)
		var param ={'Funcion':'selecClientesNube', 'cod':cod }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data)
				var datos = JSON.parse(data)
				
				$('#delete-clienteNube').click();	        

				$('#idClienteN').val(datos[0]['cli_id']);
				$('#nombClientenube').html(datos[0]['cli_nombre']);
			}
		});
	}
	function deleteClienteNube() {
			var cod = $('#idClienteN').val()
			//console.log(cod + ' 00000')
			var param ={'Funcion':'deleteClienteNube', 'cod':cod }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data + ' eliminado')
					if ( data > 0 ) {
						toastr["success"]("Se ha eliminado Cliente!", {timeOut: 10000})
						clienteNube();
						$('#NodeleteCliente').click()
					}else{
						toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
					}
				}
			});
	}
	function insertClienteNube() {
		var nombreCli = $('#nomCliente').val()
		var capacidadCli = $('#capacidadCliente').val()
		//console.log(nombreCli)
		//console.log(capacidadCli)
		var param ={'Funcion':'insertClienteNube', 'nombreCli':nombreCli, 'capacidadCli':capacidadCli  }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				if (data > 0) {
					toastr["success"]("Se ha Registrado un nuevo Cliente!", {timeOut: 10000})
					clienteNube();
					$('#reset_insert_ClienteNube').click()
					$('#cerrarModalCliente').click()	
				}else{
					toastr.error('Vuelve a intentarlo ! ...', 'Error!', {timeOut: 15000})
				}
			}
		});
	}

	function detallleDeRegresoGrResp() {
		var n = $('#detalleRegreso').val();

		if (n != 0 ) {
			$("#TablaGrespaldoNube").hide('slow');
			$('#TablaGrespaldoNube').hide();	
			detalleUsuarios(n)
		}else{
			usuariosNube();
		}
	}
	// funciones de usuario 
	function usuariosNube() {
		$('#detalleRegreso').val(0);
		$("#TablaUsuariosNube").show()
		$("#TablaClientesNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow');
		$("#licenciaNube").hide('slow')
		selectConRetenUsuarios();
		setTimeout(function(){
			var param ={'Funcion':'selectUsuariosNube' }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data)
					var json = JSON.parse(data)	
					var num = 2;
					$('#valOptDetalleUsuario').val(1);

					htm = "";
					for ( i = 0; i< json.length; i++ ) {
						var nombre_u = json[i]['nombreUsuario'];

						htm=htm + '<tr>' + 
							'<td>' + nombre_u + '</td>' + 
							'<td>' + json[i]['cuotaUsuario'] + '</td>' + 
							'<td>' + json[i]['consumido'] + '</td>' + 
							'<td>' + json[i]['retencion'] + '</td>' +
							'<td>' + json[i]['totalUtilizado'] + '</td>' +
							'<td>' + 
								'<a style=" font-size:20px; color: green;" id="del_Free" onclick="detalleGrRespaldo('+json[i]['cod']+')">' + 
						        '<i class=\"fa fa-low-vision\" aria-hidden=\"true\"></i>' + 
						    	'</a>' + 
							'</td>' +
							
							'<td>' + 
						    	'<a style=" font-size:20px; color: green;" id="del_Free" onclick="usuariosDetalleUsuarioNube('+json[i]['cod']+',' + num + ')">' + 
						        '<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
						    	'</a>' + 
						   '</td>' + 
						   '<td>' + 
						      '<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalleDeteleUsuario('+json[i]['cod']+')">' + 
						         '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
						      '</a>' + 
					      '</td>' + 
					   '</tr>'  ;
					}
					$('#cuerpoUsuariosServNube').html(htm); 
				}
			});
		},500);
	}
		function usuariosDetalleUsuarioNube(cod, num){
			//console.log(cod)
			var param ={'Funcion':'detalleUsuarioNube', 'cod':cod }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					var datos = JSON.parse(data)
						
					$('#estado-usuarioNube').click();
					var cod = parseInt(datos[0]['id_cli'])  ;	 
					//console.log(cod + ' aaaaaaaaaaaaaaaaaaaaaaaaa') 
					valEspacioDispCliente(cod);      

					$('#infoEspaDisClienteUpdate').html('*Espacio Disponible: ' + espacioDisCliente + ' GB' );
					$('#id_userNu').val(datos[0]['us_id']);
					$('#detalleDesde').val(num);
					$('#nombre_user').val(datos[0]['us_nombre']);
					$('#cuotaUser').val(datos[0]['us_cuota']);
				}
			});
		}
	
	
	
	function detalleGrRespaldo(cod){
		console.log(cod + ' ===============00000000')
		valEspacioDispUsuarios(cod);

		$('#id_usInsert').val(cod); 
		var param ={'Funcion':'detalleGrRespaldo', 'cod':cod }
		$('#cuerpoGrespaldoServNube').html('');
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data + ' ..................')
				var datos = JSON.parse(data)

				var n = $('#valOptDetalleUsuario').val();
				console.log(n)
				if (n == 0 ) {
					$('#TablaGrespaldoNube').show();	
					$("#TablaClientesNube").hide(); // mostramos tabla cliente
					$("#TablaUsuariosClienteNube").hide('slow'); // ocultamos tabla usuarios si esta abierta
					$("#TablaUsuariosNube").hide('slow') // ocultamos tabla usuarios si esta abierta
					$("#licenciaNube").hide('slow') // ocultamos tabla licencia nube si esta abierta
				}else{
					$('#TablaUsuariosNube').hide('slow');	
					$('#TablaGrespaldoNube').show();	
					$('#TablaGrespaldoNube').css('margin-top','40px')					
				}



				if (datos != 0 ) {
					$('#no_usuSerNube').html("<br> Cliente: "+datos[0]['nomCliente'] +" <br> Usuario: "+datos[0]['nomUsu']);
				}


				htm = "";
				for ( i = 0; i< datos.length; i++ ) {
					htm=htm + '<tr>' + 
						'<td>' + datos[i]['nombreGR'] + '</td>' + 
						'<td>' + datos[i]['capacidaGR'] + '</td>' + 
						'<td>' + datos[i]['retencionGR'] + '</td>' + 
						'<td>' + 
					    	'<a style=" font-size:20px; color: green;" id="del_Free" onclick="RespaldoDetalle('+datos[i]['gres_id']+')">' + 
					        '<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
					    	'</a>' + 
					   '</td>' + 
					   '<td>' + 
					      '<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalleDeteleRepaldo('+datos[i]['gres_id']+')">' + 
					         '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
					      '</a>' + 
				      '</td>' + 
					'</tr>';
				}	
				$('#cuerpoGrespaldoServNube').html(htm); 
				$('#idUsinsert').html(cod); 
			}
		});
	}
		function RespaldoDetalle(gres_id){
			//console.log(gres_id)
			var param ={'Funcion':'respaldoDetalle', 'gres_id':gres_id }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					var datos = JSON.parse(data)
						
					$('#estado-RepaldoNube').click();	

					$('#infoEsp_disponible').html('*Espacio Disponible: ' + espacioDisUsuarios + ' GB' );

					$('#dispRetencion').val(espacioDisUsuarios);
					$('#gres_idU').val(datos[0]['gres_id']);
					$('#idUsU').val(datos[0]['idU']);
					$('#nombreGRU').val(datos[0]['nombreGR']);
					$('#capacidaGRU').val(datos[0]['capacidaGR']);
					$('#retencionGRU').val(datos[0]['retencionGR']);
					var espAlmacenado = parseFloat(datos[0]['capacidaGR']) + parseFloat(datos[0]['retencionGR'])
					$('#AlmacenadoRetencion').val(espAlmacenado);
				}
			});
		}
		function updateRetencionNube() {
			var idU = $('#gres_idU').val()
			var nombreR = $('#nombreGRU').val()
			var capacidadR = $('#capacidaGRU').val()
			var retencionR =  $('#retencionGRU').val()
			var idUsu = $('#idUsU').val()
			
			var disponible = parseInt( $('#dispRetencion').val()  );
			var almacenado = $('#AlmacenadoRetencion').val();

			var newEspacio = parseFloat(capacidadR) + parseFloat(retencionR);
			var tAlmDis = parseFloat(disponible) + parseFloat(almacenado);

			if (newEspacio > tAlmDis) {
				toastr.warning('No tienes suficiente espacio ! <br> Disponible:' + tAlmDis + ' GB ', 'Error !' , {timeOut: 5000})
			}else{
				var param ={'Funcion':'updateRetencionNube', 'idU':idU, 'nombreR':nombreR, 'capacidadR':capacidadR, 'retencionR':retencionR }
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						toastr["success"]("Se ha actualizado Retencion!", {timeOut: 10000})
							selectConRetenRespaldo();
							detalleGrRespaldo(idUsu);
							setTimeout(function(){
								valEspacioDispUsuarios(idUsu)
							},2000);
							$('#cerrarRetencion').click()
				
					}
				});
			}
		}
		function detalleDeteleRepaldo(gres_id){
			//console.log(gres_id)
			var param ={'Funcion':'respaldoDetalle', 'gres_id':gres_id }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data)
					var datos = JSON.parse(data)
						
					$('#delete-repaldo').click();	        

					$('#id_gresDel').val(datos[0]['gres_id']);
					$('#id_userDel').val(datos[0]['idU']);
					$('#nombGresNube').html(datos[0]['nombreGR']);
				}
			});
		}
		function deleteRespaldo() {
				var cod = $('#id_gresDel').val()
				var idUsuD = $('#id_userDel').val()
				//console.log(cod + ' ooooooooooooooooooooo')
				var param ={'Funcion':'deleteRespaldo', 'cod':cod }
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data + ' eliminado')
						if ( data > 0 ) {
							selectConRetenRespaldo();
							toastr["success"]("Se ha eliminado Respado!", {timeOut: 10000})
							detalleGrRespaldo(idUsuD);
							$('#NodeleteRespaldo').click()
							setTimeout(function(){
								valEspacioDispUsuarios(idUsuD)
							},2000);
							
						}else{
							toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
						}
					}
				});
		}
		function insertRepaldoNube() {
			var id_us = $('#id_usInsert').val()
			var nombreRe = $('#nombreGRinsert').val()
			var capacidadRe = $('#capacidaGRinsert').val()
			var retencionRe = $('#retencionGRinsert').val()

			var EspacioEntra = parseFloat(capacidadRe) + parseFloat(retencionRe);
			var d = $('#espacRetencion').val()
			if (EspacioEntra > d) {
				toastr.warning('No tienes suficiente espacio ! <br> Disponible:' + d + ' GB ', 'Error !' , {timeOut: 5000})
			}else{
				var param ={'Funcion':'insertRepaldoNube', 'id_us':id_us, 'nombreRe':nombreRe, 'capacidadRe':capacidadRe, 'retencionRe':retencionRe }
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						if (data > 0) {
							selectConRetenRespaldo();
							toastr["success"]("Se ha Registrado un nuevo Repado!", {timeOut: 10000})
							detalleGrRespaldo(id_us);
							$('#reset_insert_RespaldoNube').click()
							$('#cerrarModalRespaldo').click()	
							setTimeout(function(){
								valEspacioDispUsuarios(id_us)
							},1500);
						}else{
							toastr.error('Vuelve a intentarlo ! ...', 'Error!', {timeOut: 15000})
						}
					}
				});
			}
		}




function internet() {
	var n = $('#estadoUsuarioint').val();
	if (n.toLowerCase() == 'internet' | n.toLowerCase() == 'administrador') {
		$('#noPermisos').hide('slow');
		$("#internet").show();
		$("#detallePais").html('Internet')
		$("#ventas").hide('slow');
	   $("#emsivoz").hide('slow');
	   $("#telefonia").hide('slow');
	   $("#pais").hide('slow');
	   $('#banco').hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#dreamDetallePBX").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#canalesT").hide('slow');
		$("#rolesDetalles").hide('slow');
		$("#contactos_Comercial").hide('slow')
		$("#TbalanceComercial").hide('slow')
		$("#comercial").hide('slow');
		$("#licenciaNube").hide('slow')
		$("#serviciosNube").hide('slow');
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow')
		$('#MetaMes').hide('slow');
		selecCanalesContratados();
		detEspacioUsado(); // funcion de verificacion de espacio disponible 	
	}else{
		$('#noPermisos').show('slow');
		$('.imgBanco').hide();

		$("#ventas").hide('slow');
	   $("#emsivoz").hide('slow');
	   $("#telefonia").hide('slow');
	   $("#pais").hide('slow');
	   $('#banco').hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#dreamDetallePBX").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#canalesT").hide('slow');
		$("#rolesDetalles").hide('slow');
		$("#contactos_Comercial").hide('slow')
		$("#TbalanceComercial").hide('slow')
		$("#comercial").hide('slow');
		$("#licenciaNube").hide('slow')
		$("#serviciosNube").hide('slow');
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow')
		$('#MetaMes').hide('slow');
	}
}
	function canalesContratados() {
		$("#canalesContratados").show();
		selecCanalesContratados();
		$("#usoEspacio").hide('slow')
	}
		function selecCanalesContratados() {
			var param ={'Funcion':'selecCanalesContratados'}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data )
					var json = JSON.parse(data)	
					// tabla vista general
					htm = "";
					for ( i = 0; i< json.length; i++ ) {

					   htm=htm + '<tr>' + 
					    '<td>' + json[i]['nombre'] + '</td>' + 
					    '<td>' + json[i]['megas'] + '</td>' + 

					    '<td>' + 
					    '<a style=" font-size:20px; color: green;" id="del_Free" onclick="detalleCanalesContrados('+json[i]['id']+')">' + 
					        '<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
					    '</a>' + 
					    '</td>' + 
					    '<td>' + 
					        '<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalledeleteCc('+json[i]['id']+')">' + 
					            '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
					        '</a>' + 
				        '</td>' + 
				        '</tr>'  ;
					}
					$('#cuerpoCanalContratado').html(htm);  
				}
			});
		}
		function detalleCanalesContrados(id){
			console.log(id)
			var param ={'Funcion':'detalleCanalesContrados', 'id':id};
			$.ajax({
			    data: JSON.stringify (param),
			    async: false,
			    type:"JSON",
			    url: 'ajax.php',
			    success:function(data){
			        console.log(data)
			        var datos = JSON.parse(data)
					
					$('#estado-cc').click();		        

					$('#id_cc').val(datos[0]['id']);
					$('#nom_cc').val(datos[0]['nombre']);
					$('#megas').val(datos[0]['megas']);
			   }
			});
		}
		function updateCanalesContrados() {
			var id = $('#id_cc').val()
			var nombre = $('#nom_cc').val()
			var megas = $('#megas').val()
			console.log()

			var param ={'Funcion':'updateCanalesContrados', 'id':id, 'nombre':nombre, 'megas':megas  };
			$.ajax({
			   data: JSON.stringify (param),
			   type:"JSON",
			   url: 'ajax.php',
			   success:function(data){
			      console.log(data + ' actualizado Canal ')
			      if ( data > 0 ) {
			      	toastr["success"]("Se ha actualizado Canal !", {timeOut: 10000})
						selecCanalesContratados();
						detEspacioUsado(); // funcion de verificacion de espacio disponible 
						$('#reset_Update_cc').click()
						$('#cerrarCcU').click()
					}else{
						toastr.error('No se puede actulizar Canal !', 'Error', {timeOut: 15000})
					}
				}
			});
		}
		function detalledeleteCc(id) {
			var param ={'Funcion':'detalleCanalesContrados', 'id':id};
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data)
					var datos = JSON.parse(data)
					$('#id_can_cD').val(datos[0]['id']);
					$('#nombre_ccD').html(datos[0]['nombre']);
						
					$('#delete-cc').click();
				}
			});
		}
		function deleteCanalesContratados() {
			var id = $('#id_can_cD').val()
			var param ={'Funcion':'deleteCanalesContratados', 'id':id }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data + ' eliminado')
					if ( data > 0 ) {
						toastr["success"]("Se ha eliminado canal !", {timeOut: 10000})
						selecCanalesContratados();
						detEspacioUsado(); // funcion de verificacion de espacio disponible 
						$('#NodeleteCc').click()
					}else{
						toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
					}
				}
			});
		}
		function inserCanalesContratados() {
			var nombre = $('#nom_canalC').val()
			var megas = $('#megas_canal').val()
			var param ={'Funcion':'inserCanalesContratados', 'megas':megas, 'nombre':nombre }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					if (data > 0) {
						toastr["success"]("Se ha Registrado un nuevo canal!", {timeOut: 10000})
						selecCanalesContratados()
						$('#reset_insert_Cc').click()
						$('#cerrarModalCc').click()
					}else{
						toastr.error('Canal ya existe ! ...', 'Error!', {timeOut: 15000})
					}
				}
			});
		}
	function EspacioUsado() {
		$("#usoEspacio").show();
		selecEspacioUsado();
		detEspacioUsado(); // funcion de verificacion de espacio disponible 
		$("#canalesContratados").hide('slow')
	}
		function detEspacioUsado() {
			var param ={'Funcion':'detallesEspacioUsado'}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data + ' ______________________________________-')
				}
			});
		}

		function selecEspacioUsado() {
			var param ={'Funcion':'selecEspacioUsado'}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data )
					var json = JSON.parse(data)	
					// tabla vista general
					htm = "";
					for ( i = 0; i< json.length; i++ ) {

					   htm=htm + '<tr>' + 
					    '<td>' + json[i]['capacidad'] + ' Mbps' + '</td>' + 
					    '<td>' + json[i]['usado'] + ' Mbps' + '</td>' + 
					    '<td>' + json[i]['fecha'] + '</td>' + 

					    '<td>' + 
					    '<a style=" font-size:20px; color: green;" id="del_Free" onclick="detallesEspacioUsado('+json[i]['id']+')">' + 
					        '<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
					    '</a>' + 
					    '</td>' + 
					   '</tr>'  ;
					}
					$('#cuerpousoEspacio').html(htm);  
				}
			});
		}
		function detallesEspacioUsado(id){
			var param ={'Funcion':'selecEspacioUsado'};
			$.ajax({
			    data: JSON.stringify (param),
			    async: false,
			    type:"JSON",
			    url: 'ajax.php',
			    success:function(data){
			        console.log(data)
			        var datos = JSON.parse(data)
					
					$('#estado-espacioUsado').click();		        
					$('#capacidadEspacio').html(datos[0]['capacidad'] );

					$('#id_usado').val(datos[0]['id']);
					$('#espacioUsado').val(datos[0]['usado']);
			   }
			});
		}
		function updateEspacioUsado() {
			var id = $('#id_usado').val()
			var usado = $('#espacioUsado').val()
			var capacidad = $('#capacidadEspacio').html()
			console.log(id)
			console.log(usado + ' usado')
			console.log(capacidad + ' capacidad')
			var param ={'Funcion':'updateEspacioUsado', 'id':id, 'usado':usado, 'capacidad':capacidad  };
			$.ajax({
			   data: JSON.stringify (param),
			   type:"JSON",
			   url: 'ajax.php',
			   success:function(data){
			      console.log(data + ' actualizado Canal ')
			      if ( data > 0 ) {
			      	toastr["success"]("Se ha actualizado Espacio Usado !", {timeOut: 10000})
			      	detEspacioUsado(); // funcion de verificacion de espacio disponible 
						selecEspacioUsado();
						$('#cerrarEspacio').click()
					}else{
						toastr.error('No se puede actulizar Espacio Usado !', 'Error', {timeOut: 15000})
					}
				}
			});
		}




function telefonia() {
	var n = $('#estadoUsuariotel').val();
	if (n.toLowerCase() == 'telefonia' | n.toLowerCase() == 'administrador') {
		$('#noPermisos').hide('slow');
	   $("#telefonia").show();
		$("#detallePais").html("Telefonía")
	   $("#pais").hide('slow');
	   $('#banco').hide('slow');
	   $("#emsivoz").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#ventas").hide('slow');
		$('#MetaMes').hide('slow');
		$("#canalesT").hide('slow');
		$("#rolesDetalles").hide('slow');
		$("#canalesContratados").hide('slow');
		$("#contactos_Comercial").hide('slow')
		$("#TbalanceComercial").hide('slow')
		$("#comercial").hide('slow');
		$("#licenciaNube").hide('slow')
		$("#serviciosNube").hide('slow');
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow')	
	}else{
		$('#noPermisos').show('slow');
		$('.imgBanco').hide();

	   $("#pais").hide('slow');
	   $('#banco').hide('slow');
	   $("#emsivoz").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#ventas").hide('slow');
		$('#MetaMes').hide('slow');
		$("#canalesT").hide('slow');
		$("#rolesDetalles").hide('slow');
		$("#canalesContratados").hide('slow');
		$("#contactos_Comercial").hide('slow')
		$("#TbalanceComercial").hide('slow')
		$("#comercial").hide('slow');
		$("#licenciaNube").hide('slow')
		$("#serviciosNube").hide('slow');
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow')	
	}

}
	function canales() {
		$("#canalesT").show();
		$("#dreamDetallePBX").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		canalesDetalles();
	}
		function canalesDetalles() {
			var param ={'Funcion':'selectCanales', 'variable':'1'}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data )
					var json = JSON.parse(data)	
							// tabla vista general
					htm = "";
			      for ( i = 0; i< json.length; i++ ) {

			         htm=htm + '<tr>' + 
			            '<td>' + json[i]['nombre'] + '</td>' + 
			              
			            '<td>' + 
			             	'<a style=" font-size:20px; color: green;" id="del_Free" onclick="detalleCa('+json[i]['id']+')">' + 
			             		'<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
			             	'</a>' + 
			            '</td>' + 
			            '<td>' + 
			             	'<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalledeleteCa('+json[i]['id']+')">' + 
			            		'<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
			             	'</a>' + 
		               '</td>' + 
		            '</tr>'  ;
			      }
			      $('#cuerpoCanales').html(htm);  
				}
			});
		}
		function detalledeleteCa(id) {
			var param ={'Funcion':'detalleCanalesUno', 'id':id};
		    $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	console.log(data)
		        	var json = JSON.parse(data)

					$('#idCanal').val(  json[0].id  );
					$('#noCanal').html(json[0]['nombre']);

		        	$('#delete-canal').click();
		      }
		   });
		}
		function deleteCanal() {
			var id = $('#idCanal').val()
			console.log(id + ' ========00')
			var param ={'Funcion':'deleteCanales', 'id':id }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data)
					if (data != 0) {
						toastr["success"]("El canal ha sido eliminado!", {timeOut: 10000})
						canalesDetalles();
						$('#Nodeletecanal').click();
					}else{
						toastr.error('No se ha podido eliminar canal...', 'Error !', {timeOut: 15000})
					}
				}
			});
		}
		function detalleCa(id){
		  	var param ={'Funcion':'detalleCanalesUno', 'id':id};
		    $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	console.log(data)
		        	var json = JSON.parse(data)

		        	$('#estado-canal').click();

					$('#idCanal').val(  json[0].id  );
					$('#nombreCanal').val(  json[0].nombre  );

		      }
		   });
		}
		function updateCanales() {
			var nombre = $('#nombreCanal').val()
			var id = $('#idCanal').val()
			console.log(id)
			console.log(nombre + ' nombre')
			var param ={'Funcion':'updateCanales', 'nombre':nombre, 'id':id }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data)
					if (data != 0) {
						toastr["success"]("El canal se ha actualizado!", {timeOut: 10000})
						canalesDetalles();
						$('#cerrarCanal').click();
					}else{
						toastr.error('No se puede actualizar canal...', 'Error !', {timeOut: 15000})
					}
				}
			});
		}
		function verfi_insert_canales() {
			var nombre = $('#nomCanal').val();
			var param ={'Funcion':'verifCanales', 'nombre':nombre}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data)
					if (data != 0) {
						console.log('no se puede registrar')
						toastr.error('Error de registro ...', 'Canal ya existe !', {timeOut: 15000})
					}else{
						var nombre = $('#nomCanal').val();
						var param ={'Funcion':'insertCanales', 'nombre':nombre}
						$.ajax({
							data: JSON.stringify (param),
							type:"JSON",
							url: 'ajax.php',
							success:function(data){
								console.log(data)
								if ( data != 0 ) {
									toastr["success"]("Se ha insertado un nuevo canal!", {timeOut: 10000})
									canalesDetalles();
									$('#reset_insert_canal').click()
									$('#cerrarModalcanal').click()
								}else{
									toastr.error('No se ha podido insertar canal !', 'Error', {timeOut: 15000})
								}
							}
						});
					}
				}
			});
		}

	function dreamPBX(){
	   $("#dreamDetallePBX").show();
	   $("#freeDetallePBX").hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#canalesT").hide('slow');
	   selectDreamPBXbanco()
	}
		function verif_in_BancoDreamIp() {
			

			var ip_a = $('#ip_inicioDream').val();
			var ip_a1 = $('#ip_segundoDream').val();
			var ip_a2 = $('#ip_terceroDream').val();
			var ip_a3 = $('#ip_cuartoDream').val();
			var ip = ip_a + '.' + ip_a1 + '.' + ip_a2 + '.' + ip_a3  ;
			//console.log(ip + '==========')
			var param ={'Funcion':'verifBancoDreamIp', 'ip':ip}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					if ( data > 0 ) {
						toastr.error('Error de registro !', 'Ip ya Existe', {timeOut: 15000})
					}else{
						var ip = ip_a + '.' + ip_a1 + '.' + ip_a2 + '.' + ip_a3  ;
						var nombre = $('#nombreDream').val();

						var param ={'Funcion':'insertBancoDreamIp', 'ip':ip, 'nombre':nombre}
						$.ajax({
							data: JSON.stringify (param),
							type:"JSON",
							url: 'ajax.php',
							success:function(data){
								if ( data > 0 ) {
									toastr["success"]("Registro exitoso!", {timeOut: 10000})
									selectDreamPBXbanco();
									$('#reset_insertDream').click()
									$('#cerrarModalBancoDream').click()
								}else{
									toastr.error('Error de registro !', 'Ip ya Existe', {timeOut: 15000})
								}
							}
						});
					}
				}
			});
		}
		function selectDreamPBXbanco() {
			var param ={'Funcion':'selectDreamPBX'}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data )
					var json = JSON.parse(data)	
						// tabla vista general
						htm = "";
		            for ( i = 0; i< json.length; i++ ) {

		            	var num = formatearNumero(json[i].saldo)
		            	var estado = json[i]['estado'];

		               htm=htm + '<tr>' + 
		               	'<td>' + json[i]['nombre'] + '</td>' + 
		               	'<td>' + json[i]['ip_dato'] + '</td>' + 
		               	'<td>' + 
		               		'<a style=" font-size:20px; c" id="upd_Free" onclick="detalleUpdateDream('+json[i]['id']+')">' + 
		               			'<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
		               		'</a>' + 
		               	'</td>' +
		               	'<td>' + 
		               		'<a style=" font-size:20px; color: red;" id="del_Dream" onclick="detalleDream('+json[i]['id']+')">' + 
		               			'<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
		               		'</a>' + 
		               	'</td>' + '</tr>'  ;
		            }
		            $('#cuerpoDream').html(htm);  

				}
			});
		}
		function detalleUpdateDream(id){
		  	var param ={'Funcion':'detalleDream', 'id':id};
		    $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	//console.log(data)
		        	var datos = JSON.parse(data)
		        	var ip = datos[0]['ip_dato'];
		        	var valIp = ip.split('.')

					$('#updateDreamPBX').click();
		        	$('#idDreamUIp').val(datos[0]['id']);
					$('#ip_unoD').val(valIp[0]);
					$('#ip_dosD').val(valIp[1]);
					$('#ip_tresD').val(valIp[2]);
					$('#ip_cuartoD').val(valIp[3]);
					$('#nombreDr').val(datos[0].nombre);
					
		        
		      }
		   });
		}
		function updateDreamIp() {
			var idDrU = $('#idDreamUIp').val();
			var ipUno = $('#ip_unoD').val();
			var ipDos = $('#ip_dosD').val();
			var ipTres = $('#ip_tresD').val();
			var ipCuatro = $('#ip_cuartoD').val();
			var NombreIpDr = $('#nombreDr').val();

			var ipUpd = ipUno + '.' + ipDos + '.' + ipTres + '.' + ipCuatro;

			//console.log(idDrU)
			//console.log(ipUpd)
			//console.log(NombreIpDr)
			var param ={'Funcion':'updateDreamIp', 'idDrU':idDrU, 'NombreIpDr':NombreIpDr, 'ipUpd':ipUpd};
			$.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	//console.log(data + ' actualizado ')
		        	if ( data > 0 ) {
						toastr["success"]("Se ha actualizado un Registro!", {timeOut: 10000})
						selectDreamPBXbanco();
						$('#cerrarModalUpdDream').click()
					}else{
						toastr.error('No se ha podido actulizar !', 'Error', {timeOut: 15000})
					}
		      }
		   });
		}
		function detalleDream(id){
		  	var param ={'Funcion':'detalleDream', 'id':id};
		   $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	//console.log(data)
		        	var datos = JSON.parse(data)

					$('#ipDream').val(datos[0]['ip_dato']);
					$('#ipD').html(datos[0]['ip_dato']);
					
					$('#delete-DreamPBX').click();
		        
		      }
		   });
		}
		function deleteDream() {
			var ip = $('#ipDream').val();
			//console.log(ip)

			var param ={'Funcion':'deleteDream', 'ip':ip};
		    $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	//console.log(data + ' eliminado ')
		        	if ( data > 0 ) {
						toastr["success"]("Se ha eliminado un Registro!", {timeOut: 10000})
						selectDreamPBXbanco();
						$('#NodeleteDream').click()
					}else{
						toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
					}
		    	}
		   });
		}

	function freePBX(){
	   $("#freeDetallePBX").show();
	   $("#dreamDetallePBX").hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#canalesT").hide('slow');
	   selectFreePBXBanco()
	}
		function verif_in_BancoFreeIp() {
			var ip_a = $('#ip_inicioFree').val();
			var ip_a1 = $('#ip_segundoFree').val();
			var ip_a2 = $('#ip_terceroFree').val();
			var ip_a3 = $('#ip_cuartoFree').val();
			var ip = ip_a + '.' + ip_a1 + '.' + ip_a2 + '.' + ip_a3  ;

			var param ={'Funcion':'verifBancoFreeIp', 'ip':ip}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					if ( data > 0 ) {
						toastr.error('Error de registro !', 'Ip ya Existe', {timeOut: 15000})
					}else{
						var ip = ip_a + '.' + ip_a1 + '.' + ip_a2 + '.' + ip_a3  ;
						var nombre = $('#nombreFree').val();

						var param ={'Funcion':'insertBancoFreeIp', 'ip':ip, 'nombre':nombre}
						$.ajax({
							data: JSON.stringify (param),
							type:"JSON",
							url: 'ajax.php',
							success:function(data){
								if ( data > 0 ) {
									toastr["success"]("Registro exitoso!", {timeOut: 10000})
									selectFreePBXBanco();
									$('#reset_insertFree').click()
									$('#cerrarModalBancoFree').click()
								}else{
									toastr.error('Error de registro !', 'Ip ya Existe', {timeOut: 15000})
								}
							}
						});
					}
				}
			});
		}
		function selectFreePBXBanco() {
			var param ={'Funcion':'selectFreePBX'}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data )
					var json = JSON.parse(data)	
						// tabla vista general
						htm = "";
		            for ( i = 0; i< json.length; i++ ) {
		            	var num = formatearNumero(json[i].saldo)
		            	var estado = json[i]['estado'];

		               htm=htm + '<tr>' + 
		               	'<td>' + json[i]['nombre'] + '</td>' + 
		               	'<td>' + json[i]['ip_dato'] + '</td>' + 
		               	'<td>' + 
		               		'<a style=" font-size:20px; c" id="upd_Free" onclick="detalleUpdateFree('+json[i]['id']+')">' + 
		               			'<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
		               		'</a>' + 
		               	'</td>' +
		               	'<td>' + 
		               		'<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalleFree('+json[i]['id']+')">' + 
		               			'<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
		               		'</a>' + 
		               	'</td>' + '</tr>'  ;
		            }
		            $('#cuerpoFree').html(htm);  

				}
			});
		}
		function detalleUpdateFree(id){
		  	var param ={'Funcion':'detalleFree', 'id':id};
		   $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	//console.log(data)
		        	var datos = JSON.parse(data)
		        	var ip = datos[0]['ip_dato'];
		        	var valIp = ip.split('.')

					$('#updateFreePBX').click();
		        	$('#idFreUIp').val(datos[0]['id']);
					$('#ip_uno').val(valIp[0]);
					$('#ip_dos').val(valIp[1]);
					$('#ip_tres').val(valIp[2]);
					$('#ip_cuarto').val(valIp[3]);
					$('#nombreFr').val(datos[0].nombre);
					
		        
		      }
		   });
		}
		function updateFreeIp() {
			var idFrU = $('#idFreUIp').val();
			var ipUno = $('#ip_uno').val();
			var ipDos = $('#ip_dos').val();
			var ipTres = $('#ip_tres').val();
			var ipCuatro = $('#ip_cuarto').val();
			var NombreIpF = $('#nombreFr').val();

			var ipUpd = ipUno + '.' + ipDos + '.' + ipTres + '.' + ipCuatro;

			//console.log(idFrU)
			//console.log(ipUpd)
			//console.log(NombreIpF)
			var param ={'Funcion':'updateFreeIp', 'idFrU':idFrU, 'NombreIpF':NombreIpF, 'ipUpd':ipUpd};
			$.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	//console.log(data + ' actualizado ')
		        	if ( data > 0 ) {
						toastr["success"]("Se ha actualizado un Registro!", {timeOut: 10000})
						selectFreePBXBanco();
						$('#cerrarModalUpdFree').click()
					}else{
						toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
					}
		      }
		   });
		}
		function detalleFree(id){
		  	var param ={'Funcion':'detalleFree', 'id':id};
		   $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	//console.log(data)
		        	var datos = JSON.parse(data)
		        	//console.log(datos[0]['fecha'] + '?=================')
		        	//console.log(datos[0]['nombre'] + ' ******************')

					$('#ipFree').val(datos[0]['ip_dato']);
					$('#ipF').html(datos[0]['ip_dato']);
					
					$('#delete-FreePBX').click();
		        
		      }
		   });
		}
		function deleteFree() {
			var ip = $('#ipFree').val();
			//console.log(ip)

			var param ={'Funcion':'deleteFree', 'ip':ip};
		   $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	//console.log(data + ' eliminado ')
		        	if ( data > 0 ) {
						toastr["success"]("Se ha eliminado un Registro!", {timeOut: 10000})
						selectFreePBXBanco();
						$('#NodeleteFree').click()
					}else{
						toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
					}
		    	}
		   });
		}

	function recargas(){
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").show();
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#dreamDetallePBX").hide('slow');
		$("#freeDetallePBX").hide('slow');
		$("#canalesT").hide('slow');
	   selectRecargas()
	}
		function selectRecargas() {
			var param ={'Funcion':'saldoRecargas'}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data )
					var json = JSON.parse(data)	
						// tabla vista general
						htm = "";
						var moneda = "";
		            for ( i = 0; i< json.length; i++ ) {
		            	var estado = json[i]['estado'];
		            	var num = json[i]['saldo'];

		            	var moneda = json[i]['moneda'];
		            	if (moneda == 1) {
		            		moneda = "$";
		            	}else{
		            		if (moneda == 2) {
		            			moneda = "Bs.";
		            		}else{
		            			moneda = "USD";
		            		}
		            	}

		               htm=htm + '<tr>' + 
		               	'<td>' + json[i]['proveedor'] + '</td>' + 
		               	'<td>' + moneda + ' ' + num + '</td>' + 
		               	'<td>' + json[i]['fecha'] + '</td>' + 
		               	'<td>' + 
		               		'<a onclick="detalleRe('+json[i]['cod']+')">' + 
		               			'<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
		               		'</a>' + 
		               	'</td>' + 
		               	'<td>' + 
		               		'<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalledeleteRe('+json[i]['cod']+')">' + 
		               			'<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
		               		'</a>' + 
		               	'</td>' + '</tr>'  ;
		            }
		            $('#cuerpoRecargas').html(htm);  

				}
			});
		}
		function detalleRe(cod){
		  	var param ={'Funcion':'detalleRecargas', 'cod':cod};
		   $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	console.log(data)
		        	var datos = JSON.parse(data)
		        	var num = formatearNumero(datos[0]['saldo'])

					$('#cod').val(datos[0]['cod']);
					$('#moneda').val(datos[0]['moneda']);
					$('#proveedorR').val(datos[0]['proveedor']);
					$('#fechaRe').val(datos[0]['fecha']);
					$('#saldo').val(datos[0]['saldo']);
					
					$('#estado-recarga').click();
		        
		      }
		   });
		}
		function updateRecargaBanco() {
			var cod = $('#cod').val();
			var proveedor = $('#proveedorR').val();
			var saldo = $('#saldo').val();
			var moneda = $('#moneda').val();
			var fecha = $('#fechaRe').val();
			console.log(saldo + ' saldo')
			console.log(moneda + ' moneda')
			console.log(proveedor + ' proveedor')
			console.log(fecha + ' fecha')
			console.log(cod + ' codigo')

			var param ={'Funcion':'updateRecargas', 'cod':cod, 'proveedor':proveedor, 'saldo':saldo, 'moneda':moneda, 'fecha':fecha};
		   $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	console.log(data + ' actualizado ')
		        	if ( data > 0 ) {
						toastr["success"]("Se ha actualizado Recarga!", {timeOut: 10000})
						selectRecargas();
						$('#cerrarRecarga').click()
					}else{
						toastr.error('No se puede actulizar Recarga !', 'Error', {timeOut: 15000})
					}
		    	}
		   });
		}
		function detalledeleteRe(cod) {
			var param ={'Funcion':'detalleRecargas', 'cod':cod }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data)
					var datos = JSON.parse(data)
					$('#codPro').val(datos[0]['cod']);
					$('#proveedor').html(datos[0]['proveedor']);
					
					$('#delete-recarga').click();
				}
			});
		}
		function deleteRe() {
			var cod = $('#codPro').val();
			console.log(cod)
			var param ={'Funcion':'deleteRecargas', 'cod':cod }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data + ' eliminado')
					if ( data > 0 ) {
						toastr["success"]("Se ha eliminado un Registro!", {timeOut: 10000})
						selectRecargas();
						$('#NodeleteRe').click()
					}else{
						toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
					}
				}
			});
		}
		function insertRecargaBanco() {
			var nombre = $('#nombreProRecarga').val();
						
			var param ={'Funcion':'insert_proRecarga', 'nombre':nombre}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data)
					if (data != 0) {
						//console.log('registro exitoso')
						var nombre = $('#nombreProRecarga').val();
						var variable = 2; // verificamos llamamos al usuario recien ingresado
						var param ={'Funcion':'verif_pro_Recargas', 'nombre':nombre, 'variable':variable}
						$.ajax({
							data: JSON.stringify (param),
							type:"JSON",
							url: 'ajax.php',
							success:function(data){
								console.log(data)
								// insertamos registro de proveedor en facturacion
								var json = JSON.parse(data)
								var cod = json[0]['cod']
								var saldo = $('#saldoRecarga').val();
								var moneda = $('#tipo_moneda').val();
								var param ={'Funcion':'insert_Recarga', 'cod':cod, 'saldo':saldo, 'moneda':moneda}
								$.ajax({
									data: JSON.stringify (param),
									type:"JSON",
									url: 'ajax.php',
									success:function(data){
										//console.log(data)
										if ( data > 0 ) {
											toastr["success"]("Registro exitoso!", {timeOut: 10000})
											selectRecargas();
											$('#reset_insert_Recargas').click()
											$('#cerrarModalRecargas').click()
										}else{
											toastr.error('vulve a intentarlo...', 'Error de registro !', {timeOut: 15000})
										}
									}
								});
							}
						});
					}else{
						//console.log('no se ha podido registrar')
						toastr.warning('Algo ha salido mal ! vuelve a intentarlo...')
					}
				}
			});
		}
		
	function facturacion(){
	   $("#facturacion").show();
	   $("#recargasBanco").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#dreamDetallePBX").hide('slow');
		$("#freeDetallePBX").hide('slow');
		$("#dreamDetallePBX").hide('slow');
		$("#canalesT").hide('slow');
	   selectfacturacion()
	}
		function selectfacturacion() {
			var param ={'Funcion':'tofacturacion'}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data + '_____________-')
					var json = JSON.parse(data)	
					var comp = JSON.parse(data)
						//console.log(comp)

						// tabla vista general
						htm = "";
		            for ( i = 0; i< json.length; i++ ) {
		            	var num = formatearNumero(json[i].valor)
		            	var estado = json[i]['estado'];

		            	if (estado == 1) {
		            		estado = "<span style='color:#058e05'><b>Pagado </b>  </span>";
		            	}else{
		            		if (estado == 2) {
		            			estado = "<span style='color:#2b13a3'><b>Pendiente </b> </span>";
		            		}else{
		            			estado = "<span style='color:#d81717'><b>Atrasado </b> </span>";
		            		}
		            	}

		               htm=htm + '<tr>' + 
		               '<td>' + json[i]['proveedor'] + '</td>' + // proveedor
		               '<td>' + '$ ' + num + '</td>' + 				//valor
		               '<td>' + json[i]['fecha'] + '</td>' + 		// fecha
		               '<td>' + estado  + '</td>' + 					// estado
		               
		               '<td>' + // detalles Actualizar
		               	'<a style=" font-size:20px; color: green;" id="del_Free" onclick="detalleFa('+json[i]['cod']+')">' + 
		               		'<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
		               	'</a>' + 
		               '</td>' + 

		               '<td>' + // detalles delete
		               	'<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalledeleteFa('+json[i]['cod']+')">' + 
		               		'<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
		               	'</a>' + 
		               '</td>' + 

		               '</tr>'  ;
		            }
		            $('#cuerpofacturacion').html(htm);  

				}
			});
		}
		function detalleFa(cod){
			console.log(cod + ' oooooooooooooooooooooooooooooo')
		  	var param ={'Funcion':'detalleFacturacion', 'cod':cod};
		   $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	console.log(data + ' detalles facturacion')
		        	var datos = JSON.parse(data)
		        	var num = formatearNumero(datos[0]['valor'])
		        	console.log(datos[0]['proveedor'] + ' ******************')

					$('#cod').val(datos[0]['cod']);
					$('#proveedorFa').val(datos[0]['proveedor']);
					$('#valor').val(datos[0]['valor']);
					$('#fecha').val(datos[0]['fecha']);
					$('#estado').val(datos[0]['estado']);
					if (datos[0]['estado'] != 1 ) {
						$('#pend').click();
					}
					$('#estado-facturacion').click();
		        
		      }
		   });
		}
		function updatefacturacionBanco() {
			var cod = $('#cod').val();
			var proFacturacion = $('#proveedorFa').val();
			var valor = $('#valor').val();
			var fecha = $('#fecha').val();
			var estado = $('#estado').val();

			var param ={'Funcion':'updatefacturacion', 'cod':cod, 'proFacturacion':proFacturacion, 'valor':valor, 'fecha':fecha, 'estado':estado};
		   $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	//console.log(data + ' actualizado ')
		        	if ( data > 0 ) {
						toastr["success"]("Se ha actualizado Factura!", {timeOut: 10000})
						selectfacturacion();
						$('#cerrarFacturacion').click()
					}else{
						toastr.error('No se puede actulizar Registro !', 'Error', {timeOut: 15000})
					}
		    	}
		   });
		}
		function detalledeleteFa(cod) {
			var param ={'Funcion':'detalleFacturacion', 'cod':cod }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data)
					var datos = JSON.parse(data)
					$('#codProF').val(datos[0]['cod']);
					$('#proveedorF').html(datos[0]['proveedor']);
					
					$('#delete-facturacion').click();
				}
			});
		}
		function deleteFa() {
			var cod = $('#codProF').val();
			console.log(cod)
			var param ={'Funcion':'deleteFactura', 'cod':cod }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data + ' eliminado')
					if ( data > 0 ) {
						toastr["success"]("Se ha eliminado un Registro!", {timeOut: 10000})
						selectfacturacion();
						$('#NodeleteFa').click()
					}else{
						toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
					}
				}
			});
		}
		function insertfacturacionBanco() {
			var nombre = $('#nombreFacturacion').val();
			var param ={'Funcion':'insert_proFacturacion', 'nombre':nombre}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data)
					if (data != 0) {
						console.log('registro exitoso')
						 // verificamos llamamos al usuario recien ingresado
						var param ={'Funcion':'verif_pro_Facturacion', 'nombre':nombre}
						$.ajax({
							data: JSON.stringify (param),
							type:"JSON",
							url: 'ajax.php',
							success:function(data){
								console.log(data)
								// insertamos registro de proveedor en facturacion
								var json = JSON.parse(data);
								var cod = json[0]['cod'];
								var valor = $('#valorFacturacion').val();
								var fecha = $('#fechaLiFa').val();
								console.log(cod + ' codigo ')
								console.log(valor + ' valor')
								console.log(fecha + ' fecha')
								var param ={'Funcion':'insert_Facturacion', 'cod':cod, 'valor':valor, 'fecha':fecha}
								$.ajax({
									data: JSON.stringify (param),
									type:"JSON",
									url: 'ajax.php',
									success:function(data){
										//console.log(data)
										if ( data > 0 ) {
											toastr["success"]("Registro exitoso!", {timeOut: 10000})
											selectfacturacion();
											$('#reset_insert_facturacion').click()
											$('#cerrarModalFacturacion').click()
										}else{
											toastr.error('vulve a intentarlo...', 'Error de registro !', {timeOut: 15000})
										}
									}
								});
							}
						});
					}else{
					//console.log('no se ha podido registrar')
						toastr.warning('Algo ha salido mal ! vuelve a intentarlo...')
					}
				}
			});
		}



function emsivoz() {
	var n = $('#estadoUsuarioems').val();
	if (n.toLowerCase() == 'emsivoz' | n.toLowerCase() == 'administrador') {
		$('#noPermisos').hide('slow');
	   $("#emsivoz").show();
	   $("#pais").show();
	   $("#detallePais").show()
	   $('#banco').hide('slow');
	   $("#telefonia").hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#dreamDetallePBX").hide('slow');
	   $("#ventas").hide('slow');
	   $('#MetaMes').hide('slow');
	   $("#canalesT").hide('slow');
	   $("#rolesDetalles").hide('slow');
	   $("#canalesContratados").hide('slow');
	   $("#contactos_Comercial").hide('slow')
		$("#TbalanceComercial").hide('slow')
		$("#comercial").hide('slow');
		$("#licenciaNube").hide('slow')
		$("#serviciosNube").hide('slow');
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow')
	   Balance();
	}else{
		$('#noPermisos').show('slow');
		$('.imgBanco').hide();

	   $('#banco').hide('slow');
	   $("#telefonia").hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#dreamDetallePBX").hide('slow');
	   $("#ventas").hide('slow');
	   $('#MetaMes').hide('slow');
	   $("#canalesT").hide('slow');
	   $("#rolesDetalles").hide('slow');
	   $("#canalesContratados").hide('slow');
	   $("#contactos_Comercial").hide('slow')
		$("#TbalanceComercial").hide('slow')
		$("#comercial").hide('slow');
		$("#licenciaNube").hide('slow')
		$("#serviciosNube").hide('slow');
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow')
	}

}
	function Balance() {
		detalleWeb();
		detallePlayStore();
		detalleAppStore();
		detalleCampanna();
		var ejecutar = $('#pais').val();
	   if (ejecutar == 1) { $("#detallePais").html("Emsivoz Colombia") }
	   if (ejecutar == 2) { $("#detallePais").html("Emsivoz Venezuela") }
	   if (ejecutar == 3) { $("#detallePais").html("Emsivoz EEUU") }
	}
	function Web() {
		$("#contWeb").show(); 
		detalleWeb();
		$("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
	}
	function PlayStore() {
		$("#contPlayStore").show();
		detallePlayStore();
		$("#contWeb").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
	}
	function AppStore() {
		$("#contAppStore").show();
		detalleAppStore();
		$("#contWeb").hide('slow');
		$("#contPlayStore").hide('slow');
		$("#contCampanna").hide('slow');
	}
	function Campanna() {
		$("#contCampanna").show();
		detalleCampanna();
		$("#contWeb").hide('slow');
		$("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
	}
	function detalleWeb() {	
		var ejecutar = $('#pais').val();
		if (ejecutar > 0 ) {}else{ejecutar = 1; }
		var param ={'Funcion':'detalleWeb', 'ejecutar':ejecutar}
			$.ajax({
			   data: JSON.stringify (param),
			   type:"JSON",
			   url: 'ajax.php',
			   success:function(data){
			   	//console.log(data + ' !!!!!!!!!')
			    	var json = JSON.parse(data)	
				   htm = "";
				   var total = 0;
	            for ( i = 0; i< json.length; i++ ) {
	            	total = total + parseInt(json[i].visitas)
	               htm=htm + '<tr>' + 
	               	'<td>' + json[i]['visitas'] + '</td>' + 
	               	'<td>' + json[i]['fecha'] + '</td>' + 
	               	'<td>' + 
	               		'<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalleDeleteVisitasWeb('+json[i]['id']+')">' + 
					            '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
					        '</a>' +

	               	'</td>' + 
	               '</tr>'  ;
	            }
	            //console.log(total + ' total visitas')
	            $('#cuerpoVistaWeb').html(htm + '<td colspan="3"> Total Visitas: ' +total + '</td>'); 
					
				}
			});
	}
		function insertWeb() {
			var visitasWeb = $('#VisitasWeb').val();
			var fechaVisitasWeb = $('#fechaVisitasWeb').val();
			console.log(fechaVisitasWeb + ' 0000000000000000000000000000000')
			var ejecutar = $('#pais').val();
			var param ={'Funcion':'insertWeb', 'visitasWeb':visitasWeb, 'fechaVisitasWeb':fechaVisitasWeb, 'ejecutar':ejecutar}
			if (visitasWeb.length > 0 && fechaVisitasWeb.length > 0   ) {
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data);
						detalleWeb();
						toastr["success"](" registro de pagina web exitoso!", {timeOut: 10000});
						$('#reset_insertWeb').click()
						$('#cerrarMoWeb').click()
					}
				});
			}else {
				toastr.error('Error de registro !', 'Hay algunos campos vacios en pagina web', {timeOut: 15000})
			}
		}
		function detalleDeleteVisitasWeb(id) {
			console.log(id);
			$('#id_visWeb').val(id)
			$('#delete-visitaWeb').click();
		}
		function deleteVisitaWeb() {
			var id = $('#id_visWeb').val();
			var ejecutar = $('#pais').val();
			var param ={'Funcion':'deleteVisitaWeb', 'id':id, 'ejecutar':ejecutar}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data);
					if (data != 0 ) {
						detalleWeb();
						toastr["success"](" registro ha sido eliminado!", {timeOut: 10000});
						$('#NodeleteVistaWeb').click()
					}else{
						toastr.error('Error !', 'Intentalo de nuevo', {timeOut: 15000})
					}
				}
			});
		}
	function detallePlayStore() {	
		var ejecutar = $('#pais').val();
		if (ejecutar > 0 ) {}else{ejecutar = 1; }
		var param ={'Funcion':'detallePlayStore', 'ejecutar':ejecutar}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data + ' ???????????????????????????')

			   var json = JSON.parse(data)	
			   if (json != 0 ) {
					var disp = json[json.length-1].dispositivos;
					//console.log(data + ' !!!!!!!!!!!!!!!!!!!!!?')
				}else{
					var disp = 0;
					//console.log(disp + ' ***********==============================================')
				}
			   htm = "";
			   var totalVis = 0;
			   var totalDesca = 0;
			   var totalDesin = 0;
            for ( i = 0; i< json.length; i++ ) {
					totalVis = totalVis + parseInt(json[i].visitas)
					totalDesca = totalDesca + parseInt(json[i].descargas)
					totalDesin = totalDesin + parseInt(json[i].desinstalaciones)
            	

            	var num = formatearNumero(json[i].saldo)
            	var estado = json[i]['estado'];

               htm=htm + '<tr>' + 
               	'<td>' + json[i]['visitas'] + '</td>' + 
               	'<td>' + json[i]['descargas'] + '</td>' + 
               	'<td>' + json[i]['desinstalaciones'] + '</td>' +  
               	'<td>' + json[i]['dispositivos'] + '</td>' +  
               	'<td>' + json[i]['fecha'] + '</td>' +  
               	'<td>' + 
               		'<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalleDeleteVisitasPlay('+json[i]['id']+')">' + 
				            '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
				        '</a>' +
	             	'</td>' + 
               '</tr>'  ;
            }
            
            $('#cuerpoPlayStore').html(htm + '<td> Total Visitas: ' +totalVis + '</td>'+
             '<td> Total Descargas: ' +totalDesca + '</td>'+
             '<td> Total Desinstalaciones: ' +totalDesin + 
             '</td>'+ '<td> Total Dispositivos actuales: ' + disp + '</td>'); 				
			}
		});
	}
		function insertPlayStore() {
			var visitasPlayStore = $('#visitasPlayStore').val();
			var descargasPlayStore = $('#descargasPlayStore').val();
			var desinstalacionesPlayStore = $('#desinstalacionesPlayStore').val();
			var dispositivosActivosPlayStore = $('#DispositivosActivosPlayStore').val();

			var fecha = $('#fechaRegistroPlay').val();
			var ejecutar = $('#pais').val();
			var param ={'Funcion':'insertPlayStore', 'fecha':fecha, 'visitasPlayStore':visitasPlayStore, 'descargasPlayStore':descargasPlayStore,  'desinstalacionesPlayStore':desinstalacionesPlayStore, 'dispositivosActivosPlayStore':dispositivosActivosPlayStore, 'ejecutar':ejecutar}
			if (descargasPlayStore.length > 0 ) {		
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						console.log(data + ' ==============================================0000');
						if (data != 0 ) {
							detallePlayStore();
							toastr["success"]("Registro PlayStore exitoso!", {timeOut: 10000})
							$('#reset_insertPlay').click()
							$('#cerrarMoPlay').click()							
						}else{
							toastr.error('Error de registro !', 'No puedes registrar fechas posteriores ! ', {timeOut: 15000})
						}
					}
				});
			}else {
				toastr.error('Error de registro !', 'Hay algunos campos vacios de PlayStore', {timeOut: 15000})
			}
		}
		function detalleDeleteVisitasPlay(id) {
			//console.log(id);
			$('#id_visPlay').val(id)
			$('#delete-visitaPlay').click();
		}
		function deleteVisitaPlay() {
			var id = $('#id_visPlay').val();
			var ejecutar = $('#pais').val();
			var param ={'Funcion':'deleteVisitaPlay', 'id':id, 'ejecutar':ejecutar}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data + '======================================');
					if (data != 0 ) {
						detallePlayStore();
						toastr["success"](" registro ha sido eliminado!", {timeOut: 10000});
						$('#NodeleteVistaPlay').click()
					}else{
						toastr.error('Error !', 'Intentalo de nuevo', {timeOut: 15000})
					}
				}
			});
		}
	function detalleAppStore() {	
		var ejecutar = $('#pais').val();
		if (ejecutar > 0 ) { }else{ ejecutar = 1;  }
		var param ={'Funcion':'detalleAppStore', 'ejecutar':ejecutar}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
			   var json = JSON.parse(data)	
			   if (json != 0 ) {
					var disp = json[json.length-1].dispositivos;
					//console.log(data + ' !!!!!!!!!!!!!!!!!!!!!?')
				}else{
					var disp = 0;
					//console.log(disp + ' ***********==============================================')
				}

			   htm = "";
            var totalVis = 0;
			   var totalDesca = 0;
			   var totalDesin = 0;

            for ( i = 0; i< json.length; i++ ) {
            	var num = formatearNumero(json[i].saldo)
            	var estado = json[i]['estado'];

			   	totalVis = totalVis + parseInt(json[i].visitas)
					totalDesca = totalDesca + parseInt(json[i].descargas)
					totalDesin = totalDesin + parseInt(json[i].desinstalaciones)
            	

               htm=htm + '<tr>' + 
               	'<td>' + json[i]['visitas'] + '</td>' + 
               	'<td>' + json[i]['descargas'] + '</td>' + 
               	'<td>' + json[i]['desinstalaciones'] + '</td>' +  
               	'<td>' + json[i]['dispositivos'] + '</td>' + 
               	'<td>' + json[i]['fecha'] + '</td>' + 
               	'<td>' + 
               		'<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalleDeleteVisitasApp('+json[i]['id']+')">' + 
				            '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
				        '</a>' +
	             	'</td>' + 
               '</tr>'  ;
            }
            $('#cuerpoAppStore').html(htm+ '<td> Total Visitas: ' +totalVis + 
            	'</td>'+ '<td> Total Descargas: ' +totalDesca + 
            	'</td>'+ '<td> Total Desinstalaciones: ' +totalDesin + 
            	'</td>'+ '<td> Total Dispositivos Actuales: ' +disp + '</td>');
			   			
			}
		});
	}
		function insertAppStore() {
			var visitasAppStore = $('#visitasAppStore').val();
			var descargasAppStore = $('#descargasAppStore').val();
			var desinstalacionesAppStore = $('#desinstalacionesAppStore').val();
			var dispositivosActivosAppStore = $('#dispositivosActivosAppStore').val();
			var fecha = $('#fechaRegistroApp').val();

			var ejecutar = $('#pais').val();
			var param ={'Funcion':'insertAppStore', 'fecha':fecha, 'visitasAppStore':visitasAppStore, 'descargasAppStore':descargasAppStore, 'desinstalacionesAppStore':desinstalacionesAppStore, 'dispositivosActivosAppStore':dispositivosActivosAppStore, 'ejecutar':ejecutar}
			if (visitasAppStore.length > 0  && descargasAppStore.length > 0 && desinstalacionesAppStore.length > 0 && dispositivosActivosAppStore.length > 0  ) {
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data);
						if (data != 0 ) {
							detalleAppStore();
							toastr["success"]("Registro de AppStore exitoso!", {timeOut: 10000});
							$('#reset_insertApp').click()
							$('#cerrarMoApp').click()
						}else{
							toastr.error('Error de registro !', 'No puedes registrar fechas posteriores ! ', {timeOut: 15000})
						}
					}
				});
			}else {
				toastr.error('Error de registro !', 'Hay algunos campos vacios En AppStore', {timeOut: 15000})
			}	
		}
		function detalleDeleteVisitasApp(id) {
			console.log(id);
			$('#id_visApp').val(id)
			$('#delete-visitaApp').click();
		}
		function deleteVisitaApp() {
			var id = $('#id_visApp').val();
			var ejecutar = $('#pais').val();
			var param ={'Funcion':'deleteVisitaApp', 'id':id, 'ejecutar':ejecutar}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data);
					if (data != 0 ) {
						detalleAppStore();
						toastr["success"](" registro ha sido eliminado!", {timeOut: 10000});
						$('#NodeleteVistaApp').click()
					}else{
						toastr.error('Error !', 'Intentalo de nuevo', {timeOut: 15000})
					}
				}
			});
		}



	function detalleCampanna() {	
		var ejecutar = $('#pais').val();
		if (ejecutar > 0 ) {}else{ ejecutar = 1; }
		var param ={'Funcion':'detalleCampanna', 'ejecutar':ejecutar}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
		    	var json = JSON.parse(data)	
		    	// tabla vista general
				var audiencia = 0;
            var clic = 0;
            var registro = 0;

				htm = "";
            for ( i = 0; i< json.length; i++ ) {
            	var num = formatearNumero(json[i].saldo)
            	var estado = json[i]['estado'];

            	audiencia = audiencia + parseInt(json[i]['audiencia']);
            	clic = clic + parseInt(json[i]['clics']);
            	registro = registro + parseInt(json[i]['total_registros']);
            	
               htm=htm + '<tr>' + 
               	'<td>' + json[i]['audiencia'] + '</td>' + 
               	'<td>' + json[i]['clics'] + '</td>' + 
               	'<td>' + json[i]['total_registros'] + '</td>' +
               	'<td>' + json[i]['fecha'] + '</td>' +
               	'<td>' + 
               		'<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalleDeleteVisitasCampana('+json[i]['id']+')">' + 
				            '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
				        '</a>' +
	             	'</td>' + 
            	'</tr>'  ;
            }
            $('#cuerpoCampanna').html(htm + '<td> Total Audiencia: ' +audiencia + '</td>'+ '<td> Total Clics: ' +clic + '</td>'+ '<td> Total Registros: ' +registro + '</td>');  
		  	 	
			}
		});
	}
		function detalleDeleteVisitasCampana(id) {
			console.log(id);
			$('#id_visCamp').val(id)
			$('#delete-visitaCampana').click();
		}
		function deleteRegistroCampana() {
			var id = $('#id_visCamp').val();
			var ejecutar = $('#pais').val();
			var param ={'Funcion':'deleteRegistroCampana', 'id':id, 'ejecutar':ejecutar}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data);
					if (data != 0 ) {
						detalleCampanna();
						toastr["success"](" registro ha sido eliminado!", {timeOut: 10000});
						$('#NodeleteVistaCampana').click()
					}else{
						toastr.error('Error !', 'Intentalo de nuevo', {timeOut: 15000})
					}
				}
			});
		}
	
	
	
	function insertCampanna() {
		var audiencia = $('#audiencia').val();
		var fecha = $('#fechaRegistroCamp').val();
		var totalClicsAudiencia = $('#totalClicsAudiencia').val();
		var totalRegistrosAudiencia = $('#totalRegistrosAudiencia').val();
		var ejecutar = $('#pais').val();
		var param ={'Funcion':'insertCampanna', 'audiencia':audiencia, 'fecha':fecha, 'totalClicsAudiencia':totalClicsAudiencia, 'totalRegistrosAudiencia':totalRegistrosAudiencia, 'ejecutar':ejecutar}
		if ( totalRegistrosAudiencia.length > 0 ) {	
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data);
					detalleCampanna();
					toastr["success"]("Registro Campaña exitoso!", {timeOut: 10000})
					$('#reset_insertCamp').click()
					$('#cerrarMoCam').click()
				}
			});
		}else{
			toastr.error('Error de registro !', 'Hay algunos campos vacios En Campaña', {timeOut: 15000})
		}
	}




function ventas() {
	var n = $('#estadoUsuariorev').val();
	if (n.toLowerCase() == 'reventa' | n.toLowerCase() == 'administrador') {
		$('#noPermisos').hide('slow');
		$("#ventas").show();
		$("#detallePais").html('Ventas')
	   $("#emsivoz").hide('slow');
	   $("#telefonia").hide('slow');
	   $("#pais").hide('slow');
	   $('#banco').hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#dreamDetallePBX").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#canalesT").hide('slow');
		$("#rolesDetalles").hide('slow');
		$("#canalesContratados").hide('slow');
		$("#contactos_Comercial").hide('slow')
		$("#TbalanceComercial").hide('slow')
		$("#comercial").hide('slow');
		$("#licenciaNube").hide('slow')
		$("#serviciosNube").hide('slow');
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow')
	}else{
		$('#noPermisos').show('slow');
		$('.imgBanco').hide();

	   $("#emsivoz").hide('slow');
	   $("#telefonia").hide('slow');
	   $("#pais").hide('slow');
	   $('#banco').hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#dreamDetallePBX").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#canalesT").hide('slow');
		$("#rolesDetalles").hide('slow');
		$("#canalesContratados").hide('slow');
		$("#contactos_Comercial").hide('slow')
		$("#TbalanceComercial").hide('slow')
		$("#comercial").hide('slow');
		$("#licenciaNube").hide('slow')
		$("#serviciosNube").hide('slow');
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow')
	}
	
}
	function selectMeta() {
		$('#MetaMes').show();
		var param ={'Funcion':'Meta'}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data)
				var json = JSON.parse(data)	
				htm = "";
				var fecha = '';
	         for ( i = 0; i< json.length; i++ ) {
	          	var num = formatearNumero(json[i].meta)
	          	
	          	fecha = json[i]['fecha'];
	          	Ndias = json[i]['dias'];
	          	var val = fecha.split('-');
	          	var val1 = val[1];
	          	var vald = val[2];


	          	if (val1 == 01) {val1 = "Enero " + vald} 
	          	if (val1 == 02) {val1 = "Febrero " + vald} 
	          	if (val1 == 03) {val1 ="Marzo " + vald} 
	          	if (val1 == 04) {val1 = "Abril " + vald} 
	          	if (val1 == 05) {val1 ="Mayo " + vald} 
	          	if (val1 == 06) {val1 = "Junio " + vald} 
	          	if (val1 == 07) {val1 ="Julio " + vald} 
	          	if (val1 == 08) {val1 = "Agosto " + vald} 
	          	if (val1 == 09) {val1 ="Septiembre " + vald} 
	          	if (val1 == 10) {val1 = "Octubre " + vald} 
	          	if (val1 == 11) {val1 ="Noviembre " + vald} 
	          	if (val1 == 12) {val1 = "Diciembre " + vald}
	            htm=htm + '<tr>' + 
	             '<td>' + ' $ ' + num + '</td>' + 
	             '<td>' + Ndias + '</td>' + 
	             '<td>' + val1 + '</td>' + 
	             '<td>' + 
	              	'<a style=" font-size:20px; color: green;" id="del_Free" onclick="detalleMeta('+json[i]['cod']+')">' + 
	              		'<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
	              	'</a>' + 
	             '</td>' +
	             '</tr>'  ;
	         }
	         $('#cuerpoMeta').html(htm); 
			}
		});
	}
	function detalleMeta(cod){
	  	var param ={'Funcion':'Meta' };
	    $.ajax({
	      data: JSON.stringify (param),
	      type:"JSON",
	      url: 'ajax.php',
	      success:function(data){
	        	//console.log(data)
	        	var datos = JSON.parse(data)
	        	var num = formatearNumero(datos[0]['valor'])
	        	//console.log(datos[0]['proveedor'] + ' ******************')

				$('#cod').val(datos[0]['cod']);
				$('#rdias').val(datos[0]['dias']);
				$('#m_meta').val(datos[0]['meta']);
				$('#estado-Meta').click();
	        
	      }
	   });
	}
	function updateMetaBanco() {
		var cod = $('#cod').val();
		var meta = $('#m_meta').val();
		var numero_dias = $('#rdias').val();
		//console.log(cod + ' codigo')
		//console.log(meta + ' meta')
		//console.log(numero_dias + ' numero_dias')
		var param ={'Funcion':'updateMetaBanco', 'cod':cod, 'meta':meta, 'numero_dias':numero_dias };
	    $.ajax({
	      data: JSON.stringify (param),
	      type:"JSON",
	      url: 'ajax.php',
	      success:function(data){
	      	//console.log(data)
	      	if ( data > 0 ) {
					toastr["success"]("Se ha actualizado Metas!", {timeOut: 10000})
					selectMeta();
					$('#cerrarMeta').click()
				}else{
					toastr.error('No se ha podido actulizar Meta !', 'Error', {timeOut: 15000})
				}
	      }
	   });
	}


function roles() {

	var n = $('#estadoUsuario').val();
	if ( n.toLowerCase() == 'administrador') {
		$('#noPermisos').hide('slow');
		$("#rolesDetalles").show();
		$("#detallePais").html('Roles')
		$("#ventas").hide('slow');
	   $("#emsivoz").hide('slow');
	   $("#telefonia").hide('slow');
	   $("#pais").hide('slow');
	   $('#banco').hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#dreamDetallePBX").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#canalesT").hide('slow');
		$("#canalesContratados").hide('slow');
		$("#contactos_Comercial").hide('slow')
		$("#TbalanceComercial").hide('slow')
		$("#comercial").hide('slow');
		$("#licenciaNube").hide('slow')
		$("#serviciosNube").hide('slow');
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow')
		$('#MetaMes').hide('slow');
		selecRol()
	
	}else{
		$('#noPermisos').show('slow');
		$('.imgBanco').hide();

		$("#ventas").hide('slow');
	   $("#emsivoz").hide('slow');
	   $("#telefonia").hide('slow');
	   $("#pais").hide('slow');
	   $('#banco').hide('slow');
	   $("#facturacion").hide('slow');
	   $("#recargasBanco").hide('slow');
	   $("#freeDetallePBX").hide('slow');
	   $("#dreamDetallePBX").hide('slow');
	   $("#contPlayStore").hide('slow');
		$("#contAppStore").hide('slow');
		$("#contCampanna").hide('slow');
		$("#contWeb").hide('slow');
		$("#canalesT").hide('slow');
		$("#canalesContratados").hide('slow');
		$("#contactos_Comercial").hide('slow')
		$("#TbalanceComercial").hide('slow')
		$("#comercial").hide('slow');
		$("#licenciaNube").hide('slow')
		$("#serviciosNube").hide('slow');
		$("#TablaClientesNube").hide('slow')
		$("#TablaUsuariosNube").hide('slow')
		$("#TablaGrespaldoNube").hide('slow')
		$("#TablaUsuariosClienteNube").hide('slow')
		$('#MetaMes').hide('slow');
	}

}
	function selecRol() {
		var param ={'Funcion':'selecRol'}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data )
				var json = JSON.parse(data)	
				// tabla vista general
				htm = "";
				for ( i = 0; i< json.length; i++ ) {

				   htm=htm + '<tr>' + 
				    '<td>' + json[i]['cod'] + '</td>' + 
				    '<td>' + json[i]['nombre'] + '</td>' + 

				    '<td>' + 
				    '<a style=" font-size:20px; color: green;" id="del_Free" onclick="detalleRol('+json[i]['cod']+')">' + 
				        '<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
				    '</a>' + 
				    '</td>' + 
				    '<td>' + 
				        '<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalledeleteRol('+json[i]['cod']+')">' + 
				            '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
				        '</a>' + 
			        '</td>' + 
			        '</tr>'  ;
				}
				$('#cuerpoRol').html(htm);  
			}
		});
	}
	function detalleRol(cod){
		var param ={'Funcion':'detalleRol', 'cod':cod};
		$.ajax({
		    data: JSON.stringify (param),
		    async: false,
		    type:"JSON",
		    url: 'ajax.php',
		    success:function(data){
		        console.log(data)
		        var datos = JSON.parse(data)
				
				$('#estado-rol').click();		        

				$('#cod_rol_u').val(datos[0]['cod']);
				$('#nom_rol_u').val(datos[0]['nombre']);
				
				
		   }
		});
	}
	function updateRol() {
		var cod = $('#cod_rol_u').val()
		var nombre = $('#nom_rol_u').val()

		var param ={'Funcion':'updateRol', 'cod':cod, 'nombre':nombre  };
		$.ajax({
		   data: JSON.stringify (param),
		   type:"JSON",
		   url: 'ajax.php',
		   success:function(data){
		      console.log(data + ' actualizado Rol ')
		      if ( data > 0 ) {
		      	toastr["success"]("Se ha actualizado Rol!", {timeOut: 10000})
					selecRol();
					$('#reset_Update_rol').click()
					$('#cerrarRolu').click()
				}else{
					toastr.error('No se puede actulizar Rol !', 'Error', {timeOut: 15000})
				}
			}
		});
	}
	function detalledeleteRol(cod) {
		var param ={'Funcion':'detalleRol', 'cod':cod};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data)
				var datos = JSON.parse(data)
				$('#cod_rol_D').val(datos[0]['cod']);
				$('#nombre_rol_D').html(datos[0]['nombre']);
					
				$('#delete-rol').click();
			}
		});
	}
	function deleteRol() {
		var cod = $('#cod_rol_D').val()
		console.log(cod + ' ooooooooooooooooooooo')
		var param ={'Funcion':'deleteRol', 'cod':cod }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data + ' eliminado')
				if ( data > 0 ) {
					toastr["success"]("Se ha eliminado un Rol!", {timeOut: 10000})
					selecRol();
					$('#NodeleteRol').click()
				}else{
					toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
				}
			}
		});
	}
	function insertRol() {
		var cod = $('#cod_rol').val()
		var nombre = $('#nom_rol').val()
		console.log(cod)
		console.log(nombre)
		var param ={'Funcion':'verifRol', 'cod':cod, 'nombre':nombre }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				if (data > 0) {
					toastr.error('Rol ya existe ! ...', 'Error!', {timeOut: 15000})
				}else{
					var cod = $('#cod_rol').val()
					var nombre = $('#nom_rol').val()
					var param ={'Funcion':'inserRol', 'cod':cod, 'nombre':nombre }
					$.ajax({
						data: JSON.stringify (param),
						type:"JSON",
						url: 'ajax.php',
						success:function(data){
							if (data > 0) {
								toastr["success"]("Se ha Registrado un nuevo Rol!", {timeOut: 10000})
								selecRol()
								$('#reset_insert_Rol').click()
								$('#cerrarModalRol').click()	
							}else{
								toastr.error('Vuelve a intentarlo ! ...', 'Error!', {timeOut: 15000})
							}
						}
					});
				}
			}
		});
	}




function formatearNumero(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? ',' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + '.' + '$2');
	}
	return x1 + x2;
}

