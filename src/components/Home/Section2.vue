<template>
  <section
    class="bg-gray-e d-flex"
    :style="{ backgroundImage: `url(${getImage})` }"
  >
    <div class="blocks container">
      <div class="row">
        <div class="block col-3 col-md first">Categories</div>
        <div
          v-for="(category, index) in categories.slice(0, 4)"
          :key="index"
          :class="{
            'block col bg-white bg-hover-gradiant text-gray': true,
            'd-none d-md-flex': index < 1 && index !== 3,
            'd-none d-lg-flex': index === 3,
          }"
        >
          {{ category.name }}
        </div>
      </div>
      <div class="row">
        <div
          v-for="(category, index) in categories.slice(4, 8)"
          :key="index"
          :class="{
            'block col bg-white bg-hover-gradiant text-gray': true,
            'd-none d-md-flex': index < 1 && index !== 3,
            'd-none d-lg-flex': index === 3,
          }"
        >
          {{ category.name }}
        </div>
        <div class="block last col-3 col-md">More+</div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {};
  },
  computed: {
    getImage() {
      let image = require("@/assets/waves.png");
      return image;
    },
    ...mapGetters("category", ["categories"]),
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
section {
  height: 67vh;
  justify-content: center;
  align-items: center;
  @media (max-width: 576px) {
    & {
      height: 57vh;
      margin-bottom: 10vh;
    }
  }
  .block {
    font-size: 28px;
    @media (max-width: 1410px) {
      & {
        font-size: 19px;
        height: 120px;
      }
    }
    @media (max-width: 576px) {
      & {
        font-size: 16px;
        height: 100px;
        margin: 7px;
      }
    }
    text-transform: capitalize;
    font-weight: 600;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 150px;
    margin: 10px;
    border-radius: 5px;

    &.last,
    &.first {
      color: #040506;
      font-weight: bold;
      font-size: 34px;
      text-transform: uppercase;

      @media (max-width: 1410px) {
        & {
          font-size: 26px;
        }
      }
      @media (max-width: 992px) {
        & {
          font-size: 20px;
        }
      }
      @media (max-width: 576px) {
        & {
          font-size: 18px;
        }
      }
    }
  }
}
</style>
