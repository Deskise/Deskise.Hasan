<template>
  <div class="container comment">
    <div class="row">
      <div
        class="col-md-12 col-lg-2 d-flex justify-content-center align-items-center"
      >
        <img :src="comment.img" :alt="comment.name" />
      </div>
      <div class="col-md d-flex flex-column justify-content-around py-2">
        <div class="row">
          <h4>{{ comment.name }}</h4>
        </div>

        <div class="row">
          <p>{{ comment.comment }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    comment: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped>
.comment {
  text-align: left;
  @media (max-width: 992px) {
    & {
      text-align: center;
    }
  }
  color: #040506;
  text-transform: uppercase;

  img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    @media (max-width: 1400px) {
      width: 80px;
       height: 80px;
    }
  }
  h4 {
    font-weight: bold;
    margin-bottom: 2px;
    font-size: 24px;
    @media (max-width: 1400px) {
     margin-bottom: 10px;
     font-size: 20px;
    }
    @media (max-width: 760px) {
      font-size: 18px;
    }
  }

  p {
    font-size: 21px;
    margin-bottom: 0;
    @media (max-width: 1400px) {
      font-size: 17px;
      line-height: 25px;
    }
    @media (max-width: 760px) {
      font-size: 16px;
    }
    line-height: 30px;
  }
}
</style>
