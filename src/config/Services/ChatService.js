import apiClient from "@/config/axios";

export default {
  rules() {
    return apiClient.get("/chat/rules", [], true);
  },
  list(page) {
    return apiClient.get("/chat/list", ["page." + page], true);
  },
  chat(chat_id) {
    return {
      messages(page) {
        return apiClient.get(
          `/chat/${chat_id}/messages`,
          ["page." + page],
          true
        );
      },
      files(page) {
        return apiClient.get(`/chat/${chat_id}/files`, ["page." + page], true);
      },
      agreements(page) {
        return apiClient.get(
          `/chat/${chat_id}/agreements`,
          ["page." + page],
          true
        );
      },

      // SEND THING HERE
      send() {
        return {
          message(message) {
            return apiClient.post(
              `/chat/${chat_id}/send/message`,
              { message },
              true
            );
          },
          agreement(details, file_types, price, note) {
            return apiClient.post(
              `/chat/${chat_id}/send/agreement`,
              { details, file_types, price, note },
              true
            );
          },
          attachment(attachments) {
            return apiClient.post(
              `/chat/${chat_id}/send/attachment`,
              { attachments },
              true
            );
          },
          call() {
            return apiClient.post(`/chat/${chat_id}/send/call`, {}, true);
          },
        };
      },
      report(note) {
        return apiClient.post(`/chat/${chat_id}/report`, { note }, true);
      },
      block() {
        return apiClient.get(`/chat/${chat_id}/block`, [], true);
      },
      unblock() {
        return apiClient.get(`/chat/${chat_id}/unblock`, [], true);
      },
    };
  },
};
