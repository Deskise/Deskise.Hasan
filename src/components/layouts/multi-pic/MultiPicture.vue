<template>
  <div class="new-image">
    <flat-icon-component
      icon="cross-small"
      type="bold"
      class="close-content pt-1"
      @click="remove"
    />
    <div class="image">
      <img :src="image" :alt="'user_uploaded_picture#' + id" />
    </div>
  </div>
</template>

<script>
export default {
  name: "multi-picture",
  props: {
    image: {
      type: String,
      required: true,
    },
    id: Number,
  },
  methods: {
    remove() {
      this.$emit("remove", this.id);
    },
  },
};
</script>

<style scoped></style>
