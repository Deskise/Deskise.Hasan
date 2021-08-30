export const routes = [
    {
        path: "/login",
        name: "login",
        component: () =>
            import(/* webpackChunkName: "Login" */ "@/views/Auth/Login.vue"),
    },
];
