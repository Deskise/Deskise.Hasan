import { createRouter, createWebHistory } from "vue-router";
import store from "@/store";
import { routes } from "./routeFiles";

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
    store.dispatch("ChangeLoading", true);
    next();
});
router.afterEach(() => {
    store.dispatch("ChangeLoading", false);
});

export default router;
