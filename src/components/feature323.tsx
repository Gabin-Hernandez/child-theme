"use client";

import { AnimatePresence, motion } from "framer-motion";
import {
  ChevronDown,
  ChevronLeft,
  ChevronRight,
  ChevronUp,
  PlusCircle,
} from "lucide-react";
import React, { useState } from "react";

import { cn } from "@/lib/utils";
import { useMediaQuery } from "@/hooks/useMediaQuery";

import { Button } from "@/components/ui/button";

interface FeatureItem {
  image: string;
  title: string;
  description: string;
}

interface ControlsProps {
  handleNext: () => void;
  handlePrevious: () => void;
  isPreviousDisabled: boolean;
  isNextDisabled: boolean;
}

const Controls = ({
  handleNext,
  handlePrevious,
  isPreviousDisabled,
  isNextDisabled,
}: ControlsProps) => {
  return (
    <div className="hidden flex-col items-start gap-8 lg:flex">
      <Button
        variant="outline"
        size="icon"
        className="rounded-full !bg-background/50 hover:!bg-background/100 [&_svg:not([class*='size-'])]:size-6"
        onClick={handlePrevious}
        disabled={isPreviousDisabled}
      >
        <ChevronUp />
      </Button>
      <Button
        variant="outline"
        size="icon"
        className="rounded-full !bg-background/50 hover:!bg-background/100 [&_svg:not([class*='size-'])]:size-6"
        onClick={handleNext}
        disabled={isNextDisabled}
      >
        <ChevronDown />
      </Button>
    </div>
  );
};

interface FeatureCardProps {
  feature: FeatureItem;
  isActive: boolean;
  onClick: () => void;
}

const FeatureCard = ({ feature, isActive, onClick }: FeatureCardProps) => {
  const variants = {
    initial: {
      opacity: 0,
    },
    animate: {
      opacity: 1,
    },
    exit: {
      opacity: 0,
    },
  };

  return (
    <AnimatePresence mode="popLayout">
      <motion.div
        layout
        transition={{
          layout: {
            duration: 0.4,
            ease: "easeOut",
          },
        }}
        style={{
          borderRadius: "24px",
        }}
        className="flex cursor-pointer items-start gap-4 overflow-hidden bg-background md:w-fit md:max-w-sm"
        onClick={onClick}
      >
        {isActive ? (
          <motion.div
            layout
            variants={variants}
            initial="initial"
            animate="animate"
            exit="exit"
            key={`feature-description-active-${feature.title}`}
            transition={{
              duration: 0.4,
              delay: 0.3,
              ease: "easeOut",
            }}
            className="p-6 text-sm md:p-8 md:text-base"
          >
            <p>
              <span className="font-semibold">{feature.title}.</span>{" "}
              <span>{feature.description}</span>
            </p>
          </motion.div>
        ) : (
          <motion.div
            layout
            variants={variants}
            initial="initial"
            animate="animate"
            exit="exit"
            key={`feature-description-inactive-${feature.title}`}
            transition={{
              duration: 0.4,
              delay: 0.2,
              ease: "easeOut",
            }}
            className={cn(
              "flex h-fit shrink-0 items-center gap-4 text-sm md:py-3.5 md:pr-6 md:pl-3 md:text-base",
              !isActive && "h-0 w-0 md:h-auto md:w-auto",
            )}
            style={{
              height: "auto",
              lineHeight: "normal",
            }}
          >
            <PlusCircle strokeWidth={1.5} />
            <p className="shrink-0 font-semibold">{feature.title}</p>
          </motion.div>
        )}
      </motion.div>
    </AnimatePresence>
  );
};

interface FeaturesDesktopProps {
  features: FeatureItem[];
  handleNext: () => void;
  handlePrevious: () => void;
  activeIndex: number;
  handleFeatureClick: (index: number) => void;
  isPreviousDisabled: boolean;
  isNextDisabled: boolean;
}

const FeaturesDesktop = ({
  features,
  handleNext,
  handlePrevious,
  activeIndex,
  handleFeatureClick,
  isPreviousDisabled,
  isNextDisabled,
}: FeaturesDesktopProps) => {
  return (
    <div className="relative z-10 hidden items-center gap-8 md:flex">
      <Controls
        handleNext={handleNext}
        handlePrevious={handlePrevious}
        isPreviousDisabled={isPreviousDisabled}
        isNextDisabled={isNextDisabled}
      />
      <div className="flex flex-col gap-4">
        {features.map((feature, index) => {
          return (
            <FeatureCard
              key={`feature-card-${index}`}
              feature={feature}
              isActive={index === activeIndex}
              onClick={() => handleFeatureClick(index)}
            />
          );
        })}
      </div>
    </div>
  );
};

interface FeatureMobileProps {
  features: FeatureItem[];
  handleNext: () => void;
  handlePrevious: () => void;
  activeIndex: number;
  direction: 1 | -1;
  isPreviousDisabled: boolean;
  isNextDisabled: boolean;
}

const FeaturesMobile = ({
  features,
  handleNext,
  handlePrevious,
  activeIndex,
  direction,
  isPreviousDisabled,
  isNextDisabled,
}: FeatureMobileProps) => {
  const variants = {
    initial: (direction: 1 | -1) => ({
      opacity: 0,
      scale: 0.6,
      x: direction * 50 + "%",
    }),
    animate: {
      opacity: 1,
      scale: 1,
      x: 0,
    },
    exit: (direction: 1 | -1) => ({
      opacity: 0,
      scale: 0.6,
      x: direction * -50 + "%",
    }),
  };

  return (
    <div className="absolute bottom-6 left-0 z-10 flex w-full items-end justify-between gap-6 px-6 md:hidden">
      <Button
        variant="outline"
        size="icon"
        className="rounded-full !bg-background/100 [&_svg:not([class*='size-'])]:size-6"
        onClick={handlePrevious}
        disabled={isPreviousDisabled}
      >
        <ChevronLeft />
      </Button>
      <AnimatePresence mode="popLayout" custom={direction}>
        <motion.div
          key={`feature-mobile-${activeIndex}`}
          variants={variants}
          initial="initial"
          animate="animate"
          exit="exit"
          custom={direction}
          transition={{
            duration: 0.2,
            ease: "easeOut",
          }}
          className="h-full w-full object-cover"
        >
          <FeatureCard
            feature={features[activeIndex]}
            isActive={true}
            onClick={() => {}}
          />
        </motion.div>
      </AnimatePresence>

      <Button
        variant="outline"
        size="icon"
        className="rounded-full !bg-background/100 [&_svg:not([class*='size-'])]:size-6"
        onClick={handleNext}
        disabled={isNextDisabled}
      >
        <ChevronRight />
      </Button>
    </div>
  );
};

interface Feature323Props {
  heading?: string;
  features?: FeatureItem[];
  className?: string;
}

const Feature323 = ({
  className,
  heading = "Soluciones Profesionales para Reparación",
  features = [
    {
      image:
        "https://images.unsplash.com/photo-1604671801908-6f0c6a092c05?w=1200&q=80",
      title: "Pantallas LCD Originales",
      description:
        "Stock completo de pantallas LCD para todas las marcas: Apple, Samsung, Huawei y Xiaomi. Garantía de fábrica y máxima calidad certificada.",
    },
    {
      image:
        "https://images.unsplash.com/photo-1517420704952-d9f39e95b43e?w=1200&q=80",
      title: "Herramientas de Soldadura",
      description:
        "Estaciones de soldadura profesionales, cautines de precisión y microscopios digitales. Equipamiento de alta gama para técnicos especializados.",
    },
    {
      image:
        "https://images.unsplash.com/photo-1556656793-08538906a9f8?w=1200&q=80",
      title: "Baterías Certificadas",
      description:
        "Baterías de reemplazo con certificación CE y RoHS. Compatible con iPhone, Samsung Galaxy, Huawei y Xiaomi. Rendimiento garantizado.",
    },
    {
      image:
        "https://images.unsplash.com/photo-1621768216002-5ac171876625?w=1200&q=80",
      title: "Microscopios Profesionales",
      description:
        "Microscopios digitales de alta resolución para reparaciones micro. Iluminación LED ajustable y visión precisa en componentes SMD.",
    },
    {
      image:
        "https://images.unsplash.com/photo-1583394838336-acd977736f90?w=1200&q=80",
      title: "Refacciones iPhone",
      description:
        "Amplio catálogo de refacciones originales y premium para iPhone. Desde iPhone 6 hasta los modelos más recientes. Envíos inmediatos.",
    },
    {
      image: "https://images.unsplash.com/photo-1588508065123-287b28e013da?w=1200&q=80",
      title: "Soporte Técnico Experto",
      description:
        "Asesoría profesional en diagnóstico y reparación. Más de 10 años de experiencia respaldando a técnicos en todo México.",
    },
  ],
}: Feature323Props) => {
  const [activeIndex, setActiveIndex] = useState(0);
  const [direction, setDirection] = useState<1 | -1>(1);

  const isMobile = useMediaQuery("(max-width: 768px)");

  const handleNext = () => {
    setDirection(1);
    if (activeIndex !== features.length - 1) {
      setActiveIndex((prevIndex) => prevIndex + 1);
    }
  };

  const handlePrevious = () => {
    setDirection(-1);
    if (activeIndex !== 0) {
      setActiveIndex((prevIndex) => prevIndex - 1);
    }
  };

  const handleFeatureClick = (index: number) => {
    setDirection(index > activeIndex ? 1 : -1);
    setActiveIndex(index);
  };

  const xOffset = !isMobile ? 50 : 15;
  const yOffset = !isMobile ? 15 : 5;
  const scale = !isMobile ? 0.6 : 0.8;

  const variants = {
    initial: (direction: 1 | -1) => ({
      opacity: 0,
      scale: scale,
      filter: "blur(20px)",
      x: direction * xOffset + "%",
      y: direction * yOffset + "%",
    }),
    animate: {
      opacity: 1,
      scale: 1,
      filter: "blur(0px)",
      x: 0,
      y: 0,
    },
    exit: (direction: 1 | -1) => ({
      opacity: 0,
      scale: scale,
      x: direction * -xOffset + "%",
      y: direction * -yOffset + "%",
      filter: "blur(20px)",
    }),
  };

  return (
    <section className={cn("py-32", className)}>
      <div className="container space-y-20">
        <div className="relative h-full min-h-[60vh] w-full overflow-hidden rounded-4xl bg-muted px-8 py-8 md:min-h-full md:py-20">
          <FeaturesDesktop
            features={features}
            handleNext={handleNext}
            handlePrevious={handlePrevious}
            activeIndex={activeIndex}
            handleFeatureClick={handleFeatureClick}
            isPreviousDisabled={activeIndex === 0}
            isNextDisabled={activeIndex === features.length - 1}
          />
          <FeaturesMobile
            features={features}
            handleNext={handleNext}
            handlePrevious={handlePrevious}
            activeIndex={activeIndex}
            direction={direction}
            isPreviousDisabled={activeIndex === 0}
            isNextDisabled={activeIndex === features.length - 1}
          />

          <div className="absolute top-0 right-0 z-0 flex h-full w-full items-center justify-center lg:w-2/3 lg:mask-[linear-gradient(to_right,_transparent,_black_30%,_black)]">
            <AnimatePresence mode="popLayout" custom={direction}>
              <motion.img
                key={`feature-image-${activeIndex}`}
                variants={variants}
                initial="initial"
                animate="animate"
                exit="exit"
                custom={direction}
                transition={{
                  duration: 0.4,
                  ease: "easeOut",
                }}
                src={features[activeIndex].image}
                alt={features[activeIndex].title}
                className="h-full w-full object-cover"
              />
            </AnimatePresence>
          </div>
        </div>
      </div>
    </section>
  );
};

export { Feature323 };
