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

function addNotification(message, status) {
  store.dispatch(
    "notification/add",
    {
      message,
      status,
    },
    { root: true }
  );
}

apiClient.interceptors.response.use(
  (response) => {
    return response;
  },
  (err) => {
    if (err.response !== undefined) {
      if (err.response.status === 500) {
        addNotification("500: Internal Server Error", false);
        return;
      }

      let { data } = err.response;
      switch (data.code) {
        case 401:
          router.push("/login");
          break;
        default:
          addNotification(data.response.message, false);
          break;
      }
    } else {
      console.log(err);
      // addNotification(err.message, false);
    }
  }
);

export default {
  async post($url, $data, $auth = false, $headers = {}) {
    if ($auth === true) {
      if (store.getters["user/isLoggedIn"]) {
        $headers.Authorization = "Bearer " + store.state.user.data.token;
      } else {
        router.push("/login");
      }
    }

    const req = await apiClient.post($url, $data, $headers);
    return req;
  },

  async get($url, $data = [], $auth = false, $headers = {}) {
    if ($auth === true) {
      if (store.getters["user/isLoggedIn"]) {
        $headers.Authorization = "Bearer " + store.state.user.data.token;
      } else {
        router.push("/login");
      }
    }
    let data = $url + "?" + $data.join("&").split(".").join("=");
    const req = await apiClient.get(data, $headers);
    return req;
  },
};
