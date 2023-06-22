import { v4 } from "uuid";
import SocialMedia from "@/config/Services/Data/SocialMedia";
import UserData from "@/config/Services/Auth/UserData";
import OtherUserData from "@/config/Services/Data/UserData";
import Dashboard from "@/config/Services/Dashboard";

export const namespaced = true;
export const state = {
  data: null,
  uuid: null,
  socialMedia: [],
  settings: null,
  otherUser: null,
  userProducts: []
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
  SET_OTHER_USER_DATA(state, data) {
    state.otherUser = data;
  },
  SET_OTHER_USER_PRODUCTS(state, data) {
    if (state.otherUser.products === undefined) {
      state.otherUser.products = {};
      state.otherUser.products.data = [];
    }
    state.otherUser.products.current_page = data.current_page;
    state.otherUser.products.next_page_url = data.next_page_url;
    data.data.forEach((d) => {
      state.otherUser.products.data.push(d);
    });
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
    state.settings = null;
    localStorage.removeItem("deskies_user");
  },
  CHANGE_UUID(state, UUID) {
    state.uuid = UUID;
    localStorage.setItem("deskies_user_uuid", UUID);
  },
  UPDATE_BANNER(state, banner) {
    state.otherUser.banner = banner
  },
  USER_PRODUCTS(state, userProducts) {
    state.userProducts = userProducts
  }
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
  async getOtherData({ commit }, { id }) {
    await OtherUserData.data(id).then((res) => {
      commit("SET_OTHER_USER_DATA", res.data.response.extra[0]);
    });
  },
  async getOtherProducts({ commit }, { id, page }) {
    await OtherUserData.products(id, page).then(({ data }) => {
      commit("SET_OTHER_USER_PRODUCTS", data.response.extra[0]);
    });
  },
  async updateBanner({ commit }, banner ) {
    await Dashboard.updateBanner(banner).then((e) => {
      commit("UPDATE_BANNER", e.data.banner)
    })
  },
  async userProducts({ commit }, id) {
    await OtherUserData.userProducts(id).then((e) => {
      console.log(e.data.response.extra);
      commit("USER_PRODUCTS", e.data.response.extra)
    })
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
  userId: (state) => {
    return state.data.id;
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
  sameUser: (state) => {
    return state.otherUser.id === state.data.id;
  },
  userPackages: (state) => {
    const flatArray = Object.values(state.userProducts.userPackages).flat();
    const uniquePackages = flatArray.reduce((packs, currentPackage) => {
      const existingPackage = packs.find(p => p.package_id === currentPackage.package_id);
      if (!existingPackage) {
        packs.push(currentPackage);
      }
      return packs;
    }, []);
    return uniquePackages;
  },
  
  views(state) {
    return Object.values(state.userProducts.productsViews)
  },
  productsIds: (state) => {
    return Object.keys(state.userProducts.productsViews)
  },
  monthlyViews: (state) => {
    return state.userProducts.periodViews
  },
  totalViews: (state) => {
    return state.userProducts.totalViews
  }
};
