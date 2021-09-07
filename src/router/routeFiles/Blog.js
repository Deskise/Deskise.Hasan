import Blog from "@/views/Blog";
import BlogSingle from "@/views/Blog";
import store from "../../store";

export const routes = [
  {
    path: "/blog",
    name: "blog",
    component: Blog,
    beforeEnter: async function (routeTo, from, next) {
      if (store.state.blog.Posts.data === undefined) {
        await store.dispatch("blog/fetch", { page: 1 });
      }
      next();
    },
    children: [
      {
        path: "post/:id",
        name: "blogSingle",
        component: BlogSingle,
      },
    ],
  },
];
