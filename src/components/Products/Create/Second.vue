<template>
  <div>
    <div class="main-title">welcome in Deskise</div>
    <p class="hint">Is The License For Life!</p>

    <yn-select placeholder="Is The License For Life!"></yn-select>
  </div>
</template>

<script>
export default {
  data() {
    return {
      category: 0,
    };
  },
  computed: {},
};
</script>

<style lang="scss" scoped>
.main-title {
  font-size: 40px;
  color: #040506;
  font-weight: bold;
  margin-bottom: 10px;
  text-transform: uppercase;
  @media (max-width: 500px) {
    font-size: 35px;
  }
}
.hint {
  font-size: 28px;
  color: #9d9d9d;
  margin-bottom: 10px;
  @media (max-width: 500px) {
    font-size: 20px;
  }
}
</style>
