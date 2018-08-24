<?php
    include "App/Views/includes/header.blade.php";
    $estado = "Reventa";
    $mes = array('','enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
    $mes =  strtoupper($mes[date('n')]);
?>

<main>
    <div class="main-wrapper">
        <div class="container-fluid">
            <div class="row">
                    <!--Main column-->
                    
                    <?php
                    
                    $roles= count($_SESSION['tipo_rol']);
                    $pag = false;
                    for ($i=0; $i < $roles; $i++) { 
                        # code...
                        if($_SESSION['tipo_rol'][$i] == $estado || $_SESSION['tipo_rol'][$i] ==  "ADMINISTRADOR"){
                            $pag = true;   
                        }
                    }
                    if($pag == true){
                    ?>
                            <div class="col-md-12">
                            <br>
                                <div class="col-md-2">

                                    <a href="Ventas" style="display:inline-block"><i class="fa fa-arrow-left  " style="color:#blue;font-size:2.5em"></i></a>
                                </div>
                                <div class="col-md-10">
                                    <center><h3 style="display:inline-block">   Calendario de Mantenimiento de Cabina</h3></center>
                                </div>
                                <div class="col-md-12"><hr></div>
                                    <div class="col-md-3 col-xs-12">
                                      <h5 href="Ventas" style="display:inline-block;color:#E51812" >Mantenimientos Atrasados (<span id="p-atrasados"></span>)</h5>
                                    <div id="list_details"></div>
                                   
                                </div>
                                <div class="col-md-9 col-xs-12" id="tip">
                                    <div id="calendar0">

                                    </div>

                                </div>
                                <input type="hidden" value="0" id="calendar_valida">
                                <input type="hidden" value="agendaWeek" id="calendar_valida_pos">
                                 <div class="col-md-12">     <br><br><br></div>
                            <script src="Public/js/calendario.js?n=1"></script>
                            <script src="Public/js/toastr.js?n=1"></script>
                            <link href='App/Librarys/Calendar/fullcalendar.css' rel='stylesheet' />
                            <link href='App/Librarys/Calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
                            <script src='App/Librarys/Calendar/moment.min.js?n=1'></script>
                            <script src='App/Librarys/Calendar/fullcalendar.min.js?n=1'></script>
                            <script src='App/Librarys/Calendar/lang-all.js?n=1'></script>
                            <script type="text/javascript">
                                var d = new Date();
                                var days = ["Dom","Lun","Mar","Mie","Jue","Vie","Sab"];
                                Calendar();

                            </script>

                    <?php
                    }else{
                    ?>
                        <CENTER>
                            <br><br>
                            <h1 style="color:#83a7ce">NO TIENES PERMISOS PARA VER ESTE MODULO</h1>
                                <img src="Public/img/acceso_denegado.png" style="width:200px">
                        </CENTER>
                    <?php
                    }
                    ?>
                    
    
            </div>
        </div>
    </div>
</main>


<!-- controles de eventos de checkbox -->
<script type="text/javascript">
function mostrar(id) {
    if (id == "selecciona") {
        $("#cabina").hide('slow');
        $("#telefono").hide('slow');
        $('#tipo_materiales').hide('slow');
    }

    if (id == "cabina") {
        $("#cabina").show('slow');
        $("#telefono").hide('slow');
        $('#tipo_materiales').hide('slow');
    }

    if (id == "telefono") {
        $("#cabina").hide('slow');
        $("#telefono").show('slow');
        $('#tipo_materiales').show('slow');
    }
}
function showContent_Mat() {
        element = document.getElementById("content_Mat");
        material_mantenimiento = document.getElementById("material_mantenimiento");
        if (material_mantenimiento.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>
<!-- ======================================== modal de registro de mantenimientos ===================================-->
<div class="modal fade modal-ext" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <!--Content-->
        <div class="modal-content">           
            <!--Header-->
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><b>Registro Mantenimientos</b></h4>
            </div>
                
            <!--Body-->
            <form method="post">            
            <div class="modal-body">
                <div class=" col-xs-12 col-md-6" >
                    <div class="md-form">
                        <p><b>Nombre Cabina</b></p>
                        <input placeholder="Ingresa Nombre Cabina" type="text" id="cabinas" name="cabina" class="form-control" onKeyUp="MostrarNombreCabinas()" >                
                        <div class="col-xs-12 " id="mostrar"></div>
                        <br>
                        <input type="hidden" id="id_cabina">
                        
                        <p><b>Detalles Mantenimientos</b></p> 
                        <select id="descripcion" name="descripcion" onChange="mostrar(this.value);" class="form-control" style="width: 200px; padding: 5px;  "  >
                            <option value="selecciona">Seleciona </option>
                            <option value="cabina">cabina</option>
                            <option value="telefono">telefono</option>         
                        </select>
                        <div id="cabina" style="display: none; margin-top: 20px; ">
                            <fieldset class="form-group" style="float: left;">
                                <input type="checkbox" name="pintura" value="1" id="pintura" >
                                <label for="pintura">Pintura</label>   <br>
                                    
                                <input type="checkbox" name="herraje" value="2" id="herraje" >
                                <label for="herraje">Herraje</label>   <br>

                                <input type="checkbox" name="sticker" value="3" id="sticker" >
                                <label for="sticker">Sticker</label>   <br>
                            </fieldset>
                        </div>

                        <div id="telefono" style="display: none; margin-top: 20px; ">
                            <fieldset class="form-group" style="float: left;">
                                <input type="checkbox" name="mant_general" value="" id="mant_general" >
                                <label for="mant_general">Mantenimiento General</label>   <br>
                                    
                                <input type="checkbox" name="prot_teclado" value="4" id="prot_teclado" >
                                <label for="prot_teclado">Protector teclado</label>   <br>

                                <input type="checkbox" name="conectores" value="5" id="conectores" >
                                <label for="conectores">Conectores</label>   <br>

                                <input type="checkbox" name="cable_red" value="6" id="cable_red" >
                                <label for="cable_red">Cable Red</label>   <br>

                                <input type="checkbox" name="cable_bocina" value="7" id="cable_bocina" >
                                <label for="cable_bocina">Cable Bocina</label>   <br>

                                <input type="checkbox" value="9" name="material_mantenimiento" value="8" id="material_mantenimiento"  onchange="javascript:showContent_Mat()" />
                                <label for="material_mantenimiento">Materiales de Mantenimiento</label>   <br>
                            </fieldset>
                        </div>
                        <div id="content_Mat" style="display: none;">
                            <textarea name="tipo_materiales" id="tipo_materiales" cols="30" rows="9" placeholder="Materiales Utilizados"></textarea>
                        </div>

                        <br><br><br>
                        <p style="float: left; width: 100%; display: block;  "><b>responsable</b></p>
                        <input placeholder="Ingrese su Nombre" type="text" id="responsable" name="responsable" class="form-control" required > 
                        <br>   
                    </div>
                </div>

                <div class=" col-xs-12 col-md-6" >
                    <div class="md-form">
                       <p><b>Descripcion Mantenimiento</b></p><br>                        
                        <input placeholder="Descripcion" type="text" id="descripcion_mantenimiento" name="descripcion_mantenimiento" class="md-textarea" > 
                        <br><br>
                        
                        <p><b>Tipo de Mantenimiento</b></p>
                        <select name="tipo" id="tipo" class="browser-default" class="form-control" style="width: 200px; padding: 5px;  " required>
                            <option value="1">Preventivo</option>
                            <option value="2">Correctivo</option>     
                        </select>  <br>

                        <p><b>Estado de Mantenimiento</b></p>
                        <select name="estado" id="estado" class="browser-default" class="form-control" style="width: 200px; padding: 5px;  " required>
                            <option value="2">Pendiente</option>    
                            <!--<option value="1">Ejecutado</option>
                            <option value="3">Atrasado</option>     -->
                        </select>  <br>

                        <p><b>Fecha de Registro </b></p>
                        <div class="fecha" style="padding: 40px "> 
                            <input type="text" id="fecha" name="fecha" >                       
                        </div>  <br>
                    </div>                    
                </div>
                    

                <div class="text-xs-center">
                    <button type="button" id="registrar" name="registrar" onclick="InsertMant_Cabinas()" class="btn btn-primary ">Registrar</button>
                    <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">
                </div>
            </div>
        </form>
            
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>






<script type="text/javascript"> 
    
    function showContent_Mat_i() {
        element = document.getElementById("content_Mat_i");
        material_mantenimiento = document.getElementById("material_mantenimiento_i");
        if (material_mantenimiento_i.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    function mostrar_i(id) {
        if (id == "selecciona_i") {
            $("#cabina_i").hide('slow');
            $("#telefono_i").hide('slow');
            $('#tipo_materiales_i').hide('slow');
        }

        if (id == "cabina") {
            $("#cabina_i").show('slow');
            $("#telefono_i").hide('slow');
            $('#tipo_materiales_i').hide('slow');
        }

        if (id == "telefono") {
            $("#cabina_i").hide('slow');
            $("#telefono_i").show('slow');
            $('#tipo_materiales_i').show('slow');
        }
    }
</script>

<!-- Actualizar - datalles de Refigistro -->
<div class="modal fade modal-ext" id="modal-contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" >
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><b>Actualizar Registros</b></h4>
            </div>
            <!--Body--><form action="" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-6" style="padding: 0px 20px 0px 20px; ">
                        <div class="md-form">
                            <input type="hidden" id="cod_ca_i" name="cod_ca_i" class="form-control">
                            <input type="hidden" id="cod_i" name="cod" class="form-control">
                            <p><b>Nombre Cabina</b></p>
                            <input placeholder="Ingresa Nombre Cabina" type="text" id="nombre_i" name="nombre" class="form-control" readonly="readonly" >
                        </div>
                        <div class="md-form">
                            <p><b>Detalles Mantenimientos</b></p> 
                            <select id="descripcion_i" name="descripcion_i" onChange="mostrar_i(this.value);" class="form-control" style="width: 200px; padding: 5px;  "  >
                                <!--<option value="selecciona_i" >Seleciona </option>-->
                                <option value="cabina" >cabina</option>
                                <option value="telefono" >telefono</option>         
                            </select>
                            <div id="cabina_i" style="display: none; margin-top: 20px; width: 100%; ">
                                <fieldset class="form-group"  >
                                    <input type="checkbox" id="pintura_i"  >
                                    <label for="pintura_i">Pintura</label>   <br>
                                    
                                    <input type="checkbox"  id="herraje_i" >
                                    <label for="herraje_i">Herraje</label>   <br>

                                    <input type="checkbox" id="sticker_i" >
                                    <label for="sticker_i">Sticker</label>   <br>
                                </fieldset>
                            </div>
                            <div id="telefono_i" style="display: none; margin-top: 20px; width: 100%;  ">
                                <fieldset class="form-group" >
                                    <input type="checkbox"  id="mant_general_i" >
                                    <label for="mant_general_i">Mantenimiento General</label>   <br>
                                    
                                    <input type="checkbox"  id="prot_teclado_i" >
                                    <label for="prot_teclado_i">Protector teclado</label>   <br>

                                    <input type="checkbox"  id="conectores_i" >
                                    <label for="conectores_i">Conectores</label>   <br>

                                    <input type="checkbox" value="1" id="cable_red_i" >
                                    <label for="cable_red_i">Cable Red</label>   <br>

                                    <input type="checkbox" id="cable_bocina_i" >
                                    <label for="cable_bocina_i">Cable Bocina</label>   <br>

                                    <!--<input type="checkbox" id="material_mantenimiento">-->
                                    <input type="checkbox" value="1" id="material_mantenimiento_i"  onchange="javascript:showContent_Mat_i()" />
                                    <label for="material_mantenimiento_i">Materiales de Mantenimiento</label>   <br>
                                </fieldset>
                            </div>
                            <div id="content_Mat_i" style="display: none;">
                                <textarea id="tipo_materiales_i" cols="30" rows="9" placeholder="Materiales Utilizados"></textarea>
                            </div> 
                        </div>
                        <div class="md-form">
                            <p style="float: left; width: 100%; display: block;  "><b>responsable</b></p>
                            <input placeholder="Ingrese su Nombre" type="text" id="responsable_i" class="form-control"   >
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="padding: 0px 20px 0px 20px; ">
                        <div class="md-form">
                            <p style="display: block;"><b>Descripcion Mantenimiento</b></p>
                            <input placeholder="Descripcion" type="text" id="descripcion_mantenimiento_i" name="descripcion_mantenimiento_i" class="md-textarea" > 
                        </div>
                        <div class="md-form">
                            <p><b>Tipo de Mantenimiento</b></p>
                            <select name="tipo_i" id="tipo_i" class="browser-default" class="form-control" style="width: 200px; padding: 5px;  " required>
                                <option value="1">Preventivo</option>
                                <option value="2">Correctivo</option>     
                            </select>
                        </div>
                        <div class="md-form">
                            <p><b>Estado de Mantenimiento</b></p>
                            <select name="estado_i" id="estado_i" class="browser-default" class="form-control" style="width: 200px; padding: 5px;  " required>
                                <option value="2" id="pendiente">Pendiente</option>    
                                <option value="1" id="ejecutado">Ejecutado</option>
                                <option value="3" id="atrasado">Atrasado</option>    
                            </select>
                        </div>
                        <div class="md-form">
                            <p><b>Fecha de Registro</b></p>
                            <div class="fecha" > 
                                <!--<input type="datetime-local" id="fecha_i" name="fecha" >-->
                                <input type="text" id="fecha_i" name="fecha_i"  >                       
                                <!--<input type="date" class="form-control" id="fecha" name="fecha">-->
                            </div>
                        </div>
                        <div class="md-form">
                            <p><b>Fecha de Ejecución</b></p>
                            <div class="fecha" >                             
                                <input type="text" id="fecha_ejecutado_i" name="fecha_ejecutado_i" value="<?php echo date('Y-m-d h:i:s'); ?>" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            <!--Footer-->
            <div class="modal-footer"><center>
                <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalActualizar">Actualizar</button>
                <button type="button" class="btn btn-danger" id="delete" data-toggle="modal" data-target=".ModalBorrar" >Borrar</button>
                <button type="button" class="btn btn-default" id="reset_modal" data-dismiss="modal"  >Cancelar</button></center>
            </div>
            </form>
        </div>
        <!--/.Content-->
    </div>
</div>


<!--   modal Actualizar -->
<div class="modal fade ModalActualizar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 130px;  ">
  <div class="modal-dialog modal-xs">
    <div class="modal-content" style="padding: 50px; background: #3b3b3b;  ">
        <h2 style="color: #fff;  text-align: center;">¿Éstas seguro de Actualizar el Registro?</h2>
        <br><br><br><br>
        <center>
            <button type="hidden" id="update" name="update" onclick="UpdatetMantenimientosCabinas()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
            <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
            <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">

        </center>       
    </div>
  </div>
</div>

<!--   modal Borrar -->
<div class="modal fade ModalBorrar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 130px;  ">
  <div class="modal-dialog modal-xs">
    <div class="modal-content" style="padding: 50px; background: #3b3b3b;  ">
        <h2 style="color: #fff; ">Estas seguro de eliminar el registo !!!</h2>
        <br><br><br><br>
        <center>
            <button type="hidden" id="update" name="update" onclick="DeleteMantenimientosCabina()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
            <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
            <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">

        </center>       
    </div>
  </div>
</div>
