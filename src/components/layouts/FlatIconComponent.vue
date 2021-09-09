<template>
  <i :class="getClass"></i>
</template>

<script>
export default {
  props: {
    icon: {
      required: true,
      type: String,
    },
    solid: {
      type: Boolean,
      default: false,
    },
    straight: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    getClass() {
      return `fi-${(this.solid ? "s" : "r") + (this.straight ? "s" : "r")}-${
        this.icon
      }`;
    },
  },
};
</script>

<style lang="scss">
//rounded:
@import url("https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css");
@import url("https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css");
@import url("https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css");

// Straight:
@import url("https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css");
@import url("https://cdn-uicons.flaticon.com/uicons-bold-straight/css/uicons-bold-straight.css");
@import url("https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css");
</style>
