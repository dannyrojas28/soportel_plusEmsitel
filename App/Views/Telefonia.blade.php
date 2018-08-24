<?php

    include "App/Views/includes/header.blade.php";
    $estado = "Telefonia";
?>

<main>
<input type="hidden" id="estadoemsi" value="telefonia">

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
                   

                     <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
                     <script src="Public/js/toastr.js?n=1"></script>
                     <script src="App/Librarys/highcharts/highcharts.js?n=1"></script>
                     <script src="App/Librarys/highcharts/data.js?n=1"></script>
                     <script src="App/Librarys/highcharts/drilldown.js?n=1"></script>
                     <script src="Public/js/telefonia.js"></script>
                     <script>
                        //selectFreePBX();
                        eventTelefonia();
                        canales();
                        todofacturacion();
                        saldoRecargas();
                        AtencionClienteDetallestelefonia();
                     </script>
<br>
<center><h1 style="color:#83a7ce" >AREA DE TELEFONÍA</h1></center>


<div class="contenedor" style="margin-top: 30px; padding: 20px 30px; text-align: center;">
   <div class="row">
      <div class="col-xs-12 "  >
         <center><h3><b>PBX</b></h3></center>
         <div class="col-xs-12">
            <div class="pbx" >
               <div class="col-sm-6">
                  <div id="ip_dreamPBX" style="width: 100%; height: 250px;  "><img src="Public/img/loader.gif" style="width:20%">   </div>
               </div>
               <div class="col-xs-6">
                  <div id="ip_freePBX" style="width: 100%; height: 250px;  "><img src="Public/img/loader.gif" style="width:20%"></div>
               </div>  <div class="col-md-5"></div>
               <div class="col-xs-12 col-md-3 " style="margin-top: -70px; float: left; margin-left: -20px;  ">
                  <center>
                     <div id="activos" style="float: left;"> <img src="Public/img/activo.png" alt=""> Activos</div>
                     <div id="activos" style="float: right;"> <img src="Public/img/inactivos.png" alt=""> Inactivos</div>
                  </center>
               </div> 
            </div>            
         </div><br>
            <center><h3><b>CANALES</b></h3></center>
         <div class="col-xs-12 col-md-9 col-md-offset-2" >
            <div id="canalesGra"><img src="Public/img/loader.gif" style="width:20%; margin-top: 20px; "></div>    
            <div class="col-xs-12" style="display: none;">
               <table id="datatable" border="1">
                  <thead>
                     <tr>
                       <th></th>
                       <th>Activos</th>
                       <th>Inactivos</th>
                     </tr>
                  </thead>
                  <tbody id="canalesTable"></tbody>
               </table>   
            </div>
         </div>
      </div>


      <div class="col-xs-12 "><br><hr><br><br></div> 
      <div class="col-xs-12">
         <h3><b>Saldo recargas</b></h3>
         <div class="col-xs-12">
            <table id="tableRecargas" class="table table-bordered" style="text-align: center; margin: 0 auto; width: 90%; ">
               <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                  <tr >
                     <th style="text-align: center;">Proveedor</th>
                     <th style="text-align: center;">Saldo</th>
                     <th style="text-align: center;">Fecha Actualizacion</th>
                  </tr>
               </thead>
               <tbody id="cuerpoRecargasT">
               </tbody>
            </table> 
         </div>         
      </div>
      <div class="col-xs-12 "><br><hr><br></div> 
      <div class="col-xs-12">
         <h3><b> Facturación por Proveedor.</b></h3>
         <table id="tablefacturacion" class="table table-bordered" style="text-align: center; margin: 0 auto; ">
            <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
               <tr >
                  <th style="text-align: center;">Proveedor</th>
                  <th style="text-align: center;">Valor</th>
                  <th style="text-align: center;">Fecha Limite</th>
                  <th style="text-align: center;">Estado</th>     
               </tr>
            </thead>
            <tbody id="cuerpofacturacion">
            </tbody>
         </table> 
      </div>

<!--modal actualizar factura-->
<button style="display: none;" type="button" id="estado-facturacion" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#estadofacturacion"></button>
  <div class="modal fade" id="estadofacturacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding: 20px; ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <center><h5 class="modal-title" id="myModalLabel"> <i class="fa fa-copy"></i> <b> Detalles Facturacion</b></h5></center>
        </div>
        <div class="modal-body" style="text-align: center;">
          <input type="hidden" id="cod" name="cod">
          <p style="font-size: 15px; "><b> Provedor: </b>  </p> 
          <input type="text" id="proveedorFa" name="proveedorFa" style="padding: 2px; width: 85%; border: 1px solid #e0d7d7" >
          <p style="font-size: 15px; "><b> Valor: </b> </p> 
          <input type="text" id="valor" name="valor" style="padding: 2px; width: 85%; border: 1px solid #e0d7d7" >
          <p style="font-size: 15px; "><b> Fecha Limite </b> </p>
          <input type="date" id="fecha" name="fecha" style="padding: 2px; width: 85%; border: 1px solid #e0d7d7"  >
          <p style="font-size: 15px; "><b>Estado</b></p>
          <center>
            <select id="estado" name="estado"  class="form-control" style="width: 85%; padding: 7px;  "  >
              <option value="2" id="pend" >Pendiente</option>         
              <option value="1" id="pago" >Pagado</option>
            </select>
          </center><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalActualizar">Actualizar</button> 
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="cerrarFacturacion" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade ModalActualizar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 130px;  ">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="padding: 50px; background: #3b3b3b;  ">
        <h2 style="color: #fff;  text-align: center;">¿Éstas seguro de Actualizar el Registro?</h2>
        <br><br><br><br>
        <center>
         <button type="hidden" id="update" name="update" onclick="updatefacturacionBanco()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
         <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
         </center>       
      </div>
    </div>
  </div>
  
<div class="col-xs-12 "><br><hr><br></div> 
<div class="col-xs-12">   
   <div class="atencioCliente" style="margin-top: 20px; ">
      <center>
         <h3><b>Atencion al Cliente </b></h3>
      </center><br>
      <div class="col-xs-12 col-sm-1 col-md-1"></div>
      <div class="col-xs-12 col-sm-5 col-md-4" style="padding: 10px;">
         <p style="float: left;"> <b>Desde</b></p> 
         <input type="date" name="fechaInicio" id="fechaInicio" value="<?php echo date('Y-m-01'); ?>" style="width: 70%; float: right;">
      </div>
      <div class="col-xs-12 col-sm-5 col-md-4" style="padding: 10px; ">
         <p style="float: left;"> <b>Hasta </b></p>
         <input type="date" name="fechaFin" id="fechaFin" value="<?php echo date('Y-m-d'); ?>" style="width: 70%; float: right;">
      </div>
      <div class="col-xs-12 col-sm-1 col-md-3">
         <button class="btn btn-primary" id="AtencionCliente" onclick="AtencionClienteDetallestelefonia()" > <i class="fa fa-search" aria-hidden="true"></i> <b>Consultar</b>  </button>
      </div>
      <div id="detalles">
         <center>
            <table id="Detalles_table" class="table table-bordered" style="text-align: center; margin: 0 auto; ">
               <tr style="background-color: #a8a8a8;">
                  <th style="text-align: center;"> Tiempo Medio de Atencion</th>
                  <th style="text-align: center;"> Asunto mas frecuente  </th> 
                  <th style="text-align: center;"> Responsable mas eficiente </th>
               </tr>
               <tr>
                  <td id="tiempo"></td>
                  <td id="AsuntoFrecuenteTel"></td>
                  <td id="resp_Ef_ente"></td>
               </tr>
            </table>
            <div class="col-xs-12 "><br><br></div> 
            <table id="table" class="table table-bordered" style="text-align: center; margin: 0 auto; ">
               <thead  style="background:  gray; padding: 1em;">
                  <tr>
                     <th style="text-align: center;">Cliente</th>
                  <th style="text-align: center;">Asunto</th>
                  <th style="text-align: center;">Responsable</th>
                  <th style="text-align: center;">Fecha</th>
                  <th style="text-align: center;">Estado</th>
                  </tr>
               </thead>
               <tbody id="cuerpo">
               </tbody>
            </table>
         </center>
      </div>
   </div>
</div>   
      
     
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
