<template>
  <div v-if="product" class="dash-product-page">
    <div class="container pt-3 dash-product-details">
      <div class="row">
        <div class="col-12 col-lg-6">
          <div class="dash-slider-images">
            <div class="main-image">
              <Swiper :pagination="true">
                  <SwiperSlide v-for="img in assets" :key="img.id">
                    <!-- <img :src="product.img" /> -->
                    <img :src="`${baseUrl}/${img}`">
                  </SwiperSlide>
                </Swiper>
              <span :class="`status ${product.status.toLowerCase()}`">
                {{ product.status.split("_").join(" ") }}
              </span>
              
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="dash-details">
            <div
              :class="{
                'person-info': true,
                'p-2': !this.$store.getters['user/isLoggedIn'],
              }"
            >
              <div
                v-if="!this.$store.getters['user/isLoggedIn']"
                class="outerLogin"
              >
                <div class="h-50 w-100">
                  <div>
                    <p class="mb-0">
                      <font-awesome-component
                        icon="shield-check"
                        :bold="false"
                      ></font-awesome-component>
                    </p>
                    <p class="mb-0 font-wieght-bold">
                      Create Your Acount to View Details Information
                    </p>
                    <p class="mb-0">
                      Signup to get access to the details
                    </p>
                    <router-link :to="{ name: 'signup' }" v-slot="{ navigate }">
                      <button @click="navigate" class="text-center mt-4">Sign-up Now</button>
                    </router-link>
                  </div>
                </div>
              </div>
              <div>
                <div>
                  <div class="image">
                    <img :src="product.user.img" />
                  </div>
                  <div class="data">
                    <div class="name">
                      {{ product.user.firstname + " " + product.user.lastname }}
                    </div>
                    <div class="dates">
                      <span class="new" v-date="product.dates.new"></span>&nbsp;
                      <span class="old" v-date="product.dates.old"></span>
                    </div>
                  </div>
                </div>
                <div class="actions d-flex flex-column align-items-end ">
                  <div class="exit" @click="$router.push({ name: 'home' })">
                    <flat-icon-component icon="cross" />
                  </div>
                  <div class="like" @click="like">
                    <flat-icon-component
                      icon="heart"
                      :type="this.product.liked ? 'solid' : 'rounded'"
                    />
                    <p>{{ this.product.likes }}</p>
                  </div>
                  <div v-if="product.affiliating" class="affiliate" @click="affiliate">
                    <flat-icon-component
                      icon="share"
                      :type="'solid'"
                    />
                  </div>
                  <p v-show="showCopiedToaster" class="copied_toaster">Link copied to clipboard</p>
                </div>
              </div>
              <div class="title">{{ product.name }}</div>
            </div>
            <div class="product-info">
              <div class="price-category-order">
                <div class="price">
                  <span class="new">{{ product.price }}$</span>
                  <span class="old">{{ product.old_price }}$</span>
                </div>
                <div class="categroy-order">
                  <span class="categroy">
                    {{ this.$store.state.category.categories[product.category_id].name  }}
                  </span>
                  <span class="order">#{{ product.id }}</span>
                </div>
              </div>
              <perfect-scrollbar class="description">
                {{ product.description }}
              </perfect-scrollbar>

              <div class="footer-details">
                <p class="mb-0" v-if="product.is_lifetime">
                  Is The License For Life!<br /><span class="date">{{
                    product.until
                  }}</span>
                </p>
                <p class="mt-0 mb-1">
                  Business Model:
                  <span class="business-model">{{
                    product.data.subcategory.name ?? "None"
                  }}</span>
                </p>
                <div>
                  <div
                    v-if="!this.$store.getters['user/isLoggedIn']"
                    class="outerLogin"
                  ></div>
                  <div v-for="social in product.social" :key="social.id">
                    {{ social.account.name }}:
                    <span class="url">
                      <a href=""> {{ social.link }} </a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="reviewers">
                <div class="images-wrapper" v-if="product.bought.count > 0">
                  <div
                    class="image-container"
                    v-for="(img, index) in product.bought.user_imgs"
                    :key="index"
                  >
                    <img :src="img.img" alt="user" />
                  </div>
                </div>
                <div class="number">{{ product.bought.count }} Bought</div>
              </div>
              <div class="footer-buttons" v-if="product.status !== 'sold'">
                <button
                  class="dash-button buy-icon"
                  :disabled="!this.$store.getters['user/isLoggedIn']"
                  aria-controls="offcanvasScrolling"
                  @click="createIntent"
                >
                  <span>Buy</span>
                  <span>
                    <font-awesome-component
                      icon="dollar-sign"
                      :bold="false"
                    ></font-awesome-component>
                  </span>
                </button>
                <!--  offcanvas of buy btn---------------------------------------------- -->
                  <div
                    class="offcanvas offcanvas-end"
                    data-bs-scroll="false"
                    data-bs-backdrop="true"
                    tabindex="-1"
                    id="offcanvasScrolling"
                    aria-labelledby="offcanvasScrollingLabel"
                    style="min-width: 450px; !important"
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
                      <!-- <button id="submit">
                        <div class="spinner hidden" id="spinner"></div>
                        <span id="button-text">Pay now</span>
                      </button> -->
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
                      <!-- ---------------------- model of complete payment -->
                      <!-- <div
                        class="modal modelsuccess fade"
                        id="exampleModal"
                        tabindex="-1"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true"
                      >
                        <div class="modal-dialog">
                          <div class="modal-content p-3">
                            <div>
                              <p>
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  viewBox="0 0 512 512"
                                  width="55"
                                >
                                  <path
                                    d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"
                                    fill="#3eadb7"
                                  />
                                </svg>
                              </p>
                              <p class="bold">Payment Complete Successfully</p>
                              <p>You Can Proceed To Receive The Files</p>
                            </div>
                            <div class="modal-footer">
                              <button
                                type="button"
                                class="btn btn-secondary"
                                @click="DeleteOffinsive"
                                data-bs-dismiss="modal"
                              >
                                OK
                              </button>
                            </div>
                          </div>
                        </div>
                      </div> -->
                      <!-- ------------------------------------------------ -->
                    </div>
                  </div>
                </div>
                <!-- ---------------------------------------------- -->
                <!-- ------------------------- model of message request--------------------- -->
                <!-- <button
                  class="dash-button buy-icon"
                  data-bs-toggle="modal"
                  data-bs-target="#staticBackdrop"
                >
                  <span>Message Request</span>
                  <span>
                    <font-awesome-component
                      icon="telegram-plane"
                    ></font-awesome-component>
                  </span>
                </button> -->
                <!-- Modal -->
                <div
                  class="modal modelMessageRequest fade"
                  id="staticBackdrop"
                  data-bs-backdrop="static"
                  data-bs-keyboard="false"
                  tabindex="-1"
                  aria-labelledby="staticBackdropLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                        <p>
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            width="55"
                          >
                            <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                              d="M501.6 4.186c-7.594-5.156-17.41-5.594-25.44-1.063L12.12 267.1C4.184 271.7-.5037 280.3 .0431 289.4c.5469 9.125 6.234 17.16 14.66 20.69l153.3 64.38v113.5c0 8.781 4.797 16.84 12.5 21.06C184.1 511 188 512 191.1 512c4.516 0 9.038-1.281 12.99-3.812l111.2-71.46l98.56 41.4c2.984 1.25 6.141 1.875 9.297 1.875c4.078 0 8.141-1.031 11.78-3.094c6.453-3.625 10.88-10.06 11.95-17.38l64-432C513.1 18.44 509.1 9.373 501.6 4.186zM369.3 119.2l-187.1 208.9L78.23 284.7L369.3 119.2zM215.1 444v-49.36l46.45 19.51L215.1 444zM404.8 421.9l-176.6-74.19l224.6-249.5L404.8 421.9z"
                              fill="#3eadb7"
                            />
                          </svg>
                        </p>
                        <p class="bold">
                          this title can replace with any anther title
                        </p>
                        <p>this text can replace with any anther text</p>
                        <textarea
                          name="message"
                          id="message"
                          placeholder="text Message"
                          class="p-2"
                        ></textarea>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-secondary"
                          data-bs-dismiss="modal"
                        >
                          Send
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ......................................... -->
              </div>
              <div class="footer-features">
                <div class="feature" v-if="product.verified">
                  <flat-icon-component
                    icon="crown"
                    class="icon"
                  ></flat-icon-component>
                  Verified Deskise
                </div>
                <div class="feature" v-if="product.special">
                  <flat-icon-component
                    icon="shield-check"
                    class="icon"
                  ></flat-icon-component>
                  Special Item
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-5 container dash-product-statistics">
      
      <!-- <div class="profile-statistics">
        <div class="statistics">
          <div class="statistic">
            <div class="key">Average monthly traffic</div>
            <div class="value">30K$</div>
          </div>
          <div class="statistic">
            <div class="key">business start</div>
            <div class="value">3 years ago</div>
          </div>
          <div class="statistic">
            <div class="key">business start making money</div>
            <div class="value">2 years ago</div>
          </div>
          <div class="statistic">
            <div class="key">Profits last 3 months</div>
            <div class="value">30K$</div>
          </div>
          <div class="statistic">
            <div class="key">Profits last 6 months</div>
            <div class="value">60K$</div>
          </div>
          <div class="statistic">
            <div class="key">Profits last 12 months</div>
            <div class="value">500K$</div>
          </div>
        </div>
      </div> -->
      <div class="chart-statistics ">
        <div class="statistic">
          <div class="labels p-4 d-flex">
            <div class="label">
              <div class="key">Traffic:</div>
            </div>
            <div class="d-flex w-100 justify-content-start">
              <div class="label mx-4">
                <div class="key">Page Views</div>
                <div class="value">{{ this.product.views.length  }}</div>
              </div>
              <!-- <div class="label">
                <div class="key">Visits</div>
                <div class="value">100.8356 P/MO</div>
              </div> -->
            </div>
          </div>
          <!-- <canvas id="price-chart" height="250" role="img"></canvas> -->
        </div>
        <!-- <div class="statistic">
          <div class="labels">
            <div class="label">
              <div class="key">Earnings</div>
            </div>
            <div class="label">
              <div class="key">Net Profit</div>
              <div class="value">100.8356 P/MO</div>
            </div>
            <div class="label">
              <div class="key">Total</div>
              <div class="value">100.8356 P/MO</div>
            </div>
          </div>
          <canvas id="earnings-chart" height="250" role="img"></canvas>
        </div> -->
      </div>
    </div>
    <div v-if="similar.length >= 0" class="container similar-products">
      <div class="title">Similar</div>
      <div class="dash-products row">
        <div
          class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4 pe-0 SingleProduct"
          v-for="p in similar"
          :key="p.id"
        >
          <Product :id="p"></Product>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import { mapGetters, mapState } from "vuex";
import Product from "../../components/Products/Product.vue";
// import BuyOffcanvas from "./BuyOffcanvas.vue";

import { loadStripe } from '@stripe/stripe-js';
import { Offcanvas } from 'bootstrap'
export default {
  components: {
    Swiper,
    SwiperSlide,
    Product
  },
  props: {
    id: {
      type: Number,
      required: true,
    },
  },

  data() {
    return {
      // product: this.$store.state.product.products.data[this.id],
      comletePayMent: false,
      showCopiedToaster: false,
      stripe: null,
      elements: null,
      showMenu: false,
      showError: false,
      errorMsg: '',
      // slides: 1,
    };
  },
  methods: {
    getSlides() {
      if (window.matchMedia("(max-width: 576px").matches) this.slides = 1;
      else if (window.matchMedia("(max-width: 768px").matches)
        this.slides = 1.5;
      else if (window.matchMedia("(max-width: 998px").matches)
        this.slides = 2.5;
      else if (window.matchMedia("(max-width: 1200px").matches)
        this.slides = 3.5;
      else if (window.matchMedia("(max-width: 1500px").matches) this.slides = 4;
      else this.slides = 5;
    },
    async checkOut() {
      this.comletePayMent = true
      if (!this.clientSecret) {
        console.error("Client secret not available. Payment cannot be processed.");
        return;
      }
      const data = {
        product_id: this.product.id,
        user_id: this.$store.state.user.data.id,
        price: this.product.price,
        ownerId: this.product.user.id,
        affiliate_code: this.$route.query.tracking
      }
      localStorage.setItem('product', JSON.stringify(this.product))
      localStorage.setItem('paymentData', JSON.stringify(data));
      
      try {
        const { error } = await this.stripe.confirmPayment({
          elements: this.elements,
          confirmParams: {
            return_url: "https://deskise.com/#/payment-complete",
            // return_url: "http://localhost:8080/#/payment-complete",
          },
        }
        );
        // Handle the payment confirmation response
        if (error.type === "card_error" || error.type === "validation_error") {
          this.showError = true
          this.errorMsg = error.message
        } else {
          this.showError = true
          this.errorMsg = "An unexpected error occurred."
        }
        let BuyOffcanvas = new Offcanvas(document.getElementById('offcanvasScrolling'));
        BuyOffcanvas.hide();
      } catch (error) {
        console.error("Error during payment processing:", error);
      }
      
    },

    async createIntent() {
      this.$store.dispatch("ChangeLoading", true);
      const data = {
        product_id: this.product.id,
        user_id: this.$store.state.user.data.id,
        price: this.product.price,
        ownerId: this.product.user.id,
        affiliate_code: this.$route.query.tracking
      }
      await this.$store.dispatch('payment/createIntent', data);
      let clientSecret = this.clientSecret

      // Create the Stripe instance and Elements after fetching the clientSecret
      const stripePublicKey =  process.env.VUE_APP_STRIPE_KEY
      this.stripe = await loadStripe(stripePublicKey);
      this.elements = this.stripe.elements({ clientSecret });

      const linkAuthenticationElement = this.elements.create('linkAuthentication');
      linkAuthenticationElement.mount('#link-authentication-element');

      const paymentElementOptions = {
        layout: 'tabs',
      };

      const paymentElement = this.elements.create('payment', paymentElementOptions);
      paymentElement.mount('#payment-element');
      // this.showMenu ? this.showMenu = false : this.showMenu = true;
      let BuyOffcanvas = new Offcanvas(document.getElementById('offcanvasScrolling'));
      BuyOffcanvas.show();
      this.$store.dispatch("ChangeLoading", false);
    },

    async like() {
      await this.$store.dispatch("product/LikeProduct", this.product.id);
      if (!this.$store.state.product.products.single[this.id].liked) {
        this.$store.state.product.products.single[this.id].liked = true;
        this.$store.state.product.products.single[this.id].likes++;
      } else {
        this.$store.state.product.products.single[this.id].liked = false;
        this.$store.state.product.products.single[this.id].likes--;
      }
    },
    affiliate() {
      const ownerId = this.product.user.id
      const userId = this.$store.state.user.data.id
      const productId = this.id
      const trackingCode = this.generateTrackingCode();

      // Generate the affiliate link using Laravel route and query parameters
      const baseUrl = process.env.VUE_APP_FRONTEND_URL
      const affiliateLink = `${baseUrl}/product/${productId}?owner=${ownerId}&user=${userId}&tracking=${trackingCode}`;
      const data = {
        affiliator_id: userId,
        owner_id : ownerId,
        product_id: productId,
        tracking_code: trackingCode,
        tracking_url: affiliateLink
      }
      const el = document.createElement('textarea');
        el.value = affiliateLink;
        el.setAttribute('readonly', '');
        el.style.position = 'absolute';
        el.style.left = '-9999px';
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
      this.$store.dispatch('affiliate/save', data)
      this.showCopiedToaster = true;

      // Hide the "Link copied to clipboard" message after 3 seconds
      setTimeout(() => {
        this.showCopiedToaster = false;
      }, 3000);
    },
    generateTrackingCode() {
      const length = 8; // Length of the tracking code
      const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      let trackingCode = '';

      for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        trackingCode += characters.charAt(randomIndex);
      }

      return trackingCode;
    },
    // DeleteOffinsive() {
    //   setTimeout(() => {
    //     document.querySelector(".offcanvasClose").click();
    //   }, 300);
    //   setTimeout(() => {
    //     const chatId = this.$store.state.payment.buyerId
    //     this.$router.push({ name: 'chat', params: { chatId: chatId } });
    //   }, 600);
    // },
  },
  computed: {
    ...mapGetters("product", ["products", "similarArray"]),
    ...mapState("payment", ["intent"]),
    // ...mapState("product", ["similar"]),
    clientSecret() {
      return this.$store.state.payment.intent.clientSecret
    },
    product() {
      // return this.$store.state.product.products.data[this.id]
      return this.$store.state.product.products.single[this.id]
    },
    assets() {
      // return JSON.parse(this.product.assets.assets)
      if (this.product && this.product.assets && this.product.assets.assets) {
        return this.product.assets.assets;
        // return JSON.parse(this.product.assets.assets);
      } else {
        return [];
      }
    },
    ps() {
      return this.products({ not: this.id });
      // const ps = this.$store.state.product.products.data[this.id].similar
      // const similar = Object.keys(ps)
      //                 .map((i) => {
      //                    return ps[i].id;
      //                 })
      //                 return similar
      // return this.$store.state.product.products.data[this.id].similar
    },
    similar() {
      return this.similarArray;
    },
    trckingCode(){
      return this.$route.query.tracking;
    },
    baseUrl() {
      return 'http://127.0.0.1:8000/products/images'
      // return process.env.VUE_APP_BACKEND_STORAGE;
    }
  },
  async beforeRouteUpdate(to, from, next) {
    try {
      await this.$store.dispatch("product/single", { id: to.params.id });
      if (this.$store.state.product.products.single) {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0;
        next()
      } else {
        next(false)
      }
    } catch (err) {
      console.log(err);
    }
    
    // next();
  },
  mounted() {
    this.$nextTick(function () {
      this.getSlides();
      window.addEventListener("resize", () => this.getSlides());
    });
  },
};
</script>

<style lang="css" scoped src="./Single.css"></style>
<style>
.images-wrapper {
  display: flex;
  justify-content: flex-start;
  gap: -40%;
  margin-right: 10px;
}

.image-container {
  position: relative;
  margin-right: -15%;
}

.image-container img {
  border: #c9c9c9 1px solid;
  border-radius: 50%;
  width: 28px;
  height: 28px;
  max-width: 100%;
  height: auto;
  aspect-ratio: 1/1;
}
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

.copied_toaster {
  padding: 4px 8px;
  border: 1px solid rgba(172, 197, 198, 30%);
  border-radius: 10px;
  color: #3eadb7;
  font-size: 0.8rem;
  width: max-content;
}
.actions {
	 height: auto;
}
 .actions div {
	 width: 40px;
	 height: 40px;
	 display: flex;
	 justify-content: center;
	 align-items: center;
	 cursor: pointer;
	 border-radius: 50%;
	 margin: 5px;
	 margin-bottom: 10px;
}
 @media (max-width: 1410px) {
	 .actions div {
		 width: 35px;
		 height: 35px;
	}
}
 .actions div * {
	 transform: translateY(12%);
}
 @media (max-width: 1410px) {
	 .actions div * {
		 font-size: 14px;
		 transform: translateY(9%);
	}
}
 .actions .exit {
	 background: #fb5b5b;
	 color: white;
}
 .actions .like {
	 background: transparent;
	 color: #c9c9c9;
	 border: 1px solid #c9c9c9;
	 position: relative;
}
 .actions .like p {
	 position: absolute;
	 margin: 0;
	 bottom: -20px;
}

.actions .affiliate {
	 background: transparent;
	 color: #c9c9c9;
	 border: 1px solid #c9c9c9;
	 position: relative;
   margin-top: 15px;
}
 
.offcanvas {
  z-index: 100000000 !important;
}
.offcanvas-backdrop {
  z-index: 10000000 !important;
}
.modal-dialog {
  border-radius: 20px !important;
}
</style>
