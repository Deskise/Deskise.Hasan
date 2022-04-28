<template>
  <div class="products">
    <div class="container-fluid">
      <div class="row">
        <div class="main col-md-9 row">
          <div class="row">
            <div
              class="col-12 col-md-6 col-lg-4 mb-4 pe-0"
              v-for="p in products"
              :key="p.id"
            >
              <product :id="p"></product>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
//TODO: Do This Component (Best Products In Home)
import Product from "@/components/Products/Product.vue";

export default {
  components: {
    Product,
  },
  mounted() {
    this.$store.dispatch("product/best");
  },
  computed: {
    products() {
      return this.$store.state.product.best.data;
    },
  },
};
</script>

<style lang="scss" scoped></style>
