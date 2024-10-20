import { Vue } from "./init";
import router from "./router";
import store from "./store";
import { createHead } from "@vueuse/head";
import "./config/hello";
import PerfectScrollbar from "vue3-perfect-scrollbar";

import "vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css";
import firebase from 'firebase/app';
import 'firebase/auth';
import 'firebase/firestore';
import firebase, { requestForToken, onMessageListener } from './firebase';
import firebase from './firebase';
import { requestPermission } from './notification';
// import normalize.css
import "normalize.css";

// Datepicker
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

//Add bootstrap to your project
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";


// Import Swiper styles
import "swiper/swiper.scss";
import "swiper/components/pagination/pagination.min.css";
import "swiper/components/navigation/navigation.min.css";

// Import Nprogress css file:
import "nprogress/nprogress.css";

// Languages Support:
import i18n from "./config/i18n";

// Vue Loaders:
import "vue-loaders/dist/vue-loaders.css";
import VueLoaders from "vue-loaders";

// My Scss Files:
import "./sass/style.scss";

// My Custom Directives:
import "./config/directives";
import "./config/globals";

// My select
import vSelect from "vue-select";

Vue.use(i18n)
  .use(store)
  .use(VueLoaders)
  .use(router)
  .use("v-select", vSelect)
  .use("Datepicker", Datepicker)
  .use(PerfectScrollbar)
  .use(createHead())
  .mount("#app");




Vue.config.productionTip = false;

requestForToken();

onMessageListener().then(payload => {
  console.log('Message received. ', payload);
  // Customize notification here
  new Notification(payload.notification.title, {
    body: payload.notification.body,
    icon: payload.notification.icon
  });
});

// تسجيل خدمة العملاء
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/firebase-messaging-sw.js')
    .then((registration) => {
      console.log('Service Worker registered with scope:', registration.scope);
    })
    .catch((err) => {
      console.log('Service Worker registration failed:', err);
    });
}

new Vue({
  render: h => h(App),
}).$mount('#app');
