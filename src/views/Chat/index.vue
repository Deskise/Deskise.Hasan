<template>
  <div>
    <div v-if="chatId === 'first'">There is no chat for you!</div>
    <DashChat :chat-id="chatId" v-if="chatId !== 'first'"/>
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

<style>
/* .scrollbar {
  max-height: calc(100vh - 80px) !important;
} */
</style>
