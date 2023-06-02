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

  async textPhoto(context, { formData, chatId, type }) {
    console.log('from Chat.js',chatId);
    console.log('from Chat.js',type);
    console.log('from Chat.js',context);
    await Chat.chat().send().textPhoto(formData, chatId, type)
  },

  async agreement(context, { agreement, chatId, type }) {
    console.log('from Chat.js',chatId);
    console.log('from Chat.js', context);
    console.log('from Chat.js',agreement);
    await Chat.chat().send().agreement(agreement, chatId, type)
  }
};

export const getters = {};
