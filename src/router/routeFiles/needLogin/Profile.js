import store from "@/store";
function lazyLoad(view) {
  return () =>
    import(/* webpackChunkName: "Profile" */ `@/views/Profile/${view}.vue`);
}

export const routes = [
  {
    path: "/profile",
    component: lazyLoad("index"),
    name: "profile",
    meta: {
      requireAuth: true,
    },
    beforeEnter: async function (routeTo, from, next) {
      let id = routeTo.query.id ?? store.state.user.data.id;
      await store.dispatch("user/getOtherData", {
        id,
      });
      await store.dispatch("user/getOtherProducts", {
        id,
        page: 1,
      });
      routeTo.params.id = Number.parseInt(id);
      next();
    },
  },
  {
    path: "/affiliate",
    component: lazyLoad("affiliate"),
    name: "profile.affiliate",
    meta: {
      requireAuth: true,
    },
    beforeEnter: async function (routeTo, from, next) {
      // let id = routeTo.query.id ?? store.state.user.data.id;
      await store.dispatch("affiliate/getAffiliats");
    next();
    },
  },
];
