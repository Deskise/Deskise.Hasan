import Login from "@/views/Auth/Login.vue";
import Signup from "@/views/Auth/Signup.vue";
import Forget from "@/views/Auth/Forget.vue";
import Verify from "@/views/Auth/Verify.vue";

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
    path: "/auth/forget",
    name: "forget",
    component: Forget,
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
    path: "/auth/logout",
    name: "logout",
    component: Forget,
    meta: {
      requireAuth: true,
    },
  },
];
