import Chat from "@/config/Services/ChatService";

export const namespaced = true;

export const state = {
  chats: [],
  blocked: [],
  userChat:[]
};

export const mutations = {
  LIST(state, payload) {
    payload.forEach((e) =>
      state.chats.filter((c) => c.id == e.id).length === 0
        ? state.chats.push(e)
        : null
    );
  },
  // BLOCK(state, chat_id, rootState) {
    BLOCK(state, payload) {
    const { chat_id, rootState } = payload;
    const blockerId = rootState.user.data.id;
    state.chats.forEach((chat) => {
      if (chat.id === parseInt(chat_id)) {
        chat.blocker.push({
          id: blockerId
        })
      }
    });
  
    // const existingChat = state.blocked.find((chat) => chat.id === parseInt(chat_id));
    // if (!existingChat) {
    //   state.blocked.push({ blocked: true });
    // }
  },
  

  BLOCKED(state, payload) {
    payload.forEach((e) => {
      const existingChat = state.chats.find((c) => c.user.id === e.user.id);
      if (!existingChat) {
        state.blocked.push({ ...e, blocked: true });
        state.chats.push({ ...e, blocked: true })
      } else {
        return;
      }
    });
  },
  UNBLOCK(state, chat_id) {
    state.chats.forEach((chat) => {
      if (chat.id === parseInt(chat_id)) {
        chat.blocker = []
      }
    });
  },
  // UNBLOCK(state, chat_id) {
  //   console.log(chat_id);
  //   state.chats = state.chats.map(chat => {
  //     if (chat.id === parseInt(chat_id)) {
  //       const { blocked, ...rest } = chat;
  //       console.log(blocked);
  //       return rest;
  //     } else {
  //       return chat;
  //     }
  //   });

  //   state.blocked = state.blocked.filter(chat => chat.id !== parseInt(chat_id));
  // },

  SET_USER_CHAT(state, msgs) {
    state.userChat = msgs
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
  
  // async block(context, {chat_id}) {
  //   const { commit, rootState } = context;
  //   console.log("the report",context);
  //   commit('BLOCK', chat_id, rootState)
  //   await Chat.chat(chat_id).block()
  // },
  async block({ commit, rootState }, { chat_id }) {
    console.log("the report", rootState);
    commit('BLOCK', { chat_id, rootState });
    await Chat.chat(chat_id).block();
  },
  

  async unblock(context, {chat_id}) {
    console.log(context);
    await Chat.chat(chat_id).unblock()
    context.commit('UNBLOCK', chat_id)
  }
};

export const getters = {
  // Getter function to return chats where the nested blocker array is empty
  chats: (state,getters, rootState) => {
    const userId = rootState.user.data.id;
    console.log(userId);
    return state.chats.filter(chat => chat.blocker.length === 0);
  },
  
  // Getter function to return chats where blocker.id = store.state.user.id
  blocked: (state,getters, rootState) => {
    return state.chats.filter(chat => {
      return chat.blocker.some(blocker => blocker.id === rootState.user.data.id);
    });
  },
  // Getter function to return chats where blocker.id != store.rootState.user.data.id
  hidden: (state,getters, rootState) => {
    return state.chats.filter(chat => {
      return chat.blocker.every(blocker => blocker.id !== rootState.user.data.id);
    });
  },

  agreements: (state) => {
    return state.userChat.filter((chat) => {
      return chat.type === 'agreement' && chat.status === 'waiting';
    });
  },

  // files: (state) => {
  //   return state.userChat.filter((chat) => {
  //     return chat.type === 'textphoto' && chat.attachments.length >=0;
  //   });
  // },

  files: (state) => {
    const groupedFiles = {};

    state.userChat.forEach((chat) => {
      if (chat.type === 'textphoto' && chat.attachments.length >= 0) {
        const date = chat.created_at.slice(0, 10);
        if (!groupedFiles[date]) {
          groupedFiles[date] = [];
        }
        groupedFiles[date].push(chat);
      }
    });

    return groupedFiles;
  },

};
