<template>
  <perfect-scrollbar ref="scroll" class="scrollbar">
    <Loader v-if="Loading || !ready"></Loader>
    <NotificationBar></NotificationBar>
    <component :is="headerComponent"></component>
    <router-view class="page" />
    <cookie-agreement
      v-if="!cookieAccepted"
      @accept="$store.dispatch('AcceptCookies')"
    ></cookie-agreement>
    <Footer></Footer>
  </perfect-scrollbar>
</template>

<script>
import NoLoginHeader from "./components/template/NoLoginHeader.vue";
import LoggedInHeader from "./components/template/LoggedInHeader.vue";
import NotificationBar from "./components/template/NotificationBar.vue";
import Footer from "./components/template/Footer.vue";
import Loader from "./components/template/Loader.vue";
import { mapState } from "vuex";
import CookieAgreement from "./components/template/CookieAgreement.vue";

export default {
  created() {
    this.$store.dispatch("category/fetch");
    this.$store.dispatch("user/getUUID");
    this.$store.dispatch("sockets/init_echo");
    this.$store.dispatch("sockets/connect_sockets");
  },
  components: { NotificationBar, Footer, Loader, CookieAgreement },
  data() {
    return {};
  },
  computed: {
    headerComponent() {
      return this.$store.getters["user/isLoggedIn"]
        ? LoggedInHeader
        : NoLoginHeader;
    },
    ...mapState(["Loading", "ready", "cookieAccepted"]),
  },
  watch: {
    $route() {
      this.$refs.scroll.$el.scrollTop = 0;
    },
  },
};
</script>

<style lang="scss">
@import "@/sass/_globals/_variables";
.ps:not(.scrollbar) {
  .ps__rail-y {
    width: 10px;
    &:hover > .ps__thumb-y,
    &:focus > .ps__thumb-y,
    &.ps--clicking .ps__thumb-y {
      width: 6px;
      background-color: #4e1b56;
    }
    .ps__thumb-y {
      background-color: #3eadb7;
      width: 2px;
    }
  }
}
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
  .scrollbar {
    height: 100vh;
    & > .ps__rail-y {
      z-index: 11;
      &:hover > .ps__thumb-y,
      &:focus > .ps__thumb-y,
      &.ps--clicking .ps__thumb-y {
        background-color: #4e1b56;
      }
      .ps__thumb-y {
        background-color: #3eadb7;
      }
    }
  }
}
* {
  font-family: "Barlow", sans-serif;
  box-sizing: border-box;
  padding: 0;
  margin: 0;
}
ul {
  list-style-type: none;
}
a {
  text-decoration: none !important;
}

nav {
  max-height: 11vh;
}

.dp__active_date {
  background: $primary !important;
}
.dp__select {
  color: $primary !important;
}
.dp__today {
  border: 1px solid $secondary !important;
}
</style>
