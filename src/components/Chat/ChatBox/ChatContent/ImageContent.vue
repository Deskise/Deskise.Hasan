<template>
        <div class="content-chat-text" v-show="msg.type === 'attachment'">
            <img v-for="m of processedAttachments" :key="m.id" :src="m">
        </div>
</template>
<script setup>
import { computed } from 'vue';
// eslint-disable-next-line vue/no-setup-props-destructure, no-undef
const { msg } = defineProps({
    msg: {
        required: true,
        type: Object,
    },
})
const baseUrl = 'http://127.0.0.1:8000/chats/images/';

const processedAttachments = computed(() => {
  if (msg.attachments) {
    return msg.attachments.map((m) => baseUrl + m);
  } else {
    return [];
  }
});

</script>
<style scoped>
.content-chat-text{
    display: flex;
    justify-content: space-between;
    align-items: center;
}
img{
    margin-right: 5px;
    width: 100px;
}
</style>