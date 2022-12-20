<template>
    <div class="chat-box">
        <ChatBoxHeader/>
        <ChatBoxContect/> 
        <DefaultChatBoxFooter/>
    </div>
    <ChatAttachment/>
</template>
<script setup>
import ChatBoxHeader from '../ChatBox/ChatBoxHeader.vue'
import ChatBoxContect from '../ChatBox/ChatBoxContect.vue'
import DefaultChatBoxFooter from '../ChatBox/DefaultChatBoxFooter.vue'
import ChatAttachment from '../ChatAttachment/ChatAttachment.vue'
</script>
<style scoped>
.chat-box{
    background-color: #F2F2F2;
    flex-grow: 1;
    height: calc(100vh - 80px);
    overflow: hidden;
    flex-direction: column;
    display: flex;
}
@media(max-width:639px){ 
    .chat-box{
        height: calc(100vh - 50px);
    }
}
</style>