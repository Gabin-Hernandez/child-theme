<?php
/**
 * Template Name: Plantilla para Checkout 
 * Template Post Type: page
 */
get_header(); 
?>

    <main id="main" class="w-11/12 lg:w-10/12 mx-auto max-w-[1920px] relative" role="main">
        <?php
        while ( have_posts() ) : the_post();
            the_content();
        endwhile; // End of the loop.
        ?>
    </main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Función para traducir textos del checkout
    function translateCheckoutTexts() {
        // Traducir "Add coupons" a "Agregar cupones"
        const couponButtons = document.querySelectorAll('.wc-block-components-panel__button, .wc-block-components-totals-coupon .wc-block-components-panel__button');
        couponButtons.forEach(function(button) {
            if (button.textContent.includes('Add coupons') || button.textContent.includes('Add coupon')) {
                button.childNodes.forEach(function(child) {
                    if (child.nodeType === 3 && (child.textContent.includes('Add coupons') || child.textContent.includes('Add coupon'))) {
                        child.textContent = child.textContent.replace(/Add coupons?/g, 'Agregar cupones');
                    }
                });
            }
        });

        // Traducir otros textos comunes del checkout
        const translations = {
            'Place Order': 'Finalizar pedido',
            'Place order': 'Finalizar pedido',
            'Proceed to Checkout': 'Proceder al pago',
            'Apply coupon': 'Aplicar cupón',
            'Apply': 'Aplicar',
            'Remove coupon': 'Eliminar cupón',
            'Coupon code': 'Código de cupón',
            'Enter coupon code': 'Ingresa el código del cupón',
            'Billing details': 'Detalles de facturación',
            'Shipping details': 'Detalles de envío',
            'Additional information': 'Información adicional',
            'Order notes': 'Notas del pedido',
            'Your order': 'Tu pedido',
            'Product': 'Producto',
            'Subtotal': 'Subtotal',
            'Total': 'Total',
            'Shipping': 'Envío',
            'Payment method': 'Método de pago',
            'Payment methods': 'Métodos de pago'
        };

        // Aplicar traducciones
        Object.keys(translations).forEach(function(english) {
            const spanish = translations[english];
            
            // Buscar en todos los elementos de texto
            document.querySelectorAll('*').forEach(function(element) {
                // Solo traducir si el elemento no tiene hijos complejos
                if (element.childNodes.length === 1 && element.childNodes[0].nodeType === 3) {
                    const text = element.textContent.trim();
                    if (text === english) {
                        element.textContent = spanish;
                    }
                }
            });
        });

        // Traducir placeholders
        const placeholderTranslations = {
            'Coupon code': 'Código de cupón',
            'Enter your code': 'Ingresa tu código'
        };

        document.querySelectorAll('input[placeholder]').forEach(function(input) {
            const placeholder = input.getAttribute('placeholder');
            if (placeholderTranslations[placeholder]) {
                input.setAttribute('placeholder', placeholderTranslations[placeholder]);
            }
        });
    }

    // Ejecutar traducción inicial
    translateCheckoutTexts();

    // Observer para cambios dinámicos
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) {
                    // Traducir textos en nodos nuevos
                    translateCheckoutTexts();

                    // Actualizar label y placeholder para "Dirección, incluido número exterior e interior"
                    const shippingAddress1Label = node.querySelector('label[for="billing-address_1"]') || node.closest('.wc-block-components-text-input')?.querySelector('label[for="billing-address_1"]');
                    const shippingAddress1Input = node.querySelector('#billing-address_1') || node.closest('.wc-block-components-text-input')?.querySelector('#billing-address_1');
                    
                    if (shippingAddress1Label) {
                        shippingAddress1Label.textContent = 'Dirección, incluido número exterior e interior';
                    }

                    if (shippingAddress1Input) {
                        shippingAddress1Input.setAttribute('aria-label', 'Dirección, incluido número exterior e interior');
                    }

                    // Actualizar label y placeholder para "Ingresa tu colonia y Municipio/delegación"
                    const shippingAddress2Label = node.querySelector('label[for="billing-address_2"]') || node.closest('.wc-block-components-text-input')?.querySelector('label[for="billing-address_2"]');
                    const shippingAddress2Input = node.querySelector('#billing-address_2') || node.closest('.wc-block-components-text-input')?.querySelector('#billing-address_2');
                    
                    if (shippingAddress2Label) {
                        shippingAddress2Label.textContent = 'Ingresa tu colonia y Municipio/delegación';
                    }

                    if (shippingAddress2Input) {
                        shippingAddress2Input.setAttribute('aria-label', 'Ingresa tu colonia y Municipio/delegación');
                    }
                }
            });
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Ejecutar traducción cada 500ms por los primeros 3 segundos (por si acaso)
    let attempts = 0;
    const maxAttempts = 6;
    const intervalId = setInterval(function() {
        translateCheckoutTexts();
        attempts++;
        if (attempts >= maxAttempts) {
            clearInterval(intervalId);
        }
    }, 500);
});
</script>






<?php get_footer(); ?>

