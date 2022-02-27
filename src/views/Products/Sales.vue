<template>
  <div class="sell-product-welcome">
    <div class="content-page">
      <component :is="component"></component>

      <button class="btn btn-primary" @click="next">Next</button>
      <button class="btn back-btn" v-if="component === 'Second'" @click="back">
        Back
      </button>
    </div>
  </div>
</template>

<script>
import First from "../../components/Products/Create/First.vue";
import Second from "../../components/Products/Create/Second.vue";
export default {
  components: { First, Second },
  data() {
    return {
      component: "First",
      category: 0,
    };
  },
  methods: {
    next() {
      if (this.component === "First") this.component = "Second";
      else
        this.$router.push({
          name: "sales.data",
          params: { cat: this.category },
        });
    },
    back() {
      this.component = "First";
    },
  },
};
</script>

<style lang="scss" scoped>
.sell-product-welcome {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  .content-page {
    min-width: 520px;
    padding: 0px;
    text-align: center;

    button {
      width: 100%;
      color: #fff;
      padding: 16px;
      font-weight: bold;
      font-size: 20px;
      border-radius: 5px;

      &.back-btn {
        color: #000;
        background: #fff;
        margin-top: 20px;
        border: none;
      }
    }
  }
}
</style>
