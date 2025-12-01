<?php
/**
 * Template Name: Página de Sucursales
 */

defined( 'ABSPATH' ) || exit;

get_header();

$page_id    = get_queried_object_id();
$page_title = get_the_title( $page_id );
?>

<main class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600 py-16 md:py-24">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/20 via-indigo-900/10 to-purple-900/20"></div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center justify-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-6">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-white font-semibold">Visítanos</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight">
                    Nuestras Sucursales
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-8 leading-relaxed">
                    Encuentra la sucursal más cercana a ti
                </p>
            </div>
        </div>
    </section>

    <!-- Sucursales Section -->
    <section class="py-16 md:py-24">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <!-- Introducción -->
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Te esperamos en cualquiera de nuestras ubicaciones
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Contamos con 3 sucursales estratégicamente ubicadas para brindarte el mejor servicio
                    </p>
                </div>

                <!-- Grid de Sucursales -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    
                    <!-- Sucursal 1 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <!-- Imagen -->
                        <div class="h-48 bg-gradient-to-br from-blue-500 to-indigo-600 relative overflow-hidden">
                            <!-- Puedes reemplazar el gradiente con una imagen real -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white/30" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <!-- Si tienes una imagen, usa esto: -->
                            <!-- <img src="URL_DE_TU_IMAGEN" alt="Sucursal 1" class="w-full h-full object-cover"> -->
                            
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-4 py-2">
                                <span class="text-sm font-bold text-blue-600">Sucursal 1</span>
                            </div>
                        </div>
                        
                        <!-- Contenido -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                Centro
                            </h3>
                            
                            <div class="space-y-3 text-gray-600">
                                <p class="text-sm leading-relaxed">
                                    <strong class="text-gray-900">Dirección:</strong><br>
                                    Calle Principal #123<br>
                                    Colonia Centro<br>
                                    CP 00000, Ciudad
                                </p>
                                
                                <div class="pt-3 border-t border-gray-100">
                                    <p class="text-sm mb-2">
                                        <strong class="text-gray-900">Horario:</strong>
                                    </p>
                                    <p class="text-sm">
                                        Lun - Vie: 9:00 AM - 7:00 PM<br>
                                        Sábado: 9:00 AM - 6:00 PM<br>
                                        Domingo: Cerrado
                                    </p>
                                </div>
                                
                                <div class="pt-3 border-t border-gray-100">
                                    <p class="text-sm">
                                        <strong class="text-gray-900">Teléfono:</strong><br>
                                        <a href="tel:+525512345678" class="text-blue-600 hover:text-blue-700">
                                            (55) 1234-5678
                                        </a>
                                    </p>
                                </div>
                            </div>
                            
                            <a href="https://maps.google.com/?q=TU_DIRECCION_AQUI" target="_blank" rel="noopener noreferrer" class="mt-6 w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                Ver en Google Maps
                            </a>
                        </div>
                    </div>

                    <!-- Sucursal 2 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <!-- Imagen -->
                        <div class="h-48 bg-gradient-to-br from-indigo-500 to-purple-600 relative overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white/30" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <!-- Si tienes una imagen, usa esto: -->
                            <!-- <img src="URL_DE_TU_IMAGEN" alt="Sucursal 2" class="w-full h-full object-cover"> -->
                            
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-4 py-2">
                                <span class="text-sm font-bold text-indigo-600">Sucursal 2</span>
                            </div>
                        </div>
                        
                        <!-- Contenido -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                Norte
                            </h3>
                            
                            <div class="space-y-3 text-gray-600">
                                <p class="text-sm leading-relaxed">
                                    <strong class="text-gray-900">Dirección:</strong><br>
                                    Avenida Norte #456<br>
                                    Colonia Zona Norte<br>
                                    CP 00000, Ciudad
                                </p>
                                
                                <div class="pt-3 border-t border-gray-100">
                                    <p class="text-sm mb-2">
                                        <strong class="text-gray-900">Horario:</strong>
                                    </p>
                                    <p class="text-sm">
                                        Lun - Vie: 9:00 AM - 7:00 PM<br>
                                        Sábado: 9:00 AM - 6:00 PM<br>
                                        Domingo: Cerrado
                                    </p>
                                </div>
                                
                                <div class="pt-3 border-t border-gray-100">
                                    <p class="text-sm">
                                        <strong class="text-gray-900">Teléfono:</strong><br>
                                        <a href="tel:+525512345679" class="text-indigo-600 hover:text-indigo-700">
                                            (55) 1234-5679
                                        </a>
                                    </p>
                                </div>
                            </div>
                            
                            <a href="https://maps.google.com/?q=TU_DIRECCION_AQUI" target="_blank" rel="noopener noreferrer" class="mt-6 w-full inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                Ver en Google Maps
                            </a>
                        </div>
                    </div>

                    <!-- Sucursal 3 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <!-- Imagen -->
                        <div class="h-48 bg-gradient-to-br from-purple-500 to-pink-600 relative overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white/30" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <!-- Si tienes una imagen, usa esto: -->
                            <!-- <img src="URL_DE_TU_IMAGEN" alt="Sucursal 3" class="w-full h-full object-cover"> -->
                            
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-4 py-2">
                                <span class="text-sm font-bold text-purple-600">Sucursal 3</span>
                            </div>
                        </div>
                        
                        <!-- Contenido -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                Sur
                            </h3>
                            
                            <div class="space-y-3 text-gray-600">
                                <p class="text-sm leading-relaxed">
                                    <strong class="text-gray-900">Dirección:</strong><br>
                                    Boulevard Sur #789<br>
                                    Colonia Zona Sur<br>
                                    CP 00000, Ciudad
                                </p>
                                
                                <div class="pt-3 border-t border-gray-100">
                                    <p class="text-sm mb-2">
                                        <strong class="text-gray-900">Horario:</strong>
                                    </p>
                                    <p class="text-sm">
                                        Lun - Vie: 9:00 AM - 7:00 PM<br>
                                        Sábado: 9:00 AM - 6:00 PM<br>
                                        Domingo: Cerrado
                                    </p>
                                </div>
                                
                                <div class="pt-3 border-t border-gray-100">
                                    <p class="text-sm">
                                        <strong class="text-gray-900">Teléfono:</strong><br>
                                        <a href="tel:+525512345680" class="text-purple-600 hover:text-purple-700">
                                            (55) 1234-5680
                                        </a>
                                    </p>
                                </div>
                            </div>
                            
                            <a href="https://maps.google.com/?q=TU_DIRECCION_AQUI" target="_blank" rel="noopener noreferrer" class="mt-6 w-full inline-flex items-center justify-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                Ver en Google Maps
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Información Adicional -->
                <div class="bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl shadow-xl p-8 md:p-12 text-center text-white">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4">
                        ¿Necesitas ayuda para encontrarnos?
                    </h3>
                    <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                        Nuestro equipo está listo para asistirte. Contáctanos por WhatsApp o llámanos directamente.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="https://wa.me/525512345678" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-4 rounded-lg transition-colors duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Chatear por WhatsApp
                        </a>
                        <a href="tel:+525512345678" class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-semibold px-8 py-4 rounded-lg transition-colors duration-200 border-2 border-white/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Llamar ahora
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<style>
    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25% { transform: translate(20px, -50px) scale(1.1); }
        50% { transform: translate(-20px, 20px) scale(0.9); }
        75% { transform: translate(50px, 50px) scale(1.05); }
    }
    
    .animate-blob {
        animation: blob 7s infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>

<?php get_footer(); ?>
