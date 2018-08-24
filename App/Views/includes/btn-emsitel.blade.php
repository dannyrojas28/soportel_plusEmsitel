<center>
    <a class="btn comerc <?php if($estado == 'Comercial')    { echo 'btn-emsitel-Active verde-Active'; }else{ echo 'btn-emsitel verde';} ?> " href="Comercial"     id="Comercial"      >   E</a>
    <a class="btn contable <?php if($estado == 'Contabilidad') { echo 'btn-emsitel-Active verde-Active'; }else{ echo 'btn-emsitel verde';} ?> " href="Contabilidad"  id="Contabilidad"   >   M</a>
    <a class="btn servicios <?php if($estado == 'Servicios')    { echo 'btn-emsitel-Active verde-Active'; }else{ echo 'btn-emsitel verde';} ?> " href="Servicios"     id="Servicios"      >   S</a>
    <a class="btn internet <?php if($estado == 'Internet')     { echo 'btn-emsitel-Active verde-Active'; }else{ echo 'btn-emsitel verde';} ?> " href="Internet"      id="Internet"       >   I</a>
    <a class="btn telefonia <?php if($estado == 'Telefonia')    { echo 'btn-emsitel-Active verde-Active'; }else{ echo 'btn-emsitel verde';} ?> " href="Telefonia"     id="Telefonia"      >   T</a>
    <a class="btn emsivoz <?php if($estado == 'Emsivoz')      { echo 'btn-emsitel-Active verde-Active'; }else{ echo 'btn-emsitel verde';} ?> " href="Emsivoz"       id="Emsivoz"        >   E</a>
    <a class="btn ventas <?php if($estado == 'Ventas')       { echo 'btn-emsitel-Active verde-Active'; }else{ echo 'btn-emsitel verde';} ?> " href="Ventas"        id="Ventas"         >   L</a>
</center>


<style type="text/css">
    .btn-emsitel{
    width:130px;
    font-size:38px;
    font-weight: bold;
    height: 42px;
    border-radius: 3px;
    margin: 0px;
    padding: 0;
    background:#c4d8fd;
    }
    .verde{
        color: #1eb15b;
    }
    .btn-emsitel-Active{
    width:130px;
    font-size:38px;
    font-weight: bold;
    height: 42px;
    border-radius: 3px;
    margin: 0px;
    padding: 0;
    background:#83a7ce;
    }
    .verde-Active{
        color: #29fd2e;
    }
</style>