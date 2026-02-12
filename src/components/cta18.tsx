import { cn } from "@/lib/utils";

import { Button } from "@/components/ui/button";

interface Cta18Props {
  className?: string;
}

const Cta18 = ({ className }: Cta18Props) => {
  return (
    <section className={cn("py-24", className)}>
      <div className="container overflow-hidden">
        <div className="relative mx-auto flex max-w-7xl flex-col justify-between gap-6 overflow-hidden rounded-xl border bg-muted/50 md:flex-row">
          <div className="max-w-xl self-center p-6 md:p-12">
            <h2 className="text-3xl font-semibold md:text-4xl">
              ¿Necesitas Herramientas Profesionales?
            </h2>
            <p className="mt-4 text-muted-foreground md:text-lg">
              Encuentra refacciones, herramientas y equipo técnico de alto desempeño. Soluciones confiables para profesionales y apasionados del sector.
            </p>
            <div className="mt-8 flex flex-col gap-4 sm:flex-row">
              <Button asChild className="text-white hover:text-white">
                <a href="/tienda">Ver Catálogo</a>
              </Button>
              <Button variant="outline" asChild>
                <a href="/ofertas">Ver Ofertas</a>
              </Button>
            </div>
          </div>
          <div className="relative ml-6 max-h-96 md:mt-8 md:ml-0 md:min-w-[400px]">
            <img
              src="https://images.unsplash.com/photo-1632749042303-7f7a18ed6ff0?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDZ8fHxlbnwwfHx8fHw%3D"
              alt="Hardware tools"
              className="h-full w-full rounded-tr-xl rounded-br-xl object-cover"
            />
          </div>
        </div>
      </div>
    </section>
  );
};

export { Cta18 };
