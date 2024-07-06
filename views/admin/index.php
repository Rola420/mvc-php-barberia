<h1 class="nombre-pagina">Panel de Administración</h1>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class = "campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo $fecha; ?>"
            />
        </div>
    </form>
</div>

<?php
    if(count ($citas) === 0){
        echo "<h2>No hay Citas en esta fecha</h2>";
    }
?>

<div id="citas-admin">
    <ul class="citas">
        <?php
            $idCita = 0;
            foreach( $citas as $key => $cita ){
                if($idCita !== $cita->id) {   
        ?>
        <li>
                <p>ID: <span><?php echo $cita->id; ?></span></p>
                <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                <p>Correo: <span><?php echo $cita->correo; ?></span></p>
                <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>

                <h3>Servicios</h3>
        <?php 
                $idCita = $cita->id;
            }// Fin del if

            // Determinar el estado del servicio
            $estadoServicio = $cita->estado == 1 ? "" : " - Inhabilitado";
            ?>
            <p class="servicio"><?php echo $cita->servicio . " - $ " . $cita->precio; ?><span id="estado"><span class="estadoIn"><?php echo $estadoServicio; ?></span></span></p>
            <?php 

                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id ?? 0;

                if(esUltimo($actual, $proximo)){ ?>
                    <p class="total">Total: <span>$ <?php echo $cita->total; ?>.00 </span><span class="info-icon" title="Total orginial, antes de modifaciones">&#9432;</span></p>

                <?php if ($cita->realizada == 0): ?>
                    <div class="botones-container">
                        <form action="/api/realizada" method="POST" id="formRealizarCita">
                            <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                            <button class="boton" type="submit" onclick="confirmDelete(event, 'formRealizarCita')">Realizar cita</button>
                        </form>
                        <form action="/api/noasistio" method="POST" id="formAsistioCita">
                            <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                            <button class="boton" type="submit" onclick="confirmDelete(event, 'formAsistioCita')">No asistió</button>
                        </form>
                    </div>
                    <?php elseif ($cita->realizada == 1): ?>
                        <div id="mensaje-cita"><span class="span-realizado">Cita realizada</span></div>
                    <?php elseif ($cita->realizada == 2): ?>
                        <div id="mensaje-cita"><span class="span-realizado">Cliente no asistió</span></div>
                    <?php endif; ?>
                <?php }
            }// Fin del Foreach ?>
    </ul>
</div>

<?php 
    $script = "<script src='build/js/buscador.js'></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
    
?>