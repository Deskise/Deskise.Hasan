
export const namespaced = true;
let nextId = 1;

export const state = {
  notifications: [],
  notificationList: [],
};

export const mutations = {
 
  // LIST(state, notification) {
  //   state.notificationList = [];
  //   Object.keys(notification).forEach((key) => {
  //     const singleNotification = notification[key];
  //     singleNotification.key = key;
  //     state.notificationList.push({...singleNotification});
  //     // if (singleNotification.read === false) {
  //     // }
  //   });
  // },

  LIST(state, notification) {
    const notifications = Object.keys(notification).map((key) => {
      const singleNotification = notification[key];
      singleNotification.key = key;
      return { ...singleNotification };
    });

    // Store only the last 10 notifications
    state.notificationList = notifications.slice(-12);
  },


  PUSH(state, notification) {
    // setTimeout(() => {
    state.notifications = [];

    const noti = Object.values(notification)
    const list = state.notificationList
    noti.forEach(function (item) {
      var keyExists = null;

      list.forEach(function (listItem) {
        if (item.read === false) {
          if (listItem.key !== item.key) {
            keyExists = true;
          }
        }
      });
      if (keyExists) {
        state.notifications.push(item);
      }
    });
    // }, 600)
  },
  DELETE(state, notification) {
    state.notifications = state.notifications.filter(
      (noti) => noti.id !== notification.id
    );
  },
  PUSH_NOT(state, notification) {
    state.notifications.push({ ...notification, id: nextId++ });
  },
};

export const actions = {
  async list({commit}, notification) {
    await commit("LIST", notification);
    await commit("PUSH", notification);
  },
  add({ commit }, notification) {
    commit("PUSH", notification);
  },
  addNot({ commit }, notification) {
    commit("PUSH_NOT", notification);
  },
  remove({ commit }, notification) {
    commit("DELETE", notification);
  },
};

export const getters = {};
