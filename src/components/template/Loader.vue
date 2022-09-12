<template>
  <div
    class="loader w-100 h-100 d-flex justify-content-center align-items-center"
  >
    <div>
      <loadMore class="mb-2 mt-5" />
      <h3>Loading <span>.</span><span>.</span><span>.</span></h3>
    </div>
  </div>
</template>
<script>
export default {};
</script>

<style lang="scss" scoped>
.loader {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 999999;
  background-color: white;
  color: #3eadb7;
}
.loader span {
  font-size: 72px;
  margin-right: 5px;
  animation: loader 0.5s linear infinite alternate;
}
.loader span:nth-of-type(1) {
  animation-delay: 0.5s;
}
.loader span:nth-of-type(2) {
  animation-delay: 0.8s;
}
.loader span:nth-of-type(3) {
  animation-delay: 1s;
}
@keyframes loader {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
</style>
