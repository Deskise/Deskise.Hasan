<template>
  <div class="chat-box-header">
    <!-- <button id="open-contacts" class="dash-btn sm">
      <span>Contacts</span>
    </button> -->
    <div class="avatar-image">
      <img :src="img" />
    </div>
    <div class="chat-box-contact">{{ name }}</div>
    <div class="chat-box-order">#{{ id }}</div>
    <div class="break"></div>
    <div class="chat-box-menu dash-has-menu" @click="handleClick">
      <div class="chat-box-icon">
        <i class="fas fa-ellipsis-v"></i>
        <ul class="dash-sub-menu" :style="{ display: active ? '' : 'none' }">
          <!-- <li class="dash-sub-menu-item">
            <router-link :to="{ name: 'Agreement' }"
              >Create An Agreement</router-link
            >
          </li> -->
          <li class="dash-sub-menu-item">
            <router-link :to="{ name: 'SendFile' }">Send File </router-link>
          </li>
          <li class="dash-sub-menu-item">
            <router-link :to="{ name: 'Reporting' }">Reporting</router-link>
          </li>
        </ul>
      </div>
    </div>
    <!-- <button id="open-agreements" class="dash-btn sm">
      <span>Attachments</span>
    </button> -->
  </div>
</template>
<script>
export default {
  props: {
    img: String,
    name: String,
    id: String,
  },
  data() {
    return {
      active: false,
    };
  },
  methods: {
    handleClick() {
      this.active = !this.active;
    },
  },
};
</script>
<style scoped>
.chat-box-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 60px;
  background-color: #fff;
  max-height: 100vh;
  /* margin-top: auto; */
}
.chat-box-header .chat-box-order {
  margin-left: 25px;
  font-size: 18px;
  color: #040506;
  flex-grow: 1;
}

.chat-box-header .chat-box-icon {
  width: 24px;
  height: 24px;
  line-height: 22px;
  text-align: center;
  font-size: 14px;
  border: 1px solid #040506;
  border-radius: 50%;
  cursor: pointer;
}
.chat-box-menu.dash-has-menu .dash-sub-menu {
  left: initial;
  right: 0;
  max-width: 220px;
  border: #3eadb7 1px solid;
  border-radius: 10px;
}
.chat-box-header .dash-sub-menu {
  text-align: left;
}
.avatar-image {
  width: 40px;
  height: 40px;
  line-height: 40px;
  overflow: hidden;
  margin-right: 18px;
}
.avatar-image img {
  display: block;
  margin: auto;
  max-width: 100%;
  border-radius: 50%;
}
#open-contacts {
  margin-right: 15px;
}
#open-agreements {
  margin-left: 15px;
}
#open-contacts,
#open-agreements {
  border-radius: 8px;
  border: none;
  padding: 10px 20px;
  font-weight: bold;
  cursor: pointer;
}
.chat-box-icon {
  position: relative;
}
.dash-sub-menu {
  width: 200px;
  height: auto;
  background-color: #fff;
  position: absolute;
  padding: 10px;
}
.dash-sub-menu-item {
  margin: 10px 0;
  padding: 5px 0px;
  border-bottom: #e1e1e1 1px solid;
}
.dash-sub-menu-item:hover{
  color: steelblue;
  border-bottom: #3eadb7 1px solid;
  
}
.dash-sub-menu-item a {
  color: black;
  width: 100%;
}
.dash-sub-menu-item a:hover {
  color: #3eadb7;
}
.chat-box-contact {
  font-size: 18px;
  color: #040506;
  padding-right: 55px;
  border-right: 1px solid rgba(201, 201, 201, 25%);
}
@media (max-width: 639px) {
  #open-contacts {
    display: block;
  }
}
@media screen and (max-width: 750px) {
  .chat-box-header {
    flex-wrap: wrap;
  }
  .chat-box-header .avatar-image {
    order: 1;
  }
  .chat-box-header .chat-box-contact {
    order: 2;
  }
  .chat-box-header .chat-box-order {
    order: 3;
  }
  .chat-box-contact {
    padding-right: 15px;
  }
  .chat-box-header .break {
    flex-basis: 100%;
    order: 4;
    margin-bottom: 10px;
  }
  .chat-box-header #open-contacts {
    order: 5;
  }

  .chat-box-header #open-agreements {
    order: 6;
  }
  .chat-box-header .dash-has-menu {
    order: 7;
  }
  .chat-box-header .dash-btn.sm {
    padding: 12px 12px;
  }
  .chat-box-header {
    padding: 10px;
  }
}
@media (max-width: 400px) {
  .chat-box-header .chat-box-order {
    margin-left: 0px;
  }
}
</style>
