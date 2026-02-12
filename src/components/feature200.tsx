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
        <div className="mx-auto mt-8 grid max-w-5xl grid-cols-1 gap-6 lg:grid-cols-3">
          {features.map((feature, index) => (
            <div
              key={index}
              className="group relative h-full rounded-xl overflow-hidden p-6 bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300"
            >
              {/* Top colored accent bar */}
              <div 
                className="absolute top-0 left-0 right-0 h-1"
                style={{ backgroundColor: feature.bgColor }}
              ></div>
              
              {/* Glow effect on hover */}
              <div 
                className="absolute -top-24 -right-24 w-48 h-48 rounded-full blur-3xl opacity-0 group-hover:opacity-20 transition-opacity duration-500"
                style={{ backgroundColor: feature.bgColor }}
              ></div>
              
              {/* Icon container */}
              <div className="relative mb-8">
                <div 
                  className="inline-flex size-14 items-center justify-center rounded-xl"
                  style={{ backgroundColor: `${feature.bgColor}20` }}
                >
                  <feature.icon 
                    className="h-7 w-7"
                    style={{ color: feature.bgColor }}
                  />
                </div>
              </div>
              
              <h3 className="relative text-xl font-semibold text-white mb-4">
                {feature.title}
              </h3>
              <ul className="relative space-y-3 text-sm text-white/80">
                {feature.features.map((item, itemIndex) => (
                  <li key={itemIndex} className="flex items-start gap-3">
                    <Check className="mt-0.5 size-4 shrink-0" style={{ color: feature.bgColor }} />
                    <span>{item}</span>
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
