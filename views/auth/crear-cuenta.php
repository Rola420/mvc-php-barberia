<?php if (isset($_SESSION['admin'])) { ?>
    <div class="accion">
    <a class="boton" href="/admin">Regresar</a>
</div>    
<?php } ?>
<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/crear-cuenta">
    
    <div class="campo">
    <label for="nombre">Nombre</label>
    <input 
        type="text"
        id="nombre"
        name="nombre"
        placeholder="Tu Nombre"
        value="<?php echo s($usuario->nombre); ?>"
    />
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
        type="text"
        id="apellido"
        name="apellido"
        placeholder="Tu Apellido"
        value="<?php echo s($usuario->apellido); ?>"
    />
    </div>

    <div class="campo">
    <label for="telefono">Telefono</label>
    <input 
        type="tel"
        id="telefono"
        name="telefono"
        placeholder="Tu Telefono"
        value="<?php echo s($usuario->telefono); ?>"
    />
    </div>

    <div class="campo">
    <label for="correo">Correo</label>
    <input 
        type="email"
        id="correo"
        name="correo"
        placeholder="Tu Correo"
        value="<?php echo s($usuario->correo); ?>"
    />
    </div>

    <div class="campo">
    <label for="password">Contraseña</label>
    <input 
        type="password"
        id="password"
        name="password"
        placeholder="Tu Contraseña"
    />
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">

</form>

<?php if (!isset($_SESSION['admin'])) { ?>
    <div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>
<?php } ?>
