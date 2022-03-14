<template>
  <label>
    <input
      type="checkbox"
      @change="$emit('check', $event.target.checked)"
      :checked="value"
      :disabled="isReadonly"
    />
    <span></span>
    <span>{{ text }}</span>
  </label>
</template>

<script>
export default {
  props: {
    text: {
      type: String,
      default: "",
    },
    value: {
      type: Boolean,
      default: false,
    },
    isReadonly: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
label {
  position: relative;
  color: $primary;
  text-transform: uppercase;

  span {
    margin: 0 5px;
    transition: all linear 0.3s;
  }

  span:first-of-type {
    width: 16px;
    height: 16px;
    border: 1px solid;
    border-color: $primary;
    display: inline-block;
    border-radius: 50%;
    position: relative;
    top: 3px;

    &:after {
      content: "";
      position: absolute;
      top: calc(25% - 1px);
      left: 6px;
      border-bottom: 2px solid $secondary;
      border-right: 2px solid $secondary;
      height: 8px;
      width: 4px;
      transform: rotate(45deg);
      visibility: hidden;
      transition: all linear 0.3s;
      opacity: 0;
    }
  }

  input {
    display: none !important;
    &:checked ~ span {
      border-color: $secondary;
      color: $secondary;
      &:after {
        visibility: visible;
        opacity: 1;
      }
    }
  }
}
</style>
