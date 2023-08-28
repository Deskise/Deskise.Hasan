import store from "../../../store";

function lazyLoad(view) {
  return () =>
    import(/* webpackChunkName: "Products" */ `@/views/Products/${view}.vue`);
}

export const routes = [
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
    props: (route) => ({ id: Number(route.params.id) }),

    beforeEnter: async function (routeTo, from, next) {
        await store.dispatch("product/single", { id: routeTo.params.id })
        if (store.state.product.products.single) {
          next();
        } else {
          next(false)
        }
    },
    watch: {
      id: async function (newId) {
        await store.dispatch("product/single", { id: newId });
      },
    },
  },

  {
    path: "/product/edit/:id",
    name: "EditProduct",
    component: lazyLoad("EditProduct"),
    beforeEnter: async function (routeTo, from, next) {
      await store.dispatch("product/edit", { id: routeTo.params.id });
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
  {
    path: "/sales-data/:cat",
    name: "sales.data",
    meta: {
      requireAuth: true,
    },
    component: lazyLoad("Sales-data"),
    beforeEnter: async function (routeTo, from, next) {
      if (store.state.user.socialMedia.length === 0) {
        await store.dispatch("user/fetchSocailMedia");
      }
      next();
    },
  },

  {
    path: "/payment-complete",
    name: "paymencompleted",
    meta: {
      requireAuth: true,
    },
    component: lazyLoad("PaymentCompleted"),
  },
];
