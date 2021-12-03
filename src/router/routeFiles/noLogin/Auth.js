import Login from "@/views/Auth/Login.vue";
import Signup from "@/views/Auth/Signup.vue";
import Verify from "@/views/Auth/Verify.vue";
import Resend from "@/views/Auth/Resend.vue";
import Forget from "@/views/Auth/Forget.vue";
import Reset from "@/views/Auth/Reset.vue";
import store from "../../../store";
import Notification from "../../../config/Notification";

export const routes = [
  {
    path: "/auth/login",
    name: "login",
    component: Login,
    meta: {
      noAuth: true,
    },
  },
  {
    path: "/auth/signup",
    name: "signup",
    component: Signup,
    meta: {
      noAuth: true,
    },
  },
  {
    path: "/auth/verify",
    name: "verify",
    component: Verify,
    meta: {
      noAuth: true,
    },
  },
  {
    path: "/auth/verify/resend",
    name: "resend",
    component: Resend,
    meta: {
      noAuth: true,
    },
  },
  {
    path: "/auth/forget",
    name: "forget",
    component: Forget,
    meta: {
      noAuth: true,
    },
  },
  {
    path: "/auth/reset",
    name: "reset",
    component: Reset,
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
