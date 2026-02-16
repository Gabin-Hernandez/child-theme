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

interface ToolsGridProps {
  title?: string;
  subcategory?: string; // Subcategoría específica de herramientas (opcional)
  productsPerPage?: number; // Número de productos a mostrar (default: 16 para 4x4)
  className?: string;
  bgColor?: 'white' | 'gray'; // Color de fondo
}

export const ToolsGrid = ({ 
  title = 'Herramientas Profesionales',
  subcategory,
  productsPerPage = 16,
  className,
  bgColor = 'white'
}: ToolsGridProps) => {
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(false);

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        // Build API URL - fetch from herramientas category
        let apiUrl = '/wp-json/wc/store/v1/products?per_page=100&category=herramientas&orderby=popularity';
        
        // If subcategory is specified, filter by that
        if (subcategory) {
          apiUrl = `/wp-json/wc/store/v1/products?per_page=100&category=${subcategory}&orderby=popularity`;
        }
        
        const response = await fetch(apiUrl);
        
        if (!response.ok) {
          throw new Error('Failed to fetch products');
        }
        
        const data = await response.json();
        
        // Filter and validate products
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
          .slice(0, productsPerPage) // Take specified number of products
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
  }, [subcategory, productsPerPage]);

  if (loading) {
    return (
      <section className={`py-16 md:py-20 ${bgColor === 'gray' ? 'bg-gray-50' : 'bg-background'} ${className}`}>
        <div className="container max-w-[1600px]">
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
    <section className={`py-16 md:py-20 ${bgColor === 'gray' ? 'bg-gray-50' : 'bg-background'} ${className}`}>
      <div className="container max-w-[1600px]">
        {/* Header */}
        <div className="mb-12 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
          <div>
            <h2 className="text-3xl font-bold tracking-tight md:text-4xl lg:text-5xl uppercase mb-2">
              {title}
            </h2>
            <p className="text-muted-foreground text-sm md:text-base">
              Las mejores herramientas para profesionales exigentes
            </p>
          </div>
          <Button asChild className="uppercase text-xs tracking-wider bg-black text-white hover:bg-black/90 whitespace-nowrap">
            <a href="/categoria-producto/herramientas">Ver Todo</a>
          </Button>
        </div>

        {/* Products Grid - 4x4 */}
        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
          {products.map((product) => (
            <div key={product.id} className="group relative bg-white rounded-lg border border-gray-200 hover:border-black transition-all duration-300 overflow-hidden hover:shadow-xl">
              {/* Product Image */}
              <a href={product.permalink} className="block relative aspect-square overflow-hidden bg-gray-50">
                <img
                  src={product.images[0]?.src || '/placeholder.jpg'}
                  alt={product.images[0]?.alt || product.name}
                  className="h-full w-full object-cover transition-all duration-500 group-hover:scale-110"
                />
                
                {/* Sale Badge */}
                {product.on_sale && (
                  <div className="absolute top-3 left-3 bg-red-600 text-white px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded">
                    OFERTA
                  </div>
                )}
                
                {/* Hover Overlay */}
                <div className="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300"></div>
              </a>

              {/* Product Info */}
              <div className="p-4">
                <a href={product.permalink} className="block mb-3">
                  <h3 className="line-clamp-2 text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors leading-tight min-h-[2.5rem]">
                    {product.name}
                  </h3>
                </a>

                {/* Price */}
                <div className="flex items-baseline gap-2 mb-3">
                  {product.on_sale && product.regular_price ? (
                    <>
                      <span className="text-lg font-bold text-gray-900">
                        ${(parseFloat(product.sale_price) / 100).toFixed(2)}
                      </span>
                      <span className="text-sm text-gray-500 line-through">
                        ${(parseFloat(product.regular_price) / 100).toFixed(2)}
                      </span>
                    </>
                  ) : (
                    <span className="text-lg font-bold text-gray-900">
                      ${(parseFloat(product.price) / 100).toFixed(2)}
                    </span>
                  )}
                </div>

                {/* Add to Cart Button */}
                <Button 
                  asChild 
                  size="sm" 
                  className="w-full text-xs uppercase tracking-wider bg-blue-600 hover:bg-blue-700 text-white"
                >
                  <a href={product.permalink} className="inline-flex items-center justify-center">
                    <svg className="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Ver Detalles
                  </a>
                </Button>
              </div>
            </div>
          ))}
        </div>

        {/* Ver más productos link */}
        <div className="mt-12 text-center">
          <a 
            href="/categoria-producto/herramientas" 
            className="inline-flex items-center gap-2 text-sm font-semibold text-gray-900 hover:text-blue-600 transition-colors group"
          >
            Explorar más herramientas
            <svg className="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
          </a>
        </div>
      </div>
    </section>
  );
};
