function eventVentas() {
    $('.ventas').css('background','#2B5A8A')   
    $('.ventas').css('color','#fff')   
}

var printo = "";  
var factura = "";
var factura2 = "";
var meta = "";

	function Meta(){
		var param ={'Funcion':'Meta'};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				printo = data;
				FacturadoFecha();
			}
		});
	}

	function FacturadoFecha(){
		$('#AtencionCliente').click();
		//console.log("mi meta del mes"+printo);
		// Envio los parametros que deseo, pero siempre tiene que ir el nombre de la funcion  Funcion = miFuncion y apuntando a la misma url ajax.php que quiero ejecutar en el principalController, envios los datos en JSON para recibirlos y convertirlos en un array en el php para poder manejarlos mejor
		meta=JSON.parse(printo);
		var param ={'Funcion':'FacturadoFecha'};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(dataf){
			//console.log(dataf)
			var facturacion=JSON.parse(dataf);
			factura  = parseInt(facturacion[0]['facturacion']);
			//VentaPromedio();
			var metaMes = parseFloat(meta[0]['meta']);
			//console.log(metaMes,factura);
			$('#canvas1').highcharts({
				chart: {
				    type: 'column'
				},
				title: {
				    text: 'Balance Total en  $'
				},
				subtitle: {
				    text: ''
				},
				xAxis: {
				    type: 'category'
				},
				yAxis: {
				    title: {
				        text: 'valores'
				    }
				},
				legend: {
				    enabled: false
				},
				plotOptions: {
				    series: {
				        borderWidth: 0,
				        dataLabels: {
			    	        enabled: true,
					        format: '{point.y:,.0f}'
				        }
				    }
				},
				tooltip: {
				    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
				    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> ${point.y:,.1f}</b><br/>'
				},
				series: [{
				    name: 'Ventas '+facturacion[0]['mes'],
				    colorByPoint: true,
				    data: [{
				        name: 'Meta',
				        y:metaMes,
				       drilldown: 'Meta'
				    }, {
				        name: 'Facturacion a la fecha',
				        y: factura,
				        drilldown: 'Facturacion a la fecha'
				    }]
				}]
			});
			var promedio = parseInt(factura / facturacion[0]['dias']);
			var metaMes = parseInt(meta[0]['meta'] / meta[0]['dias']);
				//console.log(metaMes,promedio);
		    $('#canvas3').highcharts({
			        chart: {
			            type: 'column'
			        },
			        title: {
			            text: 'Balance Promedio Diario $'
			        },
			        subtitle: {
			            text: ''
			        },
			        xAxis: {
			            type: 'category'
			        },
			        yAxis: {
			            title: {
			                text: 'valores'
			            }
				    },
			        legend: {
			            enabled: false
			        },
			        plotOptions: {
			            series: {
			                borderWidth: 0,
					        dataLabels: {
			                	enabled: true,
			                	format: '{point.y:,.0f}'
			                }
			            }
			        },
				    tooltip: {
						headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> ${point.y:,.1f}</b><br/>'
					},
					series: [{
						name: 'Ventas ',
						colorByPoint: true,
						data: [{
						    name: "Meta",
						    y:metaMes,
						    drilldown: "Meta"
						},{
						    name: "Promedio Dia",
						    y:promedio,
						   drilldown: "Dias"
						}]
					}]
			});//console.log(data+"diasssssss")
				
			if(promedio >= meta ){
				$('#Ventas').css('color','#C91023');
			}
			}
		});	
	}
		
	function MinutosTodos(){
        var minutoCol, minutoVen, minutoTod, mes;
        var param ={'Funcion':'Minutos','destino':"Todos"};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(datat){
				//console.log(datat)
				var minutos = JSON.parse(datat);
				minuto = parseInt(minutos[0]['minutos']);
				h = minuto + 100;
				var param ={'Funcion':'Minutos','destino':'Colombia'};
				
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(datac){
						//console.log(datac)
						var minutos = JSON.parse(datac);
						minutoCol = parseInt(minutos[0]['minutos']);
						mes = minutos[0]['mes'];
						var param ={'Funcion':'Minutos','destino':'Venezuela'};
						$.ajax({
							data: JSON.stringify (param),
							type:"JSON",
							url: 'ajax.php',
							success:function(datav){
								//console.log(datav)
								var minutos = JSON.parse(datav);
								minutoVen = parseInt(minutos[0]['minutos']);
								mes = minutos[0]['mes'];
								var param ={'Funcion':'Minutos','destino':'Internacionales'};
								$.ajax({
									data: JSON.stringify (param),
									type:"JSON",
									url: 'ajax.php',
									success:function(data){
										//console.log(data)
										var minutos = JSON.parse(data);
										minutoTod = parseInt(minutos[0]['minutos']) ;
									    mes = minutos[0]['mes'];

									    var uno = parseInt(minuto);
									    var dos = parseInt(minutoCol);
									    var tres = parseInt(minutoVen);
									    var cuatro = parseInt(minutoTod);

									    //console.log(uno + ' uno')
									    //console.log( dos + ' dos')
									    //console.log( tres + ' tres')
									    //console.log( cuatro + ' cuatro')


									    var t = (parseInt(dos) * parseInt(100) ) / parseInt(uno);
									    var t1 = (parseInt(tres) * parseInt(100) ) / parseInt(uno);
									    var t2 = (parseInt(cuatro) * parseInt(100) ) / parseInt(uno);


									    $('#canvas4').highcharts({
									        chart: {
									            type: 'column'
									        },
									        title: {
									            text: 'Balance de Minutos'
									        },
									        subtitle: {
									            text: ''
									        },
									        xAxis: {
									            type: 'category'
									        },
									        yAxis: {
									            title: {
									                text: 'valores'
												}
											},
											legend: {
												enabled: false
											},
											plotOptions: {
												series: {
													borderWidth: 0,
													dataLabels: {
														enabled: true,
														format: '{point.y:,.0f}'
													}
												}
											},
											tooltip: {
												headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
												pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:,.1f}</b> Minutos<br/>'
											},
											series: [{
												name: 'Ventas '+mes,
												colorByPoint: true,
												data: [ {
													name: "Todos los destinos <br> 100 % <br>",
													y:minuto ,
													drilldown: "Todos los destinos"
												},{
													name: "Colombia <br>" + t.toFixed(0) + ' % <br>',
													y:minutoCol,
													drilldown: "Colombia"
												},{
													name: "Venezuela <br>" + t1.toFixed(0) + ' % <br>',
													y:minutoVen,
													 drilldown: "Venezuela "
												},{
													name: "Internacionales <br>" + t2.toFixed(0) + ' % <br>',
													y:minutoTod,
													drilldown: "Internacionales"
												}]
											}]
										});
									}
								});
												    
							}
						});
					}
				});
			}
		});
	}


	function VentaPromedio() {
		// body...
		var param ={'Funcion':'VentaPromedio'};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data)
				//console.log(factura)
				var promedio = parseInt(factura / data);
				var metaMes = parseInt(meta[0]['meta'] / meta[0]['dias']);
				//console.log(metaMes,promedio);
			   $('#canvas3').highcharts({
			        chart: {
			            type: 'column'
			        },
			        title: {
			            text: 'Promedio Diario en $'
			        },
			        subtitle: {
			            text: ''
			        },
			        xAxis: {
			            type: 'category'
			        },
			        yAxis: {
			            title: {
			                text: 'valores'
			            }
				    },
			        legend: {
			            enabled: false
			        },
			        plotOptions: {
			            series: {
			                borderWidth: 0,
					        dataLabels: {
			                	enabled: true,
			                	format: '{point.y:,.0f}'
			                }
			            }
			        },
				    tooltip: {
						headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> ${point.y:,.1f}</b><br/>'
					},
					series: [{
						name: 'Ventas ',
						colorByPoint: true,
						data: [{
						    name: "Meta",
						    y:metaMes,
						    drilldown: "Meta"
						},{
						    name: "Dia",
						    y:promedio,
						   drilldown: "Dias"
						}]
					}]
				});//console.log(data+"diasssssss")
				
				if(promedio >= meta ){
					$('#Ventas').css('color','#C91023');
				}
			}
		});
	}
			


		function qw(argument){
			// body...
			//console.log(324)
		}




		

		function NumeroaPesos(numero) {
			// body...ç
			var num = numero;
        	num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
          	num = num.split('').reverse().join('').replace(/^[\.]/,'');
          	return num;
		}

		function MantenimientosProgramados() {
			var param ={'Funcion':'cabinasT', 'estado':' '};
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data + ' ================')
					print = data;
					$('#p-programados').html(data);
				}
			});
		}
		
		function MantenimientosPendientes(){
			// body...
			var param ={'Funcion':'cabinasT','estado':2};
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data + ' _____________________')
					print = data;
					$('#p-pendientes').html(data);
				}
			});
		}

		function MantenimientosAtrasados(){
			var param ={'Funcion':'cabinasT','estado':3};
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data + ' ===============0')
					print = data;
					if(data > 0){
						$('#Ventas').css('color','#C91023');
					}
					$('#p-atrasados').html(data);
				}
			});
		} 

		function CabinasTotal(){
			// body...
			var param ={'Funcion':'Cabinas','sql':''};
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					print = data;
					$('#total').html(data);
				}
			});
		}
		function CabinasActivas(){
			// body...
			//console.log('entro')
			var param ={'Funcion':'Cabinas','sql':1};
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data);
					print = data;
					$('#activas').html(data);
				}
			});
		}


		function CabinasInactivas(){
			var param ={'Funcion':'Cabinas','sql':'cero'};
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					print = data;
					if(data > 0){
						$('#Ventas').css('color','#C91023');
					}
					$('#inactivas').html(data);
				}
			});
		}

		function DatosCabinasInactivas(){
			// body...
			//console.log('dta');
			var param ={'Funcion':'DCabinasInactivas'};
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data + ' datos')
					print = JSON.parse(data);
					var res = "";
					if(print.length > 0 ){
						for(var i = 0;i < print.length;i++){
					 		res = res + '<tr><th scope="row">'+i+'</th> <td>'+print[i]['cabina']+'</td><td>'+print[i]['direccion']+'</td></tr>';
					 	}

					}else{
						res = "<center><h5>No hay cabinas inactivas</h5></center>";
					}
					$('#cabinasinactivastable').html(res);
				}
			});
		}

		
		function MostrarNombreCabinas(){
			var nombrecampo= $('#cabinas').val();
			var param ={'Funcion':'MostrarNombreCabinas','nombrecampo':nombrecampo};
			
			if (nombrecampo.length > 0) {
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data);
						if(data)
				        {
				            var json = JSON.parse(data),
				            html = '<div class="list-group">';
				            //console.log(data);
					        if(data != 'false' )
					        {
					            for(i=0; i<json.length; i++ )
					            {
					            	html+='<a onclick="info(\''+json[i]['nombre_cap']+'\','+json[i]['id']+')" class="list-group-item">';		            			
					            	html+= json[i]['nombre_cap'];				            			
					            	html+='</a>';

					            }
					        }
					        else
					        {
					            html+='<a href="#" class="list-group-item">';
					        		html+='<h5 class="list-group-item-heading">No se ha encontrado nada con '+$("input[name=cabina]").val()+'</h5>';
					        		html+='</a>';
					        	}

					        html+='</div>';
					        $("#mostrar").html("").append(html);
						}
					}
				});
			}
			else{
				$("#mostrar").html("");
			}
		}
			
		function info(nombre_cap, id){
			$("#cabinas" ).val(nombre_cap);
			$("#id_cabina" ).val(id);
			$("#mostrar").html("");
		}

		function AtencionCliente() {
			ResponsableEficiente();
			AtencionClienteDetalles();
			AtencionClienteTiempo();
		}
		function ResponsableEficiente(){
			var fechaInicio = $('#fechaInicio').val();
			var fechaFin = $('#fechaFin').val();
			var param ={'Funcion':'ResponsableEficiente', 'fechaInicio':fechaInicio, 'fechaFin':fechaFin }
			if (fechaInicio.length > 0 && fechaFin.length > 0 ) {
				$.ajax({
		            data: JSON.stringify (param),
		            type:"JSON",
		            url: 'ajax.php',
		            success:function(data){
		            	//console.log(data)
			            var json = JSON.parse(data)	
		            	var d = json.sort()
		            	//console.log(d + ' IIIIIIIIIIIIIIIIIIIIIIIIIIiii')
			            var responsable = json[0]['responsable'];
			            $('#respon_Eficiente').html(responsable)
		            	
		            }
		         });
			}else {
				toastr.warning('No has seleccionado ningun rango de fechas!', 'Sin resultados!' , {timeOut: 5000})
			}
		}
		function deMenorAMayor(elem1, elem2) {return elem1-elem2;}
		

		function AtencionClienteDetalles() {
			setTimeout(function(){

			var fechaInicio = $('#fechaInicio').val();
			var fechaFin = $('#fechaFin').val();
			var limite = $('#limite').val();
			
			var param ={'Funcion':'AtencionClienteDetalles', 'fechaInicio':fechaInicio, 'fechaFin':fechaFin, 'limite':limite}
			$('#cuerpo').html('');
			if (fechaInicio.length > 0 && fechaFin.length > 0 ) {
				$.ajax({
		            data: JSON.stringify (param),
		            type:"JSON",
		            url: 'ajax.php',
		            success:function(data){
		            	//console.log(data + ' =============')
		            	var json = JSON.parse(data)		            	
		            	$('#cabinamasfrecuente').html(json[0]['cabinaFrecuente'])
					            	var table = $('#table');
					            	var tBody = $('#cuerpo');
					            	cabina = 0;
					            	telefono = 0;
					            	for(var i = 0; i<json.length; i++) {			            		
					            		// contruccion de los campos de la tabla	            		
					            		//totalPagina += 1;
					            		var tr = $('<tr></tr>');	
					            		var descripcion = $('<td></td>');	
					            		var responsable = $('<td></td>');	
					            		var cabinax = $('<td></td>');	
					            		var fecha = $('<td></td>');	
					            		var estado = $('<td></td>');

					            		descripcion.text(json[i]['descripcion']);	
					            		cabinax.text(json[i]['cabina']);	
					            		if(json[i]['descripcion'] == 'cabina'){
					            			cabina = 1 + parseInt(cabina);
					            		}else{
					            			telefono = 1 + parseInt(telefono);
					            		}
					            		responsable.text(json[i]['responsable']);	
					            		fecha.text(json[i]['fecha']);		            		
					            		estado.text(json[i]['estado'] == 1 ? 'ejecutado' : 'Pendiente' );

					            		// abrimos los datos en la tabla
					            		tr.append(cabinax); 	tr.append(descripcion);		tr.append(responsable);		tr.append(fecha);	tr.append(estado);	tBody.append(tr);
									}



									if(cabina > telefono){
										$('#AsuntoFrecuente').html('Cabinas');
									}else{
										$('#AsuntoFrecuente').html('Telefonos');
									}
									var li = 0;
									if (json[0]['numero'] == 1) {} else{li = parseInt(json[0]['numero'])}
									
									//console.log(li +  ' =============================================' + limite)
									
									if(li > limite ){
										$('#btnext').css('display','block');
										//console.log(2323)
									}else{
										$('#btnext').css('display','none');
									}

									$('#numpag').html('Pagina '+$('#pagina').val());
									if(limite == 5){
										$('#btprev').css('display','block');
									}else{
										$('#btprev').css('display','none');
									}
		            	
				    }
				});
			}
			},200);
		}

		function Next(){
			$('#pagina').val(parseInt($('#pagina').val()) + 1);
			$('#limite').val(parseInt($('#limite').val()) + 5);
			AtencionClienteDetalles();
		}
		function Prev(){
			$('#pagina').val(parseInt($('#pagina').val()) - 1);
			$('#limite').val(parseInt($('#limite').val()) - 5);
			AtencionClienteDetalles();
		}

 		function AtencionClienteTiempo() {
 			
			var fechaInicio = $('#fechaInicio').val();
			var fechaFin = $('#fechaFin').val();
			
			var param ={'Funcion':'AtensionCLienteEjecutadosTiempo', 'fechaInicio':fechaInicio, 'fechaFin':fechaFin }

			if (fechaInicio.length > 0 && fechaFin.length > 0 ) {
				$.ajax({
		            data: JSON.stringify (param),
		            type:"JSON",
		            url: 'ajax.php',
		            success:function(data){
		            	//console.log(data + ' oooooooooooo') 
		            	var json = JSON.parse(data)		            	
		            		//Inicializamos variables en cero, contadoras de tiempo
		            	var t_anno = 0;
		            	var t_mes = 0;
		            	var t_dia = 0;
		            	var t_hora = 0;
		            	var t_min = 0;
		            	var t_seg = 0;	       	
		            	 
		            	for(var i = 0; i<json.length; i++) {			            		
		            		
		            		var diferencia = (json[i]['diferencia'])
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
		            	var t_anno1 = ( parseInt(t_anno) / parseInt(json.length) )
		            	var t_mes1 = ( parseInt(t_mes) / parseInt(json.length) )
		            	var t_dia1 = ( parseInt(t_dia) / parseInt(json.length) )
		            	var t_hora1 = ( parseInt(t_hora) / parseInt(json.length) )
		            	var t_min1 = ( parseInt(t_min) / parseInt(json.length) )
		            	var t_seg1 = ( parseInt(t_seg) / parseInt(json.length) )

		            	//console.log(t_anno1 + ' ano')
		            	//console.log(t_mes1 + ' mes')
		            	//console.log(t_dia1 + ' dia')
		            	//console.log(t_hora1 + ' hora')
		            	//console.log(t_min1 + ' min')
		            	//console.log(t_seg1 + ' seg')

		            	//conversion de dia
		            	if (t_dia1 % 1 == 0) {
					        var diaf = t_dia1;
					        var conversionDia = 0;
					    }else{
					    	var diaf =Math.floor(t_dia1);  // agarramos la parte entera del dia				        
							var decimalsDia = t_dia1 - Math.floor(t_dia1); // le restamos la parte decimal al dia
							var conversionDia = decimalsDia * parseInt(24);			        
					    }
					    	//conversion de horas
					    t_hora1 = parseFloat(t_hora1) + parseFloat(conversionDia);
					    if (t_hora1 % 1 == 0) {
					        var horaf = t_hora1 + conversionDia; //console.log(horaf + ' horas f')
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
					    var resSeg = conversionMin + t_seg1; //console.log(resSeg)// valor de Segundos agregados	
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
					    if (t_dia1 > 0) {
					    	$('#tiempo').html(diaf + 'Dias' +  horaf + 'Horas ' + minf + 'Minutos ' + segf + 'Segundos');
					    }else{
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
		            }
		         });
			}else {
				toastr.warning('No has seleccionado ningun rango de fechas!', 'Sin resultados!' , {timeOut: 5000})
			}
		}
		
		function UpdatetMantenimientosCabinas() {

			var cod = $('#cod_i').val();
			
			var descripcion = $('#descripcion_i').val();
			var descripcion_mantenimiento = $('#descripcion_mantenimiento_i').val();
			var pintura=document.getElementById('pintura_i').checked;
			var herraje=document.getElementById('herraje_i').checked;	
			var sticker=document.getElementById('sticker_i').checked;
			var mant_general=document.getElementById('mant_general_i').checked;
			var prot_teclado=document.getElementById('prot_teclado_i').checked;
			var conectores=document.getElementById('conectores_i').checked;
			var cable_red=document.getElementById('cable_red_i').checked;
			var cable_bocina=document.getElementById('cable_bocina_i').checked;
			var material_mantenimiento=document.getElementById('material_mantenimiento_i').checked;
			var tipo_materiales = $('#tipo_materiales_i').val();			
			var responsable = $('#responsable_i').val();
			var tipo = $('#tipo_i').val();
			var estado = $('#estado_i').val();
			var fecha = $('#fecha_i').val();
			var fecha_ejecutado = $('#fecha_ejecutado_i').val();

			var cod_cabina = $('#cod_ca_i').val();
			console.log(cod_cabina + ' cod_cabina  !!!!!!!!!!')
			console.log(estado + ' estado  !!!!!!!!!!')
			
			var param ={'Funcion':'UpdatetMantenimientosCabinas', 'cod':cod, 'cod_cabina':cod_cabina, 'descripcion':descripcion, 'descripcion_mantenimiento':descripcion_mantenimiento, 'pintura':pintura, 'herraje':herraje, 'sticker':sticker, 'mant_general':mant_general, 'prot_teclado':prot_teclado, 'conectores':conectores, 'cable_red':cable_red, 'cable_bocina':cable_bocina, 'material_mantenimiento':material_mantenimiento, 'tipo_materiales':tipo_materiales, 'responsable':responsable, 'tipo':tipo, 'estado':estado, 'fecha':fecha, 'fecha_ejecutado':fecha_ejecutado, /*'descripcion_mantenimiento':descripcion_mantenimiento, 'pintura':pintura, 'herraje':herraje, 'sticker':sticker, 'mant_general':mant_general, 'prot_teclado':prot_teclado, 'conectores':conectores, 'cable_red':cable_red, 'cable_bocina':cable_bocina, 'material_mantenimiento':material_mantenimiento, 'tipo_materiales':tipo_materiales, 'tipo':tipo,*/  /*, 'fecha':fecha*/}

			if (responsable.length > 0 ) {	
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){	
						toastr["success"]("El Registro se ha actulizado!", {timeOut: 5000})
						$('#reset_insert').click()
						$('#modal-contact').modal('hide')
						$('#calendar').html('');
						sum = 1 + parseInt($('#calendar_valida').val());
						$('#calendar_valida').val(sum);
						$('#tip').html($('#tip').html('')+ '<div id="calendar'+sum+'"></div>');
						Calendar();
						//location.href=window.location.toString();
						//location.href="http://atencioncliente2.emsitel.com.co/soportel_plus/CalendarioCabinas";
						
					}
				});
			}else{
				toastr.error('Error al actualiar !', 'Hay algunos campos vacios', {timeOut: 5000})
			} 
			
			

		}
		function DeleteMantenimientosCabina() {

			var cod = $('#cod_i').val();
			var param ={'Funcion':'DeleteMantenimientosCabina', 'cod':cod}

			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data);
					toastr.success('El Evento ha si borrado.', {timeOut: 5000})
					$('#modal-contact').modal('hide')
					$('#calendar').html('');
						sum = 1 + parseInt($('#calendar_valida').val());
						$('#calendar_valida').val(sum);
						$('#tip').html($('#tip').html('')+ '<div id="calendar'+sum+'"></div>');
						Calendar();					
					//location.href=window.location.toString();
				}
			});
		}

		function InsertMant_Cabinas() {
			var id_cabina = $('#id_cabina').val();
			var descripcion = $('#descripcion').val();
			var descripcion_mantenimiento = $('#descripcion_mantenimiento').val();	
			var pintura=document.getElementById('pintura').checked;
			var herraje=document.getElementById('herraje').checked;
			var sticker=document.getElementById('sticker').checked;
			var mant_general=document.getElementById('mant_general').checked;
			var prot_teclado=document.getElementById('prot_teclado').checked;
			var conectores=document.getElementById('conectores').checked;
			var cable_red=document.getElementById('cable_red').checked;
			var cable_bocina=document.getElementById('cable_bocina').checked;
			var material_mantenimiento=document.getElementById('material_mantenimiento').checked;
			var responsable = $('#responsable').val();
			var tipo_materiales = $('#tipo_materiales').val();
			var tipo = $('#tipo').val();
			var estado = $('#estado').val();
			var fecha = $('#fecha').val();
			var nombre_cabina = $('#cabinas').val();

			var param ={'Funcion':'InsertMantenimientosCabinas', 'id_cabina':id_cabina, 'descripcion':descripcion, 'descripcion_mantenimiento':descripcion_mantenimiento, 'pintura':pintura, 'herraje':herraje, 'sticker':sticker, 'mant_general':mant_general, 'prot_teclado':prot_teclado, 'conectores':conectores, 'cable_red':cable_red, 'cable_bocina':cable_bocina, 'material_mantenimiento':material_mantenimiento, 'tipo_materiales':tipo_materiales, 'responsable':responsable, 'tipo':tipo, 'estado':estado, 'fecha':fecha}
			
			if (id_cabina.length > 0 && descripcion.length > 0 && tipo.length > 0 && fecha.length > 0 && responsable.length > 0  ) {
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data + ' !!!!!!!!!!!!!!!');
						toastr["success"]("El Registro se ha insertado!", {timeOut: 5000})
						$('#reset_insert').click()
						$('#myModal').modal('hide')


						$('#calendar').html('');
						sum = 1 + parseInt($('#calendar_valida').val());
						$('#calendar_valida').val(sum);
						$('#tip').html($('#tip').html('')+ '<div id="calendar'+sum+'"></div>');
						Calendar();
						//window.location.reload(false); 
						//location.href=window.location.toString();
						//location.href="http://atencioncliente2.emsitel.com.co/soportel_plus/CalendarioCabinas";
					}
				});
			}else {
				toastr.error('Error de registro !', 'Hay algunos campos vacios', {timeOut: 5000})
			}
		}