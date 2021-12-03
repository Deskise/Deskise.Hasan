<template>
  <div class="home">
    <Section1></Section1>
    <man-img></man-img>
  </div>
</template>

<script>
import Section1 from "@/components/Home/Section1";
import ManImg from "@/components/template/manImg.vue";
export default {
  components: {
    Section1,
    ManImg,
  },
};
</script>

<style lang="scss" scoped></style>
