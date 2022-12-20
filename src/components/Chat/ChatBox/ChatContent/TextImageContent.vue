<template>
    <div class="content-chat-text" v-show="msg.messageType === 'textphoto'">
        <div class="text">{{msg.messageText}}</div>
        <div class="images">
            <img v-for="m of msg.messageImages" :key="m.id" :src="m">
        </div>
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