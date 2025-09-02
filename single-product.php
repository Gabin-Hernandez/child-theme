<?php
/**
 * Página individual de producto - ITOOLS Rediseñado
 */

get_header(); ?>

<div class="bg-gray-50 min-h-screen">
    <?php while ( have_posts() ) : the_post(); ?>
    
    <?php
    global $product;
    if ( ! $product || ! $product instanceof WC_Product ) {
        $product = wc_get_product( get_the_ID() );
    }
    ?>
    
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-100">
        <div class="container mx-auto px-4 py-4">
            <?php if ( function_exists( 'woocommerce_breadcrumb' ) ) : ?>
                <?php woocommerce_breadcrumb( array(
                    'delimiter'   => '<svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>',
                    'wrap_before' => '<nav class="flex items-center text-sm text-gray-600" aria-label="Breadcrumb">',
                    'wrap_after'  => '</nav>',
                    'before'      => '<span class="flex items-center">',
                    'after'       => '</span>',
                    'home'        => 'Inicio',
                ) ); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            
            <!-- Galería de imágenes del producto -->
            <div class="product-images space-y-6">
                <div class="relative bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100">
                    <?php
                    /**
                     * Hook: woocommerce_before_single_product_summary.
                     */
                    do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                    
                    <!-- Badges del producto -->
                    <div class="absolute top-6 left-6 flex flex-col gap-3 z-10">
                        <?php if ( $product->is_on_sale() ) : ?>
                            <span class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-2xl text-sm font-bold shadow-lg">
                                <?php
                                if ( $product->get_type() === 'variable' ) {
                                    echo 'En Oferta';
                                } else {
                                    $regular_price = $product->get_regular_price();
                                    $sale_price = $product->get_sale_price();
                                    if ( $regular_price && $sale_price ) {
                                        $discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                                        echo '-' . $discount . '%';
                                    } else {
                                        echo 'Oferta';
                                    }
                                }
                                ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( $product->is_featured() ) : ?>
                            <span class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-4 py-2 rounded-2xl text-sm font-bold shadow-lg">
                                ⭐ Destacado
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( ! $product->is_in_stock() ) : ?>
                            <span class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-4 py-2 rounded-2xl text-sm font-bold shadow-lg">
                                Agotado
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Información adicional visual -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-2xl text-center border border-gray-100 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-sm font-semibold text-gray-900">Garantía</div>
                        <div class="text-xs text-gray-600">1 Año</div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-2xl text-center border border-gray-100 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="text-sm font-semibold text-gray-900">Envío</div>
                        <div class="text-xs text-gray-600">Gratis +$50</div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-2xl text-center border border-gray-100 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div class="text-sm font-semibold text-gray-900">Seguro</div>
                        <div class="text-xs text-gray-600">Compra protegida</div>
                    </div>
                </div>
            </div>

            <!-- Información del producto -->
            <div class="product-info">
                <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100">
                    <div class="summary entry-summary">
                        
                        <!-- Título y valoración -->
                        <div class="mb-6">
                            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                                <?php the_title(); ?>
                            </h1>
                            
                            <!-- Valoración y reseñas -->
                            <?php if ( $product->get_review_count() > 0 ) : ?>
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="flex items-center">
                                        <?php 
                                        $rating = $product->get_average_rating();
                                        for ( $i = 1; $i <= 5; $i++ ) :
                                        ?>
                                            <svg class="w-5 h-5 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-sm text-gray-600">
                                        <?php echo $rating; ?> (<?php echo $product->get_review_count(); ?> reseñas)
                                    </span>
                                </div>
                            <?php endif; ?>
                            
                            <!-- SKU -->
                            <?php if ( $product->get_sku() ) : ?>
                                <div class="text-sm text-gray-500 mb-4">
                                    <span class="font-medium">SKU:</span> <?php echo $product->get_sku(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Precio -->
                        <div class="mb-8">
                            <div class="text-4xl font-bold text-gray-900 mb-2">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                            
                            <?php if ( $product->is_on_sale() && $product->get_regular_price() ) : ?>
                                <div class="text-lg text-gray-500">
                                    Precio regular: <span class="line-through"><?php echo wc_price( $product->get_regular_price() ); ?></span>
                                    <span class="ml-2 text-green-600 font-semibold">
                                        Ahorras: <?php echo wc_price( $product->get_regular_price() - $product->get_sale_price() ); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Descripción corta -->
                        <?php if ( $product->get_short_description() ) : ?>
                            <div class="mb-8 p-6 bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl border border-blue-100">
                                <div class="text-gray-700 leading-relaxed">
                                    <?php echo $product->get_short_description(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        /**
                         * Hook: woocommerce_single_product_summary.
                         */
                        do_action( 'woocommerce_single_product_summary' );
                        ?>
                        
                        <!-- Botones de acción -->
                        <div class="flex flex-col sm:flex-row gap-4 mt-8">
                            <button class="wishlist-btn flex-shrink-0 w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-all duration-300 group">
                                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                            
                            <button class="share-btn flex-shrink-0 w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center hover:bg-blue-50 hover:text-blue-500 transition-all duration-300 group">
                                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Información de stock y disponibilidad -->
                        <div class="mt-8 p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-200">
                            <?php if ( $product->is_in_stock() ) : ?>
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="font-semibold text-green-800">En Stock</span>
                                </div>
                                
                                <?php if ( $product->get_stock_quantity() ) : ?>
                                    <div class="text-sm text-green-700">
                                        Disponible: <?php echo $product->get_stock_quantity(); ?> unidades
                                    </div>
                                <?php endif; ?>
                                
                                <div class="text-sm text-green-600 mt-2">
                                    ✓ Envío rápido disponible<br>
                                    ✓ Instalación disponible<br>
                                    ✓ Soporte técnico incluido
                                </div>
                            <?php else : ?>
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                    <span class="font-semibold text-red-800">Agotado</span>
                                </div>
                                <div class="text-sm text-red-600 mt-2">
                                    Notificaremos cuando esté disponible
                                </div>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Pestañas del producto con diseño moderno -->
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            
            <!-- Navegación de pestañas -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-8 py-4" aria-label="Tabs">
                    <button class="tab-btn active whitespace-nowrap py-3 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600" data-tab="description">
                        Descripción
                    </button>
                    <button class="tab-btn whitespace-nowrap py-3 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="additional">
                        Especificaciones
                    </button>
                    <button class="tab-btn whitespace-nowrap py-3 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="reviews">
                        Reseñas (<?php echo $product->get_review_count(); ?>)
                    </button>
                    <button class="tab-btn whitespace-nowrap py-3 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="shipping">
                        Envío y Devoluciones
                    </button>
                </nav>
            </div>
            
            <!-- Contenido de pestañas -->
            <div class="p-8">
                
                <!-- Descripción -->
                <div id="description" class="tab-content">
                    <div class="prose max-w-none">
                        <?php if ( $product->get_description() ) : ?>
                            <?php echo $product->get_description(); ?>
                        <?php else : ?>
                            <p class="text-gray-600">No hay descripción disponible para este producto.</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Especificaciones -->
                <div id="additional" class="tab-content hidden">
                    <?php 
                    $attributes = $product->get_attributes();
                    if ( ! empty( $attributes ) ) :
                    ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach ( $attributes as $attribute ) : ?>
                                <div class="bg-gray-50 p-6 rounded-2xl">
                                    <dt class="font-semibold text-gray-900 mb-2">
                                        <?php echo wc_attribute_label( $attribute->get_name() ); ?>
                                    </dt>
                                    <dd class="text-gray-700">
                                        <?php
                                        if ( $attribute->is_taxonomy() ) {
                                            $values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'names' ) );
                                            echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
                                        } else {
                                            echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( $attribute->get_options() ) ), $attribute, $attribute->get_options() );
                                        }
                                        ?>
                                    </dd>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p class="text-gray-600">No hay especificaciones adicionales para este producto.</p>
                    <?php endif; ?>
                </div>
                
                <!-- Reseñas -->
                <div id="reviews" class="tab-content hidden">
                    <?php
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    } else {
                        echo '<p class="text-gray-600">Las reseñas están deshabilitadas para este producto.</p>';
                    }
                    ?>
                </div>
                
                <!-- Envío y Devoluciones -->
                <div id="shipping" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Información de envío -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl">
                            <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Opciones de Envío
                            </h3>
                            <ul class="space-y-3 text-gray-700">
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                                    Envío gratis en pedidos superiores a $50
                                </li>
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                    Entrega estándar: 3-5 días hábiles
                                </li>
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                                    Entrega express: 1-2 días hábiles
                                </li>
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                    Recogida en tienda disponible
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Política de devoluciones -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl">
                            <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Devoluciones y Cambios
                            </h3>
                            <ul class="space-y-3 text-gray-700">
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                                    30 días para devoluciones
                                </li>
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                    Devolución gratuita en productos defectuosos
                                </li>
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                                    Reembolso completo o cambio
                                </li>
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                    Producto debe estar en condiciones originales
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos relacionados -->
        <div class="mt-16">
            <?php
            /**
             * Hook: woocommerce_after_single_product_summary.
             */
            do_action( 'woocommerce_after_single_product_summary' );
            ?>
        </div>

        <?php endwhile; ?>

    </div>
</div>

<!-- JavaScript para las pestañas -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remover clase active de todos los botones
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Agregar clase active al botón clickeado
            this.classList.add('active', 'border-blue-500', 'text-blue-600');
            this.classList.remove('border-transparent', 'text-gray-500');
            
            // Ocultar todos los contenidos
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            
            // Mostrar el contenido correspondiente
            const targetContent = document.getElementById(targetTab);
            if (targetContent) {
                targetContent.classList.remove('hidden');
            }
        });
    });
    
    // Funcionalidad de wishlist
    const wishlistBtn = document.querySelector('.wishlist-btn');
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', function() {
            const heart = this.querySelector('svg');
            const isActive = this.classList.contains('active');
            
            if (isActive) {
                this.classList.remove('active', 'bg-red-50', 'text-red-500');
                this.classList.add('bg-gray-100');
                heart.setAttribute('fill', 'none');
            } else {
                this.classList.add('active', 'bg-red-50', 'text-red-500');
                this.classList.remove('bg-gray-100');
                heart.setAttribute('fill', 'currentColor');
            }
            
            // Animación
            this.style.transform = 'scale(1.1)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    }
    
    // Funcionalidad de compartir
    const shareBtn = document.querySelector('.share-btn');
    if (shareBtn) {
        shareBtn.addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    url: window.location.href
                });
            } else {
                // Fallback para copiar al portapapeles
                navigator.clipboard.writeText(window.location.href).then(() => {
                    // Mostrar feedback
                    const originalText = this.innerHTML;
                    this.innerHTML = '<svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 2000);
                });
            }
        });
    }
});
</script>
