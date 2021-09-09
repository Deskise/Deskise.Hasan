import apiClient from "@/axios";
import store from "@/store";

export default {
  fetch(page) {
    return apiClient.get("/blog/posts", ["page." + page]);
  },
  fetchOne(id) {
    return apiClient.get("/blog/post/" + id, ["uuid." + store.state.user.uuid]);
  },
};
