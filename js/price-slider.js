document.addEventListener('DOMContentLoaded', function () {
    if (typeof woocommerce_price_slider_params === 'undefined') {
        return false;
    }

    function initPriceFilter() {
        var min_price = jQuery('.price_slider_amount #min_price').data('min');
        var max_price = jQuery('.price_slider_amount #max_price').data('max');
        var current_min_price = parseInt(jQuery('.price_slider_amount #min_price').val(), 10);
        var current_max_price = parseInt(jQuery('.price_slider_amount #max_price').val(), 10);

        if (isNaN(current_min_price)) {
            current_min_price = parseInt(min_price, 10);
        }
        if (isNaN(current_max_price)) {
            current_max_price = parseInt(max_price, 10);
        }

        jQuery('.price_slider:not(.ui-slider)').slider({
            range: true,
            animate: true,
            min: min_price,
            max: max_price,
            values: [current_min_price, current_max_price],
            create: function() {
                jQuery('.price_slider_amount #min_price').val(current_min_price);
                jQuery('.price_slider_amount #max_price').val(current_max_price);
                jQuery(document.body).trigger('price_slider_create', [current_min_price, current_max_price]);
            },
            slide: function (event, ui) {
                jQuery('input#min_price').val(ui.values[0]);
                jQuery('input#max_price').val(ui.values[1]);
                jQuery(document.body).trigger('price_slider_slide', [ui.values[0], ui.values[1]]);
            },
            change: function(event, ui) {
                jQuery(document.body).trigger('price_slider_change', [ui.values[0], ui.values[1]]);
            }
        });
    }

    // Corrección para asegurar que el slider se inicialice después de AJAX
    jQuery(document.body).on('init_price_filter', initPriceFilter).trigger('init_price_filter');
    
    // Fallback por si el evento no se dispara
    setTimeout(function() {
        if (jQuery('.price_slider:not(.ui-slider)').length) {
            initPriceFilter();
        }
    }, 500);
});
