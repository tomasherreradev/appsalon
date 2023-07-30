<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llená el formulario para crear tu cuenta!</p>

<?php include_once __DIR__ . "/../templates/alertas.php"?>

<form action="/crear-cuenta" method="POST" class="formulario">
    <div class="campo">
        <label class="label-campo" for="nombre">Nombre</label>
        <input 
        type="text" 
        id="nombre"
        name="nombre"
        placeholder="Tu Nombre"
        value="<?php echo s($usuario->nombre); ?>">
    </div>

    <div class="campo">
        <label class="label-campo" for="apellido">Apellido</label>
        <input 
        type="text" 
        id="apellido"
        name="apellido"
        placeholder="Tu Apellido"
        value="<?php echo s($usuario->apellido); ?>">
    </div>

    <div class="campo">
        <label class="label-campo" for="telefono">Telefono</label>
        <input 
        type="tel" 
        id="telefono"
        name="telefono"
        placeholder="Tu Teléfono"
        value="<?php echo s($usuario->telefono); ?>">
    </div>

    <div class="campo">
        <label class="label-campo" for="email">Email</label>
        <input 
        type="email" 
        id="email"
        name="email"
        placeholder="Tu Email"
        value="<?php echo s($usuario->email); ?>">
    </div>

    <div class="campo">
        <label class="label-campo" for="password">Password</label>
        <input 
        type="password" 
        id="password"
        name="password"
        placeholder="Tu Password">
    </div>

    <input type="submit" class="boton" value="Crear mi cuenta">

</form>

<div class="acciones">
    <a href="/">¿Ya tenés una cuenta? Iniciar Sesión</a>
    <a href="/olvide">Olvidé mi contraseña</a>
</div>