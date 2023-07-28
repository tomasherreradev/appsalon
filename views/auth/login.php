<h1 class="nombre-pagina">Log-In</h1>
<p class="descripcion-pagina">Iniciá sesión con tus datos</p>

<?php include_once __DIR__ . "/../templates/alertas.php"?>


<form action="/" method="POST" class="formulario">
    <div class="campo">
        <label for="email">Email: </label>
        <input 
        type="email"
        id="email"
        placeholder="Ingresar correo"
        name="email"
        />
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input 
        type="password" 
        name="password" 
        placeholder="Ingresar contraseña"
        id="password">
    </div>

    <input type="submit" class="boton" value="Iniciar sesión">

</form>

<div class="acciones">
    <a href="/crear-cuenta">¿No tenés una cuenta? Crear una aquí</a>
    <a href="/olvide">Olvidé mi contraseña</a>
</div>