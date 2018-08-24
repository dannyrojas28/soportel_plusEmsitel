<?php

    include "App/Views/includes/header.blade.php";
    $estado = "Contabilidad";
?>

<main style="background-color: #f3f3f3; height: 1000px; ">
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
                        <CENTER>
                            <br><br>
                            <h1 style="color:#83a7ce">AREA CONTABLE</h1>
                        </CENTER>
                            <script src="Public/js/contable.js"></script>
                            <script>
                               eventContable();
                               Caja();
                               Bancos();
                               facturas()
                               cateraCorriente()
                               cartaDificilCobro()
                               bancoDifDebitoCredito();
                               proveedores();
                               impuestosRetefuente();
                               impuestosMinTic();
                               impuestosIva();
                               impuestosCree();
                               impuestosCrc();
                                nomina()
                            </script>
                            <br><br><br>
                        <div id="activos" class="col-xs-12">
                            <center><h4><b>ACTIVOS</b></h4></center><br><br>
                        </div>
                        <div class="col-xs-12 col-md-3" >
                            <div class="col-xs-12" style="background-color: #fff; color: #000;  padding:2px; ">
                                <h5>CAJA</h5>
                                <h3 id="caja"></h3>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3" >
                            <div class="col-xs-12" style="background-color: #fff; color: #000;  padding:2px; ">
                                <h5>BANCOS</h5>
                                <h3 id="bancos"></h3>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3" >
                            <div class="col-xs-12" style="background-color: #fff; color: #000;  padding:2px; ">
                                <h5>FACTURAS</h5>
                                <h3 id="facturas"></h3>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3" >
                            <div class="col-xs-12" style="background-color: #fff; color: #000;  padding: 5px; ">
                                <h5 style="font-size:12px; ">Cartera corriente</h5>
                                <h4 id="carteraCorriente"></h4>
                            </div>
                            <div class="col-xs-12" style="background-color: #fff; color: #000;  padding: 5px; ">
                                <h5 style="font-size:12px; ">Cartera de dificil cobro</h5>
                                <h4 id="carteraDificil"></h4>
                            </div>
                        </div>

                        <div class="col-xs-12 "><br><br><br></div>

                        <div id="pasivos" class="col-xs-12">
                            <center><h4><b>PASIVOS</b></h4></center><br><br>
                        </div>
                        <div class="col-xs-12 col-md-3" >
                            <div class="col-xs-12" style="background-color: #fff; color: #000;  padding:2px; ">
                                <h5>BANCOS</h5>
                                <h3 id="bancosDebCredito"></h3>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-3" >
                            <div class="col-xs-12" style="background-color: #fff; color: #000;  padding:2px; ">
                                <h5>PROVEEDORES</h5>
                                <h3 id="proveedores"></h3>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3" >
                            <div class="col-xs-12" style="background-color: #fff; color: #000;  padding:2px; ">
                                <h5>IMPUESTOS</h5>
                                <h5 style="font-size:12px; ">Retefuente</h5>
                                <h4 id="impuestosretefuente"></h4>
                                <h5 style="font-size:12px; ">MinTic</h5>
                                <h4 id="impuestosmintic"></h4>
                                <h5 style="font-size:12px; ">IVA</h5>
                                <h4 id="impuestosiva"></h4>
                                <h5 style="font-size:12px; ">Cree</h5>
                                <h4 id="impuestoscree"></h4>
                                <h5 style="font-size:12px; ">CRC</h5>
                                <h4 id="impuestoscrc"></h4>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-3" >
                            <div class="col-xs-12" style="background-color: #fff; color: #000;  padding:2px; ">
                                <h5>NOMINA</h5>
                                <h2 id="nomina"></h2>
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
