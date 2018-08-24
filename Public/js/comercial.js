function eventComercial() {
    $('.comerc').css('background','#2B5A8A')   
    $('.comerc').css('color','#fff')   
}
function selecBalanceComercial() {
	setTimeout(function(){
		var fechaIniaco=$('#fechaIniaco').val();
		var fechaFinaco=$('#fechaFinaco').val();
		var param ={'Funcion':'selecBalance','fechaFinaco':fechaFinaco,'fechaIniaco':fechaIniaco};
		console.log(param)
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data)
				var json = JSON.parse(data)
				if(json[0]['nombre']!=false){
						result = [];
						result1 = [];
						for (var i = 0 ; i < json.length; i++) {
							result.push({'name': json[i]['nombre'] , "y" : json[i]['cantidad']});
							result1.push({'name': json[i]['nombre'] , "y" : json[i]['valor']});
						}
						//console.log(result)
						//console.log(result1)
						
							Highcharts.chart('balNoComercial', {
						     	chart: {
						         type: 'pie'
						      },
						      title: {
						         text: 'BALANCE VENTAS No.'
						      },
						      subtitle: {
						         text: ''
						      },
						      plotOptions: {
						         series: {
						            dataLabels: {
						               enabled: true,
						               format: '{point.name}: {point.y:.0f}'
						            }
						         }
						      },
					         tooltip: {
					            headerFormat: '<span style="font-size:7px">{series.name}</span><br>',
									pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>  {point.y:,.0f}</b><br/>'
					         },
							   series: [{
							      name: 'Balance',
						    	      data:  result
						      }]
					   	});

							Highcharts.chart('balPComercial', {
						     	chart: {
					            type: 'pie'
					        	},
					        	title: {
					            text: 'BALANCE VENTAS $'
					        	},
					        	plotOptions: {
					            series: {
					               dataLabels: {
					                  enabled: true,
					                  format: '{point.name}: $ {point.y:.0f} '
					               }
					            }
					        	},
				            tooltip: {
				               headerFormat: '<span style="font-size:7px">{series.name}</span><br>',
									pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> $ {point.y:,.0f}</b><br/>'
				            },
						      series: [{
						         name: 'Balance',
					    	        data:  result1
					      	}]
			   			});
				}else{
					$('#balNoComercial').html('<div class="col-xs-12"><center><h5>No hay Datos por mostrar</h5></center></div>');
					$('#balPComercial').html('<div class="col-xs-12"><center><h5>No hay Datos por mostrar</h5></center></div>');
				}
			}
		});
	},500);
}
function detalleBalance() {
	setTimeout(function(){
		var fechaIniaco=$('#fechaIniaco').val();
		var fechaFinaco=$('#fechaFinaco').val();
		var param ={'Funcion':'detalleBalance','fechaFinaco':fechaFinaco,'fechaIniaco':fechaIniaco}
			$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data + ' =======================================')
				var json = JSON.parse(data)
				if(json[0]['todosR']!=false){
						var confianza = parseInt(json[0].confianza);
						var comunicacion = parseInt(json[0].comunicacion);
						var cooperacion = parseInt(json[0].cooperacion);
						color1='#159E75';
						color2='#383434';
						color3 = '#356F99';

						$('#balanceGeneral').highcharts({
						   chart: {
						      plotBackgroundColor: null,
						      plotBorderWidth: null,
						      plotShadow: false,
						      type: 'pie'
						   },
						   title: {
						      text: 'BALANCE GENERAL '
						    },
						   tooltip: {
						      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						   },
						   plotOptions: {
						      pie: {
						         allowPointSelect: true,
						         cursor: 'pointer',
						         dataLabels: {
							         enabled: false
							      },
							      showInLegend: true
							 	}
						   },
							series: [{
							   name: 'Balance',
							   colorByPoint: true,
							   data: [{
							      name:  confianza + ' confianza',
							      y: confianza,
							      color: color1
							   }, {
							      name: comunicacion + ' comunicacion',
							      y: comunicacion,
							      color:color2
							      //sliced: true,
							      //selected: true
							   }, {
								   name: cooperacion + ' cooperacion </a>',
								   y: cooperacion,
								   color:color3
								}]
							}]
			      	});
				}else{
					$('#balanceGeneral').html('<div class="col-xs-12"><center><h5>No hay Datos por mostrar</h5></center></div>');
				}
			}
		});
	},500);
}

function ContactosGestion() {
	setTimeout(function(){
		var param ={'Funcion':'selectContactosGestion'}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(dataC){
					//console.log(dataC + ' ..........................................')
					var jsonC = JSON.parse(dataC)	
					// tabla vista general
					htm = "<tr>";
					for ( i = 0; i< jsonC.length; i++ ) {

						var conf = parseInt(jsonC[i]['confianza']);
						//console.log('Fuera confianza' + conf )
						if (conf > 7   ) {
							//console.log('entro confianza' + conf )
							$('.comerc').css('color','#C91023')   
						}
						var comun = parseInt(jsonC[i]['comunicacion']);
						//console.log('Fuera comunicacion' + comun  )
						if (comun > 15   ) {
							//console.log('entro comunicacion' + comun  )
							$('.comerc').css('color','#C91023')   
						}
						var coop = parseInt(jsonC[i]['cooperacion']);
						//console.log('Fuera cooperacion' + coop  )
						if (coop > 7  ) {
							//console.log('entro cooperacion' + coop )
							$('.comerc').css('color','#C91023')   
						}


					   htm=htm + '<tr>' + 
					   '<td>' + 
					    '<a style=" font-size:20px; color: blue;" id="del_Free" onclick="verInfoContactoGestion('+jsonC[i]['id']+')">' + 
					        '<i class=\"fa fa-low-vision\" aria-hidden=\"true\"></i>' + 
					    '</a>' + 
					    '</td>' +
					   '<td>' + jsonC[i]['nombre_cliente'] + '</td>' + 
					   '<td>' + jsonC[i]['tipo_cliente'] + '</td>' + 
					   '<td>' + jsonC[i]['sector_economico'] + '</td>' + 
					   '<td>' + jsonC[i]['servicio'] + '</td>' + 
					   '<td>' + jsonC[i]['competencia'] + '</td>' + 
					   '<td>' + jsonC[i]['asesor_comercial'] + '</td>' + 
					   '<td>' + jsonC[i]['confianza'] + '</td>' + 
				    	'<td>' + jsonC[i]['comunicacion'] + '</td>' + 
				    	'<td>' + jsonC[i]['cooperacion'] + '</td>' + 
					    
	  	        		'</tr>'  ;
					}
				html = "</tr>";
				$('#cuerpoGestionComercial').html(htm);  
			}
		});
	},500);
}
		function verInfoContactoGestion(id) {
			var param ={'Funcion':'verInformacionContactos', 'id':id, 'variable':'1'};
			$.ajax({
			   data: JSON.stringify (param),
			   //async: false,
			   type:"JSON",
			   url: 'ajax.php',
			   success:function(data){
			   	console.log(data + ' ++++++++++++++++++++++++++++++++++++++++++++')
			      console.log(data + ' detalles tareas')
			      var json = JSON.parse(data)
			      $('#verContactos').click();
			      
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
									'<td>' + json[i].hora + '</td>' +
									'<td>' + json[i].descripcion + '</td>' +
									'<td>' + json[i].actividad + '</td>' +
									'<td>' + json[i].resultado + '</td>' +
									'<td>' + json[i].estado + '</td>' +
									'<td>' + archivo + '</td>' + 
								'<tr>';	
							}else{
								if (estado == "Comunicacion") {
									comun = comun + '<tr>' +
										'<td>' + json[i].fecha + '</td>' +
										'<td>' + json[i].hora + '</td>' +
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
											'<td>' + json[i].hora + '</td>' +
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
						$('#detaConf').html(conf)
						$('#detaComun').html(comun)
						$('#detaCoop').html(coop)
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
					      console.log(data + ' detalles Contactos +++++++++++++++++++++++++++++++++++++')

					      var usu = JSON.parse(data);
					      var negocio = usu[0].negocio_exitoso;
					       

					      if (negocio == null ) {
					      	negocio = 'En proceso...';
					      }else{
					      	negocio= negocio;
					      }

					      

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
					      	fcoop = fcoop;
					      }
					      var fdias = usu[0].totalDias;
					      if (fdias == 0 ) {
					      	fdias = ' - ';
					      }else{
					      	fdias = fdias;
					      }
					      var ffinal = usu[0].fecha_final;
					      if (ffinal == 0 ) {
					      	ffinal = ' - ';
					      }else{
					      	ffinal = ffinal;
					      }

					      $('#faseInfo').val(fase)
					      $('#negInfo').val(negocio)
					     	$('#montoInfo').val(usu[0].monto)
					      $('#fconfianza').html(usu[0].confianza)
					      $('#fcomunicacion').html(fcomun)
					      $('#fcooperacion').html(fcoop)
					     	$('#ffinal').html(ffinal)
					     	$('#fdias').html(fdias)

					   }
					});
			   }
			});
		}

function selectEstadoComercial(){
	var busqueda = $('#estadoComercial').val();
	var f1 = $('#newfechaInic').val();
	var f2 = $('#newfechaFi').val();
	var asesor = $('#nombreAsesor').val();
	if (busqueda == 4 ) {
		$('#tableBalComercial').show();
		$('#tableComercialBusqueda').hide();
	}else{
		$('#tableComercialBusqueda').show();
		$('#tableBalComercial').hide();
	}
	if (asesor.length != 0 ) {}else{
		asesor = parseInt(999);
	}
	console.log( 'asesor ' + asesor )
	var param ={'Funcion':'selectEstadoComercial', 'busqueda':busqueda, 'asesor':asesor, 'f1':f1, 'f2':f2 }
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			console.log(data + ' ==========!!!!!!!!!!!*******')

			var busqueda = $('#estadoComercial').val();
			var json = JSON.parse(data)	
			var htm = "";

			if (busqueda != 4) {
				if (busqueda == 1 ) {
					$('#detaConfianza').css('display','block');
					$('#detaComunicacion').hide();
					$('#detaCooperacion').hide();
				}
				if (busqueda == 2 ) {
					$('#detaComunicacion').css('display','block');
					$('#detaConfianza').hide();
					$('#detaCooperacion').hide();
				}
				if (busqueda == 3 ) {
					$('#detaCooperacion').css('display','block');
					$('#detaComunicacion').hide();
					$('#detaConfianza').hide();
				}
				for ( i = 0; i< json.length; i++ ) {
					var estado = "";
					if(busqueda == 1 ) {
						estado = json[i]['confianza'];
					}if (busqueda == 2 ) {
						estado = json[i]['comunicacion'];
					}if (busqueda == 3 ) {
						estado = json[i]['cooperacion'];
					}
					htm=htm + '<tr>' + 
						'<td>' + 
						   '<a style=" font-size:20px; color: blue;" id="del_Free" onclick="verInfoContactoGestion('+json[i]['id']+')">' + 
						      '<i class=\"fa fa-low-vision\" aria-hidden=\"true\"></i>' + 
						   '</a>' + 
						'</td>' +
						'<td>' + json[i]['nombre_cliente'] + '</td>' + 
						'<td>' + json[i]['tipo_cliente'] + '</td>' + 
						'<td>' + json[i]['sector_economico'] + '</td>' + 
						'<td>' + json[i]['servicio'] + '</td>' + 
						'<td>' + json[i]['competencia'] + '</td>' + 
						'<td>' + json[i]['asesor_comercial'] + '</td>' + 
						'<td>' + estado + '</td>' + 
		  	      '</tr>'  ;
				}
				$('#cuerpoDetallesComercial').html(htm);
			}else{
				$('#tableBalComercial').show();
				$('#tableComercialBusqueda').hide();

				for ( i = 0; i< json.length; i++ ) {

					htm=htm + '<tr>' + 
							'<td>' + 
						 		'<a style=" font-size:20px; color: blue;" id="del_Free" onclick="verInfoContactoGestion('+json[i]['id']+')">' + 
						        	'<i class=\"fa fa-low-vision\" aria-hidden=\"true\"></i>' + 
						    	'</a>' + 
						   '</td>' +
						   '<td>' + json[i]['nombre_cliente'] + '</td>' + 
						   '<td>' + json[i]['tipo_cliente'] + '</td>' + 
						   '<td>' + json[i]['sector_economico'] + '</td>' + 
						   '<td>' + json[i]['servicio'] + '</td>' + 
						   '<td>' + json[i]['competencia'] + '</td>' + 
						   '<td>' + json[i]['asesor_comercial'] + '</td>' + 
						   '<td>' + json[i]['confianza'] + '</td>' + 
					    	'<td>' + json[i]['comunicacion'] + '</td>' + 
					    	'<td>' + json[i]['cooperacion'] + '</td>' + 
	  	        		'</tr>'  ;
					}
					html = "</tr>";
					$('#cuerpoGestionComercial').html(htm);  
				
			}
			
			
		}
	});
}

function totalClientes() {
	setTimeout(function(){
		var fecha1 = $('#fechaInic').val();		
		//console.log(fecha1 + ' fecha1')
		var fecha2 = $('#fechaFi').val();		
		//console.log(fecha2 + ' fecha2')
		var vendedor = $('#nomVendedor').val();
		if (vendedor.length != 0) {}else{vendedor = 0;}
		console.log(vendedor)
		var param ={'Funcion':'totalCliente', 'variable':'1', 'fecha1':fecha1, 'fecha2':fecha2, 'vendedor':vendedor }
		$('#tclientes').html('');
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data + 'cliente=======================')
				var json = JSON.parse(data)	
				var clientesNo = json[0].num;
				$('#tclientes').html(clientesNo);

				setTimeout(function(){
					var fecha1 = $('#fechaInic').val();		
					var fecha2 = $('#fechaFi').val(); 		
					//console.log(fecha1)
					//console.log(fecha2)
					var vendedor = $('#nomVendedor').val();
					if (vendedor.length != 0) {}else{vendedor = 0;}
					var param ={'Funcion':'totalCliente', 'variable':'2', 'fecha1':fecha1, 'fecha2':fecha2, 'vendedor':vendedor }
					$('#negoExitosos').html('');
					$.ajax({
						data: JSON.stringify (param),
						type:"JSON",
						url: 'ajax.php',
						success:function(data){
							console.log(data + ' negocios exitosos')
							var datos = JSON.parse(data)	
							var exitosos = datos[0].num;
							$('#negoExitosos').html(exitosos + ' de ' + clientesNo);
							
						}
					});
				},500);
			}
		});
	},500);
}

function diasTotal() {
	var param ={'Funcion':'diasFinalesComercial'}
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data + ' kkkkkkkkk' )
		}
	});
}

function contactosEstadisticasGestion() {
	totalClientes();  
	setTimeout(function(){
		//totalClientes();
		var fecha1 = $('#fechaInic').val()
		var fecha2 = $('#fechaFi').val()
		var vendedor = $('#nomVendedor').val()
		if (vendedor.length != 0 ) {}else{vendedor = 0;}
		//console.log(fecha1)
		//console.log(fecha2)
		//console.log(vendedor)
		var param ={'Funcion':'contactosEstadisticasGestion', 'fecha1':fecha1, 'fecha2':fecha2, 'variable':'1', 'vendedor':vendedor}
		$('#c_GestionComercial').html('');
		$('#clienteCortaNeg').html('');
		$('#vendedorEficiente').html('');
		$('#MontoVendido').html('');
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data )
				var json = JSON.parse(data)	
				// tabla vista general
				htm = "<tr>";
				var duracionDias = 0;
				var a = 0;
				for ( i = 0; i< json.length; i++ ) {
					
					var negocio = json[i]['negocio_exitoso'];
					if (negocio == null) {
						negocio = 'NO';
					}else{
						a = a + parseInt(1);
						duracionDias = duracionDias + parseInt(json[i]['dias_negociacion']);
					}
				   htm=htm + '<tr>' + 
				   '<td>' + json[i]['nombre_cliente'] + '</td>' + 
				   '<td>' + json[i]['competencia'] + '</td>' + 
				   '<td>' + json[i]['asesor_comercial'] + '</td>' + 
				   '<td>' + negocio + '</td>' + 
				   '<td>' + json[i]['dias_negociacion'] + '</td>' + 
	  	        '</tr>'  ;
	  	      }
				html = "</tr>";
				console.log(a)
				var promedio = parseFloat(duracionDias/a);
				
				$('#c_GestionComercial').html(htm);  
				var n = NaN2Zero(promedio)
				n = Math.round(n);
				$('#tiempoMedio').html( n+ ' dias');
				
				setTimeout(function(){
					var fecha1 = $('#fechaInic').val()
					var fecha2 = $('#fechaFi').val()
					//console.log(fecha1)
					//console.log(fecha2)
					var param ={'Funcion':'contactosEstadisticasGestion', 'fecha1':fecha1, 'fecha2':fecha2, 'variable':'2'}
					
					$.ajax({
						data: JSON.stringify (param),
						type:"JSON",
						url: 'ajax.php',
						success:function(data){
							//console.log(data + ' iiiiiiiiiiiiiiiiiiiiiiiiiiii')
							var json = JSON.parse(data)	
							var monto = json[0].monto;
							$('#MontoVendido').html(monto); 

							setTimeout(function(){
								var fecha1 = $('#fechaInic').val()
								var fecha2 = $('#fechaFi').val()
								var param ={'Funcion':'contactosEstadisticasGestion', 'fecha1':fecha1, 'fecha2':fecha2, 'variable':'3'}
								$.ajax({
									data: JSON.stringify (param),
									type:"JSON",
									url: 'ajax.php',
									success:function(data){
										console.log(data + ' aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa')
										var json = JSON.parse(data)	
										var nombre = json[0].nombre_cliente;
										$('#clienteCortaNeg').html(nombre); 

										setTimeout(function(){
											var fecha1 = $('#fechaInic').val()
											var fecha2 = $('#fechaFi').val()
											//console.log(fecha1)
											//console.log(fecha2)
											var param ={'Funcion':'vendedorEficiente', 'fecha1':fecha1, 'fecha2':fecha2}
											
											$.ajax({
												data: JSON.stringify (param),
												type:"JSON",
												url: 'ajax.php',
												success:function(data){
													//console.log(data)
													var json = JSON.parse(data)
													var vendedor = json[0].vendedor;
													$('#vendedorEficiente').html(vendedor)
												}
											});
										},300);
									}
								});
							},300);
						}
					});
				},300);
			}
		});
	},300);
}

function NaN2Zero(n){
    return isNaN( n ) ? 0 : n; 
}