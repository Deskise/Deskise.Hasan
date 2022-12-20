import apiClient from "@/config/axios";

export default {
  rules() {
    return apiClient.get("/chat/rules", [], true);
  },
  list(page) {
    return apiClient.get("/chat/list", ["page." + page], true);
  },
  chat(chat_id) {},
};
