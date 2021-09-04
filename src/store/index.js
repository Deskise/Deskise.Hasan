import { createStore } from "vuex";
import * as user from "./Modules/user";
import * as notification from "./Modules/Notification";
import * as category from "./Modules/Category";
import * as data from "./Modules/Data";
import * as blog from "./Modules/Blog";

export default createStore({
    state: {
        Loading: false,
        ready: false,
    },
    mutations: {
        CHANGE_LOADING_STATE(state, to = null) {
            state.Loading = to !== null ? to : !state.Loading;
        },
        READY_STATE_CHANGE(state) {
            state.ready = true;
        },
    },
    actions: {
        ChangeLoading({ commit }, to = null) {
            commit("CHANGE_LOADING_STATE", to);
        },
    },
    modules: {
        user,
        notification,
        category,
        data,
        blog,
    },
});
