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
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) {
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
});



</script>






<?php get_footer(); ?>

