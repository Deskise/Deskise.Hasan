import apiClient from "@/config/axios";

export default {
  verify(email, verify_code) {
    return apiClient.post("auth/verify/email", {
      email,
      verify_code,
    });
  },
  resend(email) {
    return apiClient.post("auth/verify/email/resend", {
      email,
    });
  },
};
