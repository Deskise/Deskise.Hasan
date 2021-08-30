export const routes = [
    {
        path: "/404",
        name: "404",
        component: () =>
            import(/* webpackChunkName: "404" */ "@/views/404.vue"),
    },
    {
        path: "/:catchAll(.*)",
        redirect: "/404",
    },
];
