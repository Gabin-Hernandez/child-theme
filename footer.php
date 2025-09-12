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
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-black"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23ffffff" fill-opacity="0.02"%3E%3Cpath d="M20 20c0 11.046-8.954 20-20 20v20h40V20H20z"/%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
        
        <div class="relative z-10">
            <!-- Newsletter CTA Section -->
            <section id="contacto" class="pt-16 pb-8 border-b border-gray-700/30">
                <div class="container mx-auto px-4 text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">¡Mantente actualizado!</h2>
                    <p class="text-gray-300 mb-8 max-w-2xl mx-auto">
                        Suscríbete a nuestro boletín y recibe ofertas exclusivas, nuevos productos y consejos profesionales
                    </p>
                    <div class="max-w-md mx-auto flex">
                        <input type="email" placeholder="Tu correo electrónico" 
                               class="flex-1 px-4 py-3 rounded-l-lg border-0 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <button class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-r-lg font-semibold transition duration-300">
                            Suscribirse
                        </button>
                    </div>
                </div>
            </section>

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
                                <a href="#" class="group">
                                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20 group-hover:bg-blue-600 group-hover:scale-110 transition-all duration-300">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                        </svg>
                                    </div>
                                </a>
                                <a href="#" class="group">
                                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20 group-hover:bg-blue-700 group-hover:scale-110 transition-all duration-300">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                        </svg>
                                    </div>
                                </a>
                                <a href="#" class="group">
                                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20 group-hover:bg-pink-600 group-hover:scale-110 transition-all duration-300">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.219-5.160 1.219-5.160s-.312-.623-.312-1.518c0-1.423.824-2.488 1.847-2.488.871 0 1.291.653 1.291 1.438 0 .877-.558 2.188-.846 3.398-.241 1.018.511 1.848 1.518 1.848 1.82 0 3.223-1.92 3.223-4.691 0-2.452-1.763-4.165-4.281-4.165-2.917 0-4.629 2.187-4.629 4.448 0 .881.336 1.825.754 2.339.083.101.095.189.071.292-.076.315-.245.994-.277 1.133-.043.183-.142.222-.326.134-1.249-.581-2.03-2.407-2.03-3.874 0-3.154 2.292-6.052 6.608-6.052 3.469 0 6.165 2.473 6.165 5.776 0 3.447-2.173 6.22-5.19 6.22-1.013 0-1.965-.525-2.291-1.148l-.623 2.378c-.226.869-.835 1.958-1.244 2.621.937.29 1.931.446 2.962.446 6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001 12.017.001z"/>
                                        </svg>
                                    </div>
                                </a>
                                <a href="#" class="group">
                                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20 group-hover:bg-green-600 group-hover:scale-110 transition-all duration-300">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
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
                                <a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Tienda
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Mi Cuenta
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo wc_get_page_permalink( 'cart' ); ?>" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Carrito
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
                                    <p class="text-gray-300">México, CDMX</p>
                                    <p class="text-gray-400 text-sm">Zona Metropolitana</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-5 h-5 text-blue-400">
                                    <svg fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-300">+52 55 1234 5678</p>
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
                                    <p class="text-gray-300">info@itoolsmx.com</p>
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
