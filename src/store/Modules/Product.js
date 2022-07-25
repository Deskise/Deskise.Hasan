import Product from "@/config/Services/Products/ListService.js";

export const namespaced = true;

export const state = {
  products: { current_page: null, next_page_url: null, data: {}, category: 0 },
  best: { current_page: null, next_page_url: null, data: {}, category: 0 },
};

export const mutations = {
  FETCH_PRODUCTS(state, { category, obj }) {
    state.products.current_page = obj.current_page;
    state.products.next_page_url = obj.next_page_url;
    if (category != state.products.category) {
      state.products.category = category;
      state.products.data = {};
    }
    obj.data.forEach((element) => {
      state.products.data[element.id] = element;
    });
  },
  SINGLE(state, prod) {
    state.products.data[prod.id] = prod;
  },
  BEST(state, prod) {
    state.best.current_page = prod.current_page;
    state.best.next_page_url = prod.next_page_url;
    prod.data.forEach((element) => {
      state.best.data[element.id] = element;
    });
  },
};

export const actions = {
  async list({ commit }, { page = 1, category = 0 }) {
    await Product.list(page, category).then((e) => {
      commit("FETCH_PRODUCTS", { category, obj: e.data.response.extra[0] });
    });
  },

  async single({ commit }, { id }) {
    await Product.single(id).then((e) => {
      commit("SINGLE", e.data.response.extra[0]);
    });
  },
  async best({ commit }) {
    await Product.best().then((e) => {
      commit("BEST", e.data.response.extra[0]);
    });
  },
};

export const getters = {
  products:
    (state) =>
    ({ not = 0 }) => {
      return Object.keys(state.products.data)
        .map((i) => {
          if (i != not) return state.products.data[i].id;
        })
        .filter((e) => e !== undefined && e !== null);
    },
  Allproducts: (state) => {
        return state.products.data
    },
};
