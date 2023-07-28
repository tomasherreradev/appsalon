<h1 class="nombre-pagina">Crear un servicio</h1>
<p class="descripcion-pagina">Añadí un nuevo servicio</p>

<?php 
    @include_once __DIR__ . "/../templates/barra.php";
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" action="/servicios/crear" method="POST">    
    <?php
        include_once __DIR__ . "/formulario.php";
    ?>
    <input type="submit" class="boton" value="Crear">
</form>