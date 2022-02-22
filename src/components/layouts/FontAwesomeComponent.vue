<template>
  <i
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
    class: {
      type: String,
      default: "",
    },
    style: {
      type: Object,
      default: () => {},
    },
  },
  emits: ["click"],
  computed: {
    getIcon() {
      return `fab fa-${this.icon}`;
    },
    getClass() {
      return this.class;
    },
    getCSSFileName() {
      return "https://pro.fontawesome.com/releases/v5.10.0/css/all.css";
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
