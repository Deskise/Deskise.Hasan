import Login from "@/views/Auth/Login.vue";
import Signup from "@/views/Auth/Signup.vue";
import Forget from "@/views/Auth/Forget.vue";

export const routes = [
  {
    path: "/login",
    name: "login",
    component: Login,
  },
  {
    path: "/signup",
    name: "signup",
    component: Signup,
  },

  {
    path: "/forget",
    name: "forget",
    component: Forget,
  },
];
