<h1 class="nombre-pagina">Solicitud de turno</h1>
<p class="descripcion-pagina">Elegí los servicios que quieras!</p>


<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<div id="app">

    <nav class="tabs">
        <button type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Turno</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>


    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elegí el servicio que busques: </p>
        <div id="servicios" class="listado-servicios">
            <!-- contenido de js -->
        </div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus datos y turno:</h2>
        <p class="text-center">Colocá los datos y hora del turno: </p>

            <form class="formulario" id="formulario">
                <div class="campo">
                    <label for="nombre">Nombre</label>
                    <input
                        id="nombre"
                        type="text"
                        placeholder="Tu nombre"
                        value="<?php echo $nombre?>"
                        disabled
                    />
                </div>
                <div class="campo">
                    <label for="fecha">Fecha</label>
                    <input
                        id="fecha"
                        type="date"
                        min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                    />
                </div>
                <div class="campo">
                    <label for="hora">Hora</label>
                    <input
                        id="hora"
                        type="time"
                    />
                </div>

                <input type="hidden" id="id" value="<?php echo $id; ?>">
            </form>

    </div>

    <div id="paso-3" class="seccion contenido-resumen">
        <h2>En resumen:</h2>
        <p class="text-center">Verificá que la información esté correcta.</p>
    </div>

    <div class="paginacion">
        <button
            id="anterior"
            class="boton"
        >&laquo; Anterior</button>

        <button
            id="siguiente"
            class="boton"
        >Siguiente &raquo;</button>
    </div>

</div>


<?php 
    $script= "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script src='/build/js/app.js'></script>
    "
?>