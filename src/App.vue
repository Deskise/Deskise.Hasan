<template>
  <Loader v-if="Loading || !ready"></Loader>
  <NotificationBar></NotificationBar>
  <component :is="headerComponent"></component>
  <router-view class="page" />
  <Footer></Footer>
</template>

<script>
import NoLoginHeader from "./components/template/NoLoginHeader.vue";
import LoggedInHeader from "./components/template/LoggedInHeader.vue";
import NotificationBar from "./components/template/NotificationBar.vue";
import Footer from "./components/template/Footer.vue";
import Loader from "./components/template/Loader.vue";
import { mapState } from "vuex";

export default {
  created() {
    this.$store.dispatch("category/fetch");
    this.$store.dispatch("user/getUUID");
  },
  components: { NotificationBar, Footer, Loader },
  data() {
    return {};
  },
  computed: {
    headerComponent() {
      return this.$store.getters["user/isLoggedIn"]
        ? LoggedInHeader
        : NoLoginHeader;
    },
    ...mapState(["Loading", "ready"]),
  },
};
</script>

<style lang="scss">
#app {
  font-family: Barlow, Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  .page {
    margin: 30px 0 70px 0;
    min-height: 89vh;
  }
}

nav {
  max-height: 11vh;
}
</style>
