import { Vue } from "@/init";
import hello from "hellojs";

const h = hello.init(
  {
    facebook: process.env.VUE_APP_FACEBOOK_APP_ID,
    google: process.env.VUE_APP_GOOGLE_APP_ID,
  },
  { redirect_uri: process.env.VUE_APP_HELLO_REDIRECT_URL }
);
Vue.config.globalProperties.h = h;
