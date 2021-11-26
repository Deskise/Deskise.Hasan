import apiClient from "@/config/axios";

export default {
  subscribe(email) {
    return apiClient.post("/data/newsletter", {
      email,
    });
  },
};
