<template>
  <div class="content-chat-text" v-show="msg.type === 'message'">
    {{ `${msg.message}` }}
  </div>
</template>
<script setup>
// eslint-disable-next-line vue/no-setup-props-destructure, no-undef
const { msg } = defineProps({
  msg: {
    required: true,
    type: Object,
  },
});
</script>

<style>
.content-chat-text {
  text-align: left;
}
.text {
  font-size: 0.75rem;
  font-weight: bold;
  color: #4b4b4b;
}

.devider {
  width: 100%;
  height: 1px;
  background: #b3b3b3;
  margin: 10px 0px;
}
</style>
