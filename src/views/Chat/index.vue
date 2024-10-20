<template>
  <div>
    <div v-if="chatId === 'first'" class="noMsgs">
      <h3>There is No Messages !</h3>
      <p>You have to buy a product from a user to start conveersation!</p>
    </div>
    <DashChat v-if="chatId !== 'first'" :chat-id="chatId"/>
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
.noMsgs {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 70vh;
}
/* .scrollbar {
  max-height: calc(100vh - 80px) !important;
} */
</style>
