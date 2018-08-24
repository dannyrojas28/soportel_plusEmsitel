<?php

require_once '/var/www/html/soportel_plus/Database/conexion/index.php';




class PrincipalController extends Conexion {
    
   public $rout;




   public function __construct(){

      $this->rout = "App/Views/";
   }
    
   /* 
   //
   //FUNCIONES EJECUTADAS POR GET
   //
   */
   public function getLogin($PAGE)
   {
      if($this->ValidateSession() == TRUE){
         # code...
         $usuario  = "";
         $password = "";
         $error    = "";
         include $this->rout.$PAGE.".blade.php";
      }else{
         header('location:Inicio');
      }
   }

   public function getInicio($PAGE)
   {
      if($this->ValidateSession() == FALSE){
         # code...
         $this->UpdateDateSession($PAGE);
      }else{
         header('location:Login');
      }
   }
   
   public function getPerro($PAGE)
   {
      if($this->ValidateSession() == FALSE){
         # code...
         $this->UpdateDateSession($PAGE);
      }else{
         header('location:Login');
      }
   }
   
   public function getComercial($PAGE)
   {
      if($this->ValidateSession() == FALSE){
         # code...
         $this->UpdateDateSession($PAGE);
      }else{
         header('location:Login');
      }
   }
   
   public function getContabilidad($PAGE)
   {
      if($this->ValidateSession() == FALSE){
         # code...
         $this->UpdateDateSession($PAGE);
      }else{
         header('location:Login');
      }
   }
    

   public function getServicios($PAGE)
   {
      if($this->ValidateSession() == FALSE){
         # code...
         $this->UpdateDateSession($PAGE);
      }else{
         header('location:Login');
      }
   }
   
   public function getInternet($PAGE)
   {
      if($this->ValidateSession() == FALSE){
         # code...
         $this->UpdateDateSession($PAGE);
      }else{
         header('location:Login');
      }
   }
   
   public function getTelefonia($PAGE)
   {
      if($this->ValidateSession() == FALSE){
         # code...
         $this->UpdateDateSession($PAGE);
      }else{
         header('location:Login');
      }
   }
   
   public function getEmsivoz($PAGE)
   {
      if($this->ValidateSession() == FALSE){
         # code...
         $this->UpdateDateSession($PAGE);
      }else{
         header('location:Login');
      }
   }
   
   public function getVentas($PAGE)
   {
      if($this->ValidateSession() == FALSE){
         # code...
         $this->UpdateDateSession($PAGE);
      }else{
         header('location:Login');
      }
   }

   public function getUsuarios($PAGE)
   {
      if($this->ValidateSession() == FALSE){
         $queryP = "SELECT * FROM  `admin`,usuario WHERE  usuario.admin=admin.cod_ad ";
         $resultP = $this->EjecutarSoportel($queryP);
         while ($res = mysqli_fetch_object($resultP)) {
            echo $res->nombre_usu;
         }
         $this->UpdateDateSession($PAGE);
      }else{
         header('location:Login');
      }
   }
   public function getBancoDatos($PAGE){
      if($this->ValidateSession() == FALSE){
         # code...
         $this->UpdateDateSession($PAGE);
      }else{
         header('location:Login');
      }
    }
   public function getCerrarsession(){
      $this->DeleteSession();
      header('location:Login');
   }

   public function getCalendarioCabinas($PAGE){
      if($this->ValidateSession() == FALSE){
         $this->UpdateDateSession($PAGE);
      }else{
         header('location:Login');
      }
   }

      /*
      //
      //FUNCIONES EJECUTADAS POR POST
      //
      */

   public function postLogin($PAGE,$DATOS){
      if($this->ValidateSession() == TRUE){
         $usuario  = $DATOS[0]['usuario']; 
         $password = $DATOS[1]['password']; 
       //  $password = $this->Encriptar($password);
         $query = "SELECT * FROM  `admin`,usuario,rol_usu,rol WHERE admin.usuario = '$usuario' AND password = '$password' AND usuario.admin=admin.cod_ad AND rol_usu.usuario=admin.cod_ad AND rol_usu.rol=rol.cod_rol";
         $result = $this->EjecutarSoportel($query);
         if($this->CreateSession($result) == TRUE){
            $date =date('Y-m-d H:i:s');
            $token    = $_SESSION['token'];
            $cod_usu  = $_SESSION['cod_usu'];
            $query = "INSERT INTO tokens (token,id_user,fecha_ingreso,fecha_salida,state) VALUES ('$token','$cod_usu','$date','0000-00-00 00:00:00','ACTIVO')";
            $this->EjecutarSoportel($query);
            $this->getInicio('Inicio');
         }else{
            $error = "Datos Incorrectos";

            include $this->rout.$PAGE.".blade.php";
         }
      }else{
         header('location:Inicio');
      }
   }

   

    /*
    //
    //FUNCIONES EJECUTADAS POR AJAX
    //
    */

   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   /////                                               ////
   /////             USUARIOS                          ////
   /////                                               ////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   public function selecUsuarios($request) {
      $query="SELECT admin.cod_ad, admin.usuario, admin.password, usuario.documento_usu, usuario.nombre_usu, usuario.apellido_usu, usuario.telefono_usu
         FROM admin, usuario
         WHERE admin.`cod_ad` = usuario.`admin` 
          ";
      $result = $this->EjecutarSoportel($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $cod=$row->cod_ad;
          $queryd ="SELECT nombre_rol FROM rol,rol_usu WHERE rol_usu.rol = rol.cod_rol  AND rol_usu.usuario = '$cod' ";
          $resultx = $this->EjecutarSoportel($queryd);
          $rol = "";
          $i=0;
         while ($re =mysqli_fetch_object($resultx)) {
            # code...
            if($i>=1){
               $rol.=",";
            }
             $rol.=$re->nombre_rol;
             $i+=1;
         }
         $post[]= array( 'cod'=>$row->cod_ad, 'usuario'=>$row->usuario, 'password'=>$row->password, 'documento'=>$row->documento_usu,
            'nombre'=>utf8_encode($row->nombre_usu), 'apellido'=>utf8_encode($row->apellido_usu), 'telefono'=>$row->telefono_usu,  'nomRol'=>$rol   );
      }
      echo json_encode($post);
   }
   public function detalleUsu($request) {
      $cod = $request->cod;
      $query="SELECT admin.cod_ad, admin.usuario, admin.password, usuario.documento_usu, usuario.nombre_usu, usuario.apellido_usu, usuario.telefono_usu, rol.cod_rol, rol.nombre_rol,rol_usu.cod as codrolusu
         FROM admin, usuario, rol, rol_usu
         WHERE admin.`cod_ad` = usuario.`admin` 
         AND rol_usu.rol = rol.cod_rol
         AND rol_usu.`usuario` =  admin.`cod_ad`  AND admin.`cod_ad` = '$cod'     ";
      $result = $this->EjecutarSoportel($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'cod'=>$row->cod_ad, 'usuario'=>$row->usuario, 'password'=>$row->password, 'documento'=>$row->documento_usu,
            'nombre'=>utf8_encode($row->nombre_usu), 'apellido'=>utf8_encode($row->apellido_usu), 'telefono'=>$row->telefono_usu, 'rol'=>$row->cod_rol, 'nomRol'=>$row->nombre_rol ,'rolusu'=>$row->codrolusu );
      }
      echo json_encode($post);
   }
   public function verifUser($request) {
      $usuario = $request->usuario;
      $query="SELECT  `usuario` FROM `admin` WHERE `usuario`='$usuario'  ";
      $result = $this->EjecutarSoportel($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {
         $post[] = array('nombre'=>$row->nombre );
         if ($post > 0) {
            echo TRUE;
         }else{
            echo FALSE;
         }
      }
   }
   public function selecUsu($request) {
      $query="SELECT  `cod_ad` FROM  `admin` ORDER BY  `cod_ad` DESC limit 1";
      $result = $this->EjecutarSoportel($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {
         $post[] = array('num'=>$row->cod_ad );
      }
      echo json_encode($post);
   }
   public function inserUsu($request) {
      $cod = $request->cod;

      $usuario = $request->usuario;
      $password = $request->password;

      $nombre = $request->nombre;
      $apellido = $request->apellido;
      $documento = $request->documento;
      $telefono = $request->telefono;
      


      $variable = $request->variable;
      if ($variable == 1) {
         $query="INSERT INTO `admin`(`cod_ad`, `usuario`, `password`) VALUES ( '$cod', '$usuario', '$password'   )";
      }
      if ($variable == 2) {
         $query="INSERT INTO `usuario` (`documento_usu`, `nombre_usu`, `apellido_usu`, `telefono_usu`, `imagen_usu` , `admin`) 
            VALUES ('$documento', '$nombre', '$apellido', '$telefono', '', '$cod');";
      }
      if ($variable == 3) { 
           $in = "";
           $json = json_encode($request->rol);
           //var_dump(json_decode($json));
            $array = json_decode($json, true);
            $rol = "";
            for($p=0;$p <count($array);$p++){
               if($array[$p]['rol'] == true){
                  $rol=$array[$p]['tipo_rol'];
                  $in.="('$cod' , '$rol' ),";
               }
            }
         $query="INSERT INTO `rol_usu`(`usuario`, `rol`) VALUES $in k";
         $query = str_replace(', k', '', $query);
         //echo $query;
      }
      $result = $this->EjecutarSoportel($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }
   public function updateUsu($request) {
      $cod=$request->cod;
      $usuario=$request->usu;
      $password=$request->pass;
      $nombre=$request->nom;
      $apellido=$request->apell;
      $documento=$request->doc;
      $telefono=$request->tel;
      $rol=$request->rol;
      $variable=$request->variable;

      if ($variable == 1) {
         $query="UPDATE `admin` SET `usuario`='$usuario' ,`password`='$password' WHERE `cod_ad` = '$cod'  ";
         $result = $this->EjecutarSoportel($query);
      }
      if ($variable == 2) {
         $query="UPDATE  `usuario` SET  `documento_usu`='$documento', `nombre_usu`='$nombre',  `apellido_usu`='$apellido',   `telefono_usu`='$telefono' WHERE  `admin` = '$cod' ";
         $result = $this->EjecutarSoportel($query);
      }

      if ($variable == 3) {
           $result = true;
           $in = "";
           $json = json_encode($request->rol);
           //var_dump(json_decode($json));
            $array = json_decode($json, true);
            $rol = "";
            for($p=0;$p <count($array);$p++){

               if($array[$p]['rol'] == true){
                     if($array[$p]['valrolus'] != true){
                     $rol=$array[$p]['tipo_rol'];
                     $in.="('$cod' , '$rol' ),";
                   }
               }else{
                     if($array[$p]['valrolus'] == true){
                        $cod = $array[$p]['codrolus'];
                        $query="DELETE  FROM `rol_usu`  WHERE cod = '$cod' ";
                        $result = $this->EjecutarSoportel($query);
                     }
               }
            }
          if(!empty($in)){
            $query="INSERT INTO `rol_usu`(`usuario`, `rol`) VALUES $in k";
            $query = str_replace(', k', '', $query);
            $result = $this->EjecutarSoportel($query);
           } 
         //echo $query;
      }

      
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }
   public function deleteUsu($request) {
      $cod=$request->cod;
      $variable = $request->variable;
      if ($variable == 1) {
         $query="DELETE FROM `admin` WHERE `cod_ad` = '$cod'   ";
      }
      if ($variable == 2) {
         $query="DELETE FROM `rol_usu` WHERE `usuario` = '$cod'  ";
      }
      $result = $this->EjecutarSoportel($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }

   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   /////                                               ////
   /////                ROLES                          ////
   /////                                               ////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   public function selecRol($request) {
      $query="SELECT * FROM  `rol`   ";
      $result = $this->EjecutarSoportel($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'cod'=>$row->cod_rol, 'nombre'=>$row->nombre_rol  );
      }
      echo json_encode($post);
   }
     public function CheckboxRol() {
      $query="SELECT * FROM  `rol`   ";
      $result = $this->EjecutarSoportel($query);
      return $result;
   }
   public function detalleRol($request) {
      $cod = $request->cod;
      $query="SELECT  `cod_rol` ,  `nombre_rol` FROM  `rol` WHERE  `cod_rol` = '$cod'     ";
      $result = $this->EjecutarSoportel($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'cod'=>$row->cod_rol, 'nombre'=>$row->nombre_rol  );
      }
      echo json_encode($post);
   }

   public function updateRol($request) {
      $cod=$request->cod;
      $nombre=$request->nombre;

      $query="UPDATE `rol` SET `nombre_rol`='$nombre' WHERE `cod_rol`= '$cod'  ";

      $result = $this->EjecutarSoportel($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }

   public function deleteRol($request) {
      $cod=$request->cod;
      $query="DELETE FROM `rol` WHERE `cod_rol`= '$cod'   ";
      
      $result = $this->EjecutarSoportel($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }

   public function verifRol($request) {
      $cod = $request->cod;
      $nombre = $request->nombre;
      $query="SELECT `cod_rol`, `nombre_rol` FROM `rol` WHERE `cod_rol`='$cod' AND `nombre_rol` ='$nombre'  ";
      $result = $this->EjecutarSoportel($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {
         $post[] = array('cod'=>$row->cod_rol, 'nombre'=>$row->nombre_rol );
         if ($post > 0) {
            echo TRUE;
         }else{
            echo FALSE;
         }
      }
   }

   public function inserRol($request) {
      $cod = $request->cod;
      $nombre = $request->nombre;
      $query="INSERT INTO `rol`(`cod_rol`, `nombre_rol`) VALUES ( '$cod', '$nombre'   )";
      $result = $this->EjecutarSoportel($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }
   
   

   
   

   public function Meta($request) {
      $query = "SELECT * FROM metas";
      $result = $this->Ejecutar($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $date = $row->fecha;
         //$date=substr($dat, 5, 2 ); 

         $post[]= array( 'cod'=>$row->cod, 'meta' => $row->meta_mes, 'dias' => $row->numero_dias, 'fecha'=>$date );
      }
      echo json_encode($post);
   }
   public function updateMetaBanco($request) {
      $metaM = $request->meta;
      $dateM = date('Y-m-d');
      $numero_dias = $request->numero_dias;
      $cod = $request->cod;

      $query=" UPDATE  `metas` SET  `meta_mes` = '$metaM', `numero_dias`='$numero_dias', `fecha` = '$dateM' WHERE cod =  '$cod'   ";
      $result = $this->Ejecutar($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }

   public function FacturadoFecha($request) {
      $mes_actual1 = date('Y-m').'-01 00:00:00';
      $mes_actual2 = date('Y-m-d H:i:s');
      $mes = array('','enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
      $mes = strtoupper($mes[date('n')]);
      $query = "SELECT SUM( sessionbill ) AS facturacion,DATEDIFF( MAX( starttime ) , MIN( starttime ) ) as Dias FROM  `cc_call` WHERE `starttime` >=  '$mes_actual1' AND  `starttime` <=  '$mes_actual2' AND  `terminatecauseid` = 1  AND card_id != 3 AND card_id != 433 AND card_id != 432 ORDER BY  `cc_call`.`starttime` ASC  Limit 0,1";
      $result = $this->EjecutarSoportelPlus($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array('facturacion' => round($row->facturacion),'mes' => $mes, 'fecha1'=>$mes_actual1,'dias'=>$row->Dias);
      }
         echo json_encode($post);
   }
   public function Minutos($request){
      $mes_actual1 = date('Y-m').'-01 00:00:00';
      $mes_actual2 = date('Y-m-d H:i:s');
      switch ($request->destino) {
         case "Todos":
            $sql = '';
            break;
         case "Colombia":
            $sql = 'AND destination LIKE "57%" ';
            break;
         case "Venezuela":
            $sql = 'AND destination LIKE "58%" ';
            break;
         case "Internacionales":
            $sql = 'AND destination NOT LIKE  "57%" AND destination NOT LIKE  "58%" ';
            break;
      }
      $mes = array('','enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
      $mes = strtoupper($mes[date('n')]);
      $query = "SELECT SUM( CEIL( real_sessiontime /60 ) ) AS Minutos FROM  `cc_call` WHERE `starttime` >=  '$mes_actual1' AND  `starttime` <=  '$mes_actual2' AND  `terminatecauseid` = 1 AND card_id != 3 AND card_id != 433 AND card_id != 432  $sql ORDER BY  `cc_call`.`starttime` ASC Limit 0,1";
      $result = $this->EjecutarSoportelPlus($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array('minutos' => round($row->Minutos),'mes' => $mes);
      }
      echo json_encode($post);
   }
   public function Cabinas($request) {
      if(!empty($request->sql)){
         if($request->sql == 1){
            $sql = " status = ".$request->sql;
         }else{ 
            $sql = " status = 0";
         }
      }else{
         $sql = 1;
      }
      $query = "SELECT count(id) as cabinas FROM  cc_card WHERE $sql";
      $result = $this->EjecutarSoportelPlus($query);
      while ($res = mysqli_fetch_object($result)) {
         echo $res->cabinas;
      }
   }
   public function cabinasT($request) {
      $estado = $request->estado;
      $query="SELECT COUNT(`id`) as cabinas FROM  `cc_card` WHERE zipcode = '$estado' ";
      $result = $this->EjecutarSoportelPlus($query);
      while ($res = mysqli_fetch_object($result)) {
         echo $res->cabinas;
      }
   }
   public function DCabinasInactivas($request) {
      $query = 'SELECT lastname, firstname, address FROM  cc_card WHERE status = 0 ORDER BY lastname ASC';
      $result = $this->EjecutarSoportelPlus($query);

      $post  = array();
      while ($row = mysqli_fetch_object($result)) {
         $cabina = $row->lastname;
         $direccion = $row->address;
         $post[] = array( 'cabina'=>utf8_encode($cabina), 'direccion'=>utf8_encode($direccion) );
      }
      echo json_encode($post);
   }
   public function VentaPromedio($request)  {
      $mes_actual1 = date('Y-m').'-01 00:00:00';
      $mes_actual2 = date('Y-m-d H:i:s');
      $query = "SELECT DATEDIFF( MAX( starttime ) , MIN( starttime ) ) as Dias FROM  `cc_call` WHERE  `starttime` >=  '$mes_actual1' AND  `starttime` <=  '$mes_actual2' AND card_id != 3 AND card_id != 433 AND card_id != 432";
      $result = $this->EjecutarSoportelPlus($query);
      while ($res = mysqli_fetch_object($result)) {
        echo $res->Dias;
      }
   }
   public function DetallesMantenimientosAtrasados(){
      $fechaHOY = date('Y-m-d 00:00:00');
      $query = " SELECT cod, firstname, lastname FROM  cc_card, mantenimientos_cabinas WHERE mantenimientos_cabinas.cod_cabina=cc_card.id AND mantenimientos_cabinas.estado = 3 ";
      $result = $this->EjecutarSoportelPlus($query);
      if(mysqli_num_rows($result) > 0){
         $post = array();
         while ($res = mysqli_fetch_object($result)) {
            # code...
            $post[] = array('res' => 'full', 'nombre' => $res->lastname, 'codigo' => $res->cod);
         }
         echo json_encode($post);
      }else{
         echo "false";
      }
   }
   public function AtensionCLienteEjecutadosTiempo($request) {
      $dateIn = $request->fechaInicio;
      $dateFi = $request->fechaFin;
      $query = "          
         SELECT fecha, fecha_ejecutado
         FROM mantenimientos_cabinas
         WHERE fecha >=  '$dateIn 00:00:00'
         AND fecha <=  '$dateFi 23:59:59'
         AND estado = 1 LIMIT 0, 5
      ";
         
         $result = $this->EjecutarSoportelPlus($query);
         $post = array();
         while ($row = mysqli_fetch_object($result)) {


            $fecha1 = $row->fecha;
            $fecha2 = $row->fecha_ejecutado;
               // calculos de diferencia de fechas
            $start_date = new DateTime($fecha1);         
            $since_start = $start_date->diff(new DateTime($fecha2)); 

               // guardamos diferencia de fechas 
            $deta =  $since_start->y . ':' . $since_start->m . ':' . $since_start->d . ':' . $since_start->h . ':' . $since_start->i . ':' . $since_start->s; 
           
            $post[] = array('res' => 'full',  'diferencia'=>$deta );  

         }
      echo json_encode($post);
   }     
   public function AtencionClienteDetalles($request) {
         $dateIn = $request->fechaInicio;
         $dateFi = $request->fechaFin;
         $query1 = "          
         SELECT firstname, lastname, COUNT( cod_cabina ) AS num_cabinas, cod_cabina
         FROM cc_card, mantenimientos_cabinas
         WHERE cc_card.id = mantenimientos_cabinas.cod_cabina
         AND fecha >=  '$dateIn 00:00:00' AND fecha <=  '$dateFi 23:59:59'
         GROUP BY cod_cabina ORDER BY num_cabinas DESC LIMIT 1 ";

         $result1 = $this->EjecutarSoportelPlus($query1);
         while ($row = mysqli_fetch_object($result1)) {
            $cabinaFrecuente = $row->lastname;
         }


         # consulta para saber el numero de registros de nuestra DB
         $query2 = "          
         SELECT  COUNT(descripcion) as numero
         FROM mantenimientos_cabinas,cc_card
         WHERE fecha >=  '$dateIn 00:00:00'
         AND fecha <=  '$dateFi 23:59:59' AND cc_card.id=mantenimientos_cabinas.cod_cabina         
         ";
         $result2 = $this->EjecutarSoportelPlus($query2);

         while ($row = mysqli_fetch_object($result2)) {
            $numero = $row->numero;
         }
         #Agreganos una variable para guardar el numero de paginas que dará nuestra consulta
         $pagina = ceil($numero/5);

         $limite=$request->limite;

         $query = "          
         SELECT  `descripcion` ,  `responsable` ,  `estado` ,  `fecha` ,  `fecha_ejecutado` ,  `firstname` ,  `lastname` 
         FROM  `mantenimientos_cabinas` ,  `cc_card` 
         WHERE  `mantenimientos_cabinas`.`fecha` >=  '$dateIn 00:00:00'
         AND  `mantenimientos_cabinas`.`fecha` <=  '$dateFi 23:59:59'
         AND  `cc_card`.`id` =  `mantenimientos_cabinas`.`cod_cabina`  LIMIT $limite,5
         ";
         $result = $this->EjecutarSoportelPlus($query);
         $post = array();
         while ($row = mysqli_fetch_object($result)) {

            $fecha1 = $row->fecha;
            $fecha2 = $row->fecha_ejecutado;
               // calculos de diferencia de fechas
            $start_date = new DateTime($fecha1);         
            $since_start = $start_date->diff(new DateTime($fecha2)); 

               // guardamos diferencia de fechas 
            $deta =  $since_start->y . ':' . $since_start->m . ':' . $since_start->d . ':' . $since_start->h . ':' . $since_start->i . ':' . $since_start->s; 
            #$dd = $since_start->h .':' . $since_start->i . ':' . $since_start->s;

            $post[] = array('limite'=>$limite, 'fecha1' => $dateIn, 'fecha2'=>$dateFi, 'cabina' => $row->lastname , 'descripcion' => $row->descripcion, 'responsable' => $row->responsable, 'estado' => $row->estado, 'fecha' => $row->fecha, 'fecha_ejecutado' => $row->fecha_ejecutado, 'diferencia'=>$deta, 'color'=> $color, 'cabinaFrecuente' => $cabinaFrecuente, 'numero'=>$pagina);
         }
         
         echo json_encode($post);
   }
   public function ResponsableEficiente($request) {
         $dateIn = $request->fechaInicio;
         $dateFi = $request->fechaFin;
         $post = array();
         $query = " SELECT * FROM mantenimientos_cabinas WHERE fecha >=  '$dateIn 00:00:00' AND fecha <=  '$dateFi 23:59:59' AND estado = 1  GROUP BY responsable ";
         $result = $this->EjecutarSoportelPlus($query);
         // echo mysqli_num_rows($result);
         while ($row = mysqli_fetch_object($result)) {
            $responsable =$row->responsable;
            $queryc = "SELECT *  FROM mantenimientos_cabinas WHERE fecha >=  '$dateIn 00:00:00'  AND fecha <=  '$dateFi 23:59:59' AND responsable = '$responsable' AND estado = 1 ";
            $resultc = $this->EjecutarSoportelPlus($queryc);
            $num_detalles = 0;
            $horas = 0;
            $soportes = 0;
            $minutos = 0;
            $segundos = 0;
            while ($rio = mysqli_fetch_object($resultc)) {
               # code...
               $num_detalles = $num_detalles + $rio->pintura + $rio->herraje + $rio->sticker + $rio->mant_general + $rio->prot_teclado + $rio->conectores + $rio->cable_red + $rio->cable_bocina + $rio->material_mantenimiento;
               $soportes = $soportes + 1;

               $fecha1 = $rio->fecha;
               $fecha2 = $rio->fecha_ejecutado;
                  // calculos de diferencia de fechas
               $start_date = new DateTime($fecha1);         
               $since_start = $start_date->diff(new DateTime($fecha2)); 
               if($since_start->y > 0){
                  $dias = 365 * $since_start->y;
                  $horas_ano = 24 * $dias;
               }
               if($since_start->m > 0){
                  $dias= 30 * $since_start->m;
                  $horas_mes = 24 * $dias;
               }
               if($since_start->d > 0){
                  $horas_dias = 24 * $since_start->d;
               }
               $horas = $horas_ano + $horas_mes + $horas_dias + $since_start->h;
                $minutos = $minutos + $since_start->i;
               $segundos = $segundos + $since_start->s;
            }
             
            $min_h = 0;
            $horas = $horas / $soportes;
            if(is_float($horas)) {
               $min_h = explode(".", $horas);
               $horas = $min_h[0];
               $min_h = "0.".$min_h[1];
               $min_h = $min * 60;
            }
            $minutos = $minutos / $soportes;
            $minutos = $minutos + $min_h;
            $seg_m = 0;
            if(is_float($minutos)) {
               $seg_m = explode(".", $minutos);
               $minutos = $seg_m[0];
               $seg_m = "0.".$seg_m[1];
               $seg_m = $seg_m * 60;
            }
            if($minutos > 60){
               $minutos = $minutos - 60;
               $horas = $horas + 1;
            }
            $segundos = $segundos / $soportes;
            $segundos = $segundos + $seg_m;
            if($segundos > 60){
               $segundos = $segundos - 60;
               $minutos = $minutos + 1;
            }
            if(is_float($segundos)) {
               $segundos = explode(".", $segundos);
               $segundos = $segundos[0];
            }

            if($horas < 10){$horas = "0".$horas;}
            if($minutos < 10){$minutos = "0".$minutos;}
            if($segundos < 10){$segundos = "0".$segundos;}
            $des_H = "";
            $min_H = "";
            $seg_H = "";
            if($horas > 0){
               $des_H = $horas."Horas ";
            }
            if($minutos > 0 ){
               $min_H = $minutos."Minutos ";
            } 
            if($segundos > 0 ){
               $seg_H = $segundos."Segundos";
            } 
            
            $diferencia = $des_H.$min_H.$seg_H;
            $realtime = $horas.$minutos.$segundos;
            $realtime = $realtime / $soportes;
            $realtime = $realtime / $num_detalles;
            if(is_float($realtime)) {
               $realtime = explode(".", $realtime);
               $realtime = $realtime[0];
            }
            sort($post);
            $post[] = array('realtime'=>$realtime,'responsable'=>$responsable,'diferenciaTiempo'=>$diferencia,"soportes"=>$soportes,"num_detalles"=>$num_detalles);
         }
         //$post = ksort($post);
       echo json_encode($post);
   }
   public function CabinaDetalle($request){
      $codigo = $request->cod;
      $query = " SELECT * FROM  cc_card, mantenimientos_cabinas WHERE 
      mantenimientos_cabinas.cod_cabina=cc_card.id 
      AND  mantenimientos_cabinas.cod = $codigo";

      $result = $this->EjecutarSoportelPlus($query);
      if(mysqli_num_rows($result) > 0){
         $post = array();
            while ($res = mysqli_fetch_object($result)) {
            # code...
            $post[] = array('res'=> 'full', 'cod'=>$res->cod, 'cod_cabina'=>$res->cod_cabina,      'responsable'=>$res->responsable,    'nombre'=>$res->lastname,   'descripcion'=>$res->descripcion,    'descripcion_mantenimiento'=>$res->descripcion_mantenimiento,     'pintura'=>$res->pintura,     'herraje'=>$res->herraje,  'sticker'=>$res->sticker,  'mant_general'=>$res->mant_general,    'prot_teclado'=>$res->prot_teclado, 'conectores'=>$res->conectores,   'cable_red'=>$res->cable_red,       'cable_bocina'=>$res->cable_bocina, 'material_mantenimiento'=>$res->material_mantenimiento,    'tipo_materiales'=>$res->tipo_materiales,    'tipo'=>$res->tipo,      'estado'=>$res->estado,      'fecha'=>$res->fecha, 'fecha_ejecutado'=>$res->fecha_ejecutado,      'codigo'=>$res->cod);
            }
         echo json_encode($post);
      }else{
         echo "false";
      }
   }
   public function AllCabinas() {
      # code...
      $query = "SELECT * FROM cc_card,mantenimientos_cabinas,rev_estadomantenimiento,rev_tipomantenimiento WHERE cc_card.id = mantenimientos_cabinas.cod_cabina AND mantenimientos_cabinas.tipo=rev_tipomantenimiento.cod_tipm AND mantenimientos_cabinas.estado=rev_estadomantenimiento.cod_estm AND fecha != '0000-00-00 00:00:00' ";
      $result = $this->EjecutarSoportelPlus($query);
      $post  = array();
      while ($res = mysqli_fetch_object($result)) {
         $i = 0;
            $fe = explode(" ",$res->fecha);
            $i = $i + 1;
            $fechaHOY = date('Y-m-d');
            $color = 'blue';
          // echo $fe[0]."-".$fechaHOY;
            if ($fe[0] >= $fechaHOY)  {
               if ($res->estado == 1) {
                  $color = "green";
               }else{
                  $color = 'blue';
               }   
            }else{
               if ($res->estado == 1) {
                  $color = "green";
               }else{
                  if($res->estado == 2){ 
                     $cod = $res->cod;
                     $query = " UPDATE `mantenimientos_cabinas` SET `estado`= '3' WHERE cod = $cod ";
                     $results = $this->EjecutarSoportelPlus($query);
                     if ($results) {
                        $cod_ca = $res->id;
                        $query1="UPDATE `cc_card` SET `zipcode`='3' WHERE `id` = '$cod_ca' ";
                        $result1 = $this->EjecutarSoportelPlus($query1);
                        if($result1){
                           echo TRUE;
                        }else{
                           echo false;
                        }
                     }
                     $color = "red";
                  }else {
                     $color = "red";
                  }
               }
            }
            
            $post[] = array("id" => $res->cod_cabina, "title" => utf8_encode($res->cod. " , " .$res->lastname), "start" => $fe[0]."T".$fe[1]."+05:30", 'color'=> $color);
            /* $post[] = array("id" => $res->cod_cabina, "descripcion" => $res->descripcion,"tipo" => $res->tipo,"estado" => $res->estado,"fecha" => $fe[0],"nombre_estm" => $res->nombre_estm,"nombre_tipm" => $res->nombre_tipm, "cabina" => utf8_encode($res->firstname." ".$res->lastname), "address" => $res->address);*/
      }
         echo json_encode($post);
   }

   public function MostrarNombreCabinas($request) {
      $nombrecampo = strtoupper($request->nombrecampo ) ;
      $query = "SELECT firstname,lastname,id FROM cc_card WHERE ( firstname LIKE ('%$nombrecampo%') OR lastname LIKE ('%$nombrecampo%')) ";
      $result = $this->EjecutarSoportelPlus($query);
      if(mysqli_num_rows($result) > 0){
         $post = array();
         while ($res = mysqli_fetch_object($result)) {
            # code...
            $post[] = array('res' => 'full', "nombre_cap" => utf8_decode($res->lastname), "id" => $res->id );
         }
         echo json_encode($post);
      }else{
         echo "false";
      }
      //print($post);  
   }
   public function DeleteMantenimientosCabina($request) {
      $cod = $request->cod;
      //$query =" DELETE FROM `soportelplus`.`mantenimientos_cabinas` WHERE `mantenimientos_cabinas`.`cod` = $cod ";
      $query =" DELETE FROM `mantenimientos_cabinas` WHERE `mantenimientos_cabinas`.`cod` = $cod ";

      $result = $this->EjecutarSoportelPlus($query);

      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }
   public function UpdatetMantenimientosCabinas($request) {
      $cod = $request->cod;
      $cod_cabi = $request->cod_cabina;
      $descripcion = $request->descripcion;
      $descripcion_mantenimiento = $request->descripcion_mantenimiento;
      $pintura = $request->pintura;     
      $herraje = $request->herraje; 
      $sticker = $request->sticker;        
      $mant_general = $request->mant_general;         
      $prot_teclado = $request->prot_teclado;         
      $conectores = $request->conectores;            
      $cable_red = $request->cable_red;        
      $cable_bocina = $request->cable_bocina;         
      $material_mantenimiento = $request->material_mantenimiento;    
      $tipo_materiales = $request->tipo_materiales;
      $responsable = $request->responsable;      
      $tipo = $request->tipo;
      $estado = $request->estado;
      $fecha = $request->fecha;   
      $fecha_ejecutado = $request->fecha_ejecutado; 

      $query ="UPDATE  `mantenimientos_cabinas` SET  `descripcion` =  '$descripcion',
      `descripcion_mantenimiento` =  '$descripcion_mantenimiento',
      `pintura` = '$pintura',
      `herraje` = '$herraje',
      `sticker` = '$sticker',
      `mant_general` = '$mant_general',
      `prot_teclado` = '$prot_teclado',
      `conectores` = '$conectores',    
      `cable_red` =  '$cable_red',
      `cable_bocina` = '$cable_bocina',
      `material_mantenimiento` = '$material_mantenimiento',
      `tipo_materiales` =  '$tipo_materiales',
      `responsable` =  '$responsable',
      `tipo` =$tipo,
      `estado` =$estado,
      `fecha` =  '$fecha',
      `fecha_ejecutado` =  '$fecha_ejecutado' WHERE cod =$cod";      

      $result = $this->EjecutarSoportelPlus($query);

      if($result){
         if ( $estado == 1 ) {
            $query1="UPDATE `cc_card` SET `zipcode`=' ' WHERE `id` = '$cod_cabi' ";
            $result1 = $this->EjecutarSoportelPlus($query1);
            if($result1){
               echo TRUE;
            }else{
               echo false;
            }
         }else{
            if ($estado == 2) {
               $query1="UPDATE `cc_card` SET `zipcode`='2' WHERE `id` = '$cod_cabi' ";
               $result1 = $this->EjecutarSoportelPlus($query1);
               if($result1){
                  echo TRUE;
               }else{
                  echo false;
               }
            }else{
               $query1="UPDATE `cc_card` SET `zipcode`='3' WHERE `id` = '$cod_cabi' ";
               $result1 = $this->EjecutarSoportelPlus($query1);
               if($result1){
                  echo TRUE;
               }else{
                  echo false;
               }
            }
         }

         echo TRUE;
      }else{
         echo false;
      }  
   }
   public function InsertMantenimientosCabinas($request) {
      $id_cabina = $request->id_cabina;
      $descripcion = $request->descripcion;
      $descripcion_mantenimiento = $request->descripcion_mantenimiento;
      $pintura = $request->pintura;     
      $herraje = $request->herraje;        
      $sticker = $request->sticker;        
      $mant_general = $request->mant_general;         
      $prot_teclado = $request->prot_teclado;         
      $conectores = $request->conectores;        
      $cable_red = $request->cable_red;        
      $cable_bocina = $request->cable_bocina;         
      $material_mantenimiento = $request->material_mantenimiento;         
      $responsable = $request->responsable;      
      $tipo_materiales = $request->tipo_materiales;
      $tipo = $request->tipo;
      $estado = $request->estado;
      $fecha = $request->fecha;

      $query= " INSERT INTO mantenimientos_cabinas ( cod_cabina, descripcion, descripcion_mantenimiento, pintura, herraje, sticker, mant_general, prot_teclado, conectores, cable_red, cable_bocina, material_mantenimiento, tipo_materiales, responsable, tipo, estado, fecha ) VALUES ( '$id_cabina', '$descripcion', '$descripcion_mantenimiento', '$pintura', '$herraje', '$sticker', '$mant_general', '$prot_teclado', '$conectores', '$cable_red', '$cable_bocina', '$material_mantenimiento', '$tipo_materiales', '$responsable', '$tipo', '$estado', '$fecha') ";
      
      $result = $this->EjecutarSoportelPlus($query);

      if ($result) {
         $query1="UPDATE `cc_card` SET `zipcode`='2' WHERE `id` = '$id_cabina' ";
         $result1 = $this->EjecutarSoportelPlus($query1);
         if($result1){
            echo TRUE;
         }else{
            echo false;
         }
      }

      $post = array(); 
      
      if($result){
         $post[]= array( 'total'=>$id_cabina, 'descripcion'=>$descripcion, 'descripcion_mantenimiento'=>$descripcion_mantenimiento, 'pintura'=>$pintura, 'herraje'=>$herraje, 'sticker'=>$sticker, 'mant_general'=>$mant_general, 'prot_teclado'=>$prot_teclado, 'conectores'=>$conectores, 'cable_red'=>$cable_red, 'cable_bocina'=>$cable_bocina, 'material_mantenimiento'=>$material_mantenimiento, 'responsable'=>$responsable, 'tipo_materiales'=>$tipo_materiales, 'tipo'=>$tipo, 'estado'=>$estado, 'fecha'=>$fecha  );
      }else{
         echo false;
      }  
      echo json_encode($post);
   }

   //funciones de RECURSOS
   public function Encriptar($password){
      $key      = "6251625SGDHJAGJÇ2382783HJHSDJHSDN\~%X4SQ;4324237Q4324-*]+q;Lg4324|";
      $result = '';
      for($i=0; $i<strlen($password); $i++) {
         $char = substr($password, $i, 1);
         $keychar = substr($key, ($i % strlen($key))-1, 1);
         $char = chr(ord($char)+ord($keychar));
         $result.=$char;
      }
      return base64_encode($result);
   }
   public function Desencriptar($password){
      $key      = "6251625SGDHJAGJÇ2382783HJHSDJHSDN\~%X4SQ;4324237Q4324-*]+q;Lg4324|";

      $result = '';
      $password = base64_decode($password);
      for($i=0; $i<strlen($password); $i++) {
         $char = substr($password, $i, 1);
         $keychar = substr($key, ($i % strlen($key))-1, 1);
         $char = chr(ord($char)-ord($keychar));
         $result.=$char;
      }
      return $result;
   }
   public function UpdateDateSession($PAGE){
      $token    = $_SESSION['token'];
      $query = "SELECT * FROM  `admin`,usuario,rol_usu,rol,tokens WHERE tokens.state = 'ACTIVO'  AND token = '$token' AND usuario.admin=admin.cod_ad AND rol_usu.usuario=admin.cod_ad AND rol_usu.rol=rol.cod_rol AND tokens.id_user=admin.cod_ad  ";
      $result = $this->EjecutarSoportel($query);
      if($this->UpdateSession($result) == TRUE){
         include $this->rout.$PAGE.".blade.php";
      }else{
         $this->getCerrarsession();
      }
   }
   public function Roles($user) {
      # code...
      $query = "SELECT * FROM  rol_usu,rol WHERE rol_usu.usuario = '$user' AND rol_usu.usuario=admin.cod_ad AND rol_usu.rol=rol.cod_rol";
      $result = $this->Ejecutar($query);
   }
   public function CabinasActivas($user)  {
      $query = "SELECT * FROM  rol_usu,rol WHERE rol_usu.usuario = '$user' AND rol_usu.usuario=admin.cod_ad AND rol_usu.rol=rol.cod_rol";
      $result = $this->Ejecutar($query);
   }

   

   /////////////////////////////////////////////////////////////////////////////////////////////////
   //
   //                           EMSIVOZ   
   //                    
   ///////////////////////////////////////////////////////////////////////////////////////////////////   

   public function BalanceTotalMin($request) {
      $fechaInicio = date('Y-m-01 00:00:00');
      $fechaActual = date('Y-m-d 23:59:59');  
      $query = " SELECT SUM( CEIL( real_sessiontime /60 ) ) AS minutos
        FROM cc_call, cc_card
        WHERE starttime >=  '$fechaInicio'
        AND starttime <= '$fechaActual'
        AND `terminatecauseid` =1
        AND cc_call.card_id = cc_card.id
        AND address != 'REVENTA' AND calledstation != '611'
      ";
      if($request->ejecutar == 1){
       $result = $this->EjecutarEmsivozCo($query);
      }else{
          if($request->ejecutar == 2){
           $result = $this->EjecutarEmsivozVe($query);
          }else{
           $result = $this->EjecutarEmsivozUs($query);
          }
      }
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array('minutos' => 0 + $row->minutos );
      }
      echo json_encode($post);
   }
   public function getTimeNumCall($ejecutar){
      $fechaInicio = date('Y-m-01 00:00:00');
      $fechaActual = date('Y-m-d 23:59:59');  
      $query = "SELECT COUNT( cc_call.id ) as total,cc_call.destination, SUM( CEIL( real_sessiontime /60 ) ) as minutos  FROM cc_call,cc_card WHERE `terminatecauseid` =1 AND cc_call.card_id = cc_card.id AND address != 'REVENTA' AND calledstation != '611' AND `starttime` >= '$fechaInicio' AND starttime <= '$fechaActual'  GROUP BY destination ORDER BY  total DESC ";
      if($ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
           $result = $this->EjecutarEmsivozUs($query);
         }
      }
      if(mysqli_num_rows($result) > 0 ){
        return $result;
      }
      return false;
   }
   public function ConsultarPais($dial,$ejecutar){
      $query = "SELECT * FROM paises WHERE `prefix` LIKE  '%$dial%' LIMIT 0,1";
      if($ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($ejecutar == 2){
           $result = $this->EjecutarEmsivozVe($query);
         }else{
           $result = $this->EjecutarEmsivozUs($query);
         }
      }
      
      if(mysqli_num_rows($result) > 0 ){
         while ($res = mysqli_fetch_object($result)) {
            return utf8_encode($res->nombre);
         }
      }
      return false;
   }
   public function ConsultarPaisDos($dial,$ejecutar){
      $query = "SELECT * FROM paises WHERE `prefix` LIKE  '%$dial%' LIMIT 0,1";
      if($rejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($ejecutar == 2){
           $result = $this->EjecutarEmsivozVe($query);
         }else{
           $result = $this->EjecutarEmsivozUs($query);
         }
      }
      
      if(mysqli_num_rows($result) > 0 ){
         return $result;
      }
      return false;
   }
   public function ConsultarPaisTres($dial,$ejecutar){

      $query = "SELECT destination FROM cc_prefix WHERE cc_prefix.prefix = $dial limit 0,1";
      if($ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }if(mysqli_num_rows($result) > 0 ){
         while ($res = mysqli_fetch_object($result)) {
            # code...
            $pais = $res->destination;
         }
         $pais_frases = explode(" ", $pais);
         $pais = $pais_frases[0];
         $im = "";
         for($i=0;$i < count($pais_frases);$i++){
            $query = "SELECT prefix,nombre,bandera FROM paises WHERE nombre LIKE '$pais%' ";
            if($ejecutar == 1){
               $result = $this->EjecutarEmsivozCo($query);
            }else{
               if($ejecutar == 2){
                  $result = $this->EjecutarEmsivozVe($query);
               }else{
                  $result = $this->EjecutarEmsivozUs($query);
               }
            }
            if(mysqli_num_rows($result) > 0 ){
               $im = $result;
            } 
         $pais = $pais." ".$pais_frases[$i];
         }
         return $im;
      }
      return false;
   }
   public function DestinosmasLlamados($request){
      $ejecutar= $request->ejecutar;
      $queryCRM =$this->getTimeNumCall($ejecutar);

       $j=0;
       while($row=mysqli_fetch_array($queryCRM)){
        //query para saber los nminutos y las llamadas marcados de un destino ejm destino 0058 minutos 1000 llamdas 10000
      
            # code...
         $minutos = $row['minutos'];
         $total   = $row['total'];
         $destination = $row['destination'];

         if($destination == 0){
            $pais = "Colombia";
            $indicativo = "0";
         }else{
            $dial = "";
            if($destination[0] != 1){
                for ($i=0; $i < strlen($destination); $i++) { 
                    # code...
                    $dial = $dial.$destination[$i];
                    if($i >= 1){
                        $consultar = $this->ConsultarPaisDos('00'.$dial,$ejecutar);
                        if($consultar != false){
                            while ($res = mysqli_fetch_object($consultar)) {
                            # code...
                                $pais  = utf8_encode($res->nombre);
                                $indicativo = $res->prefix;
                            }
                        }
                    }
                }
            }else{
                 $pol = $this->ConsultarPaisTres($destination,$ejecutar);
                while ($resa = mysqli_fetch_object($pol)) {
                    # code...
                    $pais = $resa->nombre;
                    $indicativo = $resa->prefix;
                }
            }
         }
        
         $entro = 987666;
         if(strlen($indicativo) > 2){
            $indicativo = substr($indicativo, 2);
         } 
         if($j != 0){
            for ($i=0; $i < count($posts); $i++) { 
                # code...
                if($posts[$i]['indicativo'] == $indicativo){
                    $entro = $i; 
                }
            }
            if($entro == 987666){
                 $posts[$j]=array('minutos'=>$minutos,'pais'=>$pais,'indicativo' => $indicativo ,'total'=>$total);
                  $j = $j +1;
            }else{
                 $posts[$entro]=array('minutos'=> $posts[$entro]['minutos'] + $minutos,'pais'=>$pais,'indicativo' => $indicativo ,'total'=>$posts[$entro]['total'] + $total);
            }
         }else{
            $posts[$j]=array('minutos'=>$minutos,'pais'=>$pais,'indicativo' => $indicativo ,'total'=>$total);
             $j = $j +1;
         }
      }
      rsort($posts);
      echo json_encode($posts);
   }
   public function llamadasEmsivoz($request) {
         $fechaini = date('Y-m-01'); // hoy

      if ($request->fecha == 1) {
         $fecha1 = date('Y-m-d'); // hoy
         $aaa = "entro hoy " . $fecha1;
         $query="SELECT COUNT(  cc_call.id ) AS llamadas FROM  `cc_call`,cc_card WHERE  `starttime` >=  '$fecha1'  AND `starttime` != `stoptime` AND `calledstation` !=  '611' AND cc_call.card_id = cc_card.id AND address != 'REVENTA' AND terminatecauseid  = 1";
      }else{
         if ($request->fecha == 2) {
            $fecha1 = date('Y-m-d'); // Hoy
            $fecha2= date('Y-m-d', strtotime('-1 day')) ; // resta 1 día
            $aaa ="entro ayer " . $fecha1 . ' ' . $fecha2;
            $query="SELECT COUNT(  cc_call.id ) AS llamadas FROM  `cc_call`,cc_card WHERE  `starttime` >=  '$fecha2 00:00:00' AND  `starttime` <=  '$fecha2 23:59:59'  AND `calledstation` !=  '611' AND cc_call.card_id = cc_card.id AND address != 'REVENTA' AND terminatecauseid  = 1 ";
         }else{
            if ($request->fecha == 3) {
               $fecha2= date('Y-m-d', strtotime('-2 day')) ; // resta 2 día
               $aaa = "entro antiern " . $fecha1 . ' ' . $fehca2 ;
               $query="SELECT COUNT(  cc_call.id ) AS llamadas FROM  `cc_call`,cc_card WHERE  `starttime` >=  '$fecha2 00:00:00' AND  `starttime` <=  '$fecha2 23:59:59' AND `calledstation` !=  '611' AND cc_call.card_id = cc_card.id AND address != 'REVENTA'  AND terminatecauseid  = 1";
            }else{
               $fecha2= date('Y-m-d', strtotime('-3 day')) ; // resta 2 día
               $aaa = "entro otro " . $fecha2 ;
               $query="SELECT COUNT(  cc_call.id ) AS llamadas FROM  `cc_call`,cc_card WHERE  `starttime` <  '$fecha2 23:59:59' AND  `starttime` >=  '$fechaini 00:00:00' AND `calledstation` !=  '611' AND cc_call.card_id = cc_card.id AND address != 'REVENTA' AND terminatecauseid  = 1";
            }
         }
      }

      
      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
           $result = $this->EjecutarEmsivozVe($query);
         }else{
           $result = $this->EjecutarEmsivozUs($query);
         }
      }
      $post = array();      
      $num = "";
      while ($row = mysqli_fetch_object($result)) {

         $num = $row->llamadas;

         $post[]= array( 'total'=> 0 + $num );
      }
      echo json_encode($post);
   }

   public function BalancePesos($request) {
      if ($fecha=$request->fecha == 1) {
        $fechaInicio = date('Y-m-01 00:00:00');
        $fechaActual = date('Y-m-d h:i:s');  
        $fechaI = date('m-01 ');
        $fechaA = date('m-d ');  
     
      }else{

         $fechaInicioAnterior = date('Y-m-01 00:00:00');
         $fechaInicio = strtotime ( '-1 month' , strtotime ( $fechaInicioAnterior ) ) ;
         $fechaInicio = date ( 'Y-m-d' , $fechaInicio );

         $fechaInicioA = date('Y-m-01 00:00:00');
         $fechaIMP = strtotime ( '-1 month' , strtotime ( $fechaInicioA ) ) ;
         $fechaIMP = date ( 'm-d' , $fechaIMP );


         $fechaInicioActualAnterior = date('Y-m-d h:i:s');
         $fechaActual = strtotime ( '-1 month' , strtotime ( $fechaInicioActualAnterior ) ) ;
         $fechaActual = date ( 'Y-m-d' , $fechaActual );

         $fechaInicioActualAn = date('Y-m-d h:i:s');
         $fechaAMP = strtotime ( '-1 month' , strtotime ( $fechaInicioActualAn ) ) ;
         $fechaAMP = date ( 'm-d' , $fechaAMP );
      }

      $query = " SELECT SUM( sessionbill ) AS facturacion
        FROM cc_call, cc_card
        WHERE starttime >= '$fechaInicio'
        AND starttime <= '$fechaActual'
        AND `terminatecauseid` =1
        AND cc_call.card_id = cc_card.id
        AND address != 'REVENTA' AND `calledstation` !=  '611'
      ";
      if($request->ejecutar == 1){
       $result = $this->EjecutarEmsivozCo($query);
      }else{
          if($request->ejecutar == 2){
           $result = $this->EjecutarEmsivozVe($query);
          }else{
           $result = $this->EjecutarEmsivozUs($query);
          }
      }
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array('pesos' => $row->facturacion, 'fecha1'=>$fechaI, 'fecha2'=>$fechaA, 'fecha3'=>$fechaIMP, 'fecha4'=>$fechaAMP );
      }
      echo json_encode($post);
   }
   public function BalanceMinutos($request) {
      if ($fecha=$request->fecha == 1) { // consulta con fecha del mes actual
        $fechaInicio = date('Y-m-01 00:00:00');
        $fechaActual = date('Y-m-d 23:59:59');  
        $fechaI = date('m-01 ');
        $fechaA = date('m-d ');  
         
      }else{
        $fechaInicioAnterior = date('Y-m-01 00:00:00'); // inicio mes actual
        $fechaInicio = strtotime ( '-1 month' , strtotime ( $fechaInicioAnterior ) ) ; // resto un mes a fecha
        $fechaInicio = date ( 'Y-m-d 00:00:00' , $fechaInicio ); // nueva fecha correspondiente al inicio de la fecha del mes pasado

        // formato para imprimir fecha en grafica
         $fechaInicioA = date('Y-m-01 00:00:00');
         $fechaIMP = strtotime ( '-1 month' , strtotime ( $fechaInicioA ) ) ;
         $fechaIMP = date ( 'm-d' , $fechaIMP );


        $fechaInicioActualAnterior = date('Y-m-d 23:59:59'); // fecha actual
        $fechaActual = strtotime ( '-1 month' , strtotime ( $fechaInicioActualAnterior ) ) ; // resto mes a fecha actual
        $fechaActual = date ( 'Y-m-d 23:59:59' , $fechaActual ); // nueva fecha correspondiente a la fecha actual menos un mes

        // formato para imprimir fecha en grafica
         $fechaInicioActualAn = date('Y-m-d h:i:s');
         $fechaAMP = strtotime ( '-1 month' , strtotime ( $fechaInicioActualAn ) ) ;
         $fechaAMP = date ( 'm-d' , $fechaAMP ); 
      }

      $query = " SELECT SUM( CEIL( real_sessiontime /60 ) ) AS minutos FROM cc_call, cc_card WHERE starttime >= '$fechaInicio'
        AND starttime <= '$fechaActual'
        AND `terminatecauseid` = 1
        AND cc_call.card_id = cc_card.id
        AND address != 'REVENTA' AND `calledstation` !=  '611'
      ";
      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
           $result = $this->EjecutarEmsivozVe($query);
         }else{
           $result = $this->EjecutarEmsivozUs($query);
         }
      }
      $post = array();      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array('minutos' => $row->minutos, 'fecha1'=>$fechaI, 'fecha2'=>$fechaA, 'fecha3'=>$fechaIMP, 'fecha4'=>$fechaAMP );
      }
      echo json_encode($post);
   }  
   public function UsuariosActivosE($request) {
      $fecha = date('Y-m-d h:i:s');
      $fechaActivo = date('Y-m-d',strtotime('-3 days', strtotime($fecha)));

      $saldo = 0;
      if($request->ejecutar == 1){ $saldo = 1000; }else{  if($request->ejecutar == 2){  $saldo = 1;   }else{ $saldo = 1;  }  } 
      

      if ($request->valor == 1) { //usuarios activos
        $query = " SELECT COUNT(  cc_card.`id` ) AS usuarios FROM cc_call, cc_card WHERE cc_call.`card_id` = cc_card.`id` 
        AND starttime >=  '$fechaActivo' GROUP BY cc_card.`id` ";
      }else{
         if ($request->valor == 2) {
            $query = " SELECT COUNT(  cc_card.`id` ) AS usuarios FROM cc_card ";
         }else{
            $query="SELECT COUNT(  `id` ) AS sinSaldo FROM  `cc_card` WHERE  `credit` < $saldo ";
         }
      }

        if($request->ejecutar == 1){
          $result = $this->EjecutarEmsivozCo($query);
        }else{
          if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
          }else{
            $result = $this->EjecutarEmsivozUs($query);
          }
        }        
      
      $post = array();      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'saldo'=>$saldo, 'usuarios' => $row->usuarios, 'sinSaldo'=>$row->sinSaldo);
      }
      echo json_encode($post);
   }   
   public function fidelizacion($request) {
      
      $fecha1 =  date('Y-m-01 00:00:00');
      $query = "SELECT COUNT( id ) AS usuarios, SUM( monto ) AS monto FROM  `regalos_emsivoz` WHERE fecha_enviado >= '$fecha1' ";

      if($request->ejecutar == 1){
       $result = $this->EjecutarEmsivozCo($query);
      }else{
          if($request->ejecutar == 2){
           $result = $this->EjecutarEmsivozVe($query);
          }else{
           $result = $this->EjecutarEmsivozUs($query);
          }
      }
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
        $post[]= array( 'monto' => $row->monto, 'usuarios' => $row->usuarios );
      }
      echo json_encode($post);
   }
   public function recargasDiaC($request) {
      $d_fecha = date('Y-m-d'); // hoy
      $dt_Ayer= date('Y-m-d', strtotime('-1 day')) ; // resta 1 día
         

      if ($request->lugar == 1) {
         if ($request->fecha == 1) { // mes actual
            $query = " SELECT SUM(  `value` ) AS montoResD FROM  `recargas_crm`  WHERE `fecha` >= '$d_fecha'   ";
         }
         if ($request->fecha == 2) { // mes anterior
            $query = "SELECT SUM(  `value` ) AS montoResD FROM  `recargas_crm` WHERE  `fecha` >= '$dt_Ayer' AND  `fecha` < '$d_fecha'    ";
         }        
      }
      

      $result = $this->EjecutarEmsivozCo($query); 

      if ($result != 0 ) {
         $post = array();
         while ($row = mysqli_fetch_object($result)) {
            $post[]= array( 'montoD' => $row->montoResD, 'fecha1'=>$dt_Ayer, 'fecha2'=>$d_fecha );
         }
         echo json_encode($post);      
      }else{
         echo 'error';
      }    
   }   
   public function recargasDiaV($request) {
      $d_fecha = date('Y-m-d'); // hoy
      $dt_Ayer= date('Y-m-d', strtotime('-1 day')) ; // resta 1 día

      if ($request->fecha == 1) { // mes actual
         $query = " SELECT SUM(  `value` ) AS montoResD FROM  `recarga_mercadopago`  WHERE  `transaction_date` >= '$d_fecha'  ";
      }
      if ($request->fecha == 2) { // mes anterior
         $query = " SELECT SUM(  `value` ) AS montoResD FROM  `recarga_mercadopago`  WHERE  `transaction_date` >= '$dt_Ayer' AND `transaction_date` < '$d_fecha'  ";
      }        
      
      $result = $this->EjecutarEmsivozVe($query);

      if ($result != 0 ) {
         $post = array();
         while ($row = mysqli_fetch_object($result)) {
            $post[]= array( 'montoD' => $row->montoResD, 'fecha1'=>$dt_Ayer, 'fecha2'=>$d_fecha );
         }
         echo json_encode($post);      
      }else{
         echo 'error!!';
      }     
   }
   public function recargasDiaU($request) {
      $d_fecha = date('Y-m-d'); // hoy
      $dt_Ayer= date('Y-m-d', strtotime('-1 day')) ; // resta 1 día

      if ($request->fecha == 1) { // mes actual
         $query = " SELECT SUM(  `value` ) AS montoResD FROM  `recarga_paypal` WHERE  `transaction_date` >= '$d_fecha'  ";
      }
      if ($request->fecha == 2) { // mes anterior
         $query = " SELECT SUM(  `value` ) AS montoResD FROM  `recarga_paypal` WHERE  `transaction_date` >= '$dt_Ayer' AND `transaction_date` < '$d_fecha'  ";
      }        
      
      $result = $this->EjecutarEmsivozUs($query);

      if ($result != 0 ) {
         $post = array();
         while ($row = mysqli_fetch_object($result)) {
            $post[]= array( 'montoD' => $row->montoResD, 'fecha1'=>$dt_Ayer, 'fecha2'=>$d_fecha );
         }
         echo json_encode($post);      
      }else{
         echo 'error!!';
      }     
   }
   public function recargasSemC($request) {
      $d_fecha = date('Y-m-d'); // hoy
      $hoy = explode("-", $d_fecha);      
      $year=$hoy[0];    
      $month=$hoy[1];      
      $day=$hoy[2];
      # Obtenemos el numero de la semana
      $semana=date("W",mktime(0,0,0,$month,$day,$year));     
      # Obtenemos el día de la semana de la fecha dada
      $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));     
      # el 0 equivale al domingo...
      if($diaSemana==0)
          $diaSemana=7;     
      # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
      $primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));  //inicio de semana actual

      # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
      $ultimoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

      $hoyF = explode("-", $primerDia); // explode 
      $newFecha = $hoyF[2].'-'.$hoyF[1].'-'.$hoyF[0]; // reacomodamos la fecha Y-m-d
      $dt_SemanaPasada = date('$newFecha', strtotime('-1 week')) ; // resta 1 semana a fecha semana pasada
      
      $dt_SemanaPasada1 = date('Y-m-d', strtotime('-1 week')) ; // resta 1 semana   a la fecha actual 

      //restamos una dias a partir de la fecha de inicio de la semana actual
      $nuevafecha = strtotime ( '-1 week' , strtotime ( $newFecha ) ) ;
      // menos una semana a a partir de la fecha de incio de la semana
      $nuevafecha = date ( 'Y-m-j' , $nuevafecha );


      ////////////////////    DATOS A UTILIZAR /////////////////////////////////////////////////////////////////////////////////////
      //       echo $primerDia;              // . ' primer dia semana actual <br>';
      //       echo $d_fecha;                //. ' hoy   </ br>';
      //       echo $nuevafecha;             // . '   -1 semana a partir de inicio de la actual ! <br>';
      //       echo $dt_SemanaPasada1;       // . '  -1 semana a partir del la fecha  de hoy   <br>';
      //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      
         if ($request->fecha == 1) { // mes actual
            $query = " SELECT SUM(  `value` ) AS montoResD FROM  `recargas_crm`  WHERE `fecha` >= '$primerDia' ";
         }
         if ($request->fecha == 2) { // mes anterior
            $query = " SELECT SUM(  `value` ) AS montoResD FROM  `recargas_crm`  WHERE `fecha` >= '$nuevafecha' AND `fecha` <=  '$dt_SemanaPasada1'   ";
         }        
      

      $result = $this->EjecutarEmsivozCo($query); 
      
      if ($result != 0 ) {
         $post = array();  
      
         while ($row = mysqli_fetch_object($result)) {
            $post[]= array( 'montoS' => $row->montoResD, 'fecha1'=>$primerDia, 'fecha2'=>$d_fecha, 'fecha3'=>$nuevafecha, 'fecha4'=>$dt_SemanaPasada1);
         }      
         echo json_encode($post);      
            
      }else{
         echo "error !";
      }     
   }   
   public function recargasSemV($request) {
      $d_fecha = date('Y-m-d'); // hoy
      $hoy = explode("-", $d_fecha);      $year=$hoy[0];    $month=$hoy[1];      $day=$hoy[2];
      # Obtenemos el numero de la semana
      $semana=date("W",mktime(0,0,0,$month,$day,$year));     
      # Obtenemos el día de la semana de la fecha dada
      $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));     
      # el 0 equivale al domingo...
      if($diaSemana==0)
          $diaSemana=7;     
      # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
      $primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));  //inicio de semana actual

      # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
      $ultimoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

      $hoyF = explode("-", $primerDia); // explode 
    
      $newFecha = $hoyF[2].'-'.$hoyF[1].'-'.$hoyF[0]; // reacomodamos la fecha Y-m-d
      $dt_SemanaPasada = date('$newFecha', strtotime('-1 week')) ; // resta 1 semana a fecha semana pasada
      
      $dt_SemanaPasada1 = date('Y-m-d', strtotime('-1 week')) ; // resta 1 semana   a la fecha actual 

      //restamos una dias a partir de la fecha de inicio de la semana actual
      $nuevafecha = strtotime ( '-1 week' , strtotime ( $newFecha ) ) ;
      // menos una semana a a partir de la fecha de incio de la semana
      $nuevafecha = date ( 'Y-m-d' , $nuevafecha );


      ////////////////////    DATOS A UTILIZAR /////////////////////////////////////////////////////////////////////////////////////
      //       echo $primerDia;              // . ' primer dia semana actual <br>';
      //       echo $d_fecha;                //. ' hoy   </ br>';
      //       echo $nuevafecha;             // . '   -1 semana a partir de inicio de la actual ! <br>';
      //       echo $dt_SemanaPasada1;       // . '  -1 semana a partir del la fecha  de hoy   <br>';
      //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


      if ($request->fecha == 1) { // mes actual
         $query = " SELECT SUM(  `value` ) AS montoResD FROM  `recarga_mercadopago`  WHERE  `transaction_date` >= '$primerDia 00:00:00' ";
      }
      if ($request->fecha == 2) { // mes anterior
         $query = " SELECT SUM(  `value` ) AS montoResD FROM  `recarga_mercadopago`  WHERE  `transaction_date` >= '$nuevafecha 00:00:00' AND `transaction_date` <= '$dt_SemanaPasada1 23:59:59'  ";
      }        
    
      $result = $this->EjecutarEmsivozVe($query);
       
      $post = array();
      
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'montoS' => $row->montoResD, 'fecha1'=>$primerDia, 'fecha2'=>$d_fecha, 'fecha3'=>$nuevafecha, 'fecha4'=>$dt_SemanaPasada1);
      }      
      echo json_encode($post);      
   }      
   public function recargasSemU($request) {
      $d_fecha = date('Y-m-d'); // hoy
      $hoy = explode("-", $d_fecha);      $year=$hoy[0];    $month=$hoy[1];      $day=$hoy[2];
      # Obtenemos el numero de la semana
      $semana=date("W",mktime(0,0,0,$month,$day,$year));     
      # Obtenemos el día de la semana de la fecha dada
      $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));     
      # el 0 equivale al domingo...
      if($diaSemana==0)
          $diaSemana=7;     
      # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
      $primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));  //inicio de semana actual

      # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
      $ultimoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

      $hoyF = explode("-", $primerDia); // explode 
      $newFecha = $hoyF[2].'-'.$hoyF[1].'-'.$hoyF[0]; // reacomodamos la fecha Y-m-d
      $dt_SemanaPasada = date('$newFecha', strtotime('-1 week')) ; // resta 1 semana a fecha semana pasada
      
      $dt_SemanaPasada1 = date('Y-m-d', strtotime('-1 week')) ; // resta 1 semana   a la fecha actual 

      //restamos una dias a partir de la fecha de inicio de la semana actual
      $nuevafecha = strtotime ( '-1 week' , strtotime ( $newFecha ) ) ;
      // menos una semana a a partir de la fecha de incio de la semana
      $nuevafecha = date ( 'Y-m-j' , $nuevafecha );


      ////////////////////    DATOS A UTILIZAR /////////////////////////////////////////////////////////////////////////////////////
      //       echo $primerDia;              // . ' primer dia semana actual <br>';
      //       echo $d_fecha;                //. ' hoy   </ br>';
      //       echo $nuevafecha;             // . '   -1 semana a partir de inicio de la actual ! <br>';
      //       echo $dt_SemanaPasada1;       // . '  -1 semana a partir del la fecha  de hoy   <br>';
      //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      if ($request->fecha == 1) { // semana actual
         $query = " SELECT SUM(  `value` ) AS montoResD FROM  `recarga_paypal` WHERE  `transaction_date` >= '$primerDia'  ";
      }
      if ($request->fecha == 2) { // semana anterior
         $query = "SELECT SUM(  `value` ) AS montoResD FROM  `recarga_paypal` WHERE  `transaction_date` >= '$nuevafecha' AND `transaction_date` <= '$dt_SemanaPasada1' ";
      }        
      
      $result = $this->EjecutarEmsivozUs($query);
       
      $post = array();
      
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'montoS' => $row->montoResD, 'fecha1'=>$primerDia, 'fecha2'=>$d_fecha, 'fecha3'=>$nuevafecha, 'fecha4'=>$dt_SemanaPasada1);
      }      
      echo json_encode($post);      
   }
   public function recargasMesC($request) {
        $d_fecha = date('Y-m-01'); // Inicio mes
        $d_fecha1 = date('Y-m-d'); // hoy
        $dt_MesPasado = date('Y-m-01', strtotime('-1 month')) ; // Inicio  mes
        $dt_MesPasado1 = date('Y-m-d', strtotime('-1 month')) ; // resta 1 mes fecha hoy

        if ($request->lugar == 1) {
           if ($request->fecha == 1) { // mes actual
              $query = " SELECT SUM(  `value` ) AS montoResM FROM  `recargas_crm`  WHERE `fecha` >= '$d_fecha'  ";
           }
           if ($request->fecha == 2) { // mes anterior
              $query = " SELECT SUM(  `value` ) AS montoResM FROM  `recargas_crm`  WHERE `fecha` >=  '$dt_MesPasado' AND `fecha` <= '$dt_MesPasado1' ";
           }        
        }
        
        if ($request->lugar == 4) { //virtuales
            #$query="SELECT SUM(  `value` ) AS montoResM, COUNT( cod_id ) AS cantidad FROM  `recarga_payu`, cc_card WHERE `transaction_date` >= '$d_fecha' AND `response_message` =  'APPROVED' AND cc_card.`id`= recarga_payu.`idcard` AND address != 'REVENTA' ";
           $query="SELECT SUM(  `value` ) AS montoResM, COUNT( cod_id ) AS cantidad FROM  `recarga_payu` WHERE `transaction_date` >= '$d_fecha' AND `response_message` =  'APPROVED'   ";
        }
        if ($request->lugar == 5) { //fisicas
            #$query="SELECT SUM(  `value` ) AS montoResM, COUNT( cod_id ) AS cantidad FROM  `recarga_payu`, cc_card WHERE `transaction_date` >= '$d_fecha' AND `response_message` =  'APPROVED' AND cc_card.`id`= recarga_payu.`idcard` AND address != 'REVENTA' ";
            $query = " SELECT SUM(  `value` ) AS montoResM, COUNT( id ) AS cantidad  FROM  `recargas_crm`  WHERE `fecha` >= '$d_fecha'  AND punto != 'Payu' ";
        }

           $result = $this->EjecutarEmsivozCo($query);
        
      if ($result != 0 ) {
         $post = array();
        
         while ($row = mysqli_fetch_object($result)) {
            $post[]= array( 'montoM' => $row->montoResM, 'cantidad'=>$row->cantidad, 'fecha1'=>$d_fecha, 'fecha2'=>$d_fecha1, 'fecha3'=>$dt_MesPasado, 'fecha4'=>$dt_MesPasado1);
         }      
         echo json_encode($post);      
      }else{
         echo "error !";
      } 
   }   
   public function recargasMesV($request) {
      $d_fecha = date('Y-m-01'); // hoy
      $dt_MesPasado = date('Y-m-01', strtotime('-1 month')) ; // Inicio  mes
      $d_fecha1 = date('Y-m-d'); // hoy
      $dt_MesPasado1 = date('Y-m-d', strtotime('-1 month')) ; // resta 1 mes fecha hoy

      if ($request->fecha == 1) { // mes actual
         #$query="SELECT SUM(  `value` ) AS montoResM, COUNT(  `cod_id` ) AS cantidad FROM  `recarga_mercadopago`, cc_card  WHERE  `transaction_date` >= '$d_fecha' AND  `state_pol` =  'VERIFIED' AND cc_card.`id`= recarga_mercadopago.`idcard` AND address != 'REVENTA'  ";
         $query = " SELECT SUM(  `value` ) AS montoResM, COUNT(  `cod_id` ) AS cantidad FROM  `recarga_mercadopago`  WHERE  `transaction_date` >= '$d_fecha 00:00:00' AND  `state_pol` =  'VERIFIED' ";
      }
      if ($request->fecha == 2) { // mes anterior
         $query ="SELECT SUM(  `value` ) AS montoResM FROM  `recarga_mercadopago`  WHERE  `transaction_date` >= '$dt_MesPasado 00:00:00' AND  `transaction_date` <= '$dt_MesPasado1 23:59:59' AND  `state_pol` =  'VERIFIED'  ";
      }        
      
      
         $result = $this->EjecutarEmsivozVe($query);
      

      if ($result != 0 ) {
         $post = array();
      
         while ($row = mysqli_fetch_object($result)) {
            $post[]= array( 'montoM' => $row->montoResM, 'cantidad'=>$row->cantidad, 'fecha1'=>$d_fecha, 'fecha2'=>$d_fecha1, 'fecha3'=>$dt_MesPasado, 'fecha4'=>$dt_MesPasado1);
         }      
         echo json_encode($post);      
      }else{
         echo "error !";
      }    
   }   
   public function recargasMesU($request) {
      $d_fecha = date('Y-m-01'); // hoy
      $dt_MesPasado = date('Y-m-01', strtotime('-1 month')) ; // Inicio  mes
      $d_fecha1 = date('Y-m-d'); // hoy
      $dt_MesPasado1 = date('Y-m-d', strtotime('-1 month')) ; // resta 1 mes fecha hoy


      if ($request->fecha == 1) { // mes actual
         #$query="SELECT SUM(  `value` ) AS montoResM,  COUNT(  `cod_id` ) AS cantidad FROM  `recarga_paypal`, cc_card WHERE  `transaction_date` >= '2016-01-01' AND  `state_pol` =  'VERIFIED' AND cc_card.`id`= recarga_paypal.`idcard` AND address != 'REVENTA'";
         $query = " SELECT SUM(  `value` ) AS montoResM,  COUNT(  `cod_id` ) AS cantidad FROM  `recarga_paypal` WHERE  `transaction_date` >= '$d_fecha' AND  `state_pol` =  'VERIFIED' ";
      }
      if ($request->fecha == 2) { // mes anterior
         $query = "SELECT SUM(  `value` ) AS montoResM FROM  `recarga_paypal`  WHERE  `transaction_date` >= '$dt_MesPasado' AND  `transaction_date` <= '$dt_MesPasado1' AND  `state_pol` =  'VERIFIED' ";
      }        
      
        $result = $this->EjecutarEmsivozUs($query);
      
      
      if ($result != 0 ) {
         $post = array();
      
         while ($row = mysqli_fetch_object($result)) {
            $post[]= array( 'montoM' => $row->montoResM, 'cantidad'=>$row->cantidad, 'fecha1'=>$d_fecha, 'fecha2'=>$d_fecha1, 'fecha3'=>$dt_MesPasado, 'fecha4'=>$dt_MesPasado1);
         }      
         echo json_encode($post);      
      }else{
         echo "error !";
      }
   }
   public function detalleWeb($request) {
      $fechaHoy = date('Y-m-d 23:50:59');
      $fechaMes = date('Y-m-01 00:00:00');

      $query = "SELECT `id`, `visitas_web` ,  `fecha_web` FROM  `banco_web` WHERE  `fecha_web` >=  '$fechaMes' AND  `fecha_web` <=  '$fechaHoy' GROUP BY `fecha_web` ORDER BY  `fecha_web` ASC";
      //$query ="SELECT  `visitas_web`, `fecha_web`  FROM  `banco_web` ORDER BY  `id` DESC limit 1";
       
      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }    
      $post = array();
      while ($row = mysqli_fetch_object($result)) {
         $post[] = array( 'id'=>$row->id, 'visitas'=>$row->visitas_web, 'fecha'=>$row->fecha_web);
      }
      echo json_encode($post);
   }
   public function insertWeb($request) {
      $visitas = $request->visitasWeb;
      $fechaVisitasWeb = $request->fechaVisitasWeb;
      $query = "INSERT INTO `banco_web`( `visitas_web`, `fecha_web`) VALUES ( ' $visitas', '$fechaVisitasWeb' )";

        if($request->ejecutar == 1){
          $result = $this->EjecutarEmsivozCo($query);
        }else{
          if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
          }else{
            $result = $this->EjecutarEmsivozUs($query);
          }
        }        
      
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   } 
   public function deleteVisitaWeb($request) {
      $id = $request->id;
      $query = "DELETE FROM `banco_web` WHERE `id` = '$id' ";
       
      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }    
      if ($result) {
         echo true;
      }else{
         echo false;
      }
   }


   public function detallePlayStore($request) {
      $fechaHoy = date('Y-m-d 23:50:59');
      $fechaMes = date('Y-m-01 00:00:00');
      $query ="SELECT `id`, `visitas`, `descargas`, `desinstalaciones`, `dispositivos_activos`, `fecha_visitas` FROM  `banco_playstore` WHERE fecha_visitas >= '$fechaMes' AND fecha_visitas <= '$fechaHoy' GROUP BY `fecha_visitas` ORDER BY  `fecha_visitas` ASC";
       
      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }    
     
      $valor = $request->ejecutar;
      $post = array();
     
      while ($row = mysqli_fetch_object($result)) {

         $post[] = array( 'id'=>$row->id, 'fecha'=>$row->fecha_visitas, 'visitas'=>$row->visitas, 'descargas' => $row->descargas, 'desinstalaciones'=>$row->desinstalaciones, 'dispositivos'=>$row->dispositivos_activos);
      }
         
      echo json_encode($post);
   }
   public function insertPlayStore($request) {
      $visitasPlayStore = $request->visitasPlayStore;
      $descargas = $request->descargasPlayStore;
      $desinstalaciones = $request->desinstalacionesPlayStore;
      $dispositivosActivos = $request->dispositivosActivosPlayStore;

      $fecha = $request->fecha;
      $hoy = date('Y-m-d');

      if ($fecha > $hoy ) {
         echo false;
      }else{

         $query = "INSERT INTO `banco_playstore`(`visitas`, `fecha_visitas`, `descargas`, `fechas_descargas`, `desinstalaciones`, `fecha_desinstalaciones`, `dispositivos_activos`, `fecha_dispositivos_activos`) 
         VALUES ( 
            '$visitasPlayStore','$fecha', 
            '$descargas','$fecha', 
            '$desinstalaciones','$fecha',
            '$dispositivosActivos','$fecha' 
         )";

           if($request->ejecutar == 1){
             $result = $this->EjecutarEmsivozCo($query);
           }else{
             if($request->ejecutar == 2){
               $result = $this->EjecutarEmsivozVe($query);
             }else{
               $result = $this->EjecutarEmsivozUs($query);
             }
           }        
         
         if($result){
            echo TRUE;
         }else{
            echo false;
         }           
      }

   } 
   public function deleteVisitaPlay($request) {
      $id = $request->id;
      $query = "DELETE FROM `banco_playstore` WHERE `id` = '$id' ";
       
      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }    
      if ($result) {
         echo true;
      }else{
         echo false;
      }
   }


   public function detalleAppStore($request) {
      $fechaHoy = date('Y-m-d 23:50:59');
      $fechaMes = date('Y-m-01 00:00:00');

      $query ="SELECT `id`, `visitas`, `descargas`, `desinstalaciones`, `dispositivos_activos`, `fecha_visitas` FROM  `banco_appstore` WHERE fecha_visitas >= '$fechaMes' AND fecha_visitas <= '$fechaHoy' GROUP BY `fecha_visitas` ORDER BY  `fecha_visitas` ASC";
       
      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }    
     
      $valor = $request->ejecutar;
      $post = array();
     

      while ($row = mysqli_fetch_object($result)) {

         $post[] = array('id'=>$row->id, 'visitas'=>$row->visitas, 'fecha'=>$row->fecha_visitas, 'descargas' => $row->descargas, 'desinstalaciones'=>$row->desinstalaciones, 'dispositivos'=>$row->dispositivos_activos);
      }
         
       echo json_encode($post);
   }
   public function insertAppStore($request) {
      $visitasAppStore = $request->visitasAppStore;
      $descargas = $request->descargasAppStore;
      $desinstalaciones = $request->desinstalacionesAppStore;
      $dispositivosActivos = $request->dispositivosActivosAppStore;
      $fecha = $request->fecha;

      $fecha = $request->fecha;
      $hoy = date('Y-m-d');

      if ($fecha > $hoy ) {
         echo false;
      }else{
         $query = "INSERT INTO `banco_appstore`( `visitas`, `fecha_visitas`, `descargas`, `fechas_descargas`, `desinstalaciones`, `fecha_desinstalaciones`, `dispositivos_activos`, `fecha_dispositivos_activos`) 
         VALUES ( 
            '$visitasAppStore','$fecha', 
            '$descargas','$fecha', 
            '$desinstalaciones','$fecha',
            '$dispositivosActivos','$fecha' 
         )";

         if($request->ejecutar == 1){
            $result = $this->EjecutarEmsivozCo($query);
         }else{
            if($request->ejecutar == 2){
               $result = $this->EjecutarEmsivozVe($query);
            }else{
               $result = $this->EjecutarEmsivozUs($query);
            }
         }        
         
         if($result){
            echo TRUE;
         }else{
            echo false;
         }           
      }

   }
   public function deleteVisitaApp($request) {
      $id = $request->id;
      $query = "DELETE FROM `banco_appstore` WHERE `id` = '$id' ";
       
      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }    
      if ($result) {
         echo true;
      }else{
         echo false;
      }
   }



   public function detalleCampanna($request) {
      $fechaHoy = date('Y-m-d 23:50:59');
      $fechaMes = date('Y-m-01 00:00:00');

      $query ="SELECT `id`, `audiencia` ,  `total_clics` ,  `total_registros`, `fecha_visitas` FROM  `banco_campanna` WHERE fecha_visitas >= '$fechaMes' AND fecha_visitas <= '$fechaHoy' GROUP BY `fecha_visitas` ORDER BY  `fecha_visitas` ASC";
       
      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }    
     
      $valor = $request->ejecutar;
      $post = array();
     

      while ($row = mysqli_fetch_object($result)) {

         $post[] = array('id'=>$row->id, 'fecha'=>$row->fecha_visitas, 'audiencia'=>$row->audiencia, 'clics' => $row->total_clics, 'total_registros'=>$row->total_registros );
      }
         
       echo json_encode($post);
   }
   public function insertCampanna($request) {
      $audiencia = $request->audiencia;
      $fecha = $request->fecha;
      $totalClicsAudiencia = $request->totalClicsAudiencia;
      $totalRegistrosAudiencia = $request->totalRegistrosAudiencia;
      
      
      $query="INSERT INTO `banco_campanna`(`audiencia`, `fecha_visitas`, `total_clics`, `fecha_total_clics`, `total_registros`, `fecha_total_registros`) VALUES ('$audiencia','$fecha','$totalClicsAudiencia','$fecha','$totalRegistrosAudiencia','$fecha')";

      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
      
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
            echo "Venezuela";
         }else{
            $result = $this->EjecutarEmsivozUs($query);
            echo "USA";
         } 
      }       
      
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   } 
   public function deleteRegistroCampana($request) {
      $id = $request->id;
      $query = "DELETE FROM `banco_campanna` WHERE `id` = '$id' ";
       
      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }    
      if ($result) {
         echo true;
      }else{
         echo false;
      }
   }




   public function sumVisitasWeb($request){
      $fecha = date('Y-m-01');
      $dt_MesPasado = date('Y-m-01', strtotime('-1 month')) ; // Inicio  mes
        //$d_fecha1 = date('Y-m-d'); // hoy
      $dt_MesPasado1 = date('Y-m-d', strtotime('-1 month')) ; // resta 1 mes fecha hoy

      if ($request->fecha == 1) { // mes actual
        $query ="SELECT  SUM(  `visitas_web` ) AS visitas FROM  `banco_web` WHERE  `fecha_web` >= '$fecha' ";
      }
      if ($request->fecha == 2) { // mes PASADO
        $query ="SELECT  SUM(  `visitas_web` ) AS visitas FROM  `banco_web` WHERE  `fecha_web` >= '$dt_MesPasado' AND `fecha_web` < '$dt_MesPasado1' ";
      }

      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }  
      $post = array();
     
      while ($row = mysqli_fetch_object($result)) {

         $post[] = array( 'visitas'=>$row->visitas);
      }
      echo json_encode($post);
   }
   public function sumVisitasPlay($request){
      $fecha = date('Y-m-01');
      $dt_MesPasado = date('Y-m-01', strtotime('-1 month')) ; // Inicio  mes
        //$d_fecha1 = date('Y-m-d'); // hoy
      $dt_MesPasado1 = date('Y-m-d', strtotime('-1 month')) ; // resta 1 mes fecha hoy

      if ($request->fecha == 1) { // mes actual
        $query ="SELECT SUM(  `visitas` ) AS visitas, SUM(  `descargas` ) AS descargas FROM `banco_playstore`  WHERE `fecha_visitas` >=  '$fecha'  ";
      }
      if ($request->fecha == 2) { // mes PASADO
         $query ="SELECT SUM(  `visitas` ) AS visitas, SUM(  `descargas` ) AS descargas FROM `banco_playstore`  WHERE `fecha_visitas` >=  '$dt_MesPasado' AND `fecha_visitas` <  '$dt_MesPasado1' ";
      }

      if($request->ejecutar == 1){ 
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }  
      $post = array();
     
      while ($row = mysqli_fetch_object($result)) {

         $post[] = array( 'visitas'=>$row->visitas, 'descargas'=>$row->descargas);
      }
      echo json_encode($post);
   }
   public function sumVisitasApp($request){
      $fecha = date('Y-m-01');
      $dt_MesPasado = date('Y-m-01', strtotime('-1 month')) ; // Inicio  mes
        //$d_fecha1 = date('Y-m-d'); // hoy
      $dt_MesPasado1 = date('Y-m-d', strtotime('-1 month')) ; // resta 1 mes fecha hoy

      if ($request->fecha == 1) { // mes actual
         $query ="SELECT SUM(  `visitas` ) AS visitas, SUM(  `descargas` ) AS descargas FROM  `banco_appstore` WHERE  `fecha_visitas` >=  '$fecha' ";
      }
      if ($request->fecha == 2) { // mes PASADO
         $query ="SELECT SUM(  `visitas` ) AS visitas, SUM(  `descargas` ) AS descargas FROM  `banco_appstore` WHERE  `fecha_visitas` >=  'dt_MesPasado' AND `fecha_visitas` <  'dt_MesPasado1' ";
      }

      $query ="SELECT SUM(  `visitas` ) AS visitas, SUM(  `descargas` ) AS descargas FROM  `banco_appstore` WHERE  `fecha_visitas` >=  '2016-12-01' ";
      if($request->ejecutar == 1){ 
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }  
      $post = array();
     
      while ($row = mysqli_fetch_object($result)) {

         $post[] = array( 'visitas'=>$row->visitas, 'descargas'=>$row->descargas);
      }
      echo json_encode($post);
   }
   public function linealRegistros( $request ){
      $InicioMes = date('Y-m-01 00:00:00'); // Fecha de Inicio de mes
      $InMesPasado = date('Y-m-01 00:00:00', strtotime('-1 month')) ; // Inicio  mes pasado
      $hoy = date('Y-m-d 23:59:59'); // hoy
      $mesPasado = date('Y-m-d 23:59:59', strtotime('-1 month')) ; // resta 1 mes fecha hoy

      $date = date('Y-m-01');
      if ($request->fecha == 1) { // mes actual
         $query = "  SELECT COUNT( cc_card.`id` ) AS usuarios FROM cc_call, cc_card WHERE cc_call.`card_id` = cc_card.`id` AND starttime >= '$InicioMes'  ";
      }
      if ($request->fecha == 2) {
         $query = "  SELECT COUNT( cc_card.`id` ) AS usuarios FROM cc_call, cc_card WHERE cc_call.`card_id` = cc_card.`id` 
            AND starttime >='$InMesPasado' AND starttime < '$mesPasado'  ";
      }

      
      if($request->ejecutar == 1){
         $result = $this->EjecutarEmsivozCo($query);
      }else{
         if($request->ejecutar == 2){
            $result = $this->EjecutarEmsivozVe($query);
         }else{
            $result = $this->EjecutarEmsivozUs($query);
         }
      }        
      
      $post = array();      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array('usuarios' => $row->usuarios);
      }
      echo json_encode($post);
   }



   ////////////////////////////////////////////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////////////////////////////////////////////
   /////                                                                                           ////
   /////                Telefonia --- Banco de datos                                               ////
   /////                                                                                           ////
   ////////////////////////////////////////////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////////////////////////////////////////////
   
   //////////////////////////////////////////////////////////////
   // funciones de Canales
   /////////////////////////////////////////////////////////////
   public function selectCanales($request) {
      $query =" SELECT * FROM `canales` ORDER BY nombre ASC ";
      $result = $this->EjecutarTelefonia($query);
      $postCa = array();
      while ($row = mysqli_fetch_object($result)) {

         $variable = $request->variable;
         $nombre = $row->nombre;
         
         if ($variable == 1 ) {
         }else{
            $activos = $this->SSH($nombre,'OK');
            $activos = $activos + $this->SSH($nombre,'Unmonitored');
            $inactivos = $this->SSH($nombre,'UNKNOW');
         }
         
         $postCa[] = array( 'id'=>$row->id,  'nombre'=>$nombre,'activos'=>$activos,'inactivos'=>$inactivos);
      }
      echo json_encode($postCa);
   }// funcion principal de seleccion de canales 
   public function SSH($nombre,$proceso,$un){
      $connection = ssh2_connect('200.75.46.69', 2222);

      if (ssh2_auth_password($connection, 'root', 'voip5724422ems01')) {
       // echo "Authentication Successful!\n";
         $stream = ssh2_exec($connection, "asterisk -rx 'sip show peers' | grep '$nombre' | grep '$proceso' ");
         //$stream = ssh2_exec($connection, "asterisk -rx 'sip show peers' | grep movilvz ");
         //$stream = ssh2_exec($connection, "asterisk -rx 'sip show peers like movilvz' ");

         $errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);

         // Enable blocking for both streams
         stream_set_blocking($errorStream, true);
         stream_set_blocking($stream, true);

      // Whichever of the two below commands is listed first will receive its appropriate output.  The second command receives nothing
         $sr = stream_get_contents($stream);
         $lo = "<pre>".$sr."</pre>";
         $array = explode($proceso, $lo);
         $num = count($array) -1 ;
         /*echo count($sr);
         echo count("<pre>".$sr."</pre>");*/
         //print_r($sr);

      } else {
        $num = 0;
      }
      return $num;
   }
   public function detalleCanalesUno($request) {
      $id = $request->id;
      $query="SELECT nombre, id FROM canales WHERE id = '$id'  ";
      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {
         $post[] = array( 'id'=>$row->id, 'nombre'=>$row->nombre );
      }
      echo json_encode($post);
   } // funcion para seleccinoar dato en especifico
   public function verifCanales($request) {
      $nombre = $request->nombre;
      $query="SELECT * FROM canales WHERE nombre = '$nombre'  ";
      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {
         $post[] = array('nombre'=>$row->nombre );
         if ($post > 0) {
            echo TRUE;
         }else{
            echo FALSE;
         }
      }
   } // funcion de verificicacion de canal exitente para el registro
   public function insertCanales($request) {
      $nombre = $request->nombre;
      $query="INSERT INTO `canales` (`nombre`) VALUES ('$nombre')";
      $result = $this->EjecutarTelefonia($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   } // insertar canal
   public function updateCanales($request) {
      $nombre=$request->nombre;
      $id=$request->id;
      $query="UPDATE `canales` SET `nombre`='$nombre' WHERE `id`= '$id'  ";
      $result = $this->EjecutarTelefonia($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   } // actualizar canal
   public function deleteCanales($request) {
      $id = $request->id;
      
      $query="DELETE FROM  `canales` WHERE  `id` = '$id' "; 
      
      $result = $this->EjecutarTelefonia($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   } // funcion de borar canal


   //////////////////////////////////////////////////////////////
   // funciones Free Ip
   /////////////////////////////////////////////////////////////
   public function selectFreePBX($request) {
      $query =" SELECT id, `nombre`, `ip` FROM  `free_pbx` ORDER BY id DESC ";
      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {

         $ip = $row->ip;
         $nombre = $row->nombre;
         $post[] = array( 'id'=>$row->id, 'nombre'=>$nombre, 'ip_dato'=>$ip );

      }
      echo json_encode($post);
   }//Seleccionamos Ip Free
   public function verifBancoFreeIp($request) {
      $ip = $request->ip;
      $query="SELECT `ip` FROM `free_pbx` WHERE `ip` = '$ip'";
      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {

         $post[] = array('ip'=>$row->ip );

         if ($post > 0) {
            echo TRUE;
         }else{
            echo FALSE;
         }
      }
   }//Verifiamos si Existe Ip Free
   public function insertBancoFreeIp($request) {
      $nombre = $request->nombre;
      $ip = $request->ip;
      $query="INSERT INTO `free_pbx`(`nombre`, `ip`) VALUES ('$nombre', '$ip')";

      $result = $this->EjecutarTelefonia($query);

      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }// insertamos Ip Free
   public function detalleFree($request) {
      $id = $request->id;
      $query =" SELECT id, `nombre`, `ip` FROM  `free_pbx` WHERE id='$id' ";
      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {

         $ip = $row->ip;
         $nombre = $row->nombre;
         $post[] = array( 'id'=>$row->id, 'nombre'=>$nombre, 'ip_dato'=>$ip );

      }
      echo json_encode($post);
   } //seleccionamos dato especifico
   public function updateFreeIp($request) {
      $ip = $request->ipUpd;
      $nombre = $request->NombreIpF;
      $id = $request->idFrU;
      $query=" UPDATE  `free_pbx` SET  `nombre` =  '$nombre', `ip` =  '$ip' WHERE  `id`='$id'  ";
      $result = $this->EjecutarTelefonia($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   } // actualizar
   public function deleteFree($request) {
      $ipDel = $request->ip;
      
      $query="DELETE FROM  `free_pbx` WHERE  `ip` = '$ipDel' "; 
      
      $result = $this->EjecutarTelefonia($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   } // borar
   public function selectDreamPBX($request) {
      $query =" SELECT id, `nombre`, `ip` FROM `dream_pbx` ORDER BY id DESC ";
      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {
         $ip = $row->ip;
         $nombre = $row->nombre;
         $post[] = array( 'id'=>$row->id, 'nombre'=>$nombre, 'ip_dato'=>$ip );

      }
      echo json_encode($post);
   } // Seleccionamos Ip Dream

   //////////////////////////////////////////////////////////////
   // funciones Dream Ip
   /////////////////////////////////////////////////////////////
   public function verifBancoDreamIp($request) {
      $ip = $request->ip;
      $query="SELECT `ip` FROM `dream_pbx` WHERE `ip` = '$ip'";
      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {

         $post[] = array('ip'=>$row->ip );

         if ($post > 0) {
            echo TRUE;
         }else{
            echo FALSE;
         }
      }
   }// verificamos si existe ip Dream
   public function insertBancoDreamIp($request) {
      $nombre = $request->nombre;
      $ip = $request->ip;
      $query="INSERT INTO `dream_pbx`(`nombre`, `ip`) VALUES ('$nombre', '$ip')";

      $result = $this->EjecutarTelefonia($query);

      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }// insert Ip Dream
   public function detalleDream($request) {
      $id = $request->id;
      $query =" SELECT id, `nombre`, `ip` FROM  `dream_pbx` WHERE id='$id' ";
      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {

         $ip = $row->ip;
         $nombre = $row->nombre;
         $post[] = array( 'id'=>$row->id, 'nombre'=>$nombre, 'ip_dato'=>$ip );

      }
      echo json_encode($post);
   }
   public function updateDreamIp($request) {
      $ip = $request->ipUpd;
      $nombre = $request->NombreIpDr;
      $id = $request->idDrU;
      $query=" UPDATE  `telefonia`.`dream_pbx` SET  `nombre` = '$nombre', `ip` = '$ip' WHERE  `id`='$id'  ";
      $result = $this->EjecutarTelefonia($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }
   public function deleteDream($request) {
      $ipDel = $request->ip;
      
      $query="DELETE FROM  `dream_pbx` WHERE  `ip` = '$ipDel' "; 
      
      $result = $this->EjecutarTelefonia($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }


   //////////////////////////////////////////////////////////////
   // funciones Recargas
   /////////////////////////////////////////////////////////////
   public function saldoRecargas($request) {

      $query=" SELECT proveedor_recarga.`id_cod` , proveedor_recarga.`nombre` , recargas.`saldo` , recargas.`tipo_moneda`,  recargas.`fecha` 
         FROM recargas, proveedor_recarga
         WHERE recargas.`cod_pro` = proveedor_recarga.`id_cod` 
         AND recargas.`fecha` = ( 
         SELECT MAX( recargas.`fecha` ) 
         FROM recargas
         WHERE recargas.`cod_pro` = proveedor_recarga.`id_cod` 
         GROUP BY  `cod_pro` ) 
         GROUP BY id_cod
         ORDER BY  proveedor_recarga.`nombre` ASC 
      ";
      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {

         $cod = $row->id_cod;
         $saldo = $row->saldo;
         $moneda = $row->tipo_moneda;
         $fecha = $row->fecha;
         $date=substr($fecha, 0, 10 ); 
         $proveedor = $row->nombre;
         $post[] = array( "name"=>$proveedor, "data"=>$saldo,   'cod'=>$cod, 'saldo'=>$saldo, 'moneda'=>$moneda, 'fecha'=>$date, 'proveedor'=>$proveedor );

      }
      echo json_encode($post);
   }//seleccionamos salgo Recargas 
   public function detalleRecargas($request) {
      $codigo = $request->cod;

      $query="SELECT  `recargas`.`saldo` , recargas.`tipo_moneda`,  `recargas`.`fecha` , `proveedor_recarga`.`nombre` , proveedor_recarga.id_cod
         FROM  `recargas` ,  `proveedor_recarga` 
         WHERE  `proveedor_recarga`.`id_cod` =  '$codigo'
         AND  `recargas`.`cod_pro` =  `proveedor_recarga`.`id_cod` 
         AND  `recargas`.`fecha` = ( SELECT MAX(  `recargas`.`fecha` ) 
         FROM  `recargas` 
         WHERE  `recargas`.`cod_pro` =  `proveedor_recarga`.`id_cod` 
         GROUP BY  `cod_pro` ) 
         ORDER BY  `fecha` DESC ";

      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {
         $cod = $row->id_cod;
         $proveedor = $row->nombre;
         $saldo = $row->saldo;
         $moneda = $row->tipo_moneda;
         $fecha = $row->fecha;
         $date=substr($fecha, 0, 10 ); 
         $post[] = array('cod'=>$cod, 'proveedor'=>$proveedor, 'saldo'=>$saldo, 'moneda'=>$moneda, 'fecha'=>$date );
      }
      echo json_encode($post);
   }// seleccionamos un dato en especifico con el codigo
   public function verif_pro_Recargas($request) {
      //sleep(2);
      $nombre = $request->nombre;

      $query="SELECT id_cod,  `nombre` FROM  `proveedor_recarga` WHERE  `nombre` =  '$nombre' ORDER BY id_cod DESC ";

      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {

         $post[] = array( 'cod'=>$row->id_cod, 'nombre'=>$row->nombre );
         if ($request->variable == 1) {
            if ($post > 0) {
               echo TRUE; 
            }else{
               echo FALSE;
            }
         }
      }
      if ($request->variable == 2) {
         echo json_encode($post);
      }
   }//verificamos si existe proveedor para insertar uno nuevo
   public function updateRecargas($request) {
      $codigo = $request->cod;
      $proveedor = $request->proveedor;
      $saldo = $request->saldo;
      $moneda = $request->moneda;
      $date = $request->fecha;
      $hora = date('h:i:s');
      $fecha = $date . ' ' . $hora;
      
      $query="INSERT INTO `recargas`(`cod_pro`, `saldo`, `tipo_moneda`, `fecha`) VALUES ('$codigo', '$saldo', '$moneda', '$fecha' )"; 
      $result = $this->EjecutarTelefonia($query);

      if($result){
         $query1="UPDATE `proveedor_recarga` SET `nombre`='$proveedor' WHERE `id_cod`= '$codigo'  ";
         $result1 = $this->EjecutarTelefonia($query1);
         if($result1){
            echo TRUE;
         }else{
            echo false;
         }
      }else{
         echo false;
      }  
   }//actualizamos recargas desde Banco de datos
   public function deleteRecargas($request) {
      $cod = $request->cod;
      $query ="DELETE FROM `proveedor_recarga` WHERE `id_cod` = '$cod' ";
      $result = $this->EjecutarTelefonia($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }
   public function insert_proRecarga($request) {
      $nombre = $request->nombre;
      //$valor = $request->valor;
      $query=" INSERT INTO `proveedor_recarga`(`nombre`) VALUES ('$nombre') ";

      $result = $this->EjecutarTelefonia($query);

      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }// insertamos prooveedor Recargas
   public function insert_Recarga($request) {
      $cod = $request->cod;
      $saldo = $request->saldo;
      $moneda = $request->moneda;
      $fecha = date('Y-m-d h:i:s');

      $query=" INSERT INTO  `recargas` (  `cod_pro` ,  `saldo`, `tipo_moneda`, `fecha`  ) VALUES ( '$cod',  '$saldo', '$moneda', '$fecha' )";

      $result = $this->EjecutarTelefonia($query);

      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }//Insertamos Recargas a proveedor recien ingresado

   //////////////////////////////////////////////////////////////
   // funciones facturacion
   //////////////////////////////////////////////////////
   public function tofacturacion($request) {
      $query=" SELECT facturacion.`id`, `proveedor_facturacion`.`id_cod`,`facturacion`.`valor`, `facturacion`.`fecha_limite`, `facturacion`.`estado` , `proveedor_facturacion`.`nombre`
         FROM `facturacion`, `proveedor_facturacion` 
         WHERE `facturacion`.`cod_pro` =  `proveedor_facturacion`.`id_cod` 
         AND `facturacion`.`fecha_limite`  = ( SELECT MAX( `facturacion`.`fecha_limite` ) 
         FROM `facturacion` WHERE `facturacion`.`cod_pro` =  `proveedor_facturacion`.`id_cod` 
         GROUP BY  `cod_pro` ) ORDER BY  `proveedor_facturacion`.`nombre` ASC";
      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {

         $dt_Ayer= date('Y-m-d', strtotime('-1 day')) ; // resta 1 día

         $fecha = $row->fecha_limite;
         $estado = $row->estado;
         $cod = $row->id_cod;
         $fechaHoy = date('Y-m-d H:i:s');

         if ($estado == '2' AND $fecha < $fechaHoy) {
            $id = $row->id;
            $cod_pro = $row->id_cod;

            $query1 = "UPDATE `facturacion` SET `estado` = '3' WHERE `id` ='$id' AND `cod_pro` = '$cod_pro'  ";
            $result1 = $this->EjecutarTelefonia($query1);
            if($result1){
               $query=" SELECT facturacion.`id`, `proveedor_facturacion`.`id_cod`,`facturacion`.`valor`, `facturacion`.`fecha_limite`, `facturacion`.`estado` , `proveedor_facturacion`.`nombre`
                  FROM `facturacion`, `proveedor_facturacion` 
                  WHERE `facturacion`.`cod_pro` =  `proveedor_facturacion`.`id_cod` 
                  AND `facturacion`.`fecha_limite`  = ( SELECT MAX( `facturacion`.`fecha_limite` ) 
                  FROM `facturacion` WHERE `facturacion`.`cod_pro` =  `proveedor_facturacion`.`id_cod` 
                  GROUP BY  `cod_pro` ) ORDER BY  `proveedor_facturacion`.`nombre` ASC";
               $result = $this->EjecutarTelefonia($query);
               $post = array();
               while ($row = mysqli_fetch_object($result)) {
                  $date=substr($fecha, 0, 10 ); 
                  $post[] = array( 'se ha '=>'actualizado', 'fechaRegistro'=>$fecha, 'fechaHoy'=>$fechaHoy, 'cod'=>$row->id_cod, 'proveedor'=>$row->nombre, 'valor'=>$row->valor, 'fecha'=>$date, 'estado'=>$row->estado);
               }
            }
         }else{
            $date=substr($fecha, 0, 10 ); 
            $post[] = array( 'bien'=>'bien', 'fechaRegistro'=>$fecha, 'fechaHoy'=>$fechaHoy, 'cod'=>$row->id_cod, 'proveedor'=>$row->nombre, 'valor'=>$row->valor, 'fecha'=>$date, 'estado'=>$row->estado);
         }
      }
      echo  json_encode($post);
   }///seleccionar todos los datos
   public function detalleFacturacion($request) {
      $codigo = $request->cod;

      $query="SELECT  `facturacion`.`valor` ,  `facturacion`.`fecha_limite` ,  `facturacion`.`estado` ,  `proveedor_facturacion`.`nombre` , proveedor_facturacion.id_cod
         FROM  `facturacion` ,  `proveedor_facturacion` 
         WHERE  `proveedor_facturacion`.`id_cod` =  '$codigo'
         AND  `facturacion`.`cod_pro` =  `proveedor_facturacion`.`id_cod` 
         AND  `facturacion`.`fecha_limite` = ( 
         SELECT MAX(  `facturacion`.`fecha_limite` ) 
         FROM  `facturacion` 
         WHERE  `facturacion`.`cod_pro` =  `proveedor_facturacion`.`id_cod` 
         GROUP BY  `cod_pro` ) 
         ORDER BY  `fecha_limite` DESC ";

      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {
         $cod = $row->id_cod;
         $proveedor = $row->nombre;
         $valor = $row->valor;
         $fecha = $row->fecha_limite;
         $date=substr($fecha, 0, 10 ); 
         $estado = $row->estado;
         $post[] = array('cod'=>$cod, 'proveedor'=>$proveedor, 'valor'=>$valor, 'fecha'=>$date, 'estado'=>$estado );

      }
      echo json_encode($post);
   }//seleccionar dato en especifico con el cod
   public function updatefacturacion($request) {
      $codigo = $request->cod;
      $valor = $request->valor;
      $proFacturacion = $request->proFacturacion;
      $date = $request->fecha;
      $hora = date('h:i:s');
      $fecha = $date . ' ' . $hora;

      $estado = $request->estado;
     
      
      $query="INSERT INTO `facturacion`( `cod_pro`, `valor`, `fecha_limite`, `estado`) VALUES ( '$codigo', '$valor', '$fecha', '$estado' ) ";
      $result = $this->EjecutarTelefonia($query);
      if($result){
          
         $query1="UPDATE `proveedor_facturacion` SET `nombre`='$proFacturacion' WHERE  `id_cod` = '$codigo'  ";
         $result1 = $this->EjecutarTelefonia($query1);
         if($result1){
            echo TRUE;
         }else{
            echo false;
         }
      }else{
         echo false;
      }  
   }//actualizamos datos
   public function deleteFactura($request) {
      $cod = $request->cod;
      $query ="DELETE FROM `proveedor_facturacion` WHERE `id_cod` = '$cod' ";
      $result = $this->EjecutarTelefonia($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }
   public function verif_pro_Facturacion($request) {
      $nombre = $request->nombre;
      $query="SELECT id_cod,  `nombre` FROM  `proveedor_facturacion` WHERE  `nombre` =  '$nombre' ORDER BY id_cod DESC limit 1 ";
      $result = $this->EjecutarTelefonia($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {
         $post[] = array( 'cod'=>$row->id_cod, 'nombre'=>$row->nombre );
      }
      echo json_encode($post);
   }///verifiamos datos si existe y mostramos
   public function insert_proFacturacion($request) {
      $nombre = $request->nombre;
      //$valor = $request->valor;
      $query=" INSERT INTO `proveedor_facturacion`(`nombre`) VALUES ('$nombre') ";
      $result = $this->EjecutarTelefonia($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }//insertamos proveedor
   public function insert_Facturacion($request) {
      $cod = $request->cod;
      $valor = $request->valor;
      $date = $request->fecha;
      
      $fecha = $date.' '.date('h:i:s');

      //$nuevafecha = strtotime ( '-2 hour' , strtotime ( $fecha ) ) ;
      //$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

      //$valor = $request->valor;
      $query="INSERT INTO `facturacion` (`cod_pro`,`valor`,`fecha_limite`,`estado`) VALUES ('$cod','$valor','$fecha','2')";

      $result = $this->EjecutarTelefonia($query);

      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }//insertamos factura a proveedor recien registrado


   public function atenEmpresarial($request) {
      $fecha1 = $request->fecha1;
      $fecha2 = $request->fecha2;
      $estado = $request->estado;
      //echo $fecha1;
      //echo $fecha2;
      $query1="SELECT nombre_usu, apellido_usu, COUNT( cod_usu ) AS nums
         FROM SoportesIncidenciasEmpresas, Incidencias_Empresariales, usuario, tiposervicio_empresarial, ubicacion_servicio_empresarial, datos_clientes_empresariales,  `BD_tiposervicio` 
         WHERE  `fechaCrear_sop` >=  '$fecha1'
         AND fechaCrear_sop <=  '$fecha2'
         AND SoportesIncidenciasEmpresas.cod_inc = Incidencias_Empresariales.cod_inc
         AND usuario.cod_usu = Incidencias_Empresariales.responsable_inc
         AND Incidencias_Empresariales.cod_servicio = tiposervicio_empresarial.cod_ser_emp
         AND tiposervicio_empresarial.cod_ubicacion_emp = ubicacion_servicio_empresarial.cod_ubi_emp
         AND ubicacion_servicio_empresarial.cod_empresa = datos_clientes_empresariales.cod_emp
         AND  `tiposervicio_empresarial`.`tipo_servicio_emp` = (  `BD_tiposervicio`.`cod_tp` = '$estado' ) 
         GROUP BY cod_usu
         ORDER BY nums DESC  LIMIT 1
      ";
         
         $result1 = $this->Ejecutar($query1);
         while ($res = mysqli_fetch_object($result1)) {
            $responsable_eficiente = $res->nombre_usu." ".$res->apellido_usu;
            $numE = $res->nums;
         }

      // query de seleccion de datos empresariales.
      $query=" SELECT `BD_tiposervicio`.`cod_tp`, `BD_tiposervicio`.`nombre_tp`, nombre_emp, descripcion_sop, nombre_usu, apellido_usu, fecha_inc, estado  
         FROM SoportesIncidenciasEmpresas, Incidencias_Empresariales, usuario, tiposervicio_empresarial, ubicacion_servicio_empresarial, datos_clientes_empresariales, `BD_tiposervicio`
         WHERE  `fechaCrear_sop` >=  '$fecha1'
         AND fechaCrear_sop <=  '$fecha2'
         AND SoportesIncidenciasEmpresas.cod_inc = Incidencias_Empresariales.cod_inc
         AND usuario.cod_usu = Incidencias_Empresariales.responsable_inc
         AND Incidencias_Empresariales.cod_servicio = tiposervicio_empresarial.cod_ser_emp
         AND tiposervicio_empresarial.cod_ubicacion_emp = ubicacion_servicio_empresarial.cod_ubi_emp
         AND ubicacion_servicio_empresarial.cod_empresa = datos_clientes_empresariales.cod_emp 
         AND `tiposervicio_empresarial`.`tipo_servicio_emp` = (`BD_tiposervicio`.`cod_tp` = '$estado')
      ";
      $result = $this->Ejecutar($query);
      $post_1 = array();
      while ($row = mysqli_fetch_object($result)) {
         $servicio = $row->nombre_tp;
            $cliente = $row->nombre_emp;
            $desServicio = $row->descripcion_sop;
            $responsable = $row->nombre_usu." ".$row->apellido_usu;
            $fecha = $row->fecha_inc;
            $estado = $row->estado;

            $post_1[] = array( 'estado'=>utf8_encode($estado), 'Nomservicio'=>utf8_encode($servicio), 'cliente'=>utf8_encode($cliente), 'desServicio'=>utf8_encode($desServicio), 'Responsable'=>utf8_encode($responsable), 'fecha'=>$fecha,  'estado'=>utf8_encode($estado), 'responsableEficE'=>utf8_encode($responsable_eficiente), 'vecesE'=>$numE );
      }
      echo json_encode($post_1);         
   }
   public function AtencionClienteDetallestelefoniaEmpresarialesTiempo($request) {
      $dateIn = $request->fechaInicio;
      $dateFi = $request->fechaFin;
      $estado = $request->estado;
      $query = "          
         SELECT `SoportesIncidenciasEmpresas`.`fechaCrear_sop`, 
            `SoportesIncidenciasEmpresas`.`horaCrear_sop`, 
            `SoportesIncidenciasEmpresas`.`fechaCerrar_sop`, 
            `SoportesIncidenciasEmpresas`.`horaCerrar_sop`           
         FROM SoportesIncidenciasEmpresas, Incidencias_Empresariales, usuario, tiposervicio_empresarial, ubicacion_servicio_empresarial, datos_clientes_empresariales, `BD_tiposervicio`
         WHERE  `fechaCrear_sop` >=  '$dateIn'
         AND fechaCrear_sop <=  '$dateFi'
         AND SoportesIncidenciasEmpresas.cod_inc = Incidencias_Empresariales.cod_inc
         AND usuario.cod_usu = Incidencias_Empresariales.responsable_inc
         AND Incidencias_Empresariales.cod_servicio = tiposervicio_empresarial.cod_ser_emp
         AND tiposervicio_empresarial.cod_ubicacion_emp = ubicacion_servicio_empresarial.cod_ubi_emp
         AND ubicacion_servicio_empresarial.cod_empresa = datos_clientes_empresariales.cod_emp 
         AND `tiposervicio_empresarial`.`tipo_servicio_emp` = (`BD_tiposervicio`.`cod_tp` = '$estado')
      ";
         
         $result = $this->Ejecutar($query);
         $post = array();
         while ($row = mysqli_fetch_object($result)) {
            $fecha = $row->fechaCrear_sop;
            $fecha1 = $row->horaCrear_sop;

            $fecha2 = $row->fechaCerrar_sop;
            $fech3 = $row->horaCerrar_sop;

            $fechaIn = $fecha . ' '. $fecha1;
            $fechaFi = $fecha2 . ' '. $fech3;

               // calculos de diferencia de fechas
            $start_date = new DateTime($fechaIn);         
            $since_start = $start_date->diff(new DateTime($fechaFi)); 

               // guardamos diferencia de fechas 
            $deta =  $since_start->y . ':' . $since_start->m . ':' . $since_start->d . ':' . $since_start->h . ':' . $since_start->i . ':' . $since_start->s; 
           
            $post[] = array( 'estado'=>$estado, 'fecha1'=>$fechaIn, 'fecha2'=>$fechaFi, 'diferencia'=>$deta );  

         }
      echo json_encode($post);
   }
   public function AtencionPersonal($request) {
      $dateIn = $request->fechaInicio;
      $dateFi = $request->fechaFin;
      $estado = $request->estado;
      
      # sql reponsable eficiente

      $query1="SELECT COUNT( cod_usu ) AS nums, nombre_usu, apellido_usu
         FROM SoportesIncidenciasPersonales, Incidencias_Personales, usuario, tiposervicio_personal, ubicacion_servicio_personal, datos_clientes_personales,  `BD_tiposervicio` 
         WHERE  `fechaCrear_sop` >=  '$dateIn'
         AND fechaCrear_sop <=  '$dateFi'
         AND SoportesIncidenciasPersonales.cod_inc = Incidencias_Personales.cod_inc
         AND usuario.cod_usu = Incidencias_Personales.responsable_inc
         AND Incidencias_Personales.cod_servicio = tiposervicio_personal.cod_ser
         AND tiposervicio_personal.cod_ubicacion = ubicacion_servicio_personal.`cod_ubi` 
         AND ubicacion_servicio_personal.`cod_persona` = datos_clientes_personales.`cod_cli` 
         AND estado =  'revisado'
         AND  `tiposervicio_personal`.`tiposervicio` = (  `BD_tiposervicio`.`cod_tp` = '$estado' ) 
         GROUP BY cod_usu     ORDER BY nums DESC   LIMIT 1";

      $result1 = $this->Ejecutar($query1);
      while ($res = mysqli_fetch_object($result1)) {
         $responsable_eficiente = $res->nombre_usu." ".$res->apellido_usu;
         $numP = $res->nums;
      }


      $query=" SELECT 
         `BD_tiposervicio`.`cod_tp`, `BD_tiposervicio`.`nombre_tp`, 
         `datos_clientes_personales`.`nombre1_cli`, 
         `datos_clientes_personales`.`nombre2_cli`, 
         `datos_clientes_personales`.`apellido1_cli`, 
         `datos_clientes_personales`.`apellido2_cli`, 
         descripcion_sop, nombre_usu, apellido_usu, fecha_inc, estado  
         FROM SoportesIncidenciasPersonales, Incidencias_Personales, usuario, tiposervicio_personal, ubicacion_servicio_personal, datos_clientes_personales, `BD_tiposervicio`
         WHERE  `fechaCrear_sop` >=  '$dateIn'
         AND fechaCrear_sop <=  '$dateFi'
         AND SoportesIncidenciasPersonales.cod_inc = Incidencias_Personales.cod_inc
         AND usuario.cod_usu = Incidencias_Personales.responsable_inc
         AND Incidencias_Personales.cod_servicio = tiposervicio_personal.cod_ser
         AND tiposervicio_personal.cod_ubicacion = ubicacion_servicio_personal.`cod_ubi`
         AND ubicacion_servicio_personal.`cod_persona` = datos_clientes_personales.`cod_cli` 
         AND `tiposervicio_personal`.`tiposervicio` = (`BD_tiposervicio`.`cod_tp` = '$estado' )
      ";
         
      $result = $this->Ejecutar($query);
      $post = array();
      while ($row = mysqli_fetch_object($result)) {

         $servicio = $row->nombre_tp;
         $cliente = $row->nombre1_cli." ".$row->nombre2_cli." ".$row->apellido1_cli." ".$row->apellido2_cli;
         $desServicio = $row->descripcion_sop;
         $responsable = $row->nombre_usu." ".$row->apellido_usu;
         $fecha = $row->fecha_inc;
         $estado = $row->estado;

         $post[] = array('estado'=>utf8_encode($estado), 'Nomservicio'=>utf8_encode($servicio), 'cliente'=>utf8_encode($cliente), 'desServicio'=>utf8_encode($desServicio), 'Responsable'=>utf8_encode($responsable), 'fecha'=>$fecha,  'estado'=>utf8_encode($estado), 'responsableEficP'=>utf8_encode($responsable_eficiente), 'vecesP'=>$numP );
      }
         
        echo json_encode($post); 
   }
   public function AtencionClienteDetallestelefoniaPersonalesTiempo($request) {
      $dateIn = $request->fechaInicio;
      $dateFi = $request->fechaFin;
      $estado = $request->estado;
      $query = "          
         SELECT `SoportesIncidenciasPersonales`.`fechaCrear_sop` ,  `SoportesIncidenciasPersonales`.`horaCrear_sop` , `SoportesIncidenciasPersonales`.`fechaCerrar_sop` ,  `SoportesIncidenciasPersonales`.`horaCerrar_sop` 
         FROM SoportesIncidenciasPersonales, Incidencias_Personales, usuario, tiposervicio_personal, ubicacion_servicio_personal, datos_clientes_personales,  `BD_tiposervicio` 
         WHERE  `fechaCrear_sop` >=  '$dateIn'
         AND fechaCrear_sop <=  '$dateFi'
         AND SoportesIncidenciasPersonales.cod_inc = Incidencias_Personales.cod_inc
         AND usuario.cod_usu = Incidencias_Personales.responsable_inc
         AND Incidencias_Personales.cod_servicio = tiposervicio_personal.cod_ser
         AND tiposervicio_personal.cod_ubicacion = ubicacion_servicio_personal.`cod_ubi` 
         AND ubicacion_servicio_personal.`cod_persona` = datos_clientes_personales.`cod_cli` 
         AND  `tiposervicio_personal`.`tiposervicio` = (  `BD_tiposervicio`.`cod_tp` = '$estado' ) 
      ";
         
         $result = $this->Ejecutar($query);
         $post = array();
         while ($row = mysqli_fetch_object($result)) {
            $fecha = $row->fechaCrear_sop;
            $fecha1 = $row->horaCrear_sop;

            $fecha2 = $row->fechaCerrar_sop;
            $fech3 = $row->horaCerrar_sop;

            $fechaIn = $fecha . ' '. $fecha1;
            $fechaFi = $fecha2 . ' '. $fech3;

               // calculos de diferencia de fechas
            $start_date = new DateTime($fechaIn);         
            $since_start = $start_date->diff(new DateTime($fechaFi)); 

               // guardamos diferencia de fechas 
            $deta =  $since_start->y . ':' . $since_start->m . ':' . $since_start->d . ':' . $since_start->h . ':' . $since_start->i . ':' . $since_start->s; 
           
            $post[] = array('estado'=>$estado, 'fecha1'=>$fechaIn, 'fecha2'=>$fechaFi, 'diferencia'=>$deta );  

         }
      echo json_encode($post);
   }
   public function pingPHP($request) {
      $ip = $request->ip;
      $n = $request->n;
      $post = array();
      if ($this->GetPing($ip) == 'perdidos),') {
         $post[] = array( 'nom'=>$n, 'val'=>'2', 'ip'=>$ip ,'estado'=>'tiempo agotado' );
      } else if ($this->GetPing($ip) == '0ms') {
         $post[] = array( 'nom'=>$n, 'val'=>'2', 'ip'=>$ip,'estado'=>'servidor apagado' );
      } else {
         $post[] = array( 'nom'=>$n , 'val'=>'1', 'ip'=>$ip ,'estado'=>'servidor encendido');
      }
      echo json_encode($post);
   } // Ping Ip PHP
   public function GetPing($ip=NULL) {
      if(empty($ip)) {$ip = $_SERVER['REMOTE_ADDR'];}
      if(getenv("OS")=="Windows_NT") {
         $exec = exec("ping -c1 ".$ip);
         return end(explode(" ", $exec ));
      }else {
         $exec = exec("ping -c1 ".$ip);
         $array = explode("/", end(explode("=", $exec )) );
         return ceil($array[0]) . 'ms';
      }
   }
   ///postgres sql consulta
   public function pgVMActivas($request) {
      $activas = 0;
      $total = 0;
      $query ="SELECT count(*) as coun FROM vm_static s, vm_dynamic d, tags t, tags_vm_map tv WHERE s.vm_guid = d.vm_guid AND t.tag_id = tv.tag_id AND tv.vm_id = d.vm_guid AND t.tag_name LIKE '%produccion%' AND d.status = 1";
      $result = $this->EjecutarPostgresSql($query);
      if(pg_num_rows($result)> 0){
           while ($re = pg_fetch_object($result)){
            $activas =  $re->coun;
           }
      }
      $query ="SELECT count(*) as coun FROM vm_static s, vm_dynamic d, tags t, tags_vm_map tv WHERE s.vm_guid = d.vm_guid AND t.tag_id = tv.tag_id AND tv.vm_id = d.vm_guid AND t.tag_name LIKE '%produccion%'";
      $result = $this->EjecutarPostgresSql($query);
      if(pg_num_rows($result)> 0){
           while ($re = pg_fetch_object($result)){
            $total =  $re->coun;
           }
      } 
      $post[]= array( 'activas'=>$activas, 'total'=>$total );
      echo json_encode($post);
   }
    public function pgVMInactivas($request) {
      $query ="SELECT s.vm_name, t.tag_name, d.status FROM vm_static s, vm_dynamic d, tags t, tags_vm_map tv WHERE s.vm_guid = d.vm_guid AND t.tag_id = tv.tag_id AND tv.vm_id = d.vm_guid AND t.tag_name LIKE '%produccion%' AND d.status = 0 ORDER BY vm_name";
      $result = $this->EjecutarPostgresSql($query);
      if(pg_num_rows($result)> 0){
           while ($re = pg_fetch_object($result)){
            $post[]= array( 'name'=>$re->vm_name, 'tag_name'=>$re->tag_name,'status'=>$re->status);
           }
      }
      echo json_encode($post);
   }
   public function pgHosts($request) {
      $query ="SELECT s.vds_name as host, d.status as estado, d.vm_count as numerovms FROM vds_static s, vds_dynamic d WHERE s.vds_id = d.vds_id ORDER BY s.vds_name";
      $result = $this->EjecutarPostgresSql($query);
      if(pg_num_rows($result)> 0){
           while ($re = pg_fetch_object($result)){
            switch ($re->estado) {
               case 0:
                  # code...
                  $estado ='No Asignado';
                  $variable = 1;
                  break;
               case 2:
                  # code...
                  $estado ='Mantenimiento';
                  $variable = 2;
                  break;
               case 3:
                  # code...
                  $estado ='Activo';
                  $variable = 3;
                  break;
               case 10:
                  # code...
                  $estado ='No Operacional';
                  $variable = 4;
                  break;
            }
            $post[]= array( 'host'=>$re->host, 'variable'=>$variable, 'estado'=>$estado,'numerovms'=>$re->numerovms);
           }
      }
      echo json_encode($post);
   }
      public function pgAlmacenamiento($request) {
      $query ="SELECT s.storage_name, d.available_disk_size as libre, used_disk_size as ocupado FROM storage_domain_static s, storage_pool p, storage_pool_iso_map sp, storage_domain_dynamic d WHERE s.id = sp.storage_id AND sp.storage_pool_id = p.id AND s.id = d.id AND p.name = 'EMSITEL' ORDER BY s.storage_name;
";
      $result = $this->EjecutarPostgresSql($query);
      if(pg_num_rows($result)> 0){
           while ($re = pg_fetch_object($result)){
            $post[]= array( 'name'=>$re->storage_name, 'disponible'=>$re->libre,'ocupado'=>$re->ocupado);
           }
      }
      echo json_encode($post);
   }
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   /////                                               ////
   /////                 INTERNET                      ////
   /////                                               ////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   public function contratoMaxMin($request) {
      $va = $request->variable;
      if ($va == 1) { // consulta empresarial
         $query="SELECT sum(velmax_emp) as conmax, sum(velmin_emp) as conmin FROM `detalleservicio_empresarial`,tiposervicio_empresarial WHERE detalleservicio_empresarial.cod_servicio_emp=tiposervicio_empresarial.cod_ser_emp AND tipo_servicio_emp = 1 AND estado_servicio_emp = 1";
      }
      if ($va == 2) {
         $query="SELECT SUM(  `velmax_det` ) AS conmax, SUM(  `velmin_det` ) AS conmin FROM  `detalleservicio_personal` , tiposervicio_personal WHERE detalleservicio_personal.`cod_tiposervicio` = tiposervicio_personal.`cod_ser` AND  `tiposervicio` =1 AND  `estadoservicio` =1";
      }


      $result = $this->Ejecutar($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'conmax'=>$row->conmax, 'conmin'=>$row->conmin );
      }
      echo json_encode($post);
   }

   ////////////////////////////////////////////////////////
   /////         CANALES INTERNACIONALES               ////
   ////////////////////////////////////////////////////////
   
   public function selecCanalesContratados($request) {
      $query="SELECT * FROM `canales`  ";
      $result = $this->EjecutarInternet($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'id'=>$row->id, 'nombre'=>$row->nombre, 'megas'=> 0 + $row->megas );
      }
      echo json_encode($post);
   }
   public function detalleCanalesContrados($request) {
      $id = $request->id;
      $query="SELECT `id`, `nombre`, `megas` FROM `canales` WHERE `id` = '$id'     ";
      $result = $this->EjecutarInternet($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'id'=>$row->id, 'nombre'=>$row->nombre, 'megas'=>$row->megas );
      }
      echo json_encode($post);
   }
   public function updateCanalesContrados($request) {
      $id=$request->id;
      $nombre=$request->nombre;
      $megas=$request->megas;

      $query="UPDATE `canales` SET `nombre`='$nombre', `megas`='$megas' WHERE `id`= '$id' ";

      $result = $this->EjecutarInternet($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }
   public function deleteCanalesContratados($request) {
      $id=$request->id;
      $query="DELETE FROM `canales` WHERE `id`= '$id'   ";
      
      $result = $this->EjecutarInternet($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }
   public function inserCanalesContratados($request) {
      $nombre = $request->nombre;
      $megas = $request->megas;

      $query="INSERT INTO `canales`( `nombre`, `megas`) VALUES ( '$nombre', '$megas'   )";
      
      $result = $this->EjecutarInternet($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }

   public function selecEspacioUsado($request) {
      $query="SELECT * FROM `espacio_usado` order by `id` desc limit 1  ";
      $result = $this->EjecutarInternet($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'id'=>$row->id, 'capacidad'=> 0 + $row->capacidad, 'usado'=> 0 + $row->usado, 'fecha'=>$row->fecha );
      }
      echo json_encode($post);
   }
   public function updateEspacioUsado($request) {
      $capacidad = $request->capacidad;
      $usado = $request->usado;
      $fecha = date('Y-m-d H:i:s');
      $query="INSERT INTO  `internet`.`espacio_usado` ( `id` , `capacidad` , `usado` , `fecha` ) VALUES ( NULL ,  '$capacidad',  '$usado',  '$fecha' ) ";
      $result = $this->EjecutarInternet($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }
   public function detallesEspacioUsado($request) {
      // seleccionamos el espacio disponible contratado por canales
      $query= " SELECT SUM(  `megas` ) AS disponible FROM  `canales` ";
      $result = $this->EjecutarInternet($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         // obtenosmo la suma del espacio disponible
         $disponible = $row->disponible;

         // Ejecutamos query de para saber el ultimo registro que actualizaremos
         $query1="SELECT * FROM `espacio_usado` order by `id` desc limit 1  ";
         $result1 = $this->EjecutarInternet($query1);
         $post = array();
         while ($row = mysqli_fetch_object($result1)) {
            $id = $row->id;

            // ejecutamos query actualizando registro dependiendo del id seleccionado
            $query2 =" UPDATE `espacio_usado` SET `capacidad`= '$disponible' WHERE `id` = '$id'  ";
            $result2 = $this->EjecutarInternet($query2);
            if($result2){
               echo TRUE;
            }else{
               echo false;
            }
         }
         echo json_encode($post);
      }
      echo json_encode($post);
   }
   
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   /////                                               ////
   /////              AREA COMERCIAL                   ////
   /////                                               ////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   public function contactosEstadisticasGestion($request) {
      $fecha1 = $request->fecha1;
      $fecha2 = $request->fecha2;
      $vendedor = $request->vendedor;
      $variable = $request->variable;
      if ($variable == 1 ) { // seleccionar todos los contactos
         if ($vendedor != '0' ) {
            $query="SELECT  `nombre_cliente` ,  `competencia` ,  `asesor_comercial` ,  `negocio_exitoso` ,  `dias_confianza` ,  `dias_comunicacion` , `dias_cooperacion` ,  `duracion_dias` FROM  `contactos` WHERE  `fecha_registro` >=  '$fecha1' AND  `fecha_registro` <=  '$fecha2' AND asesor_comercial =  '$vendedor' ORDER BY  `nombre_cliente` ASC   ";   
         }else{
            $query="SELECT  `nombre_cliente` ,  `competencia` ,  `asesor_comercial` ,  `negocio_exitoso` ,  `dias_confianza` ,  `dias_comunicacion` , `dias_cooperacion` ,  `duracion_dias` FROM  `contactos` WHERE  `fecha_registro` >=  '$fecha1' AND  `fecha_registro` <=  '$fecha2' ORDER BY  `nombre_cliente` ASC   ";
         }
         
      }
      if ($variable == 2 ) { // seleccionar mayor monto
         $query="SELECT   `monto` FROM  `contactos`  WHERE  `fecha_registro` >=  '$fecha1' AND  `fecha_registro` <=  '$fecha2' AND  `negocio_exitoso` =  'SI' ORDER BY  `monto` DESC LIMIT 1 ";
      }
      if ($variable == 3) { // seleccionar tiempo de negociacion mas corto
         $query="SELECT  `nombre_cliente` ,  `duracion_dias` FROM  `contactos` WHERE  `fecha_registro` >=  '$fecha1' AND  `fecha_registro` <=  '$fecha2' AND  `negocio_exitoso` =  'SI' ORDER BY  `duracion_dias` ASC   LIMIT 1 ";
      }
      $result = $this->EjecutarComercial($query);
      $post = array();
      
    
      while ($row = mysqli_fetch_object($result)) {
           $queryS="SELECT CONCAT(nombre_usu, ' ', apellido_usu) AS name FROM usuario WHERE admin = ".$row->asesor_comercial." ";

          $resultS = $this->EjecutarSoportel($queryS);
          $asesor_comercial = "";
          while ($ws = mysqli_fetch_object($resultS)) {
            # code...
            $asesor_comercial = utf8_encode($ws->name);
          }
         $post[]= array( 'nombre_cliente'=>$row->nombre_cliente, 'competencia'=>$row->competencia, 'asesor_comercial'=>$asesor_comercial,  'negocio_exitoso'=>$row->negocio_exitoso, 'dias_negociacion'=>$row->duracion_dias, 'monto'=>$row->monto );
      }
      echo json_encode($post);
   }
   public function totalCliente($request) {
      $variable = $request->variable;
      $fecha1 = $request->fecha1;
      $fecha2 = $request->fecha2;
      $vendedor = $request->vendedor;
      if ($vendedor != '0') {
         if ($variable == 1) {
            $query="SELECT COUNT(  `id` ) AS num FROM  `contactos` WHERE  `fecha_registro` >=  '$fecha1' AND  `fecha_registro` <=  '$fecha2' AND asesor_comercial =  'Juan'   ";
         }else{
            if ($variable == 2) {
               $query="SELECT COUNT(  `id` ) AS num FROM  `contactos` WHERE  `negocio_exitoso` =  'SI'  AND `fecha_registro` >=  '$fecha1' AND  `fecha_registro` <=  '$fecha2' AND asesor_comercial =  '$vendedor'  ";
            }else{
               if ($variable == 3) {
                  $query="SELECT ROUND( AVG(  `dias_negociacion` ) , 1 ) AS num FROM contactos WHERE `fecha_registro` >=  '$fecha1' AND  `fecha_registro` <=  '$fecha2' AND negocio_exitoso = 'SI' AND asesor_comercial =  '$vendedor'  ";
               }
            }
         }
      }else{
         if ($variable == 1) {
            $query="SELECT COUNT(  `id` ) AS num FROM  `contactos` WHERE `fecha_registro` >= '$fecha1' AND  `fecha_registro` <= '$fecha2'   ";
         }else{
            if ($variable == 2) {
               $query="SELECT COUNT(  `id` ) AS num FROM  `contactos` WHERE  `negocio_exitoso` =  'SI'  AND `fecha_registro` >=  '$fecha1' AND  `fecha_registro` <=  '$fecha2'  ";
            }else{
               if ($variable == 3) {
                  $query="SELECT ROUND( AVG(  `dias_negociacion` ) , 1 ) AS num FROM contactos WHERE `fecha_registro` >=  '$fecha1' AND  `fecha_registro` <=  '$fecha2' AND negocio_exitoso = 'SI' ";
               }
            }
         }
      }
      $result = $this->EjecutarComercial($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array(   'num'=>$row->num  );
      }
      echo json_encode($post);
   } 
   public function vendedorEficiente($request) {
      $fecha1 = $request->fecha1;
      $fecha2 = $request->fecha2;
      $query="SELECT ROUND( AVG(  `monto` ) , 1 ) / ROUND( AVG(  `duracion_dias` ) , 1 ) AS valor,  `asesor_comercial` FROM  `contactos` WHERE  `negocio_exitoso` =  'SI' AND  `fecha_registro` >=  '$fecha1' AND  `fecha_registro` <=  '$fecha2' GROUP BY  `asesor_comercial` ORDER BY valor DESC limit 1 ";
      $result = $this->EjecutarComercial($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
          $queryS="SELECT CONCAT(nombre_usu, ' ', apellido_usu) AS name FROM usuario WHERE admin = ".$row->asesor_comercial." ";

          $resultS = $this->EjecutarSoportel($queryS);
          $asesor_comercial = "";
          while ($ws = mysqli_fetch_object($resultS)) {
            # code...
            $asesor_comercial = utf8_encode($ws->name);
          }
         $post[]= array('vendedor'=>$asesor_comercial  ); 
      }
      echo json_encode($post);
   }

   public function ComercialSubServicios($request){
      $servicio = $request->servicio;
      $query = "SELECT * FROM servicios WHERE cod_ser = $servicio";
      $result = $this->EjecutarComercial($query);
      while ($row = mysqli_fetch_object($result)) {
         $cod_ser = $row->cod_ser;
      
      $query2 = "SELECT * FROM subservicios WHERE cod_ser = $cod_ser ORDER BY cod_subs ASC";
      $result2 = $this->EjecutarComercial($query2);
      $post[]= array();
      while ($row = mysqli_fetch_object($result2)) {
      $nom_subservicio =$row->nom_subservicio;
      $post[] = array('nombre_subservicio' => $nom_subservicio);
   }
   
      echo json_encode($post);
      }

   }

   public function ComercialVerSubServicios($servicio){
      $query = "SELECT * FROM servicios WHERE cod_ser = $servicio";
      $result = $this->EjecutarComercial($query);
      while ($row = mysqli_fetch_object($result)) {
         $cod_ser = $row->cod_ser;
      
      $query2 = "SELECT * FROM subservicios WHERE cod_ser = $cod_ser ORDER BY cod_subs ASC";
      $result2 = $this->EjecutarComercial($query2);
      $post[]= array();
      while ($row = mysqli_fetch_object($result2)) {
      $nom_subservicio =$row->nom_subservicio;
      $post[] = array('nombre_subservicio' => $nom_subservicio);
   }
   
      echo json_encode($post);
      }

   }

   public function updateFormSubs($request){
      $id=$request->cliente;
      $query = "SELECT * FROM contactos WHERE id = $id";
      $result = $this->EjecutarComercial($query);
      while ($row = mysqli_fetch_object($result)) {
         $servicio = $row->servicio;
      
         $post[] = array('servicio' => $servicio);
      
      }
      echo json_encode($post);

   }

   public function ComercialSubervicios() {
      $query="SELECT *   FROM  `subservicios`  ORDER BY cod_subs ASC  ";
      $result = $this->EjecutarComercial($query);
      return $result;
   }

   ////////////////////////////////////////////////////////
   /////      BALANCE COMERCIAL BANCO DATOS            ////
   ////////////////////////////////////////////////////////
   public function ComercialSectorEconomico() {
      $query="SELECT *   FROM  `sector_economico`  ORDER BY categoria ASC  ";
      $result = $this->EjecutarComercial($query);
      return $result;
   }
    public function ComercialServicios() {
      $query="SELECT *   FROM  `servicios`  ORDER BY tipo_servicio DESC  ";
      $result = $this->EjecutarComercial($query);
      return $result;
   }
    public function ComercialCompetencia() {
      $query="SELECT *   FROM  `competencia`  ORDER BY categorias ASC  ";
      $result = $this->EjecutarComercial($query);
      return $result;
   }
    public function ComercialAsesores() {
      $query="SELECT CONCAT(nombre_usu, ' ', apellido_usu) AS name, nombre_rol,rol_usu.usuario as cod FROM  `rol_usu` , usuario, rol WHERE rol_usu.usuario = usuario.admin AND rol.cod_rol = rol_usu.rol AND ( cod_rol =1 OR cod_rol =2 )";
      $result = $this->EjecutarSoportel($query);
      return $result;
   }
  
   public function selecBalance($request) {
      #$query="SELECT  `id` ,  `cantidad` ,  `valor` ,  `fecha` ,  `id_cod` ,  `nombre`    FROM  `tipo_ventas` ,  `registro_ventas` WHERE  `id_cod` =  `cod_ventas`   AND  `fecha` = (  SELECT MAX(  `fecha` ) FROM  `registro_ventas`          WHERE registro_ventas.`cod_ventas` = tipo_ventas.id_cod )    ";
      $fei = $request->fechaIniaco;
      $fef = $request->fechaFinaco;
      $query="SELECT COUNT( id ) AS num, SUM( monto ) AS monto, asesor_comercial   FROM  `contactos`   WHERE negocio_exitoso =  'SI' AND fecha_registro >= '$fei 00:00:00' AND fecha_final <= '$fef 23:59:59' GROUP BY  `asesor_comercial`  ";
      $result = $this->EjecutarComercial($query);
      $post = array();
      if(mysqli_num_rows($result) > 0){
         while ($row = mysqli_fetch_object($result)) {
            $post[]= array( 'nombre'=>$row->asesor_comercial, 'cantidad'=> 0 + $row->num, 'valor'=> 0 + $row->monto );
         }
      }else{
          $post[]= array( 'nombre'=>false);
      }
      echo json_encode($post);
   }
   public function detalleBalance($request) {
         // query de todos los registros
      $fei = $request->fechaIniaco;
      $fef = $request->fechaFinaco;
      $query = "SELECT COUNT(`id`) as registros FROM `contactos` WHERE  fecha_registro >= '$fei 00:00:00'  ";
      $result = $this->EjecutarComercial($query);
      $post = array();
      $registros = 0;
      $rta = 0;
      if(mysqli_num_rows($result) > 0){
         $rta = 1;
         while ($row = mysqli_fetch_object($result)) {
            $registros = $registros +  $row->registros;

         }
      }

      // query de los registros de confianza
      $query = "SELECT COUNT(  `id` ) AS comunicacion FROM  `contactos` WHERE  `comunicacion` !=  'NULL'   AND fecha_registro >= '$fei 00:00' AND comunicacion <= '$fef 23:59:59' ";
      $result = $this->EjecutarComercial($query);
      $comunicacion = 0;
      if(mysqli_num_rows($result) > 0){
         $rta = 1;
         while ($row = mysqli_fetch_object($result)) {
            $comunicacion = $comunicacion +  $row->comunicacion;
         }
      }

      // query de los registros de comunicacion
      $query = "SELECT COUNT(  `id` ) AS cooperacion FROM  `contactos` WHERE  `cooperacion` !=  'NULL'  AND fecha_registro >= '$fei 00:00:00' AND cooperacion <= '$fef 23:59:59'  ";
      $result = $this->EjecutarComercial($query);
      $cooperacion = 0;
      if(mysqli_num_rows($result) > 0){
         $rta = 1;
         while ($row = mysqli_fetch_object($result)) {
            $cooperacion = $cooperacion +  $row->cooperacion;
            $confianza = $registros - $comunicacion;
            $comunicacion = $comunicacion - $cooperacion;

            $post[]= array( 'todosR'=>$registros, 'confianza'=> 0 + $confianza, 'comunicacion'=> 0 + $comunicacion, 'cooperacion'=>$cooperacion );

         }
      }
      if($rta==0){
          $post[]= array( 'todosR'=>false);
      }

         echo json_encode($post);
      

     
   }



   ////////////////////////////////////////////////////////
   /////     GESTION COMERCIAL BANCO DATOS             ////
   ////////////////////////////////////////////////////////

   public function diasFinalesComercial($request) {
      $query="SELECT id, `confianza` ,  `comunicacion` ,  `cooperacion` ,  `fecha_final` ,  `duracion_dias` FROM  `contactos` ";
      $result = $this->EjecutarComercial($query);
      $post = array();
      $totaDias = 0;
      while ($row = mysqli_fetch_object($result)) {

         $confianza = $row->confianza;
         $comunicacion = $row->comunicacion;
         $cooperacion = $row->cooperacion;
         $final = $row->fecha_final;

         // condicional para saber los dias de confianza
         // si comunicacion tiene fecha ahh... entramos a comparar la fecha de confianza con comunicacion
         if ($comunicacion != null ) {
            $fechaComun1 = $comunicacion;
         }else{
            $fechaComun1 = date('Y-m-d h:i:s');
         }
               $fechaConf1 = $confianza;
               $datetime1 = new DateTime($fechaConf1);
               $datetime2 = new DateTime($fechaComun1);
               $interval = $datetime1->diff($datetime2);

               $diasConfianza = 0 + $interval->format('%a');  // dias de diferencia entre confianza y comunicacion
         
               if($diasConfianza == 0){
                  $diasConfianza = 1;
               }
         // condicional para saber los dias de comunicacion
         // si en cooperacion hay fecha.... entramos a comparar la fecha de comunicacion con cooperacion
         if ($comunicacion != null ) {
            if ($cooperacion != null ) {
                $fechaCoop2 = $cooperacion;
            }else{
                $fechaCoop2 = date('Y-m-d h:i:s');
            }
               $fechaComun2 = $comunicacion; // dias comunicacion
               // dias cooperacion
                  $datetime1 = new DateTime($fechaComun2);
                  $datetime2 = new DateTime($fechaCoop2);
                  $interval = $datetime1->diff($datetime2);

                  $diasComuicacion = 0 + $interval->format('%a');   // dias de diferencia entre comunicacion y cooperacion
                  if($diasComuicacion == 0){
                        $diasComuicacion = 1;
                   }
         }else{
               $diasComuicacion =  0;
         }

         // para saber los dias de cooperacion
         // si en la fecha final esta llena... entramos a comparar la fecha de cooperacion y la final
        if ($cooperacion != null ) {
            if ($final != null ) {
               $fechafinal3 = $final; 
            }else{
               $fechafinal3 = date('Y-m-d h:i:s');
            }
                  $fechaCoop3 = $cooperacion; // dias cooperacin
                  // dias final de cierre
                  $datetime1 = new DateTime($fechaCoop3);
                  $datetime2 = new DateTime($fechafinal3);
                  $interval = $datetime1->diff($datetime2);

                  $diasCooperacion = 0 + $interval->format('%a');   // dias cooperacion
                  if($diasCooperacion == 0){
                     $diasCooperacion = 1;
                  }

         }else{
            $diasCooperacion =  0;
         }
         $totaDias = $diasConfianza + $diasComuicacion + $diasCooperacion;
         $id = $row->id;
        
         $query1 ="UPDATE `contactos` SET `dias_confianza`='$diasConfianza', `dias_comunicacion`='$diasComuicacion' ,`dias_cooperacion`='$diasCooperacion', `duracion_dias`='$totaDias' WHERE `id` = '$id' ";
         $result1 = $this->EjecutarComercial($query1);
         if($result1){
            echo TRUE;
         }else{
            echo false;
         }
         $post[]= array( 'totaDias'=>$totaDias,  'confianza'=>$diasConfianza, 'comunicacion'=>$diasComuicacion, 'cooperacion'=>$diasCooperacion  );
      }
      echo json_encode($post);
   }

   function dias_transcurridos($fecha_i,$fecha_f) {
      $dias = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
      $dias    = abs($dias); $dias = floor($dias);    
      return $dias;
   }

   public function selectContactosGestion($request) {
         $com  = false;
         session_start();
        $roles    = count($_SESSION['tipo_rol']);
        $dis   = false;
        for ($i=0; $i < $roles; $i++) { 
            if($_SESSION['tipo_rol'][$i] == 'Comercial'){
                $com = true;
            }
            
            if($_SESSION['tipo_rol'][$i] ==  "ADMINISTRADOR"){
                $dis = true;
            }
      }
      $sql = "";
      
      if($com == true){
         $sql =  ' WHERE asesor_comercial = '.$_SESSION['admin'];
      }

      if($dis == true){
          $sql = "";
      }
      $query="SELECT `id`, `nombre_cliente`, `tipo_cliente`, `sector_economico`, `servicio`,`subservicio`, `competencia`, `asesor_comercial`, `negocio_exitoso`, `monto`, `fecha_registro`, `confianza`, `comunicacion`, `cooperacion`, `fecha_final`, `dias_confianza`, `dias_comunicacion`, `dias_cooperacion`, `duracion_dias` FROM `contactos` $sql ORDER BY  `nombre_cliente` ASC  ";

      $result = $this->EjecutarComercial($query);
      $post = array();
      $fecha_f = date('Y-m-d');
      
      while ($row = mysqli_fetch_object($result)) {
       /*  $dias_confianza      = $row->dias_confianza;
         $dias_comunicacion   = $row->dias_comunicacion;
         $dias_cooperacion    = $row->dias_cooperacion;

         if($dias_confianza == 0){

            $dias_confianza = 1;
         }
         if($dias_comunicacion == 0){
            $dias_comunicacion = 1;
         }
         if($dias_cooperacion == 0){
            $dias_cooperacion = 1;
         }*/
         $diasConfianza = 0 + $row->dias_confianza;
         $diasComuicacion = 0 + $row->dias_comunicacion;
         $diasCooperacion = 0 +  $row->dias_cooperacion;
       //  if($diasConfianza == 0){$diasConfianza=1;}
       /*  if ($diasConfianza != 0 ) {
            $diasConfianza = $diasConfianza ;
            if ($diasComuicacion != 0 ) {
               $diasComuicacion = $diasComuicacion ;
               if ($diasCooperacion != 0 ) {
                  $diasCooperacion = $diasCooperacion ;
               }else{
                  $date = $row->cooperacion;
                  $fecha_i = substr($date, 0, 10 ); 
                  $diasCooperacion = $this->dias_transcurridos($fecha_i, $fecha_f);
               }
            }else{
               $date = $row->comunicacion;
               $fecha_i = substr($date, 0, 10 ); 
               $diasComuicacion = $this->dias_transcurridos($fecha_i, $fecha_f);
               $diasCooperacion = '-' ;
            }
         }else{
            $date = $row->fecha_registro;
            $fecha_i = substr($date, 0, 10 ); 
            $diasConfianza = $this->dias_transcurridos($fecha_i, $fecha_f);
            $diasComuicacion = '-';
            $diasCooperacion = '-' ;
         }*/

         $date = $row->fecha_registro;
         $fecha = substr($date, 0, 10 ); 

         $queryS="SELECT CONCAT(nombre_usu, ' ', apellido_usu) AS name FROM usuario WHERE admin = ".$row->asesor_comercial." ";

       $resultS = $this->EjecutarSoportel($queryS);
       $asesor_comercial = "";
       while ($ws = mysqli_fetch_object($resultS)) {
         # code...
         $asesor_comercial = utf8_encode($ws->name);
       }
       //$servicio=$row->servicio.','$row->subservicio;
         $post[]= array( 'id'=>$row->id, 'nombre_cliente'=>strtolower($row->nombre_cliente), 'tipo_cliente'=>$row->tipo_cliente, 'sector_economico'=>$row->sector_economico, 'servicio'=>$row->servicio,'subservicio'=>$row->subservicio, 'competencia'=>$row->competencia, 'asesor_comercial'=>$asesor_comercial, 'confianza'=>$diasConfianza, 'comunicacion'=>$diasComuicacion, 'cooperacion'=>$diasCooperacion, 'fechaFinal'=>$final,  'negocio_exitoso'=>$row->negocio_exitoso, 'monto'=>$row->monto,   'fecha_registro'=>$fecha  );
      }
      echo json_encode($post);
   }
   public function selectEstadoComercial($request) {
      $f1 = $request->f1;
      $f2 = $request->f2;
      $busqueda = $request->busqueda;
      $asesor = $request->asesor;
      $nom = "";

      if ($busqueda == 1 ) {
         $sql = "  `comunicacion` IS NULL AND `confianza` >=  '$f1 00:00:00' AND `confianza` <= '$f2 23:59:59' "; # sql para saber datos en confianza
      }else{
         if ($busqueda == 2 ) {
            $sql = " `cooperacion` IS NULL AND `comunicacion` >= '$f1 00:00:00' AND `comunicacion` <= '$f2 23:59:59'  "; # sql para saber datos en comunicacion
         }else{
            if ($busqueda == 3) {
               $sql = "  `fecha_final` IS NULL AND `cooperacion` >= '$f1 00:00:00' AND `cooperacion` <= '$f2 23:59:59' "; # sql para saber datos de cooperacion
            }else{
               if ($busqueda == 4) {
                  $fecha1 = $request->f1;
                  $fecha2 = $request->f2;
                  $sql = " `fecha_registro` >= '$fecha1 00:00:00' AND `fecha_registro` <= '$fecha2 23:59:59' "; #AND `negocio_exitoso` = 'SI'   ";
               }               
            }            
         }         
      }
      if ($asesor == 999 ) {
         $query="SELECT `id`, `nombre_cliente`, `tipo_cliente`, `sector_economico`, `servicio`, `competencia`, `asesor_comercial`, `negocio_exitoso`, `monto`, `fecha_registro`, `confianza`, `comunicacion`, `cooperacion`, `fecha_final`, `dias_confianza`, `dias_comunicacion`, `dias_cooperacion`, `duracion_dias` FROM `contactos` WHERE  $sql  ORDER BY  `nombre_cliente` ASC ";
      }else{
         $query="SELECT `id`, `nombre_cliente`, `tipo_cliente`, `sector_economico`, `servicio`, `competencia`, `asesor_comercial`, `negocio_exitoso`, `monto`, `fecha_registro`, `confianza`, `comunicacion`, `cooperacion`, `fecha_final`, `dias_confianza`, `dias_comunicacion`, `dias_cooperacion`, `duracion_dias` FROM `contactos` WHERE  $sql AND `asesor_comercial` = '$asesor' ORDER BY  `nombre_cliente` ASC ";
      }
      
      
      $result = $this->EjecutarComercial($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {

         $diasConfianza = 0 + $row->dias_confianza;
         $diasComuicacion = 0 + $row->dias_comunicacion;
         $diasCooperacion = 0 + $row->dias_cooperacion;

         

        /* if ($diasCooperacion != 0 ) {
            $diasCooperacion = $diasCooperacion ;
         }else{
            #$diasCooperacion = '-' ;
            $fecha_i = $row->cooperacion;
            $fecha_f = date('Y-m-d');
            if ($fecha_i != 0 ) {
               $diasCooperacion = $this->dias_transcurridos($fecha_i, $fecha_f) + 1;  
            }else{
               $diasCooperacion = '-';
            }
         }
         if ($diasComuicacion != 0 ) {
            $diasComuicacion = $diasComuicacion ;
         }else{
            $fecha_i = $row->comunicacion;
            $fecha_f = date('Y-m-d');
            if ($fecha_i != 0 ) {
               $diasComuicacion = $this->dias_transcurridos($fecha_i, $fecha_f) + 1;  
            }else{
               $diasComuicacion = '-';
            }
         }

         if ($diasConfianza != 0 ) {
            $diasConfianza = $diasConfianza ;
         }else{
            $fecha_i = $row->confianza;
            $fecha_f = date('Y-m-d');
            if ($fecha_i != 0 ) {
               $diasConfianza = $this->dias_transcurridos($fecha_i, $fecha_f) + 1;  
            }else{
               $diasConfianza = '-';
            }
         }*/

         

         $queryS="SELECT CONCAT(nombre_usu, ' ', apellido_usu) AS name FROM usuario WHERE admin = ".$row->asesor_comercial." ";

       $resultS = $this->EjecutarSoportel($queryS);
       $asesor_comercial = "";
       while ($ws = mysqli_fetch_object($resultS)) {
         # code...
         $asesor_comercial = utf8_decode($ws->name);
       }
         
         $date = $row->fecha_registro;
         $fecha = substr($date, 0, 10 ); 
         $post[]= array( 'id'=>$row->id, 'nombre_cliente'=>$row->nombre_cliente, 'tipo_cliente'=>$row->tipo_cliente, 'sector_economico'=>$row->sector_economico, 'servicio'=>$row->servicio, 'competencia'=>$row->competencia, 'asesor_comercial'=>$asesor_comercial, 'confianza'=>$diasConfianza, 'comunicacion'=>$diasComuicacion, 'cooperacion'=>$diasCooperacion, 'fechaFinal'=>$final,  'negocio_exitoso'=>$row->negocio_exitoso, 'monto'=>$row->monto,   'fecha_registro'=>$fecha  );
      }
      echo json_encode($post);
   }

   public function tiempoMedioDeCierre($request) {
      $fecha1 = $request->fecha1;
      $fecha2 = $request->fecha2;
      $vendedor = $request->vendedor; 
      
      if ($vendedor != '0' ) {
         $query = "SELECT ROUND( AVG(  `duracion_dias` ) , 1 ) AS dias,  `asesor_comercial` FROM  `contactos` WHERE  `negocio_exitoso` =  'SI' AND  `fecha_registro` >=  '$fecha1' AND  `fecha_registro` <= '$fecha2' AND  `asesor_comercial` =  '$vendedor'   ";
      }else{
         $query = "SELECT ROUND( AVG(  `duracion_dias` ) , 1 ) AS dias,  `asesor_comercial` FROM  `contactos` WHERE  `negocio_exitoso` =  'SI' AND  `fecha_registro` >=  '$fecha1' AND  `fecha_registro` <= '$fecha2'   ";

      }
      
      $result = $this->EjecutarComercial($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {

         $post[]= array(  'dias'=>$row->dias   );
      }
      echo json_encode($post);
   }

   public function selectTareas($request){
      $id = $request->id;
      $fase = $request->fase;
     
      $query="SELECT `fecha`,`hora`, `descripcion`, `actividad`, `resultado`, `id_usu`, `estado`, `archivo` FROM `tareas` WHERE `id_usu`='$id'    AND `estado`='$fase' ";
      $result = $this->EjecutarComercial($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'archivo'=>$row->archivo,'fecha'=>$row->fecha,'hora'=>$row->hora, 'descripcion'=>$row->descripcion, 'actividad'=>$row->actividad, 'resultado'=>$row->resultado, 'id_usu'=>$row->id_usu, 'estado'=>$row->estado );
      }
      echo json_encode($post);
   }

   public function verInformacionContactos($request) {
      $variable = $request->variable;
      $id = $request->id;
      if ($variable == 1 ) {
         $query="SELECT `fecha`,`hora`, `descripcion`, `actividad`, `resultado`, `id_usu`, `estado`,archivo FROM `tareas` WHERE `id_usu`='$id' ";
         $result = $this->EjecutarComercial($query);
         $post = array();
         
         while ($row = mysqli_fetch_object($result)) {
            $post[]= array('archivo'=>$row->archivo, 'fecha'=>$row->fecha,'hora'=>$row->hora, 'descripcion'=>$row->descripcion, 'actividad'=>$row->actividad, 'resultado'=>$row->resultado, 'id_usu'=>$row->id_usu, 'estado'=>$row->estado );
         }
         echo json_encode($post);
      }else{
         $query="SELECT `id`, `nombre_cliente`, `tipo_cliente`, `sector_economico`, `servicio`, `competencia`, `asesor_comercial`, `negocio_exitoso`, `monto`, `fecha_registro`, `confianza`, `comunicacion`, `cooperacion`, `fecha_final`, `dias_confianza`, `dias_comunicacion`, `dias_cooperacion`, `duracion_dias` FROM `contactos` WHERE  `id` =  '$id'      ";
         $result = $this->EjecutarComercial($query);
         $post = array();
         
         while ($row = mysqli_fetch_object($result)) {
            $date = $row->fecha_registro;
            $fecha = substr($date, 0, 10 ); 

            $date0 = $row->confianza;
            $confianza = substr($date0, 0, 10 ); 

            $date1 = $row->comunicacion;
            $comunicacion = substr($date1, 0, 10 ); 

            $date2 = $row->cooperacion;
            $cooperacion = substr($date2, 0, 10 ); 

            $date3 = $row->fecha_final;
            $ffinal = substr($date3, 0, 10 ); 
            if ($ffinal != 0 ) {
               $tdias = $row->duracion_dias;
            }else{
               $fecha_i = $confianza;
               $fecha_f = date('Y-m-d');
               $tdias = $this->dias_transcurridos($fecha_i, $fecha_f);               
            }

              $queryS="SELECT CONCAT(nombre_usu, ' ', apellido_usu) AS name FROM usuario WHERE admin = ".$row->asesor_comercial." ";

          $resultS = $this->EjecutarSoportel($queryS);
          $asesor_comercial = "";
          while ($ws = mysqli_fetch_object($resultS)) {
            # code...
            $asesor_comercial = $ws->name;
          }
            $post[]= array( 'id'=>$row->id, 'nombre_cliente'=>$row->nombre_cliente, 'tipo_cliente'=>$row->tipo_cliente, 'sector_economico'=>$row->sector_economico, 'servicio'=>$row->servicio, 'competencia'=>$row->competencia, 'asesor_comercial'=>$row->asesor_comercial, 'negocio_exitoso'=>$row->negocio_exitoso, 'monto'=>$row->monto, 'fecha_registro'=>$fecha, 'confianza'=>$confianza, 'comunicacion'=>$comunicacion, 'cooperacion'=>$cooperacion, 'diasConfianza'=>$row->dias_confianza, 'diasComuicacion'=>$row->dias_comunicacion, 'diasCooperacion'=>$row->dias_cooperacion, 'totalDias'=>$tdias, 'fecha_final'=>$ffinal  );
         }
         echo json_encode($post);
      }
     
         
   }

   public function detalleGestion($request) {
      $id = $request->id;
     
      $query="SELECT  `id` ,  `nombre_cliente` ,  `tipo_cliente` ,  `sector_economico` ,  `servicio` ,  `subservicio` , `cosas_positivas` , `dudas` ,  `competencia` ,  `asesor_comercial` , `negocio_exitoso` ,  `monto` ,  `fecha_registro` ,  `confianza` ,  `comunicacion` ,  `cooperacion`, `fecha_final` FROM  `contactos` WHERE  `id` =  '$id'      ";
      $result = $this->EjecutarComercial($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $date = $row->fecha_registro;
         $fecha = substr($date, 0, 10 ); 

         $date1 = $row->comunicacion;
         $comunicacion = substr($date1, 0, 10 ); 

         $date2 = $row->cooperacion;
         $cooperacion = substr($date2, 0, 10 ); 

         /*$queryS="SELECT CONCAT(nombre_usu, ' ', apellido_usu) AS name FROM usuario WHERE admin = ".$row->asesor_comercial." ";
       $resultS = $this->EjecutarSoportel($queryS);
       $asesor_comercial = "";
       while ($ws = mysqli_fetch_object($resultS)) {
         # code...
         $asesor_comercial = $ws->name;
       }*/

         $post[]= array( 'id'=>$row->id, 'nombre_cliente'=>$row->nombre_cliente, 'tipo_cliente'=>$row->tipo_cliente, 'sector_economico'=>$row->sector_economico, 'servicio'=>$row->servicio,'subservicio'=>$row->subservicio, 'cosas_positivas'=>$row->cosas_positivas,'dudas'=>$row->dudas, 'competencia'=>$row->competencia, 'asesor_comercial'=>$row->asesor_comercial, 'negocio_exitoso'=>$row->negocio_exitoso, 'monto'=>$row->monto, 'fecha_registro'=>$fecha, 'confianza'=>$row->confianza, 'comunicacion'=>$comunicacion, 'cooperacion'=>$cooperacion  );
      }
      echo json_encode($post);
   }

   public function updateGestion($request) {
      $id = $request->id;
      $id_val = $request->id_val;
      $nombre = $request->nombre;
      $tipo_c = $request->tipo_c;
      $sector_e = $request->sector_e;
       $json = json_encode($request->servicio);
     //var_dump(json_decode($json));
      $array = json_decode($json, true);
      $servicio = "";
      $lo=false;
      for($p=0;$p <count($array);$p++){
         $array[$p]['servicio'];
         if($array[$p]['servicio'] == true){
            if($p!=0 && $lo==true){
               $servicio.=",";
            }
            $servicio.=$array[$p]['tipo_ser'];
            $lo=true;
         }
      }
      $json = json_encode($request->subservicio);
     //var_dump(json_decode($json));
      $array = json_decode($json, true);
      $subservicio = "";
      $lo=false;
      for($p=0;$p <count($array);$p++){
         $array[$p]['subservicio'];
         if($array[$p]['subservicio'] == true){
            if($p!=0 && $lo==true){
               $subservicio.=",";
            }
            $subservicio.=$array[$p]['tipo_subservicio'];
            $lo=true;
         }
      }
      $competencia = $request->competencia;
      $asesor = $request->asesor;
      $fase = $request->fase;
      $monto = 0 + $request->monto;
      $negocio = $request->negocio;

      $fechaTarea = $request->fechaTarea;
      $horaTarea = $request->horaTarea;
      $descripcionTarea = $request->descripcionTarea;
      $actividadTarea = $request->actividadTarea;
      $resultadoTarea = $request->resultadoTarea;
      $cosas_positivas = $request->cosas_positivas;
      $dudas = $request->dudas;

      $dateFecha = date('Y-m-d H:i:s');
      $cod = 1;
      // validamos los campos de tareas traen texto y lo insertamos en la DB
      if ( $actividadTarea != '0' && $resultadoTarea != '0' ) {
         $cod = time();
         $query1 ="INSERT INTO `comercial`.`tareas` (`id`,`fecha`,`hora`, `descripcion`, `actividad`, `resultado`, `id_usu`, `estado`) VALUES ('$cod','$fechaTarea','$horaTarea', '$descripcionTarea', '$actividadTarea', '$resultadoTarea', '$id', '$fase')";
         $result = $this->EjecutarComercial($query1);
         
      }
      // validamos si el valor de la fase es igual a la fase actual
      if ($id_val == $fase ) {
         if ($fase == 'Comunicacion' ) {
            $query = " UPDATE `contactos` SET `nombre_cliente`='$nombre',`tipo_cliente`='$tipo_c',`sector_economico`='$sector_e',`servicio`='$servicio',`subservicio`='$subservicio',`cosas_positivas`='$cosas_positivas',`dudas`='$dudas',`competencia`='$competencia',`asesor_comercial`='$asesor' WHERE `id` = '$id' ";
         }else{
            if ($fase == 'Cooperacion' ) {
              // if ($monto > 0 ) {
                  $query = " UPDATE `contactos` SET `nombre_cliente`='$nombre',`tipo_cliente`='$tipo_c',`sector_economico`='$sector_e',`servicio`='$servicio',`subservicio`='$subservicio', `cosas_positivas`='$cosas_positivas',`dudas`='$dudas', `negocio_exitoso`='$negocio',`monto`='$monto',  `competencia`='$competencia',`asesor_comercial`='$asesor', `fecha_final`='$dateFecha' WHERE `id` = '$id' ";
             /*  }else{
                  $query = " UPDATE `contactos` SET `nombre_cliente`='$nombre',`tipo_cliente`='$tipo_c',`sector_economico`='$sector_e',`servicio`='$servicio',`competencia`='$competencia',`asesor_comercial`='$asesor' WHERE `id` = '$id' ";
               }*/
            }else{
               $query = " UPDATE `contactos` SET `nombre_cliente`='$nombre',`tipo_cliente`='$tipo_c',`sector_economico`='$sector_e',`servicio`='$servicio',`subservicio`='$subservicio',`cosas_positivas`='$cosas_positivas',`dudas`='$dudas',`competencia`='$competencia',`asesor_comercial`='$asesor' WHERE `id` = '$id' ";
            }
         }
      }else{
         if ($fase == 'Comunicacion' ) {
            $query = " UPDATE `contactos` SET `nombre_cliente`='$nombre',`tipo_cliente`='$tipo_c',`sector_economico`='$sector_e',`servicio`='$servicio',`subservicio`='$subservicio',`cosas_positivas`='$cosas_positivas',`dudas`='$dudas',`competencia`='$competencia',`asesor_comercial`='$asesor', `comunicacion`='$dateFecha' WHERE `id` = '$id' ";
         }else{
            if ($fase == 'Cooperacion' ) {
               if ($monto > 0 ) {
                  $query = " UPDATE `contactos` SET `nombre_cliente`='$nombre',`tipo_cliente`='$tipo_c',`sector_economico`='$sector_e',`servicio`='$servicio',`subservicio`='$subservicio', `cosas_positivas`='$cosas_positivas',`dudas`='$dudas', `negocio_exitoso`='$negocio',`monto`='$monto',  `competencia`='$competencia',`asesor_comercial`='$asesor', `fecha_final` = '$dateFecha' WHERE `id` = '$id' ";
               }else{
                  $query = " UPDATE `contactos` SET `nombre_cliente`='$nombre',`tipo_cliente`='$tipo_c',`sector_economico`='$sector_e',`servicio`='$servicio',`subservicio`='$subservicio',`cosas_positivas`='$cosas_positivas',`dudas`='$dudas', `competencia`='$competencia',`asesor_comercial`='$asesor', `cooperacion`='$dateFecha' WHERE `id` = '$id' ";
               }
            }else{
               $query = " UPDATE `contactos` SET `nombre_cliente`='$nombre',`tipo_cliente`='$tipo_c',`sector_economico`='$sector_e',`servicio`='$servicio',`subservicio`='$subservicio',`cosas_positivas`='$cosas_positivas',`dudas`='$dudas', `competencia`='$competencia',`asesor_comercial`='$asesor' WHERE `id` = '$id' ";
            }
         }
      }
      $result = $this->EjecutarComercial($query);
      if($result){
         echo $cod;
      }else{
         echo false;
      }
   }
   public function deleteGestion($request) {
      $id=$request->id;
      $query="DELETE FROM `contactos` WHERE `id` = '$id'   ";
      
      $result = $this->EjecutarComercial($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }
   public function insertGestion($request) {
      $nombre = $request->nombre;
      $tipo_c = $request->tipo_c;
      $sector_e = $request->sector_e;
     
      $competencia = $request->competencia;
      $asesor = $request->asesor;
      $fase = $request->fase;

      $fecha = $request->fecha;
      $date = date('H:i:s');
      $dateFecha = $fecha . ' '.$date;
      $json = json_encode($request->servicio);
     //var_dump(json_decode($json));
      $array = json_decode($json, true);
      $servicio = "";
      for($p=0;$p <count($array);$p++){
         $array[$p]['servicio'];
         if($array[$p]['servicio'] == true){
            if($p!=0){
               $servicio.=",";
            }
            $servicio.=$array[$p]['tipo_ser'];
         }
      }
      $json = json_encode($request->subservicio);
     //var_dump(json_decode($json));
      $array = json_decode($json, true);
      $subservicio = "";
      for($p=0;$p <count($array);$p++){
         $array[$p]['subservicio'];
         if($array[$p]['subservicio'] == true){
            if($p!=0){
               $subservicio.=",";
            }
            $subservicio.=$array[$p]['tipo_subser'];
         }
      }

     $query="INSERT INTO `comercial`.`contactos` (`id`, `nombre_cliente`, `tipo_cliente`, `sector_economico`, `servicio`, `subservicio`, `cosas_positivas`,`dudas`, `competencia`, `asesor_comercial`, `negocio_exitoso`, `monto`, `fecha_registro`, `confianza`, `comunicacion`, `cooperacion`, `fecha_final`) VALUES (NULL, '$nombre', '$tipo_c', '$sector_e', '$servicio',  '$subservicio', '', '', '$competencia', '$asesor', 'EN PROCESO', NULL, '$dateFecha', '$dateFecha', NULL, NULL, NULL)   ";
      $result=false;
     $result = $this->EjecutarComercial($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }
  public function UpdateArchivoTarea($cod,$name) {
      $query = "UPDATE tareas SET archivo = '$name' WHERE id = '$cod' ";
     $result = $this->EjecutarComercial($query);
      if($result){
         echo true;
      }else{
         echo false;
      } 
   }

   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   /////                                               ////
   /////           SERVICIO NUBE BANCO DATOS           ////
   /////                                               ////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////

   public function selectConRetenRespaldo($request) {
      $query = "SELECT SUM(  `gres_capacidad` ) AS capacidad, SUM(  `area_retencion` ) AS retencion,  `id_us` FROM  `grupo_respaldo` GROUP BY  `id_us` ";
      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'capacidad'=>utf8_encode($row->capacidad), 'retencion'=>utf8_encode($row->retencion), 'id_us'=>utf8_encode($row->id_us ));
      }
      echo json_encode($post);
   }
   public function consRetenUsuarios($request) {
      $cod = $request->cod;
      $consumido = $request->consumido;
      $retencion = $request->retencion;
      $query = "UPDATE `usuarios` SET `consumido`='$consumido',`area_retencion`='$retencion' WHERE `us_id` =  '$cod'  ";
      $result = $this->EjecutarServiNube($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }
   public function selectConRetenUsuarios($request) {
      $query = "SELECT SUM(  `us_cuota` ) AS cosumido,  `id_cli` FROM  `usuarios` GROUP BY  `id_cli`  ";
      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'cosumido'=>$row->cosumido, 'id_cli'=>$row->id_cli );
      }
      echo json_encode($post);
   }
   public function consRetenClientes($request) {
      $cod = $request->cod;
      $consumido = $request->consumido;
      $query = "UPDATE `cliente` SET `clic_consumido`='$consumido' WHERE `cli_id` =  '$cod'  ";
      $result = $this->EjecutarServiNube($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }

   //validaciones
   public function select_EspacioDispUsuarios($request) {
      $cod = $request->cod;
      $query="SELECT  `us_nombre` ,  `us_cuota` ,  `consumido` ,  `area_retencion` FROM  `usuarios` WHERE  `us_id`='$cod' ";
      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($r = mysqli_fetch_object($result)) {
         $us_id = $r->us_id;
         $us_nombre = $r->us_nombre;
         $us_cuota = $r->us_cuota;
         $consumido = $r->consumido;
         $area_retencion = $r->area_retencion;
         $totaUsado = $consumido + $area_retencion;
         $disponible = $us_cuota - $totaUsado; 
         
         $post[]= array( 'us_nombre'=>$us_nombre,  'totaUsado'=>$totaUsado, 'disponible'=>$disponible );
      }
      echo json_encode($post);
   }
   public function select_EspacioDispClientes($request) {
      $cod = $request->cod;
      $query="SELECT  `cli_nombre` ,  `cli_capacidad` ,  `clic_consumido` FROM  `cliente` WHERE  `cli_id` ='$cod' ";
      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($r = mysqli_fetch_object($result)) {
         $us_nombre = $r->us_nombre;

         $consumido = $r->clic_consumido;
         $capacidad = $r->cli_capacidad;

         $disponible = $capacidad - $consumido; 
         
         $post[]= array( 'us_nombre'=>$us_nombre,  'totaUsado'=>$consumido, 'disponible'=>$disponible );
      }
      echo json_encode($post);
   }

   public function selectLicenciaNube($request) {
      $query = "SELECT  `lic_id` ,  `lic_fecha_caducidad` ,  `lic_fecha_ultimo_pago` ,  `lic_valor_pagado` FROM  `licencia` ORDER BY  `lic_id` DESC  LIMIT 1 ";
      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $fecha1 = $row->lic_fecha_caducidad;
         $fecha2 = $row->lic_fecha_ultimo_pago;


         $fechaC = substr($fecha1, 0, 10 ); 
         $fechaU = substr($fecha2, 0, 10 ); 
         $hoy = date('Y-m-d');
         if ($fechaC < $hoy ) {
            $var = 1;
         }else{
            $var = 2;
         }

         $post[]= array( 'var'=>$var, 'lic_id'=>$row->lic_id, 'fechaCa'=>$fechaC, 'fechaUl'=>$fechaU, 'monto'=>$row->lic_valor_pagado );
      }
      echo json_encode($post);
   }
   public function selectLicenciaDetalle($request) {
      $cod = $request->cod;
      $query = "SELECT  `lic_id` ,  `lic_fecha_caducidad` ,  `lic_fecha_ultimo_pago` ,  `lic_valor_pagado` FROM  `licencia` WHERE lic_id = '$cod' ";
      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $fecha1 = $row->lic_fecha_caducidad;
         $fecha2 = $row->lic_fecha_ultimo_pago;


         $fechaC = substr($fecha1, 0, 10 ); 
         $fechaU = substr($fecha2, 0, 10 ); 
         $post[]= array( 'lic_id'=>$row->lic_id, 'fechaCa'=>$fechaC, 'fechaUl'=>$fechaU, 'monto'=>$row->lic_valor_pagado );
      }
      echo json_encode($post);
   }
   public function updateLicenciaNube($request) {

      $fechaCaducidad = $request->fechaCaducidad;
      $montoLicencia = $request->montoLicencia;
      $ultimoPago = $request->ultimoPago;
      $ultimoPago = $ultimoPago . ' ' .date('H:i:s');

      $query="INSERT INTO  `servicio_nube`.`licencia` ( `lic_id` , `lic_fecha_caducidad` , `lic_fecha_ultimo_pago` , `lic_valor_pagado` ) VALUES ( NULL ,  '$fechaCaducidad',  '$ultimoPago',  '$montoLicencia' )  ";
      $result = $this->EjecutarServiNube($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }

   public function selectServiciosNube($request) {
      
      // query de seleccion contable de cuantos servicios de repaldo posee cada usuario
      $query=" SELECT `cli_id`, `cli_nombre`, `cli_capacidad`, `clic_consumido` FROM `cliente`  ORDER BY cli_nombre ASC ";         
      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $cod = $row->cli_id;

         $query1=" SELECT SUM(  `consumido` +  `area_retencion` ) as espacio FROM  `usuarios` WHERE  `id_cli` = '$cod' ";         
         $result1 = $this->EjecutarServiNube($query1);
         while ($r = mysqli_fetch_object($result1)) {
            $espC = $r->espacio ;
         }

         $post[]= array( 'consuUsuarios'=>$espC, 'cli_id'=>$row->cli_id, 'cli_nombre'=>$row->cli_nombre, 'cli_capacidad'=>$row->cli_capacidad, 'consumido'=>$row->clic_consumido );
      }
      echo json_encode($post);
   }
   public function selecClientesNube($request) {
      $cod = $request->cod;
      $query=" SELECT `cli_id`, `cli_nombre`, `cli_capacidad` FROM `cliente` WHERE `cli_id`= '$cod' ";         
      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'cli_id'=>$row->cli_id, 'cli_nombre'=>$row->cli_nombre, 'cli_capacidad'=>$row->cli_capacidad );
      }
      echo json_encode($post);
   }
   public function updateClienteNube($request) {
      $id = $request->idclic;
      $nombrecli = $request->nombrecli;
      $capacidadcli = $request->capacidadcli;

      $query=" UPDATE `cliente` SET `cli_nombre`='$nombrecli', `cli_capacidad`='$capacidadcli' WHERE `cli_id`='$id' ";
      $result = $this->EjecutarServiNube($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }
   public function deleteClienteNube($request) {
      $id=$request->cod;
      $query="DELETE FROM `cliente` WHERE `cli_id` = '$id'   ";
      
      $result = $this->EjecutarServiNube($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }
   public function insertClienteNube($request) {
      $nombreCli = $request->nombreCli;
      $capacidadcli = $request->capacidadCli;

      $query="INSERT INTO `servicio_nube`.`cliente` (`cli_id`, `cli_nombre`, `cli_capacidad`, `clic_consumido`) VALUES (NULL, '$nombreCli', '$capacidadcli', '0') ";
      
      $result = $this->EjecutarServiNube($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }

   public function selecUsuariosClienteNube($request) {
      $cod = $request->cod;
      $query="SELECT us_id, us_nombre, us_cuota, `consumido`, `area_retencion`, `cli_nombre`  FROM `usuarios`, cliente WHERE  `id_cli` = '$cod' AND  `cli_id` =  `id_cli`  ";
      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($r = mysqli_fetch_object($result)) {
         $id = $r->us_id;
         $nombre = $r->us_nombre;
         $cuota = $r->us_cuota;
         $consumido = $r->consumido;
         $retencion = $r->area_retencion;
         $t_utilizado = $consumido + $retencion;
         
         $post[]= array( 'cod'=>$id, 'nombreUsuario'=>$nombre, 'cuotaUsuario'=>$cuota, 'consumido'=>$consumido, 'retencion'=>$retencion, 'totalUtilizado'=>$t_utilizado, 'nomCliente'=>$r->cli_nombre );
      }
      echo json_encode($post);
   }
   public function insertUsuarioNube($request) {
      $id_cli = $request->id_cli;
      $nombreUs = $request->nombreUs;
      $cuotaUs = $request->cuotaUs;

      $query="INSERT INTO `servicio_nube`.`usuarios` (`us_id`, `us_nombre`, `us_cuota`, `consumido`, `area_retencion`, `id_cli`) VALUES (NULL, '$nombreUs', '$cuotaUs', '0', '0', '$id_cli'); ";
      
      $result = $this->EjecutarServiNube($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }
   public function selectUsuariosNube($request) {
      $query="SELECT us_id, us_nombre, us_cuota, `consumido`, `area_retencion` FROM  `usuarios` ";
      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($r = mysqli_fetch_object($result)) {
         $id = $r->us_id;
         $nombre = utf8_encode($r->us_nombre);
         $cuota = $r->us_cuota;
         $consumido = $r->consumido;
         $retencion = $r->area_retencion;
         $t_utilizado = $consumido + $retencion;
         
         $post[]= array( 'cod'=>$id, 'nombreUsuario'=>$nombre, 'cuotaUsuario'=>$cuota, 'consumido'=>$consumido, 'retencion'=>$retencion, 'totalUtilizado'=>$t_utilizado );
      }
      echo json_encode($post);
   }
   public function detalleGrRespaldo($request) {
      $cod = $request->cod;

      $query ="SELECT  `gres_id` , usuarios.`us_nombre` as n , cliente.`cli_nombre` AS n1,  `gres_nombre` ,  `gres_capacidad` , grupo_respaldo.`area_retencion` FROM  `grupo_respaldo` , usuarios, cliente WHERE  `id_us` =  `us_id` AND  usuarios.id_cli = cliente.cli_id AND `id_us` = '$cod'  " ;

      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($r = mysqli_fetch_object($result)) {
         $idGR = $r->gres_id;
         $nom_usu = $r->n;
         $nom_cliente = $r->n1;
         $nombreGR = $r->gres_nombre;
         $capacidaGR = $r->gres_capacidad;
         $retencionGR = $r->area_retencion;
         
         $post[]= array( 'gres_id'=>$idGR, 'nomUsu'=>$nom_usu, 'nomCliente'=>$nom_cliente, 'nombreGR'=>$nombreGR, 'capacidaGR'=>$capacidaGR, 'retencionGR'=>$retencionGR );
      }
      echo json_encode($post);
   }
   public function respaldoDetalle($request) {
      $cod = $request->gres_id;
      $query="SELECT gres_id,`gres_nombre`, `gres_capacidad`, `area_retencion`, id_us FROM `grupo_respaldo` WHERE `gres_id`='$cod' ";
      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($r = mysqli_fetch_object($result)) {
         $idGR = $r->gres_id;
         $nombreGR = $r->gres_nombre;
         $capacidaGR = $r->gres_capacidad;
         $retencionGR = $r->area_retencion;
         
         $post[]= array( 'gres_id'=>$idGR, 'nombreGR'=>$nombreGR, 'capacidaGR'=>$capacidaGR, 'retencionGR'=>$retencionGR, 'idU'=>$r->id_us );
      }
      echo json_encode($post);
   }
   public function updateRetencionNube($request) {
      $id = $request->idU;
      $nombre = $request->nombreR;
      $capacidadR = $request->capacidadR;
      $retencionR = $request->retencionR;

      $query="  UPDATE `grupo_respaldo` SET `gres_nombre`='$nombre', `gres_capacidad`='$capacidadR', `area_retencion`='$retencionR' WHERE `gres_id`='$id'
      ";
      $result = $this->EjecutarServiNube($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }
   public function deleteRespaldo($request) {
      $id=$request->cod;
      $query="DELETE FROM `grupo_respaldo` WHERE `gres_id`= '$id'   ";
      
      $result = $this->EjecutarServiNube($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }
   public function detalleUsuarioNube($request) {
      $cod = $request->cod;
      $query="SELECT `us_id`, `us_nombre`, `us_cuota`, `id_cli` FROM `usuarios` WHERE `us_id`='$cod' ";
      $result = $this->EjecutarServiNube($query);
      $post = array();
      
      while ($r = mysqli_fetch_object($result)) {
         $us_id = $r->us_id;
         $us_nombre = $r->us_nombre;
         $us_cuota = $r->us_cuota;
         $id_cli = $r->id_cli;
         
         $post[]= array( 'us_id'=>$us_id, 'us_nombre'=>$us_nombre, 'us_cuota'=>$us_cuota, 'id_cli'=>$id_cli );
      }
      echo json_encode($post);
   }
   public function updateUsuarioNube($request) {
      $id = $request->idU;
      $nombre = $request->nombreU;
      $cuota = $request->cuotaU;

      $query="  UPDATE `usuarios` SET `us_nombre`='$nombre',`us_cuota`='$cuota' WHERE `us_id`='$id'
      ";
      $result = $this->EjecutarServiNube($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }
   public function deleteUsuarioNube($request) {
      $id=$request->cod;
      $query="DELETE FROM `usuarios` WHERE `us_id`= '$id'   ";
      
      $result = $this->EjecutarServiNube($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }
   }
   public function insertRepaldoNube($request) {
      $id_us = $request->id_us;
      $nombreRe = $request->nombreRe;
      $capacidadRe = $request->capacidadRe;
      $retencionRe = $request->retencionRe;

      $query="INSERT INTO  `grupo_respaldo` (`gres_id` ,`gres_nombre` ,`gres_capacidad` ,`area_retencion` ,`id_us` ) VALUES (NULL ,  '$nombreRe',  '$capacidadRe',  '$retencionRe',  '$id_us' ) ";
      
      $result = $this->EjecutarServiNube($query);
      if($result){
         echo TRUE;
      }else{
         echo false;
      }  
   }
   
   ////////////////////////////////////////////////////////
   /////                SERVICIO NUBE                  ////
   ////////////////////////////////////////////////////////
   public function totalUsuarios($request) {
      $query="SELECT COUNT(  `us_id` ) AS totalUser FROM  `usuarios`";
      if ($request->variable == 1) {
         $query="SELECT COUNT(  `us_id` ) AS Tuser,  `cli_nombre` FROM  `usuarios` ,  `cliente` WHERE  `cli_id` = id_cli GROUP BY  `id_cli` ";
      }
      $post = array();
      $result = $this->EjecutarServiNube($query);
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'totalUser'=>$row->totalUser, 'tuser'=>$row->Tuser, 'nombre'=>$row->cli_nombre  );
      }
      echo json_encode($post);
   }
   public function totalEspacio($request) {
      $query="SELECT SUM(  `cli_capacidad` ) AS capacidad, SUM(  `clic_consumido` ) AS consumido FROM  `cliente` ";
      
      if ($request->variable == 1) {
         $query="SELECT  `cli_nombre` ,  `cli_capacidad` ,  `clic_consumido` FROM  `cliente`  ";
      }

      $post = array();
      $result = $this->EjecutarServiNube($query);
      
      while ($row = mysqli_fetch_object($result)) {
         $post[]= array( 'capacidad'=> 0 + $row->capacidad, 'consumido'=> 0 + $row->consumido, 'cli_nombre'=>$row->cli_nombre, 'cli_capacidad'=> 0 + $row->cli_capacidad, 'clic_consumido'=> 0 + $row->clic_consumido );
      }
      echo json_encode($post);
   }

     ////////////////////////////////////////////////////////
   /////                CONTABLE             ////
   ////////////////////////////////////////////////////////

   public function Caja($request) {
      $query1="
      select iif (sum(dm.valortra) is null,0,sum(dm.valortra)) caja_debito
      from plancuentas p
      inner join demovi dm on dm.pucid=p.pucid and dm.tipocd='D'
      where p.codigo like '110505%'
     ";
      $debito = 0;
      $result = $this->EjecutarContableibase($query1);
      if( ibase_num_fields($result) > 0){
         while ($ro = ibase_fetch_object($result)) {
            $debito =  $ro->CAJA_DEBITO;
         }
      }else{
         $debito=  0 ;
      }

      $query="
         select iif (sum(dm.valortra) is null,0,sum(dm.valortra)) caja_credito
         from plancuentas p
         inner join demovi dm on dm.pucid=p.pucid and dm.tipocd='C'
         where p.codigo like '110505%'
      ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
         while ($ro = ibase_fetch_object($result)) {
            $credito =  $ro->CAJA_CREDITO;
            $caja = $credito - $debito;
            $post[]= array( 'caja' => $caja  );
         }
      }else{
         $post[]= array( 'caja' => 0  );
      }
      echo json_encode($post);
   }

   public function Bancos($request) {
      $query1="
      select iif (sum(dm.valortra) is null,0,sum(dm.valortra)) banco_debito
      from plancuentas p
      inner join demovi dm on dm.pucid=p.pucid and dm.tipocd='D'
      where (p.codigo like '1110%') or (p.codigo like '1120%')
     ";
      $debito = 0;
      $result = $this->EjecutarContableibase($query1);
      if( ibase_num_fields($result) > 0){
         while ($ro = ibase_fetch_object($result)) {
            $debito =  $ro->BANCO_DEBITO;
         }
      }else{
         $debito=  0 ;
      }

      $query="
         select iif (sum(dm.valortra) is null,0,sum(dm.valortra)) banco_credito
         from plancuentas p
         inner join demovi dm on dm.pucid=p.pucid and dm.tipocd='C'
         where (p.codigo like '1110%') or (p.codigo like '1120%')
      ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
         while ($ro = ibase_fetch_object($result)) {
            $credito =  $ro->BANCO_CREDITO;
            $bancos = $credito - $debito;
            $post[]= array( 'bancos' => $bancos  );
         }
      }else{
         $post[]= array( 'bancos' => 0  );
      }
      echo json_encode($post);
   }
   public function facturas($request) {
      $mes=date('m');
      $query="
      select sum(dm.valortra) facturas
      from movi m
      inner join demovi dm on dm.movid=m.movid
      inner join plancuentas p on p.pucid=dm.pucid
      where (p.codigo like '4%' or p.codigo like '240801%')
      and m.periodo=lpad(extract(month from cast('Now' as timestamp)),2,'0')
      and dm.tipocd='C'
      ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
        while ($ro = ibase_fetch_object($result)) {
            # code...
            $post[]= array( 'facturas' => $ro->FACTURAS  );
         }
      }else{
          $post[]= array( 'facturas' => 0  );
      }
      echo json_encode($post);
   }
   public function cateraCorriente($request) {
      $query="

      select sum(saldo) ccorriente
      from documento
      where (cast('Now'  as timestamp)-iif(fecultpago is null,fecvence,fecultpago))<91
      and TIPOIE='I'
      and saldo>0

      ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
        while ($ro = ibase_fetch_object($result)) {
            # code...
            $post[]= array( 'cateraCorriente' => $ro->CCORRIENTE  );
         }
      }else{
          $post[]= array( 'cateraCorriente' => 0  );
      }
      echo json_encode($post);
   }
   public function cartaDificilCobro($request) {
      $query="
         select codcomp,sum(saldo) ccdificil
         from documento
         where (cast('Now'  as timestamp)-fecvence)>91
         and saldo>0 and fecasent is not null
         group by 1
      ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
        while ($ro = ibase_fetch_object($result)) {
            $post[]= array( 'cartaDificilCobro' => $ro->CCDIFICIL  );
         }
      }else{
          $post[]= array( 'cartaDificilCobro' => 0  );
      }
      echo json_encode($post);
   }
   public function bancoDifDebitoCredito($request) {
      $query="
      select (iif (sum(dm.valortra) is null,0,sum(dm.valortra))-iif(sum(dm1.valortra)is null,0,sum(dm1.valortra))) bancos_pasivos
      from plancuentas p
      left join demovi dm on dm.pucid=p.pucid and dm.tipocd='D'
      left join demovi dm1 on dm1.pucid=p.pucid and dm1.tipocd='C'
      where (p.codigo like '2105%')


      ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
        while ($ro = ibase_fetch_object($result)) {
            $post[]= array( 'bancoDifDebitoCredito' => $ro->BANCOS_PASIVOS  );
         }
      }else{
          $post[]= array( 'bancoDifDebitoCredito' => 0  );
      }
      echo json_encode($post);
   }
   public function proveedores($request) {
      $query1="

      select iif (sum(dm.valortra) is null,0,sum(dm.valortra)) provdebito
      from plancuentas p
      inner join demovi dm on dm.pucid=p.pucid and dm.tipocd='D'
      where p.codigo like '220501%'

       ";
      $postDebito = 0;
      $result1 = $this->EjecutarContableibase($query1);
      if( ibase_num_fields($result1) > 0){
        while ($ro = ibase_fetch_object($result1)) {
            $postDebito= $ro->PROVDEBITO  ;
         }
      }else{
         $postDebito= 0 ;
      }

      $query="

      select iif (sum(dm.valortra) is null,0,sum(dm.valortra)) provcredito
      from plancuentas p
      inner join demovi dm on dm.pucid=p.pucid and dm.tipocd='C'
      where p.codigo like '220501%'

       ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
        while ($ro = ibase_fetch_object($result)) {
          $r = $postDebito - ($ro->PROVCREDITO);
            $post[]= array( 'proveedor' => $r );
         }
      }else{
         $post[]= array( 'proveedor' => 0  );
      }
      echo json_encode($post);
   }
   public function impuestosRetefuente($request) {
      $query1="

      select sum(iif(dm.valortra is null,0,dm.valortra)) retfrcr
      from plancuentas p
      inner join demovi dm on dm.pucid=p.pucid and dm.tipocd='C'
      where (p.codigo like '2365%')

     ";
      $pCredito = 0;
      $result = $this->EjecutarContableibase($query1);
      if( ibase_num_fields($result) > 0){
        while ($ro = ibase_fetch_object($result)) {
            $pCredito=  $ro->RETFRCR  ;
         }
      }else{
          $pCredito=  0 ;
      }

      $query="
         select sum(iif(dm.valortra is null,0,dm.valortra)) retfrdb
         from plancuentas p
         inner join demovi dm on dm.pucid=p.pucid and dm.tipocd='D'
         where (p.codigo like '2365%') 
      ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
        while ($ro = ibase_fetch_object($result)) {
            $rt = ( $ro->RETFRDB ) - $pCredito;
            $post[]= array( 'impuestos' => $rt );
         }
      }else{
          $post[]= array( 'impuestos' => 0 - $post1);
      }
      echo json_encode($post);
   }
   public function impuestosMinTic($request) {
      
      $fecha = date('m')  ;

      if ( $fecha <= 4 ) { // primer trimestre
         $meI = 1;
         $meF = 4;
      }else{
         if( $fecha <= 8 ){ // segundo trimestre
            $meI = 5;
            $meF = 8;
         }else{ // tercer trimestre
            $meI = 9;
            $meF = 12;
         }
       }

      $query="

      select iif (sum(dm.valortra) is null,0,sum(dm.valortra)) ministerio
      from movi m
      inner join demovi dm on dm.movid=m.movid
      inner join plancuentas p on p.pucid=dm.pucid
      where (p.codigo = '524015.01') and m.periodo between '$meI' and '$meF'  

        ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
        while ($ro = ibase_fetch_object($result)) {
            # code...
            $post[]= array( 'impuestos' => $ro->MINISTERIO  );
         }
      }else{
          $post[]= array( 'impuestos' => 0  );
      }
      echo json_encode($post);
   }
   public function impuestosIva($request) {
       $query="

select (iif (sum(dm.valortra) is null,0,sum(dm.valortra))-iif(sum(dm1.valortra)is null,0,sum(dm1.valortra))) iva
from plancuentas p
left join demovi dm on dm.pucid=p.pucid and dm.tipocd='D'
left join demovi dm1 on dm1.pucid=p.pucid and dm1.tipocd='C'
where (p.codigo like '2408%')

  ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
        while ($ro = ibase_fetch_object($result)) {
            # code...
            $post[]= array( 'impuestos' => $ro->IVA  );
         }
      }else{
          $post[]= array( 'impuestos' => 0  );
      }
      echo json_encode($post);
   }

   public function impuestosCree($request) {
      $query="

      select (sum(dm.valortra)*(0.008)) cree
      from movi m
      inner join demovi dm on dm.movid=m.movid
      inner join plancuentas p on p.pucid=dm.pucid
      where m.codcomp='FV' and m.periodo=lpad(extract(month from cast('Now' as timestamp)),2,'0')
      and p.codigo like '4%'

      ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
        while ($ro = ibase_fetch_object($result)) {
            # code...
            $post[]= array( 'impuestos' => $ro->CREE  );
         }
      }else{
          $post[]= array( 'impuestos' => 0  );
      }
      echo json_encode($post);
   }
    public function impuestosCrc($request) {
      $query="
      select sum(dm.valortra) crc
      from movi m
      inner demovi dm on dm.movid=m.movid
      inner join plancuentas p on p.pucid=dm.pucid
      where p.codigo='524015.02' and m.periodo=lpad(extract(month from cast('Now' as timestamp)),2,'0')

      ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
        while ($ro = ibase_fetch_object($result)) {
            # code...
            $post[]= array( 'impuestos' => $ro->CRC  );
         }
      }else{
          $post[]= array( 'impuestos' => 0  );
      }
      echo json_encode($post);
   }
   
   public function nomina($request) {
      $query="
select (iif (sum(dm.valortra) is null,0,sum(dm.valortra))-iif(sum(dm1.valortra)is null,0,sum(dm1.valortra))) nomina
from plancuentas p
left join demovi dm on dm.pucid=p.pucid and dm.tipocd='D'
left join demovi dm1 on dm1.pucid=p.pucid and dm1.tipocd='C'
where (p.codigo like '2505%')

      ";
      $post = array();
      $result = $this->EjecutarContableibase($query);
      if( ibase_num_fields($result) > 0){
        while ($ro = ibase_fetch_object($result)) {
            $post[]= array( 'nomina' => $ro->NOMINA  );
         }
      }else{
         $post[]= array( 'nomina' => 0  );
      }
      echo json_encode($post);
   }






}

