<template>
  <div class="dash-contacts">
    <span id="close-contacts">
      <font-awesome-component icon="times" />
    </span>
    <div class="dash-contacts-search">
      <div class="icon">
        <font-awesome-component icon="search" />
      </div>
      <input placeholder="Search Message" />
    </div>
    <ul class="dash-list-contacts">
      <MsgDetails :messeges="messeges" />
    </ul>
  </div>
</template>
<script setup>
import MsgDetails from "./Messge/MsgDetails.vue";
import ChatList from "./Api/ChatList";
import { ref } from "vue";
const messeges = ref([]);
messeges.value = ChatList.extra;
</script>
<style scoped>
.dash-btn {
  padding: 15px 72px;
  border-radius: 5px;
  border: none;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
}

.dash-profile-details .dash-profile-bio,
.dash-profile-details .dash-profile-address,
.dash-profile-details .dash-profile-email,
.dash-product-order,
.dash-product-details,
.dash-product .dash-old-price {
  color: #9d9d9d;
}

.dash-btn.edit-btn {
  background-color: #4e1b56;
  color: #fff;
}
.dash-btn.chat-btn {
  background-color: #3eadb7;
  color: #fff;
  margin-bottom: 25px;
}
.dash-chat .dash-contacts {
  max-width: 350px;
  padding: 20px;
  background-color: #fff;
}

.dash-chat .dash-contacts-search {
  position: relative;
}
.dash-contacts-search input {
  display: block;
  width: 100%;
  border: none;
  color: #9d9d9d;
  font-size: 12px;
  padding: 12px;
  padding-left: 24px;
  background-color: rgba(62, 173, 183, 5%);
  border-radius: 4px;
}
.dash-contacts-search .icon {
  color: #9d9d9d;
  font-size: 24px;
  position: absolute;
  top: calc(50% - 12px);
  left: 0px;
}
@media (max-width: 639px) {
  .dash-contacts {
    position: absolute;
    top: 0;
    bottom: 0;
    left: -100%;
    padding-top: 60px;
  }
  #close-contacts {
    display: block;
  }
}
</style>
