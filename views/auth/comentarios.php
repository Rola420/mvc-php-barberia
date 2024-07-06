<h1 class="nombre-pagina">Cuentanos tu experiencia</h1>


    <?php
        include_once __DIR__ . "/../templates/alertas.php";
    ?>

    <div class="barra">
        <p>Usuario: <?php echo $nombre ?? '' ?></p>
        <a class="boton" href="/cita">Regresar</a>
        
    </div>

    <form class="formulario" method="POST" onsubmit="avisoComentario(event)" action="/comentarios">

    <div class="comentario">
        <textarea  
            type="text"
            id="comentario"
            name="comentario"
            placeholder="Comentario"
            rows="4"
            cols="50"
            ></textarea>
            <input type="hidden" name="nombre" value="<?php echo s($nombre); ?>">
                    
        </div>

        <input type="submit" value="Enviar Comentarios" class="boton">

        
        <h2 class="comentario-pagina">Comentarios</h2>

        <div id="comentarioUs" class="listado-comentarios"></div>




<?php 
    $script = "<script src='build/js/swamp.js'></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='build/js/comentario.js'></script>";
    
?>