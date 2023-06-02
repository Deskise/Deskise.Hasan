<template>
  <div class="chat-box">
    <ChatBoxHeader
      :img="chat.user.img"
      :name="chat.user.firstname + ' ' + chat.user.lastname"
      :id="chat.user.id"
    />
    <ChatBoxContect />
       <DefaultChatBoxFooter :chat="chat"/>
  </div>
  <ChatAttachment />
</template>
<script setup>
import ChatBoxHeader from "../ChatBox/ChatBoxHeader.vue";
import ChatBoxContect from "../ChatBox/ChatBoxContect.vue";
import DefaultChatBoxFooter from "../ChatBox/DefaultChatBoxFooter.vue";
import ChatAttachment from "../ChatAttachment/ChatAttachment.vue";
</script>
<script>
import { mapState } from "vuex";

export default {
  props: {
    chatId: Number,
  },
  computed: {
    ...mapState("chat", ["chats"]),
    chat() {
      return this.chats.filter((chat) => chat.id == this.chatId)[0];
    },
  },
};
</script>
<style scoped>
.chat-box {
  background-color: #f2f2f2;
  flex-grow: 1;
  height: calc(100vh - 80px);
  overflow: hidden;
  flex-direction: column;
  display: flex;
}
@media (max-width: 639px) {
  .chat-box {
    height: calc(100vh - 50px);
  }
}
</style>
