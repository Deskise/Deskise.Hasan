<template>
  <button
    v-if="btn"
    :class="getClass"
    :style="style"
    @click="$emit('click', $event)"
  >
    <i :class="getIcon"></i>
  </button>
  <i
    v-else
    :class="getIcon + getClass"
    :style="style"
    @click="$emit('click', $event)"
  ></i>
</template>

<script>
export default {
  mounted() {
    this.createHead();
  },
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
  emits: ["click"],
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
    getCSSFileName() {
      let $file;
      switch (this.getState) {
        case "rs":
          $file = "regular-straight";
          break;
        case "bs":
          $file = "bold-straight";
          break;
        case "ss":
          $file = "solid-straight";
          break;

        case "br":
          $file = "bold-rounded";
          break;
        case "sr":
          $file = "solid-rounded";
          break;
        case "rr":
        default:
          $file = "regular-rounded";
          break;
      }
      return "/css/fonts/uicons-" + $file + ".css";
    },
  },
  watch: {
    type() {
      this.createHead();
    },
  },
  methods: {
    createHead() {
      let file = this.getCSSFileName;
      if (document.querySelector('head link[href="' + file + '"]') === null) {
        let link = document.createElement("link");
        link.href = file;
        link.rel = "stylesheet";
        document.head.appendChild(link);
      }
    },
  },
};
</script>
