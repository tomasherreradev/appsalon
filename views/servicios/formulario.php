<div class="campo">
    <label class="label-campo" for="nombre">Nombre</label>
    <input 
        type="text"
        name="nombre"
        id="nombre"
        placeholder="Nombre del servicio"
        value="<?php echo $servicio->nombre ?>"
        >
</div>

<div class="campo">
    <label class="label-campo" for="precio">Precio</label>
    <input 
        type="text"
        name="precio"
        id="precio"
        placeholder="Precio del servicio"
        value="<?php echo $servicio->precio ?>"
        >
</div>