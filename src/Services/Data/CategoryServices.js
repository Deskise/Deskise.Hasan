import apiClient from "@/axios";

export default {
  fetch(id = 0) {
    return apiClient.get("/data/categories" + (id !== 0 ? "/" + id : ""));
  },
};
