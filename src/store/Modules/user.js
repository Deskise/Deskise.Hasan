import { v4 } from "uuid";

export const namespaced = true;
export const state = {
  data: null,
  uuid: null,
  //{
  //     id: null,
  //     firstname: null,
  //     lastname: null,
  //     bio: null,
  //     img: null,
  //     email: null,
  //     backup_email: null,
  //     phone: null,
  //     backup_phone: null,
  //     location: null,
  //     uuid: null,
  //     facebook_login: false,
  //     google_login: false,
  //     token: null,
  //     token_type: "Bearer",
  // }
};

export const mutations = {
  SET_UUID(state, uuid) {
    state.uuid = uuid;
  },
};

export const actions = {
  getUUID({ commit }) {
    if (localStorage.getItem("deskies_user_uuid") === null) {
      localStorage.setItem("deskies_user_uuid", v4());
    }

    commit("SET_UUID", localStorage.getItem("deskies_user_uuid"));
  },
};

export const getters = {
  isLoggedIn: (state) => {
    return state.data === null ||
      typeof state.data !== "object" ||
      state.data.token === null
      ? false
      : true;
  },
};
