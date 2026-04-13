$(document).ready(function() {
    
   
    $('#filtro').on('keyup', function() {
        var texto = $(this).val().toLowerCase();
        
        $('tbody tr').each(function() {
            var fila = $(this);
            var contenido = fila.text().toLowerCase();
            
            if(contenido.indexOf(texto) !== -1) {
                fila.show();
            } else {
                fila.hide();
            }
        });
    });
    
      
    

    $('#limpiarfiltro').on('click', function(e) {
        e.preventDefault();
        $('#filtro').val('');
        $('tbody tr').show();
    });

    $('#nadafiltro').on('click', function(e) {
        e.preventDefault();
        $('#limpiarfiltro').val('');
        $('tbody tr').show();
    });
});
