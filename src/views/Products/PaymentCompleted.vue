<template>
  <div class="dash-product-page">
    <div class="container p-3 wrapper">
      <div class="d-flex flex-column align-items-center-justify-content-center">
        <div class="">
          <div>
            <p>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="55">
                <path
                  d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"
                  fill="#3eadb7" />
              </svg>
            </p>
            <p class="bold">{{ status }}</p>
            <p>{{ message }}</p>
          </div>
          <div class="">
            <button type="button" class="btn btn-secondary mt-3 px-5 py-2" @click="DeleteOffinsive"
              data-bs-dismiss="modal">
              OK
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ------------------------------------------------ -->
</template>

<script>
import { ref as storageRef, set } from "@firebase/database";
import db from "../../components/Chat/Api/db";

export default {
  data() {
    return {
      stripe: null,
      status: '',
      message: '',
    }
  },
  methods: {
    async DeleteOffinsive() {
      const product = JSON.parse(localStorage.getItem('product'));
      console.log(product.name);
      const date = new Date();
      const formattedDate = date.toISOString();
      const type = "order"
      const order = {
        "chat_id": this.$store.state.payment.buyerId,
        "from": this.$store.state.user.data.id,
        "created_at": formattedDate,
        "type": "order",
        "price": product.price,
        "name": product.name,
        "read": 'false',
      }
      function generateUniqueId() {
        const timestamp = Date.now();
        const randomNumber = Math.floor(Math.random() * 10000);
        return `${timestamp}_${randomNumber}`;
      }
      generateUniqueId()
      const messageId = generateUniqueId();

      // this.$store.dispatch('chat/agreement', {agreement});
      // await this.$store.dispatch('chat/agreement', { agreement, chatId: this.chatId, type: type });

      const chatId = this.$store.state.payment.buyerId
      await set(storageRef(db.db, `chats/${chatId}/messages/${messageId}`), order);

      this.$router.push({ name: 'chat', params: { chatId: chatId } });
    },
  },

  async mounted() {
    //  const stripePublicKey = process.env.VUE_APP_STRIPE_KEY
    // this.stripe = await loadStripe(stripePublicKey);
    const stripe = window.Stripe(
      process.env.VUE_APP_STRIPE_KEY
    )

    const clientSecret = new URLSearchParams(window.location.search)
      .get('payment_intent_client_secret')
    const { paymentIntent, error } = await stripe.retrievePaymentIntent(clientSecret)
    if (error) {
      console.log(error)
      this.message = 'An error has ocurred'
    }
    if (paymentIntent.status === 'succeeded') {
      
      

      this.status = 'Payment Complete Successfully'
      this.message = 'You Can Proceed To Receive The Files'
      const dataToSave = JSON.parse(localStorage.getItem('paymentData'));
      dataToSave.transaction_id = paymentIntent.id
      // localStorage.removeItem('paymentData');
      await this.$store.dispatch('payment/checkout', dataToSave)
    }
  },


  async created() {
    // await this.$store.dispatch('payment/confirm')
    // Retrieve the data from Local Storage
    // const dataToSave = JSON.parse(localStorage.getItem('paymentData'));

    // Remove the data from Local Storage to avoid duplicates
    // localStorage.removeItem('paymentData');
    // await this.$store.dispatch('payment/checkout', dataToSave)
  },
}

</script>

<style>
.dash-product-page {
  height: 95vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.wrapper {
  min-width: 500px;
  max-width: 500px;
  border: 1px solid #3eadb7;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
</style>