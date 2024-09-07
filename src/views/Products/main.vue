<template>
  <section>
    <div class="container-fluid mb-5">
      <search @searchproducts="searchproducts"></search>
      <div class="row mt-5">
        <div class="filters pe-md-3 pe-lg-4 col-12 col-md-4 col-lg-3">
          <v-select
            id="MySelect1"
            placeholder="Subcategory"
            v-model="subcategorieSelected"
            :options="Object.values(this.subcategories)"
          ></v-select>
          <v-select 
            id="MySelect2" 
            placeholder="Seller Location"
            v-model="selectedLocation"
            :options="this.sellerLocation"
          ></v-select>
          <!-- <v-select 
            id="MySelect3" 
            placeholder="Time Left"
            v-model="isLifetimeSelected"
            :options="lifetimeOptions"
          ></v-select> -->

          <range-select
            name="Price Range"
            suffex="$"
            :min="0"
            :max="2000"
            :vstart="minPrice"
            :vend="maxPrice"
            @filterRange="filterRange"
          ></range-select>
          <range-select
            name="A Lifetime Of The Product"
            suffex="D"
            :min="5"
            :max="1000"
            :step="10"
            :vstart="minLifeTime"
            :vend="maxLifeTime"
            @filterRange="filterRange"
          ></range-select>
          <range-select
            name="Monthly Pageviews"
            suffex="K"
            :min="0"
            :max="700"
            :step="10"
            :vstart="MinMonthlyPageviews"
            :vend="MaxMonthlyPageviews"
            @filterRange="filterRange"
          ></range-select>

          <label>
            <input
              type="checkbox"
              v-model="showLifetimeProducts"
            />
            <span></span>
            <span>Show Lifetime Products</span>
          </label>

          <!-- <range-select
            name="Monthly Profit"
            suffex="mo"
            :min="5"
            :max="7"
            :step="1"
            :vstart="MinMonthlyProfit"
            :vend="MaxMonthlyProfit"
            @filterRange="filterRange"
          ></range-select> -->
        </div>
        <div class="main col-12 col-md-8 col-lg-9">
          <div class="categories">
                <category-list
                  class="mb-2"
                  link="productsByCategory"
                  :cat="category"
                />
          </div>
          <div class="row" v-if="productByCategoryId.length > 0">
            <div
              class="col-12 col-md-6 col-lg-4 px-0 mb-4 SingleProduct"
              v-for="p in productByCategoryId"
              :key="p.id"
            >
              <product :id="p.id"></product>
            </div>
          </div>
          <div class="row" v-else>
            <h4 class="mt-5">
              {{ $t("sorryNoProductsHere") }}
              <svg
                class="mx-2"
                width="25"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
              >
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path
                  d="M168 376C168 362.7 178.7 352 192 352H320C333.3 352 344 362.7 344 376C344 389.3 333.3 400 320 400H192C178.7 400 168 389.3 168 376zM80 224C80 179.8 115.8 144 160 144C204.2 144 240 179.8 240 224C240 268.2 204.2 304 160 304C115.8 304 80 268.2 80 224zM160 272C186.5 272 208 250.5 208 224C208 209.7 201.7 196.8 191.8 188C191.9 189.3 192 190.6 192 192C192 209.7 177.7 224 160 224C142.3 224 128 209.7 128 192C128 190.6 128.1 189.3 128.2 188C118.3 196.8 112 209.7 112 224C112 250.5 133.5 272 160 272V272zM272 224C272 179.8 307.8 144 352 144C396.2 144 432 179.8 432 224C432 268.2 396.2 304 352 304C307.8 304 272 268.2 272 224zM352 272C378.5 272 400 250.5 400 224C400 209.7 393.7 196.8 383.8 188C383.9 189.3 384 190.6 384 192C384 209.7 369.7 224 352 224C334.3 224 320 209.7 320 192C320 190.6 320.1 189.3 320.2 188C310.3 196.8 304 209.7 304 224C304 250.5 325.5 272 352 272zM0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464z"
                  fill="grey"
                />
              </svg>
            </h4>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mixin as loadOnBottom } from "@/Mixins/loadOnBottom.js";
import { mapGetters } from "vuex";
import Product from "../../components/Products/Product.vue";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
  components: { Product, vSelect },
  mounted() {
    this.scroll("product.products", async () => {
      await this.$store
        .dispatch("product/list", {
          page: this.$store.state.product.products.current_page + 1,
          category: this.category,
        })
        .then(() => {
          this.isLoading = false;
          this.scrolledToBottom = true;
        });
    });
  },
  props: {
    category: {
      type: String,
      default: "0",
    },
  },

  data() {
    return {
      textSearch: "",
      subcategorieSelected: null,
      selectedLocation: null,
      showLifetimeProducts: true,
      // timeLeftSelected: null,
      minPrice: 0,
      maxPrice: 2000,
      minLifeTime: 0,
      maxLifeTime: 2000,
      MinMonthlyPageviews: 0,
      MaxMonthlyPageviews: 100,
      // MinMonthlyProfit: 5,
      // MaxMonthlyProfit: 7,
    };
  },
  methods: {
    searchproducts(text) {
      this.textSearch = text;
    },
    filterRange(data) {
      // console.log(data)
      if (data.title == "Price Range") {
        this.minPrice = data.min;
        this.maxPrice = data.max;
      }
      if (data.title == "A Lifetime Of The Product") {
        this.minLifeTime = data.min;
        this.maxLifeTime = data.max;
      }
      if (data.title == "Monthly Pageviews") {
        this.MinMonthlyPageviews = data.min;
        this.MaxMonthlyPageviews = data.max;
      }
      if (data.title == "Monthly Profit") {
        this.MinMonthlyProfit = data.min;
        this.MaxMonthlyProfit = data.max;
      }
    },
  },

  computed: {
    ...mapGetters("product", ["products", "Allproducts"]),
    productByCategoryId() {
      // const remainingDaysArray = this.nonLifetimeProducts;
      const today = new Date();
      let Alldata = Object.values(JSON.parse(JSON.stringify(this.Allproducts)));
      let Searchproducts = [];
      for (let i = 0; i < Alldata.length; i++) {
        const untilDate = new Date(Alldata[i].until);
        const remainingDays = Math.ceil((untilDate - today) / (1000 * 60 * 60 * 24));
        const isLifetimeProduct = Alldata[i].is_lifetime;
        //  const hasNoUntilDate = !Alldata[i].until;
        
        if (
          Alldata[i].name
            .toLowerCase()
            .includes(this.textSearch.toLowerCase()) &&
          Number(Alldata[i].price) >= this.minPrice &&
          Number(Alldata[i].price) <= this.maxPrice &&
          Number(Alldata[i].views) >= this.MinMonthlyPageviews &&
          Number(Alldata[i].views) <= this.MaxMonthlyPageviews &&
          // remainingDays >= this.minLifeTime &&
          // remainingDays <= this.maxLifeTime &&
          // ( hasNoUntilDate || (remainingDays >= this.minLifeTime && remainingDays <= this.maxLifeTime)) &&
          (isLifetimeProduct || (!isLifetimeProduct && remainingDays >= this.minLifeTime && remainingDays <= this.maxLifeTime)) &&
          (this.showLifetimeProducts || !isLifetimeProduct) &&
          (!this.subcategorieSelected || Alldata[i].subcategory === this.subcategorieSelected) &&
          (!this.selectedLocation || Alldata[i].seller_location === this.selectedLocation) 
          // (!this.timeLeftSelected || remainingDaysArray[i] === this.timeLeftSelected)
        ) {
          Searchproducts.unshift(Alldata[i]);
        }
      }
      return Searchproducts;
      // return this.products({ category: this.category });
    },
    subcategories() {
      if (this.category === 0) return this.$store.state.category.subcategories;
      else {
        let s =
          this.$store.state.category.categories[this.category].subcategories;
        if (s.length === 0) return [];

        let a = [];
        s.forEach((e) => {
          a[e.id] = e.name;
        });
        return a;
      }
    },
    
    sellerLocation() {
      const allProducts = Object.values(this.Allproducts);
      const sellerLocations = Array.from(new Set(allProducts.map((product) => product.seller_location)));
      return sellerLocations;
    },
    // nonLifetimeProducts() {
    //   const today = new Date();
    //   return Object.values(this.Allproducts)
    //     .filter((product) => product.is_lifetime)
    //     .map((product) => {
    //       const untilDate = new Date(product.until);
    //       // const formattedDate = untilDate.toISOString().slice(0, 10);
    //       const remainingDays = Math.ceil((untilDate - today) / (1000 * 60 * 60 * 24));
    //       // return { date: formattedDate, remainingDays };
    //       return remainingDays
    //     });
    // },

  },
  mixins: [loadOnBottom],

  async beforeRouteUpdate(to, from, next) {
    if (to.params.id == 0) return next({ name: "products" });
    await this.$store.dispatch("product/list", {
      page: 1,
      category: to.params.id,
    });
    to.params.category = to.params.id;

    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0;
    next();
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
label {
  position: relative;
  color: $primary;
  text-transform: uppercase;
  display: flex;

  span {
    margin: 0 5px;
    transition: all linear 0.3s;
  }

  span:first-of-type {
    width: 16px;
    height: 16px;
    border: 1px solid;
    border-color: $primary;
    display: inline-block;
    border-radius: 50%;
    position: relative;
    top: 3px;

    &:after {
      content: "";
      position: absolute;
      top: calc(25% - 1px);
      left: 6px;
      border-bottom: 2px solid $secondary;
      border-right: 2px solid $secondary;
      height: 8px;
      width: 4px;
      transform: rotate(45deg);
      visibility: hidden;
      transition: all linear 0.3s;
      opacity: 0;
    }
  }

  input {
    display: none !important;
    &:checked ~ span {
      border-color: $secondary;
      color: $secondary;
      &:after {
        visibility: visible;
        opacity: 1;
      }
    }
  }
}
section {
  div.container-fluid {
    padding: 0 8%;
  }
}
h4 {
  color: grey;
}
.SingleProduct {
  height: 500px;
  width: 280px;
  @media (max-width : 767px ) {
    width: 100%;
  }
}
</style>
<style>
.vs--searchable .vs__dropdown-toggle {
  height: 45px;
  margin-bottom: 20px;
  border-color: #ddd;
}
</style>
