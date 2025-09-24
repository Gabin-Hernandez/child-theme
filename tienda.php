<?php
// Incluir datos de prueba
include_once 'test-products.php';

// CSS para ocultar elementos de WooCommerce automáticos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda - ITOOLS MX</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Ocultar TODOS los elementos de ordenamiento de WooCommerce */
        .woocommerce-ordering,
        .storefront-sorting,
        form.woocommerce-ordering,
        .woocommerce-ordering *,
        .storefront-sorting *,
        div[class*="woocommerce-ordering"],
        div[class*="storefront-sorting"],
        .woocommerce .woocommerce-ordering,
        .woocommerce .storefront-sorting,
        #woocommerce_after_shop_loop .woocommerce-ordering,
        #woocommerce_after_shop_loop .storefront-sorting,
        .hookmeup-hook .woocommerce-ordering,
        .hookmeup-hook .storefront-sorting {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            height: 0 !important;
            width: 0 !important;
            overflow: hidden !important;
            position: absolute !important;
            left: -9999px !important;
        }
        
        /* Asegurar que solo nuestro select personalizado sea visible */
        .custom-ordering-select {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold text-blue-600">ITOOLS MX</h1>
                </div>
                <nav class="hidden md:flex space-x-6">
                    <a href="/" class="text-gray-600 hover:text-blue-600">Inicio</a>
                    <a href="/tienda/" class="text-blue-600 font-medium">Tienda</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Contacto</a>
                </nav>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <i class="fas fa-shopping-cart text-gray-600 text-xl"></i>
                        <span id="cart-count-badge" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 py-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Tienda de Herramientas
                </h1>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Encuentra las mejores herramientas profesionales para tus proyectos
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar -->
            <aside class="w-full lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Categorías</h3>
                    <ul class="space-y-2">
                        <?php
                        global $test_categories_data;
                        foreach ($test_categories_data as $category) {
                            $is_active = isset($_GET['product_cat']) && in_array($category['slug'], explode(',', $_GET['product_cat']));
                            $active_class = $is_active ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600';
                            echo '<li>';
                            echo '<label class="flex items-center justify-between cursor-pointer ' . $active_class . '">';
                            echo '<span class="flex items-center">';
                            echo '<input type="checkbox" class="category-filter mr-2" value="' . $category['slug'] . '" ' . ($is_active ? 'checked' : '') . '>';
                            echo $category['name'];
                            echo '</span>';
                            echo '<span class="text-sm text-gray-500">(' . $category['count'] . ')</span>';
                            echo '</label>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                    
                    <h3 class="text-lg font-bold text-gray-900 mb-4 mt-6">Marcas</h3>
                    <ul class="space-y-2">
                        <?php
                        global $test_brands_data;
                        foreach ($test_brands_data as $brand) {
                            $is_active = isset($_GET['product_brand']) && in_array($brand['slug'], explode(',', $_GET['product_brand']));
                            $active_class = $is_active ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600';
                            echo '<li>';
                            echo '<label class="flex items-center justify-between cursor-pointer ' . $active_class . '">';
                            echo '<span class="flex items-center">';
                            echo '<input type="checkbox" class="brand-filter mr-2" value="' . $brand['slug'] . '" ' . ($is_active ? 'checked' : '') . '>';
                            echo $brand['name'];
                            echo '</span>';
                            echo '<span class="text-sm text-gray-500">(' . $brand['count'] . ')</span>';
                            echo '</label>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                    
                    <div class="mt-6">
                        <button id="clear-filters" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                            Limpiar Filtros
                        </button>
                    </div>
                </div>
            </aside>

            <!-- Products Grid -->
            <main class="flex-1">
                <div class="bg-white p-6 rounded-2xl shadow-sm mb-6 border border-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-gray-900">12 Productos</h3>
                        <select class="custom-ordering-select px-4 py-2 border border-gray-300 rounded-lg">
                            <option>Ordenar por popularidad</option>
                            <option>Precio: menor a mayor</option>
                            <option>Precio: mayor a menor</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8" id="products-grid">
                    
                    <!-- Producto 1 -->
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-blue-300">
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <img src="https://via.placeholder.com/300x300/3B82F6/FFFFFF?text=Taladro" alt="Taladro Profesional" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute top-3 left-3">
                                <span class="bg-red-500 text-white px-2 py-1 rounded-md text-xs font-bold">Oferta</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Taladro Profesional 18V</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">(24)</span>
                            </div>
                            <div class="text-lg font-bold text-gray-900 mb-4">
                                <span class="text-red-600">$1,299</span>
                                <span class="text-sm text-gray-500 line-through ml-2">$1,599</span>
                            </div>
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>

                    <!-- Producto 2 -->
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-blue-300">
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <img src="https://via.placeholder.com/300x300/10B981/FFFFFF?text=Martillo" alt="Martillo de Acero" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Martillo de Acero Forjado</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="far fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">(18)</span>
                            </div>
                            <div class="text-lg font-bold text-gray-900 mb-4">$299</div>
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>

                    <!-- Producto 3 -->
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-blue-300">
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <img src="https://via.placeholder.com/300x300/F59E0B/FFFFFF?text=Destornillador" alt="Set de Destornilladores" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute top-3 left-3">
                                <span class="bg-yellow-500 text-white px-2 py-1 rounded-md text-xs font-bold">⭐</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Set de Destornilladores 12 Piezas</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">(31)</span>
                            </div>
                            <div class="text-lg font-bold text-gray-900 mb-4">$199</div>
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>

                <!-- Productos dinámicos basados en filtros -->
                <?php
                global $test_products_data, $test_categories_data, $test_brands_data;
                
                // Filtrar productos según parámetros URL
                $filtered_products = filter_test_products($test_products_data, $test_categories_data, $test_brands_data);
                
                if (!empty($filtered_products)) {
                    foreach ($filtered_products as $product) {
                        echo '<div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-blue-300">';
                        echo '<div class="relative overflow-hidden bg-gray-50 aspect-square">';
                        echo '<img src="' . $product['image'] . '" alt="' . $product['name'] . '" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">';
                        echo '</div>';
                        echo '<div class="p-4">';
                        echo '<h3 class="text-sm font-semibold text-gray-900 mb-2">' . $product['name'] . '</h3>';
                        echo '<div class="flex items-center gap-1 mb-3">';
                        echo '<div class="flex text-yellow-400">';
                        echo '<i class="fas fa-star text-xs"></i>';
                        echo '<i class="fas fa-star text-xs"></i>';
                        echo '<i class="fas fa-star text-xs"></i>';
                        echo '<i class="fas fa-star text-xs"></i>';
                        echo '<i class="far fa-star text-xs"></i>';
                        echo '</div>';
                        echo '<span class="text-xs text-gray-500">(15)</span>';
                        echo '</div>';
                        echo '<div class="text-lg font-bold text-gray-900 mb-4">$' . number_format($product['price'], 0) . '</div>';
                        echo '<button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">';
                        echo 'Agregar al carrito';
                        echo '</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-span-full text-center py-12">';
                    echo '<div class="text-gray-500 text-lg mb-4">';
                    echo '<i class="fas fa-search text-4xl mb-4"></i>';
                    echo '<p>No se encontraron productos que coincidan con los filtros seleccionados.</p>';
                    echo '<p class="text-sm mt-2">Intenta ajustar los filtros o buscar otros términos.</p>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>

                </div>



            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h3 class="text-2xl font-bold mb-4">ITOOLS MX</h3>
                <p class="text-gray-400 mb-6">Tu socio tecnológico de confianza</p>
                <div class="flex justify-center space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript para funcionalidad básica -->
    <script>
        // Funcionalidad de filtros
        function applyFilters() {
            const categoryFilters = Array.from(document.querySelectorAll('.category-filter:checked')).map(cb => cb.value);
            const brandFilters = Array.from(document.querySelectorAll('.brand-filter:checked')).map(cb => cb.value);
            
            // Construir URL sin parámetros WooCommerce para mantener tienda.php
            const baseUrl = window.location.origin + window.location.pathname;
            const url = new URL(baseUrl);
            
            // Agregar filtros de categoría (sin post_type para evitar archive-product.php)
            if (categoryFilters.length > 0) {
                url.searchParams.set('product_cat', categoryFilters.join(','));
            }
            
            // Agregar filtros de marca
            if (brandFilters.length > 0) {
                url.searchParams.set('product_brand', brandFilters.join(','));
            }
            
            // Redirigir con nuevos parámetros
            window.location.href = url.toString();
        }
        
        // Event listeners para filtros
        document.querySelectorAll('.category-filter, .brand-filter').forEach(checkbox => {
            checkbox.addEventListener('change', applyFilters);
        });
        
        // Limpiar filtros
        document.getElementById('clear-filters').addEventListener('click', function() {
            const baseUrl = window.location.origin + window.location.pathname;
            window.location.href = baseUrl;
        });
        
        // Simulación de agregar al carrito
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Agregar al carrito')) {
                button.addEventListener('click', function() {
                    const badge = document.getElementById('cart-count-badge');
                    let count = parseInt(badge.textContent) || 0;
                    count++;
                    badge.textContent = count;
                    badge.style.display = 'flex';
                    
                    // Animación del botón
                    this.style.background = '#10B981';
                    this.textContent = '¡Agregado!';
                    setTimeout(() => {
                        this.style.background = '#2563EB';
                        this.textContent = 'Agregar al carrito';
                    }, 1500);
                });
            }
        });
    </script>

</body>
</html>