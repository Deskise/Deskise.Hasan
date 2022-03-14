<template>
  <single-select
    :placeholder="placeholder"
    :data="Object.keys(values).map((e) => [e, values[e]])"
    @choose="(e) => $emit('choose', e)"
  ></single-select>
</template>

<script>
export default {
  props: {
    placeholder: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      values: { y: "yes", n: "no" },
    };
  },
};
</script>

<style lang="scss" scoped></style>
