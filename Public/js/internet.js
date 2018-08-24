function eventInternet() {
    $('.internet').css('background','#2B5A8A')   
    $('.internet').css('color','#fff')   
}
function conMax() {
	setTimeout(function(){
	var param ={'Funcion':'contratoMaxMin', 'variable':'1'  }
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data + ' empresarial')
				json = JSON.parse(data)
				var conMaxE = parseInt(json[0].conmax);
				var conMinE = parseInt(json[0].conmin);

				var param ={'Funcion':'contratoMaxMin', 'variable':'2'  }
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data + ' personal')
						json = JSON.parse(data)
						var conMaxP = parseInt(json[0].conmax);
						var conMinP = parseInt(json[0].conmin);
				
						var max_con = parseInt(conMaxE) + parseInt(conMaxP);
						var min_con = parseInt(conMinE) + parseInt(conMinP);

						var maximo = formatearNumero(max_con) + ' Mbps';
						var minimo = formatearNumero(min_con) + ' Mbps';


						$('#contratoMinimo').highcharts({
							chart: {
					         //plotBackgroundColor: '#eaeaea',
					         //plotBorderWidth: 2,
					         plotShadow: false
					      },
					      title: {
					         text:  minimo,
					         align: 'center',
					         verticalAlign: 'middle',
					         y: 70
					      },
					      tooltip: {
					         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					      },
					      plotOptions: {
					         pie: {
					            dataLabels: {
					               enabled: true,
					               distance: -50,
					                  style: {
					                  fontWeight: 'bold',
					                  color: 'black'
					               }
					            },
					            startAngle: -90,
					            endAngle: 90,
					            center: ['50%', '80%']
					         }
					      },
					      series: [{
					         type: 'pie',
					         name: 'Contrato Mínimo',
					         innerSize: '50%',
					         data: [
					            ['Min Comprometido',   min_con]					                
					         ]
					      }]
						});

						$('#contratoMaximo').highcharts({
							chart: {
					         //plotBackgroundColor: '#eaeaea',
					         //plotBorderWidth: 2,
					         plotShadow: false
					      },
					      title: {
					         text:  maximo,
					         align: 'center',
					         verticalAlign: 'middle',
					         y: 70
					      },
					      tooltip: {
					         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					      },
					      plotOptions: {
					         pie: {
					            dataLabels: {
					               enabled: true,
					               distance: -50,
					                  style: {
					                  fontWeight: 'bold',
					                  color: 'black'
					               }
					            },
					            startAngle: -90,
					            endAngle: 90,
					            center: ['50%', '80%']
					         }
					      },
					      series: [{
					         type: 'pie',
					         name: 'Contrato Máximo',
					         innerSize: '50%',
					         data: [
					            ['Max comprometido',   max_con]					                
					         ]
					      }]
						});
					}
				});
			}
		});
	},100);
}

function selecEspacio() {
	var param ={'Funcion':'selecEspacioUsado'}
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			console.log(data)
			var json = JSON.parse(data)

			var uso = parseInt(json[0].usado);
			var capacidad = json[0].capacidad;
			var disponible = parseInt(capacidad) - parseInt(uso);

			$('#EspacioUso').highcharts({
				chart: {
					//plotBackgroundColor: '#eaeaea',
					//plotBorderWidth: 2,
					plotShadow: false
				},
				title: {
					text:  'Uso<br>Banda<br>Ancha',
					align: 'center',
					verticalAlign: 'middle',
					y: 50
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						dataLabels: {
						   enabled: true,
						   distance: -30,
						   style: {
						      fontWeight: 'bold',
						      color: 'black'
						   }
						},
						startAngle: -90,
						endAngle: 90,
						center: ['50%', '80%']
					}
				},
				series: [{
					type: 'pie',
					name: 'Contrato Máximo',
					innerSize: '50%',
					data: [
						['Usado <br>"' + uso + ' Mbps " ',   uso],		
						['Disponible <br>"' + disponible + ' Mbps " ',   disponible]	
					]
				}]
			});

			$('#EspacioDisponible').highcharts({
				chart: {
					//plotBackgroundColor: '#eaeaea',
					//plotBorderWidth: 2,
					plotShadow: false
				},
				title: {
					text:  'Uso<br>Banda<br>Ancha',
					align: 'center',
					verticalAlign: 'middle',
					y: 50
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						dataLabels: {
						   enabled: true,
						   distance: -30,
						   style: {
						      fontWeight: 'bold',
						      color: 'black'
						   }
						},
						startAngle: -90,
						endAngle: 90,
						center: ['50%', '80%']
					}
				},
				series: [{
					type: 'pie',
					name: 'Contrato Máximo',
					innerSize: '50%',
					data: [
						['Disponible <br>"' + disponible + ' Mbps " ',   disponible]	,		                
						['Capacidad <br>"' + capacidad + ' Mbps " ',   disponible]			                
					]
				}]
			});

		}
	});
}


function selecCanalesContratados() {
	setTimeout(function(){
		var param ={'Funcion':'selecCanalesContratados'}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data)
				var json = JSON.parse(data)
				result = [];
				for (var i = 0 ; i < json.length; i++) {
					result.push({'name': json[i]['nombre'] , "y" : json[i]['megas']});
				}
				console.log(result)
				// armo datos de forma tal que me queden organizados como se reciben en el data highcharts
				setTimeout(function(){

		   	Highcharts.chart('CanInCon', {
			     	chart: {
		            type: 'pie'
		        	},
		        	title: {
		            text: 'CANALES INTERNACIONALES CONTRATADOS'
		        	},
		        	subtitle: {
		            text: ''
		        	},
		        	plotOptions: {
		            series: {
		               dataLabels: {
		                  enabled: true,
		                  format: '{point.name}: {point.y:.0f} Mbps'
		               }
		            }
		        	},
	            tooltip: {
	               headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>  {point.y:,.0f} MB</b><br/>'
	            },
			      series: [{
			         name: 'Canales',
		    	        data:  result
		      	}]
		   	});
		   	},900);
			}
		});
	},200);
}


function AtencionClienteDetallesInternet() {
	atencionClienteInternet()
	AtencionTiempoInternet()
}
	function atencionClienteInternet() {
		var fechaInicio = $('#fechaInicioI').val();
		var fechaFin = $('#fechaFinI').val();
		console.log(fechaInicio + ' fecha1')
		console.log(fechaFin + ' fecha2')

		var param ={'Funcion':'AtencionPersonal', 'fechaInicio':fechaInicio, 'fechaFin':fechaFin, 'estado':'1' }
		$('#cuerpo').html('');
			$.ajax({
	            data: JSON.stringify (param),
	            type:"JSON",
	            url: 'ajax.php',
	            success:function(data){
	            	//console.log(data + ' personal')
	            		console.log(data+ '!!====================================')
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
	            		
						var fechaInicio = $('#fechaInicioI').val();
						var fechaFin = $('#fechaFinI').val();
						//console.log(fechaInicio + ' fecha1')
						//console.log(fechaFin + ' fecha2')
	            	var param ={'Funcion':'atenEmpresarial', 'fecha1':fechaInicio, 'fecha2':fechaFin, 'estado':'1'};
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
	function AtencionTiempoInternet() {
		var fechaInicio = $('#fechaInicioI').val();
		var fechaFin = $('#fechaFinI').val();
				
		var param ={'Funcion':'AtencionClienteDetallestelefoniaPersonalesTiempo', 'fechaInicio':fechaInicio, 'fechaFin':fechaFin, 'estado':1  }
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

			      var fechaInicio = $('#fechaInicioI').val();
					var fechaFin = $('#fechaFinI').val();
					var param ={'Funcion':'AtencionClienteDetallestelefoniaEmpresarialesTiempo', 'fechaInicio':fechaInicio, 'fechaFin':fechaFin, 'estado':1  }
					$.ajax({
					   data: JSON.stringify (param),
					   type:"JSON",
					   url: 'ajax.php',
					   success:function(data1){
					   	//console.log(data + ' _______________________--') 
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













//formatear numeros -- separador
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
