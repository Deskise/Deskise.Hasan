<template>
  <div class="dash-dailog">
    <div class="dash-dailog-box">
      <div class="icon">
        <img src="@/assets/images/sheild.png" />
      </div>
      <div class="title">Reporting</div>
      <p class="description">Lorem Ipsum Dolor Sit Amet, Consetetur</p>
      <form @submit.prevent="send" class="dash-form">
        <textarea v-model="report" placeholder="Test Message"></textarea>
        <button type="submit">Send</button>
        <button @click="back" class="close">Cancel</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      report:'',
      chat_id: this.$route.params.chatId
    }
  },

  methods: {
    back() {
      this.$router.push({ name: 'chats', params: this.chatId })
    },

    async send() {
      try {
        await this.$store.dispatch('chat/report', {notes:this.report, chat_id:this.chat_id});
        await this.$router.push(`/chats/${this.chat_id}/reporting/success`);
      }catch (e) {
        console.log(e);
      }
    }
  }

}

</script>

<style scoped>
.close {
  color: #a9a9a9;
  background: none;
  border: none;
  border-bottom: #dc3545 solid 2px;
  margin-top: 15px;
  padding: 2px 20px;
}
.close:hover {
  color: #dc3545;
}
.dash-dailog {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background-color: rgba(201, 201, 201, 20%);
  z-index: 100;
  display: flex;
  justify-content: center;
  align-items: center;
}
.dash-dailog .dash-dailog-box {
  background: #fff;
  border-radius: 20px;
  padding: 40px 60px;
  min-width: 750px;
  max-width: 75%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
}
.dash-dailog .dash-dailog-box > *:not(:last-child),
.dash-form > *:not(:last-child) {
  margin-bottom: 15px;
}
.dash-dailog .icon {
  max-width: 70px;
}
.dash-dailog .icon img {
  max-width: 75%;
  display: block;
  margin: auto;
}
.dash-dailog .title {
  font-size: 1.3rem;
  color: #040506;
  font-weight: bold;
}
.dash-dailog .description {
  font-size: 1.1rem;
  color: #c9c9c9;
  text-align: center;
}
.dash-dailog .dash-form {
  width: 100%;
}
.dash-form textarea,
.dash-form input,
.dash-form select {
  color: rgba(157, 157, 157, 23%);
  padding: 8px 20px;
  border: 1px solid rgba(157, 157, 157, 23%);
  border-radius: 5px;
  display: block;
  width: 100%;
  font-size: 1rem;
}
.dash-form textarea {
  min-height: 120px;
  color: #040506;
}
.dash-form button[type="submit"],
.dash-form input[type="submit"] {
  width: 100%;
  padding: 12px;
  border-radius: 5px;
  background-color: #4e1b56;
  color: #fff;
  font-size: 1.1rem;;
  font-weight: bold;
  cursor: pointer;
  border: none;
}
@media (max-width: 800px) {
  .dash-dailog .dash-dailog-box {
    min-width: calc(100% - 20px);
    padding: 40px 10px;
  }
  .dash-dailog .title {
    font-size: 22px;
  }
  .dash-dailog .description,
  .dash-form textarea,
  .dash-form input,
  .dash-form select {
    font-size: 18px;
  }
  .dash-dailog .icon {
    max-width: 50px;
  }
}
</style>
