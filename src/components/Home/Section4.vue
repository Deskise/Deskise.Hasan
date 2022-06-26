<template>
  <div class="products">
    <div class="container-fluid">
      <h1 class="mb-5">Best Products</h1>
      <div class="main col-md-12 row">
        <div
          class="col-12 col-md-4 col-lg-3 mb-4 pe-0"
          v-for="(p, index) in products"
          :key="p.id"
        >
          <product :id="index" best></product>
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
  async mounted() {
    await this.$store.dispatch("product/best");
  },
  computed: {
    products() {
      return this.$store.state.product.best.data;
    },
  },
};
</script>

<style lang="scss" scoped>
.products {
  width: 67vh;
  background: inherit;
  padding: 70px 0;
  justify-content: center;
  align-items: center;
  width: 100%;
  .container-fluid {
    padding: 5%;
  }
  h1 {
    color: #040506;
    font-size: 60px;
    @media (max-width: 760px) {
      font-size: 40px;
    }
  }
}
</style>
