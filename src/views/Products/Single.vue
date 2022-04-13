<template>
  <div class="dash-product-page">
    <div class="dash-product-details">
      <div class="dash-slider-images">
        <div class="main-image">
          <span :class="`status ${product.status.toLowerCase()}`">
            {{ product.status.split("_").join(" ") }}
          </span>
          <img :src="product.img" />
        </div>
      </div>
      <div class="dash-details">
        <div class="person-info">
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
        <div class="product-info">
          <div class="title">{{ product.name }}</div>
          <div class="price-category-order">
            <div class="price">
              <span class="new">{{ product.price }}$</span>
              <span class="old">350$</span>
            </div>
            <div class="categroy-order">
              <span class="categroy">{{
                this.$store.state.category.categories[product.category_id].name
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
            <p class="mt-0">
              Select Business Model
              <span class="business-model">Lorem Ipsum</span>
            </p>
            URL:
            <span class="url">
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
          <div class="footer-buttons">
            <button class="dash-button buy-icon">
              <span>Buy</span>
              <span>
                <font-awesome-component
                  icon="dollar-sign"
                  :bold="false"
                ></font-awesome-component>
              </span>
            </button>
            <button class="dash-button buy-icon">
              <span>Message Request</span>
              <span>
                <font-awesome-component
                  icon="telegram-plane"
                ></font-awesome-component>
              </span>
            </button>
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
    <div class="dash-product-statistics">
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
    <div class="similar-products">
      <div class="title">Similar</div>
      <div class="dash-products row">
        <div
          class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4 pe-0"
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
    };
  },
  methods: {
    async like() {},
  },
  computed: {
    ...mapGetters("product", ["products"]),
    ps() {
      return this.products({ not: this.id });
    },
  },
  components: {
    Product,
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
