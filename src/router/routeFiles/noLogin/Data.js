import store from "@/store";
import Home from "@/views/website/Home";
import About from "@/views/website/About.vue";
import Action from "@/views/website/Action.vue";
import Terms from "@/views/website/Terms.vue";
import FAQ from "@/views/website/Faqs.vue";

export const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
  },
  {
    path: "/about",
    name: "about",
    component: About,
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
    component: Action,
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
    component: Terms,
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
    component: Terms,
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
    component: FAQ,
    beforeEnter: async function (routeTo, from, next) {
      if (store.state.data.faq.data === undefined) {
        await store.dispatch("data/faqs", { page: 1 });
      }
      routeTo.params.email = process.env.VUE_APP_SUPPORT_EMAIL;
      next();
    },
  },
];
