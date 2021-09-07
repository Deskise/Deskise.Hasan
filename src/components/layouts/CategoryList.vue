<template>
  <div class="categories"></div>
</template>

<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState("category", ["categories"]),
  },
};
</script>

<style lang="scss" scoped></style>
