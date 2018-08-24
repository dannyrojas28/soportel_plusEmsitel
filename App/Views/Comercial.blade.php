<?php

    include "App/Views/includes/header.blade.php";
    $estado = "Comercial";
?>

<main>
    <div class="main-wrapper">
        <div class="container-fluid">
            <div class="row">
                    <!--Main column-->
<?php

    require_once 'App/Controllers/PrincipalController.php';
    require_once 'Config/vars.php';

      //inicializo el controlador Principal
      $PrincipalController = new PrincipalController();  
                    
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
                        <CENTER>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="Public/js/toastr.js?n=1"></script>
<script src="App/Librarys/highcharts/highcharts.js?n=1"></script>
<script src="App/Librarys/highcharts/data.js?n=1"></script>
<script src="App/Librarys/highcharts/drilldown.js?n=1"></script>
<script src="Public/js/comercial.js"></script>
<script>
   eventComercial();
   
   ContactosGestion();
   detalleBalance()
   selecBalanceComercial();
   contactosEstadisticasGestion();
    diasTotal();
     
</script>
<br>
<center><h1 style="color:#83a7ce" >AREA COMERCIAL</h1></center><br><br>
<div class="graficas" style="padding: 5px; ">
    <div class="col-xs-12 col-md-6" style="padding-left: 150px;">
         <div class="col-xs-12 col-md-6">
            <p style="float: left; margin-left: 20px; "> <b> Del: </b></p> 
         </div>
         <div class="col-xs-12 col-md-6">
            <input  type="date" name="fechaIniaco" id="fechaIniaco" value="<?php echo date('Y-m-01'); ?>" style="width: 100%; float: left; margin-left: -10px; " onchange="selecBalanceComercial();detalleBalance()">
         </div>
      </div>
      <div class="col-xs-12 col-md-6" style="margin-right: : 150px; ">
         <div class="col-xs-12 col-md-3">
            <p style="float: right; margin-right: 10px; "> <b>Al: </b></p>
         </div>
         <div class="col-xs-12 col-md-9">
            <input  type="date" name="fechaFinaco" id="fechaFinaco" value="<?php echo date('Y-m-d'); ?>" style="width: 100%; float: left; margin-left: 0px; " onchange="selecBalanceComercial();detalleBalance()">
         </div>
      </div>
   <div class="col-xs-12 col-md-6">
      <div id="balNoComercial"></div>
   </div>
   <div class="col-xs-12 col-md-6">
      <div id="balPComercial"></div>
   </div>
   <div class="col-xs-12">
      <div id="balanceGeneral"></div>
   </div>
</div>

<div class="col-xs-12 "><br><hr><br></div>
<!--
<div class="col-xs-12">
 	
 	<center><h2>Calculadora de Precios Telefonía</h2></center>
	<div class="col-xs-12 "><br></div> 
	<div class="col-xs-12 col-md-5" style="padding-left: 150px;">
		<div class="col-xs-12 col-md-3">
            <p style="float: right; margin-left: 20px; "> <b>No. de lineas: </b></p>
        </div>
        <div class="col-xs-12 col-md-9">
            <input  type="text" name="numLineas" id="numLineas" placeholder="lineas" style="width: 65%;float: left;">
        </div>
    </div>
	<div class="col-xs-12 col-md-7" style="margin-right: : 250px;">
		<div class="col-xs-12 col-md-3">
            <p style="float: right; margin-left: 100px; "> <b>$ </b></p>
        </div>
        <div class="col-xs-12 col-md-9">
            <input  type="text" name="valorLineas" id="valorLineas" placeholder="0000" style="width: 65%;float: left;" readonly>
        </div>
    </div>
	<div class="col-xs-12 "><br></div> 
    <div class="col-xs-12 col-md-5" style="padding-left: 150px;">
		<div class="col-xs-12 col-md-3">
            <p style="float: right; margin-left: 20px; "> <b>No. de extensiones: </b></p>
        </div>
        <div class="col-xs-12 col-md-9">
            <input  type="text" name="numExtensiones" id="numExtensiones" placeholder="extensiones" style="width: 65%;float: left;">
        </div>
    </div>
	<div class="col-xs-12 col-md-7" style="margin-right: : 250px;">
		<div class="col-xs-12 col-md-3">
            <p style="float: right; margin-left: 100px; "> <b>$ </b></p>
        </div>
        <div class="col-xs-12 col-md-9">
            <input  type="text" name="valorExt" id="valorExt" placeholder="0000" style="width: 65%;float: left;" readonly>
        </div>
    </div>
	<div class="col-xs-12 "><br></div>
	<div class="col-xs-12 col-md-5" style="padding-left: 150px;">
	</div>
	<div class="col-xs-12 col-md-7" style="margin-right: : 250px;">
		<div class="col-xs-12 col-md-3">
            <p style="float: right;"> <b>TOTAL   $ </b></p>
        </div>
        <div class="col-xs-12 col-md-9">
            <input  type="text" name="valorTotal" id="valorTotal" placeholder="0000" style="width: 65%;float: left;" readonly>
        </div>
    </div>
	<div class="col-xs-12 "><br></div>
	<div class="col-xs-12 "><br>
		<button class="btn btn-primary" style="float: center; margin-top: 20px;" onclick="selectEstadoComercial()">Calcular</button>
	</div>
	
</div>-->

<div class="col-xs-12 "><br><hr><br></div>

<div id="tab" style="border: 1px solid #fff; padding: 10px; ">
   <center><h2>Gestion de Contactos</h2>
   <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <p style="float: left; margin-left: 18px; "> <b> De: </b></p> 
        <input  type="date" name="fechaInic" id="newfechaInic" value="<?php echo date('Y-m-01'); ?>" style="width: auto; float: left; margin-left: 30px; ">
      </div>
    </div>
   <div class="col-xs-12 col-md-6">
        <div class="form-group">
          <p style="float: left; margin-left:18px; "> <b> Al: </b></p>
          <input  type="date" name="fechaFi" id="newfechaFi" value="<?php echo date('Y-m-d'); ?>" style="width: auto; float: left; margin-left: 30px; ">
        </div>
    </div>
   <div class="col-xs-12 col-md-6"><br>
      <center>
          <select id="nombreAsesor" name="asesor_comercialU" class="browser-default" >
            <option value="">Seleccionar Asesor</option>
            <?php
              $selecteco =$PrincipalController->ComercialAsesores();
              while ($res = mysqli_fetch_object($selecteco)) {
                                       # code...
                  $name=utf8_encode($res->name);
                   echo '<option value="'.$res->cod.'">'.$name.'</option>';
              }
            ?>
          </select>
        </center>
   </div>
   <div class="col-xs-6 col-md-6">
      <select name="estadoComercial" id="estadoComercial" class="browser-default" class="form-control" style=" width: 200px; margin-top: 20px;  border-radius: 2px;  padding: 10px;  float: left; margin-left: 10px; border: 1px solid #efe8e8; " required onchange="selectEstadoComercial()">
         <option value="4" selected>Selecciona Categoría</option>
         <option value="1" >Confianza</option>
         <option value="2">Comunicacion</option>     
         <option value="3">Cooperacion</option>     
      </select>
   </div>
   <div class="col-xs-12">
      <center><button class="btn btn-primary" style=" margin-top: 20px;" onclick="selectEstadoComercial()">Buscar</button></center>
   </div>
   <div class="col-xs-12">
      <br><h3>Clientes Potencializados</h3>
   </div>
    
</center>
   <br>
   <div class="col-xs-12">
   <table id="tableBalComercial" class="table table-bordered" style="text-align: center; margin-left: : 0px ; width: 100%; ">
      <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
         <tr >
            <th style="text-align: center;">Ver</th>
            <th style="text-align: center;">Nombre Cliente</th>
            <th style="text-align: center;">Tipo Cliente</th>
            <th style="text-align: center;">Sector Economico</th>
            <th style="text-align: center;">Servicio</th>
            <th style="text-align: center;">Competencia</th>
            <th style="text-align: center;">Asesor Comercial</th>
            <th  style="text-align: center;">Confianza (dias)</th>
            <th  style="text-align: center;">Comunicacion (dias)</th>
            <th  style="text-align: center;">Cooperacion (dias)</th>
         </tr>
      </thead>
      <tbody id="cuerpoGestionComercial">
      </tbody>
   </table> 
   <table id="tableComercialBusqueda" class="table table-bordered" style="text-align: center; margin-left: : 0px ; width: 100%; display: none; ">
      <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
         <tr >
            <th style="text-align: center;">Ver</th>
            <th style="text-align: center;">Nombre Cliente</th>
            <th style="text-align: center;">Tipo Cliente</th>
            <th style="text-align: center;">Sector Economico</th>
            <th style="text-align: center;">Servicio</th>
            <th style="text-align: center;">Competencia</th>
            <th style="text-align: center;">Asesor Comercial</th>
            <th id="detaConfianza" style="text-align: center; display: none;">Confianza (dias)</th>
            <th id="detaComunicacion" style="text-align: center; display: none;">Comunicacion (dias)</th>
            <th id="detaCooperacion" style="text-align: center; display: none;">Cooperacion (dias)</th>
         </tr>
      </thead>
      <tbody id="cuerpoDetallesComercial">
      </tbody>
   </table> 
   </div>
</div> 
<div class="col-xs-12 "><br><hr><br></div> 
<div class="estadisticas">
   
   <div class="row">

    <div class="col-xs-12"><center><h2><b>Estadísticas</b></h2></center><br><br></div>
      <div class="col-xs-12 col-md-6" style="padding-left: 150px;">
         <div class="col-xs-12 col-md-6">
            <p style="float: left; margin-left: 20px; "> <b> Del: </b></p> 
         </div>
         <div class="col-xs-12 col-md-6">
            <input  type="date" name="fechaInic" id="fechaInic" value="<?php echo date('Y-m-01'); ?>" style="width: 100%; float: left; margin-left: -10px; ">
         </div>
      </div>
      <div class="col-xs-12 col-md-6" style="margin-right: : 150px; ">
         <div class="col-xs-12 col-md-3">
            <p style="float: right; margin-right: 10px; "> <b>Al: </b></p>
         </div>
         <div class="col-xs-12 col-md-9">
            <input  type="date" name="fechaFi" id="fechaFi" value="<?php echo date('Y-m-d'); ?>" style="width: 100%; float: left; margin-left: 0px; ">
         </div>
      </div>
      <div class="col-xs-12 "><br></div> 
      <div class="col-xs-12 col-md-6" style="padding-left: 120px;">
         <div class="col-xs-12 col-md-3">
            <p style="float: right; margin-right: 0px; "> <b>Vendedor: </b></p>
         </div>
         <div class="col-xs-12 col-md-9">
          <center>
            <select id="nomVendedor" name="nomVendedor" placeholder="Nombre Vendedor" style="width: 65%;float: right;" class="browser-default" >
              <option value="">Seleccionar Asesor</option>
              <?php
                $selecteco =$PrincipalController->ComercialAsesores();
                while ($res = mysqli_fetch_object($selecteco)) {
                                         # code...
                    $name=utf8_encode($res->name);
                     echo '<option value="'.$res->cod.'">'.$name.'</option>';
                }
              ?>
            </select>
        </center>
         </div>
      </div>
      <div class="col-xs-12 col-md-6" style="margin-right: : 150px; ">
         <center>
            <button class="btn btn-primary btn-sm" id="AtencionCliente" onclick="contactosEstadisticasGestion()" > <i class="fa fa-search" aria-hidden="true"></i> <b>Consultar<b>  </button>
         </center>
      </div>
      
   </div>

   

   <div class="col-xs-12 "><br><hr><br></div> 
   <div class="col-xs-12">
      <center>
         <div class="gestionContactos">
            <div class="col-xs-12 col-md-3">
               <h6> <b> Total Cliente:  </b><span id="tclientes"></span></h6>
            </div>
            <div class="col-xs-12 col-md-4">
               <h6> <b> Negocios Exitosos:  </b><span id="negoExitosos"></span></h6>
            </div>
            <div class="col-xs-12 col-md-5">
               <h6> <b> Tiempo Medio de cierre:  </b><span id="tiempoMedio"></span></h6>
            </div>      
         </div>         
      </center>
   </div>
   <div class="col-xs-12 "><br></div> 
   <div class="col-xs-12">
      <center>
         <table id="tableBalCo" class="table table-bordered" style="text-align: center; margin-left: : 0px ; width: 80%; ">
            <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
               <tr >
                  <th style="text-align: center;">Cliente</th>
                  <th style="text-align: center;">Competencia</th>
                  <th style="text-align: center;">Asesor Comercial</th>
                  <th style="text-align: center;">Negocio Exitoso</th>
                  <th style="text-align: center;">Duracion Dias</th>
               </tr>
            </thead>
            <tbody id="c_GestionComercial">
            </tbody>
         </table>         
      </center>
      <br><br>
   </div>
   <div class="col-xs-12">
      <center>
         <h6><b>Estadisticas del mes vigente</b></h6>
         <table id="tableBalanceComercial" class="table table-bordered" style="text-align: center; margin-left: : 0px ; width: 80%; ">
            <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
               <tr >
                  <th style="text-align: center;">Vendedor mas eficiente</th>
                  <th style="text-align: center;">Mayor monto vendido</th>
                  <th style="text-align: center;">Cliente con Negociacion mas corta</th>
               </tr>
            </thead>
            <tbody id="c_Estad_finales">
               <tr>
                  <td id="vendedorEficiente"></td>
                  <td id="MontoVendido"></td>
                  <td id="clienteCortaNeg"></td>
               </tr>
            </tbody>
         </table>          
      </center>
   </div>
   



</div>

<!-- Large modal -->
<button id="verContactos" class="btn btn-primary" data-toggle="modal" data-target=".modalVerContactos" style="display: none;"></button>

<div class="modal fade modalVerContactos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!--Content-->
        <div class="modal-content" style="background: #fff; height: 1500px;">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <center><h4 class="modal-title" id="myModalLabel"><b>Detalles Usuario</b></h4></center>
            </div>
            <!--Body-->
            <div class="modal-body">
               <div id="datosUsuarios"><center>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Nombre Cliente</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="nombInfo" readonly="readonly" >
                  </div>   
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Tipo Cliente</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="tpInfo" readonly="readonly" >
                  </div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Sector Económico</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="s_eInfo" readonly="readonly" >
                  </div>
                  <div class="col-xs-12"><br><hr></div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Servicio</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="sgInfo" readonly="readonly" >
                  </div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Competencia</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="compInfo" readonly="readonly" >
                  </div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b> Asesor Comercial</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="asesInfo" readonly="readonly" >
                  </div>
                  <div class="col-xs-12"><br><hr></div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Fase de Atencion</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="faseInfo" readonly="readonly" >
                  </div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Negocio Exitoso</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="negInfo" readonly="readonly" >
                  </div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Monto</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="number" id="montoInfo" readonly="readonly" >
                  </div>
                  <div class="col-xs-12"><br><hr></div>
                  <div class="col-xs-12 ">
                     <div id="faseDetalle" style="background: #f1efef; border: 1px solid #c1b3b3; padding: 30px; width: 100%; margin: auto;">
                        <center><h5><b>Fechas de Registro </b></h5></center>
                        <table id="tableInfoFechas" class="table table-bordered" style="" >
                           <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr>
                              <th style="text-align: center;">Fecha Confianza</th>
                              <th style="text-align: center;">Fecha Comunicacion</th>
                              <th style="text-align: center;">Fecha Cooperacion</th>
                              <th style="text-align: center;">Fecha Final Cierre</th>
                              <th style="text-align: center;">Total Dias</th>
                           </tr>
                           </thead>
                           <tbody id="cuerpoInfoFechas">
                              <tr>
                                 <td style="text-align: center;" id="fconfianza"></td>
                                 <td style="text-align: center;" id="fcomunicacion"></td>
                                 <td style="text-align: center;" id="fcooperacion"></td>
                                 <td style="text-align: center;" id="ffinal"></td>
                                 <td style="text-align: center;" id="fdias"></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="col-xs-12"><br><hr></div>
                  <div class="col-xs-12 ">
                     <div id="faseDetalle" style="background: #e8e6e6; border: 1px solid #c1b3b3; padding: 30px; width: 100%; margin: auto;">
                        <center><h5><b>Detalles Tareas </b></h5></center>
                        <div class="col-xs-12"><hr><br><br></div>
                        <center><h5><b> Confianza</b></h5></center>
                        <table id="tableComercial" class="table table-bordered" style="" >
                           <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                              <tr>
                                 <th style="text-align: center;">Fecha</th>
                                 <th style="text-align: center;">Hora</th>
                                 <th style="text-align: center;">Descripcion</th>
                                 <th style="text-align: center;">Actividad</th>
                                 <th style="text-align: center;">Resultado</th>
                                 <th style="text-align: center;">Estado</th>
                                 <th style="text-align: center;">Archivo</th>
                              </tr>
                           </thead>
                           <tbody id="detaConf">
                           </tbody>
                        </table>
                        <div class="col-xs-12"><br><br><hr></div>
                        <center><h5><b>Comunicacion</b></h5></center>
                        <table id="tableComercial" class="table table-bordered" style="" >
                           <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                              <tr>
                                 <th style="text-align: center;">Fecha</th>
                                 <th style="text-align: center;">Hora</th>
                                 <th style="text-align: center;">Descripcion</th>
                                 <th style="text-align: center;">Actividad</th>
                                 <th style="text-align: center;">Resultado</th>
                                 <th style="text-align: center;">Estado</th>
                                 <th style="text-align: center;">Archivo</th>
                              </tr>
                           </thead>
                           <tbody id="detaComun">
                           </tbody>
                        </table>
                        <div class="col-xs-12"><br><br><hr></div>
                        <center><h5><b>Cooperacion</b></h5></center>
                        <table id="tableComercial" class="table table-bordered" style="" >
                           <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                              <tr>
                                 <th style="text-align: center;">Fecha</th>
                                 <th style="text-align: center;">Hora</th>
                                 <th style="text-align: center;">Descripcion</th>
                                 <th style="text-align: center;">Actividad</th>
                                 <th style="text-align: center;">Resultado</th>
                                 <th style="text-align: center;">Estado</th>
                                 <th style="text-align: center;">Archivo</th>
                              </tr>
                           </thead>
                           <tbody id="detaCoop">
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <!--Footer-->
            
        </div>
        <!--/.Content-->
    </div>
</div>




<br>
<br>
<br>



















                           
                        </CENTER>
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
