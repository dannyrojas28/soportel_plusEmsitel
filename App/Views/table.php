<link rel="stylesheet" href="Public/css/bootstrap.min.css">
<link rel="stylesheet" href="Public/css/dataTables.bootstrap.min.css">



    <div class="row">
        <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
            <div class="col-sm-offset-2 col-sm-8">
                <h3 class="text-center"> <small class="mensaje"></small></h3>
            </div>
            <div class="table-responsive col-sm-12">        
                <table id="dt_cliente" class="table table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>                                
                            <th>Descripcion</th>
                            <th>Responsable</th>
                            <th>Fecha</th>
                            <th>Estado</th>                                           
                        </tr>
                    </thead>                    
                </table>
            </div>          
        </div>      
    </div>


<script src="Public/js/jquery-1.12.3.js"></script>
<script src="Public/js/bootstrap.min.js"></script>
<script src="Public/js/jquery.dataTables.min.js"></script>
<script src="Public/js/dataTables.bootstrap.js"></script>


<script>		
		$(document).on("ready", function(){
			Listar();
		});
		$("#btn_listar").on("click", function(){
			listar();
		});

		var Listar = function(){
			var table = $("#dt_cliente").DataTable({
				"destroy":true,
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data":"nombre"},
					{"data":"apellidos"},
					{"data":"dni"}					
				],
				"language":idioma_espanol
			});
		}
		var idioma_espanol = {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}

		
		

	</script>