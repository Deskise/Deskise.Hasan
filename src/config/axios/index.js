import axios from "axios";
import store from "@/store";
import i18n from "../i18n";
import router from "@/router";
import Notification from "../Notification";

const apiClient = axios.create({
  baseURL: process.env.VUE_APP_BACKEND_API_URL,
  withCredentials: false, // This is the default
  headers: {
    Accept: "application/json",
    "content-type": "application/json",
    "accept-language": i18n.global.locale,
  },
});

apiClient.interceptors.response.use(
  (response) => {
    return response;
  },
  (err) => {
    if (err.response !== undefined) {
      if (err.response.status === 500) {
        Notification.addNotification("500: Internal Server Error", false);
        return;
      }

      let { data } = err.response;
      switch (data.code) {
        case 401:
          Notification.addNotification(data.response.message, false);
          router.push({ name: "login" });
          break;
        default:
          Notification.addNotification(data.response.message, false);
          break;
      }
    } else {
      Notification.addNotification(err.message, false);
    }
  }
);

export default {
  async post($url, $data, $auth = false, $headers = {}) {
    if ($auth === true)
      if (store.getters["user/isLoggedIn"])
        $headers.Authorization = "Bearer " + store.state.user.data.token;
      else router.push("/login");

    return await apiClient.post($url, $data, $headers);
  },

  async get($url, $data = [], $auth = false, $headers = {}) {
    if ($auth === true)
      if (store.getters["user/isLoggedIn"])
        $headers.Authorization = "Bearer " + store.state.user.data.token;
      else router.push("/login");

    return await apiClient.get(
      $url + "?" + $data.join("&").split(".").join("="),
      $headers
    );
  },
};
