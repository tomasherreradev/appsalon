<h1 class="nombre-pagina">Olvidé mi Contraseña</h1>
<p class="descripcion-pagina">Reestablecé tu contraseña colocando tu email:</p>

<?php include_once __DIR__ . "/../templates/alertas.php"?>

<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
            <label for="email">Email</label>
            <input 
            type="email" 
            id="email"
            name="email"
            placeholder="Tu email">
        </div>


        <input type="submit" class="boton" value="Reestablecer">
</form>

<div class="acciones">
    <a href="/">¿Ya tenés una cuenta? Iniciar Sesión</a>
    <a href="/crear-cuenta">¿No tenés una cuenta? Crear una aquí</a>
</div>