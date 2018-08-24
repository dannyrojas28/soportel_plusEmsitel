<ul class="list-unstyled" id="bancoDatos">
    <li>
        <a class="btn  <?php if($estado== 'Comercial')    { echo 'btn-banco-Active verde-Active'; }else{ echo 'btn-banco verde';} ?> " id="Comercial"   onclick="comercial()"   >   E</a>
    </li>
    <li>
        <a class="btn  <?php if($estado== 'Contabilidad') { echo 'btn-banco-Active verde-Active'; }else{ echo 'btn-banco verde';} ?> " id="Contabilidad"   >   M</a>
    </li>
    <li>
        <a class="btn  <?php if($estado== 'Servicios')    { echo 'btn-banco-Active verde-Active'; }else{ echo 'btn-banco verde';} ?> " id="Servicios"  onclick="servicios()"    >   S</a>
    </li>
    <li>
        <a class="btn  <?php if($estado == 'Internet')     { echo 'btn-banco-Active verde-Active'; }else{ echo 'btn-banco verde';} ?> "  id="Internet" onclick="internet()"      >   I</a>
    </li>
    <li>
        <a class="btn  <?php if($estado == 'Telefonia')    { echo 'btn-banco-Active verde-Active'; }else{ echo 'btn-banco verde';} ?> "  id="Telefonia"  onclick="telefonia()"  >   T</a>
    </li>
    <li>
        <a class="btn  <?php if($estado == 'Emsivoz')      { echo 'btn-banco-Active verde-Active'; }else{ echo 'btn-banco verde';} ?> "  id="Emsivoz"   onclick="emsivoz() "      >   E</a>
    </li>
    <li>
        <a class="btn  <?php if($estado == 'Ventas')      { echo 'btn-banco-Active verde-Active'; }else{ echo 'btn-banco verde';} ?> "  id="Emsivoz"   onclick="ventas() "      >   L</a>
    </li>
    <br>
    <li>
        <a class="btn  <?php if($estado == 'Roles')      { echo 'btn-banco-Active verde-Active'; }else{ echo 'btn-banco verde';} ?> "  id="Emsivoz"   onclick="roles() "      >   R</a>
    </li>
    
</ul>


<style type="text/css">
    #bancoDatos > li {
        margin-bottom: 15px;
    }
    .btn-banco{
    width:90px;
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
    .btn-banco-Active{
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