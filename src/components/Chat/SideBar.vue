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
    <div>
      <div class="contacts-switch">
        <ul class="tabs-links">
          <a class="link" :class="{ active: contacts==='contacts'}" href="javascript:void(0)" 
            @click="this.contacts = 'contacts'">Contacts</a>
          <a class="link" :class="{ active: contacts==='blocked'}" href="javascript:void(0)" 
            @click="this.contacts = 'blocked'">Blocked</a>
        </ul>
      </div>
      <ul v-if="contacts === 'contacts'" class="dash-list-contacts">
        <MsgDetails :chats="chats" />
      </ul>
      <ul v-if="contacts === 'blocked'" class="dash-list-contacts">
        <MsgDetails :chats="blocked" />
      </ul>
    </div>
  </div>
</template>
<script>
import MsgDetails from "./Messge/MsgDetails.vue";
import {  mapGetters  } from "vuex";

export default {
  data() {
    return {
      contacts: 'contacts'
    }
  },
  components: {
    MsgDetails,
  },
  computed: {
    ...mapGetters('chat', ['chats', 'blocked', 'hidden']),
  },
  watch: {
    chats: {
      handler: function() {
        this.$nextTick(() => {
          this.$forceUpdate();
        });
      },
      deep: true
    }
  },
created() {
  this.$store.dispatch("chat/blocked");
},
};
</script>
<style scoped>
.contacts-switch{
  margin-top: 10px;
}
.tabs-links {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid rgba(16, 27, 79, 10%);
  margin-bottom: 15px;
}
.tabs-links .link {
  font-size: 0.8rem;
  color: #040506;
  text-align: center;
  font-weight: 500;
}
.tabs-links .link.active {
  color: #3eadb7;
  border-bottom: 1px solid #3eadb7;
}
ul{
  padding-left: 0;
}
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
  max-width: 450px;
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
  padding: 12px 12px 12px 24px;
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
