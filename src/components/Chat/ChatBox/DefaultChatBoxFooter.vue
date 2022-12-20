<template>
  <div class="chat-box-footer">
    <ul class="footer-options">
      <li class="option">
        <a href="javaascript:void(0)">
          <font-awesome-component icon="video" :bold="false" />
        </a>
      </li>
      <li class="option">
        <a href="javaascript:void(0)">
          <font-awesome-component icon="phone" :bold="false" />
        </a>
      </li>
      <li class="option">
        <a href="javaascript:void(0)">
          <font-awesome-component icon="file" :bold="false" />
        </a>
      </li>
    </ul>
    <div class="footer-text-message">
      <form @submit.prevent="sendMsg">
        <input placeholder="Type Something" v-model="message" />
      </form>
      <a href="javascript:void(0)" class="icon">
        <font-awesome-component icon="telegram-plane" />
      </a>
    </div>
  </div>
</template>
<script setup>
import store from "@/store";
import { computed, ref } from "vue";

const message = ref("");
const sendMsg = computed(() => store.dispatch("sendMsg", message));
</script>
<style scoped>
.chat-box-footer {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  border: 1px solid #fff;
  border-radius: 4px;
  max-width: 950px;
  margin: auto;
  width: 100%;
}

.chat-box-footer .footer-options {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 18px 20px;
  border-right: 1px solid #fff;
  gap: 18px;
}

.chat-box-footer .footer-options li.option a {
  color: #040506;
  font-size: 18px;
}

.chat-box-footer .footer-text-message {
  flex-grow: 1;
  position: relative;
}
.chat-box-footer .footer-text-message input {
  padding: 18px;
  font-size: 18px;
  color: #9b9b9b;
  padding-right: 50px;
  border: none;
  background: none;
  width: 100%;
}

.chat-box-footer .footer-text-message .icon {
  position: absolute;
  right: 28px;
  top: 10px;
  font-size: 22px;
  color: #3eadb7;
  top: calc(50% - 9px);
}
</style>
