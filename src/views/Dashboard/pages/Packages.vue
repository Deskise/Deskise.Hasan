<template>
  <div id="Subscribed-Packages" class="content">
    <h5 class="font-weight-normal">Subscribed-Packages</h5>
    <div class="row Subscribed">
      <div
        class="col-12 col-md-6 col-lg-3 px-1 mb-2"
        v-for="pack in filteredPackages"
        :key="pack.id"
      >
        <action-slide :pack="pack"></action-slide>
      </div>
    </div>
  </div>
</template>

<script>
import ActionSlide from "../../../components/action/ActionSlide.vue";

import { mapGetters } from "vuex";
export default {
  components: { ActionSlide },
  data() {
    return {
      packages: this.$store.state.data.packages,
    };
  },
  computed: {
    ...mapGetters("user", ["userPackages"]),
    filteredPackages() {
      return this.packages.filter(p => {
        return this.userPackages.some(pac => pac.package_id === p.id);
      });
    }
  }
};
</script>

<style lang="scss" scoped>
h5 {
  font-size: 17px;
}
</style>
