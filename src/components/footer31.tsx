"use client";

import { ArrowUpRight } from "lucide-react";
import React from "react";

import { cn } from "@/lib/utils";

const NAVIGATION = [
  { label: "Tienda", href: "/tienda" },
  { label: "Pantallas", href: "/producto-categoria/pantallas-lcd/" },
  { label: "Baterías", href: "/producto-categoria/baterias/" },
  { label: "Herramientas", href: "/producto-categoria/herramientas/" },
  { label: "Ofertas", href: "/ofertas" },
];

const SOCIAL_LINKS = [
  { label: "Facebook", href: "https://www.facebook.com/p/ITools-Mx-61550736645996/" },
  { label: "Instagram", href: "https://www.instagram.com/ipartsmovil/" },
  { label: "WhatsApp", href: "https://wa.me/5218123894076" },
];

const FOOTER_LINKS = [
  { label: "Política de Privacidad", href: "/politica-de-privacidad" },
  { label: "Términos y Condiciones", href: "/terminos-y-condiciones" },
];

interface Footer31Props {
  className?: string;
}

const Footer31 = ({ className }: Footer31Props) => {
  return (
    <section
      className={cn("dark bg-background py-32 text-foreground overflow-hidden", className)}
    >
      <div className="container relative z-10">
        <div className="flex flex-col justify-between gap-15 lg:flex-row">
          <div className="flex flex-col gap-8">
            {/* Logo */}
            <img 
              src="https://itoolsmx.com/wp-content/uploads/2023/11/cropped-image-1.png" 
              alt="ITOOLS MX" 
              className="w-[200px] h-auto object-contain mb-4"
              width="200"
              height="60"
            />
            <p className="relative text-4xl font-medium tracking-tight lg:text-5xl leading-tight text-balance">
              Todo para tu taller<br />de reparación
            </p>
            <div className="space-y-4 text-sm font-light tracking-tight lg:text-base">
              <div className="space-y-1">
                <p className="font-semibold text-foreground/90">Contáctanos</p>
                <p className="text-foreground/60 leading-relaxed">
                  Calle Heron Ramirez #715 Col. Rodriguez<br />
                  Reynosa, Tamaulipas, México
                </p>
              </div>
              
              <div className="space-y-1">
                <a 
                  href="tel:+528991450042" 
                  className="block w-fit text-lg font-medium hover:text-primary transition-colors duration-300"
                >
                  899 145 0042
                </a>
                <a 
                  href="mailto:itoolsmx05@gmail.com" 
                  className="block w-fit hover:text-primary transition-colors duration-300 underline decoration-muted-foreground/30 underline-offset-4 hover:decoration-primary"
                >
                  itoolsmx05@gmail.com
                </a>
              </div>

              <div className="pt-2">
                <p className="text-foreground/80 font-medium">Horario de atención</p>
                <p className="text-foreground/60">Lun - Vie 9:00 - 18:00</p>
                <p className="text-xs text-primary/80 mt-1 font-medium bg-primary/10 px-2 py-0.5 rounded-full w-fit">
                  Respuesta en 24hrs
                </p>
              </div>
            </div>
          </div>
          <div className="grid w-full max-w-xs grid-cols-2 gap-10 text-sm font-light lg:text-base">
            <div>
              <h3 className="font-semibold mb-6 text-foreground/90">Navegación</h3>
              <ul className="space-y-4">
                {NAVIGATION.map((item) => (
                  <li key={item.label}>
                    <a
                      href={item.href}
                      className="group flex items-center gap-2 tracking-tight text-foreground/60 hover:text-primary transition-all duration-300 hover:translate-x-1"
                    >
                      <span className="w-1.5 h-1.5 rounded-full bg-primary/0 transition-colors group-hover:bg-primary"></span>
                      {item.label}
                    </a>
                  </li>
                ))}
              </ul>
            </div>
            <div>
              <h3 className="font-semibold mb-6 text-foreground/90">Síguenos</h3>
              <ul className="space-y-4">
                {SOCIAL_LINKS.map((item) => (
                  <li key={item.label}>
                    <a
                      href={item.href}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="group flex items-center gap-2 tracking-tight text-foreground/60 hover:text-primary transition-all duration-300"
                    >
                      {item.label}{" "}
                      <ArrowUpRight className="size-3.5 text-foreground/40 transition-transform duration-300 group-hover:text-primary group-hover:-translate-y-0.5 group-hover:translate-x-0.5" />
                    </a>
                  </li>
                ))}
              </ul>
            </div>
          </div>
        </div>
        <div className="mt-24 pt-8 border-t border-foreground/5 flex flex-col justify-between gap-6 lg:flex-row items-center">
          <div className="text-sm text-foreground/50">
            © {new Date().getFullYear()} ITOOLS MX. Todos los derechos reservados.
          </div>
          <ul className="flex gap-8 text-sm">
            {FOOTER_LINKS.map((item) => (
              <li key={item.label}>
                <a
                  href={item.href}
                  className="text-foreground/50 hover:text-primary transition-colors duration-300"
                >
                  {item.label}
                </a>
              </li>
            ))}
          </ul>
        </div>
        <div className="mt-24 w-full flex justify-center opacity-30 pointer-events-none select-none mix-blend-overlay">
          <div className="text-[12vw] leading-none font-bold text-transparent bg-clip-text bg-gradient-to-b from-foreground/5 to-transparent text-center">
            ITOOLS MX
          </div>
        </div>
      </div>
    </section>
  );
};

export { Footer31 };
