import { Vue } from "./init";
import router from "./router";
import store from "./store";
import { createHead } from "@vueuse/head";
import "./global/components/globalComponents";
import "./config/hello";
import PerfectScrollbar from "vue3-perfect-scrollbar";

import "vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css";

// import normalize.css
import "normalize.css";

// Datepicker
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

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

// My select
import vSelect from 'vue-select'

Vue.use(i18n)
  .use(store)
  .use(VueLoaders)
  .use(router)
  .use('v-select', vSelect)
  .use('Datepicker', Datepicker)
  .use(PerfectScrollbar)
  .use(createHead())
  .mount("#app");
