function selecUsuarios() {
	var param ={'Funcion':'selecUsuarios'}
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			console.log(data )
			var json = JSON.parse(data)	
			// tabla vista general
			htm = "<tr>";
			for ( i = 0; i< json.length; i++ ) {

			    htm=htm + '<tr>' + 
			    '<td>' + json[i]['usuario'] + '</td>' + 
			    '<td>' + json[i]['password'] + '</td>' + 
			    '<td>' + json[i]['documento'] + '</td>' + 
			    '<td>' + json[i]['nombre'] + '</td>' + 
			    '<td>' + json[i]['apellido'] + '</td>' + 
			    '<td>' + json[i]['telefono'] + '</td>' + 
			    '<td>' + json[i]['nomRol'] + '</td>' + 

			    '<td>' + 
			    '<a style=" font-size:20px; color: green;" id="del_Free" onclick="detalleUs('+json[i]['cod']+')">' + 
			        '<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>' + 
			    '</a>' + 
			    '</td>' + 
			    '<td>' + 
			        '<a style=" font-size:20px; color: red;" id="del_Free" onclick="detalledeleteUss('+json[i]['cod']+')">' + 
			            '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>' + 
			        '</a>' + 
		        '</td>' + 
		        '</tr>'  ;
			}
			html = "</tr>";
			$('#cuerpousuarios').html(htm);  
		}
	});
}
	function detalleUs(cod){
		
		var param ={'Funcion':'detalleUsu', 'cod':cod};
		$.ajax({
		    data: JSON.stringify (param),
		    async: false,
		    type:"JSON",
		    url: 'ajax.php',
		    success:function(data){
		        console.log(data)
		        var datos = JSON.parse(data)
				
				$('#estado-usuario').click();		        

				$('#cod_usu').val(datos[0]['cod']);
				$('#nombreUs').val(datos[0]['nombre']);
				$('#apellidoUs').val(datos[0]['apellido']);
				$('#documentoUs').val(datos[0]['documento']);
				$('#telefonoUs').val(datos[0]['telefono']);
				$('#usuarioUs').val(datos[0]['usuario']);
				$('#passwordUs').val(datos[0]['password']);

					num_rol = $('#num_rolesU').val();
					for(i = 1;i<=num_rol;i++){
						document.getElementById('rol_usuU'+i).checked = false;
					}
					console.log(datos.length);
					for(j = 0; j < datos.length;j++){
						for(i = 1;i<=num_rol;i++){
							tipo_rol= $('#rolusuarioU'+i).val();
							console.log(tipo_rol)
							if(datos[j]['rol'] == tipo_rol){
								document.getElementById('rol_usuU'+i).checked = true;
								document.getElementById('val_usuU'+i).value = true;
								document.getElementById('cod_usuU'+i).value = datos[j]['rolusu'];
							}
						}
					}

				//$("#rol_usuarioU > option[value="+ datos[0]['rol'] +"]").attr("selected",true);
				//$("#rol_usuarioU > option[value='2']").attr("selected",true)
				var param ={'Funcion':'selecRol'}
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						console.log(data )
						var json = JSON.parse(data)	
						htm = "";
						for ( i = 0; i< json.length; i++ ) {
							if(datos[0]['rol'] == json[i].cod){
								$('#rol_usuarioU').append($('<option>',{
									value: json[i].cod ,
									text:json[i].nombre,
									selected:true
								}));
							}else{
								$('#rol_usuarioU').append($('<option>',{
									value: json[i].cod ,
									text:json[i].nombre
								}) );
							}
						}
					}
				});
					
		    }
		});
	}
	function selecRolesUp() {
		var param ={'Funcion':'selecRol'}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data )
				var json = JSON.parse(data)	
				htm = "";
				for ( i = 0; i< json.length; i++ ) {
				   htm=htm + '<option id="' + json[i].nombre +'" value="' + json[i].cod + ' ">' + json[i].nombre + '</option>' ;
				}
				$('#rol_usuarioU').html(htm);  
			}
		});
	}
	function updateUsuario() {
			var cod = $('#cod_usu').val();
			var usu = $('#usuarioUs').val();
			var pass = $('#passwordUs').val();
			var param ={'Funcion':'updateUsu', 'cod':cod, 'usu':usu, 'pass':pass, 'variable':'1'  };
		    $.ajax({
		      data: JSON.stringify (param),
		      type:"JSON",
		      url: 'ajax.php',
		      success:function(data){
		        	console.log(data + ' actualizado admin ')
		        	if ( data > 0 ) {

		        		var cod = $('#cod_usu').val();
						var nom = $('#nombreUs').val();
						var apell =	$('#apellidoUs').val();
						var doc = $('#documentoUs').val();
						var tel = $('#telefonoUs').val();
						

						var param ={'Funcion':'updateUsu', 'cod':cod, 'nom':nom, 'apell':apell, 'doc':doc, 'tel':tel, 'variable':'2'  };
					    $.ajax({
					      data: JSON.stringify (param),
					      type:"JSON",
					      url: 'ajax.php',
					      success:function(data){
					      	console.log(data + ' actualizado usuario ')
					      	if ( data > 0 ) {

					      			var num_rol = $('#num_rolesU').val()
										var rol = [];
										for(i = 1; i <= num_rol;i++){
											rolCh = $('#rol_usuU'+i).is(':checked');
											tipo_rol = $('#rolusuarioU'+i).val();
											valrolus= $('#val_usuU'+i).val();
											codrolus= $('#cod_usuU'+i).val();
											rol.push({'rol': rolCh,'tipo_rol':tipo_rol,'valrolus':valrolus,'codrolus':codrolus});
										}
										console.log(rol)
									var param ={'Funcion':'updateUsu', 'rol':rol , 'cod':cod, 'variable':'3' }
									$.ajax({
										data: JSON.stringify (param),
										type:"JSON",
										url: 'ajax.php',
										success:function(data){
											console.log(data + ' actualizado rol ')
											if ( data > 0 ) {
												toastr["success"]("Se ha actualizado Usuario!", {timeOut: 100})
												selecUsuarios();
												$('#reset_Update_usuario').click()
												$('#cerrarUsuario').click()
											}else{
												toastr.error('No se puede actulizar Usuario !', 'Error', {timeOut: 150})
											}
										}
									});
								}else{
									toastr.error('No se puede actulizar Usuario !', 'Error', {timeOut: 150})
								}
					      }
					  	});
					}else{
						toastr.error('No se puede actulizar Usuario !', 'Error', {timeOut: 150})
					}
		    	}
		   });
	}
	function detalledeleteUss(cod) {
		var param ={'Funcion':'detalleUsu', 'cod':cod};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data)
				var datos = JSON.parse(data)
				$('#cod_us').val(datos[0]['cod']);
				$('#nomUsu').html(datos[0]['nombre']);
					
				$('#delete-usuario').click();
			}
		});
	}
	function deleteUsu() {
		var cod = $('#cod_us').val();
		var param ={'Funcion':'deleteUsu', 'cod':cod, 'variable':'1' }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data + ' eliminado')
				if ( data > 0 ) {
					var cod = $('#cod_us').val();
					//console.log(cod)
					var param ={'Funcion':'deleteUsu', 'cod':cod, 'variable':'2' }
					$.ajax({
						data: JSON.stringify (param),
						type:"JSON",
						url: 'ajax.php',
						success:function(data){
							if ( data > 0 ) {
								toastr["success"]("Se ha eliminado un Registro!", {timeOut: 10000})
								selecUsuarios();
								$('#NodeleteUsu').click()
							}else{
								toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
							}
						}
					});
				}else{
					toastr.error('No se ha podido eliminar !', 'Error', {timeOut: 15000})
				}
			}
		});
	}
	function insertUsuario() {
		var usuario = $('#usuarioUsuario').val()
		console.log(usuario + ' usario recibido')
		if (usuario.length != 0 ) {
			var param ={'Funcion':'verifUser', 'usuario':usuario  }
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					if (data > 0) {
						toastr.error('Usuario ya existe ! ...', 'Error!', {timeOut: 15000})
					}else{
						console.log('se puede registrar');
						var param ={'Funcion':'selecUsu' }
						$.ajax({
							data: JSON.stringify (param),
							type:"JSON",
							url: 'ajax.php',
							success:function(data){
								var json = JSON.parse(data);

								var cod = parseInt(json[0].num) + parseInt(1);
								console.log(cod + ' nuevo codigo de usuario')
								var password = $('#passwordUsuario').val();
								var usuario = $('#usuarioUsuario').val();
								console.log(usuario + ' usuario')
								console.log( password + ' contraseña ')
								if (usuario.length != 0 & password.length != 0 ) {
									var param ={'Funcion':'inserUsu', 'cod':cod, 'usuario':usuario, 'password':password, 'variable':'1' }
									$.ajax({
										data: JSON.stringify (param),
										type:"JSON",
										url: 'ajax.php',
										success:function(data){
											console.log('===================')
											var nombre = $('#nombreUsuario').val();
											var apellido = $('#apellidoUsuario').val();
											var documento = $('#documentoUsuario').val();
											var telefono = $('#telefonoUsuario').val();
											
											console.log(nombre + ' nombre')
											console.log(apellido + ' apellido')
											console.log(documento + ' documento')
											console.log(telefono + ' telefono')

											if (nombre.length != 0 & apellido.length != 0 & documento.length != 0 & telefono.length != 0 ) {
												var param ={'Funcion':'inserUsu', 'cod':cod, 'nombre':nombre, 'apellido':apellido, 'documento':documento, 'telefono':telefono, 'variable':'2' }
												$.ajax({
													data: JSON.stringify (param),
													type:"JSON",
													url: 'ajax.php',
													success:function(data){
														var num_rol = $('#num_roles').val()
														var rol = [];
														for(i = 1; i <= num_rol;i++){
															rolche = $('#rol_usuDeta'+i).is(':checked');
															roltipo= $('#rolusuarioDeta'+i).val();
															rol.push({'rol': rolche,'tipo_rol':roltipo});
														}
														console.log(rol)
														var param ={'Funcion':'inserUsu', 'rol':rol , 'cod':cod, 'variable':'3' }
														$.ajax({
															data: JSON.stringify (param),
															type:"JSON",
															url: 'ajax.php',
															success:function(data){
																console.log(' se ha registrado rol ')
																toastr["success"]("Se ha Registrado un nuevo Usuario!", {timeOut: 10000})
																selecUsuarios()
																$('#reset_insert_usuario').click()
																$('#cerrarModalUsuario').click()														
																
															}
														});
													}
												});
											}else{
												toastr.error('No pueden haber campos vacios!', 'Error', {timeOut: 15000})
											}

											
										}
									});
								}else{
									toastr.error('No pueden haber campos vacios!', 'Error', {timeOut: 15000})
								}
								
									
							}
						});
					}
				}
			});
		}else{
			toastr.error('los campos estan vacios !', 'Error', {timeOut: 15000})
		}
	}
	function selecRoles() {
		var param ={'Funcion':'selecRol'}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data )
				var json = JSON.parse(data)	
				htm = "<option>";
				for ( i = 0; i< json.length; i++ ) {

				   htm=htm + '<option value="' + json[i].cod + ' ">' + json[i].nombre + '</option>' ;
				    
				}
				html = "</option>";
				$('#rol_usuDeta').html(htm);  
				/*setTimeout(function(){
					$("#rol_usuDeta option[value="3"]").attr("selected",true);
				},2000);*/
			}
		});
	}