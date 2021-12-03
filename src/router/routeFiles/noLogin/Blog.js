import Blog from "@/views/Blog";
import BlogSingle from "@/views/Blog/single";
import store from "@/store";

export const routes = [
  {
    path: "/blog",
    name: "blog",
    component: Blog,
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
    component: BlogSingle,
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
