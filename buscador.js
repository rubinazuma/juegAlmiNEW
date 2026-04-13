function rellenarSelectJuegos() {
    $.ajax({
        url: 'buscador.php',
        type: 'POST',
        data: { function: 'getCategorias' },
        success: function(response) {
            $('#selectCategoria').html(response);
        },
        error: function() {
            alert('Error al cargar las categorías');
        }
    });
}

$(document).ready(function() {
    // cargar categorías al inicio
    rellenarSelectJuegos();

    $('#selectCategoria').on('change', function() {
        var categoriaSeleccionada = $(this).val().toLowerCase();

        var parametros = {function: 'filtrarJuegos', categoria: categoriaSeleccionada};

        $.ajax({
            url: 'buscador.php',
            type: 'POST',
            data: parametros,
            success: function(response) {
                $('#resultados').html(response);
            },
            error: function() {
                alert('Error al filtrar los juegos');
            }
        });
    });
});
