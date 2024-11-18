<template>
  <div class="content-chat-text" v-show="msg.type === 'msgRequest'">
    {{ `${msg.message}` }}
    <div class="devider"></div>
    <div class="prod-card w-50" v-if="prod.name">
      <img
        class="w-25 h-25 rounded"
        :src="prod.img"
        :alt="prod.name"
        srcset=""
      />
      <small class="text">{{ prod.name }}</small>
      <small class="price">${{ prod.price }}</small>
    </div>
  </div>
</template>
<script setup>
// import store from "../../../../store";
// import { onMounted, ref, watch } from "vue";
// eslint-disable-next-line vue/no-setup-props-destructure, no-undef
const { msg } = defineProps({
  msg: {
    required: true,
    type: Object,
  },
  prod: {
    required: true,
    type: Object,
  },
});
// const productInfo = ref("");

// async function getProductinfo() {
//   if (msg.product_id) {
//     let response;
//     const id = msg.product_id;
//     try {
//       response = await store.dispatch("product/chatProduct", id);
//       productInfo.value = response?.data?.response?.extra[0]?.name;
//     } catch (error) {
//       console.log(error);
//     }
//   }
// }

// onMounted(() => {
//   getProductinfo();
// });
// watch(
//   () => msg.product_id,
//   (newValue) => {
//     if (newValue) {
//       getProductinfo(newValue);
//     }
//   }
// );
</script>

<style scoped>
.content-chat-text {
  text-align: left;
}
.prod-card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px;
  border-radius: 10px;
  margin: 10px 0px;
  background-color: #e9e9e9;
  /* gap: 10px; */
}
.text {
  font-size: 0.75rem;
  font-weight: bold;
  color: #4b4b4b;
}
.price {
  font-size: 0.85rem;
  font-weight: bold;
  color: #3eadb7;
}

.devider {
  width: 100%;
  height: 1px;
  background: #b3b3b3;
  margin: 10px 0px;
}
</style>
