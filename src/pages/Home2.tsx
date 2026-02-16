/**
 * Home2 - New ITOOLS Home Page built with shadcn/ui
 *
 * This is the main page component. Add shadcn blocks and
 * components here to build the new homepage.
 *
 * Available shadcn components can be added with:
 *   npx shadcn@latest add <component-name>
 *
 * They will be placed in src/components/ui/
 */

import { Cta18 } from '@/components/cta18'
import { ProductCarousel } from '@/components/ProductCarousel'
import { Feature200 } from '@/components/feature200'
import { NewArrivals } from '@/components/NewArrivals'
import { Feature323 } from '@/components/feature323'
import { HeroSimple } from '@/components/HeroSimple'
import { PopularProducts } from '@/components/PopularProducts'
import { Feature285 } from '@/components/feature285'
import { ToolsGrid } from '@/components/ToolsGrid'

export default function Home2() {
  return (
    <div className="min-h-screen bg-background text-foreground">
      {/* ========================================== */}
      {/* HERO SECTION - Simple Elegant Slider      */}
      {/* ========================================== */}
      <HeroSimple />

      {/* ========================================== */}
      {/* POPULAR PRODUCTS - Swiper Carousel         */}
      {/* ========================================== */}
      <PopularProducts />

      {/* ========================================== */}
      {/* HERRAMIENTAS SECTION 1 - Herramientas Más Populares */}
      {/* ========================================== */}
      <ToolsGrid 
        title="Herramientas Más Populares"
        productsPerPage={16}
        bgColor="white"
      />

      {/* ========================================== */}
      {/* FEATURE285 SECTION - shadcn block          */}
      {/* ========================================== */}
      <Feature285 />

      {/* ========================================== */}
      {/* HERRAMIENTAS SECTION 2 - Herramientas de Precisión */}
      {/* ========================================== */}
      <ToolsGrid 
        title="Herramientas de Precisión"
        productsPerPage={16}
        bgColor="gray"
      />

      {/* ========================================== */}
      {/* NEW ARRIVALS - Product Grid                */}
      {/* ========================================== */}
      <NewArrivals />

      {/* ========================================== */}
      {/* HERRAMIENTAS SECTION 3 - Equipos de Soldadura */}
      {/* ========================================== */}
      <ToolsGrid 
        title="Equipos de Soldadura y Reparación"
        productsPerPage={16}
        bgColor="white"
      />

      {/* ========================================== */}
      {/* FEATURES SECTION - shadcn block            */}
      {/* ========================================== */}
      <Feature200 />

      {/* ========================================== */}
      {/* HERRAMIENTAS SECTION 4 - Kits Profesionales */}
      {/* ========================================== */}
      <ToolsGrid 
        title="Kits Profesionales Completos"
        productsPerPage={16}
        bgColor="gray"
      />

      {/* ========================================== */}
      {/* PRODUCTS CAROUSEL - Swiper.js              */}
      {/* ========================================== */}
      <ProductCarousel />

      {/* ========================================== */}
      {/* HERRAMIENTAS SECTION 5 - Herramientas Destacadas */}
      {/* ========================================== */}
      <ToolsGrid 
        title="Herramientas Destacadas del Mes"
        productsPerPage={16}
        bgColor="white"
      />

      {/* ========================================== */}
      {/* CTA SECTION - shadcn block                 */}
      {/* ========================================== */}
      <Cta18 />
    </div>
  )
}
