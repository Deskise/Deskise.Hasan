// import store from "@/store";
function lazyLoad(view) {
  return () =>
    import(/* webpackChunkName: "Chat" */ `@/views/Chat/${view}.vue`);
}

export const routes = [
  {
    path: "/chat",
    name: "chat",
    component: lazyLoad("index"),
    meta: {
      requireAuth: true,
      noFooter: true,
    },
  },
];
