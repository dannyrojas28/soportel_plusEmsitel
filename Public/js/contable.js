function eventContable() {
    $('.contable').css('background','#2B5A8A')   
    $('.contable').css('color','#fff')   
}

function Caja() {
	//console.log(ejecutar)		
	var param ={'Funcion':'Caja'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			console.log(data  + ' caja')
			var json = JSON.parse(data)
			var caja = formatearNumero(json[0].caja)
			$('#caja').html('$ '+caja)
		}
	});
}

function Bancos() {
	//console.log(ejecutar)		
	var param ={'Funcion':'Bancos'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data)
			var json = JSON.parse(data)
			var bancos = formatearNumero(json[0].bancos)
			$('#bancos').html('$ '+bancos)
			if(bancos < 2000000 ){
				$('.contable').css('color','#C91023');
			}				
		}
	});
}

function facturas() {
	//console.log(ejecutar)		
	var param ={'Funcion':'facturas'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data)
			var json = JSON.parse(data)
			var facturas = formatearNumero(json[0].facturas)
			$('#facturas').html('$ '+facturas)
		}
	});
}

function cateraCorriente() {
	//console.log(ejecutar)		
	var param ={'Funcion':'cateraCorriente'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data)
			var json = JSON.parse(data)
			var cateraCorriente = formatearNumero(json[0].cateraCorriente)
			$('#carteraCorriente').html('$ '+cateraCorriente)
		}
	});
}

function cartaDificilCobro() {
	//console.log(ejecutar)		
	var param ={'Funcion':'cartaDificilCobro'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data)
			var json = JSON.parse(data)
			var cartaDificilCobro = formatearNumero(json[0].cartaDificilCobro)
			$('#carteraDificil').html('$ '+cartaDificilCobro)
			if(cartaDificilCobro != 0  ){
				$('.contable').css('color','#C91023');
			}
		}
	});
}

function bancoDifDebitoCredito() {
	//console.log(ejecutar)		
	var param ={'Funcion':'bancoDifDebitoCredito'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data)
			var json = JSON.parse(data)
			var bancoDifDebitoCredito = formatearNumero(json[0].bancoDifDebitoCredito)
			$('#bancosDebCredito').html('$ '+bancoDifDebitoCredito)
		}
	});
}

function proveedores() {
	//console.log(ejecutar)		
	var param ={'Funcion':'proveedores'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			console.log(data + ' ????????????????')
			var json = JSON.parse(data)
			var proveedor = formatearNumero(json[0].proveedor)
			$('#proveedores').html('$ '+proveedor)
		}
	});
}


function impuestosRetefuente() {
	//console.log(ejecutar)		
	var param ={'Funcion':'impuestosRetefuente'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data)
			var json = JSON.parse(data)
			var impuestos = formatearNumero(json[0].impuestos)
			$('#impuestosretefuente').html('$ '+impuestos)
		}
	});
}
function impuestosMinTic() {
	//console.log(ejecutar)		
	var param ={'Funcion':'impuestosMinTic'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data)
			var json = JSON.parse(data)
			var impuestos = formatearNumero(json[0].impuestos)
			$('#impuestosmintic').html('$ '+impuestos)
		}
	});
}
function impuestosIva() {
	//console.log(ejecutar)		
	var param ={'Funcion':'impuestosIva'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data)
			var json = JSON.parse(data)
			var impuestos = formatearNumero(json[0].impuestos)
			$('#impuestosiva').html('$ '+impuestos)
		}
	});
}
function impuestosCree() {
	//console.log(ejecutar)		
	var param ={'Funcion':'impuestosCree'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data)
			var json = JSON.parse(data)
			var impuestos = formatearNumero(json[0].impuestos)
			$('#impuestoscree').html('$ '+impuestos)
		}
	});
}
function impuestosCrc() {
	//console.log(ejecutar)		
	var param ={'Funcion':'impuestosCrc'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data)
			var json = JSON.parse(data)
			var impuestos = formatearNumero(json[0].impuestos)
			$('#impuestoscrc').html('$ '+impuestos)
		}
	});
}

function nomina() {
	//console.log(ejecutar)		
	var param ={'Funcion':'nomina'};
	$.ajax({
		data: JSON.stringify (param),
		type:"JSON",
		url: 'ajax.php',
		success:function(data){
			//console.log(data)
			var json = JSON.parse(data)
			var nomina = formatearNumero(json[0].nomina)
			$('#nomina').html('$ '+nomina)
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
