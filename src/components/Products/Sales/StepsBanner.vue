<template>
  <div class="dash-steps">
    <div class="steps">
      <Step
        v-for="(step, index) in steps"
        :key="index"
        :active="active == index + 1"
        :before="active > index + 1"
        :index="index + 1"
        :step="step"
        :link="index !== steps.length - 1"
        :linkActive="active > index + 1"
      ></Step>
    </div>
  </div>
</template>

<script>
import Step from "./Step.vue";
export default {
  components: {
    Step,
  },
  props: {
    steps: {
      type: Array,
      required: true,
    },
    active: {
      type: Number,
      default: 1,
    },
  },
  computed: {
    content() {
      return "";
    },
  },
};
</script>

<style lang="scss">
@import "@/sass/_globals/_variables.scss";
.dash-steps {
  margin-bottom: 40px;
  margin-top: 100px;
  .steps {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 0px;
  }
}
</style>
