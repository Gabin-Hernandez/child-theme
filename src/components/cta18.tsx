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
              Descubre nuestro amplio catálogo de refacciones, herramientas y equipo especializado. Productos de calidad para profesionales y entusiastas.
            </p>
            <div className="mt-8 flex flex-col gap-4 sm:flex-row">
              <Button asChild>
                <a href="/tienda">Ver Catálogo</a>
              </Button>
              <Button variant="outline" asChild className="text-white hover:text-white">
                <a href="/ofertas">Ver Ofertas</a>
              </Button>
            </div>
          </div>
          <div className="relative ml-6 max-h-96 md:mt-8 md:ml-0 md:min-w-[400px]">
            <img
              src="https://plus.unsplash.com/premium_photo-1723914054622-5e11ec4d8b3f?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjIyfHxoYXJkd2FyZXxlbnwwfHwwfHx8MA%3D%3D"
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
