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
    <section className={cn("bg-background text-foreground py-16 border-t font-sans", className)}>
      <div className="container px-4 md:px-6">
        
        {/* Top: Newsletter + Logo */}
        <div className="flex flex-col md:flex-row justify-between items-start md:items-end gap-10 mb-16 border-b border-foreground/10 pb-16">
          <div className="w-full max-w-sm">
            <h3 className="text-xs font-bold uppercase tracking-[0.2em] mb-4">Newsletter</h3>
            <p className="text-[11px] uppercase tracking-wide text-foreground/60 mb-6 leading-relaxed">
              Suscríbete ahora para recibir actualizaciones sobre nuevos productos, ofertas especiales y más información de ITOOLS MX.
            </p>
            <form className="flex w-full items-end gap-2 border-b border-foreground focus-within:border-foreground/50 transition-colors pb-1 group">
              <input
                type="email"
                placeholder="INTRODUCE TU E-MAIL"
                className="w-full bg-transparent py-2 text-xs outline-none placeholder:text-foreground/40 uppercase tracking-widest"
              />
              <button 
                type="submit" 
                className="pb-2 text-[10px] font-bold uppercase tracking-widest hover:opacity-50 transition-opacity"
              >
                Suscribirse
              </button>
            </form>
          </div>
          
          <div className="hidden md:block">
            <img 
              src="https://itoolsmx.com/wp-content/uploads/2023/11/cropped-image-1.png" 
              alt="ITOOLS MX" 
              className="h-6 w-auto grayscale hover:grayscale-0 transition-all duration-500 opacity-80 hover:opacity-100"
            />
          </div>
        </div>

        {/* Grid Links */}
        <div className="grid grid-cols-2 lg:grid-cols-5 gap-y-12 gap-x-8 mb-20 text-[11px] uppercase tracking-wider">
          
          {/* Col 1 */}
          <div className="col-span-1">
            <h4 className="font-bold mb-6">Tienda</h4>
            <ul className="space-y-4 text-foreground/60">
              {NAVIGATION.map((item) => (
                <li key={item.label}>
                  <a href={item.href} className="hover:text-foreground transition-colors">
                    {item.label}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Col 2 */}
          <div className="col-span-1">
            <h4 className="font-bold mb-6">Ayuda</h4>
            <ul className="space-y-4 text-foreground/60">
              <li><a href="#" className="hover:text-foreground transition-colors">Envíos</a></li>
              <li><a href="#" className="hover:text-foreground transition-colors">Devoluciones</a></li>
              <li><a href="#" className="hover:text-foreground transition-colors">Garantía</a></li>
              <li><a href="#" className="hover:text-foreground transition-colors">Contacto</a></li>
            </ul>
          </div>

          {/* Col 3: Contact */}
          <div className="col-span-2 lg:col-span-1">
            <h4 className="font-bold mb-6">Oficina</h4>
            <div className="space-y-4 text-foreground/60 leading-relaxed">
              <p>
                Calle Heron Ramirez #715<br />
                Col. Rodriguez<br />
                Reynosa, Tamps.
              </p>
              <p className="mt-4">
                 <a href="tel:+528991450042" className="hover:text-foreground transition-colors block">899 145 0042</a>
                 <a href="mailto:itoolsmx05@gmail.com" className="hover:text-foreground transition-colors block mt-1">itoolsmx05@gmail.com</a>
              </p>
            </div>
          </div>

          {/* Col 4: Social */}
          <div className="col-span-1">
            <h4 className="font-bold mb-6">Social</h4>
            <ul className="space-y-4 text-foreground/60">
              {SOCIAL_LINKS.map((item) => (
                <li key={item.label}>
                  <a 
                    href={item.href}
                    target="_blank"
                    rel="noopener noreferrer" 
                    className="hover:text-foreground transition-colors flex items-center gap-2 group"
                  >
                    {item.label}
                    <ArrowUpRight className="h-3 w-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300" />
                  </a>
                </li>
              ))}
            </ul>
          </div>
          
          {/* Branding Vertical */}
           <div className="hidden lg:flex flex-col justify-end items-end col-span-1 h-full opacity-10 select-none pointer-events-none">
              <span className="text-7xl font-black tracking-tighter writing-mode-vertical" style={{ writingMode: 'vertical-rl', transform: 'rotate(180deg)' }}>ITOOLS</span>
           </div>

        </div>

        {/* Bottom */}
        <div className="flex flex-col md:flex-row justify-between items-end gap-6 text-[10px] uppercase tracking-widest text-foreground/40 pt-8 border-t border-foreground/5">
          <div className="flex flex-col gap-2">
            <p>© {new Date().getFullYear()} ITOOLS MX</p>
            <p>Todos los derechos reservados</p>
          </div>
          
          <div className="flex gap-6">
             {FOOTER_LINKS.map((item) => (
                <a key={item.label} href={item.href} className="hover:text-foreground transition-colors">
                  {item.label}
                </a>
              ))}
          </div>
        </div>

      </div>
    </section>
  );
};

export { Footer31 };
