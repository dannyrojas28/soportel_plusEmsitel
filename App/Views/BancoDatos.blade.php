<?php

    include "App/Views/includes/header.blade.php";

    require_once 'App/Controllers/PrincipalController.php';
    require_once 'Config/vars.php';

      //inicializo el controlador Principal
      $PrincipalController = new PrincipalController();  
    $estado = "BancoDatos";
    $estado1 = "Comercial";
    $estado2 = "Contabilidad";
    $estado3 = "Emsivoz";
    $estado4 = "Internet";
    $estado5 = "Servicios";
    $estado6 = "Telefonia";
    $estado7 = "Reventa";
    


?>



<main>
    <div class="main-wrapper">
        <div class="container-fluid">
            <div class="row">
                    <!--Main column-->
                    <?php
                    $com = false;
                    $con = false;
                    $ems = false;
                    $int = false;
                    $ser = false;
                    $tel = false;
                    $rev = false;
                    $roles= count($_SESSION['tipo_rol']);
                    $pag = false;
                    for ($i=0; $i < $roles; $i++) { 
                        if($_SESSION['tipo_rol'][$i] == $estado1 || $_SESSION['tipo_rol'][$i] ==  "ADMINISTRADOR"){
                          $com = true;
                        }
                        if($_SESSION['tipo_rol'][$i] == $estado2 || $_SESSION['tipo_rol'][$i] ==  "ADMINISTRADOR"){
                          $con = true;
                        }
                        if($_SESSION['tipo_rol'][$i] == $estado3 || $_SESSION['tipo_rol'][$i] ==  "ADMINISTRADOR"){
                          $ems = true;
                        }
                        if($_SESSION['tipo_rol'][$i] == $estado4 || $_SESSION['tipo_rol'][$i] ==  "ADMINISTRADOR"){
                          $int = true;
                        }
                        if($_SESSION['tipo_rol'][$i] == $estado5 || $_SESSION['tipo_rol'][$i] ==  "ADMINISTRADOR"){
                          $ser = true;
                        }
                        if($_SESSION['tipo_rol'][$i] == $estado6 || $_SESSION['tipo_rol'][$i] ==  "ADMINISTRADOR"){
                          $tel = true;
                        }
                        if($_SESSION['tipo_rol'][$i] == $estado7 || $_SESSION['tipo_rol'][$i] ==  "ADMINISTRADOR"){
                          $rev = true;
                        }
                          $cod = $_SESSION['tipo_rol'][$i];
                            $pag = true;   
                        
                    }
                        if($com == true){
                          echo '<input type="hidden" value="comercial" id="estadoUsuariocom">';
                        }else{
                          echo '<input type="hidden" value="false" id="estadoUsuariocom">';
                        }
                        if($con == true){
                          echo '<input type="hidden" value="contabilidad" id="estadoUsuariocon">';
                        }else{
                          echo '<input type="hidden" value="false" id="estadoUsuariocon">';
                        }
                        if($ems == true){
                          echo '<input type="hidden" value="emsivoz" id="estadoUsuarioems">';
                        }else{
                          echo '<input type="hidden" value="false" id="estadoUsuarioems">';
                        }
                        if($int == true){
                          echo '<input type="hidden" value="internet" id="estadoUsuarioint">';
                        }else{
                          echo '<input type="hidden" value="false" id="estadoUsuarioint">';
                        }
                        if($ser == true){
                          echo '<input type="hidden" value="servicios" id="estadoUsuarioser">';
                        }else{
                          echo '<input type="hidden" value="false" id="estadoUsuarioser">';
                        }
                        if($tel == true){
                          echo '<input type="hidden" value="telefonia" id="estadoUsuariotel">';
                        }else{
                          echo '<input type="hidden" value="false" id="estadoUsuariotel">';
                        }
                        if($rev == true){
                          echo '<input type="hidden" value="reventa" id="estadoUsuariorev">';
                        }else{
                          echo '<input type="hidden" value="false" id="estadoUsuariorev">';
                        }
                    if($pag == true){

                     
                    ?>


                    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
                    <script src="Public/js/toastr.js?n=1"></script>
                    <script src="App/Librarys/highcharts/highcharts.js?n=1"></script>
                    <script src="App/Librarys/highcharts/data.js?n=1"></script>
                    <script src="App/Librarys/highcharts/drilldown.js?n=1"></script>
                    <script src="Public/js/bancoDatos.js"></script>
                    <script>
                        //telefonia()
                        //call()
                    </script>


   <div class="contenedor">
      <div class="col-sm-1">
         <div class="botonBanco" style="margin-top: 40px; margin-left: -50px; position: fixed;" >
            <?php
               include "App/Views/includes/btn-banco.blade.php";
            ?>
         </div>        
      </div>

      <div class="col-md-10 col-md-offset-1" align="center" >
         <div class="header">
            <div class="col-sm-8">
               <center><h2 style=" margin-top: 20px;  margin-right: -50px;"><b> Banco de Datos <span id="detallePais"></span> </b></h2></center><br><br>
            </div>
            <div class="col-sm-4" style="margin-top: 100px;">
               <select name="pais" id="pais" class="browser-default" class="form-control" style="width: 200px; display: none; margin-top: 0px;  border-radius: 2px;  padding: 10px;  " required onchange="Balance()">
                  <option value="1" selected>Colombia</option>
                  <option value="2">Venezuela</option>     
                  <option value="3">Estados Unidos</option>     
               </select>
            </div>            
         </div>
         <div class="botones" style="padding-right: 130px;" >
            <div class="col-xs-12">
               <center>
                  <div id="comercial" style="display: none; ">
                     <button type="button" class="btn btn-warning" id="con_comercial" onclick="contactosComercial()" >Contactos</button>
                  </div> 
                  <div id="serviciosNube" style="display: none; ">
                     <button type="button" class="btn btn-warning" id="BclientesNube" onclick="clienteNube()" > Clientes</button>
                     <button type="button" class="btn btn-warning" id="Usuarios" onclick="usuariosNube()" >Usuarios</button>
                     <button type="button" class="btn btn-warning" id="licencia" onclick="licenciaNube()" >licencia</button>
                  </div> 
                  <div id="telefonia" style="display: none; "> 
                     <button type="button" class="btn btn-warning" id="canalesB" onclick="canales()" > Canales </button>
                     <button type="button" class="btn btn-warning" id="DreamPBX" onclick="dreamPBX()" > DreamPBX </button>
                     <button type="button" class="btn btn-warning" id="FreePBX" onclick="freePBX()">FreePBX</button>
                     <button type="button" class="btn btn-warning" id="recargas" onclick="recargas()" >Recargas</button>
                     <button type="button" class="btn btn-warning" id="facturacionID" onclick="facturacion()" >Facturacion</button>  
                  </div>
                  <div id="internet" style="display: none; ">
                     <button type="button" class="btn btn-warning" id="Web" onclick="canalesContratados()" > Canales</button>
                     <button type="button" class="btn btn-warning" id="AppStore" onclick="EspacioUsado()" >Espacio Usado</button>
                  </div> 
                  <div id="emsivoz" style="display: none; ">
                     <button type="button" class="btn btn-warning" id="Web" onclick="Web()" > Web </button>
                     <button type="button" class="btn btn-warning" id="PlayStore" onclick="PlayStore()">PlayStore</button>
                     <button type="button" class="btn btn-warning" id="AppStore" onclick="AppStore()" >AppStore</button>
                     <button type="button" class="btn btn-warning" id="Campanna" onclick="Campanna()" >Campaña</button>  
                  </div> 
                  <div id="ventas" style="display: none; ">
                     <button type="button" class="btn btn-warning" id="Web" onclick="selectMeta()" > Meta </button>
                  </div>
               </center> 
            </div>
         </div>
         <br><br><br>
         <div class="body">
            <div class="col-xs-12">
               <div class="imgBanco" style="padding-right: 200px; "><img src="Public/img/banco.png" id="banco" >
               </div>
               <input type="hidden" id="estadoUsuario" value="<?php echo $cod ?>">
               <br><br>
                  

               <div id="contactos_Comercial"  style="display: none;">
                  <div class="row">
                     <div class="col-xs-12 col-md-9">
                        <center id="titleComercial"><h2>Gestion Contactos</h2></center>
                     </div>
                     <div class="col-xs-12 col-md-3">
                        <button id="btn-regis-comercial" class="btn btn-primary btn-md" onclick="registroContComercial()" style="font-size: 20px;  ">Registrar </button>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xs-20" style="margin-left: -100px; overflow-x:scroll ; overflow-y: scroll; ">
                        <table id="tableComercial" class="table table-bordered" style="float: left;/*margin-left: -100px;*/ overflow-x:scroll ; overflow-y: scroll; " >
                           <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                              <tr>
                              <th style="text-align: center;">Ver</th>
                              <th style="text-align: center;">Cliente</th>
                              <th style="text-align: center;">Tipo</th>
                              <th style="text-align: center;">Sector</th>
                              <th style="text-align: center;">Servicio</th>
                              <th style="text-align: center;">Competencia</th>
                              <th style="text-align: center;">Asesor</th>
                              <th style="text-align: center;">Confianza</th>
                              <th style="text-align: center;">Comunicacion</th>
                              <th style="text-align: center;">Cooperacion</th>
                              <th colspan="2" style="text-align: center;">Opciones</th>
                              </tr>
                           </thead>
                           <tbody id="cuerpoGestionCo">
                           </tbody>
                        </table>
                     </div>
                     <div class="col-xs-10">
                        <div id="ContenRegistroContComercial" class="container" style="display: none;">
                        <div class="col-xs-12">
                           <div class="col-xs-2">
                              <button style="float: left;" class="btn btn-warning" onclick="volverComercial()"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
                           </div>
                           <div class="col-xs-10"><h3><b>Registro Usuario</b></h3></div>
                        </div>
                        
                           <form action="" method="post">
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Nombre Cliente</b></h6>
                              <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="nomb_gest" name="nomb_gest" placeholder="Ingrese Nombre">
                           </div>   
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Tipo Cliente</b></h6>
                              <select name="tipo_cliente" id="tipo_cliente" class="browser-default" class="form-control" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf">
                                 <option value="Persona" selected>Persona</option>
                                 <option value="Empresa">Empresa</option>     
                              </select>
                           </div>
                           <div class="col-xs-12"><br><hr></div>
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Sector Económico</b></h6>
                              <select id="sector_economico" name="sector_economico" class="browser-default" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf">
                                  <option value="">Seleccionar..</option>
                                  <?php
                                     $selecteco =$PrincipalController->ComercialSectorEconomico();
                                     while ($res = mysqli_fetch_object($selecteco)) {
                                       # code...
                                        echo '<option value="'.utf8_encode($res->categoria).'">'.utf8_encode($res->categoria).'</option>';
                                     }
                                  ?>
                              </select>
                           </div>
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Servicio</b></h6>
                              
                                  <?php
                                     $selecteco =$PrincipalController->ComercialServicios();
                                     $i=1;
                                     while ($res = mysqli_fetch_object($selecteco)) {
                                       # code...
                                        echo '
                                                <input type="hidden" name="tiposervicio'.$i.'" id="tiposervicio'.$i.'" value="'.utf8_encode($res->tipo_servicio).'"> 
                                                <br><div class="form-group col-xs-12" style="float:left;text-align:left;margin-bottom:0px"> 
                                                <input type="checkbox" onclick="selectSubservicio('.$res->cod_ser.')" name="servicio'.$i.'" id="servicio'.$i.'" value="'.utf8_encode($res->tipo_servicio).'">
                                                <label for="servicio'.$i.'">'.utf8_encode($res->tipo_servicio).'</label>
                                              </div>';
                                              $i+=1;
                                     }
                                     $i=$i - 1;
                                     echo '<input type="hidden" name="num_services" id="num_services" value="'.$i.'">';
                                  ?>
                           </div>


                           <div class="col-xs-12"><br><hr></div>
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Competencia</b></h6>
                              <select id="competecia_gestion" name="competecia_gestion" class="browser-default" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf">
                                  <option value="">Seleccionar..</option>
                                  <?php
                                     $selecteco =$PrincipalController->ComercialCompetencia();
                                     while ($res = mysqli_fetch_object($selecteco)) {
                                       # code...
                                        echo '<option value="'.utf8_encode($res->categorias).'">'.utf8_encode($res->categorias).'</option>';
                                     }
                                  ?>
                              </select>
                           </div>
                           <div class="col-xs-12 col-md-6">
                              <h6><b> Asesor Comercial</b></h6>
                              <select id="asesor_comercial" name="asesor_comercial" class="browser-default" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf">
                                  <option value="">Seleccionar..</option>
                                  <?php
                                     $selecteco =$PrincipalController->ComercialAsesores();
                                     while ($res = mysqli_fetch_object($selecteco)) {
                                       # code...
                                      $name=utf8_encode($res->name);
                                        echo '<option value="'.$res->cod.'">'.$name.'</option>';
                                     }
                                  ?>
                              </select>
                           </div>
                           <div class="col-xs-12"><br><hr></div>
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Fase de Atencion</b></h6>
                              <select name="fase_atencion" id="fase_atencion" class="browser-default" class="form-control" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf">
                                 <option value="Confianza" selected>Confianza</option>
                              </select>
                           </div>
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Fecha Registro</b></h6>
                              <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="date" id="fecha_registro" name="fecha_registro" value="<?php echo date('Y-m-d');?>">
                           </div>
                           <div class="col-xs-12"><br>
                              <center>
                                 <button type="button" id="Insercontacto" name="Insercontacto" onclick="insertGestionContacComercia()" class="btn btn-success btn-md"  >Registrar</button>
                                 <input type="reset" id="reset_insert_Contacto" name="reset" class="btn btn-danger" value="reset" style="display: none;">
                              </center>                              
                           </div>
                           </form>
                        </div>
                     </div>

                     <div class="col-xs-10">
                        <div id="ContenUpdateContComercial" class="container" style="display: none;">
                        <div class="col-xs-12">
                           <div class="col-xs-2">
                              <button style="float: left;" class="btn btn-warning" onclick="volverComercial()"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
                           </div>
                           <div class="col-xs-10"><h3><b>Actualizar Usuario</b></h3></div>
                        </div>
                        
                           <form action="" method="post">
                           <div class="col-xs-12 col-md-6">
                              <input type="number" id="id_codGestion" style="display: none;">
                              <input type="text" id="val_update" style="display: none;">
                              <h6><b>Nombre Cliente</b></h6>
                              <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="nomb_gestU" name="nomb_gestU" placeholder="Ingrese Nombre">
                           </div>   
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Tipo Cliente</b></h6>
                              <select name="tipo_clienteU" id="tipo_clienteU" class="browser-default" class="form-control" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf">
                                 <option id="personaOpt" value="Persona" selected>Persona</option>
                                 <option id="empresaOpt" value="Empresa">Empresa</option>     
                              </select>
                           </div>
                           <div class="col-xs-12"><br><hr></div>
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Sector Económico</b></h6>
                              <select id="sector_economicoU" name="sector_economicoU" class="browser-default" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf">
                                  <option value="">Seleccionar..</option>
                                  <?php
                                     $selecteco =$PrincipalController->ComercialSectorEconomico();
                                     while ($res = mysqli_fetch_object($selecteco)) {
                                       # code...
                                        echo '<option value="'.utf8_encode($res->categoria).'">'.utf8_encode($res->categoria).'</option>';
                                     }
                                  ?>
                              </select>
                           </div>
                           <div class="col-xs-12"><br><hr></div>
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Servicio</b></h6>
                              
                                  <?php
                                     $selecteco =$PrincipalController->ComercialServicios();
                                     $i=1;
                                     while ($res = mysqli_fetch_object($selecteco)) {
                                       # code...
                                        echo '
                                                <input type="hidden" name="tiposervicio'.$i.'U" id="tiposervicio'.$i.'U" value="'.utf8_encode($res->tipo_servicio).'"> 
                                                <br><div class="form-group col-xs-12" style="float:left;text-align:left;margin-bottom:0px"> 
                                                <input type="checkbox" name="servicio'.$i.'U" id="servicio'.$i.'U" value="'.utf8_encode($res->tipo_servicio).'"> 
                                                <label for="servicio'.$i.'U">'.utf8_encode($res->tipo_servicio).'</label>
                                              </div>';
                                              $i+=1;
                                     }
                                     $i=$i - 1;
                                     echo '<input type="hidden" name="num_servicesU" id="num_servicesU" value="'.$i.'">';
                                  ?>


                           </div>

                           <div class="col-xs-12 col-md-6">
                              <h6><b>Subservicios</b></h6>
                              
                                  <?php
                                     $selecteco =$PrincipalController->ComercialSubervicios();
                                     $i=1;
                                     while ($res = mysqli_fetch_object($selecteco)) {
                                       # code...
                                        echo '
                                                <input type="hidden" name="nomSubservicio'.$i.'U" id="nomSubservicio'.$i.'U" value="'.utf8_encode($res->nom_subservicio).'"> 
                                                <br><div class="form-group col-xs-12" style="float:left;text-align:left;margin-bottom:0px"> 
                                                <input type="checkbox" name="subservicio'.$i.'U" id="subservicio'.$i.'U" value="'.utf8_encode($res->nom_subservicio).'"> 
                                                <label for="subservicio'.$i.'U">'.utf8_encode($res->nom_subservicio).'</label>
                                              </div>';
                                              $i+=1;
                                     }
                                     $i=$i - 1;
                                     echo '<input type="hidden" name="num_subservicesU" id="num_subservicesU" value="'.$i.'">';
                                  ?>


                           </div>

                           <div class="col-xs-12"><br><hr></div>
                           <div class="col-xs-12 col-md-6">
                            <h6><b>¿Qué lo atrajo?</b></h6>
                            <textarea name="positive" id="positive" style="height: 100px;" rows="10" cols="40">Cosas Positivas...</textarea>
                          <!--  <input style="width: 95%; height: 100px; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="positive" name="positive" size="50" placeholder="Cosas Positivas..."> -->
                           </div>

                           <div class="col-xs-12 col-md-6">
                            <h6><b>Dudas</b></h6>
                            <textarea name="dudas" id="dudas" style="height: 100px;" rows="10" cols="40">¿Alguna Duda?</textarea>
                          <!--  <input style="width: 95%; height: 100px; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="dudas" name="dudas" size="50" placeholder="¿Alguna Duda?"> -->
                           </div>

                           <div class="col-xs-12"><br><hr></div>
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Competencia</b></h6>
                              <select id="competecia_gestionU" name="competecia_gestionU" class="browser-default" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf">
                                  <option value="">Seleccionar..</option>
                                  <?php
                                     $selecteco =$PrincipalController->ComercialCompetencia();
                                     while ($res = mysqli_fetch_object($selecteco)) {
                                       # code...
                                        echo '<option value="'.utf8_encode($res->categorias).'">'.utf8_encode($res->categorias).'</option>';
                                     }
                                  ?>
                              </select>
                           </div>
                           <div class="col-xs-12 col-md-6">
                              <h6><b> Asesor Comercial</b></h6>
                              <select id="asesor_comercialU" name="asesor_comercialU" class="browser-default" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf">
                                  <option value="">Seleccionar..</option>
                                  <?php
                                     $selecteco =$PrincipalController->ComercialAsesores();
                                     while ($res = mysqli_fetch_object($selecteco)) {
                                       # code...
                                      $name=utf8_encode($res->name);
                                        echo '<option value="'.$res->cod.'">'.$name.'</option>';
                                     }
                                  ?>
                              </select>
                           </div>
                           <div class="col-xs-12"><br><hr></div>
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Fase de Atencion</b></h6>
                              <select name="fase_atencionU" id="fase_atencionU" class="browser-default" class="form-control" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf"> </select>
                           </div>
                           <div class="col-xs-12 col-md-6">
                              <h6><b>Fecha Registro</b></h6>
                              <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="date" id="fecha_registroU" name="fecha_registroU" readonly="readonly" >
                           </div>
                           <div class="col-xs-12">
                              <div id="optCooperacion" style="display: none;" >
                                 <div class="col-xs-12"><br><hr></div>
                                 <div class="col-xs-12 col-md-6">
                                    <h6><b>Monto</b></h6>
                                    <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="monto_gestionU" name="monto_gestionU" onKeyPress="return acceptNum(event)">
                                 </div>
                                 <div class="col-xs-12 col-md-6">
                                    <h6><b>Negocio Exitoso</b></h6>
                                    <select name="negocioExitoU" id="negocioExitoU" class="browser-default" class="form-control" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf">
                                       <option value="SI">SI</option>
                                       <option value="NO" >NO</option>
                                       <option value="EN PROCESO" >EN PROCESO</option>
                                    </select>
                                 </div>
                              </div>
                           </div>  

                          
                          </form>
                           <div class="col-xs-12" id="content_agregarTarea" style="display: none;">
                           <form action="" method="post">
                              <div class="col-xs-12"><br><hr></div>
                              <div class="col-xs-12">
                                 <center><b>
                                       <h5>Registro Tarea</h5>
                                    </b></center>
                              </div>
                              <div class="col-xs-12 col-md-6">
                                 <h6><b>Fecha</b></h6>
                                 <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="date" id="fecha_Tarea" name="fecha_Tarea" value="<?php echo date('Y-m-d');?>">
                              </div>
                               <div class="col-xs-12 col-md-6">
                                 <h6><b>Hora</b></h6>
                                 <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="time" id="hora_Tarea" name="hora_Tarea" value="<?php echo date('h:i:s');?>">
                              </div>
                              <div class="col-xs-12"><br></div>
                              <div class="col-xs-12 col-md-6">
                                 <h6><b>Descripcion</b></h6>
                                 <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="descripcionTarea" name="descripcionTarea" >
                              </div>
                              <div class="col-xs-12 col-md-6">
                                 <h6><b>Actividad</b></h6>
                                 <select name="actividadTarea" id="actividadTarea" class="browser-default" class="form-control" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf">
                                    <option value="0" selected></option>
                                    <option value="Entrevista Personal">Entrevista Personal</option>
                                    <option value="Llamada Telefonica">Llamada Telefonica</option>     
                                    <option value="Estudio de Sitio">Estudio de Sitio</option>     
                                    <option value="Correo Electronico">Correo Electronico</option>     
                                    <option value="Correo Electronico">Redes Sociales</option>     
                                 </select>
                              </div>
                              <div class="col-xs-12"><br></div>

                              <div class="col-xs-12 col-md-6">
                                 <h6><b>Resultado</b></h6>
                                 <select name="resultadoTarea" id="resultadoTarea" class="browser-default" class="form-control" style="width: 95%; padding: 8px; border-radius: 1px; border: 1px solid #d6cfcf">
                                    <option value="0" selected></option>
                                    <option value="No contesto" >No contesto</option>
                                    <option value="No atendio" >No atendio</option>
                                    <option value="Acepto">Acepto</option>     
                                 </select>
                              </div>
                              <div class="col-xs-12 col-md-6">
                                 <h6><b> Archivo</b></h6>
                                 <input type="file" name="file" id="file">
                              </div>
                              <input type="reset" id="reset_Update_Contacto" name="reset" class="btn btn-danger" value="reset" style="display: none;">
                           </form>
                           </div>
                            
                           <div class="col-xs-12">
                              <div id="detalleFases" style="" >
                                 <div class="col-xs-12"><br><hr></div>
                                 <div class="col-xs-12 ">
                                    <div id="faseDetalle" style="background: #e8e6e6; border: 1px solid #c1b3b3; padding: 30px; width: 100%; margin: auto;">
                                       <center><h5><b>Detalles Tareas</b></h5></center>
                                       <table id="tableComercial" class="table table-bordered" style="" >
                                          <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                                             <tr>
                                             <th style="text-align: center;">Fecha</th>
                                             <th style="text-align: center;">Hora</th>
                                             <th style="text-align: center;">Descripcion</th>
                                             <th style="text-align: center;">Actividad</th>
                                             <th style="text-align: center;">Resultado</th>
                                             <th style="text-align: center;">Archivo</th>
                                             </tr>
                                          </thead>
                                          <tbody id="cuerpoTareas">
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>  
                           <input type="reset" id="reset_form_Contacto" name="reset" class="btn btn-danger" value="reset" style="display: none;">
                           </form>                     
                     
                            
                           <div class="col-xs-12"><br>
                              <center>
                                 <button type="button" class="btn btn-primary" id="agregar_tarea" onclick="agregarTarea()">Agregar Tarea</button>
                                 
                              </center>  
                              <center>
                                 <button  type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalAct_Gestion">Actualizar</button>
                              </center>                              
                           </div>
                        </div>
                     </div>


                  </div>   
               </div>

                  <!-- tabla licencia nube-->
               <div id="licenciaNube" style="display: none;">
                  <div class="col-xs-8 col-md-5 col-md-offset-3">
                     <center><h2 id="rol">Licencia Servicio Nube</h2></center>
                  </div>
                  <div class="col-xs-4 col-md-2 "></div>
                  <div class="col-md-2"></div>
                  <div id="tab">
                     <table id="tableLicenciaN" class="table table-bordered" style="text-align: center; margin-right: 100px ; width: 80%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Fecha Caducidad</th>
                              <th style="text-align: center;">Fecha Ultimo Pago</th>
                              <th style="text-align: center;">Valor</th>
                              <th colspan="2" style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoLicenciaNubes">
                        </tbody>
                     </table> 
                  </div> 
               </div>
               <div id="TablaClientesNube" style="display: none;">
                  <div class="col-xs-8 col-md-5 col-md-offset-3">
                     <center><h2 id="rol">Clientes Servicio Nube</h2></center>
                  </div>
                  <div class="col-xs-4 col-md-2 ">
                     <button style="float: right; margin-right: -15px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#inserClienteNube" style="font-size: -40px; ">Registrar </button>
                  </div>
                  <div class="col-md-2"></div>
                  <div id="tab">
                     <table id="tableLicenciaNube" class="table table-bordered" style="text-align: center; margin-right: 100px ; width: 80%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Nombre</th>
                              <th style="text-align: center;">Capacidad Contratada (GB)</th>
                              <th style="text-align: center;">Espacio Asignado (GB)</th>
                              <th style="text-align: center;">Espacio Consumido (GB)</th>
                              <th style="text-align: center;">Usuarios</th>
                              <th colspan="2" style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoClientesServNube">
                        </tbody>
                     </table> 
                  </div> 
               </div>
               <!--tabla de usuarios en cliente-->
               <div id="TablaUsuariosClienteNube" style="display: none; margin-top: 20px;">
                  <div class="col-md-3">
                     <a onclick="clienteNube()"><img src="Public/img/atras.gif" id="banco" style="float: left;" alt=""></a>
                  </div>
                  <div class="col-xs-8 col-md-5 ">
                     <center><h2 id="rol">Usuarios <span id="clienteDetalle"></span></h2></center>
                  </div>
                  <div class="col-xs-4 col-md-2 ">
                     <button style="float: right; margin-right: -15px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#inserUsuarioNube" style="font-size: -40px; ">Registrar </button>
                  </div>
                  <div class="col-md-2"></div>
                  <div id="tab">
                     <table id="tableUsuariosNube" class="table table-bordered" style="text-align: center; margin-right: 100px ; width: 80%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Nombre</th>
                              <th style="text-align: center;">Cuota</th>
                              <th style="text-align: center;">Espacio Consumido (GB)</th>
                              <th style="text-align: center;">Area Retencion (GB)</th>
                              <th style="text-align: center;">Total Utilizado</th>
                              <th style="text-align: center;">Grupos Respaldo</th>
                              <th colspan="2" style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoUsuariosClienteServNube">
                        </tbody>
                     </table> 
                  </div> 
               </div>
               <div id="TablaUsuariosNube" style="display: none;">
                  <div class="col-xs-8 col-md-6 col-md-offset-3">
                     <center><h2 id="rol">Usuarios Servicio Nube</h2></center>
                  </div>
                  <div class="col-xs-4 col-md-2 ">
                     
                  </div>
                  <div class="col-md-2"></div>
                  <div id="tab">
                     <table id="tableUsuarioNub" class="table table-bordered" style="text-align: center; margin-right: 100px ; width: 80%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Nombre</th>
                              <th style="text-align: center;">Cuota</th>
                              <th style="text-align: center;">Área de datos (GB)</th>
                              <th style="text-align: center;">Área Retencion (GB)</th>
                              <th style="text-align: center;">Total Utilizado</th>
                              <th style="text-align: center;">Grupos Respaldo</th>
                              <th colspan="2" style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoUsuariosServNube">
                        </tbody>
                     </table> 
                  </div> 
               </div>
               <div id="TablaGrespaldoNube" style="display: none;">
                  <input type="hidden" id="valOptDetalleUsuario" value="0">
                  <input type="hidden" id="detalleRegreso" value="0">
                  <div class="col-md-3">
                     <a onclick="detallleDeRegresoGrResp()"><img src="Public/img/atras.gif" id="banco" style="float: left;" alt=""></a>
                  </div>
                  <div class="col-xs-8 col-md-6 ">
                     <center><h2 id="rol">Grupos Respaldo Servicio Nube <span id="no_usuSerNube"></span></h2></center>
                  </div>
                  <div class="col-xs-4 col-md-2 ">
                     <button style="float: right; margin-right: -15px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#inserRespalNube" style="font-size: -40px; ">Registrar </button>
                  </div>
                  <div class="col-md-2"></div>
                  <div id="tab">
                     <table id="tableRespaldoNube" class="table table-bordered" style="text-align: center; margin-right: 100px ; width: 80%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Nombre</th>
                              <th style="text-align: center;">Área de datos</th>
                              <th style="text-align: center;">Área Retencion</th>
                              <th colspan="2" style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoGrespaldoServNube">
                        </tbody>
                     </table> 
                  </div> 
               </div>
               <div id="rolesDetalles" style="display: none;">
                  <div class="col-xs-8 col-md-5 col-md-offset-3">
                     <center><h2 id="rol">Roles Detalles</h2></center>
                  </div>
                  <div class="col-xs-4 col-md-2 ">
                     <button style="float: right; margin-right: -20px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#rol_register" style="font-size: 20px; ">Registrar </button>
                  </div>
                  <div class="col-md-2"></div>
                  <div id="tab">
                     <table id="tableRol" class="table table-bordered" style="text-align: center; margin-right: 100px ; width: 80%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Codigo</th>
                              <th style="text-align: center;">Nombre</th>
                              <th colspan="2" style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoRol">
                        </tbody>
                     </table> 
                  </div> 
               </div>
               <div id="canalesContratados" style="display: none;">
                  <div class="col-xs-8 col-md-8 col-md-offset-1">
                     <center><h2 id="CanCont">Canales Internacionales Contratados</h2></center>
                  </div>
                  <div class="col-xs-4 col-md-3 ">
                     <button style="float: right; margin-right: 120px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#cc_register" style="font-size: 20px; ">Registrar </button>
                  </div>
                  <div class="col-md-2"></div>
                  <div id="tab">
                     <table id="tablecanalesContratados" class="table table-bordered" style="text-align: center; margin-right: 100px ; width: 80%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Nombre</th>
                              <th style="text-align: center;">Mbps</th>
                              <th colspan="2" style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoCanalContratado">
                        </tbody>
                     </table> 
                  </div> 
               </div>
               <div id="usoEspacio" style="display: none;">
                  <div class="col-xs-12 ">
                     <center><h2 id="CanCont">Uso de Espacio</h2></center><br>
                     <table id="tableUsoEspacio" class="table table-bordered" style="text-align: center;width: 80%;  ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Capacidad</th>
                              <th style="text-align: center;">Usado</th>
                              <th style="text-align: center;">fecha</th>
                              <th style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpousoEspacio">
                        </tbody>
                     </table> 
                  </div>
               </div>
               <div id="canalesT" style="display: none;">
                  <div class="col-xs-3 col-md-offset-3">
                      <center><h3><b>Canales</b></h3></center>
                  </div>
                  <div class="col-xs-3" ">
                      <button style="float: right; margin-right: -5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#canalRegister" > Registrar</button>                
                  </div><div class="col-xs-3"></div>
                  <table id="tableDreamPBX" class="table table-bordered" style="text-align: center; margin-right: 100px; width: 60%; ">
                     <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                        <tr >
                           <th style="text-align: center; width: 100%;">Nombre</th>
                           <th colspan="2" style="text-align: center; width: 30%; ">Opciones</th>
                        </tr>
                     </thead>
                     <tbody id="cuerpoCanales">

                    </tbody>
                  </table> 
               </div> 
               <div id="MetaMes" style="display: none;">
                  <div class="col-md-9" id="tab">
                  <center><h2 id="MetaM">Meta</h2></center>
                     <table id="tableDreamPBX" class="table table-bordered" style="text-align: center; margin: 0 auto; width: 100%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Meta</th>
                              <th style="text-align: center;">Rango días</th>
                              <th style="text-align: center;">fecha</th>
                              <th colspan="2" style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoMeta">
                        </tbody>
                     </table> 
                  </div> 
                  <div class="col-md-3"></div>
               </div>
               <div id="facturacion" style="display: none;">
                  <div class="col-xs-8 col-md-offset-1">
                      <center><h3><b>Detalles Proveedores Facturacion</b></h3></center>
                  </div>
                  <div class="col-xs-3" ">
                      <button style="float: right; margin-right: 65px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#facturacion_register" > Registrar</button>                
                  </div>
                  <table id="tablefacturacion" class="table table-bordered" style="text-align: center; margin-right: 120px; width: 90%; ">
                    <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                      <tr >
                        <th style="text-align: center;">Proveedor</th>
                        <th style="text-align: center;">Valor</th>
                        <th style="text-align: center;">Fecha Limite</th>
                        <th style="text-align: center;">Estado</th>     
                        <th style="text-align: center;" colspan="2">Opciones</th>     
                      </tr>
                    </thead>
                    <tbody id="cuerpofacturacion">
                    </tbody>
                  </table>  
               </div>
               <div id="recargasBanco" style="display: none;">
                  <div class="col-xs-8 col-md-offset-1">
                      <center><h3><b>Detalles Proveedores Recargas</b></h3></center>
                  </div>
                  <div class="col-xs-3">
                     <button style="float: right; margin-right: 65px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#recargas_register" data-dismiss="modal">Registrar</button>              
                  </div>
                  <table id="tableRecargas" class="table table-bordered" style="text-align: center; margin-right: 120px; width: 90%; ">
                    <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                      <tr >
                        <th style="text-align: center;">Proveedor</th>
                        <th style="text-align: center;">Saldo</th>
                        <th style="text-align: center;">Fecha Actualizacion</th>
                        <th style="text-align: center;" colspan="2">Opciones</th>     
                      </tr>
                    </thead>
                    <tbody id="cuerpoRecargas">
                    </tbody>
                  </table>  
               </div> 
               <div id="dreamDetallePBX" style="display: none;">
                  <div class="col-xs-8 col-md-5 col-md-offset-3">
                     <center><h2 id="dreamPBX">DreamPBX</h2></center>
                  </div>
                  <div class="col-xs-4 col-md-2 ">
                     <button style="float: right; margin-right: -7px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#DreamPBX-register" style="font-size: 20px; ">Registrar </button>
                  </div>
                  <div class="col-md-2"></div>
                  <div id="tab">
                     <table id="tableDreamPBX" class="table table-bordered" style="text-align: center; margin-right: 120px; width: 80%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Nombre</th>
                              <th style="text-align: center;">Ip</th>
                              <th colspan="2" style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoDream">
                        </tbody>
                     </table> 
                  </div> 
               </div>
               <div id="freeDetallePBX" style="display: none;">
                  <div class="col-xs-8 col-md-5 col-md-offset-3">
                     <center><h2 id="paisBancoDetalle">FreePBX</h2></center>
                  </div>
                  <div class="col-xs-4 col-md-2 ">
                     <button style="float: right; margin-right: -7px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#FreePBX-register" style="font-size: 20px; ">Registrar </button>
                  </div>
                  <div class="col-md-2"></div>
                  <div id="tab">
                     <table id="tableFreePBX" class="table table-bordered" style="text-align: center; margin-right: 120px; width: 80%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Nombre</th>
                              <th style="text-align: center;">Ip</th>
                              <th colspan="2" style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoFree">
                        </tbody>
                     </table> 
                  </div> 
               </div>
               <div id="contWeb" style="display: none;" >
                  <div class="col-xs-8 col-md-5 col-md-offset-3">
                     <center><h2 id="paisBancoDetalle">Detalles Web</h2></center>
                  </div>
                  <div class="col-xs-4 col-md-2 ">
                     <button style="float: right; margin-right: -30px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#rWeb" style="font-size: 20px; ">Registrar </button>
                  </div>
                  <div class="col-md-2"></div>
                  <div id="tab">
                     <table id="tableVistasWeb" class="table table-bordered" style="text-align: center; margin: 0 auto; width: 70%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Visitas</th>
                              <th style="text-align: center;">Fecha</th>
                              <th style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoVistaWeb">
                        </tbody>
                     </table> 
                  </div>
               </div>
               <div id="contPlayStore" style="display: none;" >
                  <div class="col-xs-8 col-md-8 col-md-offset-2">
                     <center><h2 id="paisBancoDetalle">Detalles PlayStore</h2></center>
                  </div>
                  <div class="col-xs-4 col-md-2 ">
                     <button style="float: right; margin-right: 30px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#rPlay" style="font-size: 20px; ">Registrar </button>
                  </div>
                  <div id="tab">
                     <table id="tablePlayStore" class="table table-bordered" style="text-align: center; margin: 0 auto; width: 90%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Visitas</th>
                              <th style="text-align: center;">Descargas</th>
                              <th style="text-align: center;">Desinstalaciones</th>
                              <th style="text-align: center;">Dispositivos Activos</th> 
                              <th style="text-align: center;">Fecha</th> 
                              <th style="text-align: center;">Opciones</th> 
                           </tr>
                        </thead>
                        <tbody id="cuerpoPlayStore">
                        </tbody>
                     </table> 
                  </div>
               </div>
               <div id="contAppStore" style="display: none;" >
                  <div class="col-xs-8 col-md-8 col-md-offset-2">
                     <center><h2 id="paisBancoDetalle">Detalles AppStore</h2></center>
                  </div>
                  <div class="col-xs-4 col-md-2 ">
                     <button style="float: right; margin-right: 30px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#rApp" style="font-size: 20px; ">Registrar </button>
                  </div>
                  <div id="tab">
                     <table id="tableAppStore" class="table table-bordered" style="text-align: center; margin: 0 auto; width: 90%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Visitas</th>
                              <th style="text-align: center;">Descargas</th>
                              <th style="text-align: center;">Desinstalaciones</th>
                              <th style="text-align: center;">Dispositivos Activos</th> 
                              <th style="text-align: center;">Fecha</th>
                              <th style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoAppStore">
                        </tbody>
                     </table> 
                  </div>
               </div>
               <div id="contCampanna" style="display: none;" >
                  <div class="col-xs-8 col-md-6 col-md-offset-2">
                     <center><h2 id="paisBancoDetalle">Detalles Campaña</h2></center>
                  </div>
                  <div class="col-xs-4 col-md-3 ">
                     <button style="float: right; margin-right: 0px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#rCampanna" style="font-size: 20px; ">Registrar </button>
                  </div>
                  <div class="col-md-1"></div>
                  <div id="tab">
                     <table id="tableCampanna" class="table table-bordered" style="text-align: center; margin: 0 auto; width: 80%; ">
                        <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                           <tr >
                              <th style="text-align: center;">Audiencia</th>
                              <th style="text-align: center;">Total Clics</th>
                              <th style="text-align: center;">Total Registros</th>
                              <th style="text-align: center;">Fecha</th>
                              <th style="text-align: center;">Opciones</th>
                           </tr>
                        </thead>
                        <tbody id="cuerpoCampanna">
                        </tbody>
                     </table> 
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-1"></div>
   </div>
   <br><br>
   <br><br>

     






<!--  ============================================================================
========================            modales             ==========================
=================================================================================-->



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
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="nombInfo" readonly="readonly">
                  </div>   
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Tipo Cliente</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="tpInfo" readonly="readonly">
                  </div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Sector Económico</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="s_eInfo" readonly="readonly">
                  </div>
                  <div class="col-xs-12"><br><hr></div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Servicio</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="sgInfo" readonly="readonly">
                  </div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Competencia</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="compInfo" readonly="readonly">
                  </div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b> Asesor Comercial</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="asesInfo" readonly="readonly">
                  </div>
                  <div class="col-xs-12"><br><hr></div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Fase de Atencion</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="faseInfo" readonly="readonly">
                  </div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Negocio Exitoso</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="text" id="negInfo" readonly="readonly">
                  </div>
                  <div class="col-xs-12 col-md-4">
                     <h6><b>Monto</b></h6>
                     <input style="width: 95%; padding: 2px; border-radius: 1px; border: 1px solid #d6cfcf" type="number" id="montoInfo" readonly="readonly">
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
                              <th style="text-align: center;">Total Dias</th>
                           </tr>
                           </thead>
                           <tbody id="cuerpoInfoFechas">
                              <tr>
                                 <td style="text-align: center;" id="fconfianza"></td>
                                 <td style="text-align: center;" id="fcomunicacion"></td>
                                 <td style="text-align: center;" id="fcooperacion"></td>
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
                                 <th style="text-align: center;">Descripcion</th>
                                 <th style="text-align: center;">Actividad</th>
                                 <th style="text-align: center;">Resultado</th>
                                 <th style="text-align: center;">Estado</th>
                                 <th style="text-align: center;">Archivo</th>
                              </tr>
                           </thead>
                           <tbody id="detaConfianza">
                           </tbody>
                        </table>
                        <div class="col-xs-12"><br><br><hr></div>
                        <center><h5><b>Comunicacion</b></h5></center>
                        <table id="tableComercial" class="table table-bordered" style="" >
                           <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                              <tr>
                                 <th style="text-align: center;">Fecha</th>
                                 <th style="text-align: center;">Descripcion</th>
                                 <th style="text-align: center;">Actividad</th>
                                 <th style="text-align: center;">Resultado</th>
                                 <th style="text-align: center;">Estado</th>
                                 <th style="text-align: center;">Archivo</th>
                              </tr>
                           </thead>
                           <tbody id="detaComunicacion">
                           </tbody>
                        </table>
                        <div class="col-xs-12"><br><br><hr></div>
                        <center><h5><b>Cooperacion</b></h5></center>
                        <table id="tableComercial" class="table table-bordered" style="" >
                           <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
                              <tr>
                                 <th style="text-align: center;">Fecha</th>
                                 <th style="text-align: center;">Descripcion</th>
                                 <th style="text-align: center;">Actividad</th>
                                 <th style="text-align: center;">Resultado</th>
                                 <th style="text-align: center;">Estado</th>
                                 <th style="text-align: center;">Archivo</th>
                              </tr>
                           </thead>
                           <tbody id="detaCooperacion">
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

 
   <div class="modal fade ModalAct_Gestion" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 130px;  ">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="padding: 50px; background: #fff;  ">
        <h2 style="color: #000;  text-align: center;">¿Éstas seguro de Actualizar Contacto?</h2>
        <br><br><br><br>
        <center>
          <button type="hidden" id="update" name="update" onclick="updateGestion()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
          <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
          <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </center>       
      </div>
    </div>
   </div>

<!--modal delete Gestion comercial -->
<button style="display: none;" type="button" id="delete-gestion" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteGestion"></button>
  <div style="margin-top: 120px;" class="modal fade" id="deleteGestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center;">
          <input type="text" id="iddelldGest" name="iddelldGest" style="display: none; ">
          <center><h3 class="modal-title" id="myModalLabel"><b>¿ Estas seguro de eliminar <br> Usuario: <i id="nombre_Del_Gestion"></i> ? </b></h3></center><br><br><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="sideleteGestion" onclick="deleteGestion()"> Si </button>
            <button type="button" class="btn btn-danger" id="NodeleteGestion" data-dismiss="modal" > No </button> 
          </div>
        </div>            
      </div>
    </div>
  </div>





































<!--modal actualizar Meta-->
<button style="display: none;" type="button" id="estado-Meta" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#estadoMeta"></button>
  <div class="modal fade" id="estadoMeta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding: 20px; ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <center><h5 class="modal-title" id="myModalLabel"><i class="fa fa-copy"></i> <b>  Detalles Recarga</b></h5></center>
        </div>
        <div class="modal-body" style="text-align: center;">
          <input type="hidden" id="cod" name="cod">
          <p style="font-size: 15px; "><b> Rango días </b> </p> 
          <input type="text" id="rdias" name="rdias" style="padding: 3px; width: 85%; border: 1px solid #e0d7d7" >

          <p style="font-size: 15px; "><b> Meta  </b> </p>
          <input type="text" id="m_meta" name="m_meta" style="padding: 3px; width: 85%; border: 1px solid #e0d7d7" >
      
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalActualizarMeta">Actualizar</button> 
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="cerrarMeta" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade ModalActualizarMeta" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 90px;  ">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="padding: 15px; background: #3b3b3b;  ">
        <h2 style="color: #fff;  text-align: center;">¿Éstas seguro de Actualizar Meta?</h2>
        <br><br><br><br>
        <center>
          <button type="hidden" id="update" name="update" onclick="updateMetaBanco()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
          <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
          <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">
        </center>       
      </div>
    </div>
  </div>


<!-- Modal Registro  Facturacion-->
<div class="modal fade modal-ext" id="facturacion_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-clone" aria-hidden="true"></i> Registro- Facturacion</h3>
      </div>
      <form action="" method="post">
        <div class="modal-body" id="Refacturacion">
          <div class="md-form">
            <center><h5><b>Proveedor</b></h5>
              <input style="width: 50%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nombreFacturacion" name="nombreFacturacion" placeholder="Ingrese Nombre">
            </center>
          </div>
          <div class="md-form">
            <center><h5><b>Fecha Limite</b></h5>
              <input style="width: 50%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="date" id="fechaLiFa" name="fechaLiFa" placeholder="Ingrese Nombre">
            </center>
          </div>
          <div class="md-form">
            <center>
              <h5><b>Valor</b></h5>
              <input style="width: 50%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="number" id="valorFacturacion" name="valorFacturacion" placeholder="Ingrese Valor">
            </center>
          </div>
          <div class="text-xs-center">
            <button type="button" id="InsertFactura" name="InsertFactura" onclick="insertfacturacionBanco()" class="btn btn-success btn-md"  >Insertar</button>
            <input type="reset" id="reset_insert_facturacion" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </div>
        </div>
      </form>
      <div class="modal-footer">           
        <button type="button" id="cerrarModalFacturacion" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal delete Facturacion -->
<button style="display: none;" type="button" id="delete-facturacion" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deletefacturacion"></button>
  <div style="margin-top: 120px;" class="modal fade" id="deletefacturacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center;">
          <input type="text" id="codProF" name="codProF" style="display: none; ">
          <center><h3 class="modal-title" id="myModalLabel"><b> ¿ Estas seguro de eliminar <br> Proveedor: <span id="proveedorF"></span> ? </b></h3></center><br><br><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="deleteFree" onclick="deleteFa()"> Si </button>
            <button type="button" class="btn btn-danger" id="NodeleteFa" data-dismiss="modal" > No </button> 
          </div>
        </div>            
      </div>
    </div>
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
          <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </center>       
      </div>
    </div>
  </div>



<!-- Modal registro  Recargas-->
<div class="modal fade modal-ext" id="recargas_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-clone" aria-hidden="true"></i> Registro- Recargas</h3>
      </div>
      <form action="" method="post">
        <div class="modal-body" id="Refacturacion">
          <div class="md-form">
            <center><h5><b>Proveedor</b></h5>
            <input style="width: 60%; padding: 10px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nombreProRecarga" name="nombreProRecarga" placeholder="Ingrese Nombre proveedor Recargas">
            </center>
          </div>
          <div class="md-form">
            <center>
              <h5><b>Saldo</b></h5>
              <input style="width: 60%; padding: 10px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="saldoRecarga" name="saldoRecarga" placeholder="Ingrese Saldo Recarga">
            </center>
          </div>
           <div class="md-form">
           <center>  
            <select name="tipo_moneda" id="tipo_moneda" class="browser-default" class="form-control" style="width: 15%;  margin-top: 0px;  border-radius: 2px;  padding: 10px;  " >
                  <option value="1" selected>$</option>
                  <option value="2">Bs.</option>     
                  <option value="3">USD</option>     
               </select>
               </center>
          </div>
          <div class="text-xs-center">
            <button type="button" id="InsertFactura" name="InsertFactura" onclick="insertRecargaBanco()" class="btn btn-success btn-md"  >Insertar</button>
            <input type="reset" id="reset_insert_Recargas" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" id="cerrarModalRecargas" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal actualizar Recarga-->
<button style="display: none;" type="button" id="estado-recarga" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#estadoRecarga"></button>
  <div class="modal fade" id="estadoRecarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding: 20px; ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <center><h5 class="modal-title" id="myModalLabel"><i class="fa fa-copy"></i> <b>  Detalles Recarga</b></h5></center>
        </div>
        <div class="modal-body" style="text-align: center;">
          <input type="hidden" id="cod" name="cod">
          <input type="hidden" id="moneda" name="moneda">
          <p style="font-size: 15px; "><b> Proveedor </b> </p> 
          <input type="text" id="proveedorR" name="proveedorR" style="padding: 3px; width: 85%; border: 1px solid #e0d7d7" >

          <p style="font-size: 15px; "><b> Fecha  </b> </p>
          <input type="date" id="fechaRe" name="fechaRe" style="padding: 3px; width: 85%; border: 1px solid #e0d7d7" >

          <p style="font-size: 15px; "><b> Saldo </b> </p> 
          <input type="text" id="saldo" name="saldo" style="padding: 3px; width: 85%; border: 1px solid #e0d7d7" >
                 
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalActualizarRecarga">Actualizar</button> 
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="cerrarRecarga" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade ModalActualizarRecarga" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 90px;  ">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="padding: 50px; background: #3b3b3b;  ">
        <h2 style="color: #fff;  text-align: center;">¿Éstas seguro de Actualizar el Registro?</h2>
        <br><br><br><br>
        <center>
          <button type="hidden" id="update" name="update" onclick="updateRecargaBanco()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
          <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
          <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">
        </center>       
      </div>
    </div>
  </div>
<!--modal delete freePBX-->
<button style="display: none;" type="button" id="delete-recarga" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteRecarga"></button>
  <div style="margin-top: 120px;" class="modal fade" id="deleteRecarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center;">
          <input type="text" id="codPro" name="codPro" style="display: none; ">
          <center><h3 class="modal-title" id="myModalLabel"><b> ¿ Estas seguro de eliminar <br> Proveedor: <span id="proveedor"></span> ? </b></h3></center><br><br><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="deleteFree" onclick="deleteRe()"> Si </button>
            <button type="button" class="btn btn-danger" id="NodeleteRe" data-dismiss="modal" > No </button> 
          </div>
        </div>            
      </div>
    </div>
  </div>




<!-- Modal Register  freePBX-->
<div class="modal fade modal-ext" id="FreePBX-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-cubes" aria-hidden="true"></i> FreePBX - Registro</h3>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="md-form">
            <center><h5>Introduce Ip</h5>
              <input style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; " type="number" name="ip_style" id="ip_inicioFree" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) {getElementById('ip_segundoFree').focus(); } } "   >

              <input style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; " type="number" name="ip_style" id="ip_segundoFree" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) { getElementById('ip_terceroFree').focus(); } }">

              <input style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; " type="number" name="ip_style" id="ip_terceroFree" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) { getElementById('ip_cuartoFree').focus(); } }">
              
              <input style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; " type="number" name="ip_style" id="ip_cuartoFree" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) { getElementById('nombreFree').focus(); } }">
            </center>
          </div>
          <div class="md-form">
            <center>
              <h5 for="nombre">Nombre</h5>
              <br><input style="border: 1px solid #cec8c8; width: 50%; padding: 0px 50px 0px 50px;  " type="text" id="nombreFree" class="form-control" placeholder="Ingrese Nombre Ip" >
            </center>
          </div>              
          <div class="text-xs-center">
            <button type="button" id="InsertBancoFree" name="InsertBancoFree" onclick=" verif_in_BancoFreeIp() " class="btn btn-success btn-md"  >Insertar</button>
            <input type="reset" id="reset_insertFree" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </div>
        </div>
      </form>
      <div class="modal-footer">             
        <button type="button" id="cerrarModalBancoFree" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal delete freePBX-->
<button style="display: none;" type="button" id="delete-FreePBX" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteFreePBX"></button>
  <div style="margin-top: 120px;" class="modal fade" id="deleteFreePBX" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center;">
          <input type="text" id="ipFree" name="ipFree" style="display: none; ">
          <center><h3 class="modal-title" id="myModalLabel"><b> ¿ Estas seguro de eliminar <br> Ip: <span id="ipF"></span> ? </b></h3></center><br><br><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="deleteFree" onclick="deleteFree()"> Si </button>
            <button type="button" class="btn btn-danger" id="NodeleteFree" data-dismiss="modal" > No </button> 
          </div>
        </div>            
      </div>
    </div>
  </div>
<!-- Modal Update  freePBX-->
<button style="display: none;" id="updateFreePBX" class="btn btn-primary btn-md" data-toggle="modal" data-target="#FreePBX-update" ></button>
  <div class="modal fade modal-ext" id="FreePBX-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h3><i class="fa fa-cubes" aria-hidden="true"></i> Actualizar - FreePBX</h3>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="md-form">
              <input type="hidden" name="idFreUIp" id="idFreUIp">
              <center><h5> Ip</h5>
                      
              <input type="number" name="ip_style" id="ip_uno" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) {getElementById('ip_dos').focus(); } } " style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; "  >

              <input type="number" name="ip_style" id="ip_dos" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) { getElementById('ip_tres').focus(); } }"    style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; ">

              <input type="number" name="ip_style" id="ip_tres" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) { getElementById('ip_cuarto').focus(); } }"     style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; ">
              
              <input type="number" name="ip_style" id="ip_cuarto" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) { getElementById('nombreFr').focus(); } }"     style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; ">
              </center>
            </div>
            <div class="md-form">
              <center>
                <h5 for="nombre">Nombre</h5>
                <br><input type="text" id="nombreFr" class="form-control" style="border: 1px solid #cec8c8; width: 50%; padding: 0px 50px 0px 50px;  " placeholder="Ingrese Nombre Ip" >
              </center>
            </div>
            <div class="text-xs-center">
              <button type="button" id="InsertBancoFree" name="InsertBancoFree" onclick=" updateFreeIp() " class="btn btn-success btn-md"  >Actualizar</button>
            </div>
          </div>
        </form>
        <div class="modal-footer"> 
          <button type="button" id="cerrarModalUpdFree" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



<!-- Modal Register  DreamPBX-->
<div class="modal fade modal-ext" id="DreamPBX-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-cubes" aria-hidden="true"></i> DreamPBX - Registro</h3>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="md-form" id="dreamRegister"> 
            <center><h5>Introduce Ip</h5>

              <input style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; " type="number" name="ip_style" id="ip_inicioDream" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) {getElementById('ip_segundoDream').focus(); } } "   >

              <input style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; " type="number" name="ip_style" id="ip_segundoDream" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) { getElementById('ip_terceroDream').focus(); } }">

              <input style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; " type="number" name="ip_style" id="ip_terceroDream" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) { getElementById('ip_cuartoDream').focus(); } }">
              
              <input style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; " type="number" name="ip_style" id="ip_cuartoDream" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) { getElementById('nombreDream').focus(); } }">
            </center>
          </div>
          <div class="md-form">
            <center>
              <h5 for="nombre">Nombre</h5>
              <br><input style="border: 1px solid #cec8c8; width: 50%; padding: 0px 50px 0px 50px;  " type="text" id="nombreDream" class="form-control" placeholder="Ingrese nombre Ip" >
            </center>
          </div>
          <div class="text-xs-center">
            <button type="button" id="InsertBanco" name="InsertBanco" onclick=" verif_in_BancoDreamIp() " class="btn btn-success btn-md"  >Insertar</button>
            <input type="reset" id="reset_insertDream" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" id="cerrarModalBancoDream" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal delete DreamPBX-->
<button style="display: none;" type="button" id="delete-DreamPBX" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteDreamPBX"></button>
  <div style="margin-top: 120px;" class="modal fade" id="deleteDreamPBX" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center;">
          <input type="text" id="ipDream" name="ipDream" style="display: none; ">
          <center><h3 class="modal-title" id="myModalLabel"><b> ¿ Estas seguro de eliminar <br> Ip: <span id="ipD"></span> ? </b></h3></center><br><br><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="deleteDream" onclick="deleteDream()">Si</button>
            <button type="button" class="btn btn-danger" id="NodeleteDream" data-dismiss="modal" >No</button> 
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Modal Update  DreamPBX-->
<button style="display: none;" id="updateDreamPBX" class="btn btn-primary btn-md" data-toggle="modal" data-target="#DreamPBX-update" >Registrar </button>
  <div class="modal fade modal-ext" id="DreamPBX-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h3><i class="fa fa-cubes" aria-hidden="true"></i> Actulizar - DreamPBX</h3>       
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="md-form">
              <input type="hidden" name="idDreamUIp" id="idDreamUIp">
                <center><h5> Ip</h5>
                      
              <input type="number" name="ip_style" id="ip_unoD" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) {getElementById('ip_dosD').focus(); } } " style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; "  >

              <input type="number" name="ip_style" id="ip_dosD" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) { getElementById('ip_tresD').focus(); } }"    style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; ">

              <input type="number" name="ip_style" id="ip_tresD" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) { getElementById('ip_cuartoD').focus(); } }"     style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; ">
                
              <input type="number" name="ip_style" id="ip_cuartoD" maxlength="3" onkeyup=" if (this.value.length == this.getAttribute('maxlength')) { if (event.keyCode!=9) { getElementById('nombreDream').focus(); } }"     style="padding: 0px 0px 0px 10px;  width: 70px; border: 1px solid #cec8c8; ">
              </center>
            </div>
            <div class="md-form">
              <center>
                <h5 for="nombre">Nombre</h5>
                <br><input type="text" id="nombreDr" class="form-control" style="border: 1px solid #cec8c8; width: 50%; padding: 0px 50px 0px 50px;  " >
              </center>
            </div>
            <div class="text-xs-center">
              <button type="button" id="UpdateBancoDream" name="UpdateBancoDream" onclick=" updateDreamIp() " class="btn btn-success btn-md"  >Actualizar</button>
            </div>
          </div>
        </form>
        <div class="modal-footer">
          <button type="button" id="cerrarModalUpdDream" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



<!-- Modal Register  Web-->
<div class="modal fade modal-ext" id="rWeb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xs" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><b>Banco de Datos</b></h4>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="row" style="text-align: center;">
            <h2>Pagina Web</h2>
            <div class="col-xs-12 ">
              <p>Visitas Pagina</p>
              <input type="number" name="VisitasWeb" id="VisitasWeb" placeholder="# Visitas Web" style="padding: 7px; border-radius: 2px; border: 1px solid #d1c4c4;  width: 80%;  ">
            </div>
            <div class="col-xs-12 ">
              <p>Fecha Visitas</p>
              <input type="date" id="fechaVisitasWeb" name="fechaVisitasWeb"  style="padding: 7px; border-radius: 2px; border: 1px solid #d1c4c4; width: 80%;  ">
            </div>
          </div> 
          <br><br><br>
        </div>   
        <div class="modal-footer"><center>
          <button type="button" id="InsertBanco" name="InsertBanco" onclick=" insertWeb() " class="btn btn-success btn-md"  >Insertar</button>
          <input type="reset" id="reset_insertWeb" name="reset_insertWeb" class="btn btn-danger" value="reset" style="display: none;">
          <button type="button" class="btn btn-danger" id="cerrarMoWeb" data-dismiss="modal"  >Cancelar</button></center>
        </div>
      </form>
    </div>
  </div>
</div>
   <!--modal delete VisitasWeb-->
   <button style="display: none;" type="button" id="delete-visitaWeb" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteVisitaWeb"></button>
     <div style="margin-top: 120px;" class="modal fade" id="deleteVisitaWeb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-xs" role="document">
         <div class="modal-content">
           <div class="modal-body" style="text-align: center;">
             <input type="text" id="id_visWeb" name="id_visWeb" style="display: none; ">
             <center><h3 class="modal-title" id="myModalLabel"><b> ¿ Estas seguro de eliminar Visita Web ? </b></h3></center><br><br><br>
             <div class="text-xs-center">
               <button type="button" class="btn btn-success" id="deleteVistaWeb" onclick="deleteVisitaWeb()"> Si </button>
               <button type="button" class="btn btn-danger" id="NodeleteVistaWeb" data-dismiss="modal" > No </button> 
             </div>
           </div>            
         </div>
       </div>
     </div>


<!-- Modal Register  PlayStore-->
<div class="modal fade modal-ext" id="rPlay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><b>Banco de Datos</b></h4>
            </div>
            <form action="" method="post">
            <div class="modal-body">

            
            <div class="row" style="text-align: center;">
               <h2>Play Store</h2>
               <div class="col-xs-6 col-md-12">
                  <p>Total Visitas</p>
                  <input type="number" id="visitasPlayStore" name="visitasPlayStore" placeholder="# Visitas PlayStore" style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
               <div class="col-xs-12 col-md-12">
                  <p>Número Descargas</p>
                  <input type="number" id="descargasPlayStore" name="descargasPlayStore" placeholder="# descargas PlayStore" style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
               <div class="col-xs-12 col-md-12">
                  <p>Desinstalaciones</p>
                  <input type="number" id="desinstalacionesPlayStore" name="desinstalacionesPlayStore" placeholder="# desinstalaciones PlayStore" style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
               <div class="col-xs-12 col-md-12">
                  <p>Dispositivos Activos</p>
                  <input type="number" id="DispositivosActivosPlayStore" name="DispositivosActivosPlayStore" placeholder="# Dispositivos Activos PlayStore" style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
               <div class="col-xs-12 col-md-12">
                  <p>fecha</p>
                  <input type="date" id="fechaRegistroPlay" name="fechaRegistroPlay"  style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
            </div>
            <br><br>
         </div>   

            <div class="modal-footer"><center>
                <button type="button" id="InsertBanco" name="InsertBanco" onclick=" insertPlayStore() " class="btn btn-success btn-md"  >Insertar</button>
                <input type="reset" id="reset_insertPlay" name="reset_insertPlay" class="btn btn-danger" value="reset" style="display: none;">
                <button type="button" class="btn btn-danger" id="cerrarMoPlay" data-dismiss="modal"  >Cancelar</button></center>
            </div>
            </form>
        </div>
    </div>
</div>
   <!--modal delete VisitasPlayStore-->
   <button style="display: none;" type="button" id="delete-visitaPlay" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteVisitaPlay"></button>
     <div style="margin-top: 120px;" class="modal fade" id="deleteVisitaPlay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-xs" role="document">
         <div class="modal-content">
           <div class="modal-body" style="text-align: center;">
             <input type="text" id="id_visPlay" name="id_visPlay" style="display: none; ">
             <center><h3 class="modal-title" id="myModalLabel"><b> ¿ Estas seguro de eliminar Visita PlayStore ? </b></h3></center><br><br><br>
             <div class="text-xs-center">
               <button type="button" class="btn btn-success" id="deleteVistaPlay" onclick="deleteVisitaPlay()"> Si </button>
               <button type="button" class="btn btn-danger" id="NodeleteVistaPlay" data-dismiss="modal" > No </button> 
             </div>
           </div>            
         </div>
       </div>
     </div>

<!-- Modal Register  AppStore-->
<div class="modal fade modal-ext" id="rApp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><b>Banco de Datos</b></h4>
            </div>
            <form action="" method="post">
            <div class="modal-body">

            <div class="row" style="text-align: center;">
               <h2>AppStore</h2>
               <div class="col-xs-12 col-md-12">
                  <p>Total Visitas</p>
                  <input type="number" id="visitasAppStore" name="visitasAppStore" placeholder="# Visitas AppStore" style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
               <div class="col-xs-12 col-md-12">
                  <p>Número Descargas</p>
                  <input type="number" id="descargasAppStore" name="descargasAppStore" placeholder="# descargas AppStore " style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
               <div class="col-xs-12 col-md-12">
                  <p>Desinstalaciones</p>
                  <input type="number" id="desinstalacionesAppStore" name="desinstalacionesAppStore" placeholder="# desinstalaciones AppStore" style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
               <div class="col-xs-12 col-md-12">
                  <p>Dispositivos Activos</p>
                  <input type="number" id="dispositivosActivosAppStore" name="dispositivosActivosAppStore" placeholder="# Dispositivos Activos AppStore" style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
               <div class="col-xs-12 col-md-12">
                  <p>fecha</p>
                  <input type="date" id="fechaRegistroApp" name="fechaRegistroApp"  style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
            </div>

             <br><br><br>
         </div>   

            <div class="modal-footer"><center>
                <button type="button" id="InsertBanco" name="InsertBanco" onclick=" insertAppStore() " class="btn btn-success btn-md"  >Insertar</button>
                <input type="reset" id="reset_insertApp" name="reset_insertApp" class="btn btn-danger" value="reset" style="display: none;">
                <button type="button" class="btn btn-danger" id="cerrarMoApp" data-dismiss="modal"  >Cancelar</button></center>
            </div>
            </form>
        </div>
    </div>
</div>
   <!--modal delete VisitasAppStore-->
   <button style="display: none;" type="button" id="delete-visitaApp" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteVisitaApp"></button>
     <div style="margin-top: 120px;" class="modal fade" id="deleteVisitaApp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-xs" role="document">
         <div class="modal-content">
           <div class="modal-body" style="text-align: center;">
             <input type="text" id="id_visApp" name="id_visApp" style="display: none; ">
             <center><h3 class="modal-title" id="myModalLabel"><b> ¿ Estas seguro de eliminar Visita AppStore ? </b></h3></center><br><br><br>
             <div class="text-xs-center">
               <button type="button" class="btn btn-success" id="deleteVistaApp" onclick="deleteVisitaApp()"> Si </button>
               <button type="button" class="btn btn-danger" id="NodeleteVistaApp" data-dismiss="modal" > No </button> 
             </div>
           </div>            
         </div>
       </div>
     </div>


<!-- Modal Register  Campaña-->
<div class="modal fade modal-ext" id="rCampanna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xs" >
        <div class="modal-content">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><b>Banco de Datos</b></h4>
            </div>
            <form action="" method="post">
            <div class="modal-body">

            <div class="row" style="text-align: center;">
               <h2>Campaña</h2>
               <div class="col-md-12">
                  <p>Total Audiencia</p>
                  <input type="number" id="audiencia" name="audiencia" placeholder="# Audiencia Campaña" style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
               <div class="col-md-12">
                  <p>Total clics</p>
                  <input type="number" id="totalClicsAudiencia" name="totalClicsAudiencia" placeholder="# Clics Campaña" style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
               <div class="col-md-12">
                  <p>Total Registros</p>
                  <input type="number" id="totalRegistrosAudiencia" name="totalRegistrosAudiencia" placeholder="# Registros Campaña" style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
               <div class="col-xs-12 col-md-12">
                  <p>fecha</p>
                  <input type="date" id="fechaRegistroCamp" name="fechaRegistroCamp"  style="padding: 2px 15px 2px 20px; border-radius: 2px; border: 1px solid #d1c4c4; width: 60%;  ">
               </div>
            </div> <br><br><br>
         </div>   

            <div class="modal-footer"><center>
                <button type="button" id="InsertBanco" name="InsertBanco" onclick=" insertCampanna() " class="btn btn-success btn-md"  >Insertar</button>
                <input type="reset" id="reset_insertCamp" name="reset_insertCamp" class="btn btn-danger" value="reset" style="display: none;">
                <button type="button" class="btn btn-danger" id="cerrarMoCam" data-dismiss="modal"  >Cancelar</button></center>
            </div>
         </form>
        </div>
   </div>
</div>
   <!--modal delete Visitas campaña-->
   <button style="display: none;" type="button" id="delete-visitaCampana" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteVisitaCampana"></button>
     <div style="margin-top: 120px;" class="modal fade" id="deleteVisitaCampana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-xs" role="document">
         <div class="modal-content">
           <div class="modal-body" style="text-align: center;">
             <input type="text" id="id_visCamp" name="id_visCamp" style="display: none; ">
             <center><h3 class="modal-title" id="myModalLabel"><b> ¿ Estas seguro de eliminar Registro Campaña ? </b></h3></center><br><br><br>
             <div class="text-xs-center">
               <button type="button" class="btn btn-success" id="deleteVistaCampana" onclick="deleteRegistroCampana()"> Si </button>
               <button type="button" class="btn btn-danger" id="NodeleteVistaCampana" data-dismiss="modal" > No </button> 
             </div>
           </div>            
         </div>
       </div>
     </div>



<!-- Modal Registro  Facturacion-->
<div class="modal fade modal-ext" id="canalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-clone" aria-hidden="true"></i> Registro - Canal</h3>
      </div>
      <form action="" method="post">
        <div class="modal-body" id="Refacturacion">
          <div class="md-form">
            <center><h5><b>Nombre</b></h5>
              <input style="width: 50%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nomCanal" name="nomCanal" placeholder="Ingrese Nombre Canal">
            </center>
          </div>
          <div class="text-xs-center">
            <button type="button" id="InsertFactura" name="Insertcanal" onclick="verfi_insert_canales()" class="btn btn-success btn-md"  >Insertar</button>
            <input type="reset" id="reset_insert_canal" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </div>
        </div>
      </form>
      <div class="modal-footer">           
        <button type="button" id="cerrarModalcanal" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!--modal delete canal-->
<button style="display: none;" type="button" id="delete-canal" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteCanal"></button>
  <div style="margin-top: 120px;" class="modal fade" id="deleteCanal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center;">
          <input type="text" id="idCanal" name="idCanal" style="display: none; ">
          <center><h3 class="modal-title" id="myModalLabel"><b> ¿ Estas seguro de eliminar <br> canal: <i id="noCanal"></i> ? </b></h3>

          
          </center><br><br><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="deletecanal" onclick="deleteCanal()">Si</button>
            <button type="button" class="btn btn-danger" id="Nodeletecanal" data-dismiss="modal" >No</button> 
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- actualiar canal-->
<button style="display: none;" type="button" id="estado-canal" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#estadocanal"></button>
  <div class="modal fade" id="estadocanal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header" style="padding: 20px; ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <center><h5 class="modal-title" id="myModalLabel"><i class="fa fa-copy"></i> <b>  Detalles Canal</b></h5></center>
         </div>
         <div class="modal-body" style="text-align: center;">
            <input type="hidden" id="idCanal" name="idCanal">
            <p style="font-size: 15px; "><b> Nombre </b> </p> 
            <input type="text" id="nombreCanal" name="nombreCanal" style="padding: 3px; width: 85%; border: 1px solid #e0d7d7" placeholder="Ingrese Nombre Canal" >
         
            <div class="text-xs-center">
               <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalActualizarCanal">Actualizar</button> 
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" id="cerrarCanal" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
    </div>
  </div>
  <div class="modal fade ModalActualizarCanal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 90px;  ">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="padding: 50px; background: #3b3b3b;  ">
        <h2 style="color: #fff;  text-align: center;">¿Éstas seguro de Actualizar Canal?</h2>
        <br><br><br><br>
        <center>
          <button type="hidden" id="update" name="update" onclick="updateCanales()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
          <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
          <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">
        </center>       
      </div>
    </div>
  </div>





<!-- Modal Registro  Rol-->
<div class="modal fade modal-ext" id="rol_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-sm">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-clone" aria-hidden="true"></i> Registro - Rol</h3>
      </div>
      <form action="" method="post">
         <div class="modal-body" id="usuarios">
            <div class="md-form">  
               <center>
               <div class="col-xs-12 ">
                  <div class="md-form">
                     <h5><b>Codigo</b></h5>
                     <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="cod_rol" name="cod_rol" placeholder="Ingrese Codigo Rol">
                  </div>
               </div>
               <div class="col-xs-12 ">
                  <div class="md-form">
                     <h5><b>Nombre</b></h5>
                     <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nom_rol" name="nom_rol" placeholder="Ingrese Nombre">
                  </div>
               </div>
               </center>
            </div>
            <div class="text-xs-center">
               <button type="button" id="InsertRol" name="InsertRol" onclick="insertRol()" class="btn btn-success btn-md"  >Insertar</button>
               <input type="reset" id="reset_insert_Rol" name="reset" class="btn btn-danger" value="reset" style="display: none;">
            </div>
         </div>
      </form>
      <div class="modal-footer">           
        <button type="button" id="cerrarModalRol" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--modal delete Rol -->
<button style="display: none;" type="button" id="delete-rol" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteRol"></button>
  <div style="margin-top: 120px;" class="modal fade" id="deleteRol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center;">
          <input type="text" id="cod_rol_D" name="cod_rol_D" style="display: none; ">
          <center><h3 class="modal-title" id="myModalLabel"><b>¿ Estas seguro de eliminar <br> Rol: <i id="nombre_rol_D"></i> ? </b></h3></center><br><br><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="deleteRol" onclick="deleteRol()"> Si </button>
            <button type="button" class="btn btn-danger" id="NodeleteRol" data-dismiss="modal" > No </button> 
          </div>
        </div>            
      </div>
    </div>
  </div>

<!--modal actualizar Rol-->
<button style="display: none;" type="button" id="estado-rol" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#estadoRol"></button>
  <div class="modal fade" id="estadoRol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding: 20px; ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <center><h5 class="modal-title" id="myModalLabel"> <i class="fa fa-copy"></i> <b> Detalles Rol</b></h5></center>
        </div>
        <div class="modal-body" >
          
            <form action="" method="post">
               <div class="modal-body" id="usuarios" style="text-align: center;">
                  <div class="md-form">  
                  <center>
                  <div class="col-xs-12 ">
                     <div class="md-form">
                        <input style="display: none;" type="number" id="cod_rol_u" name="cod_rol_u" placeholder="Ingrese Codigo">
                        <h5><b>Nombre</b></h5>
                        <input style="width: 100%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nom_rol_u" name="nom_rol_u" placeholder="Ingrese Nombre">
                     </div>
                  </div>
                  
                  </center>
               </div>
                  <div class="text-xs-center">
                     <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalAct_Rol">Actualizar</button>
                     <input type="reset" id="reset_Update_rol" name="reset" class="btn btn-danger" value="reset" style="display: none;">
                  </div>
               </div>
            </form>
            <div class="modal-footer">
             <button type="button" id="cerrarRolu" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
      </div>
   </div>
   </div>
   <div class="modal fade ModalAct_Rol" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 130px;  ">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="padding: 50px; background: #3b3b3b;  ">
        <h2 style="color: #fff;  text-align: center;">¿Éstas seguro de Actualizar el Registro?</h2>
        <br><br><br><br>
        <center>
          <button type="hidden" id="update" name="update" onclick="updateRol()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
          <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
          <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </center>       
      </div>
    </div>
   </div>



                   


<!-- Modal Registro  Canal-->
<div class="modal fade modal-ext" id="cc_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-sm">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-clone" aria-hidden="true"></i> Registro - Canal </h3>
      </div>
      <form action="" method="post">
         <div class="modal-body" id="usuarios">
            <div class="md-form">  
               <center>
               <div class="col-xs-12 ">
                  <div class="md-form">
                     <h5><b>Nombre</b></h5>
                     <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nom_canalC" name="nom_canalC" placeholder="Ingrese Nombre">
                  </div>
               </div>
               <div class="col-xs-12 ">
                  <div class="md-form">
                     <h5><b>Capacidad</b></h5>
                     <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="megas_canal" name="megas_canal" placeholder="Ingrese  Valor Capacidad">
                  </div>
               </div>
               </center>
            </div>
            <div class="text-xs-center">
               <button type="button" id="InsertCaC" name="InsertCaC" onclick="inserCanalesContratados()" class="btn btn-success btn-md"  >Insertar</button>
               <input type="reset" id="reset_insert_Cc" name="reset" class="btn btn-danger" value="reset" style="display: none;">
            </div>
         </div>
      </form>
      <div class="modal-footer">           
        <button type="button" id="cerrarModalCc" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal delete Canal -->
<button style="display: none;" type="button" id="delete-cc" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteCc"></button>
  <div style="margin-top: 120px;" class="modal fade" id="deleteCc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center;">
          <input type="text" id="id_can_cD" name="id_can_cD" style="display: none; ">
          <center><h3 class="modal-title" id="myModalLabel"><b>¿ Estas seguro de eliminar <br> Canal: <i id="nombre_ccD"></i> ? </b></h3></center><br><br><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="deleteCc" onclick="deleteCanalesContratados()"> Si </button>
            <button type="button" class="btn btn-danger" id="NodeleteCc" data-dismiss="modal" > No </button> 
          </div>
        </div>            
      </div>
    </div>
  </div>

<!--modal actualizar Canal-->
<button style="display: none;" type="button" id="estado-cc" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#estadoCa_con"></button>
  <div class="modal fade" id="estadoCa_con" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding: 20px; ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <center><h5 class="modal-title" id="myModalLabel"> <i class="fa fa-copy"></i> <b> Detalles Canal</b></h5></center>
        </div>
        <div class="modal-body" >
          
            <form action="" method="post">
               <div class="modal-body" id="usuarios" style="text-align: center;">
                  <div class="md-form">  
                  <center>
                  <div class="col-xs-12 ">
                     <div class="md-form">
                        <input style="display: none;" type="number" id="id_cc" name="id_cc" >
                        <h5><b>Gigas</b></h5>
                        <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="number" id="megas" name="megas" placeholder="Ingrese Capacidad Gigas">
                     </div>
                  </div>
                  <div class="col-xs-12 ">
                     <div class="md-form">
                        <h5><b>Nombre</b></h5>
                        <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nom_cc" name="nom_cc" placeholder="Ingrese Nombre">
                     </div>
                  </div>
                  
                  </center>
               </div>
                  <div class="text-xs-center">
                     <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalAct_Cc">Actualizar</button>
                     <input type="reset" id="reset_Update_cc" name="reset" class="btn btn-danger" value="reset" style="display: none;">
                  </div>
               </div>
            </form>
            <div class="modal-footer">
             <button type="button" id="cerrarCcU" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
      </div>
   </div>
   </div>
   <div class="modal fade ModalAct_Cc" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 130px;  ">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="padding: 50px; background: #3b3b3b;  ">
        <h2 style="color: #fff;  text-align: center;">¿Éstas seguro de Actualizar el Registro?</h2>
        <br><br><br><br>
        <center>
          <button type="hidden" id="updateCc" name="updateCc" onclick="updateCanalesContrados()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
          <button type="hidden" id="cerrarCc" name="cerrarCc"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
          </center>       
      </div>
    </div>
   </div>



<!--modal actualizar Canal-->
<button style="display: none;" type="button" id="estado-espacioUsado" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#espacioUsadoUpdate"></button>
  <div class="modal fade" id="espacioUsadoUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding: 20px; ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <center><h5 class="modal-title" id="myModalLabel"> <i class="fa fa-copy"></i> <b> Detalles Espacio</b></h5></center>
        </div>
        <div class="modal-body" >
          
            <form action="" method="post">
               <div class="modal-body" id="usuarios" style="text-align: center;">
                  <div class="md-form">  
                  <center>
                  <div class="col-xs-12 ">
                     <div class="md-form">
                        <h5><b>Capacidad:  <i id="capacidadEspacio">  </i> <i> GB</i> </b></h5>
                     </div>
                  </div> 
                  <div class="col-xs-12 "><hr><br></div>   
                  <div class="col-xs-12 ">
                     <div class="md-form">
                        <input style="display: none;" type="number" id="id_usado" name="id_cc" >
                        <h5><b>Usado</b></h5>
                        <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="number" id="espacioUsado" name="espacioUsado" placeholder="Ingrese Espacio Usado">
                     </div>
                     
                  </div>
                  </center>
               </div>
                  <div class="text-xs-center">
                     <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalAct_EspacioUsado">Actualizar</button>
                  </div>
               </div>
            </form>
            <div class="modal-footer">
             <button type="button" id="cerrarEspacio" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
      </div>
   </div>
   </div>
   <div class="modal fade ModalAct_EspacioUsado" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 130px;  ">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="padding: 50px; background: #3b3b3b;  ">
        <h2 style="color: #fff;  text-align: center;">¿Éstas seguro de Actualizar el Registro?</h2>
        <br><br><br><br>
        <center>
          <button type="hidden" id="updateEspacio" onclick="updateEspacioUsado()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
          <button type="hidden" id="cerrarModalEspacio"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
          </center>       
      </div>
    </div>
   </div>




<!-- Modal Registro  Repaldo nube-->
<div class="modal fade modal-ext" id="inserRespalNube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-sm">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-clone" aria-hidden="true"></i> Registro - Respaldo</h3>
      </div>
      <form action="" method="post">
         <div class="modal-body" id="usuarios">
            <div class="md-form">  
               <center>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                        <input style="display: none;" type="number" id="id_usInsert" name="id_usInsert" >
                        <input style="display: none;" type="number" id="espacRetencion" name="espacRetencion" >
                           <h5><b>Nombre</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nombreGRinsert" name="nombreGRinsert" placeholder="Ingrese Nombre">
                        </div>
                     </div>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                           <h5><b>Capacidad</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="capacidaGRinsert" name="capacidaGRinsert" placeholder="Ingrese Valor Capacidad">
                        </div>
                     </div>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                           <h5><b>Retencion</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="retencionGRinsert" name="retencionGRinsert" placeholder="Ingrese Valor Retencion">
                        </div>
                     </div>
                     <p> <i id="infoEsp_disponibleInsert"></i></p>
                     </center>
            </div>
            <div class="text-xs-center">
               <button type="button" id="InsertRol" name="InsertRol" onclick="insertRepaldoNube()" class="btn btn-success btn-md"  >Insertar</button>
               <input type="reset" id="reset_insert_RespaldoNube" name="reset" class="btn btn-danger" value="reset" style="display: none;">
            </div>
         </div>
      </form>
      <div class="modal-footer">           
        <button type="button" id="cerrarModalRespaldo" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- modal actualizar Respaldo Nube-->
<button style="display: none;" type="button" id="estado-RepaldoNube" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#estadoRespaldoNube"></button>
  <div class="modal fade" id="estadoRespaldoNube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding: 20px; ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <center><h5 class="modal-title" id="myModalLabel"> <i class="fa fa-copy"></i> <b> Detalles Retencion</b></h5></center>
        </div>
        <div class="modal-body" >
          
            <form action="" method="post">
               <div class="modal-body" id="usuarios" style="text-align: center;">
                  <div class="md-form">  
                     <center>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                        <input style="display: none;" type="number" id="gres_idU" name="gres_idU" >
                        <input style="display: none;" type="number" id="idUsU" name="idUsU" >
                        <input style="display: none;" type="number" id="dispRetencion" name="dispRetencion" >
                        <input style="display: none;" type="number" id="AlmacenadoRetencion" name="AlmacenadoRetencion" >
                           <h5><b>Nombre</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nombreGRU" name="nombreGRU" placeholder="Ingrese Nombre">
                        </div>
                     </div>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                           <h5><b>Capacidad</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="capacidaGRU" name="capacidaGRU" placeholder="Ingrese Valor Capacidad">
                        </div>
                     </div>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                           <h5><b>Retencion</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="retencionGRU" name="retencionGRU" placeholder="Ingrese Valor Retencion">
                        </div>
                     </div>
                     <p> <i id="infoEsp_disponible"></i></p>
                     </center>
                  </div>
                  <div class="text-xs-center">
                     <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalAct_RetencionNube">Actualizar</button>
                     <input type="reset" id="reset_Update_Retencion" name="reset" class="btn btn-danger" value="reset" style="display: none;">
                  </div>
               </div>
            </form>
            <div class="modal-footer">
             <button type="button" id="cerrarRetencion" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
      </div>
   </div>
   </div>
   <div class="modal fade ModalAct_RetencionNube" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 130px;  ">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="padding: 50px; background: #3b3b3b;  ">
        <h2 style="color: #fff;  text-align: center;">¿Éstas seguro de Actualizar Respaldo?</h2>
        <br><br><br><br>
        <center>
          <button type="hidden" id="update" name="update" onclick="updateRetencionNube()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
          <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
          <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </center>       
      </div>
    </div>
   </div>
<!--modal delete respaldo -->
<button style="display: none;" type="button" id="delete-repaldo" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteRespado"></button>
  <div style="margin-top: 120px;" class="modal fade" id="deleteRespado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center;">
          <input type="text" id="id_gresDel" name="id_gresDel" style="display: none; ">
          <input type="text" id="id_userDel" name="id_userDel" style="display: none; ">
          <center><h3 class="modal-title" id="myModalLabel"><b>¿ Estas seguro de eliminar <br> Respaldo: 
          <i id="nombGresNube"></i> ? </b></h3></center><br><br><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="sideleteRespaldo" onclick="deleteRespaldo()"> Si </button>
            <button type="button" class="btn btn-danger" id="NodeleteRespaldo" data-dismiss="modal" > No </button> 
          </div>
        </div>            
      </div>
    </div>
   </div>



<!-- modal actualizar Usuario cliente Nube -->
<button style="display: none;" type="button" id="estado-usuarioNube" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#estadoUsuarioSerNube"></button>
  <div class="modal fade" id="estadoUsuarioSerNube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding: 20px; ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <center><h5 class="modal-title" id="myModalLabel"> <i class="fa fa-copy"></i> <b> Detalles Usuario</b></h5></center>
        </div>
        <div class="modal-body" >
          
            <form action="" method="post">
               <div class="modal-body" id="usuarios" style="text-align: center;">
                  <div class="md-form">  
                     <center>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                        <input style="display: none;" type="number" id="id_userNu" name="id_userNu" >
                        <input style="display: none;" type="number" id="idClienteUsuario" name="idClienteUsuario" >
                        <input style="display: none;" type="number" id="detalleDesde" name="detalleDesde" >
                        <input style="display: none;" type="number" id="cuotaAlmacenada" name="cuotaAlmacenada" >
                           <h5><b>Nombre</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nombre_user" name="nombre_user" placeholder="Ingrese Nombre">
                        </div>
                     </div>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                           <h5><b>Cuota</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="cuotaUser" name="cuotaUser" placeholder="Ingrese Valor Cuota">
                        </div>
                     </div>
                     <p><i id="infoEspaDisClienteUpdate"></i></p>
                     </center>
                  </div>
                  <div class="text-xs-center">
                     <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalAct_UsuarioNube">Actualizar</button>
                     <input type="reset" id="reset_Update_Usuario" name="reset" class="btn btn-danger" value="reset" style="display: none;">
                  </div>
               </div>
            </form>
            <div class="modal-footer">
             <button type="button" id="cerrarUsuario" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
      </div>
   </div>
   </div>
   <div class="modal fade ModalAct_UsuarioNube" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 130px;  ">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="padding: 50px; background: #3b3b3b;  ">
        <h2 style="color: #fff;  text-align: center;">¿Éstas seguro de Actualizar Usuario?</h2>
        <br><br><br><br>
        <center>
          <button type="hidden" id="update" name="update" onclick="updateUsuarioNube()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
          <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
          <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </center>       
      </div>
    </div>
   </div>
<!--modal delete Usuario -->
<button style="display: none;" type="button" id="delete-usuarioNube" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteUsuarioNube"></button>
  <div style="margin-top: 120px;" class="modal fade" id="deleteUsuarioNube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center;">
          <input type="text" id="idUsuarioN" name="idUsuarioN" style="display: none; ">
          <input style="display: none;" type="number" id="id_clienteUs" name="id_clienteUs" >
          <input style="display: none;" type="number" id="deleteDesde" name="deleteDesde" >
          <center><h3 class="modal-title" id="myModalLabel"><b>¿ Estas seguro de eliminar <br> Usuario: 
          <i id="nombUsuarionube"></i> ? </b></h3></center><br><br><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="sideleteUsuario" onclick="deleteUsuarioNube()"> Si </button>
            <button type="button" class="btn btn-danger" id="NodeleteUsuario" data-dismiss="modal" > No </button> 
          </div>
        </div>            
      </div>
    </div>
   </div>
<!-- Modal Registro  Usuario Nube-->
<div class="modal fade modal-ext" id="inserUsuarioNube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-sm">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-clone" aria-hidden="true"></i> Registro - Usuario</h3>
      </div>
      <form action="" method="post">
         <div class="modal-body" id="usuarios">
            <div class="md-form">  
               <center>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                        <input style="display: none;" type="number" id="id_ClienteInsert" name="id_ClienteInsert" >
                           <h5><b>Nombre</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nombreClienteinsert" name="nombreClienteinsert" placeholder="Ingrese Nombre">
                        </div>
                     </div>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                           <h5><b>Cuota</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="cuotaClienteinsert" name="cuotaClienteinsert" placeholder="Ingrese Valor Cuota">
                        </div>
                     </div>
                     <p><i id="infoEspaDisClienteInsert"></i></p>
                     </center>
            </div>
            <div class="text-xs-center">
               <button type="button" id="InsertUsuario" name="InsertUsuario" onclick="insertUsuarioNube()" class="btn btn-success btn-md"  >Insertar</button>
               <input type="reset" id="reset_insert_UsuarioNube" name="reset" class="btn btn-danger" value="reset" style="display: none;">
            </div>
         </div>
      </form>
      <div class="modal-footer">           
        <button type="button" id="cerrarModalUsuario" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal Registro  Usuario Nube-->
<div class="modal fade modal-ext" id="inserClienteNube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-sm">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-clone" aria-hidden="true"></i> Registro - Cliente</h3>
      </div>
      <form action="" method="post">
         <div class="modal-body" id="Clientes">
            <div class="md-form">  
               <center>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                           <h5><b>Nombre</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nomCliente" name="nomCliente" placeholder="Ingrese Nombre">
                        </div>
                     </div>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                           <h5><b>Capacidad</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="capacidadCliente" name="capacidadCliente" placeholder="Ingrese Valor Capacidad ">
                        </div>
                     </div>
                     
                     </center>
            </div>
            <div class="text-xs-center">
               <button type="button" id="InsertCliente" name="InsertCliente" onclick="insertClienteNube()" class="btn btn-success btn-md"  >Insertar</button>
               <input type="reset" id="reset_insert_ClienteNube" name="reset" class="btn btn-danger" value="reset" style="display: none;">
            </div>
         </div>
      </form>
      <div class="modal-footer">           
        <button type="button" id="cerrarModalCliente" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- modal actualizar Cliente Nube-->
<button style="display: none;" type="button" id="estado-clienteNube" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#estadoClienteNube"></button>
  <div class="modal fade" id="estadoClienteNube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding: 20px; ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <center><h5 class="modal-title" id="myModalLabel"> <i class="fa fa-copy"></i> <b> Detalles Usuario</b></h5></center>
        </div>
        <div class="modal-body" >
          
            <form action="" method="post">
               <div class="modal-body" id="usuarios" style="text-align: center;">
                  <div class="md-form">  
                     <center>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                        <input style="display: none;" type="number" id="idclienteU" name="idclienteU" >
                           <h5><b>Nombre</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nombre_clienteU" name="nombre_clienteU" placeholder="Ingrese Nombre">
                        </div>
                     </div>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                           <h5><b>Capacidad</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="capacidadClienteU" name="capacidadClienteU" placeholder="Ingrese Valor Capacidad">
                        </div>
                     </div>
                     </center>
                  </div>
                  <div class="text-xs-center">
                     <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalAct_Cliente">Actualizar</button>
                     <input type="reset" id="reset_Update_Usuario" name="reset" class="btn btn-danger" value="reset" style="display: none;">
                  </div>
               </div>
            </form>
            <div class="modal-footer">
             <button type="button" id="cerrarCliente" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
      </div>
   </div>
   </div>
   <div class="modal fade ModalAct_Cliente" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 130px;  ">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="padding: 50px; background: #3b3b3b;  ">
        <h2 style="color: #fff;  text-align: center;">¿Éstas seguro de Actualizar Cliente?</h2>
        <br><br><br><br>
        <center>
          <button type="hidden" id="update" name="update" onclick="updateClienteNube()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
          <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
          <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </center>       
      </div>
    </div>
   </div>
<!--modal delete Usuario -->
<button style="display: none;" type="button" id="delete-clienteNube" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteClienteNube"></button>
  <div style="margin-top: 120px;" class="modal fade" id="deleteClienteNube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center;">
          <input type="text" id="idClienteN" name="idClienteN" style="display: none; ">
          <center><h3 class="modal-title" id="myModalLabel"><b>¿ Estas seguro de eliminar <br> Usuario: 
          <i id="nombClientenube"></i> ? </b></h3></center><br><br><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="sideleteCliente" onclick="deleteClienteNube()"> Si </button>
            <button type="button" class="btn btn-danger" id="NodeleteCliente" data-dismiss="modal" > No </button> 
          </div>
        </div>            
      </div>
    </div>
   </div>
<!-- Modal para escoger los subservicios -->

<button id="verSubservicios" class="btn btn-primary" data-toggle="modal" data-target="#verSubservicios2" style="display: none;"></button>

<div class="modal fade" id="verSubservicios2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!--Content-->
        <div class="modal-content" style="background: #fff; height: 500px; width: 600px; margin-top: 10%; margin-left: 30%;">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <center><h4 class="modal-title" id="myModalLabel"><b>Seleccionar Subservicios</b></h4></center>
            </div>
            <!--Body-->
            <div class="modal-body">

              <div id="prod">
                

              </div>

              <div id="totsser"></div>
              
               
            <!--Footer-->
            <div class="text-xs-center">
            <button type="button" class="btn btn-danger" id="NodeleteCliente" data-dismiss="modal" > Aceptar </button> 
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
</div>

<!-- Modal para actualizar los subservicios -->

<button id="updateSubs" class="btn btn-primary" data-toggle="modal" data-target="#verSubservicios3" style="display: none;"></button>

<div class="modal fade" id="verSubservicios3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!--Content-->
        <div class="modal-content" style="background: #fff; height: 500px; width: 600px; margin-top: 10%; margin-left: 30%;">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <center><h4 class="modal-title" id="myModalLabel"><b>Seleccionar Subservicios</b></h4></center>
            </div>
            <!--Body-->
            <div class="modal-body">

              <div id="prod2">
                

              </div>

              <div id="totsser2"></div>

              <!--<div id="updsubs"></div>-->
              
               
            <!--Footer-->
            <div class="text-xs-center">
            <button type="button" class="btn btn-danger" id="NodeleteCliente" data-dismiss="modal" > Aceptar </button> 
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
</div>

<!-- modal actualizar Respaldo Nube-->
<button style="display: none;" type="button" id="estado-licenciaNube" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#estadolicenciaNube"></button>
  <div class="modal fade" id="estadolicenciaNube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding: 20px; ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <center><h5 class="modal-title" id="myModalLabel"> <i class="fa fa-copy"></i> <b> Detalles Retencion</b></h5></center>
        </div>
        <div class="modal-body" >
          
            <form action="" method="post">
               <div class="modal-body" id="usuarios" style="text-align: center;">
                  <div class="md-form">  
                     <center>
                     <div class="col-xs-12 ">
                        <div class="md-form">
                           <input style="display: none;" type="number" id="idUsU" name="idUsU" >
                           <h5><b>Fecha caducidad</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="date" id="fechaCaduLicencia" name="fechaCaduLicencia" >
                        </div>
                        <div class="md-form">
                           <input style="display: none;" type="number" id="idUsU" name="idUsU" >
                           <h5><b>Ultimo Pago</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="date" id="ultimoPago" name="ultimoPago" >
                        </div>
                        <div class="md-form">
                           <input style="display: none;" type="number" id="idUsU" name="idUsU" >
                           <h5><b>Monto</b></h5>
                           <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="number" id="montoLicencia" name="montoLicencia" placeholder="Ingrese Monto Retencion">
                        </div>
                     </div>
                     
                     </center>
                  </div>
                  <div class="text-xs-center">
                     <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalAct_LicenciaNube">Actualizar</button>
                     <input type="reset" id="reset_Update_Retencion" name="reset" class="btn btn-danger" value="reset" style="display: none;">
                  </div>
               </div>
            </form>
            <div class="modal-footer">
             <button type="button" id="cerrarLicencia" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
      </div>
   </div>
   </div>
   <div class="modal fade ModalAct_LicenciaNube" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="top: 130px;  ">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="padding: 50px; background: #3b3b3b;  ">
        <h2 style="color: #fff;  text-align: center;">¿Éstas seguro de Actualizar Fecha?</h2>
        <br><br><br><br>
        <center>
          <button type="hidden" id="update" name="update" onclick="updateLicenciaNube()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
          <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
          <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </center>       
      </div>
    </div>
   </div>

    
                        <div id="noPermisos" style="display: none;">
                          <CENTER>
                                              <br><br>
                              <h1 style="color:#83a7ce">NO TIENES PERMISOS PARA VER ESTE MODULO</h1>
                                  <img src="Public/img/acceso_denegado.png" style="width:200px">
                          </CENTER>
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
