<template>
    <div class="content-chat-text" v-show="msg.messageType === 'photo'">
        <img v-for="m of msg.messageContent" :key="m.id" :src="m">
    </div>
</template>
<script setup>
// eslint-disable-next-line vue/no-setup-props-destructure, no-undef
const { msg } = defineProps({
    msg: {
        required: true,
        type: Object,
    },
})
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