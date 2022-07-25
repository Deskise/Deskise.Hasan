<template>
  <div id="Subscribed-Packages" class="content">
    <h5 class="font-weight-normal">Subscribed-Packages</h5>
    <div class="row Subscribed">
      <div
        class="col-12 col-md-6 col-lg-3 px-1 mb-2"
        v-for="pack in packages"
        :key="pack.id"
      >
        <action-slide :pack="pack.package"></action-slide>
      </div>
    </div>
  </div>
</template>

<script>
import ActionSlide from "../../../components/action/ActionSlide.vue";
export default {
  components: { ActionSlide },
  data() {
    return {
      packages: this.$store.state.user.data.packages,
    };
  },
};
</script>

<style lang="scss" scoped>
h5{
  font-size: 17px;
}
</style>
