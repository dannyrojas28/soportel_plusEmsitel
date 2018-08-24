<?php


require_once '/var/www/html/soportel_plus/Config/vars.php';
class Conexion extends Variables{

    
   	function __Construct()
    {
    	# code...
        session_start();
        date_default_timezone_set('America/Bogota');
    	$var   = new Variables();
    }

    public function Conectar(){
        $connect = mysqli_connect($this->host,$this->user,$this->pass,$this->db) 
            or die ("Error". mysqli_error($connect));
        return $connect;   
    }
    public function ConectarSoportel(){
        $connect = mysqli_connect($this->host,$this->user,$this->pass,$this->dbSp) 
            or die ("Error". mysqli_error($connect));
        return $connect;   
    }
    public function ConectarSoportelPlus(){
        $connect = mysqli_connect($this->host,$this->user,$this->pass,$this->dbSo) 
            or die ("Error ". mysqli_error($connect));
        return $connect;   
    }
    public function ConectarSoportelPlus2(){
        $connect = mysqli_connect('11.1.2.7','root','jjpitaemsitel2012','mya2billing') 
            or die ("Error ". mysqli_error($connect));
        return $connect;   
    }
    ///////////////////
    public function ConectarTelefonia(){
        $connect = mysqli_connect($this->host,$this->user,$this->pass,$this->telef) 
            or die ("Error ". mysqli_error($connect));
        return $connect;   
    }///////////////////////////
    public function ConectarEmsivozCo(){
        $connect = mysqli_connect($this->HEmsCo,$this->UEmsi,$this->PEmsi,$this->BEmsi) 
            or die ("Error en la conexion con colombida". mysqli_error($connect));
        return $connect;   
    }
    public function ConectarEmsivozVe(){
        $connect = mysqli_connect($this->HEmsVe,$this->UEmsi,$this->PEmsi,$this->BEmsi) 
            or die ("Error ". mysqli_error($connect));
        return $connect;   
    }
    public function ConectarEmsivozUs(){
        $connect = mysqli_connect($this->HEmsUs,$this->UEmsi,$this->PEmsi,$this->BEmsi) 
            or die ("Error ". mysqli_error($connect));
        return $connect;   
    }
    public function ConectarContableIbase(){
        $connect = ibase_connect($this->hodbib, $this->userib, $this->passib) or die(ibase_errmsg());
        return $connect;   
    }
    public function ConectarSSH(){
        $connection = ssh2_connect($this->hostS, $this->portS);
        $conex = ssh2_auth_password($connection, $this->userS, $this->passS);
        if($conex){
            return $connection;
        }else{
            return false;
        }
    }
    public function ConectarInternet(){
        $connect = mysqli_connect($this->host,$this->user,$this->pass,$this->inter) 
            or die ("Error". mysqli_error($connect));
        return $connect;   
    }
    public function ConectarPostgres(){
        $connect = pg_connect("host=".$this->pgHost." port=".$this->pgPort." dbname=".$this->pgDbna." user=".$this->pgUser." password=".$this->pgPass." ")
            or die ("Error");
        return $connect;   
    }
    
    
    public function ConectarServiNube(){
        $connect = mysqli_connect($this->host,$this->user,$this->pass,$this->serviNube) 
            or die ("Error". mysqli_error($connect));
        return $connect;   
    }
    public function EjecutarServiNube($sql){
        $connect = $this->ConectarServiNube();
        $result = $connect->query($sql);
        return $result;
    }
    
    
    
    
    
    
    public function ConectarComercial(){
        $connect = mysqli_connect($this->host,$this->user,$this->pass,$this->comerc) 
            or die ("Error". mysqli_error($connect));
        return $connect;   
    }
    public function EjecutarComercial($sql){
        $connect = $this->ConectarComercial();
        $result = $connect->query($sql);
        return $result;
    }
    public function EjecutarInternet($sql){
        $connect = $this->ConectarInternet();
        $result = $connect->query($sql);
        return $result;
    }
    public function Ejecutar($sql){
        $connect = $this->Conectar();
        $result = $connect->query($sql);
        return $result;
    }
    public function EjecutarSoportel($sql){
        $connect = $this->ConectarSoportel();
        $result = $connect->query($sql);
        return $result;
    }
    public function EjecutarSoportelPlus($sql){
        $connect = $this->ConectarSoportelPlus();
        $result = $connect->query($sql);
        return $result;
    }
    public function EjecutarSoportelPlus2($sql){
        $connect = $this->ConectarSoportelPlus2();
        $result = $connect->query($sql);
        return $result;
    }
    ////////////////////////////
    public function EjecutarTelefonia($sql){
        $connect = $this->ConectarTelefonia();
        $result = $connect->query($sql);
        return $result;
    }///////////////////////
    public function EjecutarEmsivozCo($sql){
        $connect = $this->ConectarEmsivozCo();
        $result = $connect->query($sql);
        return $result;
    }
     public function EjecutarEmsivozVe($sql){
        $connect = $this->ConectarEmsivozVe();
        $result = $connect->query($sql);
        return $result;
    }
     public function EjecutarEmsivozUs($sql){
        $connect = $this->ConectarEmsivozUs();
        $result = $connect->query($sql);
        return $result;
    }
    public function EjecutarPostgresSql($sql){
        $connect = $this->ConectarPostgres();
        $result = pg_query($connect,$sql);
        return $result;
    }
    public function EjecutarContableibase($sql){
        $connect = $this->ConectarContableIbase();
        $result = ibase_query($connect, $sql);
        return $result;
    }
    public function ValidateSession()
    {
        # code...

        if(empty($_SESSION['token'])){

            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function CreateSession($result){
        if(mysqli_num_rows($result)> 0){
            $i=0;
            while ($res = mysqli_fetch_object($result)) {
                # code...
                
                if($i == 0){
                    $_SESSION['token']          = time();
                    $_SESSION['nombres']        = $res->nombre_usu." ".$res->apellido_usu;
                    $_SESSION['cod_usu']        = $res->cod_ad;
                    $_SESSION['nombre']         = $res->nombre_usu;
                    $_SESSION['apellido_usu']   = $res->apellido_usu;
                    $_SESSION['telefono_usu']   = $res->telefono_usu;
                    $_SESSION['documento_usu']  = $res->documento_usu;
                    $_SESSION['admin']          = $res->admin;
                    $_SESSION['imagen_usu']     = $res->imagen_usu;
                }
                    $_SESSION['rol'][$i]            = $res->rol;
                    $_SESSION['tipo_rol'][$i]       = $res->nombre_rol;

                    $i = $i +1;
            }
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function DeleteSession(){
        # code...
        session_destroy();
                $_SESSION['token']          = "";
                $_SESSION['nombre']         = "";
                $_SESSION['apellido_usu']   = "";
                $_SESSION['telefono_usu']   = "";
                $_SESSION['documento_usu']  = "";
                $_SESSION['admin']          = "";
                $_SESSION['imagen_usu']     = "";
                $_SESSION['rol']            = "";
                $_SESSION['tipo_rol']       = "";
    }

    public function UpdateSession($result){
        if(mysqli_num_rows($result)> 0){
            $i=0;
                $_SESSION['rol']            = "";
                $_SESSION['tipo_rol']       = "";
            while ($res = mysqli_fetch_object($result)) {
                # code...
                if($i == 0){
                    $_SESSION['nombres']        = $res->nombre_usu." ".$res->apellido_usu;
                    $_SESSION['nombre']         = $res->nombre_usu;
                    $_SESSION['apellido_usu']   = $res->apellido_usu;
                    $_SESSION['telefono_usu']   = $res->telefono_usu;
                    $_SESSION['documento_usu']  = $res->documento_usu;
                    $_SESSION['admin']          = $res->admin;
                    $_SESSION['imagen_usu']     = $res->imagen_usu;
                }
                    $_SESSION['rol'][$i]            = $res->rol;
                    $_SESSION['tipo_rol'][$i]       = $res->nombre_rol;

                    $i = $i +1;
            }
            return TRUE;
        }else{
            return FALSE;
        }
    }
}

?>