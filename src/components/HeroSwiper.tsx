import { useRef } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';
import { ChevronLeft, ChevronRight } from 'lucide-react';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';
import '../styles/hero-swiper.css';

interface Slide {
  id: number;
  title: string;
  description: string;
  image: string;
}

const slides: Slide[] = [
  {
    id: 1,
    title: "Refacciones Premium",
    description: "Stock completo de pantallas, baterías y componentes originales para todas las marcas.",
    image: "https://images.unsplash.com/photo-1604671801908-6f0c6a092c05?w=1920&q=80"
  },
  {
    id: 2,
    title: "Herramientas Profesionales",
    description: "Estaciones de soldadura, microscopios y herramientas de precisión para técnicos expertos.",
    image: "https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=1920&q=80"
  },
  {
    id: 3,
    title: "Pantallas LCD",
    description: "Amplio catálogo de displays originales para iPhone, Samsung, Huawei y Xiaomi.",
    image: "https://images.unsplash.com/photo-1556656793-08538906a9f8?w=1920&q=80"
  },
  {
    id: 4,
    title: "Soluciones Técnicas",
    description: "Más de 10 años respaldando a profesionales de la reparación en todo México.",
    image: "https://images.unsplash.com/photo-1621768216002-5ac171876625?w=1920&q=80"
  },
  {
    id: 5,
    title: "Garantía Certificada",
    description: "Productos con certificación CE y RoHS. Calidad garantizada en cada componente.",
    image: "https://images.unsplash.com/photo-1583394838336-acd977736f90?w=1920&q=80"
  },
  {
    id: 6,
    title: "Envíos Rápidos",
    description: "Distribución nacional con envíos inmediatos. Tu pedido en tiempo récord.",
    image: "https://images.unsplash.com/photo-1588508065123-287b28e013da?w=1920&q=80"
  }
];

export function HeroSwiper() {
  const prevRef = useRef<HTMLButtonElement>(null);
  const nextRef = useRef<HTMLButtonElement>(null);

  return (
    <section className="hero-swiper-section">
      <div className="hero-swiper-container">
        {/* Custom Navigation Buttons */}
        <button
          ref={prevRef}
          className="hero-swiper-button-prev"
          aria-label="Previous slide"
        >
          <ChevronLeft className="h-6 w-6" />
        </button>
        <button
          ref={nextRef}
          className="hero-swiper-button-next"
          aria-label="Next slide"
        >
          <ChevronRight className="h-6 w-6" />
        </button>

        <Swiper
          modules={[Navigation, Pagination, Autoplay, EffectFade]}
          effect="fade"
          fadeEffect={{ crossFade: true }}
          speed={1000}
          navigation={{
            prevEl: prevRef.current,
            nextEl: nextRef.current,
          }}
          onBeforeInit={(swiper) => {
            if (typeof swiper.params.navigation !== 'boolean') {
              const navigation = swiper.params.navigation;
              if (navigation) {
                navigation.prevEl = prevRef.current;
                navigation.nextEl = nextRef.current;
              }
            }
          }}
          pagination={{
            clickable: true,
            bulletClass: 'hero-swiper-bullet',
            bulletActiveClass: 'hero-swiper-bullet-active',
          }}
          autoplay={{
            delay: 5000,
            disableOnInteraction: false,
          }}
          loop={true}
          className="hero-swiper"
        >
          {slides.map((slide) => (
            <SwiperSlide key={slide.id}>
              <div className="hero-slide">
                {/* Background Image */}
                <div
                  className="hero-slide-bg"
                  style={{ backgroundImage: `url(${slide.image})` }}
                />
                
                {/* Dark Overlay */}
                <div className="hero-slide-overlay" />
                
                {/* Content */}
                <div className="hero-slide-content">
                  <div className="container">
                    <div className="hero-slide-text">
                      <h1 className="hero-slide-title">
                        {slide.title}
                      </h1>
                      <p className="hero-slide-description">
                        {slide.description}
                      </p>
                      <div className="hero-slide-actions">
                        <a
                          href="https://itoolsmx.com/tienda/"
                          className="hero-slide-button hero-slide-button-primary"
                        >
                          Ver Catálogo
                        </a>
                        <a
                          href="https://itoolsmx.com/ofertas/"
                          className="hero-slide-button hero-slide-button-secondary"
                        >
                          Ofertas
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </SwiperSlide>
          ))}
        </Swiper>
      </div>
    </section>
  );
}
