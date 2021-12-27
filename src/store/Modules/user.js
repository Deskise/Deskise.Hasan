import { v4 } from "uuid";
import SocialMedia from "@/config/Services/Data/SocialMedia";
import UserData from "@/config/Services/Auth/UserData";

export const namespaced = true;
export const state = {
  data: null,
  uuid: null,
  socialMedia: [],
  settings: null,
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
    let d = data;
    d["uuid"] = state.uuid;
    if (state.data !== null) {
      d["token"] = state.data["token"];
      d["token_expire"] = state.data["token_expire"];
      d["token_type"] = state.data["token_type"];
    }
    state.data = d;

    localStorage.setItem("deskies_user", JSON.stringify(state.data));
  },
  SET_TOKEN(state, { token, type, exp }) {
    state.data["token"] = token;
    state.data["token_type"] = type;
    state.data["token_expire"] = exp;

    localStorage.setItem("deskies_user", JSON.stringify(state.data));
  },
  SET_SOCIAL_MEDIA(state, socialMedia) {
    state.socialMedia = socialMedia;
  },
  SET_SETTINGS(state, settings) {
    state.settings = settings;
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

  async fetchSocailMedia({ commit }) {
    await SocialMedia.fetch()
      .then((response) => {
        let socialMedia = response.data.response.extra;
        commit("SET_SOCIAL_MEDIA", socialMedia);
      })
      .catch(() => {});
  },
  async fetchSettings({ commit }) {
    await UserData.settings()
      .then((response) => {
        let settings = response.data.response.extra;
        commit("SET_SETTINGS", settings[0]);
      })
      .catch(() => {});
  },
  async getData({ commit }) {
    await UserData.data()
      .then(({ data }) => {
        commit("SET_DATA", data.response.extra[0]);
      })
      .catch(() => {});
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
  getUserData: (state) => {
    return {
      backup_email: state.data.backup_email,
      backup_phone: state.data.backup_phone,
      bio: state.data.bio,
      email: state.data.email,
      firstname: state.data.firstname,
      id: state.data.id,
      img: state.data.img,
      lastname: state.data.lastname,
      links: state.data.links,
      location: state.data.location,
      phone: state.data.phone,
    };
  },
};
