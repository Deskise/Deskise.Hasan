<template>
  <div class="dash-dailog">
    <div class="dash-dailog-box">
      <div class="icon">
        <img src="@/assets/images/sheild.png" />
      </div>
      <div class="title">Create An Agreement</div>
      <p class="description">Write Down The Agreement And All The Details</p>
      <form @submit.prevent="sendAgreemnt" class="dash-form">
        <textarea v-model="details" placeholder="Agreement Details"></textarea>
        <input v-model="price" placeholder="Price" />
        <input v-model="filesType" placeholder="The type of files to be delivered" />
        <textarea v-model="notes" placeholder="Notes"></textarea>
        <button type="submit" class="pelorous">Send</button>
      </form>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import { ref as storageRef, set } from "@firebase/database";
import db from "../Api/db";
export default {
  data() {
    return {
      details: '',
      price: '',
      filesType: '',
      notes: '',
      chatId: this.$route.params.chatId,
      senderId: this.$store.state.user.data.id
    };
  },

  methods: {
    sendAgreemnt() {
      const date = new Date();
      const formattedDate = date.toISOString();
      const type = "agreement"
      const agreement = {
        "chat_id": this.chatId,
        "from": this.senderId,
        "created_at": formattedDate,
        "type": "agreement",
        "price": this.price,
        "notes": this.notes,
        "details": this.details,
        "file_types": JSON.stringify(this.filesType),
        "status": 'waiting',
      }
      function generateUniqueId() {
        const timestamp = Date.now();
        const randomNumber = Math.floor(Math.random() * 10000);
        return `${timestamp}_${randomNumber}`; 
      }
      generateUniqueId()
      const messageId = generateUniqueId();

      // this.$store.dispatch('chat/agreement', {agreement});
      this.$store.dispatch('chat/agreement', {agreement, chatId: this.chatId, type: type });
      
      set(storageRef(db.db, `chats/${this.chatId}/messages/${messageId}`), agreement);

      // this.price = ''
      // this.notes = ''
      // this.details = ''
      // this.filesType = ''
    }
  },

  computed: {
    ...mapState("chat", ["chats"]),
    chat() {
      return this.chats.filter((chat) => chat.id == this.chatId)[0];
    },
  }

}

</script>

<style scoped>
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
  color: rgba(157, 157, 157);
  padding: 8px 20px;
  border: 1px solid rgba(157, 157, 157, 23%);
  border-radius: 5px;
  display: block;
  width: 100%;
  font-size: 1rem;
}
.dash-form textarea {
  min-height: 100px;
}

.dash-form button[type="submit"],
.dash-form input[type="submit"] {
  width: 100%;
  padding: 16px;
  border-radius: 5px;
  background-color: #4e1b56;
  color: #fff;
  font-size: 1.1rem;
  font-weight: bold;
  cursor: pointer;
  border: none;
}

.dash-form button[type="submit"].pelorous,
.dash-form input[type="submit"].pelorous {
  background-color: #3eadb7;
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
