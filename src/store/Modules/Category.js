import category from "@/config/Services/Data/CategoryServices";

export const namespaced = true;

export const state = {
  categories: [],
  subcategories: [],
};

export const mutations = {
  FETCH(state, categories) {
    categories.forEach((element) => {
      state.categories[element.id] = element;
    });
  },
  FETCH_SUB(state, subcategories) {
    subcategories.forEach((element) => {
      state.subcategories[element.id] = element.name;
    });
  },
};

export const actions = {
  async fetch({ commit }) {
    await category
      .fetch()
      .then(async (response) => {
        commit("FETCH", response.data.response.extra);
        await category.subcategories().then((res) => {
          commit("FETCH_SUB", res.data.response.extra.subcategories);
        });

        commit("READY_STATE_CHANGE", null, { root: true });
      })
      .catch(() => {});
  },
};

export const getters = {
  categories: (state) => {
    return state.categories.filter((e) => e !== null && e !== undefined);
  },
};
