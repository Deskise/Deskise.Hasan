<template>
  <section class="d-flex">
    <div class="container">
      <h2 class="mb-3 mt-4">What Is Deskise?</h2>
      <div class="row">
        <div class="col-md-6 col-lg mb-4">
          <div class="icon">
            <flat-icon-component icon="diamond"></flat-icon-component>
          </div>
          <h4 class="mb-1">Offer <span>the best sales</span></h4>
          <p class="details mb-0">
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
            nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
          </p>
          <router-link :to="{ name: 'about' }" class="read">
            read more
            <flat-icon-component
              icon="arrow-right"
              style="position: relative; top: 5px"
            ></flat-icon-component>
          </router-link>
        </div>
        <div class="col-md-6 col-lg mb-4">
          <div class="icon">
            <flat-icon-component icon="shield-check"></flat-icon-component>
          </div>
          <h4 class="mb-1">Protection <span>of buyers and sellers</span></h4>
          <p class="details mb-0">
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
            nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
          </p>
          <router-link :to="{ name: 'about' }" class="read">
            read more
            <flat-icon-component
              icon="arrow-right"
              style="position: relative; top: 5px"
            ></flat-icon-component>
          </router-link>
        </div>
        <div class="col-md-6 col-lg mb-4">
          <div class="icon">
            <flat-icon-component icon="sticker"></flat-icon-component>
          </div>
          <h4 class="mb-1">Providing <span>secure payment methods</span></h4>
          <p class="details mb-0">
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
            nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
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
export default {};
</script>

<style lang="scss" scoped>
section {
  width: 67vh;
  background: inherit;
  padding: 70px 0;
  justify-content: center;
  align-items: center;
  width: 100%;
  @media (max-width: 1410px) {
    padding: 90px 0;
  }
  h2 {
    color: #040506;
    font-size: 60px;
    @media (max-width: 1410px) {
      font-size: 40px;
      margin-bottom: 10px;
    }
    @media (max-width: 760px) {
      font-size: 35px;
    }
  }

  .row .col-lg {
    text-align: left;
    @media (max-width: 760px) {
      text-align: center;
    }
    .icon {
      color: #3eadb7;
      font-size: 24px;
    }

    h4 {
      font-size: 28px;
      font-weight: bold;
      color: #040506;
      text-transform: uppercase;
      @media (max-width: 1410px) {
        font-size: 23px;
      }
      span {
        display: block;
        font-weight: 400;
      }
    }

    p {
      font-size: 24px;
      color: #9d9d9d;
      text-transform: uppercase;
      padding-right: 15%;
      @media (max-width: 1410px) {
        font-size: 17px;
      }
      @media (max-width: 776px) {
        & {
          padding-right: 0;
        }
      }
    }

    a {
      text-transform: capitalize;
      color: #3eadb7;
      text-decoration: none;
      font-size: 24px;
      @media (max-width: 1410px) {
        font-size: 19px;
      }
    }
  }
}
</style>
