<template>
  <div class="sell-product-welcome">
    <div class="content-page">
      <div class="main-title">welcome in Deskise</div>
      <p class="hint">Is The License For Life!</p>
      <select>
        <option>Yes</option>
      </select>
      <single-select
        placeholder="Is The License For Life!"
        :data="['yes', 'no']"
      ></single-select>

      <button class="btn btn-primary">Next</button>
      <button class="btn back-btn">Back</button>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      category: 0,
    };
  },
  computed: {
    ...mapGetters("category", ["categories"]),
    Gs() {
      return this.categories.map((g) => g.name);
    },
  },
};
</script>

<style lang="scss" scoped>
.sell-product-welcome {
  display: flex;
  align-items: center;
  justify-content: center;
  .content-page {
    min-width: 520px;
    padding: 0px;
    text-align: center;
  }
  .main-title {
    font-size: 40px;
    color: #040506;
    font-weight: bold;
    margin-bottom: 10px;
    text-transform: uppercase;
    @media (max-width: 500px) {
      font-size: 35px;
    }
  }
  .hint {
    font-size: 28px;
    color: #9d9d9d;
    margin-bottom: 10px;
    @media (max-width: 500px) {
      font-size: 20px;
    }
  }
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
</style>
