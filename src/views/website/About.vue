<template>
  <div class="about">
    <div class="container">
      <div class="row">
        <h2 class="mb-3 mt-5">{{ __("header.nologin.about") }}</h2>
      </div>
      <div class="container">
        <p class="text-gray lead">{{ about }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["about"],
};
</script>

<style lang="scss" scoped>
.lead{
  @media (max-width: 1410px) {
        font-size: 18px;
        margin-bottom: 150px!important;
    }
}
</style>
