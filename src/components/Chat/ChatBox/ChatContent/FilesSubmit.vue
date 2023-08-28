<template>
  <div class="content-order-details" v-show="msg.type === 'files'">
    <div class="order-details-summary">Product Files</div>
    <div class="order-details">
      <div class="order-details-list">
        <div class="product-with-price">
          <span class="name">Access Info.</span>
          <span class="price">{{ msg.access }}</span>
        </div>
        <div class="product-with-price total text-wrap">
          <span class="key">uploaded files:</span>
          <p class="value pt-2 text-wrap" id="link">{{ msg.link }}</p>
          <p class="notes my-1">Copy the URL and past it in browser</p>
        </div>
      </div>
      <div class="payment-method">
        <span class="key">Notes</span>
      </div>
      <div class="notes">{{ msg.notes }}</div>
      <!-- <div class="status-order">Payment Completed Successfully</div> -->
    </div>
  </div>
</template>

<script>
export default {
  props: {
    msg: {
      required: true,
      type: Object,
    },
  },
  data() {
    return {
      
    }
  },
  computed: {
  }
}
</script>
<style scoped>
.product-with-price .name,
.product-with-price {
  white-space: normal;
  white-space: pre-wrap; 
}
#link{
  color: #3eadb7;
}
.chat-box .content-order-details {
  background: #FFF;
  padding: 15px 10px;
  border-radius: 10px;
  max-width: 475px;
}

.chat-box .chat-box-sender .content-order-details {
  border-top-left-radius: 0px;
}

.chat-box .content-order-details .order-details-summary {
  font-size: 16px;
  font-weight: bold;
  color: #040506;
  margin-bottom: 15px;
}

.chat-box .content-order-details .order-details {
  max-width: 400px;
  margin: auto;
}

.chat-box .content-order-details .order-details-list {
  margin-bottom: 20px;
}

.chat-box .content-order-details .product-with-price {
  display: flex;
  flex-direction: column;
  border-bottom: 1px solid #EEE;
  align-items: start;
  justify-content: space-between;
  font-size: 16px;
  color: #040506;
  padding: 6px 0px;
  
}

.chat-box .content-order-details .product-with-price.total {
  border-bottom: none;
  white-space: pre-wrap;
  width: 100%;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.chat-box .content-order-details .payment-method {
  border-bottom: 1px solid rgba(201, 201, 201, 25%);
  border-top: 1px solid rgba(201, 201, 201, 25%);
  padding: 10px 0px;
  margin-bottom: 8px;
}

.chat-box .content-order-details .payment-method .key {
  font-size: 16px;
  color: #040506;
  margin-right: 12px;
}

.chat-box .content-order-details .payment-method .value {
  color: #9D9D9D;
}

.chat-box .content-order-details .notes {
  font-size: 14px;
  color: #9D9D9D;
  margin-bottom: 40px;
}

.chat-box .content-order-details .status-order {
  font-size: 16px;
  color: #040506;
  padding: 10px 0px;
  border-top: 1px solid #C9C9C9;
  border-bottom: 1px solid #C9C9C9;
  text-align: center;
}

@media(max-width:750px) {
  .chat-box .content-order-details {
    flex-grow: 1;
    width: 100%;
    margin: 10px 0;
    border-radius: 4px;
  }
}</style>