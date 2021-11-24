import { v4 } from "uuid";

export const namespaced = true;
export const state = {
  data: null,
  uuid: null,
};

export const mutations = {
  SET_UUID(state, uuid) {
    state.uuid = uuid;
  },
  SET_DATA(state, data) {
    state.data = data;
    state.data["uuid"] = state.uuid;
  },
  SET_TOKEN(state, { token, type }) {
    state.data["token"] = token;
    state.data["token_type"] = type;
  },
};

export const actions = {
  getUUID({ commit }) {
    if (localStorage.getItem("deskies_user_uuid") === null) {
      localStorage.setItem("deskies_user_uuid", v4().substr(0, 30));
    }

    commit("SET_UUID", localStorage.getItem("deskies_user_uuid").substr(0, 30));
  },
  setUserData({ commit }, { data }) {
    commit("SET_DATA", data);
  },
  setToken({ commit }, { token, type }) {
    commit("SET_TOKEN", { token, type });
  },
};

export const getters = {
  isLoggedIn: (state) => {
    return !(
      state.data === null ||
      typeof state.data !== "object" ||
      state.data.token === null
    );
  },
};
