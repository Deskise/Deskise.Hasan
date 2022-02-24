import store from "../../../store";

function lazyLoad(view) {
  return () =>
    import(/* webpackChunkName: "Products" */ `@/views/Products/${view}.vue`);
}

export const routes = [
  {
    path: "/icons",
    name: "icons",
    component: lazyLoad("Icons"),
  },
  {
    path: "/product/request",
    name: "requestProduct",
    component: lazyLoad("Request"),
  },
  {
    path: "/product/stop",
    name: "Product.stop",
    component: lazyLoad("Request"),
  },

  {
    path: "/products",
    name: "products",
    component: lazyLoad("main"),
    beforeEnter: async function (routeTo, from, next) {
      routeTo.params.category = 0;
      await store.dispatch("product/list", { page: 1, category: 0 });
      next();
    },
  },
  {
    path: "/products/category/:id",
    name: "productsByCategory",
    component: lazyLoad("main"),
    beforeEnter: async function (routeTo, from, next) {
      if (routeTo.params.id == 0) return next({ name: "products" });
      await store.dispatch("product/list", {
        page: 1,
        category: routeTo.params.id,
      });
      routeTo.params.category = routeTo.params.id;
      next();
    },
  },

  {
    path: "/product/:id",
    name: "singleProduct",
    component: lazyLoad("Single"),
    beforeEnter: async function (routeTo, from, next) {
      console.log(
        store.state.product.products.data,
        store.state.product.products.data[routeTo.params.id]
      );
      if (
        store.state.product.products.data === {} ||
        store.state.product.products.data[routeTo.params.id] === undefined ||
        store.state.product.products.data[routeTo.params.id] === null
      ) {
        await store.dispatch("product/single", { id: routeTo.params.id });
      }
      next();
    },
  },

  {
    path: "/sales",
    name: "sales",
    meta: {
      requireAuth: true,
    },
    component: lazyLoad("Sales"),
  },
];
