function eventEmsivoz() {
    $('.emsivoz').css('background','#2B5A8A')   
    $('.emsivoz').css('color','#fff')   
}

var printo = "";  
var meta = "";
color1='#159E75';
color2='#383434';
color3 = '#356F99';
color4 = '#BD1019';

function Balance(){
		
	
	DestinosmasLlamados();
	llamadasEmsivoz();
	BalancePesos()
	BalanceMinutos();
	detallesMercadeo()
	linealRegistros();
	fidelizacion();
	UsuariosActivosE();
	TodasRecargas();

}
function BalanceTotalMin(){
		var ejecutar = 1;	
		var param ={'Funcion':'BalanceTotalMin','ejecutar':ejecutar};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data)
				var dataActual = JSON.parse(data);
				var Colombia  = parseInt(dataActual[0].minutos);
				if (Colombia > 0) {}else{Colombia = 0; }

				var ejecutar = 2;	
				var param ={'Funcion':'BalanceTotalMin','ejecutar':ejecutar};
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data + ' Minutos Actuales')
						var dataActual = JSON.parse(data);
						var Venezuela  = parseInt(dataActual[0].minutos);
						if (Venezuela > 0) {}else{Venezuela = 0;}

						var ejecutar = 3;	
						var param ={'Funcion':'BalanceTotalMin','ejecutar':ejecutar};
						$.ajax({
							data: JSON.stringify (param),
							type:"JSON",
							url: 'ajax.php',
							success:function(data){
								//console.log(data + ' Minutos Actuales')
								var dataActual = JSON.parse(data);
								var EEUU  = parseInt(dataActual[0].minutos);
								if (EEUU > 0) {}else{EEUU = 0; }
								
								var totalMin = parseInt(Colombia + Venezuela + EEUU);
								if (totalMin > 0) {}else{totalMin = 0; }
								$('#totalMin').html('<b>Total Minutos: </b>' + totalMin)
		                    	
						       	$('#BalanceTotalMin').highcharts({
						            chart: {
						                plotBackgroundColor: null,
						                plotBorderWidth: null,
						                plotShadow: false,
						                type: 'pie'
						            },
						            title: {
						                text: 'Total Minutos '
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
						                name: 'Total Minutos',
						                colorByPoint: true,
						                data: [{
						                    name: '<button class=\"btn\" onclick=\"Balance(1)\">' + Colombia + ' Colombia </button>',
						                    y: Colombia,
						                    color: color1
						                }, {
						                    name: '<a href=\"#\" onclick=\"Balance(2)\">' + Venezuela + ' Venezuela </a>',
						                    y: Venezuela,
						                    color:color2
						                    //sliced: true,
						                    //selected: true
						                }, {
						                    name: '<a href=\"#\" onclick=\"Balance(3)\">' + EEUU + ' EEUU </a>',
						                    y: EEUU,
						                    color:color3
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
function DestinosmasLlamados() {
		var ejecutar = $('#pais').val();
		var param ={'Funcion':'DestinosmasLlamados','ejecutar':ejecutar};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data)
				json = JSON.parse(data);
				var pais0="",minutos0="",color0="transparent",pais1="",minutos1="",color1="transparent",pais2="",minutos2="",color2="transparent",pais3="",minutos3="",color3="transparent",pais4="",minutos4 ="",color4="transparent";
				if(json.length > 5){
					nu = 5;
				}else{
					nu = json.length;
				}
				for(jk = 0; jk < nu;jk++){
					if(jk == 0){
						pais0= json[jk]['pais'];
						minutos0= parseFloat(json[jk]['minutos']);
						color0='#159E75';
					}
					if(jk == 1){
						pais1= json[jk]['pais'];
						minutos1= parseFloat(json[jk]['minutos']);
						color1 = '#356F99';
					}
					if(jk == 2){
						pais2= json[jk]['pais'];
						minutos2= parseFloat(json[jk]['minutos']);
						color2="#6AB01E";
					}
					if(jk == 3){
						pais3= json[jk]['pais'];
						minutos3= parseFloat(json[jk]['minutos']);
						color3='#383434';
					}
					if(jk == 4){
						pais4= json[jk]['pais'];
						minutos4= parseFloat(json[jk]['minutos']);
						color4='#B0751E';
					}
				}
				var minutosTotal = parseInt(minutos0 + minutos1 + minutos2 + minutos3 + minutos4) 
				$('#MinutosTotal').html('<b> Total Minutos: </b>' + minutosTotal)

				Highcharts.chart('destinosllamados', {
		            chart: {
		                plotBackgroundColor: null,
		                plotBorderWidth: null,
		                plotShadow: false,
		                type: 'pie'
		            },
		            title: {
		                text: '5 Destinos mas llamados'
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
		                name: 'Pais',
		                colorByPoint: true,
		                data: [{
		                    name: minutos0 + ' ' + pais0,
		                    y: minutos0,
		                    color:color0
		                }, {
		                    name: minutos1 + ' ' + pais1,
		                    y: minutos1,
		                    color:color1
		                }, {
		                    name: minutos2 + ' ' + pais2,
		                    y:minutos2,
		                    color:color2
		                }, {
		                    name: minutos3 + ' ' + pais3,
		                    y: minutos3,
		                    color:color3
		                }, {
		                    name: minutos4 + ' ' + pais4,
		                    y: minutos4,
		                    color:color4
		                }]
		            }]
		        });

			}
		});
}
function llamadasEmsivoz() {
	var ejecutar = $('#pais').val();
	if (ejecutar > 0 ) {}else{ejecutar = 1; }
	var fecha = 1;
	console.log(ejecutar)
	var param ={'Funcion':'llamadasEmsivoz', 'ejecutar':ejecutar, 'fecha':fecha}
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			console.log(data + ' llamadas hoy!')
			var hoy = JSON.parse(data);
			var llamadashoy = 0;
			for(var i = 0; i<hoy.length; i++) {
				llamadashoy = hoy[i].total;
			}
				if(llamadashoy == 0 ){
					$('.emsivoz').css('color','#C91023');
				}
			
			var ejecutar = $('#pais').val();
			if (ejecutar > 0 ) {}else{ejecutar = 1; }
			var fecha = 2;
			var param ={'Funcion':'llamadasEmsivoz', 'ejecutar':ejecutar, 'fecha':fecha}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log(data + ' llamadas Ayer!')
					var ayer = JSON.parse(data);
					var llamadasAyer = 0;
					for(var i = 0; i<ayer.length; i++) {
						llamadasAyer = ayer[i].total;
					}

					var ejecutar = $('#pais').val();
					if (ejecutar > 0 ) {}else{ejecutar = 1; }
					var fecha = 3;
					var param ={'Funcion':'llamadasEmsivoz', 'ejecutar':ejecutar, 'fecha':fecha}
					$.ajax({
						data: JSON.stringify (param),
						type:"JSON",
						url: 'ajax.php',
						success:function(data){
							//console.log(data + ' llamadas Antier!')
							var antier = JSON.parse(data);
							var llamadasAntier = 0;
							for(var i = 0; i<antier.length; i++) {
								llamadasAntier = antier[i].total;
							}

							var ejecutar = $('#pais').val();
							if (ejecutar > 0 ) {}else{ejecutar = 1; }
							var fecha = 4;
							var param ={'Funcion':'llamadasEmsivoz', 'ejecutar':ejecutar, 'fecha':fecha}
							$.ajax({
								data: JSON.stringify (param),
								type:"JSON",
								url: 'ajax.php',
								success:function(data){
									console.log(data + ' Otras llamadas!')
									var otros = JSON.parse(data);
									var llamadasOtros = 0;
									for(var i = 0; i<otros.length; i++) {
											llamadasOtros =  otros[i].total;
									}

									$('#total_llamadas').highcharts({
							            chart: {
							                plotBackgroundColor: null,
							                plotBorderWidth: null,
							                plotShadow: false,
							                type: 'pie'
							            },
							            title: {
							                text: 'Llamadas '
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
							                name: 'Total llamadas',
							                colorByPoint: true,
							                data: [{
							                    name: llamadashoy + ' Hoy',
							                    y: llamadashoy,
							                    color: color1
							                }, {
							                    name: llamadasAyer + ' Ayer',
							                    y: llamadasAyer,
							                    color:color2
							                    //sliced: true,
							                    //selected: true
							                }, {
							                    name:  llamadasAntier + ' Antier',
							                    y: llamadasAntier,
							                    color:color4
							                }, {
							                    name: llamadasOtros + ' Inicio Mes',
							                    y: llamadasOtros,
							                    color:color3
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

function BalancePesos(){
		var ejecutar = $('#pais').val();		
		var fecha = 1;
		var param ={'Funcion':'BalancePesos','ejecutar':ejecutar, 'fecha':fecha};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data + ' pesos Actuales')
				var dataActual = JSON.parse(data);
				var fecha1 = dataActual[0].fecha1;
				var fecha2 = dataActual[0].fecha2;

				var uno  = parseInt(dataActual[0].pesos);
				if (uno > 0) {}else{uno = 0;}

				var fecha = 2;
				var param ={'Funcion':'Balancepesos','ejecutar':ejecutar, 'fecha':fecha};
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data + ' pesos Anteriores')
						var dataAnterior = JSON.parse(data);

						var fecha3 = dataAnterior[0].fecha3;
						var fecha4 = dataAnterior[0].fecha4;

						var dos  = parseInt(dataAnterior[0].pesos);
						if (dos > 0) {}else{dos = 0;}

						var moneda = "";

						if (ejecutar == 1) {
							moneda = '$';
						}
						if (ejecutar == 2) {
							moneda = 'Bs.';
						}
						if (ejecutar == 3) {
							moneda = 'USD';
						}
						
						if (parseInt(uno)  == parseInt(dos)) {
							$('#Bpesos').html( 'Iguales' + '<br>' +  '<img src="App/Archives/Images/igual.png" style="float: left;">' );
						}else{
							if ( parseInt(uno)  > parseInt(dos) ) {
								var dif = parseInt( uno - dos )
								difT = parseFloat( (dif / uno ) * 100)
								if (difT > 0) {}else{difT = 0; }
								
								$('#Bpesos').html( 'Incrementó' + '<br>' + '<p style=" ">' + difT.toFixed(2) + '%' + '<br>' + moneda + ' ' + dif   + '<p>'
								+  '<img src="App/Archives/Images/incremento.png" style="float: left;">' 
								)
							}else{
								var dif = parseInt( dos - uno )
								difT = parseFloat( (dif / dos ) * 100)
								if (difT > 0) {}else{difT = 0; }

								$('#Bpesos').html( 'Disminuyo' + '<br>' + '<p style=" ">' + '-' + difT.toFixed(2) + '%' + '<br>' + moneda + ' ' +  '-'+ dif  + '<p>'
								+  '<img src="App/Archives/Images/disminuyo.png" style="float: left;">' 
								);
							}
						}

						$('#BalancePesos').highcharts({
							        chart: {
							            type: 'column'
							        },
							        title: {
							            text: '<b>Comparativo/mes [' + moneda + ']</b>'
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
							            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>'+ moneda + ' {point.y:,.1f}</b><br/>'
							        },
							        series: [{
							            name: 'Pesos',
							            colorByPoint: true,
							            data: [{
							                name: 'Mes Anterior <br> Del: ' + fecha3 + ' al ' + fecha4  ,
							                y: dos,
							                drilldown: 'Mes Anterior'
							            }, {
							                name: 'Mes Actual <br> Del: ' + fecha1 + ' al ' + fecha2  ,
							                y: uno,
							                drilldown: 'Mes Actual'
							            }]
							        }],
						});								
					}
				});
			}
		});
}
function BalanceMinutos(){
		var ejecutar = $('#pais').val();		
		var fecha = 1;
		var param ={'Funcion':'BalanceMinutos','ejecutar':ejecutar, 'fecha':fecha};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data + ' Minutos Actuales')
				var dataActual = JSON.parse(data);

				var fecha1 = dataActual[0].fecha1;
				var fecha2 = dataActual[0].fecha2;


				var uno  = parseInt(dataActual[0].minutos);
				if (uno > 0) {}else{	uno = 0; }
				//console.log(dataActual[0].minutos + ' Minutos Actuales')
				// datos mes anterior
				var fecha = 2;
				var param ={'Funcion':'BalanceMinutos','ejecutar':ejecutar, 'fecha':fecha};
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data + ' Minutos Anteriores')
						var dataAnterior = JSON.parse(data);

						var fecha3 = dataAnterior[0].fecha3;
						var fecha4 = dataAnterior[0].fecha4;

						var dos  = parseInt(dataAnterior[0].minutos);
						if (dos > 0) {}else{dos = 0;}
						
							if (parseInt(uno)  == parseInt(dos)) {
								$('#BMinutos').html( 'Iguales' + '<br>' +  '<img src="App/Archives/Images/igual.png" style="float: left;">' );
							}else{
								if (parseInt(uno)  > parseInt(dos) ) {
									var dif = parseInt( uno) - parseInt( dos )
									difT = parseFloat( (dif / uno ) * 100)
									if (difT > 0 ) {}else{difT = 0;}
									if (dif > 0 ) {}else{dif = 0;}
									$('#BMinutos').html( 'Incrementó' + '<br>' + '<p style="">' + difT.toFixed(2) + '%' + '<br>' + dif  +  ' <i>Minutos</i>' +'<p>'
									+  '<img src="App/Archives/Images/incremento.png" style="">' 
									   );							
								}else{

									var dif = parseInt( dos ) - parseInt( uno )
									difT = parseFloat( (dif / dos ) * 100)
									

									if (difT > 0 ) {}else{difT = 0;}
									if (dif > 0 ) {}else{dif = 0;}
									$('#BMinutos').html( 'Disminuyó' + '<br>' + '<p style="">' + '-' + difT.toFixed(2) + '%' + '<br>' + '-' + dif  + '<p>'
										+  '<img src="App/Archives/Images/disminuyo.png" style="">' 
										);								
								}
							}
						
						$('#BalanceMinutos').highcharts({
							        chart: {
							            type: 'column'
							        },
							        title: {
							            text: '<b>Comparativo/mes [min]</b>'
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
							            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> {point.y:,1f}</b><br/>'
							        },
							        series: [{
							            name: 'Minutos',
							            colorByPoint: true,
							            data: [{
							                name: 'Mes Anterior <br> Del: ' + fecha3 + ' al ' + fecha4  ,
							                y: dos,
							                drilldown: 'Mes Anterior'
							            }, {
							                name: 'Mes Actual <br> Del: ' + fecha1 + ' al ' + fecha2  ,
							                y: uno,
							                drilldown: 'Mes Actual'
							            }, ]
							        }],

							        /*series: [{
							            name: 'minutos '+dataActual[0].minutos,
							            colorByPoint: true,
							            data: [{
							                name: ' Mes Actual',
							                y:dataActual,
							                drilldown: 'Mes Actual'
							            }, {
							                name: 'Mes Anterior',
							                y: dataAnterior,
							                drilldown: 'Mes Anterior'
							            }]
							        }]*/
						});								
					}
				});
			}
		});
}


function UsuariosActivosE() {
		var ejecutar = $('#pais').val();
		var valor = 1;	
		//console.log(ejecutar)	
		var param ={'Funcion':'UsuariosActivosE','ejecutar':ejecutar, 'valor':valor};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data ) 
				var usuariosActivos = JSON.parse(data);
				//console.log(usuariosActivos[0].sinSaldo + ' ==========================')
				var usuariosA = 0;
				for(var i = 0; i<usuariosActivos.length; i++) {
					usuariosA = usuariosA + parseInt(1);
				}

				
				var ejecutar = $('#pais').val();
				var valor = 2;	
				//console.log(ejecutar)		
				var param ={'Funcion':'UsuariosActivosE','ejecutar':ejecutar, 'valor':valor};
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						console.log(data)
						var tusuarios = JSON.parse(data);
						var usuriosTotal  = parseInt(tusuarios[0]['usuarios'] );

						var ejecutar = $('#pais').val();
						var valor = 3;	
						//console.log(ejecutar)		
						var param ={'Funcion':'UsuariosActivosE','ejecutar':ejecutar, 'valor':valor};
						$.ajax({
							data: JSON.stringify (param),
							type:"JSON",
							url: 'ajax.php',
							success:function(data){
								console.log(data + ' ???????????????')
								var saldo = JSON.parse(data)
								TuSinSaldo = saldo[0].sinSaldo


								var usuariosInactivos = parseInt(usuriosTotal) - parseInt(usuariosA);
								//var tot = parseInt(usuariosInactivos) - parseInt(usuariosA);

								//console.log(usuariosInactivos + '==========!!!usuarios Inactivos!!!=======')
								var totalUser = parseInt(usuariosA) + parseInt(usuariosInactivos);
								if (totalUser > 0) {}else{totalUser = 0; }

								$('#totalUser').html('<b>Total Usuarios: </b>' + usuriosTotal + ' <br><b>Usuarios sin saldo: </b> ' + TuSinSaldo)
								$('#usuariosTotal').highcharts({
							            chart: {
							                plotBackgroundColor: null,
							                plotBorderWidth: null,
							                plotShadow: false,
							                type: 'pie'
							            },
							            title: {
							                text: '<h1><b>Total Usuarios</b></h1>'
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
							                name: 'Usuarios',
							                colorByPoint: true,
							                data: [ {
							                    name: usuariosA +  ' Activos',
							                    y: usuariosA
							                    //sliced: true,
							                    //selected: true
							                }, {
							                    name: usuariosInactivos + ' Inactivos',
							                    y: usuariosInactivos
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
function fidelizacion() {
		var ejecutar = $('#pais').val();	
		//console.log(ejecutar)		
		var param ={'Funcion':'fidelizacion','ejecutar':ejecutar};
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data);
				var json = JSON.parse(data)	
				var val = json[0].monto;
				if (val > 0) {}else{val = parseInt(0);}
				var moneda = "";
				var ejecutar = $('#pais').val();
				if(ejecutar == 1 ){
					moneda = '$ ';
				}else{
					if (ejecutar == 2) {
						moneda = 'Bs. ';
					}else{
						moneda = 'USD '
					}
				}

				$('#InversionMes').html(moneda + ' ' + val)
				$('#ClientesFidelizados').html(json[0].usuarios)
			}
		});
}


function TodasRecargas() {
	var ejecutar = $('#pais').val();
	if (ejecutar == 1) {
		$('#ensivozPais').html('<b>EMSIVOZ COLOMBIA</b>');
		recargasMesC();
		recargasSemC(); 
		recargasDiaC(); 
	}else{
		if (ejecutar == 2 ) {
			$('#ensivozPais').html('<b>EMSIVOZ VENEZUELA</b>');
			recargasMesV(); 
			recargasSemV(); 
			recargasDiaV(); 
		}else{
			if (ejecutar == 3) {
				$('#ensivozPais').html('<b>EMSIVOZ EEUU</b>');
				recargasMesU();
				recargasSemU();		
				recargasDiaU(); 
			}
		}
	}
}

function recargasDiaC() {
	var ejecutar = $('#pais').val();
	var fecha= 1; // MES ACTUAL
		var lugar = 1;// JJPITA
		var param ={'Funcion':'recargasDiaC','ejecutar':ejecutar, 'fecha':fecha, 'lugar':lugar };
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data)
				var mesActual = JSON.parse(data);
				var unoL1  = parseInt(mesActual[0]['montoD'] ); // monto fisicas
				if (unoL1 > 0) {}else{unoL1 = 0; }
				
				
				var ejecutar = $('#pais').val();
				var fecha= 2; // MES ANTERIOR
				var lugar = 1; // JJPITA
				var param ={'Funcion':'recargasDiaC','ejecutar':ejecutar, 'fecha':fecha, 'lugar':lugar };
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data)
						var mesPasado = JSON.parse(data);
						var dosL2  = parseInt(mesPasado[0]['montoD'] );
						if (dosL2 > 0) {}else{dosL2 = 0;}
						var fecha1 = mesPasado[0]['fecha1']
						var fecha2 = mesPasado[0]['fecha2']
								
						uno = parseInt(unoL1)
						dos = parseInt(dosL2)

						$('#recargaAyerHoy').highcharts({
					        chart: {
					            type: 'column'
					        },
					        title: {
					            text: 'Dia Anterior - Dia Actual'
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
					            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> $ {point.y:,.0f}</b><br/>'
					        },
					        series: [{
					            name: 'Recargas',
					            colorByPoint: true,
					            data: [{
					                name: 'Dia Anterior: <br>' + fecha1,
					                y: dos,
					                drilldown: 'Dia Anterior'
					            }, {
					                name: 'Dia Actual: <br>' + fecha2,
					                y: uno,
					                drilldown: 'Dia Actual'
						        }]
						    }],
						});		
					}
				});
			}
		});	
}
function recargasDiaV() {
		var ejecutar = $('#pais').val();
		var fecha= 1; // MES ACTUAL
		var param ={'Funcion':'recargasDiaV','ejecutar':ejecutar, 'fecha':fecha };
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data )
				var mesActual = JSON.parse(data);
				var unoL1  = parseInt(mesActual[0]['montoD'] );
				if (unoL1 > 0) {}else{unoL1 = 0;}

				var ejecutar = $('#pais').val();
				var fecha= 2; //mes PASADO
				var param ={'Funcion':'recargasDiaV','ejecutar':ejecutar, 'fecha':fecha };
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data )
						var mesPasado = JSON.parse(data);
						var dosL1  = parseInt(mesPasado[0]['montoD'] );
						if (dosL1 > 0) {}else{dosL1 = 0;}

						var fecha1 = mesPasado[0]['fecha1']; // ayer
						var fecha2 = mesPasado[0]['fecha2']; // hoy

						var uno = parseInt(unoL1)
						var dos = parseInt(dosL1)


						$('#recargaAyerHoy').highcharts({
							chart: {
							    type: 'column'
							},
							title: {
							    text: 'Dia Anterior - Dia Actual'
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
					            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> Bs. {point.y:,.0f}</b><br/>'
						    },
						    series: [{
						        name: 'Recargas',
						        colorByPoint: true,
						        data: [{
						            name: 'Dia Anterior',
						            name: 'Dia Anterior: <br>' + fecha1,
						            y: dos,
						            drilldown: 'Dia Anterior'
						        }, {
						            name: 'Dia Actual: <br> ' + fecha2,
						            y: uno,
						            drilldown: 'Dia Actual'
						        }]
							}],

						});								

					}
				});

			}
		});
}
function recargasDiaU() {
		var ejecutar = $('#pais').val();
		var fecha= 1; // MES ACTUAL
		var param ={'Funcion':'recargasDiaU','ejecutar':ejecutar, 'fecha':fecha };
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data )
				var mesActual = JSON.parse(data);
				var unoL1  = parseInt(mesActual[0]['montoD'] );
				if (unoL1 > 0) {}else{unoL1 = 0;}

				var ejecutar = $('#pais').val();
				var fecha= 2; //mes PASADO
				var param ={'Funcion':'recargasDiaU','ejecutar':ejecutar, 'fecha':fecha };
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data)
						var mesPasado = JSON.parse(data);
						var dosL1  = parseInt(mesPasado[0]['montoD'] );
						if (dosL1 > 0) {}else{dosL1 = 0;}
						var uno = parseInt(unoL1)
						var dos = parseInt(dosL1)
						var fecha1 = mesPasado[0]['fecha1']; // ayer
						var fecha2 = mesPasado[0]['fecha2']; // hoy
						

						$('#recargaAyerHoy').highcharts({
							chart: {
							    type: 'column'
							},
							title: {
							    text: 'Dia Anterior - Dia Actual'
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
					            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> USD {point.y:,.0f}</b><br/>'
						    },
						    series: [{
						        name: 'Recargas',
						        colorByPoint: true,
						        data: [{
						            name: 'Dia Anterior: <br> ' + fecha1,
						            y: dos,
						            drilldown: 'Dia Anterior'
						        }, {
						            name: 'Dia Actual: <br> ' + fecha2,
						            y: uno,
						            drilldown: 'Dia Actual'
						        }]
							}],

						});		
					}
				});

			}
		});
}

function recargasSemC() {
		var ejecutar = $('#pais').val();
		var fecha= 1; // MES ACTUAL
		var lugar = 1; // CRM
		var param ={'Funcion':'recargasSemC','ejecutar':ejecutar, 'fecha':fecha, 'lugar':lugar };
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data)
				var mesActual = JSON.parse(data);
				var unoL1  = parseInt(mesActual[0]['montoS'] );
				if (unoL1 > 0) {
					//console.log( unoL1  )		
				}else{
					unoL1 = 0;							
				}


				var ejecutar = $('#pais').val();
				var fecha= 2; //mes PASADO
				var lugar = 1; //CRM
				var param ={'Funcion':'recargasSemC','ejecutar':ejecutar, 'fecha':fecha, 'lugar':lugar };
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data)
						var mesPasado = JSON.parse(data);
						var dosL1  = parseInt(mesPasado[0]['montoS'] )
						if (dosL1 > 0) {
							//console.log(dosL1 )
						}else{
							dosL1 = 0;							
						}

						var fecha1 = mesPasado[0]['fecha1']
						var fecha2 = mesPasado[0]['fecha2']
						var fecha3 = mesPasado[0]['fecha3']
						var fecha4 = mesPasado[0]['fecha4']
						
						uno = parseInt(unoL1);
						dos = parseInt(dosL1);
						if (uno == 0) {
							$('.emsivoz').css('color','#C91023');
						}


						$('#recargaSem').highcharts({
								chart: {
								        type: 'column'
								},
								title: {
									text: 'Semana Anterior - Semana Actual'
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
									pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> $ {point.y:,.0f}</b><br/>'
								},
								series: [{
									name: 'Recargas',
									colorByPoint: true,
										data: [{
											name: 'Semana Anterior <br>De: ' + fecha3 + ' al ' + fecha4,
											y: dos,
											drilldown: 'Semana Anterior'
										}, {
											name: 'Semana Actual <br>De: ' + fecha1 + ' al ' + fecha2,
											y: uno,
											drilldown: 'Semana Actual'
										}]
									}],

							});	
						}
				});
			}
		});
}

function recargasSemV() {
		var ejecutar = $('#pais').val();
		var fecha= 1; // MES ACTUAL
		var param ={'Funcion':'recargasSemV','ejecutar':ejecutar, 'fecha':fecha };
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//
				console.log(data)
				var mesActual = JSON.parse(data);
				var unoL1  = parseInt(mesActual[0]['montoS'] );
				if (unoL1 > 0) {}else{unoL1 = 0;}

				var ejecutar = $('#pais').val();
				var fecha= 2; //mes PASADO
				var param ={'Funcion':'recargasSemV','ejecutar':ejecutar, 'fecha':fecha };
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//

						console.log(data )
						var mesPasado = JSON.parse(data);
						var dosL1  = parseInt(mesPasado[0]['montoS'] );
						if (dosL1 > 0) {}else{dosL1 = 0;}

						var fecha1 = mesPasado[0]['fecha1']
						var fecha2 = mesPasado[0]['fecha2']
						var fecha3 = mesPasado[0]['fecha3']
						var fecha4 = mesPasado[0]['fecha4']

						var uno = parseInt(unoL1)
						var dos = parseInt(dosL1)

						$('#recargaSem').highcharts({
							chart: {
							    type: 'column'
							},
							title: {
							    text: 'Semana Anterior - Semana Actual'
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
					            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> Bs.{point.y:,.0f}</b><br/>'
					        },
					        series: [{
					            name: 'Recargas',
					            colorByPoint: true,
					            data: [{
					                name: 'Semana Anterior <br>De: ' + fecha3 + ' al ' + fecha4,
					                y: dos,
					                drilldown: 'Semana Anterior'
					            }, {
					                name: 'Semana Actual <br>De: ' + fecha1 + ' al ' + fecha2,
					                y: uno,
					                drilldown: 'Semana Actual'
					            }]
					        }],

						});						
						

					}
				});

			}
		});
}
function recargasSemU() {
		var ejecutar = $('#pais').val();
		var fecha= 1; // MES ACTUAL
		var param ={'Funcion':'recargasSemU','ejecutar':ejecutar, 'fecha':fecha };
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data )
				var mesActual = JSON.parse(data);
				var unoL1  = parseInt(mesActual[0]['montoS'] );
				if (unoL1 > 0) {}else{unoL1 = 0;}

				var ejecutar = $('#pais').val();
				var fecha= 2; //mes PASADO
				var param ={'Funcion':'recargasSemU','ejecutar':ejecutar, 'fecha':fecha };
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data)
						var mesPasado = JSON.parse(data);
						var dosL1  = parseInt(mesPasado[0]['montoS'] );
						if (dosL1 > 0) {}else{dosL1 = 0;}

						var fecha1 = mesPasado[0]['fecha1']
						var fecha2 = mesPasado[0]['fecha2']
						var fecha3 = mesPasado[0]['fecha3']
						var fecha4 = mesPasado[0]['fecha4']
						
						var uno = parseInt(unoL1)
						var dos = parseInt(dosL1)

						
						$('#recargaSem').highcharts({
							chart: {
							    type: 'column'
							},
							title: {
							    text: 'Semana Anterior - Semana Actual'
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
					            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> USD. {point.y:,.0f}</b><br/>'
					        },
					        series: [{
					            name: 'Recargas',
					            colorByPoint: true,
					            data: [{
					                name: 'Semana Anterior <br>De: ' + fecha3 + ' al ' + fecha4,
					                y: dos,
					                drilldown: 'Semana Anterior'
					            }, {
					                name: 'Semana Actual <br>De: ' + fecha1 + ' al ' + fecha2,
					                y: uno,
					                drilldown: 'Semana Actual'
					            }]
					        }],
						});			

					}
				});
			}
		});
}

function recargasMesC() {
		var ejecutar = $('#pais').val();
		var fecha= 1; // MES ACTUAL
		var lugar = 1; // CRM
		var param ={'Funcion':'recargasMesC','ejecutar':ejecutar, 'fecha':fecha, 'lugar':lugar };
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				console.log(data + ' crm actual')
				var mesActual = JSON.parse(data);
				var unoL1  = parseInt(mesActual[0]['montoM'] );
				if (unoL1 > 0) {}else{unoL1 = 0;}
				console.log(unoL1 + ' unoL1')
				var ejecutar = $('#pais').val();
				var fecha= 2; //mes PASADO
				var lugar = 1; //CRM
				var param ={'Funcion':'recargasMesC','ejecutar':ejecutar, 'fecha':fecha, 'lugar':lugar };
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						console.log(data + ' crm anterior')
						var mesPasado = JSON.parse(data);
						var dosL1  = parseInt(mesPasado[0]['montoM'] )
						if (dosL1 > 0) {}else{dosL1 = 0;}
						console.log(dosL1 + ' dosL1')
							//Distribuidor
						
							var dosL3  = parseInt(mesPasado[0]['montoM'] );
							var fecha1 = mesPasado[0]['fecha1']
							var fecha2 = mesPasado[0]['fecha2']
							var fecha3 = mesPasado[0]['fecha3']
							var fecha4 = mesPasado[0]['fecha4']
								uno = parseInt(unoL1)
							dos = parseInt(dosL1)
							mesAc = parseInt(uno)
							mesAn = parseInt(dos)
							console.log(uno + ' total mes')
							console.log(dos + ' total mes anterior')
							// RECARGAS VIRTUALES
							var ejecutar = $('#pais').val();														
							var lugar = 5; // JJPITA
							var param ={'Funcion':'recargasMesC','ejecutar':ejecutar, 'lugar':lugar };
							$.ajax({
								data: JSON.stringify (param),
								type:"JSON",
								url: 'ajax.php',
								success:function(data){
									var reFisicos = JSON.parse(data);
									var toReFisicas  = parseInt(reFisicos[0]['cantidad'] ) // numero recargas virtuales																
									if (toReFisicas > 0 ) {}else{toReFisicas = 0;}// fin numero recargas virtuales
									var motoReFisicas  = parseInt(reFisicos[0]['montoM'] ); // monto recargas virtuales
									console.log('motoReFisicas'+ motoReFisicas)
									if (motoReFisicas > 0 ) {}else{motoReFisicas = 0;}

									var ejecutar = $('#pais').val();														
									var lugar = 4; // JJPITA
									var param ={'Funcion':'recargasMesC','ejecutar':ejecutar, 'lugar':lugar };
									$.ajax({
										data: JSON.stringify (param),
										type:"JSON",
										url: 'ajax.php',
										success:function(data){
											var reVirt = JSON.parse(data);
											var toReVirtuales  = parseInt(reVirt[0]['cantidad'] ) // numero recargas virtuales																
											if (toReVirtuales > 0 ) {}else{toReVirtuales = 0;}// fin numero recargas virtuales
											var motoReVirtuales  = parseInt(reVirt[0]['montoM'] ); // monto recargas virtuales
											if (motoReVirtuales > 0 ) {}else{motoReVirtuales = 0;}// fin monto recargas virtuales
											// TOTAL RECARGAS FISICAS NUMERO-- CANTIDAD
											var TotalReFisicas = toReFisicas;
											// total monto de recargas fisicas
											
											$('#recargaMes').highcharts({
											    chart: {
										            type: 'column'
										        },
										        title: {
										            text: 'Mes Anterior - Mes Actual'
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
											            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> $ {point.y:,.0f}</b><br/>'
											        },
											        series: [{
											            name: 'Recargas',
											            colorByPoint: true,
											            data: [{
											                name: 'Mes Anterior <br>De: ' + fecha3 + ' al ' + fecha4,
											                y: mesAn,
											                drilldown: 'Mes Anterior'
											            }, {
											                name: 'Mes Actual <br>De: ' + fecha1 + ' al ' + fecha2,
											                y: mesAc,
											                drilldown: 'Mes Actual'
											            } ]
											        }],
											});	

											$('#MontoRecargas').highcharts({
												chart: {
													type: 'column'
												},
												title: {
													text: 'Monto Recargas '
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
												    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> $ {point.y:,.0f}</b><br/>'
												},
												series: [{
												    name: 'Monto',
												    colorByPoint: true,
												    data: [{
												        name: 'Recargas Virtuales',
												        y: motoReVirtuales,
												        drilldown: 'Mes Anterior'
												    }, {
												        name: 'Recargas Fisicas',
												        y: motoReFisicas,
												        drilldown: 'Mes Actual'
												    } ]
												}],
											});
											
											$('#TopRecargas').highcharts({
											    chart: {
											     	type: 'column'
											    },
											    title: {
											        text: 'Número Recargas '
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
																			        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> {point.y:,.0f}</b><br/>'
																			    },
																			    series: [{
																			        name: 'Total',
																			        colorByPoint: true,
																			        data: [{
																			            name: 'Recargas Virtuales',
																			            y: toReVirtuales,
																			            drilldown: 'Mes Anterior'
																			        }, {
																			            name: 'Recargas Fisicas',
																			            y: TotalReFisicas,
																			            drilldown: 'Mes Actual'
																			        } ]
																			     }],
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
function recargasMesV() {
		var ejecutar = $('#pais').val();
		var fecha= 1; // MES ACTUAL
		var param ={'Funcion':'recargasMesV','ejecutar':ejecutar, 'fecha':fecha };
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data )
				var mesActual = JSON.parse(data);
				var unoL1  = parseInt(mesActual[0]['montoM'] );
				var totalVir = mesActual[0]['cantidad'];	
				if (totalVir > 0) {}else{totalVir=0;}
				if (unoL1 > 0) {}else{ unoL1 = 0; }

				var ejecutar = $('#pais').val();
				var fecha= 2; //mes PASADO
				var param ={'Funcion':'recargasMesV','ejecutar':ejecutar, 'fecha':fecha };
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data )
						//console.log(data )
						var mesPasado = JSON.parse(data);
						var dosL1  = parseInt(mesPasado[0]['montoM'] );
						if (dosL1 > 0) {}else{ dosL1 = 0; }

						var fecha1 = mesPasado[0]['fecha1']
						var fecha2 = mesPasado[0]['fecha2']
						var fecha3 = mesPasado[0]['fecha3']
						var fecha4 = mesPasado[0]['fecha4']

						var uno = parseInt(unoL1)						
						var dos = parseInt(dosL1)						

						var MontoReFisicas = parseInt(0);	 
						var MontoReVirtuales = parseInt(uno);
						
						var TotalReFisicas = parseInt(0);	 
						var ToReVirtuales = parseInt(totalVir);
						
						var moneda = 'Bs.';
						$('#MontoRecargas').highcharts({

								chart: {
									type: 'column'
								},
								title: {
									text: 'Monto Recargas '
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
									pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>'+ moneda +' .{point.y:,.0f}</b><br/>'
								},
								series: [{
									name: 'Monto',
									colorByPoint: true,
									data: [{
										name: ' Virtuales',
											y: MontoReVirtuales,
											drilldown: 'Mes Anterior'
									}, {
										name: 'Fisicas',
										y: MontoReFisicas,
										drilldown: 'Mes Actual'
									} ]
								}],
							});

						$('#TopRecargas').highcharts({

								chart: {
									type: 'column'
								},
								title: {
									text: 'Número Recargas '
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
									pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> {point.y:,.0f}</b><br/>'
								},
								series: [{
									name: 'Número',
									colorByPoint: true,
									data: [{
										name: 'Recargas Virtuales',
											y: ToReVirtuales,
											drilldown: 'Mes Anterior'
									}, {
										name: 'Recargas Fisicas',
										y: TotalReFisicas,
										drilldown: 'Mes Actual'
									} ]
								}],
						});

						$('#recargaMes').highcharts({
							chart: {
								type: 'column'
							},
							title: {
								text: 'Mes Anterior - Mes Actual'
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
					            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> '+ moneda +' {point.y:,.0f}</b><br/>'
					        },
					        series: [{
					            name: 'Recargas',
					            colorByPoint: true,
					            data: [{
					                name: 'Mes Anterior <br>De: ' + fecha3 + ' al ' + fecha4,
					                y: dos,
					                drilldown: 'Mes Anterior'
					            }, {
					                name: 'Mes Actual <br>De: ' + fecha1 + ' al ' + fecha2,
					                y: uno,
					                drilldown: 'Mes Actual'
					            } ]
					        }],
						});	
						

					}
				});

			}
		});
}
function recargasMesU() {
		var ejecutar = $('#pais').val();
		var fecha= 1; // MES ACTUAL
		var param ={'Funcion':'recargasMesU','ejecutar':ejecutar, 'fecha':fecha };
		$.ajax({
			data: JSON.stringify (param),
			type:"JSON",
			url: 'ajax.php',
			success:function(data){
				//console.log(data)
				
				var mesActual = JSON.parse(data);
				var unoL1  = parseInt(mesActual[0]['montoM'] );
				var totalVir = mesActual[0]['cantidad'];	
				if (totalVir > 0) {}else{totalVir=0;}
				if (unoL1 > 0) {}else{ unoL1 = 0; }

				var ejecutar = $('#pais').val();
				var fecha= 2; //mes PASADO
				var param ={'Funcion':'recargasMesU','ejecutar':ejecutar, 'fecha':fecha };
				$.ajax({
					data: JSON.stringify (param),
					type:"JSON",
					url: 'ajax.php',
					success:function(data){
						//console.log(data )
						var mesPasado = JSON.parse(data);
						var dosL1  = parseInt(mesPasado[0]['montoM'] );
						if (dosL1 > 0) {}else{ dosL1 = 0; }

						var fecha1 = mesPasado[0]['fecha1']
						var fecha2 = mesPasado[0]['fecha2']
						var fecha3 = mesPasado[0]['fecha3']
						var fecha4 = mesPasado[0]['fecha4']
						console.log(fecha1 + ' fecha1') 
						console.log(fecha2 + ' fecha2') 
						console.log(fecha3 + ' fecha3') 
						console.log(fecha4 + ' fecha4') 

						var uno = parseInt(unoL1)
						var dos = parseInt(dosL1)
						//dos = parseInt(dos) - parseInt(uno);
						var MontoReFisicas = parseInt(0);	 
						var MontoReVirtuales = parseInt(uno);
						//console.log(MontoReFisicas )
						//console.log(MontoReVirtuales)

						var TotalReFisicas = parseInt(0);	 
						var ToReVirtuales = parseInt(totalVir);
						//console.log(TotalReFisicas )
						//console.log(ToReVirtuales )
						var moneda = 'USD ';
						$('#MontoRecargas').highcharts({

								chart: {
									type: 'column'
								},
								title: {
									text: 'Monto Recargas'
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
									pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> '+ moneda + '{point.y:,.0f}</b><br/>'
								},
								series: [{
									name: 'Monto',
									colorByPoint: true,
									data: [{
										name: 'Virtuales',
											y: ToReVirtuales,
											drilldown: 'Virtuales'
									}, {
										name: 'Fisicas',
										y: TotalReFisicas,
										drilldown: 'Fisicas'
									} ]
								}],
						});

						$('#TopRecargas').highcharts({

								chart: {
									type: 'column'
								},
								title: {
									text: 'Número Recargas'
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
									pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> {point.y:,.0f}</b><br/>'
								},
								series: [{
									name: 'Numero',
									colorByPoint: true,
									data: [{
										name: 'Recargas Virtuales',
											y: ToReVirtuales,
											drilldown: 'Mes Anterior'
									}, {
										name: 'Recargas Fisicas',
										y: TotalReFisicas,
										drilldown: 'Mes Actual'
									} ]
								}],
						});
						

						$('#recargaMes').highcharts({
							chart: {
								type: 'column'
							},
							title: {
								text: 'Mes Anterior - Mes Actual'
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
					            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> '+ moneda + '{point.y:,.0f}</b><br/>'
					        },
					        series: [{
					            name: 'Recargas',
					            colorByPoint: true,
					            data: [{
					                name: 'Mes Anterior <br>De: ' + fecha3 + ' al ' + fecha4,
					                y: dos,
					                drilldown: 'Mes Anterior'
					            }, {
					                name: 'Mes Actual <br>De: ' + fecha1 + ' al ' + fecha2,
					                y: uno,
					                drilldown: 'Mes Actual'
					            } ]
					        }],
						});											
						


					}
				});

			}
		});
}


function detallesMercadeo(){
	var ejecutar = $('#pais').val();
	if (ejecutar > 0 ) {}else{ejecutar = 1; }
	var param ={'Funcion':'detalleWeb', 'ejecutar':ejecutar}
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
		    var json = JSON.parse(data)	
		    var visitasWeb = 0;
		    for ( i = 0; i< json.length; i++ ) {
		    	visitasWeb = visitasWeb + parseInt(json[i].visitas);
		    }
		    

			var ejecutar = $('#pais').val();
			if (ejecutar > 0 ) {}else{ejecutar = 1; }
			var param ={'Funcion':'detallePlayStore', 'ejecutar':ejecutar}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
				    var json = JSON.parse(data)
				    var visitasPlayStore = 0;
				    var descargasPlayStore = 0;
				    var desinstalacionesPlayStore = 0;
				    for ( i = 0; i< json.length; i++ ) {
				    	visitasPlayStore = visitasPlayStore + parseInt(json[i].visitas) ;
				    	descargasPlayStore = descargasPlayStore + parseInt(json[i].descargas) ;
				    	desinstalacionesPlayStore = desinstalacionesPlayStore + parseInt(json[i].desinstalaciones) ;
				    }
				    var dispositivos_activosPlayStore =  parseInt(json[json.length-1].dispositivos) ;
					
					var ejecutar = $('#pais').val();
					if (ejecutar > 0 ) { }else{ ejecutar = 1;  }
					var param ={'Funcion':'detalleAppStore', 'ejecutar':ejecutar}
					$.ajax({
						data: JSON.stringify (param),
						type:"JSON",
						url: 'ajax.php',
						success:function(data){
						    var json = JSON.parse(data)	
						    var visitasAppStore = 0;
						    var descargasAppStore = 0;
						    var desinstalacionesAppStore = 0;
						    for ( i = 0; i< json.length; i++ ) {
						    	visitasAppStore = visitasAppStore + parseInt(json[i].visitas) ;
						    	descargasAppStore = descargasAppStore + parseInt(json[i].descargas) ;
						    	desinstalacionesAppStore = desinstalacionesAppStore + parseInt(json[i].desinstalaciones) ;
						    }
						    var dispositivos_activosAppStore = parseInt(json[json.length-1].dispositivos) ;
						    
							var ejecutar = $('#pais').val();
							if (ejecutar > 0 ) {}else{ ejecutar = 1; }
							var param ={'Funcion':'detalleCampanna', 'ejecutar':ejecutar}
							$.ajax({
								data: JSON.stringify (param),
								type:"JSON",
								url: 'ajax.php',
								success:function(data){
							    	var json = JSON.parse(data)	
							    	var audiencia = 0;
							    	var clics = 0;
							    	var totalRegistros = 0;
							    	for ( i = 0; i< json.length; i++ ) {
							    		audiencia = audiencia + parseInt(json[i].audiencia) ;
							    		clics = clics + parseInt(json[i].clics) ;
							    		totalRegistros = totalRegistros + parseInt(json[i].total_registros) ; 
							    	}

							    	$('#visitasMercadeo').highcharts({
								        chart: {
								            type: 'column'
								        },
								        title: {
								            text: 'Balance Visitas'
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
								            headerFormat: '<span style="font-size:15px">{series.name}</span><br>',
								            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> {point.y:,.0f}</b><br/>'
								        },

								        series: [{
								            name: 'Visitas',
								            colorByPoint: true,
								            data: [{
								                name: 'Pagina Web',
								                y:visitasWeb,
								                drilldown: 'Pagina Web'
								            }, {
								                name: 'PlayStore',
								                y: visitasPlayStore,
								                drilldown: 'PlayStore'
								            },{
								                name: 'AppStore',
								                y:visitasAppStore,
								                drilldown: 'AppStore'
								            }]
								        }]
									});
									$('#Campanna').highcharts({
								        chart: {
								            type: 'column'
								        },
								        title: {
								            text: 'Campaña'
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
								            headerFormat: '<span style="font-size:15px">{series.name}</span><br>',
								            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> {point.y:,.0f}</b><br/>'
								        },

								        series: [{
								            name: 'Campaña',
								            colorByPoint: true,
								            data: [{
								                name: 'Audiencia',
								                y: audiencia,
								                drilldown: 'Audiencia'
								            },{
								                name: 'Clics',
								                y:clics,
								                drilldown: 'Clics'
								            },{
								                name: 'Total Registros',
								                y:totalRegistros,
								                drilldown: 'Total Registros'
								            }]
								        }]
									});
									$('#DescargasMercadeo').highcharts({
								        chart: {
								            type: 'column'
								        },
								        title: {
								            text: 'Descargas'
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
								            headerFormat: '<span style="font-size:15px">{series.name}</span><br>',
								            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> {point.y:,.0f}</b><br/>'
								        },

								        series: [{
								            name: 'Descargas',
								            colorByPoint: true,
								            data: [{
								                name: 'PlayStore',
								                y: descargasPlayStore,
								                drilldown: 'PlayStore'
								            },{
								                name: 'AppStore',
								                y:descargasAppStore,
								                drilldown: 'AppStore'
								            }]
								        }]
									});
							  	 	$('#DesinstalacionesMercadeo').highcharts({
								        chart: {
								            type: 'column'
								        },
								        title: {
								            text: 'Desinstalaciones'
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
								            headerFormat: '<span style="font-size:15px">{series.name}</span><br>',
								            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> {point.y:,.0f}</b><br/>'
								        },

								        series: [{
								            name: 'Desinstalaciones',
								            colorByPoint: true,
								            data: [{
								                name: 'PlayStore',
								                y: desinstalacionesPlayStore,
								                drilldown: 'PlayStore'
								            },{
								                name: 'AppStore',
								                y:desinstalacionesAppStore,
								                drilldown: 'AppStore'
								            }]
								        }]
									});
									$('#DispositivosMercadeo').highcharts({
								        chart: {
								            type: 'column'
								        },
								        title: {
								            text: 'Dispositivos Activos'
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
								            headerFormat: '<span style="font-size:15px">{series.name}</span><br>',
								            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b> {point.y:,.0f}</b><br/>'
								        },

								        series: [{
								            name: 'Dispositivos Activos',
								            colorByPoint: true,
								            data: [{
								                name: 'PlayStore',
								                y: dispositivos_activosPlayStore,
								                drilldown: 'PlayStore'
								            },{
								                name: 'AppStore',
								                y:dispositivos_activosAppStore,
								                drilldown: 'AppStore'
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
function detalleWeb() {	
	var ejecutar = $('#pais').val();
	if (ejecutar > 0 ) {}else{ejecutar = 1; }
	var param ={'Funcion':'detalleWeb', 'ejecutar':ejecutar}
		$.ajax({
		    data: JSON.stringify (param),
		    type:"JSON",
		    url: 'ajax.php',
		    success:function(data){
		    	var json = JSON.parse(data)	
				
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
		    var json = JSON.parse(data)	
			
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
	  	 	
		}
	});
}

// funcion de indices Visitas VS registros y vs descargas
function linealRegistros(){
	var ejecutar = $('#pais').val();
	if (ejecutar > 0 ) {}else{ejecutar = 1; }
	var fecha = 1;
	
	var param ={'Funcion':'linealRegistros', 'ejecutar':ejecutar, 'fecha':fecha}
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log( data + 'usuarios   oooooooooooooo' + data)
			var registros = JSON.parse(data)
			var TotalRegistros = registros[0].usuarios;

			var ejecutar = $('#pais').val();
			if (ejecutar > 0 ) {}else{ejecutar = 1; }
			var fecha = 2;
			
			var param ={'Funcion':'linealRegistros', 'ejecutar':ejecutar, 'fecha':fecha}
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					//console.log( data + 'usuarios   oooooooooooooo' + data)
					var registros = JSON.parse(data)
					var TotalRegistros1 = registros[0].usuarios;
			
					var ejecutar = $('#pais').val();
					if (ejecutar > 0 ) {}else{ejecutar = 1; }
					var fecha = 1;
					var param ={'Funcion':'sumVisitasWeb', 'ejecutar':ejecutar, 'fecha':fecha}
					$.ajax({
						data: JSON.stringify (param),
						type:"JSON",
						url: 'ajax.php',
						success:function(data){
							//console.log( data)
							var registrosWeb = JSON.parse(data)
							var TotalWeb = registrosWeb[0].visitas;
							
							var ejecutar = $('#pais').val();
							if (ejecutar > 0 ) {}else{ejecutar = 1; }
							var fecha = 2;
							var param ={'Funcion':'sumVisitasWeb', 'ejecutar':ejecutar, 'fecha':fecha}
							$.ajax({
								data: JSON.stringify (param),
								type:"JSON",
								url: 'ajax.php',
								success:function(data){
									//console.log( data)
									var registrosWeb = JSON.parse(data)
									var TotalWeb1 = registrosWeb[0].visitas;

									var ejecutar = $('#pais').val();
									if (ejecutar > 0 ) {}else{ejecutar = 1; }
									var fecha = 1;
									var param ={'Funcion':'sumVisitasPlay', 'ejecutar':ejecutar, 'fecha':fecha}
									$.ajax({
										data: JSON.stringify (param),
										type:"JSON",
										url: 'ajax.php',
										success:function(data){
											var registrosPlay = JSON.parse(data)
											var TotalPlay = registrosPlay[0].visitas;
											var DescargasPlay = registrosPlay[0].descargas;


											var ejecutar = $('#pais').val();
											if (ejecutar > 0 ) {}else{ejecutar = 1; }
											var fecha = 2;
											var param ={'Funcion':'sumVisitasPlay', 'ejecutar':ejecutar, 'fecha':fecha}
											$.ajax({
												data: JSON.stringify (param),
												type:"JSON",
												url: 'ajax.php',
												success:function(data){
													var registrosPlay = JSON.parse(data)
													var TotalPlay1 = registrosPlay[0].visitas;
													var DescargasPlay1 = registrosPlay[0].descargas;
											

													var ejecutar = $('#pais').val();
													if (ejecutar > 0 ) {}else{ejecutar = 1; }
													var fecha = 1;
													var param ={'Funcion':'sumVisitasApp', 'ejecutar':ejecutar, 'fecha':fecha}
													$.ajax({
														data: JSON.stringify (param),
														type:"JSON",
														url: 'ajax.php',
														success:function(data){
															var registrosApp = JSON.parse(data)
															var TotalApp = registrosApp[0].visitas;
															var DescargasApp = registrosApp[0].descargas;

															var ejecutar = $('#pais').val();
															if (ejecutar > 0 ) {}else{ejecutar = 1; }
															var fecha = 2;
															var param ={'Funcion':'sumVisitasApp', 'ejecutar':ejecutar, 'fecha':fecha}
															$.ajax({
																data: JSON.stringify (param),
																type:"JSON",
																url: 'ajax.php',
																success:function(data){
																	var registrosApp = JSON.parse(data)
																	var TotalApp1 = registrosApp[0].visitas;
																	var DescargasApp1 = registrosApp[0].descargas;


																	var registostotal = parseInt(TotalRegistros);
																	var visitastotal = parseInt(TotalWeb) + parseInt(TotalPlay) + parseInt(TotalApp);
																	var descargasTotal = parseInt(DescargasPlay) + parseInt(DescargasApp)

																	var registostotalP = parseInt(TotalRegistros1);
																	var visitastotalP = parseInt(TotalWeb1) + parseInt(TotalPlay1) + parseInt(TotalApp1);
																	var descargasTotalP = parseInt(DescargasPlay1) + parseInt(DescargasApp1)
															

																	var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
																	var f=new Date();
																	var mes = meses[f.getMonth()];

																	var mesP = "";
																	if (mes == "Enero" ) {mesP = 'Diciembre'}
																	if (mes == "Febrero" ) {mesP = 'Enero'}
																	if (mes == "Marzo" ) {mesP = 'Febrero'}
																	if (mes == 'Abril') {mesP = 'Marzo'}
																	if (mes == 'Mayo') {mesP = 'Abril'}
																	if (mes == 'Junio') {mesP = 'Mayo'}
																	if (mes == 'Julio') {mesP = 'Junio'}
																	if (mes == 'Agosto') {mesP = 'Julio'}
																	if (mes == 'Septiembre') {mesP = 'Agosto'}
																	if (mes == 'Octubre') {mesP = 'Septiembre'}
																	if (mes == 'Noviembre') {mesP = 'Octubre'}
																	if (mes == 'Diciembre') {mesP = 'Noviembre'}

																	//document.write(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());


																	$('#indVisitasRegistros').highcharts({
																        title: {
																            text: 'Visitas VS Registros',
																            x: -20 //center
																        },
																        subtitle: {
																            text: '',
																            x: -20
																        },
																        xAxis: {
																            categories: [mesP, mes ]
																        },
																        yAxis: {
																            title: {
																                text: 'Datos'
																            },
																            plotLines: [{
																                value: 0,
																                width: 1,
																                color: '#808080'
																            }]
																        },
																        tooltip: {
																            valueSuffix: ''
																        },
																        legend: {
																            layout: 'vertical',
																            align: 'right',
																            verticalAlign: 'middle',
																            borderWidth: 0
																        },
																        series: [{
																            name: 'registros',
																            data: [registostotalP, registostotal]
																        }, {
																            name: 'Visitas',
																            data: [visitastotalP, visitastotal]
																        }]
																    });
																    $('#indDescargasRegistros').highcharts({
																        title: {
																            text: 'Descargas VS Registros',
																            x: -20 //center
																        },
																        subtitle: {
																            text: '',
																            x: -20
																        },
																        xAxis: {
																            categories: [mesP, mes ]
																        },
																        yAxis: {
																            title: {
																                text: 'Datos'
																            },
																            plotLines: [{
																                value: 0,
																                width: 1,
																                color: '#808080'
																            }]
																        },
																        tooltip: {
																            valueSuffix: ''
																        },
																        legend: {
																            layout: 'vertical',
																            align: 'right',
																            verticalAlign: 'middle',
																            borderWidth: 0
																        },
																        series: [{
																            name: 'registros',
																            data: [registostotalP, registostotal]
																        },{
																            name: 'Descargas',
																            data: [descargasTotalP, descargasTotal]
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
							});
						}
					});
				}
			});
		}
	});
}










							