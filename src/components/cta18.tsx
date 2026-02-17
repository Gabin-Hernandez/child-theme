import { MessageCircle } from "lucide-react";

import { cn } from "@/lib/utils";

import { Button } from "@/components/ui/button";

interface Cta18Props {
  className?: string;
} 
 
const Cta18 = ({ className }: Cta18Props) => {
  return (
    <section className={cn("pb-12 md:pb-24", className)}>
      <div className="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
        <div 
          className="relative mx-auto max-w-[1600px] overflow-hidden rounded-xl border"
          style={{
            backgroundImage: 'url(https://images.unsplash.com/photo-1632749042303-7f7a18ed6ff0?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDZ8fHxlbnwwfHx8fHw%3D)',
            backgroundSize: 'cover',
            backgroundPosition: 'center',
          }}
        >
          {/* Overlay oscuro para legibilidad */}
          <div className="absolute inset-0 bg-black/60"></div>
          
          {/* Contenido centrado */}
          <div className="relative z-10 flex flex-col items-center justify-center text-center px-6 py-20 md:py-32">
            <h2 className="text-3xl font-semibold md:text-5xl text-white max-w-3xl">
              ¿No encuentras lo que buscas?
            </h2>
            <p className="mt-6 text-white/90 md:text-lg max-w-2xl">
              Tenemos más de 19,000 productos. Explora nuestro catálogo completo o contáctanos directamente.
            </p>
            <div className="mt-10 flex flex-col gap-4 sm:flex-row">
              <Button asChild size="lg" className="text-white hover:text-white">
                <a href="/tienda">Explorar Catálogo Completo</a>
              </Button>
              <Button variant="outline" asChild size="lg" className="bg-white/10 border-white/30 text-white hover:bg-white/20 hover:text-white backdrop-blur-sm">
                <a href="https://wa.me/5218123894076" target="_blank" rel="noopener noreferrer" className="inline-flex items-center gap-2">
                  <MessageCircle className="h-5 w-5" />
                  Contáctanos por WhatsApp
                </a>
              </Button>
            </div> 
            
            {/* Trust badges */}
            <div className="mt-12 flex flex-wrap justify-center gap-4 md:gap-8 text-white/80 text-xs md:text-sm font-medium">
              <span>Compra 100% segura</span>
              <span className="hidden sm:inline">·</span>
              <span>Garantía de satisfacción</span>
              <span className="hidden sm:inline">·</span>
              <span>Envíos a todo México</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export { Cta18 };
