<template>
  <div class="chat-box-content" ref="chatBoxRef">
    <ChatDetails v-for="msg of messeges" :key="msg.id" :msg="msg" />
  </div>
</template>
<script setup>
import { ref, watch, onMounted, nextTick } from "vue";
import { useRoute } from 'vue-router';
import { useStore } from 'vuex';
import ChatDetails from "../ChatBox/ChatDetails.vue";
// import ChatMessages from "../Api/ChatMessage"
import { ref as storageRef, onValue } from "@firebase/database";
import db from "../Api/db";

const ChatMessage = ref([]);
const messeges = ref([]);
const route = useRoute();
const chatId = ref();
const store = useStore();
const chatBoxRef = ref(null)

onMounted(() => {
  // messeges.value = ChatMessages.sort(function (a, b) {
  //       return new Date(a.created_at) - new Date(b.created_at);
  //     });
      // scrollToBottom()
      let chatId = route.params.chatId
      const starCountRef = storageRef(db.db, `chats/${chatId}/messages`);
    onValue(starCountRef, (snapshot) => {
      const data = snapshot.val();
      ChatMessage.value = [];
      messeges.value = [];
      for (const messageId in data) {
        const message = data[messageId];
        ChatMessage.value.push(message);
      }
      messeges.value = ChatMessage.value.sort(function (a, b) {
        return new Date(a.created_at) - new Date(b.created_at);
      });
      store.commit('chat/SET_USER_CHAT', messeges.value)
      scrollToBottom();
    });
})

const scrollToBottom = () => {
  nextTick(() => {
    if (chatBoxRef.value) {
      chatBoxRef.value.scrollTop = chatBoxRef.value.scrollHeight;
    }
  });
};

watch(
  () => route.params.chatId,
  (newChatId, oldChatId) => {
    chatId.value = newChatId;
    console.log(oldChatId);

    ChatMessage.value = [];
    messeges.value = [];

    const starCountRef = storageRef(db.db, `chats/${newChatId}/messages`);
    onValue(starCountRef, (snapshot) => {
      const data = snapshot.val();
      ChatMessage.value = [];
      messeges.value = [];
      for (const messageId in data) {
        const message = data[messageId];
        ChatMessage.value.push(message);
      }
      messeges.value = ChatMessage.value.sort(function (a, b) {
        return new Date(a.created_at) - new Date(b.created_at);
      });
      store.commit('chat/SET_USER_CHAT', messeges.value)
      scrollToBottom();
    });
  }
);


</script>
<style scoped>
.avatar-image {
  width: 40px;
  height: 40px;
  line-height: 40px;
  overflow: hidden;
  margin-right: 18px;
}
.avatar-image img {
  display: block;
  margin: auto;
  max-width: 100%;
  border-radius: 50%;
}
.chat-box-content {
  padding: 20px 60px;
  flex-grow: 1;
  overflow-y: auto;
  margin-bottom: 15px;
}
.chat-box-content > * {
  margin-bottom: 40px;
}
.chat-box-sender,
.chat-box .chat-box-reciver {
  display: flex;
  justify-content: flex-start;
}
.chat-box .chat-box-reciver {
  direction: rtl;
}
.chat-box-reciver > * {
  direction: ltr;
}
.chat-box-reciver .avatar-image {
  margin-left: 18px;
  margin-right: initial;
}
.chat-box-reciver .send-message-time {
  margin-right: 10px;
  margin-left: initial;
}
.content-order-details,
.chat-box .content-chat-text {
  background: #fff;
  padding: 25px 20px;
  border-radius: 20px;
  max-width: 575px;
}
.chat-box-reciver .content-order-details,
.chat-box .chat-box-reciver .content-chat-text {
  background: #c9c9c9;
}
.content-order-details,
.chat-box .content-chat-text {
  border-top-left-radius: 0px;
}
.chat-box-reciver .content-order-details,
.chat-box .chat-box-reciver .content-chat-text {
  border-top-left-radius: 20px;
  border-top-right-radius: 0px;
}
.send-message-time {
  font-size: 14px;
  color: #9b9b9b;
  margin-left: 10px;
}
.content-order-details .order-details-summary {
  font-size: 18px;
  font-weight: bold;
  color: #040506;
  margin-bottom: 20px;
}
.content-order-details .order-details {
  max-width: 500px;
  margin: auto;
}
.content-order-details .order-details-list {
  margin-bottom: 30px;
}
.content-order-details .product-with-price {
  display: flex;
  border-bottom: 1px solid #eee;
  align-items: center;
  justify-content: space-between;
  font-size: 20px;
  color: #040506;
  padding: 8px 0px;
}
.content-order-details .product-with-price.total {
  border-bottom: none;
}
.content-order-details .payment-method {
  border-bottom: 1px solid rgba(201, 201, 201, 25%);
  border-top: 1px solid rgba(201, 201, 201, 25%);
  padding: 12px 0px;
  margin-bottom: 10px;
}
.content-order-details .payment-method .key {
  font-size: 20px;
  color: #040506;
  margin-right: 12px;
}
.content-order-details .payment-method .value {
  color: #9d9d9d;
}

.content-order-details .notes {
  font-size: 18px;
  color: #9d9d9d;
  margin-bottom: 62px;
}

.content-order-details .status-order {
  font-size: 20px;
  color: #040506;
  padding: 10px 0px;
  border-top: 1px solid #c9c9c9;
  border-bottom: 1px solid #c9c9c9;
  text-align: center;
}
@media (max-width: 750px) {
  .chat-box .chat-box-content {
    padding: 10px;
  }
  .chat-box-sender,
  .chat-box .chat-box-reciver {
    flex-wrap: wrap;
  }
  .content-order-details,
  .chat-box .content-chat-text {
    flex-grow: 1;
    width: 100%;
    margin: 10px 0;
    border-radius: 4px;
  }
  .send-message-time {
    flex-basis: 100%;
    text-align: right;
  }
}
</style>
