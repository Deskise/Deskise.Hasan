import Chat from "@/config/Services/ChatService";

export const namespaced = true;

export const state = {
  chats: [],
};

export const mutations = {
  LIST(state, payload) {
    payload.forEach((e) =>
      state.chats.filter((c) => c.id == e.id).length === 0
        ? state.chats.push(e)
        : null
    );
  },
};

export const actions = {
  async list({ commit }, page = 1) {
    await Chat.list(page).then(({ data }) => {
      console.log(data);
      commit("LIST", data.response.extra);
    });
  },
};

export const getters = {};
