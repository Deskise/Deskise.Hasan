import apiClient from "@/axios";

export default {
  fetch($for) {
    return apiClient.get("/data/terms/" + $for);
  },
};
