import Products from "@/views/Products/main.vue";
import Request from "@/views/Products/Request.vue";
export const routes = [
  {
    path: "/products",
    name: "products",
    component: Products,
  },
  {
    path: "/product/request",
    name: "requestProduct",
    component: Request,
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
