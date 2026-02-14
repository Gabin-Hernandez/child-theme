"use client";

import { motion } from "framer-motion";
import { Forward } from "lucide-react";
import { useState } from "react";

import { cn } from "@/lib/utils";

import { Marquee } from "@/components/ui/marquee";
import { Button } from "@/components/ui/button";

interface Feature285Props {
  className?: string;
}

const Feature285 = ({ className }: Feature285Props) => {
  const [hoveredIndex, setHoveredIndex] = useState<number | null>(null);

  const images = [
    {
      src: "https://images.unsplash.com/photo-1604671801908-6f0c6a092c05?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1556656793-08538906a9f8?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1621768216002-5ac171876625?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1517420704952-d9f39e95b43e?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1604671801908-6f0c6a092c05?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1556656793-08538906a9f8?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1621768216002-5ac171876625?w=400&q=80",
    },
  ];

  const BRAND = {
    url: "https://itoolsmx.com",
    src: "https://itoolsmx.com/wp-content/uploads/2024/01/cropped-Logo-ITOOLS-favicon-150x150.png",
    alt: "ITOOLS MX Logo",
    title: "ITOOLS MX",
  };

  return (
    <section
      className={cn("h-full overflow-hidden py-32 lg:h-screen", className)}
    >
      <div className="container flex h-full w-full items-center justify-center">
        <div className="grid h-full w-full max-w-7xl grid-cols-1 overflow-hidden rounded-4xl bg-muted lg:grid-cols-2">
          <div className="relative flex flex-col justify-between p-15">
            <a href={BRAND.url} className="flex items-center gap-2">
              <img src={BRAND.src} className="max-h-8 w-8" alt={BRAND.alt} />
              <span className="text-xl font-semibold tracking-tight">
                {BRAND.title}
              </span>
            </a>
            <div>
              <h2 className="relative mt-12 font-sans text-4xl font-semibold tracking-tighter md:text-5xl lg:mt-0 xl:text-6xl">
                Equipando a Profesionales desde 2013
              </h2>
              <p className="text-md mx-auto mt-2 mb-10 max-w-2xl text-muted-foreground/50 md:text-lg">
                Somos el proveedor líder de refacciones, herramientas y equipo profesional para reparación de smartphones en México. Calidad garantizada y stock permanente.
              </p>
            </div>
            <Button className="h-12 w-fit rounded-xl !px-5" asChild>
              <a href="https://itoolsmx.com/tienda/">
                Explorar Catálogo <Forward />
              </a>
            </Button>
          </div>
          <div className="relative mr-3 flex h-120 flex-row items-center justify-end overflow-hidden lg:h-full">
            <Marquee pauseOnHover vertical className="[--duration:20s]">
              {images.map((image, index) => (
                <motion.img
                  onMouseEnter={() => setHoveredIndex(index)}
                  onMouseLeave={() => setHoveredIndex(null)}
                  transition={{
                    duration: 0.2,
                    ease: "easeOut",
                    delay: index * 0.1 + 0.5,
                  }}
                  animate={{
                    filter:
                      hoveredIndex !== null && hoveredIndex !== index
                        ? "blur(10px)"
                        : "blur(0px)",
                    transition: {
                      duration: 0.3,
                      ease: "easeOut",
                      delay: 0,
                    },
                  }}
                  key={`marquee1-${image.src}-${index}`}
                  src={image.src}
                  alt=""
                  className="w-full rounded-3xl object-cover lg:h-60"
                />
              ))}
            </Marquee>
            <Marquee reverse pauseOnHover vertical className="[--duration:20s]">
              {images.map((image, index) => (
                <motion.img
                  onMouseEnter={() => setHoveredIndex(index)}
                  onMouseLeave={() => setHoveredIndex(null)}
                  transition={{
                    duration: 0.2,
                    ease: "easeOut",
                    delay: index * 0.1 + 0.5,
                  }}
                  animate={{
                    filter:
                      hoveredIndex !== null && hoveredIndex !== index
                        ? "blur(10px)"
                        : "blur(0px)",
                    transition: {
                      duration: 0.3,
                      ease: "easeOut",
                      delay: 0,
                    },
                  }}
                  key={`marquee2-${image.src}-${index}`}
                  src={image.src}
                  alt=""
                  className="w-full rounded-3xl object-cover lg:h-60"
                />
              ))}
            </Marquee>
            <div className="pointer-events-none absolute inset-x-0 top-0 block h-1/4 bg-gradient-to-b from-muted lg:hidden"></div>
            {/* <div className="from-muted pointer-events-none absolute inset-x-0 bottom-0 h-1/4 bg-gradient-to-t"></div> */}
          </div>
        </div>
      </div>
    </section>
  );
};

export { Feature285 };
