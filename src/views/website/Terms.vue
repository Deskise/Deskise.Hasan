<template>
  <div class="termsOfUse">
    <div class="container">
      <div class="row">
        <h2 class="mb-3">{{ __("header.nologin." + name) }}</h2>
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

<style lang="scss" scoped></style>
