<?php
    $print = "";
    $roles= count($_SESSION['tipo_rol']);
    for ($i=0; $i < $roles; $i++) { 
        # code...
        
        if(($i + 1) == $roles){
            $print = $print.$_SESSION['tipo_rol'][$i];
        }else{
            $print = $print.$_SESSION['tipo_rol'][$i]."<br>";
        }
    }

?>

<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<link href='Public/css/compiled.css' rel='stylesheet' id='compiled.css-css'   type='text/css' media='all' />
<!--/. SideNav slide-out button -->

 <!-- Sidebar navigation -->
<ul id="slide-out" class="side-nav fixed admin-side-nav stylish-side-nav">

     <div class="logo-wrapper">
        <img src="/soportel_plus/Public/img/user.png" class="img-fluid img-circle">
        <div class="rgba-stylish-strong"><p class="user white-text"><?php echo $print;?> <br>
        <?php echo $_SESSION['nombres'];?></p></div>
    </div>
    <!--/. Logo -->

    <!-- Side navigation links -->
    <ul class="collapsible collapsible-accordion">
        <li><a href="Inicio" class="waves-light"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="Usuarios" class="waves-light"> <i class="fa fa-users"></i>  Añadir Usuarios</a></li>
        <li><a href="#" class="waves-light"><i class="fa fa-gears "></i> Privacidad</a></li>
        <li><a href="BancoDatos" class="waves-light"><i class="fa fa-database" ></i> Banco de Datos</a></li>
        <li><a href="Cerrarsession" id="show_login" ><i class="fa fa-power-off"></i> <span >Cerrar Sesión</span></a></li>
    </ul>
    <!--/. Side navigation links -->
    
</ul>
<!--/. Sidebar navigation -->


<!--Navbar-->
<nav class="navbar navbar-fixed-top scrolling-navbar double-nav  top-nav-collapse" style="background-color: #ffffff; padding-bottom: 10px; ">
    <!-- SideNav slide-out button -->
    <div class="pull-left">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
    </div>
    <!-- Breadcrumb-->
    <div class="" style="padding: 0px 0px 0px 40px">
        <center>
            <?php include "App/Views/includes/btn-emsitel.blade.php";  ?>
        </center>                     
    </div>
   
</nav>

<script src="Public/js/telefonia.js"></script>
<script src="Public/js/ventas.js"></script>
<script src="Public/js/nube.js"></script>
<script src="Public/js/emsivoz.js"></script>
<script src="Public/js/contable.js"></script>
<script src="Public/js/comercial.js"></script>
<script type="text/javascript">
  
    //canales();
    
    Meta();
    MinutosTodos();
    CabinasInactivas();
    MantenimientosAtrasados();

    todofacturacion();
    selectDreamPBX();
    selectFreePBX();

    // emsivoz
    llamadasEmsivoz();

    // nube
    pgVMActivas()
    pgHosts()
    licencia()
    totalEspacio()

    //emsivoz
    recargasSemC();
    
    // contable
    Bancos();
    cartaDificilCobro();
    
    // comercial
    ContactosGestion();
    
    
</script>
