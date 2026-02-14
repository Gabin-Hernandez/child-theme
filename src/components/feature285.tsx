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
      src: "https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1540553016722-983e48a2cd10?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1591337676887-a217a6970a8a?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1616401784845-180882ba9ba8?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1519558260268-cde7e03a0152?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1540553016722-983e48a2cd10?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1591337676887-a217a6970a8a?w=400&q=80",
    },
    {
      src: "https://images.unsplash.com/photo-1616401784845-180882ba9ba8?w=400&q=80",
    },
  ];

  const BRAND = {
    url: "https://itoolsmx.com",
    src: "https://itoolsmx.com/wp-content/uploads/2023/11/cropped-image-1.png",
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
            <a href={BRAND.url} className="flex items-center gap-3">
              <img src={BRAND.src} className="h-12 w-auto" alt={BRAND.alt} />
              <span className="text-2xl font-bold tracking-tight">
                {BRAND.title}
              </span>
            </a>
            <div>
              <h2 className="relative mt-12 font-sans text-4xl font-bold tracking-tighter md:text-5xl lg:mt-0 xl:text-6xl text-foreground">
                Tu Socio en Reparación Profesional
              </h2>
              <p className="text-md mx-auto mt-2 mb-10 max-w-2xl text-muted-foreground md:text-lg">
                Stock completo de pantallas, baterías, herramientas y equipo profesional. Envíos a todo México con la mejor garantía del mercado.
              </p>
            </div>
            <Button className="h-12 w-fit rounded-xl !px-6 bg-black hover:bg-black/90 text-white" asChild>
              <a href="https://itoolsmx.com/tienda/">
                Ver Productos <Forward />
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
