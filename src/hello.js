import { Vue } from "./init";
import hello from "hellojs";

const h = hello.init(
  {
    facebook: process.VUE_APP_FACEBOOK_APP_ID,
    google: process.VUE_APP_GOOGLE_APP_ID,
  },
  { redirect_uri: "https://localhost:8080/" }
);
Vue.config.globalProperties.h = h;
