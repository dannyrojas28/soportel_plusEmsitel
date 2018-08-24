<?php

    include "App/Views/includes/header.blade.php";
    $estado = "Servicios";
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
                        
                            <br>
                            <center><h1 style="color:#83a7ce">AREA SERVICIOS </h1></center>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="Public/js/toastr.js?n=1"></script>
<script src="App/Librarys/highcharts/highcharts.js?n=1"></script>
<script src="App/Librarys/highcharts/data.js?n=1"></script>
<script src="App/Librarys/highcharts/drilldown.js?n=1"></script>
<script src="Public/js/nube.js"></script>
<script>
   eventServicios();
   totalUsuarios(); 
   totalEspacio();
   licencia();
   estadoServicio();
   AtencionClienteDetallesNube();
</script>

<div class="col-xs-12 "><br><hr><br></div>

<div class="col-xs-12">
   <h2><center><b>Virtualización</b></center></h2><br>   
   <div class="col-xs-12 col-md-6" >
      <div class="col-xs-9" style="border: 1px solid #efe8e8">
        <h5>Maquinas Virtuales activas</h5>
        <h2 id="maquinasVirtuales"></h2>
        <a href="" style="float: right; margin-right: 10px; font-size: 20px; background-color: #fff; color: #212121; " data-toggle="modal" data-target="#modal-login"  class="table-danger" onclick="pgVMInctivas()" ><u>Ver Inactivas</u></a>
         <div class="modal fade modal-ext" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                     <h3><i class="fa fa-power-off "></i> Maquinas Inactivas</h3>
                  </div>
                  <div class="modal-body">
                     <table class="table">
                        <thead class="thead-default">
                           <tr>
                              <th>#</th>
                              <th>Nombre</th>
                           </tr>
                        </thead>
                        <tbody id="maquinasVirInactivas">
                        </tbody>
                     </table>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
               </div>
            </div>
         </div>
         
      </div>
   </div>
   <div class="col-sm-6">
      <div class="col-md-12">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Hosts</th>
                  <th>Estado</th>
                  <th>No. VMs</th>
               </tr>
            </thead>
            <tbody id="cuerpoHostServNube">
               
            </tbody>
         </table>
      </div>
   </div>
</div>

<div class="col-xs-12 "><br><hr><br></div>

<div class="col-xs-12">
   <h2><center><b>Almacenamiento</b></center></h2><br><br>

   <div class="col-md-5" id="unoDatos" style="border: 1px solid #efe8e8; display: none;" >
      <div class="col-xs-12">
         <div id="dominioDatosUno"></div>
      </div>
      <div class="col-xs-12">
         <div ><center><h5 id="totalDominioUno"></h5></center></div>
      </div>
   </div>
   <div class="col-md-5 col-md-offset-1" id="dosDatos" style="border: 1px solid #efe8e8; display: none;" >
      <div class="col-xs-12">
         <div id="dominioDatosDos"></div>
      </div>
      <div class="col-xs-12">
         <div ><center><h5 id="totalDominioDos"></h5></center></div>
      </div>
   </div>
   <div class="col-xs-12 "><br><br></div>
   <div class="col-md-5" id="tresDatos" style="border: 1px solid #efe8e8; display: none;" >
      <div class="col-xs-12">
         <div id="DominioExport"></div>
      </div>
      <div class="col-xs-12">
         <div ><center><h5 id="totalDominioExport"></h5></center></div>
      </div>
   </div>
   <div class="col-md-5 col-md-offset-1" id="cuatroDatos" style="border: 1px solid #efe8e8; display: none;" >
      <div class="col-xs-12">
         <div id="DominioISO"></div>
      </div>
      <div class="col-xs-12">
         <div ><center><h5 id="totalDominioISO"></h5></center></div>
      </div>
   </div>
   <div class="col-xs-12 "><br><br></div>
   <div class="col-md-5" id="cincoDatos" style="border: 1px solid #efe8e8; display: none;" >
      <div class="col-xs-12">
         <div id="cincoDatos"></div>
      </div>
      <div class="col-xs-12">
         <div ><center><h5 id="totalCincoDatos"></h5></center></div>
      </div>
   </div>
   <div class="col-md-5 col-md-offset-1" id="seisDatos" style="border: 1px solid #efe8e8; display: none;" >
      <div class="col-xs-12">
         <div id="seisDatos"></div>
      </div>
      <div class="col-xs-12">
         <div ><center><h5 id="totalSeis"></h5></center></div>
      </div>
   </div>

</div>


<div class="col-xs-12 "><br><br><hr><br></div>
<div class="col-xs-12">
   <h2><center><b>Almacenamiento Seguro de Respaldo ASR</b></center></h2>
   <div class="col-xs-12 col-md-4" style="padding: 50px 50px 0px 0px">
      <table class="table table-bordered">
         <thead>
            <tr style="background-color: #dadada">
               <th >Total Usuarios</th>
               <td id="totalUser"></td>
            </tr>
         </thead>
         <tbody id="tUsuarios">
            
         </tbody>
      </table>   
   </div>
   <div class="col-xs-12 col-md-7 " style="padding: 30px; ">
      <div id="totalEspacio"></div>
   </div>

   <div class="col-xs-12 "><br><hr><br></div>

   <div class="col-xs-12 col-md-7">
      <div class="col-xs-12">
         <div id="datosEspEspacio">
         </div>
      </div>   
   </div>

   <div class="col-xs-12 col-md-5 " >
      <table class="table " width="90%">
         <thead>
            <tr style="background-color: #dadada">
               <th colspan="2"><center><h3><b>ESTADO SERVICIO</b></h3></center></th>
            </tr>
         </thead>
         <tbody id="tUsuarios">
            <tr>
               <td>Servicio Principal</td>
               <td><span id="principal"></span></td>
            </tr>
            <tr>
               <td>Servicio Réplica</td>
               <td><span id="replica"></span></td>
            </tr>
            <tr>
               <td>Vencimiento Licencia</td>
               <td> <span id="vencLiencia"></span></td>
            </tr>
            <tr>
               <td>Ultimo Pago</td>
               <td><span id="ultPago"></span></td>
            </tr>
            <tr>
               <td>Valor</td>
               <td><span id="valLicencia"></span></td>
            </tr>
         </tbody>
      </table>   

   </div>
   
</div>





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
         <button class="btn btn-primary" id="AtencionCliente" onclick="AtencionClienteDetallesNube()" > <i class="fa fa-search" aria-hidden="true"></i> <b>Consultar</b>  </button>
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
     <script src="Public/js/nube.js"></script>
     <script type="text/javascript">
         pgVMActivas();
         pgVMInctivas();
         pgHosts();
         pgAlmacenamiento();
     </script>
</main>
