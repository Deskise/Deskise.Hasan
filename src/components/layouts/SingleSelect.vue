//TODO:Do This Selector
<template>
  <select class="form-select mb-3" aria-label="Default select example">
    <option selected disabled>{{ placeholder }}</option>
    <option v-for="(item, key) in NotNullData" :key="key" :value="key">
      {{ item }}
    </option>
  </select>
</template>

<script>
export default {
  props: {
    placeholder: {
      type: String,
      default: "",
    },
    data: {
      type: Array,
      default: () => [],
    },
  },
  computed: {
    NotNullData() {
      return this.data.filter((e) => e !== null && e !== undefined);
    },
  },
};
</script>

<style lang="scss" scoped></style>
