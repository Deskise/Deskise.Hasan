//TODO:Do This Range Selector
<template>
  <div class="m-0">
    <label for="range" class="form-label name w-100 text-left mb-0">
      {{ name }}
    </label>
    <input
      type="range"
      class="form-range"
      :min="min"
      :max="max"
      :step="step"
      id="renge"
      :value="vstart"
    />
    <div class="d-flex justify-content-between">
      <label for="range" class="min">{{ min + suffex }}</label>
      <label for="range" class="max">{{ max + suffex }}</label>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      default: "",
    },
    min: {
      type: Number,
      default: 0,
    },
    max: {
      type: Number,
      default: 100,
    },
    step: {
      type: Number,
      default: 1,
    },
    vstart: {
      type: Number,
      default: 0,
    },
    vend: {
      type: Number,
      default: 100,
    },
    suffex: {
      type: String,
      default: "",
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
div {
  position: relative;

  label {
    color: $dark;
    font-size: 20px;
    text-transform: capitalize;
  }

  div.d-flex {
    top: -10px;
  }
}
</style>
