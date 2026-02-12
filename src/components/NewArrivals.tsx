import { useEffect, useState } from 'react';
import { Button } from '@/components/ui/button';

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

interface NewArrivalsProps {
  className?: string;
}

export const NewArrivals = ({ className }: NewArrivalsProps) => {
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(false);

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        // Fetch most recent products sorted by creation date (descending)
        const response = await fetch('/wp-json/wc/store/v1/products?per_page=100&orderby=date&order=desc');
        
        if (!response.ok) {
          throw new Error('Failed to fetch products');
        }
        
        const data = await response.json();
        
        // Filter and validate products - get first 8 valid recent products
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
          .slice(0, 8) // Take first 8 valid products (these are the most recent)
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
    return null;
  }

  return (
    <section className={`py-16 md:py-24 bg-background ${className}`}>
      <div className="container">
        {/* Header */}
        <div className="mb-12 flex items-center justify-between">
          <h2 className="text-3xl font-bold tracking-tight md:text-4xl lg:text-5xl uppercase">
            Recién Llegados
          </h2>
          <Button asChild className="uppercase text-xs tracking-wider bg-black text-white hover:bg-black/90">
            <a href="/tienda">Ver Todos</a>
          </Button>
        </div>

        {/* Products Grid */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
          {products.map((product) => (
            <div key={product.id} className="group relative">
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
          ))}
        </div>
      </div>
    </section>
  );
};
