<template>
  <div class="chat-attachment" style="right: 0">
    <span id="close-agreements">
      <!-- <font-awesome-component icon="times" :bold="false" /> -->
    </span>
    <div class="chat-product">
      <div class="product-info">
        <div class="product-title-and-price">
          <div class="product-title">{{ product.name }}</div>
          <div class="product-price-discount">
            <span class="product-price">{{ product.price }}$</span>
            <span v-if="product.old_price" class="product-old-price">{{ product.old_price }}$</span>
          </div>
        </div>
        <!-- <div class="product-action-and-order">
          <button class="dash-btn product-btn">Stop Selling</button>
          <span class="product-order">#3123</span>
        </div> -->
      </div>
      <div class="product-details">
        {{ product.description }}
      </div>
    </div>
    <div class="chat-attachment-tabs">
      <ul class="tabs-links">
        <!-- <li @click="this.tabs = 'agreements'">
          <a class="link" :class="{ active: tabs ==='agreements'}" href="javascript:void(0)">Agreemnts</a>
        </li> -->
        <li @click="this.tabs = 'files'">
          <a class="link" :class="{ active: tabs ==='files'}" href="javascript:void(0)">Files</a>
        </li>
        <!-- <li @click="this.tabs = 'rules'">
          <a class="link" :class="{ active: tabs ==='rules'}" href="javascript:void(0)">Rules</a>
        </li> -->
      </ul>
      <!-- <div v-if="tabs === 'agreements'" class="agreemet-tab">
        <div v-for="(agreement, index) in agreements" :key="index" class="dash-agreement">
          <div class="agreement-title">Agreement Details</div>
          <p class="agreement-details">
            {{ agreement.details }}
            <button class="dash-btn read-agreement-btn">Read Agreement</button>
          </p>
        </div>
      </div> -->
      <div v-if="tabs === 'files'" class="agreemet-tab">
        <div v-for="(chats, date) in files" :key="date" class="dash-agreement">
          <div class="agreement-title">{{ date }}</div>
          <div v-for="(chat, index) in chats" :key="index" class="agreement-details">
            <a v-for="(img, imgIndex) in chat.attachments" :key="imgIndex" :href="`${baseUrl}/chats/images/${img}`">
              <!-- <img :src="`${baseUrl}${img}`"> -->
              <img :src="`${baseUrl}/chats/images/${img}`">
            </a>
          </div>
        </div>
      </div>

      <!-- <div v-if="tabs === 'rules'" class="agreemet-tab">
        <div class="dash-agreement">
          <div class="agreement-title">Rules</div>
          <p class="agreement-details">
            this is the Rules tab
          </p>
        </div>
      </div> -->
    </div>
    <!-- <div class="dash-hsitory-calls">
      <div class="history-call missed">
        <div class="image">
          <img src="@/assets/images/chat-avatar.png" />
        </div>
        <div class="history-call-info">
          <div class="history-call-contact">Hilda Hansen</div>
          <div class="history-call-status">
            <span class="history-call-text">Missed Call From You</span>
            <span class="history-call-time">08:43 Am</span>
          </div>
        </div>
        <div class="history-call-icon">
          <font-awesome-component icon="phone-slash" :bold="false" />
        </div>
      </div>
      <div class="history-`call">
        <div class="image">
          <img src="@/assets/images/chat-avatar.png" />
        </div>
        <div class="history-call-info">
          <div class="history-call-contact">Hilda Hansen</div>
          <div class="history-call-status">
            <span class="history-call-text">Missed Call From You</span>
            <span class="history-call-time">08:43 Am</span>
          </div>
        </div>
        <div class="history-call-icon">
          <font-awesome-component icon="phone" :bold="false" />
        </div>
      </div>
      <div class="history-call">
        <div class="image">
          <img src="@/assets/images/chat-avatar.png" />
        </div>
        <div class="history-call-info">
          <div class="history-call-contact">Hilda Hansen</div>
          <div class="history-call-status">
            <span class="history-call-text">Missed Call From You</span>
            <span class="history-call-time">08:43 Am</span>
          </div>
        </div>
        <div class="history-call-icon">
          <font-awesome-component icon="phone" :bold="false" />
        </div>
      </div>
    </div> -->
    <!-- <div class="ringing-call">
      <div class="avatar-image lg">
        <img src="@/assets/images/chat-avatar.png" />
      </div>
      <div class="ringing-info">
        <div class="contact-name">Hilda Hansen</div>
        <div class="call-status">Call you</div>
      </div>
      <div class="ringing-actions">
        <a href="javascript:void(0)" class="action action-close">
          <font-awesome-component icon="times" :bold="false" />
        </a>
        <a href="javascript:void(0)" class="action action-answer">
          <font-awesome-component icon="phone" :bold="false" />
        </a>
      </div>
    </div> -->
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  data() {
    return {
      tabs: 'files'
    }
  },
  props: {
    product: {},
  },
  methods: {
    getImageUrl(img) {
      return `${this.baseUrl}/chats/images/${img}`;
    }
  },
  computed: {
    ...mapGetters("chat", ["agreements", "files"]),

    baseUrl() {
      // return 'http://127.0.0.1:8000/chats/images/'
      return process.env.VUE_APP_BACKEND_STORAGE;
    }

    // processedAttachments() {
    //   const baseUrl = 'http://127.0.0.1:8000/chats/images/';
    //   if (msg.attachments) {
    //     return msg.attachments.map((m) => baseUrl + m);
    //   } else {
    //     return [];
    //   }
    // }

  }
}

</script>

<style scoped>
img{
    margin-right: 5px;
    width: 100px;
    aspect-ratio: 1/1;
    border-radius: 8px;
}
.chat-attachment {
  max-width: 390px;
  padding: 20px 35px;
  background-color: #fff;
  position: relative;
  max-height: calc(100vh - 80px);
  overflow-y: scroll;
}
.chat-product {
  margin-bottom: 10px;
  padding-bottom: 25px;
  border-bottom: 1px solid rgba(16, 27, 79, 10%);
}

.chat-product .product-info {
  display: flex;
  justify-content: space-between;
}
.chat-product .product-action-and-order {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}
.chat-product .product-title {
  color: #040506;
  font-size: 1.1rem;
  /* margin-bottom: 5x; */
  font-weight: bold;
}
.chat-product .product-price-discount {
  display: flex;
}
.chat-product .product-price {
  color: #3eadb7;
  font-weight: bold;
  font-size: 1.2rem;
  display: inline-block;
  margin-right: 8px;
}
.chat-product .product-old-price {
  font-size: 16px;
  text-decoration: line-through;
}

.chat-product .product-btn.dash-btn {
  padding: 7px;
  background: none;
  border: 1px solid #3eadb7;
  color: #3eadb7;
  margin-bottom: 5px;
  font-weight: 400;
}

.chat-product .product-order {
  font-size: 1rem;
  color: #9b9b9b;
}

.chat-product .product-details {
  font-size: 1rem;
  /* margin-bottom: 4px; */
  text-align: left;
}

.chat-attachment-tabs {
  margin-bottom: 10px;
}

.chat-attachment .tabs-links {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  border-bottom: 1px solid rgba(16, 27, 79, 10%);
  margin-bottom: 15px;
  padding-left: 1px !important;
}

.chat-attachment .tabs-links .link {
  font-size: 14px;
  color: #040506;
  text-align: center;
}
.chat-attachment .tabs-links .link.active {
  color: #e590b5;
  border-bottom: 1px solid #e590b5;
}
.dash-agreement {
  border-bottom: 1px solid rgba(16, 27, 79, 10%);
  padding: 8px 0px;
}

.dash-agreement .agreement-title {
  font-size: 14px;
  font-weight: bold;
  color: #040506;
  margin-bottom: 8px;
}
.dash-agreement .agreement-details {
  display: flex;
  font-size: 14px;
  text-align: left;
  color: #9b9b9b;
}
.dash-agreement .agreement-details .read-agreement-btn {
  padding: 4px;
  cursor: pointer;
  color: #3eadb7;
  border: 1px solid #3eadb7;
  font-weight: bold;
  font-size: 12px;
  flex-grow: 1;
  display: inline-block;
  margin-left: 10px;
  margin-top: auto;
  background-color: #fff;
  min-width: max-content;
  max-height: 40px;
}

.dash-history-calls {
  position: relative;
}

.history-call {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid rgba(16, 27, 79, 10%);
  padding: 10px 0px;
}
.history-call .image {
  width: 40px;
  height: 40px;
  overflow: hidden;
}
.history-call .image img {
  display: block;
  margin: auto;
  border-radius: 50%;
  max-width: 100%;
}
.history-call .history-call-info {
  flex-grow: 1;
  margin: 0px 5px;
}
.history-call .history-call-contact {
  font-size: 18px;
}
.history-call .history-call-status {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 16px;
  color: #3eadb7;
}
.history-call.missed .history-call-status {
  color: #fb5b5b;
}

.history-call .history-call-time {
  font-size: 14px;
}
.history-call .history-call-icon {
  width: 35px;
  height: 35px;
  line-height: 35px;
  text-align: center;
  border-radius: 50%;
  font-size: 20px;
  color: #fff;
  background-color: #3eadb7;
}
.history-call.missed .history-call-icon {
  background-color: #fb5b5b;
}
.ringing-call {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 25px;
  background-color: #3eadb7;
  color: #fff;
  font-size: 18px;
  gap: 12px;
  border-radius: 20px;
}

.chat-attachment .ringing-call {
  position: absolute;
  bottom: 0;
  left: 20px;
  right: 20px;
}
.avatar-image.lg {
  width: 78px;
  height: 78px;
  line-height: 78px;
}
.ringing-call .ringing-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 18px;
}

.ringing-call .ringing-actions .action {
  width: 35px;
  height: 35px;
  line-height: 35px;
  text-align: center;
  border-radius: 50%;
  font-size: 18px;
}
.ringing-call .ringing-actions .action-close {
  background-color: #fb5b5b;
  color: #fff;
}
.ringing-call .ringing-actions .action-answer {
  background-color: #ffffff;
  color: #3eadb7;
}
.chat-attachment #close-agreements {
  right: initial;
  left: 10px;
}
.dash-btn {
  cursor: pointer;
  color: #86cbd2;
}
@media (max-width: 640px) {
  .chat-attachment {
    position: absolute;
    top: 0;
    bottom: 0;
    right: -100%;
    padding-top: 60px;
  }
}
@media (max-width: 400px) {
  .chat-attachment {
    max-width: 100vw;
  }
}
</style>
