import { cn } from "@/lib/utils";

import { Button } from "@/components/ui/button";

interface Cta18Props {
  className?: string;
}

const Cta18 = ({ className }: Cta18Props) => {
  return (
    <section className={cn("py-12 md:py-24", className)}>
      <div className="container">
        <div 
          className="relative mx-auto max-w-7xl overflow-hidden rounded-xl border"
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
              ¿Necesitas Herramientas Profesionales?
            </h2>
            <p className="mt-6 text-white/90 md:text-lg max-w-2xl">
              Encuentra refacciones, herramientas y equipo técnico de alto desempeño. Soluciones confiables para profesionales y apasionados del sector.
            </p>
            <div className="mt-10 flex flex-col gap-4 sm:flex-row">
              <Button asChild size="lg" className="text-white hover:text-white">
                <a href="/tienda">Ver Catálogo</a>
              </Button>
              <Button variant="outline" asChild size="lg" className="bg-white/10 border-white/30 text-white hover:bg-white/20 hover:text-white backdrop-blur-sm">
                <a href="/ofertas">Ver Ofertas</a>
              </Button>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export { Cta18 };
