<template>
  <router-link
    :class="{
      step: true,
      active: active,
      before: before,
    }"
    data-content=".step-content.price-content"
    :to="{ name: $router.currentRoute.name, hash: `#${index}` }"
  >
    <span class="num">{{ index }}</span>
    <span class="name">{{ step }}</span>
  </router-link>
  <div :class="{ line: true, active: linkActive }" v-if="link"></div>
</template>

<script>
export default {
  props: {
    step: {
      type: String,
      default: "",
    },
    index: {
      type: Number,
      default: 1,
    },
    before: {
      type: Boolean,
      default: false,
    },
    active: {
      type: Boolean,
      default: false,
    },
    link: {
      type: Boolean,
      default: false,
    },
    linkActive: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
.step {
  position: relative;
  display: flex;
  flex-direction: column;
  gap: 10px;
  align-items: center;
  margin: 0px 20px;
  font-weight: bold;
  color: #c9c9c9;
  cursor: pointer;

  &.before {
    .num {
      background-color: rgba($primary, 0.8);
    }
    .name {
      color: rgba($primary, 0.8);
      text-transform: uppercase;
    }
  }

  &.active {
    .num {
      background-color: $primary;
    }
    .name {
      color: $primary;
      text-transform: uppercase;
    }
  }

  .num {
    position: relative;
    font-size: 20px;
    text-align: center;
    width: 42px;
    height: 42px;
    line-height: 42px;
    background-color: #c9c9c9;
    color: #fff;
    border-radius: 50%;
  }
}
.line {
  flex-grow: 1;
  height: 3px;
  background-color: rgba(137, 137, 137, 0.23);
  margin-top: -20px;

  &.active {
    background-color: rgba($primary, 0.23);
  }
}
</style>
