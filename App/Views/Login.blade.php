
        <style type="text/css">
            body{
                background: #607d8b;
            }
            .btn-success:hover{
                background: :blue;
            }
        </style>
    

    <div class="container">
      <!-- Content here -->
        <div class="row">
            <center>
                <!--Rotating card-->
                <div  style="width:300px;margin-top:20%;border-radius:10px">
                    <!--Panel-->
                    <?php 
                        if (!empty($error)) {
                            # code...
                            echo '  <div class="card">
                                        <div class="card-header danger-color-dark white-text">
                                           <h5>'.$error.'</h5>
                                        </div>
                                    </div>';
                        }
                   
                    ?>
                    <!--Panel-->
                  
                        <div class="card text-xs-center">
                            <div class="card-header default-color-dark white-text">
                                Login
                            </div>
                            <div class="card-block">
                                <form action="Login" method="post" >
                                    <!--Email validation-->
                                    <div class="md-form input-group">
                                        <span class="input-group-addon fa fa-user" id="basic-addon1" style="font-size: 1.6rem;"></span>
                                        <input type="text" class="form-control" placeholder="Usuario" aria-describedby="basic-addon1" id="usuario" name="usuario" style="border-top:1px solid #ccc;margin-top:0px" required="required" value="<?php echo $usuario; ?>">
                                    </div>
                                    <!--Password validation-->
                                    <div class="md-form input-group">
                                        <span class="input-group-addon fa fa-lock" id="basic-addon2" style="font-size: 1.6rem;"></span>
                                        <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2"  id="password" name="password" style="border-top:1px solid #ccc;margin-top:0px" required="required" value="" >
                                    </div>
                                    <button class="default-color-dark link-text btn btn-success btn-sm" type="submit" style="color:#FFF" ><h5>Iniciar Sesión <i class="fa fa-chevron-right"></i></h5></button>
                                </form>
                            </div>   
                        </div>
                        
                </div>
                <!--/.Rotating card-->
            </center>
        </div>
    </div>