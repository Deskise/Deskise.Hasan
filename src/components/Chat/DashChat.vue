<template>
  <div class="dash-chat">
    <SideBar />
    <ChatBox :chat-id="chatId" />
    <!-- Stripe Payment Modal -->
    <div
      v-show="isOffcanvasVisible"
      class="offcanvas offcanvas-end"
      data-bs-scroll="false"
      data-bs-backdrop="false"
      tabindex="-1"
      id="offcanvasScrolling"
      ref="offcanvas"
      aria-labelledby="offcanvasScrollingLabel"
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
        <BuyOffcanvas :product="product" class="mb-2" />
        <div v-if="showError" class="error">{{ errorMsg }}</div>
        <form id="payment-form">
          <div id="link-authentication-element">
            <!--Stripe.js injects the Link Authentication Element-->
          </div>
          <div id="payment-element">
            <!--Stripe.js injects the Payment Element-->
          </div>
          <div id="payment-message" class="hidden"></div>
        </form>
        <div class="mt-3 btnComplete">
          <button
            :class="{ disabledBtn: comletePayMent }"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
            @click="checkOut"
            :disabled="comletePayMent"
          >
            Complete Payment
          </button>
          <!-- --------->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import SideBar from "./SideBar.vue";
import ChatBox from "./ChatBox/ChatBox.vue";
import { Offcanvas } from "bootstrap";
import { loadStripe } from "@stripe/stripe-js";
import eventBus from "../../config/Services/EvenBus";

export default {
  components: {
    SideBar,
    ChatBox,
  },
  props: {
    chatId: Number,
  },
  data() {
    return {
      showError: false,
      errorMsg: "",
      isProcessing: false,
      stripe: null,
      elements: null,
      offcanvasInstance: null,
      paymentMessage: "",
      isError: false,
      mountedElements: [],
      isOffcanvasVisible: false,
    };
  },
  computed: {
    clientSecret() {
      return this.$store.state.payment.intent?.clientSecret;
    },
  },
  methods: {
    initOffcanvas() {
      if (this.$refs.offcanvas && !this.offcanvasInstance) {
        this.offcanvasInstance = new Offcanvas(this.$refs.offcanvas);
        console.log("offcanvas:", this.offcanvasInstance);
      }
    },
    async createStripeInstance() {
      this.isOffcanvasVisible = true; // Show the offcanvas

      let clientSecret = this.clientSecret;
      const stripePublicKey = process.env.VUE_APP_STRIPE_KEY;
      this.stripe = await loadStripe(stripePublicKey);
      this.elements = this.stripe.elements({ clientSecret });

      const linkAuthenticationElement =
        this.elements.create("linkAuthentication");
      linkAuthenticationElement.mount("#link-authentication-element");

      const paymentElementOptions = {
        layout: "tabs",
      };

      const paymentElement = this.elements.create(
        "payment",
        paymentElementOptions
      );
      paymentElement.mount("#payment-element");
      // this.showMenu ? this.showMenu = false : this.showMenu = true;
      let BuyOffcanvas = new Offcanvas(
        document.getElementById("offcanvasScrolling")
      );
      BuyOffcanvas.show();
      this.$store.dispatch("ChangeLoading", false);
    },
    showOffcanvas() {
      if (this.offcanvasInstance) {
        this.offcanvasInstance.show();
      }
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

  mounted() {
    this.initOffcanvas();
    eventBus.on("create-stripe-instance", this.createStripeInstance);
  },
  beforeUnmount() {
    eventBus.off("create-stripe-instance", this.createStripeInstance);
  },
};
</script>
<style scoped>
.dash-chat {
  display: flex;
  justify-content: space-between;
  align-items: stretch;
  position: relative;
  overflow: hidden;
  height: 90vh;
  max-height: 100vh;
  /* margin-top: -60px; */
}

@media (max-width: 639px) {
  .dash-chat .chat-attachment {
    position: absolute;
    top: 0;
    bottom: 0;
    right: -100%;
  }

  .dash-chat #open-agreements {
    display: block;
  }

  .dash-chat .chat-attachment {
    padding-top: 60px;
  }
}

@media (max-width: 400px) {
  .dash-chat .chat-attachment {
    max-width: 100vw;
  }
}

/* ofcanvas */
.error {
  background-color: tomato;
  padding: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  color: #ffffff;
}
#payment-form {
  /* width: 80vw; */
  /* min-width: 250px; */
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

/* Buttons and links */
button {
  background: #5469d4;
  font-family: Arial, sans-serif;
  color: #ffffff;
  border-radius: 4px;
  border: 0;
  padding: 12px 16px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  display: block;
  transition: all 0.2s ease;
  box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
  width: 100%;
}
button:hover {
  filter: contrast(115%);
}
button:disabled {
  opacity: 0.5;
  cursor: default;
}

/* spinner/processing state, errors */
.spinner,
.spinner:before,
.spinner:after {
  border-radius: 50%;
}
.spinner {
  color: #ffffff;
  font-size: 22px;
  text-indent: -99999px;
  margin: 0px auto;
  position: relative;
  width: 20px;
  height: 20px;
  box-shadow: inset 0 0 0 2px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
.spinner:before,
.spinner:after {
  position: absolute;
  content: "";
}
.spinner:before {
  width: 10.4px;
  height: 20.4px;
  background: #5469d4;
  border-radius: 20.4px 0 0 20.4px;
  top: -0.2px;
  left: -0.2px;
  -webkit-transform-origin: 10.4px 10.2px;
  transform-origin: 10.4px 10.2px;
  -webkit-animation: loading 2s infinite ease 1.5s;
  animation: loading 2s infinite ease 1.5s;
}
.spinner:after {
  width: 10.4px;
  height: 10.2px;
  background: #5469d4;
  border-radius: 0 10.2px 10.2px 0;
  top: -0.1px;
  left: 10.2px;
  -webkit-transform-origin: 0px 10.2px;
  transform-origin: 0px 10.2px;
  -webkit-animation: loading 2s infinite ease;
  animation: loading 2s infinite ease;
}

@-webkit-keyframes loading {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes loading {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

@media only screen and (max-width: 600px) {
  form {
    width: 60vw;
    min-width: initial;
  }
}
</style>
