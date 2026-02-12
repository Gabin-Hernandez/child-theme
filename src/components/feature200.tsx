import { Check, Package, Shield, Store } from "lucide-react";

import { cn } from "@/lib/utils";

interface Feature200Props {
  className?: string;
}

const Feature200 = ({ className }: Feature200Props) => {
  const features = [
    {
      title: "Envíos a Todo México",
      icon: Package,
      iconColor: "text-blue-400",
      bgColor: "#3b82f6", // blue-500
      features: [
        "Entrega rápida y confiable",
        "Rastreo en tiempo real",
        "Múltiples opciones de envío",
      ],
    },
    {
      title: "Calidad Garantizada",
      icon: Shield,
      iconColor: "text-green-400",
      bgColor: "#22c55e", // green-500
      features: [
        "Productos originales certificados",
        "Garantía de satisfacción",
        "Soporte técnico especializado",
      ],
    },
    {
      title: "Amplio Catálogo",
      icon: Store,
      iconColor: "text-orange-400",
      bgColor: "#f97316", // orange-500
      features: [
        "Más de 19,000 productos",
        "Refacciones y herramientas",
        "Stock siempre disponible",
      ],
    },
  ];

  return (
    <section className={cn("pt-32", className)}>
      <div className="container">
        <div className="mx-auto mt-8 grid max-w-5xl grid-cols-1 gap-4 lg:grid-cols-3">
          {features.map((feature, index) => (
            <div
              key={index}
              className="relative h-full rounded-xl overflow-hidden p-6 bg-zinc-950"
              style={{
                background: `radial-gradient(circle at 80% 14%, ${feature.bgColor}15 0%, #09090b 50%, #09090b 100%)`
              }}
            >
              {/* Dot pattern overlay */}
              <div 
                className="absolute inset-0 h-full w-full opacity-20"
                style={{
                  backgroundImage: 'radial-gradient(circle, white 1px, transparent 1px)',
                  backgroundSize: '20px 20px',
                  maskImage: `radial-gradient(ellipse at 80% 14%, black 0%, transparent 50%)`
                }}
              ></div>
              
              {/* Icon container */}
              <div className="relative">
                <div 
                  className="grid size-12 place-items-center rounded-full p-[2px]"
                  style={{
                    background: `linear-gradient(to bottom, ${feature.bgColor}80, transparent, ${feature.bgColor}40)`
                  }}
                >
                  <div 
                    className="grid size-full place-items-center rounded-full bg-zinc-950"
                    style={{
                      background: `linear-gradient(to bottom, ${feature.bgColor}30, transparent, ${feature.bgColor}20)`
                    }}
                  >
                    <feature.icon className={`${feature.iconColor} h-5 w-5`} />
                  </div>
                </div>
              </div>
              
              <h3 className="relative mt-10 text-lg font-semibold text-white">
                {feature.title}
              </h3>
              <ul className="relative mt-4 space-y-3.5 text-sm text-white/70">
                {feature.features.map((item, itemIndex) => (
                  <li key={itemIndex} className="flex items-center gap-2">
                    <Check className="mt-0.5 size-4 shrink-0" />
                    {item}
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export { Feature200 };
