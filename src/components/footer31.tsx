"use client";

import { ArrowRight, ArrowUpRight } from "lucide-react";
import React from "react";

import { cn } from "@/lib/utils";

import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";

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
            <p className="relative text-4xl font-medium tracking-tight lg:text-5xl">
              Todo para tu taller<br />de reparación
            </p>
            <div className="space-y-1 text-sm font-light tracking-tight lg:text-base">
              <p>Contáctanos:</p>
              <a href="mailto:contacto@itoolsmx.com" className="hover:text-blue-400 transition-colors">
                contacto@itoolsmx.com
              </a>
              <p className="mt-2">
                <a href="tel:+528123894076" className="hover:text-blue-400 transition-colors">
                  +52 81 2389 4076
                </a>
              </p>
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
        <div className="mt-20 flex flex-col justify-between gap-15 lg:flex-row">
          <div className="flex w-full max-w-md flex-col gap-10">
            <div className="space-y-1 text-sm font-light tracking-tight lg:text-base">
              <p>Suscríbete a nuestro boletín:</p>
              <form className="flex w-full items-end border-b border-b-foreground/10">
                <Input
                  type="email"
                  placeholder="Tu email*"
                  className="mt-10 rounded-none border-0 !bg-transparent p-0 shadow-none placeholder:text-foreground/20 focus-visible:ring-0 lg:text-base"
                />
                <Button type="submit" variant="ghost">
                  <ArrowRight />
                </Button>
              </form>
            </div>
          </div>
          <div className="grid w-full max-w-xs grid-cols-2 gap-10 text-sm font-light lg:text-base">
            <div className="w-40">
              <p className="font-medium mb-2">ITOOLS MX</p>
              <p className="text-foreground/70">Monterrey, Nuevo León<br />México</p>
            </div>
            <ul className="space-y-1">
              {FOOTER_LINKS.map((item) => (
                <li key={item.label}>
                  <a
                    href={item.href}
                    className="group flex items-center gap-1 tracking-tight text-foreground hover:text-foreground/30"
                  >
                    {item.label}{" "}
                  </a>
                </li>
              ))}
            </ul>
          </div>
        </div>
        <div className="mt-20 w-full lg:mt-32">
          <div className="text-6xl md:text-8xl lg:text-9xl font-bold text-foreground/10 select-none">
            ITOOLS MX
          </div>
        </div>
      </div>
    </section>
  );
};

export { Footer31 };
