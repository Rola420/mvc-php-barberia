<div class="barra">
    <p>Hola: <?php echo $nombre ?? '' ?></p>
    <a class="boton" href="/logout">Cerrar Sesión</a>
</div>

<?php if (isset($_SESSION['admin'])) {
    //<a class="boton" href="/admin">Ver Citas</a>?>
    <div class="barra-servicios">
        <a class="boton" href="/servicios">Ver Servicios</a>
        <a class="boton" href="/servicios/crear">Nuevo Servicio</a>
        <a class="boton" href="/crear-cuenta">Nuevo Usuario</a>
        <a class="boton" href="/servicios/comentarios">Admin Comentarios</a>
    </div>

<?php } ?>