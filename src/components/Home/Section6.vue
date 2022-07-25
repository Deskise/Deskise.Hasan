<template>
  <section class="action">
    <div class="container-fluid">
      <div class="row">
        <h2 class="mb-4 mt-5">{{ __("header.nologin.mech") }}</h2>
      </div>
      <div class="container packages-container">
        <swiper :slidesPerView="slides" :spaceBetween="10" class="packages">
          <swiper-slide v-for="pack in packages" :key="pack.id">
            <action-slide :pack="pack"></action-slide>
          </swiper-slide>
        </swiper>
      </div>
    </div>
  </section>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import { mapState } from "vuex";
import ActionSlide from "@/components/action/ActionSlide";
export default {
  async mounted() {
    this.$nextTick(function () {
      this.getSlides();
      window.addEventListener("resize", () => this.getSlides());
    });
    if (this.packages.length === 0) await this.$store.dispatch("data/packages");
  },
  data() {
    return {
      slides: 5,
    };
  },
  components: {
    Swiper,
    SwiperSlide,
    ActionSlide,
  },
  computed: {
    ...mapState("data", ["packages"]),
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

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
section {
  margin-bottom: 70px;
  h2 {
    font-size: 60px;
    text-transform: capitalize;
    @media (max-width: 1400px) {
      & {
        font-size: 40px;
        margin-bottom: 40px!important;
      }
    }
    @media (max-width: 776px) {
      & {
        font-size: 35px;
      }
    }
  }

  .packages-container {
    width: 75%;
    @media (max-width: 1400px) {
      & {
        width: 100%;
      }
    }
    & > p {
      font-size: 24px;
      width: 100%;
      max-width: 478px;
      word-break: break-word;
      margin: auto;
      text-transform: capitalize;
      
    }
    .packages {
      width: 100%;
      height: 100%;
      align-content: center;
      .swiper-slide {
        text-align: center;
        font-size: 20px !important;
        background: #fff;
        height: unset !important;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
      }
    }
  }
}
</style>
