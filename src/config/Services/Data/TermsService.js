import apiClient from "@/config/axios";

export default {
  fetch($for) {
    return apiClient.get("/data/terms/" + $for);
  },
};
