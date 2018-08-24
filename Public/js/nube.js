function eventServicios() {
    $('.servicios').css('background','#2B5A8A')   
    $('.servicios').css('color','#fff')   
}
	function pgVMActivas(){
		var param ={'Funcion':'pgVMActivas'};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log("Aui se imprimen las maquinas virtuales activas y el total")
				//console.log(data)
				var json =JSON.parse(data)
				var activas = json[0].activas
				var total = json[0].total

				var inac = parseInt(total) - parseInt(activas);

				if (inac != 0 ) {
					$('.servicios').css('color','#C91023');
				}

				$('#maquinasVirtuales').html('<b>'+ activas + ' de ' + total + '</b>')
			}
		});
	}
	function pgVMInctivas(){
		var param ={'Funcion':'pgVMInactivas'};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log("Aui se imprimen las listas de las VM inactivas")
				//console.log(data)
				print = JSON.parse(data);
				var res = "";
				if(print.length > 0 ){
					for(var i = 0;i < print.length;i++){
						num = parseInt(i) + parseInt(1);
					 	res = res + '<tr><th scope="row">'+num+'</th> <td>'+print[i]['name']+'</td></tr>';
					}
				}else{
					res = "<center><h5>No hay Maquinas inactivas</h5></center>";
				}
				$('#maquinasVirInactivas').html(res);
			}
		});
	}
	function pgHosts(){
		var param ={'Funcion':'pgHosts'};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log("Aqui se imprimen los host con su estado")
				//console.log(data)
				var json = JSON.parse(data);
				htm = "";
				for ( i = 0; i< json.length; i++ ) {

					var estado = json[i]['variable'];
					if (estado != 3 ) {
						$('.servicios').css('color','#C91023');
					}
					if (estado == 1 || estado == 4 ) {
						var text = '<span style="color: #C91023; font-size: 20px; " > <b>' + json[i]['estado'] + '</b></span>';
					}
					if (estado == 2 ) {
						var text = '<span style="color: #080C63; font-size: 20px; " > <b>' + json[i]['estado'] + '</b></span>';
					}
					if (estado == 3 ) {
						var text = '<span style="color: #176922; font-size: 20px; " > <b>' + json[i]['estado'] + '</b></span>';
					}
					htm = htm + '<tr>' + '<td>'+json[i].host+'</td>' +	'<td>'+text+'</td>' + '<td>'+json[i].numerovms+'</td>' + '</tr>';
				}
				
				$('#cuerpoHostServNube').html(htm);
			}
		});
	}
	function pgAlmacenamiento(){
		var param ={'Funcion':'pgAlmacenamiento'};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log("Aqui se el almacenamiento del server")
				console.log(data)
				var json = JSON.parse(data);
				var ocupado = parseFloat(json[0].ocupado);
				var E = ' GB';
				if (ocupado > 0) {
					$('#unoDatos').show(); 
					var name = json[0].name
					console.log(name + ' 111111111111')
					var disponible = parseFloat(json[0].disponible);
					var total = parseFloat(disponible) + parseFloat(ocupado)

					var a = ( parseFloat(disponible)*parseFloat(100) ) / parseInt(total);
					var a1 = ( parseFloat(ocupado)*parseFloat(100) ) / parseInt(total);
					total = total / parseInt(1024);
					console.log(a + ' kkkkkkkkkkkkkkkk')
					console.log(a1 + ' mmmmmmmmmmmmmmmm')

					if (a < 15) {
						$('.servicios').css('color','#C91023');
					}

					$('#totalDominioUno').html( '<b>CAPACIDAD:   ' + total.toFixed(1) + ' TB</b>')
					Highcharts.chart('dominioDatosUno', {
			        	chart: {
			            type: 'pie'
			        	},
			        	title: {
			            text: name
			        	},
			        	plotOptions: {
							series: {
							   dataLabels: {
							      enabled: true,
							      format: '{point.name} {point.y:.0f} ' + E
							   }
							}
						},
			       		tooltip: {
						   headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
							pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>  {point.y:,.0f} '+E+'</b><br/>'
						},
			        	series: [{
			            name: name,
			            colorByPoint: true,
			            data: [{
			               name: 'Disponible <br>' + a.toFixed(0)+'%<br>',
			               color: 'rgb(249, 164, 28)',
			               y: disponible
			            }, {
			               name: 'Ocupado <br>' + a1.toFixed(0)+'%<br>',
			               color: 'rgb(5, 172, 172)',
			               y: ocupado,
			            }]
			        	}]
			    	});
				}


				var ocupado = parseFloat(json[1].ocupado);
				if (ocupado > 0) {
					$('#dosDatos').show(); 
			    	var name = json[1].name
					var disponible = parseFloat(json[1].disponible);
					var total = parseFloat(disponible) + parseFloat(ocupado)

					var a = ( parseFloat(disponible)*parseFloat(100) ) / parseInt(total);
					var a1 = ( parseFloat(ocupado)*parseFloat(100) ) / parseInt(total);
					total = total / parseInt(1024);

					if (a < 15) {
						$('.servicios').css('color','#C91023');
					}

					$('#totalDominioDos').html( '<b>CAPACIDAD:   ' + total.toFixed(1) + ' TB</b>')
					Highcharts.chart('dominioDatosDos', {
			        	chart: {
			            type: 'pie'
			        	},
			        	title: {
			            text: name
			        	},
			        	plotOptions: {
							series: {
							   dataLabels: {
							      enabled: true,
							      format: '{point.name} {point.y:.0f} '+ E
							   }
							}
						},
			       		tooltip: {
						   headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
							pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>  {point.y:,.0f} '+E +'</b><br/>'
						},
			        	series: [{
			            name: name,
			            colorByPoint: true,
			            data: [{
			               name: 'Disponible <br>' + a.toFixed(0)+'%<br>',
			               color: 'rgb(249, 164, 28)',
			               y: disponible
			            }, {
			               name: 'Ocupado <br>' + a1.toFixed(0)+'%<br>',
			               color: 'rgb(5, 172, 172)',
			               y: ocupado,
			            }]
			        	}]
			    	});
				}

				var ocupado = parseFloat(json[2].ocupado);
				if (ocupado > 0) {
					$('#tresDatos').show(); 
			    	var name = json[2].name
					var disponible = parseFloat(json[2].disponible);
					var total = parseFloat(disponible) + parseFloat(ocupado)

					var a = ( parseFloat(disponible)*parseFloat(100) ) / parseInt(total);
					var a1 = ( parseFloat(ocupado)*parseFloat(100) ) / parseInt(total);
					total = total / parseInt(1024);

					if (a < 15) {
						$('.servicios').css('color','#C91023');
					}

					$('#totalDominioExport').html( '<b>CAPACIDAD:   ' + total.toFixed(1) + ' TB</b>')
					Highcharts.chart('DominioExport', {
			        	chart: {
			            type: 'pie'
			        	},
			        	title: {
			            text: name
			        	},
			        	plotOptions: {
							series: {
							   dataLabels: {
							      enabled: true,
							      format: '{point.name} {point.y:.0f} ' + E
							   }
							}
						},
			       		tooltip: {
						   headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
							pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>  {point.y:,.0f} '+ E +' </b><br/>'
						},
			        	series: [{
			            name: name,
			            colorByPoint: true,
			            data: [{
			               name: 'Disponible <br>' + a.toFixed(0)+'%<br>',
			               color: 'rgb(249, 164, 28)',
			               y: disponible
			            }, {
			               name: 'Ocupado <br>' + a1.toFixed(0)+'%<br>',
			               color: 'rgb(5, 172, 172)',
			               y: ocupado,
			            }]
			        	}]
			    	});
				}

				var ocupado = parseFloat(json[3].ocupado);
				if (ocupado > 0) {
					$('#cuatroDatos').show(); 
			    	var name = json[3].name
					var disponible = parseFloat(json[3].disponible);
					var total = parseFloat(disponible) + parseFloat(ocupado)

					var a = ( parseFloat(disponible)*parseFloat(100) ) / parseInt(total);
					var a1 = ( parseFloat(ocupado)*parseFloat(100) ) / parseInt(total);
					total = total / parseInt(1024);

					if (a < 15) {
						$('.servicios').css('color','#C91023');
					}

					$('#totalDominioISO').html( '<b>CAPACIDAD:   ' + total.toFixed(1) + ' TB</b>')
					Highcharts.chart('DominioISO', {
			        	chart: {
			            type: 'pie'
			        	},
			        	title: {
			            text: name
			        	},
			        	plotOptions: {
							series: {
							   dataLabels: {
							      enabled: true,
							      format: '{point.name} {point.y:.0f} ' + E
							   }
							}
						},
			       		tooltip: {
						   headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
							pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>  {point.y:,.0f} ' + E + ' </b><br/>'
						},
			        	series: [{
			            name: name,
			            colorByPoint: true,
			            data: [{
			               name: 'Disponible <br>' + a.toFixed(0)+'%<br>',
			               color: 'rgb(249, 164, 28)',
			               y: disponible
			            }, {
			               name: 'Ocupado <br>' + a1.toFixed(0)+'%<br>',
			               color: 'rgb(5, 172, 172)',
			               y: ocupado,
			            }]
			        	}]
			    	});
				}

				var ocupado = parseFloat(json[4].ocupado);
				if (ocupado > 0) {
					$('#cincoDatos').show(); 
			    	var name = json[4].name
					var disponible = parseFloat(json[0].disponible);
					var total = parseFloat(disponible) + parseFloat(ocupado)

					var a = ( parseFloat(disponible)*parseFloat(100) ) / parseInt(total);
					var a1 = ( parseFloat(ocupado)*parseFloat(100) ) / parseInt(total);
					total = total / parseInt(1024);

					if (a < 15) {
						$('.servicios').css('color','#C91023');
					}

					$('#totalCincoDatos').html( '<b>CAPACIDAD:   ' + total.toFixed(1) + ' TB</b>')
					Highcharts.chart('cincoDatos', {
			        	chart: {
			            type: 'pie'
			        	},
			        	title: {
			            text: name
			        	},
			        	plotOptions: {
							series: {
							   dataLabels: {
							      enabled: true,
							      format: '{point.name} {point.y:.0f} ' + E
							   }
							}
						},
			       		tooltip: {
						   headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
							pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>  {point.y:,.0f} ' + E + ' </b><br/>'
						},
			        	series: [{
			            name: name,
			            colorByPoint: true,
			            data: [{
			               name: 'Disponible <br>' + a.toFixed(0)+'%<br>',
			               color: 'rgb(249, 164, 28)',
			               y: disponible
			            }, {
			               name: 'Ocupado <br>' + a1.toFixed(0)+'%<br>',
			               color: 'rgb(5, 172, 172)',
			               y: ocupado,
			            }]
			        	}]
			    	});
				}

				var ocupado = parseFloat(json[5].ocupado);
				if (ocupado > 0) {
					$('#seisDatos').show(); 
			    	var name = json[5].name
					var disponible = parseFloat(json[0].disponible);
					var total = parseFloat(disponible) + parseFloat(ocupado)

					var a = ( parseFloat(disponible)*parseFloat(100) ) / parseInt(total);
					var a1 = ( parseFloat(ocupado)*parseFloat(100) ) / parseInt(total);
					total = total / parseInt(1024);

					if (a < 15) {
						$('.servicios').css('color','#C91023');
					}

					$('#totalSeis').html( '<b>CAPACIDAD:   ' + total.toFixed(1) + ' TB</b>')
					Highcharts.chart('seisDatos', {
			        	chart: {
			            type: 'pie'
			        	},
			        	title: {
			            text: name
			        	},
			        	plotOptions: {
							series: {
							   dataLabels: {
							      enabled: true,
							      format: '{point.name} {point.y:.0f} '+ E
							   }
							}
						},
			       		tooltip: {
						   headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
							pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>  {point.y:,.0f} '+ E + '</b><br/>'
						},
			        	series: [{
			            name: name,
			            colorByPoint: true,
			            data: [{
			               name: 'Disponible <br>' + a.toFixed(0)+'%<br>',
			               color: 'rgb(249, 164, 28)',
			               y: disponible
			            }, {
			               name: 'Ocupado <br>' + a1.toFixed(0)+'%<br>',
			               color: 'rgb(5, 172, 172)',
			               y: ocupado,
			            }]
			        	}]
			    	});
				}
			}
		});
	}

	function totalUsuarios() {
		var param ={'Funcion':'totalUsuarios'};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data )
				var total = JSON.parse(data);
				var t = total[0].totalUser;
				//console.log(t )
				$('#totalUser').html(t);
				var param ={'Funcion':'totalUsuarios', 'variable':'1'};
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data)
						var json = JSON.parse(data);
						htm = "";
						for ( i = 0; i< json.length; i++ ) {
							htm = htm + '<tr>' +
							'<td>'+json[i].nombre+'</td>' +
							'<td>'+json[i].tuser+'</td>' +
							'</tr>';
						}
						$('#tUsuarios').html(htm);
					}
				});
			}
		});
	}

	function totalEspacio() {
		var param ={'Funcion':'totalEspacio'};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				var json = JSON.parse(data);

				var consumido = parseInt(json[0].consumido)
				var capacidad = parseInt(json[0].capacidad)

				var total = parseInt(consumido) + parseInt(capacidad)  ;
				var a = ( ( parseInt(capacidad) * 100 ) / parseInt(total) )
				var a1 = parseInt(100) - parseFloat(a);
				if (a < 20 ) {
					$('.servicios').css('color','#C91023');
				}

				Highcharts.chart('totalEspacio', {
				   chart: {
			         type: 'pie'
			      },
			      title: {
			         text: 'Uso total de espacio'
			      },
			      subtitle: {
			         text: ''
			      },
			      plotOptions: {
			         series: {
			            dataLabels: {
			            enabled: true,
			            format: '{point.name} {point.y:.0f} GB '
			            }
			         }
			      },
		         tooltip: {
		            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
					   pointFormat: '<span style="color:{point.color}">{point.name}</span> <b> {point.y:,.0f} GB </b><br/>'
		         },
				   series: [{
	               name: 'Espacio',
	               colorByPoint: true,
	               data: [{
	                  name: ' Disponible <br>' + a.toFixed(0)+'%<br>',
							color: 'rgb(249, 164, 28)',
	                  y: capacidad
	               }, {
	                  name: ' Usado<br>' + a1.toFixed(0)+'%<br>',
	                  color: 'rgb(5, 172, 172)',
	                  y: consumido,
	               }]
	            }]
			   });

			   var param ={'Funcion':'totalEspacio', 'variable':'1'};
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						var json = JSON.parse(data);

						var nombre = [];
						var disponibleC = [];
						var consumido = [];
						var total = [];
						for (var i = 0 ; i < json.length; i++) {
							var num1 = parseInt(json[i]['cli_capacidad']);
							var num2 = parseInt(json[i]['clic_consumido']);
							var t = parseInt(num1) - parseInt(num2);
							nombre.push(json[i]['cli_nombre'])
							disponibleC.push(json[i]['cli_capacidad'])
							consumido.push(json[i]['clic_consumido'])
							total.push(t)
						}

						
						console.log(nombre + ' ----------------')
						console.log(disponibleC + ' ----- disponible-----------')
						console.log(consumido + ' ---------- consumido------')
						console.log(total + ' ----------- diferencia-----')

						Highcharts.chart('datosEspEspacio', {
					       chart: {
					            type: 'bar'
					        },
					        title: {
					            text: 'USO CLIENTES'
					        },
					        xAxis: {
								  	categories: nombre
								  },
					        yAxis: [{
					            min: 0,
					            title: {
					                text: ''
					            }
					        }, {
					            title: {
					                text: 'GB'
					            },
					            opposite: true
					        }],
					        legend: {
					            shadow: true
					        },
					        tooltip: {
					            shared: true
					        },
					        plotOptions: {
					            series: {
		                        	stacking: 'normal'
		                     	}
					        },
					        series: [{
					            name: 'Disponible',
								color: 'rgb(249, 164, 28)',
					            data: total,
					            pointPadding: 0.2,
					            pointPlacement: -0.2
					        }, {
					            name: 'consumido',
					            color: 'rgb(1, 78, 141)',
					            data: consumido,
					            pointPadding: 0.2,
					            pointPlacement: -0.2
					        }]
					    });

					}
				});

			}
		});
	}
	function licencia() {
		var param ={'Funcion':'selectLicenciaNube' }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data)
				var json = JSON.parse(data)

				var vencimientoLi = json[0].fechaCa
				var ultimopago = json[0].fechaUl
				var valor = json[0].monto
				//console.log(vencimientoLi)
				//console.log(ultimopago)
				//console.log(valor)

				var variable = json[0].var
				if (variable == 1) {
					var ht = '<span style="color: #C91023;" >' + vencimientoLi + '</span>';
					$('.servicios').css('color','#C91023');
				}else{
					var ht = '<span>' + vencimientoLi + '</span>';
				}

				$('#vencLiencia').html( ht );
				$('#ultPago').html( ultimopago );
				$('#valLicencia').html( valor + ' USD' );
			}
		});
	}
	function estadoServicio() {
		var princilpal = '200.75.46.124';
		var ip = princilpal;
		//console.log(ip + '______________________________________________')
		var paramx ={'Funcion':'pingPHP', 'ip':ip}
		$.ajax({
			data: JSON.stringify (paramx),
			type:"JSON",
			url: 'ajax.php',
				success:function(datax){
				//console.log(datax + ' ?????????????????????')
				var json = JSON.parse(datax)

				var prin = json[0].val;
				if (prin == 1 ) {
					$('#principal').html('<span style="color: #176922;" > OK </span>');
				}else{
					$('#principal').html('<span style="color: #C91023;" > Unknown </span>');
				}
				
				var replica = '200.75.46.122';
				var ip = replica;
				//console.log(ip + '______________________________________________')
				var paramx ={'Funcion':'pingPHP', 'ip':ip}
				$.ajax({
					data: JSON.stringify (paramx),
					type:"JSON",
					url: 'ajax.php',
						success:function(datax){
						//console.log(datax + ' ?????????????????????')
						var json = JSON.parse(datax)

						var replica = json[0].val;
						if (replica == 1 ) {
							$('#replica').html('<span style="color: green;" > OK </span>');
						}else{
							$('#replica').html('<span style="color: #C91023;" > Unknown </span>');
						}
						//var replica = '201.245.191.91';
					}
				});
			}
		});
	}

function AtencionClienteDetallesNube() {
	atencionClienteAlmNube()
	AtencionTiempo()
}
	function atencionClienteAlmNube() {
		var fechaInicio = $('#fechaInicio').val();
		var fechaFin = $('#fechaFin').val();
		////console.log(fechaInicio + ' fecha1')
		//console.log(fechaFin + ' fecha2')

		var param ={'Funcion':'AtencionPersonal', 'fechaInicio':fechaInicio, 'fechaFin':fechaFin, 'estado':'4' }
		$('#cuerpo').html('');
			$.ajax({
	            data: JSON.stringify (param),
	            type:"JSON",
	            url: 'ajax.php',
	            success:function(data){
	            	//console.log(data + ' personal')
	            		//console.log('!!====================================')
		            	var pers = JSON.parse(data)

		            	var respoP = pers[0]['responsableEficP'] // responsable personal
		            	var r = pers[0]['vecesP']


		            	var table = $('#table');
						   var tBody = $('#cuerpo');
				         for(var i = 0; i<pers.length; i++) {			            		
				           	// contruccion de los campos de la tabla	            		
								//totalPagina += 1;
					        	var tr = $('<tr></tr>');	
								var cliente = $('<td></td>');	
					         var asunto = $('<td></td>');	
					         var responsable = $('<td></td>');	
								var fecha = $('<td></td>');	
								var estado = $('<td></td>');

								cliente.text(pers[i]['cliente']);	
								asunto.text(pers[i]['desServicio']);	
						      responsable.text(pers[i]['Responsable']);	
						      fecha.text(pers[i]['fecha']);		            		
								estado.text(pers[i]['estado'] );
									// abrimos los datos en la tabla
								tr.append(cliente); 	tr.append(asunto);		tr.append(responsable);		tr.append(fecha);	tr.append(estado);	tBody.append(tr);
							}	
	            		

	            	var param ={'Funcion':'atenEmpresarial', 'fecha1':fechaInicio, 'fecha2':fechaFin, 'estado':'4'};
						$.ajax({
						   data: JSON.stringify (param),
						   type:"JSON",
						   url: 'ajax.php',
						   success:function(data1){
					         //console.log(data1 + ' =============')
						         var emp = JSON.parse(data1)
						         var respoE = emp[0]['responsableEficE'] // responsable empresarial
						         var r1 = emp[0]['vecesE']

						         $('#AsuntoFrecuenteTel').html(emp[0]['Nomservicio'])
						        	
						        	// calculamos cual de los responsables se repite mas veces !!!
						        	// responsable personal mayor que empresarial
						         if ( r > r1 ) {
						            $('#resp_Ef_ente').html(respoP)
						         }else{
						            $('#resp_Ef_ente').html(respoE)
						         }

									var table = $('#table');
								   var tBody = $('#cuerpo');
						         for(var i = 0; i<emp.length; i++) {			            		
						           	// contruccion de los campos de la tabla	            		
										//totalPagina += 1;
							        	var tr = $('<tr></tr>');	
										var cliente = $('<td></td>');	
							            var asunto = $('<td></td>');	
							            var responsable = $('<td></td>');	
										var fecha = $('<td></td>');	
										var estado = $('<td></td>');

										cliente.text(emp[i]['cliente']);	
										asunto.text(emp[i]['desServicio']);	
								        responsable.text(emp[i]['Responsable']);	
								        fecha.text(emp[i]['fecha']);		            		
										estado.text(emp[i]['estado'] );
											// abrimos los datos en la tabla
										tr.append(cliente); 	tr.append(asunto);		tr.append(responsable);		tr.append(fecha);	tr.append(estado);	tBody.append(tr);
									}					         	

					      }
					   });
					}
	        });
	}
	function AtencionTiempo() {
		var fechaInicio = $('#fechaInicio').val();
		var fechaFin = $('#fechaFin').val();
				
		var param ={'Funcion':'AtencionClienteDetallestelefoniaPersonalesTiempo', 'fechaInicio':fechaInicio, 'fechaFin':fechaFin, 'estado':'4'  }
			$.ajax({
			   data: JSON.stringify (param),
			   type:"JSON",
			   url: 'ajax.php',
			   success:function(data){
			   	//console.log(data) 
			   	var json = JSON.parse(data)		            	
			   	//Inicializamos variables en cero, contadoras de tiempo
			   	var t_anno = 0;  	var t_mes = 0;	   	var t_dia = 0;	   	var t_hora = 0;	   	var t_min = 0;	   	var t_seg = 0;	       	
			            	 
			      for(var i = 0; i<json.length; i++) {			            		
			            		
			         var diferencia = (json[i]['diferencia'])
			         //console.log(diferencia + ' ==============================')
			         var dif = diferencia.split( ':' );
			         // accedemos a cada uno de los campos de la fecha
			         var a = (dif[0])
			         var mes = (dif[1])
			         var dia = (dif[2])		            		
			         var hora = (dif[3])
			         var min = (dif[4])
			         var seg = (dif[5])
			         // sumamos cada uno de los formatos de la fecha // Y-m-d 00:00:00
			         t_anno = (parseInt(t_anno) + parseInt(a) );	
			         t_mes = (parseInt(t_mes) + parseInt(mes) );
			         t_dia = (parseInt(t_dia) + parseInt(dia) );
			         t_hora = (parseInt(t_hora) + parseInt(hora) );
			         t_min = (parseInt(t_min) + parseInt(min) );
			         t_seg = (parseInt(t_seg) + parseInt(seg) );
			      }

			      // dividimos cada una de las sumas para obtener promedio
			      var t_annoPe = ( parseInt(t_anno) / parseInt(json.length) )
			      var t_mesPe = ( parseInt(t_mes) / parseInt(json.length) )
			      var t_diaPe = ( parseInt(t_dia) / parseInt(json.length) )
			      var t_horaPe = ( parseInt(t_hora) / parseInt(json.length) )
			      var t_minPe = ( parseInt(t_min) / parseInt(json.length) )
			      var t_segPe = ( parseInt(t_seg) / parseInt(json.length) )

			      var fechaInicio = $('#fechaInicio').val();
					var fechaFin = $('#fechaFin').val();
					var param ={'Funcion':'AtencionClienteDetallestelefoniaEmpresarialesTiempo', 'fechaInicio':fechaInicio, 'fechaFin':fechaFin, 'estado':'4'  }
					$.ajax({
					   data: JSON.stringify (param),
					   type:"JSON",
					   url: 'ajax.php',
					   success:function(data1){
					   	//console.log(data) 
					   	var jsonEm = JSON.parse(data1)		            	
					   	//Inicializamos variables en cero, contadoras de tiempo
					   	var t_anno1 = 0;  	var t_mes1 = 0;	   	var t_dia1 = 0;	   	var t_hora1 = 0;	   	var t_min1 = 0;	   	var t_seg1 = 0;	       	
					           	 
					      for(var i = 0; i<jsonEm.length; i++) {			            		
					            		
					         var diferencia = (jsonEm[i]['diferencia'])
					         var dif = diferencia.split( ':' );
					         // accedemos a cada uno de los campos de la fecha
					         var a1 = (dif[0])
					        	var mes1 = (dif[1])
					         var dia1 = (dif[2])		            		
					         var hora1 = (dif[3])
					         var min1 = (dif[4])
					         var seg1 = (dif[5])
					         // sumamos cada uno de los formatos de la fecha // Y-m-d 00:00:00
					         t_anno1 = (parseInt(t_anno1) + parseInt(a1) );	
					         t_mes1 = (parseInt(t_mes1) + parseInt(mes1) );
					         t_dia1 = (parseInt(t_dia1) + parseInt(dia1) );
					        	t_hora1 = (parseInt(t_hora1) + parseInt(hora1) );
					         t_min1 = (parseInt(t_min1) + parseInt(min1) );
					         t_seg1 = (parseInt(t_seg1) + parseInt(seg1) );
					      }
					      // dividimos cada una de las sumas para obtener promedio
					      var t_annoEm = ( parseInt(t_anno1) / parseInt(jsonEm.length) )
					      var t_mesEm = ( parseInt(t_mes1) / parseInt(jsonEm.length) )
					      var t_diaEm = ( parseInt(t_dia1) / parseInt(jsonEm.length) )
					      var t_horaEm = ( parseInt(t_hora1) / parseInt(jsonEm.length) )
					      var t_minEm = ( parseInt(t_min1) / parseInt(jsonEm.length) )
					      var t_segEm = ( parseInt(t_seg1) / parseInt(jsonEm.length) )
			      
					      var t_anno1 =  ( parseInt(t_annoPe) + parseInt(t_annoEm) ) / parseInt(2);
					      var t_mes1 = ( parseInt(t_mesPe) + parseInt(t_mesEm) ) / parseInt(2);
							var t_dia1 = ( parseInt(t_diaPe) + parseInt(t_diaEm) ) / parseInt(2);
							var t_hora1 = ( parseInt(t_horaPe) + parseInt(t_horaEm) ) / parseInt(2);
							var t_min1 = ( parseInt(t_minPe) + parseInt(t_minEm) ) / parseInt(2);
							var t_seg1 = ( parseInt(t_segPe) + parseInt(t_segEm) ) / parseInt(2);

					      //conversion de dia
					      if (t_dia1 % 1 == 0) {
								var diaf = t_dia1;
								var conversionDia = 0;
							}else{
								var diaf =Math.floor(t_dia1);// agarramos la parte entera del dia				        
								var decimalsDia = t_dia1 - Math.floor(t_dia1); // le restamos la parte decimal al dia
								var conversionDia = decimalsDia * parseInt(24);				        
							}
							//conversion de horas
							if (t_hora1 % 1 == 0) {
								var horaf = t_hora1 + parseFloat(conversionDia); //console.log(horaf + ' horas f')
								var conversionHora = 0;
							}else{
								var horaf =Math.floor(t_hora1);// agarramos la parte entera del horas				        
								var decimalsHora = t_hora1 - Math.floor(t_hora1); // le restamos la parte decimal a las horas
								var conversionHora = decimalsHora * parseInt(60); //console.log(conversionHora + ' minutos sobrados')				        
							} 
							var resMin = conversionHora + t_min1; //console.log(resMin)// valor de minutos agregados
							if (resMin >= 60 ) {
								horaf = horaf + parseInt(1); //console.log(horaf + ' horas')
								t_min2 = resMin - parseInt(60); //console.log(t_min2 + ' minutos')
							}else{
								horaf = horaf; //console.log(horaf + ' horas')
								t_min2 = resMin; //console.log(t_min2 + ' minutos')
							}					    
							//Conversion de minutos
							if (t_min2 % 1 == 0) {
								var minf = t_min2; //console.log(minf)
								var conversionMin = 0;
							}else{
								var minf =Math.floor(t_min2);// agarramos la parte entera del minutos				        
								var decimalsMin = t_min2 - Math.floor(t_min2); // le restamos la parte decimal a minutos
								var conversionMin = decimalsMin * parseInt(60);				        
							}
							var resSeg = parseFloat(conversionMin) + parseFloat(t_seg1); //console.log(resSeg)// valor de Segundos agregados	
							if (resSeg >= 60 ) {
								minf = minf + parseInt(1); //console.log(minf + ' Minutos')
								t_seg2 = resSeg - parseInt(60); //console.log(t_seg2 + ' Segundos')
							}else{
								minf = minf; //console.log(minf + ' Minutos')
								t_seg2 = resSeg; //console.log(t_seg2 + 'Segundos')
							}
							if (t_seg2 % 1 == 0) {
								var segf = t_seg2; //console.log(segf)
							}else{
								var segf =Math.floor(t_seg2);// agarramos la parte entera de los segundos				        
								var decimalsSeg = t_seg2 - Math.floor(t_seg2); // le restamos la parte decimal a los segundos
								var conversionSeg = decimalsMin * parseInt(99);				        
							}
							//console.log(t_hora1)
					      if ( t_hora1  > 0) {
					         $('#tiempo').html(horaf + 'Horas ' + minf + 'Minutos ' + segf + 'Segundos');
					      }else if( t_min1 > 0){
					         $('#tiempo').html(minf + 'Minutos '+ segf + 'Segundos');
					      }else if( t_seg1 > 0){
					         $('#tiempo').html(segf + 'Segundos');
					      }else{
					         $('#tiempo').html('0');
					      }
					   }
					});
			   }
			});
	}




	