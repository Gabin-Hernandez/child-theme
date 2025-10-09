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
    <div class="w-11/12 lg:w-10/12 mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar -->
            <aside class="w-full lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Categorías</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Herramientas Eléctricas</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Herramientas Manuales</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Accesorios</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Refacciones</a></li>
                    </ul>
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

                    <!-- Producto 4 -->
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-blue-300">
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <img src="https://via.placeholder.com/300x300/8B5CF6/FFFFFF?text=Sierra" alt="Sierra Circular" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Sierra Circular 7 1/4"</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="far fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">(12)</span>
                            </div>
                            <div class="text-lg font-bold text-gray-900 mb-4">$899</div>
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>

                    <!-- Producto 5 -->
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-blue-300">
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <img src="https://via.placeholder.com/300x300/EF4444/FFFFFF?text=Llave" alt="Juego de Llaves" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Juego de Llaves Combinadas</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">(27)</span>
                            </div>
                            <div class="text-lg font-bold text-gray-900 mb-4">$449</div>
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>

                    <!-- Producto 6 -->
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-blue-300">
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <img src="https://via.placeholder.com/300x300/06B6D4/FFFFFF?text=Nivel" alt="Nivel de Burbuja" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Nivel de Burbuja 24"</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="far fa-star text-xs"></i>
                                    <i class="far fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">(8)</span>
                            </div>
                            <div class="text-lg font-bold text-gray-900 mb-4">$149</div>
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>

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