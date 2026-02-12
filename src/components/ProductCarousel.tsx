import { Swiper, SwiperSlide } from 'swiper/react';
import { Pagination, Autoplay } from 'swiper/modules';
import { Button } from '@/components/ui/button';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

interface Brand {
  id: number;
  name: string;
  logo: string;
  permalink: string;
}

interface ProductCarouselProps {
  className?: string;
}

const brands: Brand[] = [
  {
    id: 1,
    name: 'Apple',
    logo: 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg',
    permalink: '/page-apple',
  },
  {
    id: 2,
    name: 'Samsung',
    logo: 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Samsung_old_logo_before_year_2015.svg/1280px-Samsung_old_logo_before_year_2015.svg.png',
    permalink: '/page-samsung',
  },
  {
    id: 3,
    name: 'Huawei',
    logo: 'https://upload.wikimedia.org/wikipedia/en/thumb/0/04/Huawei_Standard_logo.svg/1280px-Huawei_Standard_logo.svg.png',
    permalink: '/page-huawei',
  },
  {
    id: 4,
    name: 'Xiaomi',
    logo: 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Xiaomi_logo_%282021-%29.svg/500px-Xiaomi_logo_%282021-%29.svg.png',
    permalink: '/page-xiaomi',
  },
];

export const ProductCarousel = ({ className }: ProductCarouselProps) => {
  return (
    <section className={`pt-16 md:pt-24 bg-background ${className}`}>
      <div className="container">
        {/* Header */}
        <div className="mb-12 flex items-center justify-between">
          <h2 className="text-3xl font-bold tracking-tight md:text-4xl lg:text-5xl uppercase">
            Marcas Destacadas
          </h2>
          <Button asChild className="uppercase text-xs tracking-wider bg-black text-white hover:bg-black/90">
            <a href="/page-modelos">Ver Todas</a>
          </Button>
        </div>

        {/* Carousel Container */}
        <div className="relative">
          {/* Swiper Carousel */}
          <Swiper
          modules={[Pagination, Autoplay]}
          spaceBetween={24}
          slidesPerView={2}

          pagination={{ clickable: true }}
          autoplay={{ delay: 3500, disableOnInteraction: false }}
          breakpoints={{
            640: { slidesPerView: 2 },
            768: { slidesPerView: 3 },
            1024: { slidesPerView: 4 },
          }}
          className="!pb-14"
        >
          {brands.map((brand) => (
            <SwiperSlide key={brand.id}>
              <a 
                href={brand.permalink} 
                className="group block"
              >
                <div className="relative aspect-[4/3] overflow-hidden rounded-lg bg-white border border-border p-8 transition-all duration-300 hover:shadow-lg hover:border-black">
                  {/* Brand Logo */}
                  <div className="flex h-full items-center justify-center">
                    <img
                      src={brand.logo}
                      alt={`${brand.name} logo`}
                      className="h-auto w-full max-w-[70%] object-contain transition-all duration-500 group-hover:scale-110 filter grayscale-0"
                    />
                  </div>
                  
                  {/* Hover Overlay */}
                  <div className="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 rounded-lg"></div>
                </div>

                {/* Brand Name */}
                <div className="mt-4 text-center">
                  <h3 className="text-sm font-semibold uppercase tracking-wider text-foreground/80 group-hover:text-foreground transition-colors">
                    {brand.name}
                  </h3>
                </div>
              </a>
            </SwiperSlide>
          ))}
        </Swiper>
        </div>
      </div>
    </section>
  );
};
