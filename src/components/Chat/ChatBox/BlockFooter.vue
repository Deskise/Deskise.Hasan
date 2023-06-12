<template>
  <div class="chat-box-footer">
    <div class="cannot-communication">You cannot communicate with this contanct - 
      <a @click="unblock" href="javascript:void(0)">Unblock</a>
    </div>
  </div>
</template>

<script>
export default{
  data() {
    return {
      chatId: this.$route.params.chatId
    }
  },
  methods: {
    unblock() {
      console.log('unblock is clicked');
      this.$store.dispatch('chat/unblock', {chat_id: this.chatId})
    }
  }
}

</script>


<style scoped>
.chat-box-footer .cannot-communication {
  border-radius: 10px;
  padding: 16px 20px;
  background: #fb5b5b;
  color: #fff;
  font-weight: bold;
  font-size: 16px;
  width: 100%;
  text-align: center;
}
</style>
