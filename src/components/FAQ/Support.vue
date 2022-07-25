<template>
  <div class="support container my-2">
    <div class="row justify-content-center align-items-center pb-5 pt-2">
      <div class="bg col-12 bg-gray-e"></div>
      <div class="image col-12 col-md-4">
        <img src="@/assets/support.png" alt="support" />
      </div>
      <div class="content  col-12 col-md-4">
        <p>
          {{ __("websiteName") }}<br />
          {{ __("faqs.support") }}
        </p>
      </div>
      <div class=" col-12 col-md-4 button">
        <a :href="`mailto:${email}`" class="btn btn-primary">Communication</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    email() {
      return process.env.VUE_APP_SUPPORT_EMAIL;
    },
  },
};
</script>

<style lang="scss" scoped>
.support {
  text-align: left;
  position: relative;
  .col {
    display: flex;
    align-items: center;
    justify-content: center;
    max-height: 50%;
  }
  .bg {
    position: absolute;
    width: 100%;
    height: 50%;
    z-index: -1;
     @media (max-width: 576px) {
     height: 100%;
   
    }
  }
  .content p {
    font-size: 28px;
    font-weight: bold;
    color: #4e4e4e;
    @media (max-width: 1410px) {
    font-size:18px;
    }
    &::first-line {
      color: #3eadb7;
    }
  }
  img{
    @media (max-width: 1410px) {
    width: 70%;
    }
    @media (max-width: 576px) {
    width: 50%;
    margin: auto;
    display: block;
    }
  }
  .button a {
    padding: 15px 50px;
    font-weight: bold;
    font-size: 20px;
     @media (max-width: 1410px) {
    font-size:18px;
    padding: 10px 30px;
    }
     @media (max-width: 576px) {
    width: 100%;
   
    }
  }
}
</style>
