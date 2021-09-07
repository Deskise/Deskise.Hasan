import Blog from "@/Services/Data/BlogServices";

export const namespaced = true;

export const state = { Posts: {} };

export const mutations = {
  FETCH_POSTS(state, $posts) {
    if (state.Posts.data === undefined) {
      state.Posts = $posts;
    } else {
      state.Posts.current_page = $posts.current_page;
      state.Posts.next_page_url = $posts.next_page_url;
      state.Posts.data.push(...$posts.data);
    }
  },
};

export const actions = {
  async fetch({ commit }, { page }) {
    await Blog.fetch(page)
      .then((response) => {
        let posts = response.data.response.extra[0];
        commit("FETCH_POSTS", posts);
      })
      .catch(() => {});
  },
};

export const getters = {
  getPostsByCategoryId:
    (state) =>
    ($id = 0) => {
      if (state.Posts.data !== undefined)
        if ($id === 0) return state.Posts.data;
        else
          return state.Posts.data.filter((post) => {
            return post.category.id === $id;
          });
    },
};
