<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<?php
    include_once __DIR__ . '/../templates/barra2.php';
?>

<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Información Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita</p>
        <p class="text-center">Horario de 10am a 6pm</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input
                    id="nombre" 
                    type="text"
                    placeholder="Tu Nombre"
                    value="<?php echo $nombre?>"
                    disabled
                />
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input
                    id="fecha" 
                    type="date"
                    min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                />
            </div>

            <div class="s2">
                <label for="hora">Hora:</label>
                <select id="hora" name="hora">
                <option value="" disabled selected>-- --</option>
                    <?php
                        $hora_inicio = strtotime('10:00'); // Hora de apertura (10:00)
                        $hora_fin = strtotime('17:30'); // Hora de cierre (18:00)
                        $intervalo = 30 * 60; // Intervalo de 30 minutos en segundos

                        // Generar las opciones de horarios disponibles
                        while ($hora_inicio <= $hora_fin) {
                            $hora_actual = date('H:i', $hora_inicio);
                            echo "<option value='$hora_actual'>$hora_actual</option>";
                            $hora_inicio += $intervalo; // Añadir 30 minutos al tiempo actual
                        }
                    ?>
                </select>
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">

        </form>
    </div>

    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verfica que la información sea correcta</p>
    </div>

    <div class="paginacion">
        <button
            id="anterior"
            class="boton"
        >&laquo; Anterior</button>

        <button
            id="siguiente"
            class="boton"
        >Siguiente &raquo;</button>
    </div>
</div>

<?php
    $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
    ";
?>