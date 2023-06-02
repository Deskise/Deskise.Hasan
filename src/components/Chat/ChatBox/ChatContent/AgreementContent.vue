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
            <div v-if="msg.from === store.state.user.data.id" class="detail ">
                <span class="key">Status</span>
                {{msg.status}}
            </div>
            <div v-if="msg.from !== store.state.user.data.id" class="detail center">
                <button class="btn-accept">Accept</button>
                <button class="btn-decline">Decline</button>
            </div>
        </div>
    </div>
</template>
<script setup>
import store from "../../../../store";
// eslint-disable-next-line vue/no-setup-props-destructure, no-undef
const { msg } = defineProps({
    msg: {
        required: true,
        type: Object,
    },
})
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