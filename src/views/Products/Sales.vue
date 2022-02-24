<template>
  <component :is="component"></component>
</template>

<script>
import First from "../../components/Products/Create/First.vue";
import Second from "../../components/Products/Create/Second.vue";
export default {
  components: { First, Second },
  data() {
    return {
      component: "Second",
    };
  },
};
</script>

<style lang="scss" scoped></style>
