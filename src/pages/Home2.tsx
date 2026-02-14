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

import { Footer31 } from '@/components/footer31'
import { Cta18 } from '@/components/cta18'
import { ProductCarousel } from '@/components/ProductCarousel'
import { Feature200 } from '@/components/feature200'
import { NewArrivals } from '@/components/NewArrivals'
import { Feature323 } from '@/components/feature323'
import { HeroSimple } from '@/components/HeroSimple'
import { PopularProducts } from '@/components/PopularProducts'
import { Feature285 } from '@/components/feature285'

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
      {/* FEATURE285 SECTION - shadcn block          */}
      {/* ========================================== */}
      <Feature285 />

      {/* ========================================== */}
      {/* FEATURE323 SECTION - shadcn block          */}
      {/* ========================================== */}
      <Feature323 />

      {/* ========================================== */}
      {/* NEW ARRIVALS - Product Grid                */}
      {/* ========================================== */}
      <NewArrivals />

      {/* ========================================== */}
      {/* FEATURES SECTION - shadcn block            */}
      {/* ========================================== */}
      <Feature200 />

      {/* ========================================== */}
      {/* PRODUCTS CAROUSEL - Swiper.js              */}
      {/* ========================================== */}
      <ProductCarousel />

      {/* ========================================== */}
      {/* CTA SECTION - shadcn block                 */}
      {/* ========================================== */}
      <Cta18 />

      {/* ========================================== */}
      {/* FOOTER - shadcn block                      */}
      {/* ========================================== */}
      <Footer31 />
    </div>
  )
}
