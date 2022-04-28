<template>
  <div class="cookies">
    <img src="@/assets/cookies.png" alt="cookies" class="mx-3" />
    <p class="mx-3 pt-2">
      Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy
      Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam
    </p>
    <button class="btn btn-dark mx-3 py-2 px-5">cancel</button>
    <button class="btn btn-primary py-2 px-5" @click="$emit('accept')">
      Agree
    </button>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.cookies {
  background: #eeeeee;
  position: fixed;
  bottom: 0;
  width: 100%;
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  z-index: 5;
  min-height: 100px;

  img {
    width: 10%;
  }

  p {
    font-size: 28px;
    color: #9d9d9d;
    width: 50%;
    height: 50px;
    overflow: hidden;
  }
}
</style>
