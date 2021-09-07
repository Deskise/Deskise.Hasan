<template>
  <div :class="getClassName" :id="`notification-${notification.id}`">
    {{ notification.message }}
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  mounted() {
    this.timer = setTimeout(() => {
      let notification = document.querySelector(
        `#notification-${this.notification.id}`
      );
      notification.style.right = "-1000px";

      setTimeout(() => this.remove(this.notification), 3000);
    }, this.time);
  },
  beforeUnmount() {
    clearTimeout(this.timer);
  },
  props: {
    notification: {
      type: Object,
      required: true,
    },
  },
  computed: {
    getClassName() {
      return `alert alert-${
        this.notification.status ? "primary" : "secondary"
      } mb-2 notification`;
    },
  },
  methods: mapActions("notification", ["remove"]),
  data() {
    return {
      timer: null,
      time: 1000 * 5,
    };
  },
};
</script>

<style lang="scss" scoped>
.notification {
  color: white;
  border: 0;
  width: 25%;
  margin-left: auto;
  position: relative;
  bottom: 0;
  right: 10px;
  transition: all 3s ease-in-out;
}
</style>
