<template>
  <div class="dash-profile-header" :style="`background-image: url(${img})`">
    <div class="dash-update-profile">
      <div class="dash-update-profile-content">
        <p>Replae Banner Image Optimal Dimensions 3200/410 Px</p>
        <button class="dash-btn replace-image-btn"
        @click="() => $el.querySelector('input[type=file]').click()"
        >Replace Image</button>
        <input type="file" @change="uploadImage" hidden />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    async uploadImage(e) {
      const file = e.target.files[0]
      console.log('logging the const file: ', file);
      this.$store.state.user.data.banner = (URL.createObjectURL(file))
      const userId = this.$store.state.user.data.id
      console.log(userId);
      const formData = new FormData()
      formData.append('banner', file)
      formData.append('user_id', userId)
      await this.$store.dispatch('user/updateBanner', formData)
    }
  },
  computed: {
    img() {
      return this.$store.state.user.otherUser.banner;
    },
  },
};
</script>

<style lang="scss" scoped>
.dash-profile-header {
  max-width: 100%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  height: 316px;
  margin-bottom: 20px;
  margin-top: 90px;
  box-shadow: 2px 2px 6px #ccc;
  @media (max-width: 1400px) {
    height: 250px;
  }
  .dash-update-profile {
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    display: none;

    .dash-update-profile-content {
      max-width: 450px;
      display: flex;
      flex-direction: column;
      align-items: center;

      p {
        color: #fff;
        text-align: center;
        margin-bottom: 15px;
        font-weight: bold;
        font-size: 20px;
        @media (max-width: 1400px) {
          font-size: 16px;
        }
      }

      .dash-btn.replace-image-btn {
        background-color: #3eadb7;
        color: #fff;
        @media (max-width: 1400px) {
          padding: 10px 40px;
          font-size: 14px;
        }
      }
    }
  }
  &:hover .dash-update-profile {
    display: flex;
  }
}
</style>
