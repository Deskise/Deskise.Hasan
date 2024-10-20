import apiClient from "@/config/axios";

export default {
  send(name, email, message) {
    return apiClient.post("/data/contactus", { name, email, message });
  },
};
