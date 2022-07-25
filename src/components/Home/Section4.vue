<template>
  <div class="products">
    <div class="container-fluid">
      <h1 class="mb-5">Best Products</h1>
      <div class="main">
         <swiper :modules="modules" :slidesPerView="slides" :pagination="pagination" :spaceBetween="10" class="packages">
          <swiper-slide v-for="(p, index) in products" :key="p.id" class="px-1 py-3">
            <product :id="index" best></product>
          </swiper-slide>
        </swiper>
      </div>
    </div>
  </div>
</template>

<script>
//TODO: Do This Component (Best Products In Home)
import Product from "@/components/Products/Product.vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import SwiperCore, { Pagination } from "swiper";
// Import Swiper styles
import "swiper/swiper.min.css";
SwiperCore.use([Pagination]);
export default {
  data() {
    return {
      slides: 5,
           pagination: {
        clickable: true,
      },
    }
  },
  components: {
    Product,
    Swiper,
    SwiperSlide,
  },
  async mounted() {
    await this.$store.dispatch("product/best");
    this.$nextTick(function () {
      this.getSlides();
      window.addEventListener("resize", () => this.getSlides());
    });
    if (this.packages.length === 0) await this.$store.dispatch("data/packages");
  },
  computed: {
    products() {
       return this.$store.state.product.best.data;
    },
  },
   methods: {
    getSlides() {
      if (window.matchMedia("(max-width: 576px").matches) this.slides = 1;
      else if (window.matchMedia("(max-width: 568px").matches)
        this.slides = 1;
      else if (window.matchMedia("(max-width: 768px").matches)
        this.slides = 2;
      else if (window.matchMedia("(max-width: 998px").matches)
        this.slides = 3;
      else if (window.matchMedia("(max-width: 1200px").matches)
        this.slides = 4;
      else if (window.matchMedia("(max-width: 1500px").matches) this.slides = 4;
      else this.slides = 5;
    },
  },
};
</script>
<style>
.swiper-container-horizontal>.swiper-pagination-bullets{
  bottom: 0px!important;
}
.swiper-pagination-bullet-active{
  width: 30px!important;
  border-radius: 10px!important;
  background-color: #3EADB7!important;
}
.swiper-wrapper{
  overflow: visible!important;
  padding-bottom: 30px!important;
}
</style>
<style lang="scss" scoped>

.swiper-slide{
  height: 560px;
}
.products {
  background: inherit;
  padding: 70px 0;
  justify-content: center;
  align-items: center;
  width: 100%;
   @media (max-width: 1410px) {
        padding-top: 0px;
    }
  .container-fluid {
    padding: 5%;
  }
  h1 {
    color: #040506;
    font-size: 60px;
     @media (max-width: 1410px) {
        font-size: 50px;
        margin-bottom: 30px!important;
    }
    @media (max-width: 760px) {
      font-size: 40px;
    }
  }
}
</style>
