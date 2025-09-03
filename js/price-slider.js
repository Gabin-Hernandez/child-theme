document.addEventListener('DOMContentLoaded', function () {
    console.log('Price slider script loaded');
    
    function initPriceFilter() {
        console.log('Inicializando filtro de precio...');
        
        // Intentar encontrar elementos del widget de WooCommerce
        var $minInput = jQuery('.price_slider_amount #min_price, #min_price');
        var $maxInput = jQuery('.price_slider_amount #max_price, #max_price');

        // Si no hay elementos del widget, buscar los campos personalizados
        if (!$minInput.length) {
            $minInput = jQuery('#min_price');
        }
        if (!$maxInput.length) {
            $maxInput = jQuery('#max_price');
        }

        console.log('Elementos encontrados:', {
            minInput: $minInput.length,
            maxInput: $maxInput.length
        });

        if (!$minInput.length || !$maxInput.length) {
            console.log('Elementos de precio no encontrados');
            return;
        }

        var min_price = parseInt($minInput.data('min'), 10);
        var max_price = parseInt($maxInput.data('max'), 10);
        var current_min_price = parseInt($minInput.val(), 10);
        var current_max_price = parseInt($maxInput.val(), 10);

        // Valores por defecto más realistas
        if (isNaN(min_price)) min_price = 0;
        if (isNaN(max_price)) max_price = 10000;
        if (isNaN(current_min_price)) current_min_price = min_price;
        if (isNaN(current_max_price)) current_max_price = max_price;
        
        console.log('Valores de precio:', {min_price, max_price, current_min_price, current_max_price});

        var $slider = jQuery('.price_slider');
        
        // Si no hay slider de WooCommerce, crear uno personalizado
        if (!$slider.length) {
            // Crear un slider personalizado para los campos de entrada
            var sliderHtml = '<div class="price_slider"></div>';
            $minInput.closest('.space-y-4, .price-filter-widget').prepend(sliderHtml);
            $slider = jQuery('.price_slider');
        }
        
        if (!$slider.length) {
            console.log('No se pudo crear el slider');
            return;
        }

        if ($slider.hasClass('ui-slider')) {
            $slider.slider('destroy');
        }

        function formatPrice(val){
            var p = window.woocommerce_price_slider_params || {};
            var symbol = p.currency_symbol || '$';
            var decimals = parseInt(p.currency_format_num_decimals || 0, 10);
            var decSep = p.currency_format_decimal_sep || '.';
            var thouSep = p.currency_format_thousand_sep || ',';
            var pos = p.currency_position || 'left';

            var num = Number(val || 0).toFixed(decimals);
            var parts = num.split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thouSep);
            var formatted = parts.join(decSep);

            switch(pos){
                case 'left': return symbol + formatted;
                case 'right': return formatted + symbol;
                case 'left_space': return symbol + ' ' + formatted;
                case 'right_space': return formatted + ' ' + symbol;
                default: return symbol + formatted;
            }
        }

        function updateLabel(minV, maxV){
            var $label = jQuery('.price_slider_amount .price_label');
            if (!$label.length) return;
            var minText = formatPrice(minV);
            var maxText = formatPrice(maxV);
            var $from = $label.find('.from');
            var $to = $label.find('.to');
            if ($from.length && $to.length){
                $from.text(minText);
                $to.text(maxText);
            } else {
                $label.text('Precio: ' + minText + ' — ' + maxText);
            }
        }

        $slider.slider({
            range: true,
            animate: true,
            min: min_price,
            max: max_price,
            values: [current_min_price, current_max_price],
            create: function() {
                $minInput.val(current_min_price);
                $maxInput.val(current_max_price);
                updateLabel(current_min_price, current_max_price);
                jQuery(document.body).trigger('price_slider_create', [current_min_price, current_max_price]);
            },
            slide: function (event, ui) {
                $minInput.val(ui.values[0]);
                $maxInput.val(ui.values[1]);
                updateLabel(ui.values[0], ui.values[1]);
                jQuery(document.body).trigger('price_slider_slide', [ui.values[0], ui.values[1]]);
            },
            change: function(event, ui) {
                jQuery(document.body).trigger('price_slider_change', [ui.values[0], ui.values[1]]);
            }
        });
        
        // Actualizar slider cuando cambien los inputs
        $minInput.on('change input', function() {
            var value = parseInt(jQuery(this).val(), 10);
            if (!isNaN(value) && value >= min_price && value <= max_price) {
                var maxVal = parseInt($maxInput.val(), 10) || max_price;
                if (value <= maxVal) {
                    $slider.slider('values', [value, maxVal]);
                    updateLabel(value, maxVal);
                }
            }
        });
        
        $maxInput.on('change input', function() {
            var value = parseInt(jQuery(this).val(), 10);
            if (!isNaN(value) && value >= min_price && value <= max_price) {
                var minVal = parseInt($minInput.val(), 10) || min_price;
                if (value >= minVal) {
                    $slider.slider('values', [minVal, value]);
                    updateLabel(minVal, value);
                }
            }
        });
    }

    // Inicial inicialización y al cargar fragmentos/AJAX de WooCommerce
    jQuery(document.body)
        .on('price_slider_create price_slider_updated woocommerce_update_variation_values', initPriceFilter);

    initPriceFilter();

    // Fallback por si hay retrasos
    setTimeout(initPriceFilter, 300);
    setTimeout(initPriceFilter, 800);
    
    // Reinicializar después de actualizaciones AJAX de WooCommerce
    jQuery(document.body).on('updated_wc_div', function() {
        setTimeout(initPriceFilter, 100);
    });
});
