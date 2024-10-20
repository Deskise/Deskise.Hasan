import apiClient from "@/config/axios";

export default {

  checkout(data) {
    return apiClient.post("/payment/create-payment", data, true);
  },

  createIntent(data) {
    return apiClient.post("/payment/create-paymentintent", data, true)
  },

  confirm() {
    return apiClient.get("/payment/confirm")
  },

  createConnectedAccount(user) {
    return apiClient.post("/payment/create-connected-account", user, true)
  },

  getWithdrawLimit() {
    return apiClient.get('/payment/get-withdraw-limit')
  }

}