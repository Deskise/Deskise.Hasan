<template>
  <div>
    <DashChat :chat-id="chatId" />
    <router-view />
  </div>
</template>
<script>
import DashChat from "@/components/Chat/DashChat.vue";

export default {
  components: {
    DashChat,
  },
  props: {
    chatId: Number,
  },
};
</script>
