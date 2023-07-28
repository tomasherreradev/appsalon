<h1 class="nombre-pagina">Administración</h1>

<?php
    $citaId = 0;
    $nombreSolo = explode(" ", $nombre);
    include_once __DIR__ . '/../templates/barra.php';
?>
<h2>Buscar un turno:</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo $fecha; ?>"
            >
        </div>
    </form>
</div>


<?php if($citas){ ?>
    <div class="citas-admin">
    <ul class="citas">
       <?php foreach($citas as $key => $cita):
             if($citaId !== $cita->id): //Evita repetir la cita x cantidad de servicios
                $total= 0;
             ?> 
                <li class="datos">
                        <p>ID: <span><?php echo $cita->id; ?></span></p>
                        <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                        <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                        <p>Email: <span><?php echo $cita->email; ?></span></p>
                        <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>

                        <h3>Servicios pretendidos:</h3>
                        <?php
                                $citaId = $cita->id;
                                endif; ?>
                        <div>                              
                             <p class="servicio"><?php echo $cita->servicio . " $" . $cita->precio;//Iteramos cada servicio fuera del if?></p> 
                                 <?php
                                 //Saber cuando termina el id de una cita
                                    $actual = $cita->id;
                                    $proximo = $citas[$key +1]->id ?? 0;
                                    $total = $total + $cita->precio;
                                 
                                    if(esUltimo($actual, $proximo)) { ?>
                                         <p class="total">Importe: $<span><?php echo $total; ?></span></p>
                                         <form action="/api/eliminar" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                                            <input type="submit" value="Eliminar turno" class="boton-eliminar">
                                         </form>
                                   <?php } ?>
                            </div>  
                </li>

        <?php endforeach; ?>
    </ul>
</div>

<?php } else {?>
        <h2>No hay turnos para este día.</h2>
<?php } ?>

<?php 
    $script = "<script src='build/js/buscador.js'></script>"

?>