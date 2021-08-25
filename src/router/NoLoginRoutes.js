import Home from "../views/Home.vue";

export const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/about",
        name: "About",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
            import(/* webpackChunkName: "about" */ "../views/About.vue"),

        meta: {
            requireAuth: true,
        },
    },
    {
        path: "/login",
        name: "login",
        component: () =>
            import(/* webpackChunkName: "404" */ "../views/Auth/Login.vue"),
    },
];
