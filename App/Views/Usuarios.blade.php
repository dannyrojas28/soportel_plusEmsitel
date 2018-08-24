<?php

    include "App/Views/includes/header.blade.php";

    require_once 'App/Controllers/PrincipalController.php';
    require_once 'Config/vars.php';

      //inicializo el controlador Principal
      $PrincipalController = new PrincipalController();  
    $estado = "ADMINISTRADOR";

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
                        if($_SESSION['tipo_rol'][$i] ==  "ADMINISTRADOR"){
                          $cod = $_SESSION['tipo_rol'][$i];
                            $pag = true;   
                        }
                      }
                      if($pag == true){
                      
                     
                    ?>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="Public/js/toastr.js?n=1"></script>
<script src="Public/js/usuario.js"></script>
<script>
   selecUsuarios();
   selecRoles();
</script>

<br>



<div id="usuarios" >
   <div class="col-xs-6 col-md-offset-3">
      <center><h3><b>Detalles usuarios</b></h3></center>
   </div>
   <div class="col-xs-3" ">
      <button style="float: right; margin-right: 18px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#usuarios_register" > Registrar</button>                
   </div>
   <table id="tableusuarios" class="table table-bordered" style="text-align: center; margin: 0 auto; width: 80%; ">
      <thead  style="background: #7cb5ec; padding: 1em; color: #000; ">
         <tr >
            <th style="text-align: center;">Usuario</th>
            <th style="text-align: center;">Contraseña</th>
            <th style="text-align: center;">Documento</th>
            <th style="text-align: center;">Nombre</th>
            <th style="text-align: center;">Apellido</th>
            <th style="text-align: center;">Telefono</th>     
            <th style="text-align: center;">Rol</th>     
            <th style="text-align: center;" colspan="2">Opciones</th>     
         </tr>
      </thead>
      <tbody id="cuerpousuarios">
      </tbody>
   </table>  
</div>


<!-- Modal Registro  Facturacion-->
<div class="modal fade modal-ext" id="usuarios_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-xs">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-clone" aria-hidden="true"></i> Registro - Usuarios</h3>
      </div>
      <form action="" method="post">
         <div class="modal-body" id="usuarios">
            <div class="md-form">  
               <center>
               <div class="col-xs-12 col-md-6">
                  <div class="md-form">
                     <h5><b>Nombre</b></h5>
                     <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nombreUsuario" name="nombreUsuario" placeholder="Ingrese Nombre">
                  </div>
               </div>
               <div class="col-xs-12 col-md-6">
                  <div class="md-form">
                     <h5><b>Apellido</b></h5>
                     <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="apellidoUsuario" name="apellidoUsuario" placeholder="Ingrese Nombre">
                  </div>
               </div>
               <div class="col-xs-12 col-md-6">   
                  <div class="md-form">   
                     <h5><b>Documento</b></h5>
                     <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="number" id="documentoUsuario" name="documentoUsuario" placeholder="Ingrese Nombre">
                  </div>
               </div>
               <div class="col-xs-12 col-md-6">   
                  <div class="md-form">   
                     <h5><b>Telefono</b></h5>
                     <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="number" id="telefonoUsuario" name="telefonoUsuario" placeholder="Ingrese Nombre">
                  </div>
               </div>
               <div class="col-xs-12 col-md-6">   
                  <div class="md-form">   
                     <h5><b>Usuario</b></h5>
                     <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="usuarioUsuario" name="usuarioUsuario" placeholder="Ingrese Nombre">
                  </div>  
               </div>
               <div class="col-xs-12 col-md-6">   
                  <div class="md-form">   
                     <h5><b>Contraseña</b></h5>
                     <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="password" id="passwordUsuario" name="passwordUsuario" placeholder="Ingrese Nombre">
                  </div>   
               </div>
               </center>
            </div>
            
            <div class="col-xs-12">
               <div class="md-form">
                  <center> 
                     <h5><b>Rol</b></h5>
                     <?php
                                $re = 0;
                                     $selecteco =$PrincipalController->CheckboxRol();
                                     $i=1;
                                     while ($res = mysqli_fetch_object($selecteco)) {
                                       # code...
                                        echo '
                                                <input type="hidden" name="rolusuarioDeta'.$i.'" id="rolusuarioDeta'.$i.'" value="'.utf8_encode($res->cod_rol).'"> 
                                                <br><div class="form-group col-xs-12" style="float:left;text-align:left;margin-bottom:0px"> 
                                                <input type="checkbox" name="rol_usuDeta'.$i.'" id="rol_usuDeta'.$i.'" value="'.utf8_encode($res->nombre_rol).'"> 
                                                <label for="rol_usuDeta'.$i.'">'.utf8_encode($res->nombre_rol).'</label>
                                              </div>';
                                              $i+=1;
                                     }
                                     $i=$i - 1;
                                     echo '<input type="hidden" name="num_roles" id="num_roles" value="'.$i.'">';
                      ?>
                  </center>
               </div>               
            </div>
          
            <div class="text-xs-center">
               <button type="button" id="InsertUsuario" name="InsertUsuario" onclick="insertUsuario()" class="btn btn-success btn-md"  >Insertar</button>
               <input type="reset" id="reset_insert_usuario" name="reset" class="btn btn-danger" value="reset" style="display: none;">
            </div>
         </div>
      </form>
      <div class="modal-footer">           
        <button type="button" id="cerrarModalUsuario" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--modal delete Facturacion -->
<button style="display: none;" type="button" id="delete-usuario" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deletefacturacion"></button>
  <div style="margin-top: 120px;" class="modal fade" id="deletefacturacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center;">
          <input type="text" id="cod_us" name="cod_us" style="display: none; ">
          <center><h3 class="modal-title" id="myModalLabel"><b> ¿ Estas seguro de eliminar <br> Usuario: <span id="nomUsu"></span> ? </b></h3></center><br><br><br>
          <div class="text-xs-center">
            <button type="button" class="btn btn-success" id="deleteUsu" onclick="deleteUsu()"> Si </button>
            <button type="button" class="btn btn-danger" id="NodeleteUsu" data-dismiss="modal" > No </button> 
          </div>
        </div>            
      </div>
    </div>
  </div>

<!--modal actualizar factura-->
<button style="display: none;" type="button" id="estado-usuario" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#estadousuario"></button>
  <div class="modal fade" id="estadousuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
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
                  <div class="col-xs-12 col-md-6">
                     <div class="md-form">
                        <input style="display: none;" type="text" id="cod_usu" name="cod_usu" placeholder="Ingrese Nombre">
                        <h5><b>Nombre</b></h5>
                        <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="nombreUs" name="nombreUs" placeholder="Ingrese Nombre">
                     </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                     <div class="md-form">
                        <h5><b>Apellido</b></h5>
                        <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="apellidoUs" name="apellidoUs" placeholder="Ingrese Nombre">
                     </div>
                  </div>
                  <div class="col-xs-12 col-md-6">   
                     <div class="md-form">   
                        <h5><b>Documento</b></h5>
                        <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="documentoUs" name="documentoUs" placeholder="Ingrese Nombre">
                     </div>
                  </div>
                  <div class="col-xs-12 col-md-6">   
                     <div class="md-form">   
                        <h5><b>Telefono</b></h5>
                        <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="telefonoUs" name="telefonoUs" placeholder="Ingrese Nombre">
                     </div>
                  </div>
                  <div class="col-xs-12 col-md-6">   
                     <div class="md-form">   
                        <h5><b>Usuario</b></h5>
                        <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="usuarioUs" name="usuarioUs" placeholder="Ingrese Nombre">
                     </div>  
                  </div>
                  <div class="col-xs-12 col-md-6">   
                     <div class="md-form">   
                        <h5><b>Contraseña</b></h5>
                        <input style="width: 80%; padding: 5px; border-radius: 3px; border: 1px solid #d6cfcf" type="text" id="passwordUs" name="passwordUs" placeholder="Ingrese Nombre">
                     </div>   
                  </div>
                  </center>
               </div>
               <div class="col-xs-12">
                  <div class="md-form">
                     <center> 
                        <h5><b>Rol</b></h5>
                        <?php
                                    $re = 0;
                                     $selecteco =$PrincipalController->CheckboxRol();
                                     $i=1;
                                     while ($res = mysqli_fetch_object($selecteco)) {
                                       # code...
                                        echo '
                                                <input type="hidden" name="rolusuarioU'.$i.'" id="rolusuarioU'.$i.'" value="'.$res->cod_rol.'"> 
                                                <input type="hidden" name="val_usuU'.$i.'" id="val_usuU'.$i.'" value=""> 
                                                <input type="hidden" name="cod_usuU'.$i.'" id="cod_usuU'.$i.'" value=""> 
                                                <br><div class="form-group col-xs-12" style="float:left;text-align:left;margin-bottom:0px"> 
                                                <input type="checkbox" name="rol_usuU'.$i.'" id="rol_usuU'.$i.'" value="'.utf8_encode($res->nombre_rol).'"> 
                                                <label for="rol_usuU'.$i.'">'.utf8_encode($res->nombre_rol).'</label>
                                              </div>';
                                              $i+=1;
                                     }
                                     $i=$i - 1;
                                     echo '<input type="hidden" name="num_roles" id="num_rolesU" value="'.$i.'">';
                        ?>
                     </center>
                  </div>               
               </div>
             
               <div class="text-xs-center">
                  <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target=".ModalActualizar">Actualizar</button>
                  <input type="reset" id="reset_Update_usuario" name="reset" class="btn btn-danger" value="reset" style="display: none;">
               </div>
            </div>
         </form>
        <div class="modal-footer">
          <button type="button" id="cerrarUsuario" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
          <button type="hidden" id="update" name="update" onclick="updateUsuario()" class="btn btn-success btn-md" data-dismiss="modal" > ¡Si!</button>
          <button type="hidden" id="delete" name="delete"  data-dismiss="modal" class="btn btn-danger btn-md" >¡No!</button> 
          <input type="reset" id="reset_insert" name="reset" class="btn btn-danger" value="reset" style="display: none;">
          </center>       
      </div>
    </div>
  </div>











     
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

