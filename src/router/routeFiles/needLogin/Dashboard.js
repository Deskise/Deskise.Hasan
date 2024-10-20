import store from "@/store";
import withdraw from "@/components/Dashboard/withdraw.vue"
function lazyLoad(view) {
  return () =>
    import(
      /* webpackChunkName: "Dashboard" */ `@/views/Dashboard/pages/${view}.vue`
    );
}

export const routes = [
  {
    path: "/dash",
    component: () => import(`@/views/Dashboard/index.vue`),
    name: "dash",
    meta: {
      requireAuth: true,
    },
    beforeEnter: async function (routeTo, from, next) {
      if (store.state.user.socialMedia.length === 0) {
        await store.dispatch("user/fetchSocailMedia");
        await store.dispatch("user/getData");
      }
      next();
    },
    children: [
      {
        path: "",
        name: "dashboard.index",
        component: lazyLoad("index"),
      },
      {
        path: "alerts",
        name: "dashboard.alerts",
        component: lazyLoad("Alerts"),
        beforeEnter: async (to, from, next) => {
          if (store.state.user.settings === null) {
            await store.dispatch("user/fetchSettings");
          }
          next();
        },
      },
      {
        path: "password",
        name: "dashboard.password",
        component: lazyLoad("ChangePassword"),
      },
      {
        path: "close",
        name: "dashboard.close",
        component: lazyLoad("CloseAccount"),
      },
      {
        path: "packages",
        name: "dashboard.packages",
        component: lazyLoad("Packages"),
        beforeEnter: async (to, from, next) => {
          let id = store.state.user.data.id
          await store.dispatch("user/userProducts", id)
            await store.dispatch("data/packages");
        next();
      },
      },
      {
        path: "payment",
        name: "dashboard.payment",
        component: lazyLoad("Payment"),
      },
      {
        path: "verification",
        name: "dashboard.verification",
        component: lazyLoad("Verification"),
      },

      {
        path: "sales",
        name: "dashboard.sales",
        component: lazyLoad("Sales"),
        beforeEnter: async (to, from, next) => {
          let id = store.state.user.data.id
          await store.dispatch("user/userSales", id)
          next();
        },
      },
      
      {
        path: "withdraw",
        name: "dashboard.wirhdraw",
        component: withdraw,
      },

      {
        path: "product",
        name: "dashboard.product",
        component: lazyLoad("Product"),
        beforeEnter: async (to, from, next) => {
            let id = store.state.user.data.id
            await store.dispatch("user/userProducts", id)
          next();
        },
      },
    ],
  },
];
