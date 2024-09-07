<template>
  <section>
    <div class="container">
      <div class="row">
        <h2 class="mt-5">Trusted Clients</h2>
        <div class="container-fluid">
          <swiper
            :slidesPerView="1"
            :spaceBetween="10"
            :navigation="{ nextEl: '#next', prevEl: '#prev' }"
            class="comments"
          >
            <swiper-slide
              class="bg-gray-e"
              :style="{ backgroundImage: `url(${getImage})` }"
              v-for="(comment, index) in comments"
              :key="index"
            >
              <comment :comment="comment"></comment>
            </swiper-slide>
          </swiper>

          <button id="next" class="btn btn-outline-primary">
            <flat-icon-component icon="angle-right"></flat-icon-component>
          </button>
          <button id="prev" class="btn btn-outline-primary">
            <flat-icon-component icon="angle-left"></flat-icon-component>
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import SwiperCore, { Navigation } from "swiper";
import { mapState } from "vuex";
import Comment from "./Comment.vue";
SwiperCore.use([Navigation]);

export default {
  async mounted() {
    if (this.comments.length === 0) await this.$store.dispatch("data/comments");
  },
  components: {
    Swiper,
    SwiperSlide,
    Comment,
  },
  data() {
    return {};
  },
  computed: {
    getImage() {
      let image = require("@/assets/waves.png");
      return image;
    },
    ...mapState("data", ["comments"]),
  },
};
</script>

<style lang="scss" scoped>
section {
  margin: 70px 0;
  min-height: 33vh;
  justify-content: center;
  align-items: center;
  margin-bottom: 150px;
  h2 {
    font-size: 60px;
    @media (max-width: 1400px) {
      font-size: 40px;
      margin-bottom: 20px;
    }
    @media (max-width: 760px) {
      font-size: 40px;
    }
    margin-bottom: 50px;
  }

  .container-fluid {
    position: relative;
    .comments {
      width: 100%;
      height: 100%;
      min-height: 160px;
      align-content: center;
      border-radius: 10px;
      border: 1px solid #eee;
      .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        background-position: 0;
        background-size: 120% 320%;
        z-index: 1;
        padding: 10px 150px;
        @media (max-width: 1200px) {
          & {
            padding: 30px 50px;
          }
        }
        @media (max-width: 500px) {
          & {
            padding: 20px 35px;
          }
        }
      }
    }

    #next,
    #prev {
      position: absolute;
      top: calc(50% - 25px);
      width: 50px;
      height: 50px;
      border-radius: 50%;
      z-index: 10;
    }
    #next {
      right: -10%;
      z-index: -1;
      @media (max-width: 1600px) {
        & {
          right: -5%;
        }
      }
      @media (max-width: 1480px) {
        & {
          right: 2.5%;
        }
      }
      @media (max-width: 992px) {
        & {
          right: 5%;
        }
      }
    }
    #prev {
      left: -10%;
      z-index: -1;
      @media (max-width: 1600px) {
        & {
          left: -5%;
        }
      }
      @media (max-width: 1480px) {
        & {
          left: 2.5%;
        }
      }
      @media (max-width: 992px) {
        & {
          left: 5%;
        }
      }
    }
  }
}
</style>
