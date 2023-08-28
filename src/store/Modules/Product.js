import Product from "@/config/Services/Products/ListService.js";

export const namespaced = true;

export const state = {
  products: { current_page: null, next_page_url: null, data: {}, category: 0, single: {} },
  best: { current_page: null, next_page_url: null, data: {}, category: 0 },
  newProduct: null,
  file: null,
  edit: {info: null, packages: null},
  similar: {}
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
      // state.products.single[element.id] = element;
    });
  },
  SINGLE(state, prod) {
    // state.products.data[prod.id] = prod;
    state.products.single = {};
    state.products.single[prod.id] = prod;
    state.similar = {}
    prod.similar.forEach((el) => {
      state.similar[el.id] = el
    })
    // state.similar = prod.similar
    // state.similar = Object.keys(prod.similar).map((i) => {
    //    return prod.similar[i].id
    // })
    //   .filter((e) => e !== undefined && e !== null);
  },
  SIMILAR(state, similar) {
    state.similar = similar
  },
  EDIT(state, prod) {
    state.edit.info = prod
    state.edit.packages = prod.data.data.packages
  },
  BEST(state, prod) {
    state.best.current_page = prod.current_page;
    state.best.next_page_url = prod.next_page_url;
    prod.data.forEach((element) => {
      state.best.data[element.id] = element;
    });
  },
  ADD(state, prod) {
    state.newProduct.push(prod)
  },

  upload(state, file) {
    state.file = file
  }
};

export const actions = {
  async list({ commit }, { page = 1, category = 0 }) {
    await Product.list(page, category).then((e) => {
      commit("FETCH_PRODUCTS", { category, obj: e.data.response.extra[0] });
    });
  },

  async single({ commit }, { id, category = 0 }) {
    await Product.list(2, 0).then((e) => {
      commit("FETCH_PRODUCTS", { category, obj: e.data.response.extra[0] });
    });
    await Product.single(id).then((e) => {
      commit("SINGLE", e.data.response.extra[0]);
    });
  },

  async similar({commit}, catId) {
    await Product.similar(catId).then((e) => {
      console.log(catId);
      commit("SIMILAR", e.data)
    })
  },
  async best({ commit }) {
    await Product.best().then((e) => {
      commit("BEST", e.data.response.extra[0]);
    });
  },

  async add({commit}, {product}) {
    await Product.addProduct(product).then((e) => {
      commit("ADD", e.data.response)
    })
  },

  async edit({commit}, {id}) {
    await Product.edit(id).then((e) => {
      commit("EDIT", e.data.response.extra[0])
    })
  },

  async update( id , {product }) {
    await Product.update(id, product).then((e) => {
      console.log(e.data);
    })
  },
  async LikeProduct({ dispatch }, id ) {
    await Product.LikeProduct(id)
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
  products:
    (state) =>
    ({ not = 0 }) => {
      return Object.keys(state.products.data)
        .map((i) => {
          if (i != not) return state.products.data[i].id;
        })
        .filter((e) => e !== undefined && e !== null);
    },
  similarArray(state) {
    // return state.similar
    return Object.keys(state.similar).map((i) => {
      return state.similar[i].id
    })
      .filter((e) => e !== undefined && e !== null);
  },

  Allproducts: (state) => {
    return state.products.data;
  },
  info: (state) => {
    return state.edit.info
  },
  selectedPackages: (state) => {
    return JSON.parse(state.edit.packages)
  }
};
