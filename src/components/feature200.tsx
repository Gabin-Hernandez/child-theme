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
      iconColor: "text-blue-400/90",
      bgGradient: "from-blue-500",
      features: [
        "Entrega rápida y confiable",
        "Rastreo en tiempo real",
        "Múltiples opciones de envío",
      ],
    },
    {
      title: "Calidad Garantizada",
      icon: Shield,
      iconColor: "text-green-400/90",
      bgGradient: "from-green-500",
      features: [
        "Productos originales certificados",
        "Garantía de satisfacción",
        "Soporte técnico especializado",
      ],
    },
    {
      title: "Amplio Catálogo",
      icon: Store,
      iconColor: "text-orange-400/90",
      bgGradient: "from-orange-500",
      features: [
        "Más de 19,000 productos",
        "Refacciones y herramientas",
        "Stock siempre disponible",
      ],
    },
  ];

  return (
    <section className={cn("py-32", className)}>
      <div className="container">
        <div className="mx-auto mt-8 grid max-w-5xl grid-cols-1 gap-2 lg:grid-cols-3">
          {features.map((feature, index) => (
            <div
              key={index}
              className={`relative h-full rounded-xl bg-radial-[at_80%_14%] ${feature.bgGradient} overflow-hidden from-[-50%] via-zinc-950 via-75% to-zinc-950 p-6`}
            >
              <div className="absolute inset-0 h-full w-full bg-[radial-gradient(white_1px,transparent_1px)] [mask-image:radial-gradient(ellipse_at_80%_14%,#000,transparent_40%)] [background-size:3px_3px] opacity-35"></div>
              <div
                className={`relative grid size-11 place-items-center rounded-full bg-gradient-to-b ${feature.bgGradient}/50 via-transparent to-${feature.bgGradient.split("-")[1]}/50 p-[2px]`}
              >
                <div
                  className={`grid size-full place-items-center rounded-full bg-zinc-950 bg-gradient-to-b ${feature.bgGradient}/30 via-transparent to-${feature.bgGradient.split("-")[1]}/30`}
                >
                  <feature.icon className={feature.iconColor} />
                </div>
              </div>
              <h3 className="relative mt-10 text-lg font-semibold text-background dark:text-primary">
                {feature.title}
              </h3>
              <ul className="relative mt-4 space-y-3.5 text-sm text-background/70 dark:text-primary/70">
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
