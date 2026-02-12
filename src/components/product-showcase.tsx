import { ShoppingCart } from "lucide-react";
import { useEffect, useState } from "react";

import { cn } from "@/lib/utils";

import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";

interface WooProduct {
  id: number;
  name: string;
  link: string;
  image: string;
  price: string;
  regular_price: string;
  sale_price: string;
  currency: string;
  on_sale: boolean;
  in_stock: boolean;
}

interface ProductShowcaseProps {
  className?: string;
}

const ProductShowcase = ({ className }: ProductShowcaseProps) => {
  const [herramientas, setHerramientas] = useState<WooProduct[]>([]);
  const [refacciones, setRefacciones] = useState<WooProduct[]>([]);

  useEffect(() => {
    const data = window.itoolsProducts || { herramientas: [], refacciones: [] };
    setHerramientas(data.herramientas || []);
    setRefacciones(data.refacciones || []);
  }, []);

  const handleAddToCart = (productId: number) => {
    // Usar la funcionalidad nativa de WooCommerce
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = window.location.href;
    
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'add-to-cart';
    input.value = productId.toString();
    
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
  };

  return (
    <section className={cn("py-12 md:py-16 bg-white", className)}>
      <div className="container max-w-7xl mx-auto px-4 sm:px-6">
        
        {/* Herramientas Section */}
        {herramientas.length > 0 && (
          <div className="mb-16">
            <div className="flex items-center justify-between mb-8">
              <div>
                <h2 className="text-2xl md:text-3xl font-bold text-slate-900">Herramientas</h2>
                <p className="text-slate-500 mt-1">Equipamiento profesional para técnicos</p>
              </div>
              <a 
                href="/?post_type=product&s=&product_cat=herramientas" 
                className="hidden sm:inline-flex items-center gap-1 text-amber-600 hover:text-amber-700 font-semibold text-sm transition-colors"
              >
                Ver todo
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"/>
                </svg>
              </a>
            </div>

            <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
              {herramientas.slice(0, 8).map((product) => (
                <ProductCard key={product.id} product={product} onAddToCart={handleAddToCart} />
              ))}
            </div>
          </div>
        )}

        {/* Refacciones Section */}
        {refacciones.length > 0 && (
          <div>
            <div className="flex items-center justify-between mb-8">
              <div>
                <h2 className="text-2xl md:text-3xl font-bold text-slate-900">Refacciones</h2>
                <p className="text-slate-500 mt-1">Componentes originales y compatibles</p>
              </div>
              <a 
                href="/?post_type=product&s=&product_cat=refacciones" 
                className="hidden sm:inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 font-semibold text-sm transition-colors"
              >
                Ver todo
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"/>
                </svg>
              </a>
            </div>

            <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
              {refacciones.slice(0, 8).map((product) => (
                <ProductCard key={product.id} product={product} onAddToCart={handleAddToCart} />
              ))}
            </div>
          </div>
        )}

      </div>
    </section>
  );
};

interface ProductCardProps {
  product: WooProduct;
  onAddToCart: (id: number) => void;
}

const ProductCard = ({ product, onAddToCart }: ProductCardProps) => {
  const discount = product.on_sale && product.regular_price && product.sale_price
    ? Math.round(((parseFloat(product.regular_price) - parseFloat(product.sale_price)) / parseFloat(product.regular_price)) * 100)
    : 0;

  return (
    <div className="group bg-white rounded-xl overflow-hidden border border-slate-200 hover:border-blue-300 hover:shadow-lg transition-all duration-300 flex flex-col h-full">
      {/* Imagen */}
      <div className="relative overflow-hidden bg-slate-50 aspect-square">
        <a href={product.link} className="block h-full">
          {product.image ? (
            <img 
              src={product.image} 
              alt={product.name}
              className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
            />
          ) : (
            <div className="w-full h-full flex items-center justify-center text-slate-400">
              <ShoppingCart className="w-12 h-12" />
            </div>
          )}
        </a>

        {product.on_sale && discount > 0 && (
          <Badge className="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold">
            -{discount}%
          </Badge>
        )}
      </div>

      {/* Info */}
      <div className="p-3 flex flex-col flex-1">
        <h3 className="font-medium text-slate-800 text-sm leading-snug mb-2 line-clamp-2 group-hover:text-blue-700 transition-colors min-h-[2.5rem]">
          <a href={product.link}>{product.name}</a>
        </h3>

        <div className="mb-3">
          {product.on_sale && product.sale_price ? (
            <div className="flex items-center gap-2">
              <span className="text-base font-bold text-slate-900">
                {product.currency}{parseFloat(product.sale_price).toFixed(2)}
              </span>
              <span className="text-sm text-slate-400 line-through">
                {product.currency}{parseFloat(product.regular_price).toFixed(2)}
              </span>
            </div>
          ) : (
            <span className="text-base font-bold text-slate-900">
              {product.currency}{parseFloat(product.price).toFixed(2)}
            </span>
          )}
        </div>

        <Button 
          onClick={() => onAddToCart(product.id)}
          className="w-full mt-auto bg-blue-600 hover:bg-blue-700 text-white"
          size="sm"
          disabled={!product.in_stock}
        >
          <ShoppingCart className="w-4 h-4 mr-2" />
          {product.in_stock ? 'Agregar al carrito' : 'Agotado'}
        </Button>
      </div>
    </div>
  );
};

export { ProductShowcase };
