/**
 * Hero Swiper Configuration
 * Configuración moderna del carrusel principal con efectos avanzados
 */

document.addEventListener('DOMContentLoaded', function() {
    // Verificar que Swiper esté disponible
    if (typeof Swiper === 'undefined') {
        console.error('Swiper.js no está cargado');
        return;
    }

    // Inicializar el Swiper del hero
    const heroSwiper = new Swiper('.hero-swiper', {
        // Configuración básica
        loop: true,
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        speed: 1000,
        
        // Efecto de transición
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        
        // Navegación
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        
        // Paginación
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: false,
            renderBullet: function (index, className) {
                return '<span class="' + className + '"></span>';
            },
        },
        
        // Configuración táctil
        touchRatio: 1,
        touchAngle: 45,
        grabCursor: true,
        
        // Configuración de teclado
        keyboard: {
            enabled: true,
            onlyInViewport: true,
        },
        
        // Configuración de mouse wheel
        mousewheel: {
            enabled: false,
        },
        
        // Configuración responsive
        breakpoints: {
            320: {
                spaceBetween: 0,
            },
            768: {
                spaceBetween: 0,
            },
            1024: {
                spaceBetween: 0,
            }
        },
        
        // Eventos
        on: {
            init: function() {
                console.log('Hero Swiper inicializado correctamente');
                // Asegurar que el primer slide tenga las animaciones activas
                this.slides[this.activeIndex].classList.add('swiper-slide-active');
            },
            
            slideChange: function() {
                // Resetear animaciones de todos los slides
                this.slides.forEach(slide => {
                    const content = slide.querySelector('.slide-content');
                    if (content) {
                        content.style.opacity = '0';
                        content.style.transform = 'translateY(50px)';
                    }
                });
                
                // Activar animaciones del slide actual después de un pequeño delay
                setTimeout(() => {
                    const activeSlide = this.slides[this.activeIndex];
                    const content = activeSlide.querySelector('.slide-content');
                    if (content) {
                        content.style.opacity = '1';
                        content.style.transform = 'translateY(0)';
                    }
                }, 100);
            },
            
            autoplayTimeLeft: function(s, time, progress) {
                // Opcional: mostrar progreso del autoplay
                // console.log('Tiempo restante:', time);
            },
            
            touchStart: function() {
                // Pausar autoplay al tocar
                this.autoplay.stop();
            },
            
            touchEnd: function() {
                // Reanudar autoplay después de tocar
                setTimeout(() => {
                    this.autoplay.start();
                }, 3000);
            }
        }
    });

    // Funciones adicionales para mejorar la experiencia
    
    // Pausar autoplay cuando la pestaña no está visible
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            heroSwiper.autoplay.stop();
        } else {
            heroSwiper.autoplay.start();
        }
    });
    
    // Pausar autoplay al hacer hover sobre el carrusel
    const swiperContainer = document.querySelector('.hero-swiper');
    if (swiperContainer) {
        swiperContainer.addEventListener('mouseenter', function() {
            heroSwiper.autoplay.stop();
        });
        
        swiperContainer.addEventListener('mouseleave', function() {
            heroSwiper.autoplay.start();
        });
    }
    
    // Función para ir a un slide específico (útil para enlaces externos)
    window.goToHeroSlide = function(index) {
        if (heroSwiper) {
            heroSwiper.slideTo(index);
        }
    };
    
    // Función para obtener el slide actual
    window.getCurrentHeroSlide = function() {
        return heroSwiper ? heroSwiper.activeIndex : 0;
    };
    
    // Optimización de rendimiento: reducir la frecuencia de animaciones en dispositivos lentos
    const isSlowDevice = navigator.hardwareConcurrency && navigator.hardwareConcurrency < 4;
    if (isSlowDevice) {
        // Reducir la velocidad de transición en dispositivos lentos
        heroSwiper.params.speed = 800;
        heroSwiper.update();
    }
    
    // Precargar imágenes del siguiente slide para mejorar la experiencia
    heroSwiper.on('slideChange', function() {
        const nextIndex = (this.activeIndex + 1) % this.slides.length;
        const nextSlide = this.slides[nextIndex];
        const nextImage = nextSlide.querySelector('img');
        
        if (nextImage && !nextImage.complete) {
            const img = new Image();
            img.src = nextImage.src;
        }
    });
    
    console.log('Hero Swiper configurado con éxito');
});