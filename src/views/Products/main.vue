//TODO:Do the filters

<template>
  <section>
    <div class="container-fluid mb-5">
      <search></search>
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
          <div class="row">
            <div
              class="col-12 col-md-6 col-lg-4 px-0 mb-4"
              v-for="p in productByCategoryId"
              :key="p.id"
            >
              <product :id="p"></product>
            </div>
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
  computed: {
    ...mapGetters("product", ["products"]),
    productByCategoryId() {
      return this.products({ category: this.category });
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

</style>
