import { Vue } from "@/init";

import { Head } from "@vueuse/head";
import CategoryList from "@/components/layouts/CategoryList";
import CircleCheckbox from "@/components/layouts/CircleCheckbox";
import Confirm from "@/components/layouts/Confirm";
import FlatIconComponent from "@/components/layouts/FlatIconComponent";
import LoadMore from "@/components/layouts/LoadMore";
import RangeSelect from "@/components/layouts/RangeSelect";
import Search from "@/components/layouts/Search";
import SingleSelect from "@/components/layouts/SingleSelect";
import toTop from "@/components/layouts/toTop";
import YNSelect from "@/components/layouts/YNSelect";
import FontAwesomeComponent from "@/components/layouts/FontAwesomeComponent";

Vue.component("Head", Head);
Vue.component("category-list", CategoryList);
Vue.component("circle-checkbox", CircleCheckbox);
Vue.component("confirm", Confirm);
Vue.component("flat-icon-component", FlatIconComponent);
Vue.component("font-awesome-component", FontAwesomeComponent);
Vue.component("load-more", LoadMore);
Vue.component("range-select", RangeSelect);
Vue.component("search", Search);
Vue.component("single-select", SingleSelect);
Vue.component("to-top", toTop);
Vue.component("yn-select", YNSelect);
