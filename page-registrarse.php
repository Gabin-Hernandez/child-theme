<?php
/**
 * Template Name: Página de Registro
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
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight">
                    <?php echo esc_html( $page_title ); ?>
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-8 leading-relaxed">
                    Únete a nuestra comunidad y disfruta de beneficios exclusivos
                </p>
                <div class="flex items-center justify-center gap-4 text-white/90">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-lg">Ofertas exclusivas para miembros</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-16 md:py-24">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Card Container -->
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                        <h2 class="text-2xl md:text-3xl font-bold text-white text-center">
                            Completa tu registro
                        </h2>
                        <p class="text-blue-100 text-center mt-2">
                            Solo te tomará unos minutos
                        </p>
                    </div>

                    <!-- Form Container -->
                    <div class="p-8 md:p-12">
                        <!-- 
                        ============================================
                        INSERTA AQUÍ TU FORMULARIO DE TALLY
                        ============================================
                        Ejemplo de embed de Tally:
                        
                        <iframe 
                            src="https://tally.so/embed/YOUR_FORM_ID?alignLeft=1&hideTitle=1&transparentBackground=1" 
                            width="100%" 
                            height="600" 
                            frameborder="0" 
                            marginheight="0" 
                            marginwidth="0" 
                            title="Formulario de Registro"
                            style="border: none;"
                        ></iframe>
                        
                        O usa el código de script que te proporciona Tally
                        ============================================
                        -->
                        
                        <div id="tally-form-container" class="min-h-[600px]">
                            <!-- El formulario de Tally irá aquí -->
                            <iframe data-tally-src="https://tally.so/embed/1AWNxp?alignLeft=1&hideTitle=1&transparentBackground=1&dynamicHeight=1" loading="lazy" width="100%" height="168" frameborder="0" marginheight="0" marginwidth="0" title="iToolsMx
"></iframe>
<script>var d=document,w="https://tally.so/widgets/embed.js",v=function(){"undefined"!=typeof Tally?Tally.loadEmbeds():d.querySelectorAll("iframe[data-tally-src]:not([src])").forEach((function(e){e.src=e.dataset.tallySrc}))};if("undefined"!=typeof Tally)v();else if(d.querySelector('script[src="'+w+'"]')==null){var s=d.createElement("script");s.src=w,s.onload=v,s.onerror=v,d.body.appendChild(s);}</script>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="bg-gray-50 px-8 py-6 border-t border-gray-100">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">Tus datos están seguros y protegidos</span>
                            </div>
                            <div class="text-sm text-gray-500">
                                ¿Ya tienes cuenta? <a href="<?php echo esc_url( home_url( '/mi-cuenta/' ) ); ?>" class="text-blue-600 hover:text-blue-700 font-semibold">Inicia sesión</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Benefits Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Ofertas Exclusivas</h3>
                        <p class="text-gray-600 text-sm">Acceso a descuentos especiales solo para miembros registrados</p>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 text-center">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Compra Rápida</h3>
                        <p class="text-gray-600 text-sm">Checkout acelerado con tus datos guardados de forma segura</p>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Notificaciones</h3>
                        <p class="text-gray-600 text-sm">Recibe alertas de nuevos productos y promociones especiales</p>
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
