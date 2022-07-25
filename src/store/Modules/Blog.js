import Blog from "@/config/Services/Data/BlogServices";

export const namespaced = true;

export const state = {
  Posts: { current_page: null, next_page_url: null, data: [] },
  SinglePostData: {},
};

export const mutations = {
  FETCH_POSTS(state, $posts) {
    state.Posts.current_page = $posts.current_page;
    state.Posts.next_page_url = $posts.next_page_url;
    $posts.data.forEach((post) => {
      state.Posts.data[post.id] = post;
    });
  },
  FETCH_POST(state, post) {
    state.SinglePostData[post.id] = post;
  },
  FETCH_CATEGORY(state, $posts) {
    $posts.data.forEach((post) => {
      state.Posts.data[post.id] = post;
    });
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
  async fetchOne({ commit }, { id }) {
    await Blog.fetchOne(id)
      .then((response) => {
        let data = response.data.response.extra[0];
        commit("FETCH_POST", data);
      })
      .catch(() => {});
  },
  async fetchCatecory({ commit }, { id }) {
    await Blog.fetchCat(id) 
      .then((response) => {
        let data = response.data.response.extra[0];
        commit("FETCH_CATEGORY", data);
      })
      .catch(() => {});
  },
  async LikePost({ dispatch }, { id }) {
    await Blog.likePost(id)
      .then((response) => {
        dispatch(
          "notification/add",
          {
            message: response.data.response.message,
            status: true,
          },
          { root: true }
        );
      })
      .catch(() => {});
  },
};

export const getters = {
  getPostsByCategoryId:
    (state) =>
    ($id = 0) => {
      if (state.Posts.data !== [])
        if ($id === 0)
          return state.Posts.data.filter((post) => {
            return post !== undefined;
          });
        else
          return state.Posts.data.filter((post) => {
            return (post !== undefined && post.category.id) === $id;
          });

      return [];
    },
  getSinglePostById: (state) => (id) => {
    return state.SinglePostData.filter((post) => {
      return post.id === id;
    });
  },
};
