import apiClient from "@/axios";

export default {
  fetch(page) {
    return apiClient.get("/data/faq", ["page." + page]);
  },
};
