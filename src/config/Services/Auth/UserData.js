import apiClient from "@/config/axios";

export default {
  data() {
    return apiClient.get("/auth/user", [], true);
  },
  settings() {
    return apiClient.get("/auth/user/settings", [], true);
  },
};
