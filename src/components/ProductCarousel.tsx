import { useEffect, useState } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
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

  useEffect(() => {
    // Fetch products from WooCommerce REST API
    const fetchProducts = async () => {
      try {
        // Using Store API which doesn't require authentication
        const response = await fetch('/wp-json/wc/store/v1/products?per_page=12&orderby=popularity');
        
        if (!response.ok) {
          throw new Error('Failed to fetch products');
        }
        
        const data = await response.json();
        
        // Transform Store API format to match our interface
        const transformedProducts = data.map((item: any) => ({
          id: item.id,
          name: item.name,
          price: item.prices?.price || '0',
          regular_price: item.prices?.regular_price || '0',
          sale_price: item.prices?.sale_price || item.prices?.price || '0',
          images: item.images?.length > 0 ? item.images.map((img: any) => ({ src: img.src, alt: img.alt || item.name })) : [{ src: '/wp-content/uploads/woocommerce-placeholder.png', alt: item.name }],
          permalink: item.permalink || '#',
          on_sale: item.prices?.price !== item.prices?.regular_price,
        }));
        
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
    <section className={`py-16 md:py-24 bg-background ${className}`}>
      <div className="container">
        {/* Header */}
        <div className="mb-12 flex items-center justify-between">
          <h2 className="text-3xl font-bold tracking-tight md:text-4xl lg:text-5xl">
            Productos Destacados
          </h2>
          <Button asChild variant="outline" className="uppercase text-xs tracking-wider">
            <a href="/tienda">Ver Todos</a>
          </Button>
        </div>

        {/* Swiper Carousel */}
        <Swiper
          modules={[Navigation, Pagination, Autoplay]}
          spaceBetween={24}
          slidesPerView={1}
          navigation
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
    </section>
  );
};
