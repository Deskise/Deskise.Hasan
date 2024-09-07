<template>
  <perfect-scrollbar ref="scroll" class="scrollbar" @scroll="handleScroll">
    <Loader v-if="Loading || !ready"></Loader>
    <NotificationBar></NotificationBar>
    <component :is="headerComponent"></component>
    <router-view class="page" />
    <cookie-agreement
      v-if="!cookieAccepted"
      @accept="$store.dispatch('AcceptCookies')"
      @cancel="$store.dispatch('CancelCookies')"
    ></cookie-agreement>
    <Footer v-if="!noFooter"></Footer>
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
  async created() {
    this.$store.dispatch("category/fetch");
    this.$store.dispatch("user/getUUID");
    this.$store.dispatch("getCookieStatus");
  },
  components: { NotificationBar, Footer, Loader, CookieAgreement },
  computed: {
    headerComponent() {
      return this.$store.getters["user/isLoggedIn"]
        ? LoggedInHeader
        : NoLoginHeader;
    },
    ...mapState(["Loading", "ready", "cookieAccepted", "noFooter"]),
  },
  watch: {
    $route() {
      this.$refs.scroll.$el.scrollTop = 0;
      this.noFooter =
        this.$route.meta.noFooter !== undefined &&
        this.$route.meta.noFooter === true;
    },
  },
  methods: {
    handleScroll() {
      if (this.$refs.scroll.$el.scrollTop > 50) {
        this.$store.commit("CHANGE_PAGEY", true);
      }
      if (this.$refs.scroll.$el.scrollTop < 50) {
        this.$store.commit("CHANGE_PAGEY", false);
      }
    },
  },
};
</script>

<style lang="scss">
@import "@/sass/_globals/_variables";
body {
  overflow: hidden;
}
section {
  width: 100%;
  overflow: hidden;
  @media (max-width: 576px) {
    width: 100%;
    padding-left: 2%;
    padding-right: 2%;
  }
}
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
    margin: 11vh 0 0 0;
    // margin: 11vh 0 70px 0;
    min-height: 90vh;
    // max-width: 1508px;
    // display: inline-block;
    @media (max-width: 1400px) {
      min-height: 90vh;
      margin: 14vh 0 0 0;
      // margin: 14vh 0 70px 0;
    }
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
  max-height: 10vh;
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
