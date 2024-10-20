import store from "@/store";
export default {
  addNotification(message, status) {
    store.dispatch(
      "notification/add",
      {
        message,
        status,
      },
      { root: true }
    );
  },
};
