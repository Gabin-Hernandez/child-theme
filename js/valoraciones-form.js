jQuery(document).ready(function($) {
    // Mostrar/ocultar formulario
    $('#btn-nueva-valoracion').on('click', function() {
        $('#formulario-valoracion').removeClass('hidden').hide().slideDown(400);
        $('html, body').animate({
            scrollTop: $('#formulario-valoracion').offset().top - 100
        }, 600);
    });

    $('#btn-cancelar-valoracion').on('click', function() {
        $('#formulario-valoracion').slideUp(400);
        $('#form-nueva-valoracion')[0].reset();
        resetStars();
        $('#form-response').addClass('hidden');
    });

    // Sistema de calificación por estrellas
    let selectedRating = 0;

    $('.star-label').on('mouseenter', function() {
        const rating = $(this).data('rating');
        highlightStars(rating);
    });

    $('#star-rating').on('mouseleave', function() {
        highlightStars(selectedRating);
    });

    $('.star-label').on('click', function() {
        const rating = $(this).data('rating');
        selectedRating = rating;
        $('input[name="rating"][value="' + rating + '"]').prop('checked', true);
        highlightStars(rating);
    });

    function highlightStars(rating) {
        $('.star-label').each(function() {
            const starRating = $(this).data('rating');
            if (starRating <= rating) {
                $(this).removeClass('text-gray-300').addClass('text-yellow-400');
            } else {
                $(this).removeClass('text-yellow-400').addClass('text-gray-300');
            }
        });
    }

    function resetStars() {
        selectedRating = 0;
        highlightStars(0);
    }

    // Enviar formulario
    $('#form-nueva-valoracion').on('submit', function(e) {
        e.preventDefault();

        const nombre = $('#valoracion-nombre').val().trim();
        const rating = $('input[name="rating"]:checked').val();
        const comentario = $('#valoracion-comentario').val().trim();
        const producto = $('#valoracion-producto').val().trim();

        // Validaciones del cliente
        if (nombre.length < 3) {
            showResponse('error', 'El nombre debe tener al menos 3 caracteres');
            return;
        }

        if (!rating) {
            showResponse('error', 'Por favor selecciona una calificación');
            return;
        }

        if (comentario.length < 10) {
            showResponse('error', 'El comentario debe tener al menos 10 caracteres');
            return;
        }

        // Deshabilitar botón de envío
        const $submitBtn = $(this).find('button[type="submit"]');
        const originalText = $submitBtn.html();
        $submitBtn.prop('disabled', true).html('<svg class="animate-spin h-5 w-5 inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Enviando...');

        // Enviar vía AJAX
        $.ajax({
            url: itoolsValoraciones.ajaxurl,
            type: 'POST',
            data: {
                action: 'save_valoracion',
                nonce: itoolsValoraciones.nonce,
                nombre: nombre,
                rating: rating,
                comentario: comentario,
                producto: producto
            },
            success: function(response) {
                $submitBtn.prop('disabled', false).html(originalText);
                
                if (response.success) {
                    showResponse('success', response.data);
                    $('#form-nueva-valoracion')[0].reset();
                    resetStars();
                    
                    // Ocultar formulario después de 3 segundos
                    setTimeout(function() {
                        $('#formulario-valoracion').slideUp(400);
                        $('#form-response').addClass('hidden');
                    }, 3000);
                } else {
                    showResponse('error', response.data);
                }
            },
            error: function() {
                $submitBtn.prop('disabled', false).html(originalText);
                showResponse('error', 'Hubo un error al enviar tu valoración. Por favor intenta de nuevo.');
            }
        });
    });

    function showResponse(type, message) {
        const $response = $('#form-response');
        const isSuccess = type === 'success';
        
        $response
            .removeClass('hidden')
            .removeClass('bg-red-100 border-red-400 text-red-700 bg-green-100 border-green-400 text-green-700')
            .addClass(isSuccess ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700')
            .addClass('border-l-4 p-4 rounded')
            .html(
                '<div class="flex items-center">' +
                    '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">' +
                        (isSuccess
                            ? '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>'
                            : '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>'
                        ) +
                    '</svg>' +
                    '<p class="font-semibold">' + message + '</p>' +
                '</div>'
            );
    }
});
