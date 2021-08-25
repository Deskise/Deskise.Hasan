import { createRouter, createWebHistory } from "vue-router";
import store from "@/store";

import { routes as loggedIn } from "./loggedInRoutes";
import { routes as NoLogin } from "./NoLoginRoutes";

const routes = [
    ...(store.state.user.loggedIn ? loggedIn : NoLogin),
    {
        path: "/404",
        name: "404",
        component: () =>
            import(/* webpackChunkName: "404" */ "../views/404.vue"),
    },
    {
        path: "/:catchAll(.*)",
        redirect: "/404",
    },
];
routes.forEach((route) => {
    if (route.meta == undefined) {
        route.meta = {
            requireAuth: false,
        };
    }
    route.props = true;
});

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requireAuth)) {
        if (!store.state.user.loggedIn) {
            next({
                name: "login",
                query: { redirect: to.fullPath },
            });
        }
    }
    next();
});

export default router;
