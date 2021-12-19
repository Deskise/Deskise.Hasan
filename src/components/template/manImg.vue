<template>
  <div class="col d-none d-lg-block">
    <img src="@/assets/bg1.png" alt="bg1" />
    <img src="@/assets/bg2.png" alt="bg2" />
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
div {
  position: absolute;
  width: 100%;
  top: -11vh;
  height: 100vh !important;
  z-index: -1;

  img {
    position: absolute;
    top: 21%;
    right: 20vw;
    height: 75%;
    @media (max-width: 1500px) {
      & {
        right: 10vw;
      }
    }
    @media (max-width: 1200px) {
      & {
        right: 8vw;
        height: 64%;
      }
    }

    &:first-of-type {
      height: 85%;
      @media (max-width: 1200px) {
        & {
          height: 75%;
        }
      }
      top: 0;
    }
  }
}
</style>
