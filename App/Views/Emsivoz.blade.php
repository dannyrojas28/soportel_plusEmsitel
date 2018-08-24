<?php

    include "App/Views/includes/header.blade.php";
    $estado = "Emsivoz";
?>
<input type="hidden" id="estadoemsi" value="emsivoz">
<main>
    <div class="main-wrapper" >
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
                        <script src="Public/js/emsivoz.js"></script>
                        <script type="text/javascript">
                            eventEmsivoz();
                            setTimeout(function(){


                                detalleWeb();
                                detallePlayStore()
                                detalleAppStore()
                                detalleCampanna()
                                detallesMercadeo()
                                linealRegistros()
                                llamadasEmsivoz();

                                BalanceMinutos();
                                BalancePesos();
                                BalanceTotalMin();
                                DestinosmasLlamados();
                                UsuariosActivosE();
                                fidelizacion();                              
                                recargasMesC();
                                recargasDiaC();
                                recargasSemC()
                                TodasRecargas();

                             },500);
                        </script>    
                     

   <div class="contenedor" style="margin-top: 10px; ">
      <div class="row">
         <div class="col-xs-12 col-md-6 col-md-offset-3">
            <center><h1 id="emsivoz" style="margin-top: 20px;"><b>EMSIVOZ</b></h1></center>
         </div>
         <div class="col-xs-12 col-md-3">
           
         </div>
         <div class="col-xs-12 ">
            <div id="BalanceTotalMin" style="min-width: 310px; height: 400px; max-width: 900px; margin: 0 auto"></div>  
            <div id="totalMin" style="text-align: center;"></div>     
         </div> 
         <div class="col-xs-12 "><hr><br></div>
         


         <div class="col-xs-12"><center><h3 id="ensivozPais"><b>EMSIVOZ COLOMBIA</b></h3>
             <select name="pais" id="pais" class="browser-default" class="form-control" style=" width: 200px; margin-top: 20px;  border-radius: 2px;  padding: 10px;  " required onchange="Balance()">
               <option value="1" selected>Colombia</option>
               <option value="2">Venezuela</option>     
               <option value="3">Estados Unidos</option>     
            </select>
         </center></div>
         <div class="col-xs-12"><br></div>
         


         <div class="col-xs-12 col-md-6">
            <div id="destinosllamados"> </div>
            <div id="MinutosTotal" style="text-align: center;"></div>     
         </div>
         <div class="col-xs-12 col-md-6">
            <div id="total_llamadas"></div>
         </div> 
         <div class="col-xs-12  "><hr><br></div> 



         <div class="col-xs-12 col-md-6"> 
            <div class="col-xs-8">
               <div id="BalanceMinutos" ></div>  
            </div>
            <div class="col-xs-4" >
               <div id="BMinutos" style="padding: 120px 0px 100px 0px; "> </div>
            </div>  
         </div>
         <div class="col-xs-12 col-md-6"> 
            <div class="col-xs-8 col-md-8">
               <div id="BalancePesos" ></div>  
            </div>
            <div class="col-xs-4 col-md-4">
               <div id="Bpesos" style="padding: 120px 0px 100px 0px; "> </div>
            </div>
         </div>                             
         <div class="col-xs-12 "><hr><br></div> 
         



         <div class="col-xs-12 col-md-6 ">
            <center><div id="usuariosTotal"></div>
            <div id="totalUser"></div></center>
         </div>
         <div class="col-xs-12 col-md-6 ">
            <center><h5><b>Fidelización</b></h5><br><br></center>
            <table class="table table-bordered">
               <tbody>
                  <tr>
                     <th style="background: #234963; color: #fff ">Inversion del mes</th>
                     <td id="InversionMes" style="background: #234963; color: #fff "></td>
                  </tr>
                  <tr>
                     <th style="background: #383434; color: #fff ">Clientes Fidelizados</th>
                     <td id="ClientesFidelizados" style="background: #383434; color: #fff"></td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="col-xs-12 "><hr><br></div> 



         <div class="recargas col-xs-12">
            <center><h2><b>Balance Recargas</b></h2><br><br></center>
            <div class="col-md-4">
               <div id="recargaAyerHoy"></div>
            </div>
            <div class="col-md-4">
               <div id="recargaSem"></div>
            </div>
            <div class="col-md-4">                               
               <div id="recargaMes"></div>
            </div>
         </div>
         <div class="col-xs-12 "><hr><br></div> 


         <div class="MontoNumeroRecargas">
            <div class="row">
            <div class="col-md-6">
               <div id="TopRecargas"></div>
               <div id="TRed"></div>
            </div>
            <div class="col-md-6">
               <div id="MontoRecargas"></div>
            </div>
            </div>
         </div>
         <div class="col-xs-12 "><br><hr><br></div> 






         <div id="bancodata " class="col-xs-12" style="text-align: center;">
				<h3><b>Mercadeo Online</b></h3>
				<div class="col-xs-12 col-md-6">
					<div id="visitasMercadeo"></div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div id="Campanna"></div>
				</div>
            <div class="col-xs-12 "><br><hr><br></div> 
				
            <div class="col-xs-12 col-md-4">
					<div id="DescargasMercadeo"></div>
				</div>
            <div class="col-xs-12 col-md-4">
					<div id="DesinstalacionesMercadeo"></div>
				</div>
				<div class="col-xs-12 col-md-4">
					<div id="DispositivosMercadeo"></div>
				</div>
			</div>
         <div class="col-xs-12 "><hr><br><br><br></div>  
						


         <div class="col-xs-12" style="text-align: center;">
				<h3><b>Índices</b></h3>
				<div class="col-xs-12 col-md-6" style="padding: 0px 10px 0px 0px;">
					<div id="indVisitasRegistros"></div>     
				</div>
				<div class="col-xs-12 col-md-6" style="padding: 0px 0px 0px 10px;">
					<div id="indDescargasRegistros"></div>     
				</div>
			</div>


      </div> 
   </div>     
					


                    <br><br><br><br><br>

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


