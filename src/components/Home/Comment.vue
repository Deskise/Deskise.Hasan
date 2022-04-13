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
          <h3>{{ comment.name }}</h3>
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
  }
  h3 {
    font-weight: bold;
    margin-bottom: 2px;
    font-size: 24px;
  }

  p {
    font-size: 22px;
    line-height: 30px;
  }
}
</style>
