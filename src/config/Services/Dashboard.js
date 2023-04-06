import apiClient from "@/config/axios";
export default {
  userData(data) {
    return apiClient.post("/dashboard/user/data", data, true);
  },

  updateBanner(banner) {
    return apiClient.post("/dashboard/user/update-banner", banner, true);
  },

  alerts(alerts) {
    return apiClient.post("/dashboard/user/alerts", alerts, true);
  },

  changePassword(old_password, new_password, new_password_confirmation) {
    return apiClient.post(
      "/dashboard/user/password/change",
      { old_password, new_password, new_password_confirmation },
      true
    );
  },

  close() {
    return apiClient.post("/dashboard/user/account/close", [], true);
  },
};
