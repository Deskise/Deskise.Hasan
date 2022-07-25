//TODO:Do the filters

<template>
  <section>
    <div class="container-fluid mb-5">
      <search @searchproducts="searchproducts"></search>
      <div class="row mt-5">
        <div class="filters  pe-md-3 pe-lg-4 col-12 col-md-4 col-lg-3">
          <single-select
            placeholder="Subcategory"
            :data="subcategories"
          ></single-select>
          <single-select placeholder="Seller Location"></single-select>
          <single-select placeholder="Time Left" class="mb-4"></single-select>

          <range-select
            name="Price Range"
            suffex="$"
            :min="100"
            :max="2000"
            :vstart="300"
            :vend="1500"
          ></range-select>
          <range-select
            name="A Lifetime Of The Product"
            suffex="M"
            :min="5"
            :max="7"
            :step="0.001"
            :vstart="5.465"
            :vend="6.789"
          ></range-select>
          <range-select
            name="Monthly Pageviews"
            suffex="M"
            :min="5"
            :max="7"
            :step="0.001"
            :vstart="5.465"
            :vend="6.789"
          ></range-select>
          <range-select
            name="Monthly Profit"
            suffex="M"
            :min="5"
            :max="7"
            :step="0.001"
            :vstart="5.465"
            :vend="6.789"
          ></range-select>
        </div>
        <div class="main col-12 col-md-8 col-lg-9 ">
          <div class="categories">
            <category-list
              class="mb-2"
              link="productsByCategory"
              :cat="category"
            />
          </div>
          <div class="row" v-if="productByCategoryId.length > 0">
            <div
              class="col-12 col-md-6 col-lg-4 px-0 mb-4"
              v-for="p in productByCategoryId"
              :key="p.id"
             >
              <product :id="p.id"></product>
            </div>
          </div>
          <div class="row" v-else>
            <h4 class="mt-5">Sorry No Products Here..<svg class="mx-2" width="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M168 376C168 362.7 178.7 352 192 352H320C333.3 352 344 362.7 344 376C344 389.3 333.3 400 320 400H192C178.7 400 168 389.3 168 376zM80 224C80 179.8 115.8 144 160 144C204.2 144 240 179.8 240 224C240 268.2 204.2 304 160 304C115.8 304 80 268.2 80 224zM160 272C186.5 272 208 250.5 208 224C208 209.7 201.7 196.8 191.8 188C191.9 189.3 192 190.6 192 192C192 209.7 177.7 224 160 224C142.3 224 128 209.7 128 192C128 190.6 128.1 189.3 128.2 188C118.3 196.8 112 209.7 112 224C112 250.5 133.5 272 160 272V272zM272 224C272 179.8 307.8 144 352 144C396.2 144 432 179.8 432 224C432 268.2 396.2 304 352 304C307.8 304 272 268.2 272 224zM352 272C378.5 272 400 250.5 400 224C400 209.7 393.7 196.8 383.8 188C383.9 189.3 384 190.6 384 192C384 209.7 369.7 224 352 224C334.3 224 320 209.7 320 192C320 190.6 320.1 189.3 320.2 188C310.3 196.8 304 209.7 304 224C304 250.5 325.5 272 352 272zM0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464z" fill="grey"/></svg></h4>
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

export default {
  components: { Product },
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
      // minPrice: 100,
      // maxPrice: 2000,
      // minLifeTime:5,
      // maxLifeTime:7,
    }
  },
  methods: {
   searchproducts(text) {
      this.textSearch = text;
    }, 
  },

  computed: {
     ...mapGetters("product", ["products","Allproducts"]),
    productByCategoryId() {
     let Alldata = Object.values(JSON.parse(JSON.stringify(this.Allproducts)))
      let Searchproducts = []
      for (let i = 0; i < Alldata.length; i++){
        if (Alldata[i].name.toLowerCase().includes(this.textSearch.toLowerCase())) {
          Searchproducts.push(Alldata[i]);
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

section {
  div.container-fluid {
    padding: 0 8%;
  }
  
}
h4{
  color: grey;
}
</style>
