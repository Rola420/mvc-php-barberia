<div class="accion">
    <a class="boton" href="/admin">Regresar</a>
</div>


    <?php
        include_once __DIR__ . "/../templates/alertas.php";
    ?>
       
        <h2 class="comentario-pagina">Comentarios</h2>

        <ul class="listado-comentarios">
            <?php foreach($comentarios as $comentario) {?>
                <li>
                    <div class="comentario">
                    <p class="nombre-comentario"><span><?php echo $comentario->nombre; ?></span> </p>
                    <p class="comentario-comentario"><span><?php echo $comentario->comentario; ?></span> </p>
                    <p class="fecha-comentario"><span><?php echo $comentario->fecha; ?></span> </p>
                    </div>

                    <div class="acciones">
                        <form action="/servicios/eliminarC" method="POST">
                            <input type="hidden" name="id" value="<?php echo $comentario->id; ?>">
                            <input type="submit" value="Borrar" class="boton-eliminar" onclick="confirmarEliminarComentario(event)">
                        </form>
                    </div>
                </li>
            <?php } ?>
        </ul>


<?php 
    echo "<script src='/build/js/swamp.js'></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='/build/js/comentario.js'></script>";  
?>