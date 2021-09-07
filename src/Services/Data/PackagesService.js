import apiClient from "@/axios";

export default {
  fetch() {
    return apiClient.get("/data/packages");
  },
};
