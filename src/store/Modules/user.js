import { v4 } from "uuid";

export const namespaced = true;
export const state = {
  data: null,
  uuid: null,
};

export const mutations = {
  SET_UUID(state, uuid) {
    state.uuid = uuid;
    if (localStorage.getItem("deskies_user") !== null) {
      let storageData = JSON.parse(localStorage.getItem("deskies_user"));
      let date = Date.parse(storageData["token_expire"]) - Date.now();
      if (date > 0) state.data = storageData;
    }
  },
  SET_DATA(state, data) {
    state.data = data;
    state.data["uuid"] = state.uuid;

    localStorage.setItem("deskies_user", JSON.stringify(state.data));
  },
  SET_TOKEN(state, { token, type, exp }) {
    state.data["token"] = token;
    state.data["token_type"] = type;
    state.data["token_expire"] = exp;

    localStorage.setItem("deskies_user", JSON.stringify(state.data));
  },
  ERASE_USER_DATA(state) {
    state.data = null;
    localStorage.removeItem("deskies_user");
  },
  CHANGE_UUID(state, UUID) {
    state.uuid = UUID;
    localStorage.setItem("deskies_user_uuid", UUID);
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
  setToken({ commit }, { token, type, exp }) {
    commit("SET_TOKEN", { token, type, exp });
  },
  logout({ commit }) {
    commit("ERASE_USER_DATA");
    commit("CHANGE_UUID", v4().substr(0, 30));
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
