<?php
/**
 * Footer personalizado para ITOOLS
 */
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer custom-footer">
        <div class="footer-content">
            <div class="container">
                <div class="footer-sections">
                    <!-- Información de la empresa -->
                    <div class="footer-section">
                        <h3>ITOOLS</h3>
                        <p>Tu proveedor confiable de herramientas y maquinaria profesional.</p>
                        <div class="contact-info">
                            <p><strong>Teléfono:</strong> +52 (123) 456-7890</p>
                            <p><strong>Email:</strong> info@itoolsmx.com</p>
                        </div>
                    </div>

                    <!-- Enlaces útiles -->
                    <div class="footer-section">
                        <h3>Enlaces Útiles</h3>
                        <ul class="footer-menu">
                            <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>">Acerca de</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contacto</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/shipping' ) ); ?>">Envíos</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/returns' ) ); ?>">Devoluciones</a></li>
                        </ul>
                    </div>

                    <!-- Categorías -->
                    <div class="footer-section">
                        <h3>Categorías</h3>
                        <ul class="footer-menu">
                            <?php
                            $categories = itools_get_product_categories();
                            $count = 0;
                            foreach ( $categories as $category ) {
                                if ( $count >= 5 ) break; // Limitar a 5 categorías
                                
                                $category_link = function_exists( 'get_term_link' ) ? get_term_link( $category ) : '#';
                                if ( is_wp_error( $category_link ) ) {
                                    $category_link = '#';
                                }
                                
                                printf(
                                    '<li><a href="%s">%s</a></li>',
                                    esc_url( $category_link ),
                                    esc_html( $category->name )
                                );
                                $count++;
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div class="footer-section">
                        <h3>Newsletter</h3>
                        <p>Suscríbete para recibir ofertas y novedades.</p>
                        <form class="newsletter-form" action="#" method="post">
                            <input type="email" name="email" placeholder="Tu email" required>
                            <button type="submit" class="btn btn-primary">Suscribirse</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <p>&copy; <?php echo date( 'Y' ); ?> ITOOLS. Todos los derechos reservados.</p>
                    <div class="footer-links">
                        <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>">Política de Privacidad</a>
                        <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>">Términos y Condiciones</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<?php wp_footer(); ?>

</body>
</html>