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
    <section className={cn("bg-black text-white py-16 border-t border-white/10 font-sans", className)}>
      <div className="container px-4 md:px-6">
        
        {/* Top: Logo Only */}
        <div className="flex w-full justify-center mb-16 border-b border-white/10 pb-16">
          <div className="block">
            <img 
              src="https://itoolsmx.com/wp-content/uploads/2023/11/cropped-image-1.png" 
              alt="ITOOLS MX" 
              className="h-16 md:h-20 w-auto opacity-90 hover:opacity-100 transition-opacity duration-300"
            />
          </div>
        </div>

        {/* Grid Links */}
        <div className="grid grid-cols-2 lg:grid-cols-5 gap-y-12 gap-x-8 mb-20 text-[11px] uppercase tracking-wider">
          
          {/* Col 1 */}
          <div className="col-span-1">
            <h4 className="font-bold mb-6 text-white">Tienda</h4>
            <ul className="space-y-4 text-white/60">
              {NAVIGATION.map((item) => (
                <li key={item.label}>
                  <a href={item.href} className="hover:text-white transition-colors">
                    {item.label}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Col 2 */}
          <div className="col-span-1">
            <h4 className="font-bold mb-6 text-white">Ayuda</h4>
            <ul className="space-y-4 text-white/60">
              <li><a href="#" className="hover:text-white transition-colors">Envíos</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Devoluciones</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Garantía</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Contacto</a></li>
            </ul>
          </div>

          {/* Col 3: Contact */}
          <div className="col-span-2 lg:col-span-1">
            <h4 className="font-bold mb-6 text-white">Oficina</h4>
            <div className="space-y-4 text-white/60 leading-relaxed">
              <p>
                Calle Heron Ramirez #715<br />
                Col. Rodriguez<br />
                Reynosa, Tamps.
              </p>
              <p className="mt-4">
                 <a href="tel:+528991450042" className="hover:text-white transition-colors block">899 145 0042</a>
                 <a href="mailto:itoolsmx05@gmail.com" className="hover:text-white transition-colors block mt-1">itoolsmx05@gmail.com</a>
              </p>
            </div>
          </div>

          {/* Col 4: Social */}
          <div className="col-span-1">
            <h4 className="font-bold mb-6 text-white">Social</h4>
            <ul className="space-y-4 text-white/60">
              {SOCIAL_LINKS.map((item) => (
                <li key={item.label}>
                  <a 
                    href={item.href}
                    target="_blank"
                    rel="noopener noreferrer" 
                    className="hover:text-white transition-colors flex items-center gap-2 group"
                  >
                    {item.label}
                    <ArrowUpRight className="h-3 w-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300" />
                  </a>
                </li>
              ))}
            </ul>
          </div>
          
          {/* Branding Horizontal/Vertical */}
           <div className="col-span-2 lg:col-span-1 flex justify-center lg:justify-end lg:items-end select-none py-8 lg:py-0">
              <span
                className="text-5xl sm:text-6xl lg:text-7xl font-black tracking-tighter bg-[linear-gradient(to_right,#ff0000,#ff8000,#ffff00,#00ff00,#00ffff,#0000ff,#8000ff,#ff0000)] bg-clip-text text-transparent animate-gradient-loop lg:[writing-mode:vertical-rl] lg:[transform:rotate(180deg)]"
              >
                ITOOLS
              </span>
           </div>

        </div>

        {/* Bottom */}
        <div className="flex flex-col md:flex-row justify-between items-end gap-6 text-[10px] uppercase tracking-widest text-white/40 pt-8 border-t border-white/10">
          <div className="flex flex-col gap-2">
            <p>© {new Date().getFullYear()} ITOOLS MX</p>
            <p>Todos los derechos reservados</p>
          </div>
          
          <div className="flex gap-6">
             {FOOTER_LINKS.map((item) => (
                <a key={item.label} href={item.href} className="hover:text-white transition-colors">
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
