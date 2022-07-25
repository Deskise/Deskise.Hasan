<template>
  <div class="col d-sm-block">
    <img src="@/assets/bg1.png" alt="bg1" class="bg1"/>
    <img src="@/assets/bg2.png" alt="bg2" class="bg2"/>
  </div>
</template>
  
<script>
export default {};
</script>
<style>
.bg1{
  z-index: 5!important;
}
.bg2{
  animation: mover 1.5s linear infinite alternate;
}
@keyframes mover {
  0%{
    transform: translateX(0px);
  }
  100%{
    transform: translateX(10px);
  }
}
</style>
<style lang="scss" scoped>
div {
  position: absolute;
  width: 100%;
  top: -11vh;
  height: 100vh !important;
  z-index: -1;
  img {
    position: absolute;
    top: 31%;
    right: 20vw;
    height: 75%;
    @media (max-width: 1500px) {
      & {
        right: 16vw;
         
      }
    }
    @media (max-width: 1200px) {
      & {
        right: 8vw;
        height: 40%;
      }
    }
    @media (max-width: 992px) {
       height: 33%;
       opacity: .5;
    }
    @media (max-width: 576px) {
      & {
       height: 26%;
      }
    }

    &:first-of-type {
      height: 95%;
      z-index: -1!important;
      @media (max-width: 1200px) {
          height: 85%;
      }
      @media (max-width: 992px) {
       height: 70%;
    }
      @media (max-width: 576px) {
       height:60%;
    }
      top: 0;
    }
  }
  
}
</style>
