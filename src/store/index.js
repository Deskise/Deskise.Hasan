import { createStore } from "vuex";
import * as user from "./Modules/user";
import * as notification from "./Modules/Notification";
import * as category from "./Modules/Category";
import * as data from "./Modules/Data";
import * as blog from "./Modules/Blog";
import * as product from "./Modules/Product";

export default createStore({
  state: {
    pageY: false,
    Loading: false,
    ready: false,
    cookieAccepted: false,
    heightHeader: 0,
  },
  mutations: {
    CHANGE_LOADING_STATE(state, to = null) {
      state.Loading = to !== null ? to : !state.Loading;
    },
    READY_STATE_CHANGE(state) {
      state.ready = true;
    },
    ACCEPT_COOKIES(state) {
      state.cookieAccepted = true;
      localStorage.setItem("accept_cookies", true);
    },
    CANCEL_COOKIES(state) {
      state.cookieAccepted = true;
    },
    CHANGE_PAGEY(state, action) {
      state.pageY = action;
    },
    CHANGE_heightHeader(state, action) {
      state.heightHeader = action;
    },
  },
  actions: {
    ChangeLoading({ commit }, to = null) {
      commit("CHANGE_LOADING_STATE", to);
    },
    AcceptCookies({ commit }) {
      commit("ACCEPT_COOKIES");
    },
    CancelCookies({ commit }) {
      commit("CANCEL_COOKIES");
    },
    getCookieStatus({ state }) {
      if (
        localStorage.getItem("accept_cookies") !== undefined &&
        localStorage.getItem("accept_cookies") !== null
      ) {
        state.cookieAccepted = localStorage.getItem("accept_cookies");
      }
    },
  },
  modules: {
    user,
    notification,
    category,
    data,
    blog,
    product,
  },
});
