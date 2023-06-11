import Chat from "@/config/Services/ChatService";

export const namespaced = true;

export const state = {
  chats: [],
  blocked: []
};

export const mutations = {
  LIST(state, payload) {
    payload.forEach((e) =>
      state.chats.filter((c) => c.id == e.id).length === 0
        ? state.chats.push(e)
        : null
    );
  },

  BLOCKED(state, payload) {
    payload.forEach((e) =>
      state.blocked.filter((c) => c.id == e.id).length === 0
        ? state.blocked.push(e)
        : null
    )
  }
};

export const actions = {
  async list({ commit }, page = 1) {
    await Chat.list(page).then(({ data }) => {
      console.log(data);
      commit("LIST", data.response.extra);
    });
  },

  async blocked({ commit }, page = 1) {
    await Chat.blocked(page).then(({ data }) => {
      console.log('Blocked', data.response.extra);
      commit('BLOCKED', data.response.extra)
    })
  },

  async textPhoto(context, { formData, chatId, type }) {
    console.log(context);
    await Chat.chat().send().textPhoto(formData, chatId, type)
  },

  async agreement(context, { agreement, chatId, type }) {
    console.log(context);
    await Chat.chat().send().agreement(agreement, chatId, type)
  },

  async report(context, {notes, chat_id}) {
    console.log("the report",notes);
    console.log("the report",context);
    // console.log('chat id: ',chat_id);
    await Chat.chat(chat_id).report(notes)
  },
  
  async block(context, {chat_id}) {
    console.log("the report",context);
    console.log('chat id: ',chat_id);
    await Chat.chat(chat_id).block()
  }
};

export const getters = {};
