<template>
  <div class="upload-images">
    <div
      class="add-new-image"
      @click="() => $el.querySelector('input[type=file]').click()"
    >
      <flat-icon-component :style="{ color: 'gray' }" icon="plus" type="bold" />
      <input type="file" @change="uploadImage" hidden multiple />
    </div>
    <multi-picture
      v-for="(image, i) in images"
      :key="i"
      :image="image"
      :id="i"
      @remove="removeImages"
    />
  </div>
</template>

<script>
import MultiPicture from "@/components/layouts/multi-pic/MultiPicture";
export default {
  name: "MultiImgPicker",
  components: { MultiPicture },
  data() {
    return {
      images: [],
      files: [],
    };
  },
  methods: {
    uploadImage(e) {
      Array.from(e.target.files).forEach((file) => {
        this.images.push(URL.createObjectURL(file));
        this.files.push(file);
      });
      this.$emit("change", this.files);
    },
    removeImages(e) {
      this.images.splice(e, 1);
      this.files.splice(e, 1);
      this.$emit("change", this.files);
    },
  },
};
</script>

<style scoped></style>
