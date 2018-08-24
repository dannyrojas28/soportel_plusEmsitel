<?php

    include "App/Views/includes/header.blade.php";
    $estado = "Internet";
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
                        

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="Public/js/toastr.js?n=1"></script>
<script src="App/Librarys/highcharts/highcharts.js?n=1"></script>
<script src="App/Librarys/highcharts/data.js?n=1"></script>
<script src="App/Librarys/highcharts/drilldown.js?n=1"></script>
<script src="Public/js/internet.js"></script>
<script>
eventInternet();
   conMax();
   selecCanalesContratados();
   AtencionClienteDetallesInternet();
   selecEspacio();
</script>

                    
<center><h1 style="color:#83a7ce" >AREA DE INTERNET</h1></center>
   <div class="row" style="margin-top: -10px; ">
      <div class="col-xs-12 col-md-4">
         <div id="contratoMaximo" style=" width: 100%; margin: 0 auto"></div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div id="contratoMinimo" style=" width: 100%; margin: 0 auto"></div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div id="EspacioUso" style=" width: 100%; margin: 0 auto"></div>
      </div>
      <div class="col-xs-12">
        <!--<iframe src="http://201.245.191.78/cacti/graph_image.php?local_graph_id=100" style="width:100%;height:100%"></iframe>-->
      </div>
      <a href="http://201.245.191.78/cacti/graph_image.php?local_graph_id=100" target="_blank">Ver Grafica de Switchs</a>
      <div class="col-xs-12 "><hr></div> 
      <!--<div class="col-xs-12 col-md-6">
         <div id="EspacioDisponible" style=" width: 100%; margin: 0 auto"></div>
      </div>-->
   </div>

   <div id="CanInCon"></div>



<div class="col-xs-12 "><br><hr><br></div>    
<div class="atencioCliente" style="margin-top: 20px; ">
   <center>
      <h3><b>Atencion al Cliente </b></h3>
   </center><br>
   <div class="col-xs-12 col-sm-1 col-md-1"></div>
      <div class="col-xs-12 col-sm-5 col-md-4" style="padding: 10px;">
         <p style="float: left;"> <b>Desde</b></p> 
         <input type="date" name="fechaInicioI" id="fechaInicioI" value="<?php echo date('Y-m-01'); ?>" style="width: 70%; float: right;">
      </div>
      <div class="col-xs-12 col-sm-5 col-md-4" style="padding: 10px; ">
         <p style="float: left;"> <b>Hasta </b></p>
         <input type="date" name="fechaFinI" id="fechaFinI" value="<?php echo date('Y-m-d'); ?>" style="width: 70%; float: right;">
      </div>
      <div class="col-xs-12 col-sm-1 col-md-3"> 
      <button class="btn btn-primary" id="AtencionCliente" onclick="AtencionClienteDetallesInternet()" > <i class="fa fa-search" aria-hidden="true"></i> <b>Consultar</b>  </button>
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
      </center>
   </div>
   <div class="col-xs-12 "><br><br></div> 
   <center>
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
         <nav id="pag" style="display: none;">
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
         </table>    <br><br><br>
    </center>        
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
