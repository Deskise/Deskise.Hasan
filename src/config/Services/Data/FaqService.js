import apiClient from "@/config/axios";

export default {
  fetch(page) {
    return apiClient.get("/data/faq", ["page." + page]);
  },
};
