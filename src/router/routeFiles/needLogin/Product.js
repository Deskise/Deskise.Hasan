import Products from "@/views/Products/main.vue";
export const routes = [
  {
    path: "/products",
    name: "products",
    component: Products,
  },
  {
    path: "/product/request",
    name: "requestProduct",
  },
  {
    path: "/products/category/:id",
    name: "productsByCategory",
  },
  {
    path: "/product/:id",
    name: "singleProduct",
    meta: {
      requireAuth: true,
    },
  },

  {
    path: "/sales",
    name: "sales",
    meta: {
      requireAuth: true,
    },
  },
];
