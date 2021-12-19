function lazyLoad(view) {
  return import(
    /* webpackChunkName: "Products" */ `@/views/Products/${view}.vue`
  );
}

export const routes = [
  {
    path: "/products",
    name: "products",
    component: lazyLoad("main"),
  },
  {
    path: "/product/request",
    name: "requestProduct",
    component: lazyLoad("Request"),
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
