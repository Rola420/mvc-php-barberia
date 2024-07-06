<div class="accion">
    <a class="boton" href="/admin">Regresar</a>
</div>

<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de servicios</p>

<?php
    //include_once __DIR__ . '/../templates/barra.php';
?>

<ul class="servicios">
    <?php foreach($servicios as $servicio) {?>
        <li>
            <p>Nombre <span><?php echo $servicio->nombre; ?></span> </p>
            <p>Precio <span>$<?php echo $servicio->precio; ?></span> </p>

            <div class="acciones">
                <a class="boton" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">Actualizar</a>

                <form action="/servicios/estado" method="POST">
                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                    <?php if ($servicio->estado == 1) { ?>
                        <input type="submit" value="Inhabilitar" class="boton-eliminar">
                    <?php } else { ?>
                        <input type="submit" value="Habilitar" class="boton">
                    <?php } ?>
                </form>
            </div>
        </li>
    <?php }?>
</ul>

<?php 
    echo "<script src='/build/js/swamp.js'></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>";  
?>