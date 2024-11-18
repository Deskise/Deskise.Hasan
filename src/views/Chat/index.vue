<template>
  <div>
    <div v-if="chatId === 'first'" class="noMsgs">
      <h3>There are No Messages!</h3>
      <p>You have to buy a product from a user to start conversation!</p>
    </div>
    <DashChat v-if="chatId !== 'first'" :chat-id="chatId" />
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
  data() {
    return {
      showError: false,
      errorMsg: "",
      isProcessing: false,
      stripe: null,
      elements: null,
      offcanvasInstance: null,
      paymentMessage: "",
      isError: false,
      mountedElements: [],
    };
  },
};
</script>

<style lang="scss" scoped>
.noMsgs {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 70vh;
}

#payment-form {
  align-self: center;
  box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
    0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
  border-radius: 7px;
  padding: 40px;
}

.payment-message {
  color: rgb(105, 115, 134);
  font-size: 16px;
  line-height: 20px;
  padding-top: 12px;
  text-align: center;
}

#payment-element {
  margin-bottom: 24px;
}

.btnComplete {
  button {
    background: #5469d4;
    color: #ffffff;
    border-radius: 4px;
    border: 0;
    padding: 12px 16px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    display: block;
    transition: all 0.2s ease;
    box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
    width: 100%;

    &:hover {
      filter: brightness(1.1);
    }

    &:disabled {
      opacity: 0.5;
      cursor: default;
    }
  }
}
</style>
