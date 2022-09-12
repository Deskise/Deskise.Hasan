<template>
  <div class="dash-product-page">
    <div class="container pt-3 dash-product-details">
      <div class="row">
        <div class="col-12 col-lg-6">
          <div class="dash-slider-images">
            <div class="main-image">
              <span :class="`status ${product.status.toLowerCase()}`">
                {{ product.status.split("_").join(" ") }}
              </span>
              <img :src="product.img" />
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
                <div>
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
                      this text can replace with any anter text
                    </p>
                    <router-link :to="{ name: 'login' }" v-slot="{ navigate }">
                      <button @click="navigate">Message Request</button>
                    </router-link>
                  </div>
                </div>
              </div>
              <div>
                <div class="image">
                  <img :src="product.user.img" />
                </div>
                <div class="data">
                  <div class="name">
                    {{ product.user.firstname + " " + product.user.firstname }}
                  </div>
                  <div class="dates">
                    <span class="new" v-date="product.dates.new"></span>&nbsp;
                    <span class="old" v-date="product.dates.old"></span>
                  </div>
                </div>
              </div>
              <div class="title">{{ product.name }}</div>
            </div>
            <div class="product-info">
              <div class="price-category-order">
                <div class="price">
                  <span class="new">{{ product.price }}$</span>
                  <span class="old">350$</span>
                </div>
                <div class="categroy-order">
                  <span class="categroy">{{
                    this.$store.state.category.categories[product.category_id]
                      .name
                  }}</span
                  >&nbsp;
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
                  Select Business Model
                  <span class="business-model">Lorem Ipsum</span>
                </p>
                URL:
                <span class="url">
                  <div
                    v-if="!this.$store.getters['user/isLoggedIn']"
                    class="outerLogin"
                  ></div>
                  -->
                  <!-- TODO: DO THE LINK HERE -->
                  <a href=""> Https://Www.Behance.Net/Sammeer12591d4 </a>
                </span>
              </div>
              <div class="reviewers">
                <div class="images">
                  <div
                    class="image"
                    v-for="img in product.bought.user_imgs"
                    :key="img"
                  >
                    <img :src="img" />
                  </div>
                </div>
                <div class="number">{{ product.bought.count }}</div>
              </div>
              <div class="footer-buttons" v-if="product.status !== 'sold'">
                <button
                  class="dash-button buy-icon"
                  data-bs-toggle="offcanvas"
                  data-bs-target="#offcanvasScrolling"
                  aria-controls="offcanvasScrolling"
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
                    <BuyOffcanvas :product="product" />
                    <div class="mt-3 btnComplete">
                      <button
                        :class="{ disabledBtn: comletePayMent }"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal"
                        @click="comletePayMent = true"
                        :disabled="comletePayMent"
                      >
                        Complete Payment
                      </button>
                      <!-- ---------------------- model of complete payment -->
                      <div
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
                                  <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
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
                      </div>
                      <!-- ------------------------------------------------ -->
                    </div>
                  </div>
                </div>
                <!-- ---------------------------------------------- -->
                <!-- ------------------------- model of message request--------------------- -->
                <button
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
                </button>
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
      <div class="profile-statistics">
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
      </div>
      <div class="chart-statistics">
        <div class="statistic">
          <div class="labels">
            <div class="label">
              <div class="key">Traffic</div>
            </div>
            <div class="label">
              <div class="key">Page Views</div>
              <div class="value">100.8356 P/MO</div>
            </div>
            <div class="label">
              <div class="key">Visits</div>
              <div class="value">100.8356 P/MO</div>
            </div>
          </div>
          <canvas id="price-chart" height="250" role="img"></canvas>
        </div>
        <div class="statistic">
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
        </div>
      </div>
      <div class="assets-statistics">
        <div class="title">Business Assets Included</div>
        <div class="statistic">
          <span class="key">Domain</span>
          <span class="value"
            ><a href="javascript:void(0)"
              >Https://Www.Behance.Net/Sammeer12591d4</a
            ></span
          >
        </div>
        <div class="statistic">
          <span class="key">Instagram</span>
          <span class="value"
            ><a href="javascript:void(0)"
              >Https://Www.Behance.Net/Sammeer12591d4</a
            ></span
          >
        </div>
        <div class="statistic">
          <span class="key">Twitter</span>
          <span class="value"
            ><a href="javascript:void(0)"
              >Https://Www.Behance.Net/Sammeer12591d4</a
            ></span
          >
        </div>
        <div class="statistic">
          <span class="key">Web</span>
          <span class="value"
            ><a href="javascript:void(0)"
              >Https://Www.Behance.Net/Sammeer12591d4</a
            ></span
          >
        </div>
      </div>
    </div>
    <div class="container similar-products">
      <div class="title">Similar</div>
      <div class="dash-products row">
        <div
          class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4 pe-0 SingleProduct"
          v-for="p in ps"
          :key="p.id"
        >
          <product :id="p"></product>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import Product from "../../components/Products/Product.vue";
import BuyOffcanvas from "./BuyOffcanvas.vue";
export default {
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      product: this.$store.state.product.products.data[this.id],
      comletePayMent: false,
    };
  },
  methods: {
    async like() {},
    DeleteOffinsive() {
      setTimeout(() => {
        document.querySelector(".offcanvasClose").click();
      }, 300);
      setTimeout(() => {
        this.$router.push("/chat");
      }, 600);
    },
  },
  computed: {
    ...mapGetters("product", ["products"]),
    ps() {
      return this.products({ not: this.id });
    },
  },
  components: {
    Product,
    BuyOffcanvas,
  },
  async beforeRouteUpdate(to, from, next) {
    await this.$store.dispatch("product/single", { id: to.params.id });
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0;
    next();
  },
};
</script>

<style lang="css" scoped src="./Single.css"></style>
<style>
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
