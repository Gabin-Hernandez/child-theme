<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herramientas Eléctricas - ITOOLS MX</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                    <a href="/tienda.php" class="text-gray-600 hover:text-blue-600">Tienda</a>
                    <a href="#" class="text-blue-600 font-medium">Herramientas Eléctricas</a>
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

    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-3">
            <nav class="text-sm">
                <a href="/" class="text-gray-500 hover:text-blue-600">Inicio</a>
                <span class="mx-2 text-gray-400">/</span>
                <a href="/tienda.php" class="text-gray-500 hover:text-blue-600">Tienda</a>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-gray-900 font-medium">Herramientas Eléctricas</span>
            </nav>
        </div>
    </div>

    <!-- Category Hero -->
    <div class="bg-gradient-to-br from-yellow-500 to-orange-600 py-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    <i class="fas fa-bolt mr-3"></i>
                    Herramientas Eléctricas
                </h1>
                <p class="text-lg text-yellow-100 max-w-2xl mx-auto">
                    Potencia y precisión para tus proyectos más exigentes
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar -->
            <aside class="w-full lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Filtros</h3>
                    
                    <!-- Precio -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 mb-3">Precio</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                <span class="text-sm">$0 - $500</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                <span class="text-sm">$500 - $1,000</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                <span class="text-sm">$1,000 - $2,000</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                <span class="text-sm">Más de $2,000</span>
                            </label>
                        </div>
                    </div>

                    <!-- Marca -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 mb-3">Marca</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                <span class="text-sm">DeWalt</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                <span class="text-sm">Makita</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                <span class="text-sm">Bosch</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                <span class="text-sm">Milwaukee</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Categorías relacionadas -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Otras Categorías</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Herramientas Manuales</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Accesorios</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Refacciones</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Seguridad</a></li>
                    </ul>
                </div>
            </aside>

            <!-- Products Grid -->
            <main class="flex-1">
                <div class="bg-white p-6 rounded-2xl shadow-sm mb-6 border border-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-gray-900">8 Herramientas Eléctricas</h3>
                        <select class="px-4 py-2 border border-gray-300 rounded-lg">
                            <option>Ordenar por popularidad</option>
                            <option>Precio: menor a mayor</option>
                            <option>Precio: mayor a menor</option>
                            <option>Más vendidos</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8" id="products-grid">
                    
                    <!-- Taladro Inalámbrico -->
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-yellow-300">
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <div class="w-full h-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                                <i class="fas fa-drill text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-3 left-3">
                                <span class="bg-red-500 text-white px-2 py-1 rounded-md text-xs font-bold">-20%</span>
                            </div>
                            <div class="absolute top-3 right-3">
                                <span class="bg-yellow-500 text-white px-2 py-1 rounded-md text-xs font-bold">⭐</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Taladro Inalámbrico 20V MAX</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">(45)</span>
                            </div>
                            <div class="text-lg font-bold text-gray-900 mb-4">
                                <span class="text-red-600">$1,599</span>
                                <span class="text-sm text-gray-500 line-through ml-2">$1,999</span>
                            </div>
                            <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>

                    <!-- Sierra Circular -->
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-yellow-300">
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <i class="fas fa-saw-blade text-6xl text-white"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Sierra Circular 7 1/4" 15A</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="far fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">(32)</span>
                            </div>
                            <div class="text-lg font-bold text-gray-900 mb-4">$1,299</div>
                            <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>

                    <!-- Amoladora Angular -->
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-yellow-300">
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <div class="w-full h-full bg-gradient-to-br from-red-500 to-pink-600 flex items-center justify-center">
                                <i class="fas fa-compact-disc text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-3 left-3">
                                <span class="bg-green-500 text-white px-2 py-1 rounded-md text-xs font-bold">Nuevo</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Amoladora Angular 4 1/2"</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">(28)</span>
                            </div>
                            <div class="text-lg font-bold text-gray-900 mb-4">$899</div>
                            <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>

                    <!-- Lijadora Orbital -->
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-yellow-300">
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <div class="w-full h-full bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center">
                                <i class="fas fa-square text-6xl text-white"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Lijadora Orbital 1/4 Hoja</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="far fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">(19)</span>
                            </div>
                            <div class="text-lg font-bold text-gray-900 mb-4">$699</div>
                            <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>

                    <!-- Rotomartillo -->
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-yellow-300">
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center">
                                <i class="fas fa-hammer text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-3 left-3">
                                <span class="bg-red-500 text-white px-2 py-1 rounded-md text-xs font-bold">Oferta</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Rotomartillo SDS Plus 800W</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">(37)</span>
                            </div>
                            <div class="text-lg font-bold text-gray-900 mb-4">
                                <span class="text-red-600">$1,799</span>
                                <span class="text-sm text-gray-500 line-through ml-2">$2,199</span>
                            </div>
                            <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>

                    <!-- Caladora -->
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-yellow-300">
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <div class="w-full h-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                                <i class="fas fa-cut text-6xl text-white"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Caladora Variable 650W</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="far fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">(24)</span>
                            </div>
                            <div class="text-lg font-bold text-gray-900 mb-4">$799</div>
                            <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Paginación -->
                <div class="mt-12 flex justify-center">
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">Anterior</button>
                        <button class="px-4 py-2 bg-yellow-500 text-white rounded-lg">1</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">2</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">Siguiente</button>
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
                        this.style.background = '#EAB308';
                        this.textContent = 'Agregar al carrito';
                    }, 1500);
                });
            }
        });

        // Funcionalidad de filtros
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                console.log('Filtro aplicado:', this.nextElementSibling.textContent);
            });
        });
    </script>

</body>
</html>