import axios from "axios";
import store from "../store";
import i18n from "../i18n";
import router from "../router";

const apiClient = axios.create({
  baseURL: `http://127.0.0.1:8000/api/v1`,
  withCredentials: false, // This is the default
  headers: {
    Accept: "application/json",
    "content-type": "application/json",
    "accept-language": i18n.global.locale,
  },
});

export default {
  async post($url, $data, $auth = false, $headers = {}) {
    if ($auth === true) {
      if (store.getters["user/isLoggedIn"]) {
        $headers.Authorization = "Bearer " + store.state.user.data.token;
      } else {
        router.push("/login");
      }
    }

    try {
      const req = await apiClient.post($url, $data, $headers);
      return req;
    } catch (err) {
      if (err.response !== undefined) {
        let data = err.response.data;
        store.dispatch(
          "notification/add",
          {
            message: data.response.message,
            status: false,
          },
          { root: true }
        );
        switch (data.code) {
          case 401:
            router.push("/login");
            break;
        }
      } else {
        store.dispatch(
          "notification/add",
          {
            message: err.message,
            status: false,
          },
          { root: true }
        );
      }
    }
  },

  async get($url, $data = [], $auth = false, $headers = {}) {
    if ($auth === true) {
      if (store.getters["user/isLoggedIn"]) {
        $headers.Authorization = "Bearer " + store.state.user.data.token;
      } else {
        router.push("/login");
      }
    }

    try {
      let data = $url + "?" + $data.join("&").split(".").join("=");
      const req = await apiClient.get(data, $headers);
      return req;
    } catch (err) {
      if (err.response !== undefined) {
        let data = err.response.data;
        store.dispatch(
          "notification/add",
          {
            message: data.response.message,
            status: false,
          },
          { root: true }
        );
        switch (data.code) {
          case 401:
            router.push("/login");
            break;
        }
      } else {
        store.dispatch(
          "notification/add",
          {
            message: err.message + " - Can not process the request",
            status: false,
          },
          { root: true }
        );
      }
      return null;
    }
  },
};
