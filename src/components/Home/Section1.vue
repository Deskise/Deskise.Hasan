<template>
  <section class="section1 d-flex">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 row">
          <h1 class="p-lg-0">Lorem ipsum</h1>
          <p class="lead p-lg-0">
            Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam
            Nonumy Eirmod
          </p>
          <div class="input-group col-12 p-lg-0 relative mb-3">
            <input
              type="search"
              placeholder="Search"
              class="form-control pe-5"
            />
            <flat-icon-component
              icon="search"
              class="input-group-text border-0"
              style="
                position: absolute;
                height: 100%;
                width: 60px;
                right: 2px;
                justify-content: center;
                align-items: center;
                display: flex;
                color: #9d9d9d;
                z-index: 10;
                background: transparent;
                color: #c9c9c9;
                font-size: 24px;
              "
            />
          </div>
          <div class="btns col-12 p-lg-0 w-100 d-flex">
            <a href="" class="btn btn-outline-secondary">Buy</a>
            <a href="" class="btn btn-outline-secondary">Sell</a>
          </div>
        </div>
      </div>
    </div>
    <man-img></man-img>
  </section>
</template>

<script>
import ManImg from "@/components/template/manImg.vue";
export default {
  components: {
    ManImg,
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
.section1 {
  min-height: 89vh;
  text-align: left;
  @media (max-width: 760px) {
    & {
      text-align: inherit;
    }
  }
  align-items: center;
  .container {
    @media (min-width: 1200px) {
      & {
        transform: translateY(-14vh);
      }
    }
    h1 {
      text-transform: uppercase;
      font-size: 60px;
      font-weight: bold;
      color: $dark;
    }

    p {
      font-size: 28px;
      color: $gray;
    }

    .input-group {
      input {
        height: 50px;
      }
    }

    .btns {
      justify-content: space-between;
      a.btn {
        width: 49%;
        height: 50px;
        text-transform: capitalize;
        display: flex;
        justify-content: center;
        align-items: center;
      }
    }
  }
}
</style>
