// chatService.js
import apiClient from "@/config/axios";
import firebase from '@/firebase';

export default {
  rules() {
    return apiClient.get("/chat/rules", [], true);
  },
  list(page) {
    return apiClient.get("/chat/list", ["page." + page], true);
  },
  blocked(page) {
    return apiClient.get("/chat/blocked", ["page." + page], true);
  },
  chat(chat_id) {
    return {
      messages(page) {
        return apiClient.get(`/chat/${chat_id}/messages`, ["page." + page], true);
      },
      files(page) {
        return apiClient.get(`/chat/${chat_id}/files`, ["page." + page], true);
      },
      agreements(page) {
        return apiClient.get(`/chat/${chat_id}/agreements`, ["page." + page], true);
      },
      send() {
        return {
          message(message) {
            return apiClient.post(`/chat/${chat_id}/send/message`, { message }, true)
              .then(() => {
                // Send notification
                const notificationPayload = {
                  notification: {
                    title: "New Message",
                    body: message,
                    icon: "/favicon.ico"
                  }
                };
                firebase.messaging().send(notificationPayload)
                  .then(response => {
                    console.log('Notification sent successfully:', response);
                  })
                  .catch(error => {
                    console.error('Error sending notification:', error);
                  });
              });
          },
          agreement(agreement, chatId, type) {
            console.log(agreement, 'chatid:', chatId, type);
            return apiClient.post(`/chat/${chatId}/send/${type}`, agreement, true);
          },
          attachment(attachments) {
            return apiClient.post(`/chat/${chat_id}/send/attachment`, { attachments }, true);
          },
          textPhoto(formData, chatId, type) {
            return apiClient.post(`/chat/${chatId}/send/${type}`, formData, true);
          },
          call() {
            return apiClient.post(`/chat/${chat_id}/send/call`, {}, true);
          },
        };
      },
      report(notes) {
        console.log(notes);
        return apiClient.post(`/chat/${chat_id}/report`, { notes }, true);
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
