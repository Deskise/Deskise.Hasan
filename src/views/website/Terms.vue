<template>
  <div class="termsOfUse">
    <div class="container">
      <div class="row">
        <h2 class="mb-3 mt-5">{{ $t("header.nologin." + name) }}</h2>
      </div>
      <div class="container">
        <p class="text-gray lead">{{ term }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["term", "name"],
};
</script>

<style lang="scss" scoped>
.lead {
  @media (max-width: 1410px) {
    font-size: 18px;
    margin-bottom: 150px !important;
  }
}
</style>
