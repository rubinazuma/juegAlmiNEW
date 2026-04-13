$(document).ready(function() {
    $('.iconoAgrandar').on('click', function() {
        var categoria = $(this).nextAll('.categoriaJuegos').first();
        categoria.slideToggle(400);
        var srcActual = $(this).attr('src'); 
        if (srcActual.includes('plus')) {
            $(this).attr('src', 'images/25232.png');
        } else {
            $(this).attr('src', 'images/plus-icon-plus-svg-png-icon-download-1.png');
        }
        
        $('.imagen').fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
    });

    $('#logo2').mouseenter(function() {
        $(this).animate({width: '165px', height: '165px'}, 300);
    }).mouseleave(function() {
        $(this).animate({width: '150px', height: '150px'}, 300);
    });


    let aCount = 0;
    $(document).keydown(function(e) {
        const key = String.fromCharCode(e.which).toLowerCase();
        if (key === 'a') {
            aCount++;
            if (aCount >= 3) {
                
                $('nav').addClass('red-menu');
                $('.menuNivel1').addClass('red-menu');
                aCount = 0; 
            }
        } else {
            aCount = 0; 
        }
    });
});

