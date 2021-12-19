<template>
  <Head>
    <link
      rel="stylesheet"
      href="css/fonts/uicons-regular-straight.css"
      v-if="getState === 'rs'"
    />
    <link
      rel="stylesheet"
      href="css/fonts/uicons-bold-straight.css"
      v-if="getState === 'bs'"
    />
    <link
      rel="stylesheet"
      href="css/fonts/uicons-solid-straight.css"
      v-if="getState === 'ss'"
    />

    <link
      rel="stylesheet"
      href="css/fonts/uicons-regular-rounded.css"
      v-if="getState === 'rr'"
    />
    <link
      rel="stylesheet"
      href="css/fonts/uicons-bold-rounded.css"
      v-if="getState === 'br'"
    />
    <link
      rel="stylesheet"
      href="css/fonts/uicons-solid-rounded.css"
      v-if="getState === 'sr'"
    />
  </Head>
  <button
    v-if="btn"
    :class="getClass"
    :style="style"
    @click="(event) => $emit('ev', event)"
  >
    <i :class="getIcon"></i>
  </button>
  <i v-else :class="getIcon + getClass" :style="style"></i>
</template>

<script>
export default {
  props: {
    icon: {
      required: true,
      type: String,
    },
    type: {
      type: String,
      default: "r",
    },
    straight: {
      type: Boolean,
      default: false,
    },
    class: {
      type: String,
      default: "",
    },
    style: {
      type: Object,
      default: () => {},
    },
    btn: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    getState() {
      return this.type.toLowerCase().charAt(0) + (this.straight ? "s" : "r");
    },
    getIcon() {
      return `fi fi-${this.getState}-${this.icon} `;
    },
    getClass() {
      return this.class;
    },
  },
};
</script>
