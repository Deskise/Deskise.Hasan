import category from "@/Services/Data/CategoryServices";

export const namespaced = true;

export const state = {
    categories: [],
};

export const mutations = {
    FETCH(state, categories) {
        state.categories = categories;
    },
};

export const actions = {
    fetch({ commit }) {
        category
            .fetch()
            .then((response) => {
                commit("FETCH", response.data.response.extra);
                commit("READY_STATE_CHANGE", null, { root: true });
            })
            .catch(() => {});
    },
};

export const getters = {};
