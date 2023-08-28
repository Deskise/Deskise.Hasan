<template>
  <div class="chat-time-line">
    <span
      >{{ new Date(msg.created_at).getDate() }}-{{
        new Date(msg.created_at).getMonth() + 1
      }}-{{ new Date(msg.created_at).getFullYear() }}</span
    >
  </div>
  <div
    v-bind:class="msg.from === this.$store.state.user.data.id ? 'sender' : 'receiver'"
    :style="{
      display: msg.type === 'call' ? 'flex' : '',
      flexDirection: msg.type === 'call' ? 'column' : '',
    }"
  >
    <div
      class="avatar-image"
      :style="{ display: msg.type === 'call' ? 'none' : '' }"
    >
      <img v-if="msg.from !== this.$store.state.user.data.id" :src="chat.user.img" :alt=chat.user.firstname>
      <img v-if="msg.from === this.$store.state.user.data.id" :src="sender.img" :alt="sender.firstname">
    </div>
    <TextContent :msg="msg" />
    <ImageContent :msg="msg" />
    <TextImageContent :msg="msg" />
    <AgreementContent :msg="msg" />
    <CallMessage :msg="msg" />
    <OrderDetails :msg="msg" />
    <FilesSubmit :msg="msg"/>
    <div class="send-message-time">
      {{ new Date(msg.created_at).getHours() }}:{{
        new Date(msg.created_at).getMinutes()
      }}
    </div>
  </div>
</template>


<script setup>
import { useStore } from 'vuex';
import { computed } from 'vue'
import TextContent from "../ChatBox/ChatContent/TextContent.vue";
import ImageContent from "../ChatBox/ChatContent/ImageContent.vue";
import TextImageContent from "../ChatBox/ChatContent/TextImageContent.vue";
import AgreementContent from "../ChatBox/ChatContent/AgreementContent.vue";
import CallMessage from "../ChatBox/ChatContent/CallMessage.vue";
import { useRoute } from 'vue-router';
import OrderDetails from './ChatContent/OrderDetails.vue';
import FilesSubmit from './ChatContent/FilesSubmit.vue';
// eslint-disable-next-line vue/no-setup-props-destructure, no-undef
const { msg } = defineProps({
  msg: {
    required: true,
    type: Object,
  },
});
const route = useRoute();
const chatId = parseInt(route.params.chatId)
const store = useStore();
const sender = computed(() => store.state.user.data);
const chats = store.state.chat.chats;
const chat = computed(() => {
  return chats.filter((chat) => chat.id === chatId)[0];
});

</script>


<style scoped>
.sender,
.receiver {
  display: flex;
  justify-content: flex-start;
}
.receiver {
  direction: rtl;
}
.receiver > * {
  direction: ltr;
}
.receiver .avatar-image {
  margin-left: 18px;
  margin-right: initial;
}
.receiver .avatar-image img {
  margin-left: 5px;
  aspect-ratio: 1/1;
}
.sender .avatar-image img {
  margin-right: 5px;
  aspect-ratio: 1/1;
}
.avatar-image img {
  width: 30px;
  border-radius: 50%;
}
.receiver .send-message-time {
  margin-right: 10px;
  margin-left: initial;
}
.content-order-details,
.content-chat-text {
  background: #fff;
  padding: 25px 20px;
  border-radius: 20px;
  max-width: 575px;
}
.receiver .content-order-details,
.receiver .content-chat-text {
  background: #c9c9c9;
}
.content-order-details,
.content-chat-text {
  border-top-left-radius: 0px;
}
.receiver .content-order-details,
.receiver .content-chat-text {
  border-top-left-radius: 20px;
  border-top-right-radius: 0px;
}
.send-message-time {
  font-size: 14px;
  color: #9b9b9b;
  margin-left: 10px;
}
.chat-box-content .chat-time-line {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 37px;
  margin-top: 20px;
}
.chat-box-content .chat-time-line span {
  font-size: 14px;
  color: #9b9b9b;
}
.chat-box-content .chat-time-line::after,
.chat-box-content .chat-time-line::before {
  content: "";
  height: 1px;
  background-color: #9d9d9d;
  flex-grow: 1;
}
.chat-box-content .chat-time-line::after {
  margin-left: 100px;
}
.chat-box-content .chat-time-line::before {
  margin-right: 100px;
}
</style>
