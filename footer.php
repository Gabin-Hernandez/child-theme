        </div><!-- .col-full -->
    </div><!-- #content -->

    <?php
    /**
     * Functions hooked in to storefront_before_footer
     *
     * @hooked woocommerce_cross_sell_display - 10
     */
    do_action( 'storefront_before_footer' );
    ?>

    <footer id="colophon" class="site-footer bg-gray-900 text-white" role="contentinfo">
        <div class="container mx-auto px-4 py-12">
            
            <!-- Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                
                <!-- Información de la empresa -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-xl font-bold mb-4"><?php bloginfo( 'name' ); ?></h3>
                    <p class="text-gray-300 mb-4">
                        <?php 
                        $description = get_bloginfo( 'description' );
                        echo $description ? $description : 'Tu tienda online de confianza';
                        ?>
                    </p>
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="mb-4">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Enlaces rápidos -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Enlaces Rápidos</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="<?php echo home_url(); ?>" class="hover:text-white transition">Inicio</a></li>
                        <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
                        <li><a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="hover:text-white transition">Tienda</a></li>
                        <li><a href="<?php echo wc_get_page_permalink( 'cart' ); ?>" class="hover:text-white transition">Carrito</a></li>
                        <li><a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" class="hover:text-white transition">Mi Cuenta</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Contacto -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contacto</h4>
                    <div class="text-gray-300 space-y-2">
                        <p>Email: info@<?php echo str_replace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) ); ?></p>
                        <p>Teléfono: +52 XXX XXX XXXX</p>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 pt-8 text-center text-gray-400">
                <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. Todos los derechos reservados.</p>
            </div>
        </div>

        <?php
        /**
         * Functions hooked in to storefront_footer
         *
         * @hooked storefront_footer_widgets - 10
         * @hooked storefront_credit - 20
         */
        // Comentamos la acción original para usar nuestro footer personalizado
        // do_action( 'storefront_footer' );
        ?>
    </footer><!-- #colophon -->

    <?php
    /**
     * Functions hooked in to storefront_after_footer
     */
    do_action( 'storefront_after_footer' );
    ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
