import { Vue } from "./init";
import router from "./router";
import store from "./store";
import { createHead } from "@vueuse/head";
import "./global/components/globalComponents";

// import normalize.css
import "normalize.css";

//Add bootstrap to your project
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

// Import Swiper styles
import "swiper/swiper.scss";
import "swiper/components/pagination/pagination.min.css";
import "swiper/components/navigation/navigation.min.css";

// Import Nprogress css file:
import "nprogress/nprogress.css";

// My Scss Files:
import "./sass/style.scss";

// Languages Support:
import VueI18n from "vue-i18n";
import "./lang";

Vue.use(VueI18n);

Vue.use(store).use(router).use(createHead()).mount("#app");
