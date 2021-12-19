import store from "@/store";

function lazyLoad(view) {
  return import(/* webpackChunkName: "Blog" */ `@/views/Blog/${view}.vue`);
}

export const routes = [
  {
    path: "/blog",
    name: "blog",
    component: lazyLoad("index"),
    beforeEnter: async function (routeTo, from, next) {
      if (store.state.blog.Posts.data) {
        await store.dispatch("blog/fetch", { page: 1 });
      }
      next();
    },
  },
  {
    path: "/blog/post/:id",
    name: "blogSingle",
    component: lazyLoad("single"),
    beforeEnter: async function (routeTo, from, next) {
      if (
        store.state.blog.SinglePostData === [] ||
        store.state.blog.SinglePostData[routeTo.params.id] === undefined
      ) {
        await store.dispatch("blog/fetchOne", { id: routeTo.params.id });
      }
      next();
    },
  },
];
