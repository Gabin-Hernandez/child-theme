import { useEffect, useState, useRef } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import { ChevronLeft, ChevronRight } from 'lucide-react';
import { Button } from '@/components/ui/button';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

interface Product {
  id: number;
  name: string;
  price: string;
  regular_price: string;
  sale_price: string;
  images: Array<{ src: string; alt: string }>;
  permalink: string;
  on_sale: boolean;
}

interface ProductCarouselProps {
  className?: string;
}

export const ProductCarousel = ({ className }: ProductCarouselProps) => {
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(false);
  const prevRef = useRef<HTMLButtonElement>(null);
  const nextRef = useRef<HTMLButtonElement>(null);

  useEffect(() => {
    // Fetch products from WooCommerce REST API
    const fetchProducts = async () => {
      try {
        // Using Store API which doesn't require authentication
        // Fetch more products to account for filtering
        const response = await fetch('/wp-json/wc/store/v1/products?per_page=20&orderby=popularity');
        
        if (!response.ok) {
          throw new Error('Failed to fetch products');
        }
        
        const data = await response.json();
        
        // Transform Store API format to match our interface
        const transformedProducts = data
          .filter((item: any) => {
            // Only include products with real images (not placeholders)
            return item.images && 
                   item.images.length > 0 && 
                   item.images[0].src && 
                   !item.images[0].src.includes('woocommerce-placeholder') &&
                   !item.images[0].src.includes('placeholder.png');
          })
          .map((item: any) => ({
            id: item.id,
            name: item.name,
            price: item.prices?.price || '0',
            regular_price: item.prices?.regular_price || '0',
            sale_price: item.prices?.sale_price || item.prices?.price || '0',
            images: item.images.map((img: any) => ({ src: img.src, alt: img.alt || item.name })),
            permalink: item.permalink || '#',
            on_sale: item.prices?.price !== item.prices?.regular_price,
          }))
          .slice(0, 10); // Only take top 10 after filtering
        
        setProducts(transformedProducts);
      } catch (error) {
        console.error('Error fetching products:', error);
        setError(true);
      } finally {
        setLoading(false);
      }
    };

    fetchProducts();
  }, []);

  if (loading) {
    return (
      <section className={`py-16 md:py-24 ${className}`}>
        <div className="container">
          <div className="text-center">
            <div className="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent"></div>
          </div>
        </div>
      </section>
    );
  }

  if (error || products.length === 0) {
    return (
      <section className={`py-16 md:py-24 bg-background ${className}`}>
        <div className="container">
          <div className="mb-12 text-center">
            <h2 className="text-3xl font-bold tracking-tight md:text-4xl lg:text-5xl">
              Productos Destacados
            </h2>
            <p className="mt-4 text-muted-foreground md:text-lg max-w-2xl mx-auto">
              {error ? 'Error al cargar productos. Por favor, intenta más tarde.' : 'No hay productos disponibles en este momento.'}
            </p>
          </div>
        </div>
      </section>
    );
  }

  return (
    <section className={`pt-16 md:pt-24 bg-background ${className}`}>
      <div className="container">
        {/* Header */}
        <div className="mb-12 flex items-center justify-between">
          <h2 className="text-3xl font-bold tracking-tight md:text-4xl lg:text-5xl">
            Top 10 Más Vendidos
          </h2>
          <Button asChild className="uppercase text-xs tracking-wider bg-black text-white hover:bg-black/90">
            <a href="/tienda">Ver Todos</a>
          </Button>
        </div>

        {/* Carousel Container */}
        <div className="relative">
          {/* Custom Navigation Buttons */}
          <button
            ref={prevRef}
            className="swiper-button-prev-custom absolute left-0 top-1/2 -translate-y-1/2 z-10 flex h-12 w-12 items-center justify-center rounded-full bg-white shadow-lg transition-all hover:bg-black hover:text-white disabled:opacity-30 -ml-6"
            aria-label="Previous slide"
          >
            <ChevronLeft className="h-6 w-6" />
          </button>
          <button
            ref={nextRef}
            className="swiper-button-next-custom absolute right-0 top-1/2 -translate-y-1/2 z-10 flex h-12 w-12 items-center justify-center rounded-full bg-white shadow-lg transition-all hover:bg-black hover:text-white disabled:opacity-30 -mr-6"
            aria-label="Next slide"
          >
            <ChevronRight className="h-6 w-6" />
          </button>

          {/* Swiper Carousel */}
          <Swiper
          modules={[Navigation, Pagination, Autoplay]}
          spaceBetween={24}
          slidesPerView={1}
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
          pagination={{ clickable: true }}
          autoplay={{ delay: 3500, disableOnInteraction: false }}
          breakpoints={{
            640: { slidesPerView: 2 },
            768: { slidesPerView: 3 },
            1024: { slidesPerView: 4 },
          }}
          className="!pb-14"
        >
          {products.map((product) => (
            <SwiperSlide key={product.id}>
              <div className="group relative">
                {/* Product Image */}
                <a href={product.permalink} className="block relative aspect-square overflow-hidden bg-muted/30 mb-4">
                  <img
                    src={product.images[0]?.src || '/placeholder.jpg'}
                    alt={product.images[0]?.alt || product.name}
                    className="h-full w-full object-cover transition-all duration-500 group-hover:scale-110"
                  />
                  
                  {/* Sale Badge */}
                  {product.on_sale && (
                    <div className="absolute top-4 left-4 bg-black text-white px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider">
                      OFERTA
                    </div>
                  )}
                  
                  {/* Hover Overlay */}
                  <div className="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                </a>

                {/* Product Info */}
                <div className="space-y-2">
                  <a href={product.permalink} className="block">
                    <h3 className="line-clamp-2 text-sm uppercase tracking-wide text-foreground/90 group-hover:text-foreground transition-colors font-medium leading-tight min-h-[2.5rem]">
                      {product.name}
                    </h3>
                  </a>

                  {/* Price */}
                  <div className="flex items-baseline gap-2">
                    {product.on_sale && product.regular_price ? (
                      <>
                        <span className="text-base font-semibold text-foreground">
                          ${(parseFloat(product.sale_price) / 100).toFixed(2)}
                        </span>
                        <span className="text-xs text-muted-foreground line-through">
                          ${(parseFloat(product.regular_price) / 100).toFixed(2)}
                        </span>
                      </>
                    ) : (
                      <span className="text-base font-semibold text-foreground">
                        ${(parseFloat(product.price) / 100).toFixed(2)}
                      </span>
                    )}
                  </div>

                  {/* Add to Cart Button - Hidden by default, shows on hover */}
                  <div className="opacity-0 group-hover:opacity-100 transition-opacity duration-300 pt-2">
                    <Button asChild size="sm" variant="outline" className="w-full text-xs uppercase tracking-wider">
                      <a href={product.permalink} className="inline-flex items-center justify-center gap-2">
                        Ver Detalles
                      </a>
                    </Button>
                  </div>
                </div>
              </div>
            </SwiperSlide>
          ))}
        </Swiper>
        </div>
      </div>
    </section>
  );
};
