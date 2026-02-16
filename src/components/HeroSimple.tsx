import { useState, useEffect } from 'react';
import { ChevronLeft, ChevronRight } from 'lucide-react';

interface Slide {
  id: number;
  title: string;
  description: string;
  image: string;
}

const slides: Slide[] = [
  {
    id: 1,
    title: 'Refacciones y Accesorios',
    description: 'Pantallas, baterías, carcasas, flex y accesorios originales. Todo lo que necesitas para tu smartphone.',
    image: 'https://cdn.thewirecutter.com/wp-content/media/2024/10/BEST-IPHONE-16-CASES-2048px-4833-2x1-1.jpg?width=2048&quality=75&crop=2:1&auto=webp'
  },
  {
    id: 2,
    title: 'Herramientas de Precisión',
    description: 'Kits profesionales de destornilladores, pinzas y palancas para reparación de smartphones.',
    image: '/wp-content/themes/storefront-child/images/master-uses-special-tools-disassemble-electronic-device-carefully-pincers-bit-screw-driver.jpg'
  },
  {
    id: 3,
    title: 'Estaciones de Soldadura',
    description: 'Equipos profesionales para microelectrónica. Control de temperatura digital y precisión milimétrica.',
    image: '/wp-content/themes/storefront-child/images/close-up-man-soldering-computer-circuit-workshop.jpg'
  },
  {
    id: 4,
    title: 'Insumos y Consumibles',
    description: 'Flux, pasta térmica, alcohol isopropílico y adhesivos profesionales. Todo lo necesario para tu taller.',
    image: '/wp-content/themes/storefront-child/images/master-making-crafts-with-glue.jpg'
  }
];

export function HeroSimple() {
  const [currentSlide, setCurrentSlide] = useState(0);
  const [isAutoPlaying, setIsAutoPlaying] = useState(true);

  useEffect(() => {
    if (!isAutoPlaying) return;

    const interval = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % slides.length);
    }, 5000);

    return () => clearInterval(interval);
  }, [isAutoPlaying]);

  const goToSlide = (index: number) => {
    setCurrentSlide(index);
    setIsAutoPlaying(false);
  };

  const nextSlide = () => {
    setCurrentSlide((prev) => (prev + 1) % slides.length);
    setIsAutoPlaying(false);
  };

  const prevSlide = () => {
    setCurrentSlide((prev) => (prev - 1 + slides.length) % slides.length);
    setIsAutoPlaying(false);
  };

  return (
    <section id="hero-slider" className="relative w-full h-[70vh] overflow-hidden bg-black">
      {/* Background Images */}
      {slides.map((slide, index) => (
        <div
          key={slide.id}
          className={`absolute inset-0 transition-opacity duration-1000 ${
            index === currentSlide ? 'opacity-100' : 'opacity-0'
          }`}
        >
          <img
            src={slide.image}
            alt={slide.title}
            className="w-full h-full object-cover"
            loading={index === 0 ? 'eager' : 'lazy'}
          />
          <div className="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent" />
        </div>
      ))}

      {/* Counter */}
      <div className="absolute top-8 left-8 z-20 flex items-center gap-2 text-white">
        <span className="text-lg font-light font-mono">
          {String(currentSlide + 1).padStart(2, '0')}
        </span>
        <span className="text-white/50">/</span>
        <span className="text-lg font-light font-mono text-white/70">
          {String(slides.length).padStart(2, '0')}
        </span>
      </div>

      {/* Content */}
      <div className="absolute bottom-[20%] md:bottom-[25%] left-4 right-4 md:left-8 md:right-auto z-20 max-w-2xl">
        <div className="space-y-3 md:space-y-4">
          {slides.map((slide, index) => (
            <div
              key={slide.id}
              className={`transition-all duration-700 ${
                index === currentSlide
                  ? 'opacity-100 translate-y-0'
                  : 'opacity-0 translate-y-4 absolute pointer-events-none'
              }`}
            >
              <h1 className="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-light uppercase tracking-tight leading-tight text-white mb-3 md:mb-4" 
                  style={{ textShadow: '0 4px 20px rgba(0,0,0,0.9), 0 8px 40px rgba(0,0,0,0.7)' }}>
                {slide.title}
              </h1>
              <p className="text-sm sm:text-base md:text-lg leading-relaxed text-white/95 max-w-xl bg-black/30 backdrop-blur-sm px-3 py-2 md:px-4 md:py-3 rounded-lg"
                 style={{ textShadow: '0 2px 10px rgba(0,0,0,0.9)' }}>
                {slide.description}
              </p>
            </div>
          ))}
        </div>
      </div>

      {/* Navigation Dots - Bottom Center */}
      <div className="absolute bottom-8 left-0 right-0 z-20 flex items-center justify-center gap-4 md:gap-6 px-4">
        {slides.map((slide, index) => (
          <button
            key={slide.id}
            onClick={() => goToSlide(index)}
            className="group flex flex-col items-center gap-2 transition-all hover:scale-110 outline-none focus:outline-none focus-visible:outline-none"
          >
            {/* Progress Bar */}
            <div className="relative w-12 md:w-16 h-0.5 bg-white/20 rounded-full overflow-hidden">
              <div
                className={`absolute inset-y-0 left-0 bg-white rounded-full transition-all duration-300 ${
                  index === currentSlide ? 'w-full' : 'w-0'
                }`}
                style={{
                  transition: index === currentSlide && isAutoPlaying ? 'width 5s linear' : 'width 0.3s ease'
                }}
              />
            </div>
            {/* Label */}
            <span
              className={`hidden text-xs uppercase tracking-wider transition-all whitespace-nowrap ${
                index === currentSlide
                  ? 'text-white opacity-100'
                  : 'text-white/50 opacity-70 group-hover:opacity-100'
              }`}
              style={{ textShadow: '0 2px 8px rgba(0,0,0,0.9)' }}
            >
              {slide.title}
            </span>
          </button>
        ))}
      </div>

      {/* Navigation Arrows - Mobile */}
      <div className="hidden absolute bottom-32 left-1/2 -translate-x-1/2 z-20 flex items-center gap-4 md:hidden">
        <button
          onClick={prevSlide}
          className="p-3 rounded-full bg-white/10 backdrop-blur-sm text-white hover:bg-white/20 transition-all outline-none focus:outline-none active:scale-95"
          aria-label="Previous slide"
        >
          <ChevronLeft className="w-6 h-6" />
        </button>
        <button
          onClick={nextSlide}
          className="p-3 rounded-full bg-white/10 backdrop-blur-sm text-white hover:bg-white/20 transition-all outline-none focus:outline-none active:scale-95"
          aria-label="Next slide"
        >
          <ChevronRight className="w-6 h-6" />
        </button>
      </div>
    </section>
  );
}
