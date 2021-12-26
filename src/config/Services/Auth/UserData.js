import apiClient from "@/config/axios";

export default {
  data() {
    return apiClient.get("/auth/user", [], true);
  },
  alerts() {
    return apiClient.get("auth/user/alerts", [], true);
  },
};
