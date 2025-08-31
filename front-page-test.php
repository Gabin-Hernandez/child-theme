<?php
/**
 * Front Page - ITOOLS Child Theme
 * Versión Ultra Simple que FUNCIONA
 */

get_header(); 
?>

<!-- Contenido Principal -->
<main class="bg-gray-50 min-h-screen">
    
    <!-- Hero Section -->
    <section class="bg-blue-600 text-white py-20">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">ITOOLS México</h1>
            <p class="text-xl mb-8">Herramientas profesionales para técnicos expertos</p>
            <div class="space-x-4">
                <a href="<?php echo home_url('/tienda'); ?>" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">
                    Ver Catálogo
                </a>
                <a href="<?php echo home_url('/contacto'); ?>" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600">
                    Contacto
                </a>
            </div>
        </div>
    </section>

    <!-- Servicios -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Nuestros Servicios</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-gray-50 rounded-lg">
                    <h3 class="text-xl font-semibold mb-3">Herramientas Eléctricas</h3>
                    <p class="text-gray-600">Multímetros, probadores y equipos de medición profesional.</p>
                </div>
                
                <div class="text-center p-6 bg-gray-50 rounded-lg">
                    <h3 class="text-xl font-semibold mb-3">Electrónica Automotriz</h3>
                    <p class="text-gray-600">Scanner automotriz y herramientas de diagnóstico.</p>
                </div>
                
                <div class="text-center p-6 bg-gray-50 rounded-lg">
                    <h3 class="text-xl font-semibold mb-3">Comunicaciones</h3>
                    <p class="text-gray-600">Radios, antenas y equipos de comunicación profesional.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Test básico -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Sitio Web Funcionando Correctamente</h2>
            <p class="text-lg text-gray-600 mb-8">
                ✅ Tema hijo cargado<br>
                ✅ Tailwind CSS funcionando<br>
                ✅ Header personalizado activo<br>
                ✅ Front-page.php funcionando
            </p>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <strong>¡Éxito!</strong> El tema hijo está funcionando correctamente.
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
