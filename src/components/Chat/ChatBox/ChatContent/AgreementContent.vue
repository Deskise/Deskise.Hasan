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
            <div class="detail center">
                <span class="key">Waiting For Approval</span>
            </div>
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
.key{
    font-size: 20px;
    color: #040506;
}
</style>