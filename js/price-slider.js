document.addEventListener('DOMContentLoaded', function () {
    function initPriceFilter() {
        var $minInput = jQuery('.price_slider_amount #min_price');
        var $maxInput = jQuery('.price_slider_amount #max_price');

        if (!$minInput.length || !$maxInput.length) return;

        var min_price = parseInt($minInput.data('min'), 10);
        var max_price = parseInt($maxInput.data('max'), 10);
        var current_min_price = parseInt($minInput.val(), 10);
        var current_max_price = parseInt($maxInput.val(), 10);

        if (isNaN(min_price)) min_price = 0;
        if (isNaN(max_price)) max_price = 1000;
        if (isNaN(current_min_price)) current_min_price = min_price;
        if (isNaN(current_max_price)) current_max_price = max_price;

        var $slider = jQuery('.price_slider');
        if (!$slider.length) return;

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
    }

    // Inicial inicialización y al cargar fragmentos/AJAX de WooCommerce
    jQuery(document.body)
        .on('price_slider_create price_slider_updated woocommerce_update_variation_values', initPriceFilter);

    initPriceFilter();

    // Fallback por si hay retrasos
    setTimeout(initPriceFilter, 300);
    setTimeout(initPriceFilter, 800);
});
