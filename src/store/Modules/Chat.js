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
  BLOCK(state, chat_id) {
    state.chats.forEach((chat) => {
      if (chat.id === parseInt(chat_id)) {
        chat.blocked = true;
        state.blocked.push(chat)
      }
    });
  
    // const existingChat = state.blocked.find((chat) => chat.id === parseInt(chat_id));
    // if (!existingChat) {
    //   state.blocked.push({ blocked: true });
    // }
  },
  

  BLOCKED(state, payload) {
    payload.forEach((e) => {
      const existingChat = state.chats.find((c) => c.id === e.id);
      if (!existingChat) {
        state.blocked.push({ ...e, blocked: true });
        state.chats.push({ ...e, blocked: true })
      } else {
        existingChat.blocked = true;
      }
    });
  },
  UNBLOCK(state, chat_id) {
    console.log(chat_id);
    state.chats = state.chats.map(chat => {
      if (chat.id === parseInt(chat_id)) {
        const { blocked, ...rest } = chat;
        console.log(blocked);
        return rest;
      } else {
        return chat;
      }
    });

    state.blocked = state.blocked.filter(chat => chat.id !== parseInt(chat_id));
  },

  // UNBLOCK(state, chat_id) {
  //   console.log('unblock mutation:', chat_id);
  //   // Remove blocked: true from state.chats
  //   state.chats.forEach(chat => {
  //     if (chat.id === parseInt(chat_id)) {
  //       delete chat.blocked;
  //     }
  //   });

  //   // Remove blocked: true from state.blocked
  //   state.blocked = state.blocked.filter(chat => chat.id !== parseInt(chat_id));
  // },


  // BLOCKED(state, payload) {
  //   payload.forEach((e) =>
  //     state.blocked.filter((c) => c.id == e.id).length === 0
  //       ? state.blocked.push(e)
  //       : null
  //   )
  // }
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
    context.commit('BLOCK', chat_id)
    await Chat.chat(chat_id).block()
  },

  async unblock(context, {chat_id}) {
    console.log(context);
    await Chat.chat(chat_id).unblock()
    context.commit('UNBLOCK', chat_id)
  }
};

export const getters = {};
