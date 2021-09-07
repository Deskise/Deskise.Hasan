export const namespaced = true;
let nextId = 1;

export const state = {
  notifications: [],
};

export const mutations = {
  PUSH(state, notification) {
    state.notifications.push({ ...notification, id: nextId++ });
  },
  DELETE(state, notification) {
    state.notifications = state.notifications.filter(
      (noti) => noti.id !== notification.id
    );
  },
};

export const actions = {
  add({ commit }, notifiaction) {
    commit("PUSH", notifiaction);
  },
  remove({ commit }, notifiaction) {
    commit("DELETE", notifiaction);
  },
};

export const getters = {};
