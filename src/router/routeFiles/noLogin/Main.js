import erorr404 from "@/views/404.vue";

export const routes = [
  {
    path: "/404",
    name: "404",
    component: erorr404,
  },
  {
    path: "/:catchAll(.*)",
    redirect: "/404",
  },
];
