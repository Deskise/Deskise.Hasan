<template>
    <div class="content-chat-text" v-show="msg.type === 'agreement'">
        <h4 class="agreemnet-title">Create An Agreement</h4>
        <div class="agreement-details">
            <div class="detail">
                <span class="key">Agreement Details :</span>
                {{msg.details}}
            </div>
            <div class="detail">
                <span class="key">Price :</span>
                {{msg.price}}
            </div>
            <div class="detail">
                <span class="key">The Type Of Files To Be Delivered:</span>
                {{msg.file_types}}
            </div>
            <div class="detail">
                <span class="key">Notes :</span>
                {{msg.notes}}
            </div>
            <div v-if="msg.status == 'waiting'">
                <div v-if="msg.from === store.state.user.data.id" class="detail ">
                    <span class="key">Status</span>
                    {{msg.status}}
                </div>
                <div v-if="msg.from !== store.state.user.data.id" @click="accept" class="detail center">
                    <button class="btn-accept" value="Accepted">Accept</button>
                    <button class="btn-decline" value="Declined">Decline</button>
                </div>
            </div>
            <div v-else>
                <div class="detail ">
                    <span class="key">Status</span>
                    {{msg.status}}
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import store from "../../../../store";
import { ref as storageRef, set } from "@firebase/database";
import db from "../../Api/db";
// eslint-disable-next-line vue/no-setup-props-destructure, no-undef
const { msg } = defineProps({
    msg: {
        required: true,
        type: Object,
    },
})

const accept = (e) => {
    const reply = e.srcElement.value
    const date = new Date();
    const formattedDate = date.toISOString();
    const type = "agreement"
    const fileTypes = JSON.parse(msg.file_types)
    const agreement = {
        "chat_id": msg.chat_id,
        "from": store.state.user.data.id,
        "created_at": formattedDate,
        "type": "agreement",
        "price": msg.price,
        "notes": msg.notes,
        "details": msg.details,
        "file_types": JSON.stringify(fileTypes),
        "status": reply,
    }
    function generateUniqueId() {
        const timestamp = Date.now();
        const randomNumber = Math.floor(Math.random() * 10000);
        return `${timestamp}_${randomNumber}`; 
      }
      generateUniqueId()
      const messageId = generateUniqueId();

      // this.$store.dispatch('chat/agreement', {agreement});
      store.dispatch('chat/agreement', {agreement, chatId: msg.chat_id, type: type });
      
      set(storageRef(db.db, `chats/${msg.chat_id}/messages/${messageId}`), agreement);
    console.log('agreement Reply:', agreement);
}
</script>
<style scoped>
.agreemnet-title{
    margin-bottom: 15px;
}
.detail{
    font-size: 16px;
    color: #9D9D9D;
    padding: 10px 0px;
    border-bottom: 1px solid #9D9D9D;
    line-height: 24px;
}
.center{
    display: flex;
    align-items: center;
    justify-content: space-around;
    border: none;
    margin-top: 10px;
}
.key{
    font-size: 20px;
    color: #040506;
}

.btn-accept {
    color: #fff;
    background-color: #4e1b56;
    padding: 8px 20px;
    border: none;
    border-radius: 5px;
   flex: 1;
   margin-inline: 4px;
}

.btn-decline {
    color: #fff;
    background-color: #fb5b5b;
    padding: 8px 20px;
    border: none;
    border-radius: 5px;
    flex: 1;
   margin-inline: 4px;
}
</style>