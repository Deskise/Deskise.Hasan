<template>
  <div class="action">
    <div class="container-fluid">
      <div class="row">
        <h2 class="mb-3">{{ __("header.nologin.mech") }}</h2>
      </div>
      <div class="container-fluid packages-container">
        <p class="text-gray lead mb-4">{{ __("mech.text") }}</p>
        <swiper :slidesPerView="5" :spaceBetween="15" class="packages">
          <swiper-slide v-for="pack in packages" :key="pack.id">
            <action-slide :pack="pack"></action-slide>
          </swiper-slide>
        </swiper>
      </div>
    </div>
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import { mapState } from "vuex";
import ActionSlide from "@/components/action/ActionSlide";
export default {
  components: {
    Swiper,
    SwiperSlide,
    ActionSlide,
  },
  computed: {
    ...mapState("data", ["packages"]),
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
.packages-container {
  width: 75%;

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
</style>
