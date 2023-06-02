<template>
    <div class="content-chat-text" v-show="msg.type === 'textphoto'">
        <div class="text">{{msg.message}}</div>
        <div class="images">
            <img v-for="m of msgImgs" :key="m.id" :src="m">
            <!-- <img v-for="m of msg.messageImages" :key="m.id" :src="m"> -->
        </div>
    </div>
</template>
<script setup>
import { computed } from "vue";
// eslint-disable-next-line vue/no-setup-props-destructure, no-undef
const { msg } = defineProps({
    msg: {
        required: true,
        type: Object,
    },
})
const baseUrl = 'http://127.0.0.1:8000/chats/images/';

const msgImgs = computed(() => {
  if (msg.attachments) {
    return msg.attachments.map((m) => baseUrl + m);
  } else {
    return [];
  }
});
</script>
<style scoped>
.text{
    margin-bottom: 10px;
}
.images{
    display: flex;
    justify-content: space-between;
    align-items: center;
}
img{
    margin-right: 5px;
    width: 100px;
}

</style>