// Animaciones de la página
$(document).ready(function() {
    // Fade-in para los elementos de la hero section
    // $('.hero-section h1').addClass('fadeIn');
    // $('.hero-section p').addClass('fadeIn');
    // $('.hero-section .btn').addClass('fadeIn');
    
    // Animación para los servicios
    $('.service-card').hover(function() {
        $(this).css("transform", "translateY(-10px)");
    }, function() {
        $(this).css("transform", "translateY(0)");
    });

    // Animación de Testimonios
    $('#testimonialSlider').carousel({
        interval: 5000 // Cambiar cada 5 segundos
    });

    // Agregar efecto fade-in a los elementos al hacer scroll
    $(window).on('scroll', function() {
        $('.fadeIn').each(function() {
            if ($(this).offset().top < $(window).scrollTop() + $(window).height()) {
                $(this).addClass('animated fadeIn');
            }
        });
    });
});
