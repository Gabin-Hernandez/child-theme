// Global type declarations for ITOOLS MX

interface WooCommerceProduct {
  id: number;
  name: string;
  link: string;
  image: string;
  price: string;
  regular_price: string;
  sale_price: string;
  currency: string;
  on_sale: boolean;
  in_stock: boolean;
}

interface ItoolsProductsData {
  herramientas: WooCommerceProduct[];
  refacciones: WooCommerceProduct[];
}

declare global {
  interface Window {
    itoolsProducts?: ItoolsProductsData;
  }
}

export {};
