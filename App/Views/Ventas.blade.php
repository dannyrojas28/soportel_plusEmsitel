<?php

    include "App/Views/includes/header.blade.php";
    $estado = "Reventa";
    
    $mes = array('','enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
    $mes =  strtoupper($mes[date('n')]);

?>

<main onload="AtencionCliente()">
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
                            <br><br>
                             <style>
                                canvas {
                                    -moz-user-select: none;
                                    -webkit-user-select: none;
                                    -ms-user-select: none;
                                }
                            </style>


                            <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
                            <script src="App/Librarys/highcharts/highcharts.js?n=1"></script>
                            <script src="App/Librarys/highcharts/data.js?n=1"></script>
                            <script src="App/Librarys/highcharts/drilldown.js?n=1"></script>
                        
                            <script src="Public/js/ventas.js"></script>
                            <script type="text/javascript">
                               eventVentas();
                               setTimeout(function(){

                                    //FacturadoFecha()
                                  //  Minutos();
                                    //MinutosTodos();
                                    //CabinasInactivas();
                                    MantenimientosAtrasados();
                                    
                                    CabinasTotal();
                                    CabinasActivas();
                                    MantenimientosPendientes();
                                    MantenimientosProgramados();
                                    AtencionCliente();
                                },100);
                                
                            </script>


                            <div class="col-sm-12">
                                <center><h2>Cabinas Alianza JJpita</h2></center>
                                <h3>Ventas <span style="float:right;margin-right:0px;font-size:15px"><?php echo date('H:m a | d')." ".$mes." del ".date('Y');?></span></h3>
                                <hr>
                            </div>
                            <div class="col-sm-6">
                                <div id="canvas1"></div>
                            </div>
                            <div class="col-sm-6">
                                <div id="canvas3"></div>
                            </div>

                            <div class="col-sm-12">
                            <br><br>
                            </div>
                            <div class="col-sm-12">
                                <div id="canvas4"><center><img src="Public/img/loader.gif" style="width:10%"></center></div>
                            </div>

                           
                            <div class="col-sm-6">
                            <br><br>
                                <center><h3>Cabinas</h3></center>
                               
                                <hr>
                                <div class="col-md-12">

                                        <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                              <th>Total</th>
                                              <td id="total"></td>
                                            </tr>
                                            <tr>
                                              <th>Cabinas Activas</th>
                                              <td id="activas"></td>
                                            </tr>
                                            <tr data-toggle="modal" data-target="#modal-login"  class="table-danger" onclick=" DatosCabinasInactivas()">
                                              <th>Cabinas Inactivas</th>
                                              <td id="inactivas"></td>
                                              <td><i class="fa fa-eye "></i> Ver</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                             <div class="col-sm-6">
                            <br><br>
                                <center><h3>Mantenimiento de Cabinas</h3></center>
                                
                                <hr>

                                <div class="col-md-12">

                                        <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                              <th>Pendientes por Mantenimiento</th>
                                              <td id="p-pendientes"></td>
                                            </tr>
                                            <tr>
                                              <th>Mantenimientos Atrasados</th>
                                              <td id="p-atrasados"></td>
                                            </tr>
                                            <tr>
                                              <th>Por Programar</th>
                                              <td id="p-programados"></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <center><a class="btn btn-secondary btn-rounded" href="CalendarioCabinas">Ver Calendario <i class="fa fa-calendar  right"></i></a></center>
                                </div>
                            </div>


                           
<div class="atencioCliente" style="margin-top: 20px; ">
    <center>
        <h3><b>Atencion al Cliente</b></h3>
    </center><br>      
    <div class="col-xs-12 col-md-3"></div>

    <div class="col-xs-12 col-md-3" style="padding: 10px;">

        <p style="float: left;"> <b>Desde</b></p> 
        <input type="date" name="fechaInicio" id="fechaInicio" value="<?php echo date('Y-m-01'); ?>" style="width: 70%; float: right;">

    </div>
    <div class="col-xs-12 col-md-3" style="padding: 10px; ">

        <p style="float: left;"> <b>Hasta </b></p>
        <input type="date" name="fechaFin" id="fechaFin" value="<?php echo date('Y-m-d'); ?>" style="width: 70%; float: right;">

    </div>
    <div class="col-xs-12 col-md-3"> 
    <input type="hidden" id="limite" value="0">
    <input type="hidden" id="pagina" value="1">
    <button class="btn btn-primary" id="AtencionCliente" onclick="AtencionCliente()" > <i class="fa fa-search" aria-hidden="true"></i> <b>Consultar<b>  </button>

    </div>  


    <center>
        <table id="table" class="table table-bordered" style="text-align: center; margin: 0 auto; ">
            <thead  style="background:  gray; padding: 1em;">
                <tr>
                    <th style="text-align: center;">Cabina</th>
                    <th style="text-align: center;">Detalle</th>
                    <th style="text-align: center;">Responsable</th>
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Estado</th>     
                                
                </tr>
            </thead>
            <tbody id="cuerpo">

            </tbody>
            <nav>
                <ul class="pagination" style="float:right;right: 0px">
                <li class="page-item">
                  <a class="page-link"  aria-label="Previous" style="display: none" id="btprev" onclick="Prev()">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <li class="page-item"><a class="page-link" id="numpag"> Pagina 1</a></li>
                <li class="page-item">
                  <a class="page-link"  aria-label="Next" style="display: none" id="btnext" onclick="Next()">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>

        </table> <br><br><br>
        <table id="Detalles_table" class="table table-bordered" style="text-align: center; margin: 0 auto; width: 80%; ">
            <tr style="background-color: #a8a8a8; ">
                <th style="text-align: center;"> Tiempo Medio de Atencion</th>
                <th style="text-align: center;"> Asunto mas frecuente  </th> 
                <th style="text-align: center;"> Responsable mas eficiente </th>
                <th style="text-align: center;"> Cabina mas frecuente </th>
            </tr>
            <tr>
                <td style="text-align: center;" id="tiempo"></td>
                <td style="text-align: center;" id="AsuntoFrecuente"></td>
                <td style="text-align: center;" id="respon_Eficiente"></td>
                <td style="text-align: center;" id="cabinamasfrecuente"></td>
            </tr>
        </table>

        
    </center>
</div>                      
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
                        <!-- Modal Login -->
                        <div class="modal fade modal-ext" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <!--Content-->
                                <div class="modal-content">
                                   
                                    <!--Header-->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h3><i class="fa fa-power-off "></i> Cabinas Inactivas</h3>
                                    </div>
                                    
                                    <!--Body-->
                                    <div class="modal-body">
                                        <table class="table">
                                          <thead class="thead-default">
                                            <tr>
                                              <th>#</th>
                                              <th>Cabina</th>
                                              <th>Direccion</th>
                                            </tr>
                                          </thead>
                                          <tbody id="cabinasinactivastable">
                                          </tbody>
                                        </table>

                                    </div>
                                    
                                    <!--Footer-->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                                <!--/.Content-->
                            </div>
                        </div>


                    <?php
                    }else{
                    ?>
                        <CENTER>
                            <br><br>
                            <h1 style="color:#83a7ce">NO TIENES PERMISOS PARA VER ESTE MODULO</h1>
                                <img src="Public/img/acceso_denegado.png" style="width:200px">
                                <?php echo $_SESSION['tipo_rol'][$i]."...."; ?>
                        </CENTER>
                    <?php
                    }
                    ?>
                    
    
            </div>
        </div>
    </div>
</main>

   
