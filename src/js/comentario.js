document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

const comentariosPorPagina = 5;
let comentariosMostrados = 0;
let comentariosTotales = []; // Almacena todos los comentarios obtenidos de la API

function iniciarApp() {

    consultarAPI(); //Consulta la API en el backend de PHP

}
async function consultarAPI() {

    try {
        //Mandar a traer los comentarios a través de fetch api
        //const url2 = `${location.origin}/api/comentario`;
        const url2 = '/api/comentario';
        const resultado2 = await fetch(url2);
        comentariosTotales = await resultado2.json();
        mostrarComentarios();

    } catch (error) {
        console.log(error);
    }

}

function mostrarComentarios() {
    const comentarios = comentariosTotales.slice(comentariosMostrados, comentariosMostrados + comentariosPorPagina);

    // Verifica si hay comentarios vacíos antes de mostrarlos
    const comentariosValidos = comentarios.filter(comentario1 => comentario1.comentario.trim() !== '');
    if (comentariosValidos.length > 0) {
        comentariosValidos.forEach(comentario2 => {

        const { id, nombre, comentario, respuesta, fecha} = comentario2;

        const nombreUsuario = document.createElement('P');
        nombreUsuario.classList.add('nombre-comentario');
        nombreUsuario.textContent = nombre;

        const comentarioUsuario = document.createElement('P');
        comentarioUsuario.classList.add('comentario-comentario');
        comentarioUsuario.textContent = comentario;

        const fechaUsuario = document.createElement('P');
        fechaUsuario.classList.add('fecha-comentario');
        fechaUsuario.textContent = fecha;

        const respuestaUsuario = document.createElement('P');
        respuestaUsuario.classList.add('respuesta-comentario');
        respuestaUsuario.textContent = respuesta;

        const comentarioDiv = document.createElement('DIV');
        comentarioDiv.classList.add('comentario');
        comentarioDiv.dataset.idComentario = id;

        comentarioDiv.appendChild(nombreUsuario);
        comentarioDiv.appendChild(comentarioUsuario);
        comentarioDiv.appendChild(fechaUsuario);
        comentarioDiv.appendChild(respuestaUsuario);

        document.querySelector('#comentarioUs').appendChild(comentarioDiv);

    });

    comentariosMostrados += comentarios.length;

    if (comentariosMostrados < comentariosTotales.length) {
        const verMasBoton = document.createElement('button');
        verMasBoton.textContent = 'Ver más comentarios';
        verMasBoton.classList.add('ver-mas');
        verMasBoton.addEventListener('click', cargarMasComentarios);
        document.querySelector('#comentarioUs').appendChild(verMasBoton);
    }

    } else {
        // Si no hay comentarios válidos, muestra una alerta
        alert('El comentario no puede ir vacío.');
    }
}

function cargarMasComentarios() {
    // Elimina el botón "Ver más comentarios"
    document.querySelector('.ver-mas').remove();
    mostrarComentarios();
}