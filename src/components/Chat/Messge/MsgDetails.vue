<template>
  <li v-for="c of chats" :key="c.id" class="dash-contact-item">
    <router-link
      :to="{ name: 'chats', params: { chatId: c.id } }"
      class="contanct"
    >
      <div class="dash-contact-image">
        <img :src="c.user.img" alt="image" />
      </div>
      <div class="contact-name-message">
        <div class="contact-name">
          {{ c.user.firstname.slice(0, 2) }} {{ c.user.lastname }}
        </div>
        <!-- <div class="contact-last-message">
          {{
            c.lastMsg?.type === "message"
              ? c.lastMsg.message.slice(0, 25)
              : "User Sent " + c.lastMsg?.type
          }}
        </div> -->
      </div>
      <div class="contact-time-count">
        <div class="contact-last-messages-time">
          {{ new Date(c.lastMsg?.created_at).getHours() }}:
          {{ new Date(c.lastMsg?.created_at).getMinutes() }}
        </div>
        <div class="contact-last-messages-count">4</div>
      </div>
    </router-link>
  </li>
</template>
<script>
import { mapState } from "vuex";

export default {
  name: "msg-details",
  computed: {
    ...mapState("chat", ["chats"]),
  },
};
</script>
<style scoped>
.dash-contact-item {
  padding: 18px 0px;
  border-bottom: 1px solid rgba(16, 27, 79, 10%);
  margin-bottom: 20px;
}
.dash-contact-item a {
  display: flex;
  justify-content: space-between;
}
.dash-contact-item .dash-contact-image {
  width: 40px;
  height: 40px;
  overflow: hidden;
  margin-right: 16px;
}
.dash-contact-item .dash-contact-image img {
  border-radius: 50%;
  max-width: 100%;
  display: block;
  margin: auto;
}
.dash-contact-item .contact-name {
  padding-top: 8px;
  font-size: 16px;
  color: #4e1b56;
  margin-bottom: 14px;
}
.dash-contact-item .contact-last-message {
  font-size: 12px;
  color: #9b9b9b;
}
.dash-contact-item .contact-time-count {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.dash-contact-item .contact-last-messages-time {
  font-size: 12px;
  color: #9d9d9d;
}
.dash-contact-item .contact-last-messages-count {
  width: 22px;
  height: 22px;
  line-height: 22px;
  background-color: #3eadb7;
  border-radius: 50%;
  color: #fff;
  text-align: center;
}
</style>
