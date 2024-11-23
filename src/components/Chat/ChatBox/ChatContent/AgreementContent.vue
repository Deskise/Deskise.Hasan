<template>
  <div class="content-chat-text" v-show="msg.type === 'agreement'">
    <h4 class="agreemnet-title">Create An Agreement</h4>
    <div class="agreement-details">
      <div class="detail">
        <span class="key">Product Id :</span>
        {{ msg.product_id }}
      </div>
      <div class="detail">
        <span class="key">Agreement Details :</span>
        {{ msg.details }}
      </div>
      <div class="detail">
        <span class="key">Price :</span>
        {{ msg.price }}
      </div>
      <div class="detail">
        <span class="key">The Type Of Files To Be Delivered:</span>
        {{ msg.file_types }}
      </div>
      <div class="detail">
        <span class="key">Notes :</span>
        {{ msg.notes }}
      </div>
      <div v-if="msg.status == 'waiting'">
        <div v-if="msg.from === $store.state.user.data.id" class="detail">
          <span class="key">Status</span>
          {{ msg.status }}
        </div>
        <div
          v-if="msg.from !== $store.state.user.data.id"
          class="detail center"
        >
          <button
            class="btn-accept"
            value="Accepted"
            aria-controls="offcanvasScrolling"
            @click="respond"
          >
            Accept
          </button>
          <button class="btn-decline" value="Declined" @click="respond">
            Decline
          </button>
        </div>
      </div>
      <div v-else>
        <div class="detail">
          <span class="key">Status</span>
          {{ msg.status }}
        </div>
      </div>
    </div>
    <!-- offcanvase -  -->
    <div
      class="offcanvas offcanvas-end"
      data-bs-scroll="false"
      data-bs-backdrop="false"
      tabindex="-1"
      id="offcanvasScrolling"
      aria-labelledby="offcanvasScrollingLabel"
      ref="offcanvas"
      style="min-width: 450px !important"
    >
      <div class="offcanvas-header">
        <button
          type="button"
          class="btn-close offcanvasClose"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <div v-if="showError" class="error">{{ errorMsg }}</div>
        <form id="payment-form">
          <div id="link-authentication-element">
            <!-- Stripe.js injects the Link Authentication Element -->
          </div>
          <div id="payment-element">
            <!-- Stripe.js injects the Payment Element -->
          </div>
          <div id="payment-message" class="hidden"></div>
        </form>
        <div class="mt-3 btnComplete">
          <button
            :class="{ disabledBtn: completePayment }"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
            @click="checkOut"
            :disabled="completePayment"
          >
            Complete Payment
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, update } from "@firebase/database";
import db from "../../Api/db";
// import { loadStripe } from "@stripe/stripe-js";
// import { Offcanvas } from "bootstrap";
import { mapState } from "vuex";
// import eventBus from "../../../../config/Services/EvenBus";

export default {
  name: "AgreementContent",

  props: {
    msg: {
      required: true,
      type: Object,
    },
  },

  data() {
    return {
      showError: false,
      errorMsg: "",
      completePayment: false,
      stripe: null,
      elements: null,
      offcanvasInstance: null,
      hasInitialized: false,
    };
  },

  // mounted() {
  //   // Initialize the offcanvas instance
  //   this.initOffcanvas();
  // },

  // beforeUnmount() {
  //   // Cleanup when component is destroyed
  //   this.destroyOffcanvas();
  // },

  methods: {
    // initOffcanvas() {
    //   if (this.$refs.offcanvas && !this.offcanvasInstance) {
    //     this.offcanvasInstance = new Offcanvas(this.$refs.offcanvas);
    //   }
    // },

    // destroyOffcanvas() {
    //   if (this.offcanvasInstance) {
    //     this.offcanvasInstance.dispose();
    //     this.offcanvasInstance = null;
    //   }
    // },

    closeOffcanvas() {
      this.hasInitialized = false;
    },
    generateUniqueId() {
      const timestamp = Date.now();
      const randomNumber = Math.floor(Math.random() * 10000);
      return `${timestamp}_${randomNumber}`;
    },

    async respond(e) {
      this.$store.dispatch("ChangeLoading", true);
      const reply = e.target.value;
      const date = new Date();
      const formattedDate = date.toISOString();
      const fileTypes = JSON.parse(this.msg.file_types);

      const agreement = {
        chat_id: this.msg.chat_id,
        from: this.$store.state.user.data.id,
        created_at: formattedDate,
        msg_id: this.msg.msg_id ?? null,
        type: "agreement",
        product_id: this.msg.product_id,
        price: this.msg.price,
        notes: this.msg.notes,
        details: this.msg.details,
        file_types: JSON.stringify(fileTypes),
        status: reply,
      };

      // todo: change the method to update
      await this.$store.dispatch("chat/agreementResponse", {
        agreement,
        chatId: this.msg.chat_id,
        type: "agreement",
      });

      await update(
        ref(db.db, `chats/${this.msg.chat_id}/messages/${this.msg.msg_id}`),
        agreement
      );

      if (e.target.value === "Declined") {
        // this.$router.push({ name: "chats", params: this.msg.chat_id });
        this.$store.dispatch("ChangeLoading", false);
        return;
      }

      const paymentData = {
        product_id: this.msg.product_id,
        user_id: this.$store.state.user.data.id,
        price: this.msg.price,
        ownerId: this.msg.from,
        affiliate_code: this.$route.query.tracking ?? null,
      };
      localStorage.setItem("agreement", JSON.stringify(agreement));
      this.$store.state.payment.newPrice = this.msg.price;
      await this.$store.dispatch("payment/createIntent", paymentData);
      // let clientSecret = this.clientSecret;

      // Create the Stripe instance and Elements after fetching the clientSecret
      this.$router.push({
        name: "singleProduct",
        params: { id: this.msg.product_id },
      });
      // setTimeout(() => {
      //   eventBus.emit("create-stripe-instance");
      // }, 2000);
      // this.$store.dispatch("ChangeLoading", false);
    },

    async checkOut() {
      try {
        this.completePayment = true;

        if (!this.clientSecret) {
          throw new Error(
            "Client secret not available. Payment cannot be processed."
          );
        }

        const paymentData = {
          product_id: this.msg.product_id,
          user_id: this.$store.state.user.data.id,
          price: this.msg.price,
          ownerId: this.msg.from,
          affiliate_code: this.$route.query.tracking ?? null,
        };

        localStorage.setItem("paymentData", JSON.stringify(paymentData));

        const { error } = await this.stripe.confirmPayment({
          elements: this.elements,
          confirmParams: {
            // return_url: "https://deskise.com/#/payment-complete",
            return_url: "http://localhost:8080/#/payment-complete",
          },
        });

        if (error) {
          this.showError = true;
          this.errorMsg =
            error.type === "card_error" || error.type === "validation_error"
              ? error.message
              : "An unexpected error occurred.";

          if (this.offcanvasInstance) {
            this.offcanvasInstance.hide();
          }
        }
      } catch (error) {
        console.error("Error during payment processing:", error);
        this.showError = true;
        this.errorMsg = "Failed to process payment. Please try again.";
      } finally {
        this.completePayment = false;
      }
    },
  },

  computed: {
    ...mapState("payment", ["intent"]),
    clientSecret() {
      return this.$store.state.payment.intent.clientSecret;
    },
  },
};
</script>

<style lang="css" scoped src="../../../../views/Products/Single.css"></style>
<style scoped>
.agreemnet-title {
  margin-bottom: 10px;
  font-size: 1.2rem;
  text-align: center;
}
.detail {
  font-size: 1rem;
  color: #5f5f5f;
  padding: 10px 0px;
  border-bottom: 1px solid #b3b3b3;
  line-height: 21px;
}
.center {
  display: flex;
  align-items: center;
  justify-content: space-around;
  border: none;
  margin-top: 10px;
}
.key {
  font-size: 1rem;
  color: #040506;
  font-weight: 500;
}

.btn-accept {
  color: #fff;
  background-color: #4e1b56;
  padding: 8px 20px;
  border: none;
  border-radius: 5px;
  flex: 1;
  margin-inline: 4px;
}

.btn-decline {
  color: #fff;
  background-color: #fb5b5b;
  padding: 8px 20px;
  border: none;
  border-radius: 5px;
  flex: 1;
  margin-inline: 4px;
}

#payment-form {
  align-self: center;
  box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
    0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
  border-radius: 7px;
  padding: 40px;
}

.hidden {
  display: none;
}

#payment-message {
  color: rgb(105, 115, 134);
  font-size: 16px;
  line-height: 20px;
  padding-top: 12px;
  text-align: center;
}

#payment-element {
  margin-bottom: 24px;
}
</style>
