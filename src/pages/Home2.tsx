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

export default function Home2() {
  return (
    <div className="min-h-screen bg-background text-foreground">
      {/* ========================================== */}
      {/* HERO SECTION - Replace with shadcn blocks  */}
      {/* ========================================== */}
      <section className="relative flex items-center justify-center min-h-[60vh] bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900">
        <div className="container mx-auto px-6 py-20 text-center">
          <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight">
            ITOOLS MX
          </h1>
          <p className="mt-4 text-lg md:text-xl text-slate-300 max-w-2xl mx-auto">
            Tu socio tecnológico de confianza — Refacciones, herramientas y equipo especializado
          </p>
          <div className="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            {/* Buttons will use shadcn Button component once added */}
            <a
              href="/tienda"
              className="inline-flex items-center justify-center rounded-lg bg-primary px-8 py-3 text-sm font-semibold text-primary-foreground shadow-lg hover:bg-primary/90 transition-colors"
            >
              Explorar Catálogo
            </a>
            <a
              href="/ofertas"
              className="inline-flex items-center justify-center rounded-lg border border-white/20 bg-white/10 px-8 py-3 text-sm font-semibold text-white backdrop-blur-sm hover:bg-white/20 transition-colors"
            >
              Ver Ofertas
            </a>
          </div>
        </div>
      </section>

      {/* ========================================== */}
      {/* CONTENT SECTIONS - Add shadcn blocks here  */}
      {/* ========================================== */}
      <section className="container mx-auto px-6 py-16">
        <div className="text-center">
          <h2 className="text-3xl font-bold tracking-tight">
            Página Home 2 — shadcn/ui Ready
          </h2>
          <p className="mt-4 text-muted-foreground max-w-xl mx-auto">
            Esta plantilla está lista para recibir componentes y bloques de shadcn/ui.
            Agrega componentes con <code className="bg-muted px-2 py-1 rounded text-sm font-mono">npx shadcn@latest add button</code>
          </p>
        </div>

        {/* Placeholder grid — will be replaced with actual shadcn blocks */}
        <div className="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
          {[
            { title: 'Categorías', desc: 'Navega por categorías de productos' },
            { title: 'Productos Destacados', desc: 'Lo más vendido y novedades' },
            { title: 'Ofertas', desc: 'Descuentos y promociones activas' },
          ].map((item) => (
            <div
              key={item.title}
              className="rounded-xl border border-border bg-card p-6 shadow-sm hover:shadow-md transition-shadow"
            >
              <h3 className="text-lg font-semibold text-card-foreground">
                {item.title}
              </h3>
              <p className="mt-2 text-sm text-muted-foreground">
                {item.desc}
              </p>
            </div>
          ))}
        </div>
      </section>

      {/* ========================================== */}
      {/* FOOTER - shadcn block                      */}
      {/* ========================================== */}
      <Footer31 />
    </div>
  )
}
