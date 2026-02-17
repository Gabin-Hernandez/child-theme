import { useEffect, useState } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Pagination, Autoplay } from 'swiper/modules';
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

interface PopularProductsProps {
  className?: string;
}

export const PopularProducts = ({ className }: PopularProductsProps) => {
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(false);

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        // Fetch popular products sorted by popularity
        const response = await fetch('/wp-json/wc/store/v1/products?per_page=100&orderby=popularity&order=desc');
        
        if (!response.ok) {
          throw new Error('Failed to fetch products');
        }
        
        const data = await response.json();
        
        // Filter and validate products - get first 12 valid popular products
        const transformedProducts = data
          .filter((item: any) => {
            // Must have valid images
            const hasValidImage = item.images && 
                   item.images.length > 0 && 
                   item.images[0].src && 
                   !item.images[0].src.includes('woocommerce-placeholder') &&
                   !item.images[0].src.includes('placeholder.png');
            
            // Must have valid price (not 0)
            const hasValidPrice = item.prices?.price && 
                   parseFloat(item.prices.price) > 0;
            
            // Must have valid name (not too short or generic)
            const hasValidName = item.name && 
                   item.name.trim().length > 3 &&
                   !item.name.toLowerCase().includes('producto sin') &&
                   item.name.toLowerCase() !== 'producto';
            
            return hasValidImage && hasValidPrice && hasValidName;
          })
          .slice(0, 12) // Take first 12 valid products
          .map((item: any) => ({
            id: item.id,
            name: item.name,
            price: item.prices?.price || '0',
            regular_price: item.prices?.regular_price || '0',
            sale_price: item.prices?.sale_price || item.prices?.price || '0',
            images: item.images.map((img: any) => ({ src: img.src, alt: img.alt || item.name })),
            permalink: item.permalink || '#',
            on_sale: item.prices?.price !== item.prices?.regular_price,
          }));
        
        setProducts(transformedProducts);
      } catch (error) {
        console.error('Error fetching popular products:', error);
        setError(true);
      } finally {
        setLoading(false);
      }
    };

    fetchProducts();
  }, []);

  const formatPrice = (price: string) => {
    const numPrice = parseFloat(price);
    return new Intl.NumberFormat('es-MX', {
      style: 'currency',
      currency: 'MXN',
    }).format(numPrice);
  };

  if (error) {
    return null; // Silent fail
  }

  return (
    <section className={`py-16 md:py-24 bg-background ${className}`}>
      <div className="container">
        {/* Header */}
        <div className="mb-12 flex items-center justify-between">
          <h2 className="text-3xl font-bold tracking-tight md:text-4xl lg:text-5xl uppercase">
            Productos Más Populares
          </h2>
          <Button asChild className="uppercase text-xs tracking-wider bg-black text-white hover:bg-black/90">
            <a href="https://itoolsmx.com/tienda/">Ver Todos</a>
          </Button>
        </div>

        {/* Loading State */}
        {loading && (
          <div className="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">
            {[...Array(12)].map((_, i) => (
              <div key={i} className="animate-pulse">
                <div className="aspect-square bg-muted rounded-lg mb-3"></div>
                <div className="h-4 bg-muted rounded w-3/4 mb-2"></div>
                <div className="h-4 bg-muted rounded w-1/2"></div>
              </div>
            ))}
          </div>
        )}

        {/* Products Carousel */}
        {!loading && products.length > 0 && (
          <div className="relative">
            <Swiper
              modules={[Pagination, Autoplay]}
              spaceBetween={16}
              slidesPerView={2}
              pagination={{ clickable: true }}
              autoplay={{ delay: 4000, disableOnInteraction: false }}
              breakpoints={{
                480: { slidesPerView: 2, spaceBetween: 16 },
                640: { slidesPerView: 3, spaceBetween: 20 },
                768: { slidesPerView: 4, spaceBetween: 20 },
                1024: { slidesPerView: 5, spaceBetween: 24 },
                1280: { slidesPerView: 6, spaceBetween: 24 },
              }}
              className="!pb-14"
            >
              {products.map((product) => (
                <SwiperSlide key={product.id}>
                  <a 
                    href={product.permalink} 
                    className="group block"
                  >
                    {/* Product Card */}
                    <div className="relative overflow-hidden rounded-lg bg-white border border-border transition-all duration-300 hover:shadow-lg hover:border-black">
                      {/* Sale Badge */}
                      {product.on_sale && (
                        <div className="absolute top-2 right-2 z-10 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-md uppercase tracking-wider">
                          Oferta
                        </div>
                      )}

                      {/* Product Image */}
                      <div className="aspect-square overflow-hidden bg-gray-50">
                        <img
                          src={product.images[0]?.src}
                          alt={product.images[0]?.alt || product.name}
                          className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                          loading="lazy"
                        />
                      </div>

                      {/* Hover Overlay */}
                      <div className="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 rounded-lg pointer-events-none"></div>
                    </div>

                    {/* Product Info */}
                    <div className="mt-3 space-y-1">
                      <h3 className="text-sm font-medium text-foreground/90 group-hover:text-foreground transition-colors line-clamp-2 min-h-[2.5rem]">
                        {product.name}
                      </h3>
                      
                      <div className="flex items-center gap-2">
                        {product.on_sale ? (
                          <>
                            <span className="text-base font-bold text-red-600">
                              {formatPrice(product.sale_price)}
                            </span>
                            <span className="text-xs text-muted-foreground line-through">
                              {formatPrice(product.regular_price)}
                            </span>
                          </>
                        ) : (
                          <span className="text-base font-bold text-foreground">
                            {formatPrice(product.price)}
                          </span>
                        )}
                      </div>
                    </div>
                  </a>
                </SwiperSlide>
              ))}
            </Swiper>
          </div>
        )}

        {/* Empty State */}
        {!loading && products.length === 0 && (
          <div className="text-center py-12">
            <p className="text-muted-foreground">No hay productos disponibles en este momento.</p>
          </div>
        )}
      </div>
    </section>
  );
};
