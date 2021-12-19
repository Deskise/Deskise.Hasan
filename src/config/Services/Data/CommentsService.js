import apiClient from "@/config/axios";

export default {
  fetch() {
    return apiClient.get("/data/comments");
  },
};
