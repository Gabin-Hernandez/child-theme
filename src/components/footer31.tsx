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
      className={cn("dark bg-background py-32 text-foreground", className)}
    >
      <div className="container">
        <div className="flex flex-col justify-between gap-15 lg:flex-row">
          <div className="flex flex-col gap-10">
            {/* Logo */}
            <img 
              src="https://itoolsmx.com/wp-content/uploads/2023/11/cropped-image-1.png" 
              alt="ITOOLS MX" 
              className="h-12 w-auto"
            />
            <p className="relative text-4xl font-medium tracking-tight lg:text-5xl">
              Todo para tu taller<br />de reparación
            </p>
            <div className="space-y-1 text-sm font-light tracking-tight lg:text-base">
              <p className="font-medium">Contáctanos:</p>
              <p className="text-foreground/70">Calle Heron Ramirez #715 Col. Rodriguez<br />Reynosa, Tamaulipas<br />México</p>
              <p className="mt-2">
                <a href="tel:+528991450042" className="hover:text-blue-400 transition-colors">
                  899 145 0042
                </a>
              </p>
              <p className="text-foreground/70">Lun - Vie 9:00 - 18:00</p>
              <p className="mt-2">
                <a href="mailto:itoolsmx05@gmail.com" className="hover:text-blue-400 transition-colors">
                  itoolsmx05@gmail.com
                </a>
              </p>
              <p className="text-foreground/50 text-xs">Respuesta en 24hrs</p>
            </div>
          </div>
          <div className="grid w-full max-w-xs grid-cols-2 gap-10 text-sm font-light lg:text-base">
            <ul className="space-y-1">
              {NAVIGATION.map((item) => (
                <li key={item.label}>
                  <a
                    href={item.href}
                    className="tracking-tight text-foreground hover:text-foreground/30"
                  >
                    {item.label}
                  </a>
                </li>
              ))}
            </ul>
            <ul className="space-y-1">
              {SOCIAL_LINKS.map((item) => (
                <li key={item.label}>
                  <a
                    href={item.href}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="group flex items-center gap-1 tracking-tight text-foreground hover:text-foreground/30"
                  >
                    {item.label}{" "}
                    <ArrowUpRight className="size-3.5 text-foreground group-hover:text-muted-foreground/50" />
                  </a>
                </li>
              ))}
            </ul>
          </div>
        </div>
        <div className="mt-20 flex flex-col justify-between gap-10 lg:flex-row">
          <div className="flex w-full max-w-md flex-col gap-4">
            <div className="text-sm font-light tracking-tight lg:text-base text-foreground/70">
              © {new Date().getFullYear()} ITOOLS MX. Todos los derechos reservados.
            </div>
          </div>
          <div className="flex items-center">
            <ul className="flex gap-8 text-sm font-light lg:text-base">
              {FOOTER_LINKS.map((item) => (
                <li key={item.label}>
                  <a
                    href={item.href}
                    className="tracking-tight text-foreground hover:text-foreground/30"
                  >
                    {item.label}
                  </a>
                </li>
              ))}
            </ul>
          </div>
        </div>
        <div className="mt-20 w-full lg:mt-32 flex justify-center">
          <div className="text-6xl md:text-8xl lg:text-9xl font-bold text-foreground/10 select-none text-center">
            ITOOLS MX
          </div>
        </div>
      </div>
    </section>
  );
};

export { Footer31 };
