import store from "@/store";
import Home from "@/views/website/Home";

export const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/about",
        name: "about",
        component: () =>
            import(/* webpackChunkName: "About" */ "@/views/website/About.vue"),
        beforeEnter: async function (routeTo, from, next) {
            if (store.state.data.about.page === null) {
                await store.dispatch("data/about", "page").then((data) => {
                    routeTo.params.about = data;
                });
            } else {
                routeTo.params.about = store.state.data.about.page;
            }
            next();
        },
    },
    {
        path: "/action",
        name: "action",
        component: () =>
            import(
                /* webpackChunkName: "Action" */ "@/views/website/Action.vue"
            ),
        beforeEnter: async function (routeTo, from, next) {
            if (store.state.data.packages.length === 0) {
                await store.dispatch("data/packages");
            }
            next();
        },
    },
    {
        path: "/terms&conditions",
        name: "terms",
        component: () =>
            import(/* webpackChunkName: "Terms" */ "@/views/website/Terms.vue"),
        beforeEnter: async function (routeTo, from, next) {
            routeTo.params.name = "terms";
            if (store.state.data.terms.terms === null) {
                await store.dispatch("data/terms", "terms").then((data) => {
                    routeTo.params.term = data;
                });
            } else {
                routeTo.params.term = store.state.data.terms.terms;
            }
            next();
        },
    },
    {
        path: "/privacy",
        name: "privacy",
        component: () =>
            import(/* webpackChunkName: "Terms" */ "@/views/website/Terms.vue"),
        beforeEnter: async function (routeTo, from, next) {
            routeTo.params.name = "privacy";
            if (store.state.data.terms.privacy === null) {
                await store.dispatch("data/terms", "privacy").then((data) => {
                    routeTo.params.term = data;
                });
            } else {
                routeTo.params.term = store.state.data.terms.privacy;
            }
            next();
        },
    },
    {
        path: "/frequentity-asked-questions",
        name: "faq",
        component: () =>
            import(/* webpackChunkName: "Faqs" */ "@/views/website/Faqs.vue"),
        beforeEnter: async function (routeTo, from, next) {
            if (store.state.data.packages.length === 0) {
                await store.dispatch("data/packages");
            }
            next();
        },
    },
];
