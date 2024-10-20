<template>
  <section class="stuff" :style="{ backgroundImage: `url(${getImage})` }">
    <div class="container">
      <div class="row data">
        <div class="col-md-6 my-5 py-xl-5 py-lg-3">
          <h3>Request A Product</h3>
          <p>
            Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam
            Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam
            Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores
            Et Ea Rebum. Stet Clita Kasd Gubergren, No Sea Takimata Sanctus Est
            Lorem Ipsum Dolor Sit Amet. Lorem Ipsum
          </p>
          <router-link :to="{ name: 'requestProduct' }">
            <button class="btn btn-outline-secondary">Requist Product</button>
          </router-link>
        </div>

        <div class="col-md">
          <span
            class="img-span"
            :style="{
              backgroundImage: `url(${getImage})`,
              backgroundPosition: 'center',
            }"
          ></span>
          <img src="@/assets/woman1.png" alt="Woman" class="img1" />
        </div>
      </div>
      <div class="row data">
        <div class="col-md-6 d-flex">
          <img src="@/assets/man2.png" alt="man" class="img2" />
        </div>
        <div class="col-md-6 my-5 py-xl-5 py-lg-3">
          <span></span>
          <h3>About Us& Staff</h3>
          <p>
            <!-- {{ about }} -->
            Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam
            Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam
            Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores
            Et Ea Rebum. Stet Clita Kasd Gubergren, No Sea Takimata Sanctus Est
            Lorem Ipsum Dolor Sit Amet. Lorem Ipsum
          </p>
          <router-link :to="{ name: 'about' }" class="read">
            read more
            <flat-icon-component
              icon="arrow-right"
              style="position: relative; top: 5px"
            ></flat-icon-component>
          </router-link>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  async mounted() {
    if (this.$store.state.data.about.home === null) {
      await this.$store.dispatch("data/about", "home").then((data) => {
        this.about = data;
      });
    } else {
      this.about = this.$store.state.data.about.home;
    }
  },
  data() {
    return {
      about: "",
    };
  },
  computed: {
    getImage() {
      let image = require("@/assets/waves.png");
      return image;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
section {
  background: $light-gray;
  margin-bottom: 70px;
  background-size: cover;
  background-position: 0 70vh;
  background-repeat: no-repeat;

  .data {
    justify-content: center;
    text-align: left;
    position: relative;
    align-items: center;
    z-index: 1;
    @media (max-width: 576px) {
      & {
        text-align: center;
      }
      span,
      img {
        z-index: -1;
        opacity: 0.3;
      }
    }

    span {
      background: #c9c9c955;
      height: 100%;
      width: 24%;
      position: absolute;
      top: 0;
      z-index: -1;
      &:not(.img-span) {
        left: 49%;
      }
      &.img-span {
        left: 65%;
      }
    }
    img {
      width: 69%;
      position: absolute;
      @media (max-width: 1400px) {
        & {
          width: 55%;
        }
      }
      @media (max-width: 992px) {
        & {
          width: 77%;
        }
      }
      &.img1 {
        bottom: -16px;
        @media (max-width: 1200px) {
          & {
            bottom: -11px;
          }
        }
        left: 37%;
      }
      &.img2 {
        bottom: 0;
        left: -23%;
        max-height: 120%;
        @media (max-width: 1400px) {
          & {
            left: -15%;
            width: 50%;
          }
        }
        @media (max-width: 992px) {
          & {
            width: 60%;
            left: -15%;
            max-height: 120%;
          }
        }
      }
    }
    h3 {
      color: $dark;
      font-size: 60px;
      font-weight: bold;
      text-transform: uppercase;
      margin-bottom: 20px;
      @media (max-width: 1400px) {
        & {
          font-size: 40px;
        }
      }
      @media (max-width: 992px) {
        & {
          margin-bottom: 10px;
          font-size: 31px;
        }
      }
    }
    p {
      font-size: 28px;
      color: $gray;
      width: 82%;
      margin-bottom: 30px;
      @media (max-width: 1400px) {
        & {
          width: 75%;
          font-size: 18px;
          margin-bottom: 20px;
        }
      }
      @media (max-width: 992px) {
        & {
          margin-bottom: 15px;
          font-size: 17px;
          width: 95%;
        }
      }
    }
    a {
      text-transform: capitalize;
      color: #3eadb7;
      text-decoration: none;
      font-size: 24px;
      @media (max-width: 1400px) {
        & {
          font-size: 20px;
        }
      }
      @media (max-width: 992px) {
        & {
          font-size: 17px;
        }
      }

      button {
        height: 50px;
        width: 40%;
        @media (max-width: 1400px) {
          width: 37%;
          height: 40px;
          font-size: 15px;
        }
        @media (max-width: 992px) {
          & {
            width: 50%;
            height: 45px;
          }
        }
      }
    }
  }
}
</style>
