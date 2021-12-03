import apiClient from "@/config/axios";

export default {
  verify(email) {
    return apiClient.post("auth/forget", {
      email,
    });
  },
  resend(hash, new_password, new_password_confirmation) {
    return apiClient.post("auth/reset", {
      hash,
      new_password,
      new_password_confirmation,
    });
  },
};
