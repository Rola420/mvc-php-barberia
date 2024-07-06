function avisoComentario(event) {
    event.preventDefault();

    // Obtener el valor del comentario
    const comentario = event.target.querySelector('#comentario').value.trim();

    // Verificar si el comentario está vacío
    if (!comentario) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, ingresa un comentario antes de enviar.'
        });
        return; // Detener la ejecución de la función si el comentario está vacío
    }

    Swal.fire({
        icon: 'success',
        title: 'Comentario Creado',
        text: 'Tu Comentario fue enviado correctamente',
        button: 'OK'
    }).then(() => {
        setTimeout(() => {
            event.target.submit();
        }, 500);
    });
}

function confirmarEliminarComentario(event) {
    event.preventDefault();

    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma la eliminación, enviar el formulario
            const form = event.target.closest('form');
            form.submit();
            
        }
    });
}