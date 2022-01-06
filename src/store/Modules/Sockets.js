import store from "..";
import Echo from "laravel-echo";

export const namespaced = true;
export const state = {
  sockets: [
    {
      id: "Public",
      name: "Public",
      channel: "user.public.::id::",
      status: false,
      listen: {
        NewNotification: (e) => {
          console.log(e);
        },
        admin: (e) => {
          console.log(e);
        },
        messages: (e) => {
          console.log(e);
        },
      },
    },
    //TODO: Calls Websocket Connection.
  ],
};

export const mutations = {
  INIT_ECHO() {
    window.Pusher = require("pusher-js");
    const echo = new Echo({
      broadcaster: "pusher",
      key: process.env.VUE_APP_ECHO_KEY,
      wsHost: process.env.VUE_APP_ECHO_HOST,
      httpHost: process.env.VUE_APP_ECHO_HOST,
      authEndpoint: process.env.VUE_APP_ECHO_AUTHENDPOINT,
      wsPort: process.env.VUE_APP_ECHO_PORT,
      connectOnLogin: true,
      forceTLS: false,
      disableStats: true,
      auth: {
        headers: {
          Authorization: "Bearer " + store.state.user.data.token,
          Accept: "application/json",
        },
      },
    });
    window.Echo = echo;
  },
  CONNECT_SOCKETS() {
    store.getters["sockets/sockets"].forEach((socket) => {
      let s = window.Echo.private(socket.channel).subscribed(() => {
        socket.status = true;
        console.log(
          "%c" + socket.name + " Channel Subscribed",
          `font-size:20px; color: green`
        );
      });
      Object.keys(socket.listen).map((key) => {
        s.listen(key, socket.listen[key]);
      });
    });
  },
};

export const actions = {
  init_echo({ commit }) {
    if (store.getters["user/isLoggedIn"] && window.Echo === undefined)
      commit("INIT_ECHO");
  },
  connect_sockets({ commit }) {
    if (store.getters["user/isLoggedIn"]) commit("CONNECT_SOCKETS");
  },
};

export const getters = {
  sockets: (state) => {
    state.sockets.forEach((socket) => {
      socket.channel = socket.channel.replace(
        /::id::/g,
        store.state.user.data.id
      );
    });
    return state.sockets.filter((socket) => !socket.status);
  },
};
