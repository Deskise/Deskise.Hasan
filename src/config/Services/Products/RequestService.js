import apiClient from "@/config/axios";

export default {
  send(category, subcategory, price, message, email, sendEmails = 0) {
    return apiClient.post("/products/request", {
      category,
      subcategory,
      price,
      message,
      email,
      sendEmails,
    });
  },
};
