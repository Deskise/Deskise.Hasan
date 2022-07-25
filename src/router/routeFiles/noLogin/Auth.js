import store from "../../../store";
import Notification from "../../../config/Notification";

function lazyLoad(view) {
  return () =>
    import(/* webpackChunkName: "Auth" */ `@/views/Auth/${view}.vue`);
}

export const routes = [
  {
    path: "/auth/login",
    name: "login",
    component: lazyLoad("Login"),
    meta: {
      noAuth: true,
    },
  },
  {
    path: "/auth/signup",
    name: "signup",
    component: lazyLoad("Signup"),
    meta: {
      noAuth: true,
    },
  }, 
  {
    path: "/auth/verify",
    name: "verify",
    component: lazyLoad("Verify"),
    meta: {
      noAuth: true,
    },
  },
  {
    path: "/auth/verify/resend",
    name: "resend",
    component: lazyLoad("Resend"),
    meta: {
      noAuth: true,
    },
  },
  {
    path: "/auth/forget",
    name: "forget",
    component: lazyLoad("Forget"),
    meta: {
      noAuth: true,
    },
  },
  {
    path: "/auth/reset",
    name: "reset",
    component: lazyLoad("Reset"),
    meta: {
      noAuth: true,
    },
  },

  {
    path: "/auth/logout",
    name: "logout",
    beforeEnter: (to, from, next) => {
      window.h("facebook").logout();
      window.h("google").logout();
      store.dispatch("user/logout");
      Notification.addNotification("Logged Out Successfully", true);
      next({
        name: "home",
      });
    },
    meta: {
      requireAuth: true,
    },
  },
];
