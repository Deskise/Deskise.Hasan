<template>
  <div class="fixed-bottom">
    <notification
      v-for="notification in notifications"
      :key="notification.id"
      :notification="notification"
    ></notification>
  </div>
</template>

<script>
import { mapState } from "vuex";
import Notification from "../Notification.vue";
export default {
  components: {
    Notification,
  },
  computed: mapState("notification", ["notifications"]),
};
</script>

<style lang="scss" scoped></style>
