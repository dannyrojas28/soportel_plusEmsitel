function eventTelefonia() {
    $('.telefonia').css('background','#2B5A8A')   
    $('.telefonia').css('color','#fff')   
}

function selectDreamPBX() {
	setTimeout(function(){
	var param ={'Funcion':'selectDreamPBX'}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				json = JSON.parse(data)
				var activos = 0;
				var inactivos = 0;
				var N_ActivosDream = [];
				var N_inactDream = [];
				for(var i = 0; i<json.length; i++) {
					var ip = json[i]['ip_dato'];
					n=json[i].nombre;
					var paramx ={'Funcion':'pingPHP', 'ip':ip, 'n':n}
					$.ajax({
						data: JSON.stringify (paramx),
						type:"JSON",
						url: 'ajax.php',
						success:function(datax){
							//console.log(datax + ' =====xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx0')
							jsonx = JSON.parse(datax)
							var val = jsonx[0].val;
							var ipT = jsonx[0].ip;
							var n1 = jsonx[0].nom;
							//console.log(datax)
							if (val == 1 ) {
								activos = parseInt(activos) + parseInt(1);
								N_ActivosDream.push(  n1 + ' <br> ' ) 
							}
							if (val == 2) {
								inactivos = parseInt(inactivos) + parseInt(1);
								N_inactDream.push(  n1 + ' <br> ' ) 
							}
							
						}
					});
				}
				
				setTimeout(function(){
					var total = json.length;
					var res = parseInt(total) - parseInt(activos);
					var porcentaje = ( parseInt(activos) * 100) / parseInt(total);
					var porcentaje1 = parseFloat(100) - parseFloat(porcentaje);

					if(res > 0 ){
						$('.telefonia').css('color','#C91023');
					}
					$('#porcentajeDream').html('<b>' + porcentaje.toFixed(1) + ' %' + '</b>')
					$('#ip_dreamPBX').highcharts({
						chart: {
						   type: 'bar'
						},
						title: {
						   text: ''
						},
						xAxis: {
			            categories: [
			               porcentaje.toFixed(1) + ' %'
			            ]
			        	},
						yAxis: [{
						   title: {
						   	text: '<b>  Pbx Activass: ' + activos + ' de ' + total + '</b>'
							},
						   opposite: true
						}],
						plotOptions: {
						   series: {
						      stacking: 'normal'
						   }
						},
						series: [ {
						   name: porcentaje1.toFixed(2) + '% <br> ' + N_inactDream,
						   color: 'rgb(189, 193, 189)',
						   data: [res] ,
						            //y: 5,
						   pointPadding: 0.1,
						   pointPlacement: 0.2,
						   //yAxis: 1
						}, {
						   name: N_ActivosDream,
						   color: 'rgb(41, 132, 51)',
						   data: [activos] ,
						     //y: 1,
						   pointPadding: 0.1,
						   pointPlacement: 0.2,
						            //yAxis: 1
						}]							       
					});
					eem = $('#estadoemsi').val();
					if(eem == 'telefonia'){
						$('.highcharts-legend').css('display','none')
					}
				},9000);

				
				
			}
		});
	},100);
}

function selectFreePBX() {
	setTimeout(function(){
	var param ={'Funcion':'selectFreePBX'}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				json = JSON.parse(data)
				var activos = 0;
				var inactivos = 0;
				var N_ActivosFree = [];
				var N_inactFree = [];
				
				for(var i = 0; i<json.length; i++) {
					var ip = json[i]['ip_dato'];
					n=json[i].nombre;
					var paramx ={'Funcion':'pingPHP', 'ip':ip, 'n':n}
					$.ajax({
						data: JSON.stringify (paramx),
						type:"JSON",
						url: 'ajax.php',
						success:function(datax){
							//console.log(datax + ' ??????----------------------------?????')
							jsonx = JSON.parse(datax)
							var val = jsonx[0].val;
							var ipT = jsonx[0].ip;
							var n1 = jsonx[0].nom;
							//console.log(datax)
							if (val == 1 ) {
								activos = parseInt(activos) + parseInt(1);
								N_ActivosFree.push(  n1 + ' <br> ' ) 
							}
							if (val == 2) {
								inactivos = parseInt(inactivos) + parseInt(1);
								N_inactFree.push(  n1 + ' <br> ' ) 
							}
							
						}
					});
				}
				setTimeout(function(){
					var total = json.length;
					var res = parseInt(total) - parseInt(activos);
					var porcentaje = ( parseInt(activos) * 100) / parseInt(total);
					var porcentaje1 = parseFloat(100) - parseFloat(porcentaje);

					if(res > 0 ){
						$('.telefonia').css('color','#C91023');
					}
					
					$('#ip_freePBX').highcharts({
						chart: {
						   type: 'bar'
						},
						title: {
						   text: ''
						},
						xAxis: {
			            categories: [
			               porcentaje.toFixed(1) + ' %'
			            ]
			        	},
						yAxis: [{
						   title: {
						   	text: '<b> Gateway Activas: ' + activos + ' de ' + total + '</b>'
							},
						   opposite: true
						}],
						plotOptions: {
						   series: {
						      stacking: 'normal'
						   }
						},
						series: [ {
						   name: porcentaje1.toFixed(2) + '% <br> ' + N_inactFree,
						   color: 'rgb(189, 193, 189)',
						   data: [res] ,
						   pointPadding: 0.1,
						   pointPlacement: 0.2,
						}, {
						   name: N_ActivosFree,
						   color: 'rgb(41, 132, 51)',
						   data: [activos] ,
						   pointPadding: 0.1,
						   pointPlacement: 0.2,
						}]							       
					});
					eem = $('#estadoemsi').val();
					if(eem == 'telefonia'){
						$('.highcharts-legend').css('display','none')
					}
				},9000);

				
				
			}
		});
	},10000);
}

function canales() {
	setTimeout(function(){
		var param ={'Funcion':'selectCanales'}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(dataca){
				
				var jsonCa = JSON.parse(dataca)
				htm = "";
				for ( i = 0; i< jsonCa.length; i++ ) {
					htm=htm + '<tr>' + 
		         '<td>' + jsonCa[i]['nombre'] + '</td>' + 
		         '<td>' + jsonCa[i]['activos'] + '</td>' + 
		         '<td>' + jsonCa[i]['inactivos'] + '</td>' + 
		         '</tr>'  ;
		      }
		      
		      $('#canalesTable').html(htm); 
				
				Highcharts.chart('canalesGra', {
		        	data: {
		            table: 'datatable'
		        	},
		        	chart: {
		            type: 'column'
		        	},
		        	title: {
		            text: ''
		        	},
		        	yAxis: {
		            allowDecimals: false,
		            title: {
		               text: 'Datos'
		            }
		        	},
		        	tooltip: {
		            formatter: function () {
		               return '<b>' + this.series.name + '</b><br/>' +
		                  this.point.y + ' ' + this.point.name.toLowerCase();
		            }
		        	}
		    	}); 
			}
		});
	},500);
}



/*function saldoRecargas() {
	var param ={'Funcion':'saldoRecargas'}
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data)
			var json = JSON.parse(data)
			var nombre = [];
			var fecha = [];
			var saldo = [];
			for (var i = 0 ; i < json.length; i++) {
				
				var sal = (json[i]['saldo'])
				var dif = sal.split( '.' );
				var a = (dif[0])
				var a1 = (dif[1])
				var saldoSum = a + a1;
				//console.log(saldoSum + ' ?????????????')

				nombre.push(  json[i]['proveedor'] + ' <br> Actualizado el ' + json[i]['fecha'])
				fecha.push( json[i]['fecha'] ) 
				saldo.push( parseInt(saldoSum) ) 
			}
			//console.log(nombre + ' ----------------')
			//console.log(saldo + ' ___________')

			Highcharts.chart('saldoRecargas', {
	      	chart: {
					type: 'bar'
				},
        		title: {
            	text: 'Proveedor por recarga'
        		},
        		subtitle: {
	            text: ''
   	      		},
	         	xAxis: {
           		categories: nombre
        		},
        		tooltip: {
					headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
					pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> $ {point.y:,.0f}</b><br/>'
				},
	         series: [{
	         	name: 'Recargas',
    	        data: saldo
      	  }]
   	   });
		}
	});	
}*/
function saldoRecargas() {
	var param ={'Funcion':'saldoRecargas'}
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data )
				var json = JSON.parse(data)	
					// tabla vista general
					htm = "<tr>";
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
		               '<td>' + json[i]['fecha'] + '</td>' +  '</tr>'  ;
		            }
		            html = "</tr>";
		            $('#cuerpoRecargasT').html(htm);  

				}
			});
		}




function todofacturacion() {
	var param ={'Funcion':'tofacturacion'}
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data )
			var json = JSON.parse(data)		  

			htm = "";
            var json = JSON.parse(data)
			
			if(json[0].estado >= 2){
				$('.telefonia').css('color','#C91023');
			}
            
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
            htm=htm + '<tr>' + '<td>' + json[i]['proveedor'] + '</td>' + 
               '<td>' + '$ ' + num + '</td>' + 
               '<td>' + json[i]['fecha'] + '</td>' + 
               '<td>' + '<a onclick="detalleFact('+json[i]['cod']+')">' + estado +'</a>' + 
               '</td>' + '</tr>'  ;
         }
         html = "</tr>";
         $('#cuerpofacturacion').html(htm);  
		}
	});
}
	function detalleFact(cod){
	  	var param ={'Funcion':'detalleFacturacion', 'cod':cod};
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
		//console.log(cod)
		//console.log(valor + ' valor')
		//console.log(fecha + ' fecha')
		//console.log(estado + ' stado')

		var param ={'Funcion':'updatefacturacion', 'cod':cod, 'proFacturacion':proFacturacion, 'valor':valor, 'fecha':fecha, 'estado':estado};
	    $.ajax({
	      data: JSON.stringify (param),
	      type:"JSON",
	      url: 'ajax.php',
	      success:function(data){
	        	//console.log(data + ' actualizado ')
	        	if ( data > 0 ) {
					toastr["success"]("Se ha actualizado Factura!", {timeOut: 10000})
					todofacturacion();
					$('#cerrarFacturacion').click()
				}else{
					toastr.error('No se puede actulizar Registro !', 'Error', {timeOut: 15000})
				}
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


function AtencionClienteDetallestelefonia() {
	atencionClienteTelefonia()
	AtencionTiempo()
}
	function atencionClienteTelefonia() {
		var fechaInicio = $('#fechaInicio').val();
		var fechaFin = $('#fechaFin').val();
		//console.log(fechaInicio + ' fecha1')
		//console.log(fechaFin + ' fecha2')

		var param ={'Funcion':'AtencionPersonal', 'fechaInicio':fechaInicio, 'fechaFin':fechaFin, 'estado':'2' }
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
	            		

	            	var param ={'Funcion':'atenEmpresarial', 'fecha1':fechaInicio, 'fecha2':fechaFin, 'estado':'2'};
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
		console.log(fechaInicio + ' fechaInicio')
		console.log(fechaFin + ' fechaFin')
				
		var param ={'Funcion':'AtencionClienteDetallestelefoniaPersonalesTiempo', 'fechaInicio':fechaInicio, 'fechaFin':fechaFin, 'estado':'2'  }
			$.ajax({
			   data: JSON.stringify (param),
			   type:"JSON",
			   url: 'ajax.php',
			   success:function(data){
			   	console.log(data) 
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
					var param ={'Funcion':'AtencionClienteDetallestelefoniaEmpresarialesTiempo', 'fechaInicio':fechaInicio, 'fechaFin':fechaFin, 'estado':'2'  }
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


