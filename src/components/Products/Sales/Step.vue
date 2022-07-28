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
  align-items: center;
  font-weight: bold;
  color: #c9c9c9;
  cursor: pointer;
   @media (max-width:576px) {
      height: 90px;
      text-align: center;
    }
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
  .name{
    @media (max-width:576px) {
      width: 60px;
    }
  }
  .num {
    position: relative;
    font-size: 18px;
    text-align: center;
    width: 40px;
    height: 40px;
    line-height: 40px;
    background-color: #c9c9c9;
    color: #fff;
    border-radius: 50%;
    margin-bottom: 10px;
  }
}
.line {
  flex-grow: 1;
  height: 3px;
  background-color: rgba(137, 137, 137, 0.23);
  margin-top: -32px;
  z-index: -1;
  @media (max-width:576px) {
      margin-top: -45px;
    }
  &.active {
    background-color: rgba($primary, 0.23);
  }
}
.line:first-of-type{
    transform: translateX(-15px) scaleX(1.2);
     @media (max-width:576px) {
     transform: translateX(-15px) scaleX(1.5);
    }

}
.line:last-of-type{
  transform: translateX(10px) scaleX(1.2);
  @media (max-width:576px) {
     transform: translateX(-15px) scaleX(1.5);
    }
}
</style>
