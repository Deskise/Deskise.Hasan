import apiClient from "@/config/axios";
export default {
  userData(data) {
    return apiClient.post("/dashboard/user/data", data, true);
  },
  alerts(alerts) {
    return apiClient.post("/dashboard/user/alerts", alerts, true);
  },
};
