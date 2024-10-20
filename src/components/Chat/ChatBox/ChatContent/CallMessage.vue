<template>
    <div class="chat-time-line missed" v-show="msg.type === 'call'">
        <div class="missed">
            <span>{{new Date(msg.created_at).getHours()}}:{{new Date(msg.created_at).getMinutes()}}</span>
            <span>Missed call from you</span>
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
.missed {
    display: flex;
    gap: 15px;
}
.chat-time-line.missed {
    color: #FB5B5B;
}
.chat-time-line {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 37px;
}
.chat-time-line span{
    font-size: 14px;
    color: #9B9B9B;
}
.missed::before{
    background-color: red;
}
</style>