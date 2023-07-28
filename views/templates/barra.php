<?php 
    $nombreSolo = explode(" ", $nombre);
?>

<div class="barra">
    <p> Hola, <?php echo $nombreSolo[0]; ?>!</p>

    <a class="boton" href="/logout">Logout</a>
</div>

<?php if(isset($_SESSION['admin'])) { ?>
    <div class="barra-admin">
        <a class="boton" href="/admin">Ver mis turnos</a>
        <a class="boton" href="/servicios">Ver servicios</a>
        <a class="boton" href="/servicios/crear">Crear servicios</a>
    </div>
<?php } ?>