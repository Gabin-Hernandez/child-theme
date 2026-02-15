</div><!-- #content -->

    <?php
    /**
     * Functions hooked in to storefront_before_footer
     *
     * @hooked woocommerce_cross_sell_display - 10
     */
    do_action( 'storefront_before_footer' );
    ?>

    <footer id="colophon" class="site-footer relative overflow-hidden" role="contentinfo">
        <!-- Background with gradient and pattern -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-blue-1000 to-slate-900 "></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23ffffff" fill-opacity="0.02"%3E%3Cpath d="M20 20c0 11.046-8.954 20-20 20v20h40V20H20z"/%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
        
        <div class="relative z-10">
            <!-- Main Footer Content -->
            <div class="container mx-auto px-4 py-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                    
                    <!-- Company Info -->
                    <div class="lg:col-span-2">
                        <div class="mb-6">
                            <?php if ( has_custom_logo() ) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <h3 class="text-2xl font-bold text-white"><?php bloginfo( 'name' ); ?></h3>
                            <?php endif; ?>
                        </div>
                        <p class="text-gray-300 mb-6 text-lg leading-relaxed">
                            <?php 
                            $description = get_bloginfo( 'description' );
                            echo $description ? $description : 'ITOOLS MX - Tu socio confiable en herramientas profesionales. Calidad garantizada, servicio excepcional y las mejores marcas del mercado.';
                            ?>
                        </p>
                        
                        <!-- Social Media -->
                        <div class="space-y-4">
                            <p class="text-white font-semibold">Síguenos</p>
                            <div class="flex space-x-4">
                                <a href="https://www.facebook.com/p/ITools-Mx-61550736645996/" target="_blank" rel="noopener noreferrer" class="group">
                                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20 group-hover:bg-blue-600 group-hover:scale-110 transition-all duration-300">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </div>
                                </a>
                                <a href="https://www.instagram.com/ipartsmovil/" target="_blank" rel="noopener noreferrer" class="group">
                                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20 group-hover:bg-pink-600 group-hover:scale-110 transition-all duration-300">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <p class="text-white font-semibold text-lg mb-6 relative">
                            Navegación
                            <div class="absolute -bottom-2 left-0 w-8 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></div>
                        </p>
                        <ul class="space-y-3">
                            <li>
                                <a href="<?php echo home_url(); ?>" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Inicio
                                </a>
                            </li>
                            <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
                            <li>
                                <a href="/tienda" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Tienda
                                </a>
                            </li>
                            <li>
                                <a href="/registrarse" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Registrarse
                                </a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Soporte
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <p class="text-white font-semibold text-lg mb-6 relative">
                            Contacto
                            <div class="absolute -bottom-2 left-0 w-8 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></div>
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="w-5 h-5 mt-1 text-blue-400">
                                    <svg fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-300">Calle Heron Ramirez #715 Col. Rodriguez en Reynosa Tamps</p>
                                    <p class="text-gray-400 text-sm"> Reynosa, Mexico</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-5 h-5 text-blue-400">
                                    <svg fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-300">899 145 0042</p>
                                    <p class="text-gray-400 text-sm">Lun - Vie 9:00 - 18:00</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-5 h-5 text-blue-400">
                                    <svg fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-300">itoolsmx05@gmail.com</p>
                                    <p class="text-gray-400 text-sm">Respuesta en 24hrs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700/50 backdrop-blur-sm">
                <div class="container mx-auto px-4 py-6">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <p class="text-gray-400 text-sm">
                            &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. Todos los derechos reservados.
                        </p>
                        <div class="flex space-x-6 text-sm">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Política de Privacidad</a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Términos de Servicio</a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Cookies</a>
                        </div>
                    </div>
                </div>
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

    <!-- Estilos adicionales para el footer -->
    <style>
        /* Forzar el fondo oscuro del footer */
        #colophon,
        .site-footer {
            background-color: rgb(17, 23, 41) !important;
        }
        
        /* Asegurar que todos los textos del footer sean blancos/grises */
        #colophon * {
            color: inherit !important;
        }
        
        #colophon a {
            color: #d1d5db !important; /* text-gray-300 */
            transition: color 0.3s ease !important;
        }
        
        #colophon a:hover {
            color: #ffffff !important; /* text-white */
        }
        
        #colophon .text-white {
            color: #ffffff !important;
        }
        
        #colophon .text-gray-300 {
            color: #d1d5db !important;
        }
        
        #colophon .text-gray-400 {
            color: #9ca3af !important;
        }
        
        /* Específicamente para los enlaces de navegación */
        #colophon ul li a {
            color: #d1d5db !important;
        }
        
        #colophon ul li a:hover {
            color: #ffffff !important;
        }
    </style>

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
