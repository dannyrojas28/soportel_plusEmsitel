$(document).ready(function(){
	//LetraVentas();ç
	 param = {'action':'login','login_username':'admin','login_password':'admin','realm':2};
	 $.ajax({
				data: param,
				type:"post",
				url: 'http://201.245.191.78/cacti/',
				success:function(data){
					console.log(".."+data);
				}
			});
});
		function Encriptar(){
			// Envio los parametros que deseo, pero siempre tiene que ir el nombre de la funcion  Funcion = miFuncion y apuntando a la misma url ajax.php que quiero ejecutar en el principalController, envios los datos en JSON para recibirlos y convertirlos en un array en el php para poder manejarlos mejor
			var password = $('#password').val();
			var param ={'Funcion':'Encriptar','password':password};
			$.ajax({
				data: JSON.stringify (param),
				type:"JSON",
				url: 'ajax.php',
				success:function(data){
					console.log(data);
					$('#passwordHid').val(data);
				}
			});
		}


			
		
		

