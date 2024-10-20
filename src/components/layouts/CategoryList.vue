<template>
  <div class="categories mt-4">
    
    <div
      :class="{
        'category p-3 px-1 ': true,
        active: this.category === 0 && this.cat == 0,
      }"
      @click="doAction(0)"
    >
        <h4>All Categories</h4>
    </div>
    <div class="">
      <Swiper :slidesPerView="slides" :loop="true">
        <SwiperSlide v-for="(item, index) in categories" :key="index"  :class="{
          'category p-3 px-1': true,
          active: this.category === item.id || this.cat == item.id,
          }"
          @click="doAction(item.id)">
          <h4>{{ item.name }}</h4>
        </SwiperSlide>
      </Swiper>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { Swiper, SwiperSlide } from "swiper/vue";

export default {
  components: {
    Swiper,
    SwiperSlide,
  },
  props: {
    link: {
      type: String,
      default: "",
    },
    cat: {
      type: String,
      default: "0",
    },
  },
  computed: {
    ...mapGetters("category", ["categories"]),
  },
  data() {
    return {
      category: 0,
      slides: 9,
    };
  },
  methods: {
    doAction(id) {
      if (this.link !== "")
        return this.$router.push({ name: this.link, params: { id } });
      else {
        this.category = id;
        this.$emit("category", id);
      }
    },

    getSlides() {
      if (window.matchMedia("(max-width: 576px").matches) this.slides = 3;
      else if (window.matchMedia("(max-width: 768px").matches)
        this.slides = 4;
      else if (window.matchMedia("(max-width: 998px").matches)
        this.slides = 5;
      else if (window.matchMedia("(max-width: 1200px").matches)
        this.slides = 6;
      else if (window.matchMedia("(max-width: 1500px").matches) this.slides = 6;
      else this.slides = 6;
    },
  },

  mounted() {
    this.$nextTick(function () {
      this.getSlides();
      window.addEventListener("resize", () => this.getSlides());
    });
  }
};
</script>

<style lang="scss" scoped>
// .swiper-slide{
//  width: fit-content !important;
// }
.categories {
  // display: flex;
  // flex-direction: row;
  // align-items: center;
  // flex-wrap: wrap;
  .category {

  //   display: flex;
  // flex-direction: row;
  // align-items: center;
    border-radius: 5px;
    background: transparent;
    padding: 10px !important;
    margin: 5px;
    border: 1px solid #eee;
    color: #040506;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    &.active {
      background: #4e1b56;
      color: #fff;
    }
  }
}

h4 {
  font-size: 16px;
  text-transform: capitalize;
  width: 100%;
  margin-bottom: 0px;
  @media (max-width: 1410px) {
    font-size: 13px !important;
  }
}
</style>
