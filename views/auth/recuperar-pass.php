<h1 class="nombre-pagina">Reestablecer mi contraseña</h1>
<p class="descripcion-pagina">Escribí tu nueva contraseña en el siguiente campo:</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>


<?php if($error) return; ?>
    <form method="POST" class="formulario">
    <div class="campo">
        <label for="password">Contraseña</label>
        <input 
        type="password"
        id="password"
        name="password"
        placeholder="Tu nuevo password">
    </div>

    <input type="submit" class="boton" value="Guardar cambios">
</form>

<div class="acciones">
    <a href="/">¿Ya tenés una cuenta? Iniciar Sesión</a>
    <a href="/crear-cuenta">¿No tenés una cuenta? Crear una aquí</a>
</div>
