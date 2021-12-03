import apiClient from "@/config/axios";

export default {
  via(v, token) {
    return apiClient.post("/auth/login/" + v.toLowerCase(), {
      token,
    });
  },
  login(email, password, remember_me) {
    return apiClient.post("/auth/login", {
      email,
      password,
      remember_me,
    });
  },
};
