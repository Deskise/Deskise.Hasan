<template>
  <!-- <Loader v-if="Loading || !ready"></Loader> -->
  <div v-if="imgs.length" class="display-attachments">
    <div v-for="(m, i) in imgs" :key="i" class="attachments-container">
      <!-- <div v-if="loading">Loading</div> -->
      <div class="loading" v-if="loading" >
        <span class="loader"></span>
      </div>
      <img :src="m" alt="m" >
      <div class="remove-button" >
        <font-awesome-component @click="removeImg(i)" icon="times" :bold="false"/>
      </div>
    </div>
  </div>
  <div class="chat-box-footer">
    <ul class="footer-options">
      <li class="option">
        <a href="javaascript:void(0)">
          <font-awesome-component icon="video" :bold="false" />
        </a>
      </li>
      <li class="option">
        <a href="javascript:void(0)">
          <font-awesome-component icon="phone" :bold="false" />
        </a>
      </li>
      <li class="option">
        <a href="javascript:void(0)"  
          @click="chooseFiles"
        >
          <input @change="addFile" type="file" name="imgs" hidden multiple>
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

import store from "../../../store";
import { computed, ref, watch } from "vue";
import { defineProps } from 'vue';
import { v4 as uuidv4 } from 'uuid';
import { ref as storageRef, set } from "@firebase/database";
import db from "../Api/db";

const props = defineProps({
  chat: {
    type: Object,
    required: true
  }
});

const loading = ref(false);
const imgs = ref([]);
const files = ref([]);
const addFile = (e) => {
  Array.from(e.target.files).forEach((file) => {
    imgs.value.push(URL.createObjectURL(file))
    files.value.push(file)
  })
}

const removeImg = (i) => {
  console.log(i);
      imgs.value.splice(i, 1);
      files.value.splice(i, 1);
    }

const sender = ref();
sender.value = store.state.user.data.id
const receiver = ref()
const conversationId = ref()
watch(() => {
  const { chat } = props;
  receiver.value = chat.user.id
  conversationId.value = chat.id
});

const getChatId = (user1, user2) => {
  const sortedIds = [user1, user2].sort();
  return sortedIds.join('_');
};
const chatId = computed(() => {
  return getChatId(sender.value, receiver.value);
});

function generateUniqueId() {
  const timestamp = Date.now();
  const randomNumber = Math.floor(Math.random() * 10000);
  return `${timestamp}_${randomNumber}`; 
}

const chooseFiles = () => {
  document.querySelector('input[type="file"]').click()
};

const message = ref("");

const sendMsg = async () => {
  loading.value = true
  const attachments = files.value.map((file) => {
      const fileName = `${uuidv4()}.${file.name.split('.').pop()}`;
      return fileName;
    });

    const date = new Date();
    const formattedDate = date.toISOString();

    generateUniqueId()
    const messageId = generateUniqueId();

  if (files.value && files.value.length > 0) {
    const type = ref()
    type.value = 'textphoto';
    const textphoto = {
      "chat_id": conversationId.value,
      "from": sender.value,
      "message": message.value,
      "attachments": attachments,
      "created_at": formattedDate,
      "type": type.value,
    }
    const formData = new FormData();
    // Append the textphoto data to the FormData
    Object.entries(textphoto).forEach(([key, value]) => {
      formData.append(key, value);
    });
     // Append the files to the FormData with generated file names
    files.value.forEach((file, index) => {
      const fileName = attachments[index];
      formData.append("files[]", file, fileName);
    });
    let chat_id = textphoto.chat_id
    let msgType = textphoto.type
    

    try {
      await store.dispatch('chat/textPhoto', {formData: formData, chatId: chat_id, type: msgType});
      await set(storageRef(db.db, `chats/${conversationId.value}/messages/${messageId}`), textphoto);

      loading.value = false; 
      message.value = ''
      imgs.value = [];
      files.value = [];
    } catch (error) {
      console.error('Error occurred during dispatch or Firebase update:', error);
      loading.value = false;
    }

    // store.dispatch('chat/textPhoto', {formData: formData, chatId: chat_id, type: msgType})
    //   .then(() => {
    //     loading.value = false
    //   })
    // set(storageRef(db.db, `chats/${conversationId.value}/messages/${messageId}`), textphoto)

  } else {
    const type = ref()
    type.value = 'message';
  
    // const date = new Date();
    // const formattedDate = date.toISOString();
    // generateUniqueId()
    // const messageId = generateUniqueId();
  
    set(storageRef(db.db, `chats/${conversationId.value}/messages/${messageId}`), {
        "id": chatId.value,
        "chat_id": conversationId.value,
        "from": sender.value,
        "message": message.value,
        "attachments": attachments,
        "read": false,
        "created_at": formattedDate,
        "type": type.value,
    });
    message.value = ''
  }

};


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

.display-attachments {
  position: relative;
  display: flex;
  justify-content: flex-start;
  width: 90%;
  border: 1px solid #a5a5a5;
  border-radius: 10px;
  height: 150px;
  z-index: 100;
  margin-top: -15px;
}
.attachments-container {
  position: relative;
  margin: 5px;
}
.attachments-container img{
  width: 60px;
  border-radius: 5px;
}

.remove-button {
  position: absolute;
  background: #ff5a58;
  cursor: pointer;
  align-self: center;
  z-index: 100;
  top: -2px;
  right: -2px;
  width: 22px;
  height: 22px;
  border-radius: 50%;
  color: #ffffff;
}
.icon {
color: red;
}

.loading {
  position: absolute;
  inset: 0;
  background: #3e3e3e;
  opacity: 0.6;
}

.loader {
  width: 40px;
  height: 40px;
  border: 5px solid;
  border-color: #5eacb7 transparent;
  border-radius: 50%;
  display: inline-block;
  box-sizing: border-box;
  animation: rotation 1s linear infinite;
}

@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
} 
    
</style>
