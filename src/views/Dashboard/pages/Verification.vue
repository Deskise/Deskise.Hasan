<template>
  <div id="Verification" class="content">
    <form class="mt-4 mt-lg-2" @submit.prevent="submit()">
      <verify-inputs
        text="Email"
        :data="user.email"
        :condition="user.email_verified_at === null"
      ></verify-inputs>
      <verify-inputs
        text="Backup Email"
        :data="user.backup_email"
        :condition="user.backup_email_verified_at === null"
      ></verify-inputs>
      <verify-inputs
        text="Phone"
        :data="user.phone"
        :condition="user.phone_verified_at === null"
      ></verify-inputs>
      <verify-inputs
        text="Backup Phone"
        :data="user.backup_phone"
        :condition="user.backup_phone_verified_at === null"
      ></verify-inputs>

      <div class="add-img replace-img mb-4 row px-3">
        <label class="col-12">Id Verification </label>

        <div
          class="profile-pic img-replace-square me-3 mb-3col-6 col-md-4 col-lg-3"
          v-if="user.id_verified_at === null"
        >
          <label class="-label" for="file2">
            <span class="glyphicon glyphicon-camera"></span>
          </label>

          <input id="file2" type="file" />

          <button class="btn add-img-plus bg-transparent" type="button">
            <flat-icon-component icon="plus" type="b"></flat-icon-component>
          </button>
        </div>

        <div
          class="profile-pic img-replace-square me-3 mb-3 p-2 col-6 col-md-4 col-lg-3"
        >
          <img src="@/assets/Path56647.png" style="width: 100%; height: 100%" />
        </div>

        <circle-checkbox
          :value="true"
          :isReadonly="true"
          :text="`ID Verified`"
          v-if="!user.id_verified_at === null"
        ></circle-checkbox>
      </div>
      <div class="col-lg-5 m-auto text-center p-1">
        <div class="form-group">
          <button
            type="submit"
            class="btn w-100 btn-primary mt-2"
            value="Send"
            name="submit"
          >
            SAVE
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import VerifyInputs from "../../../components/Dashboard/verifyInputs.vue";
export default {
  components: { VerifyInputs },
  data() {
    return {
      user: this.$store.state.user.data,
    };
  },
  methods: {
    submit() {
      //TODO: CONNECT WITH THE BACKEND
      return true;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables";
.add-img {
  @mixin object-center {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  $circleSize: 120px;
  $radius: 10px;
  $shadow: 0 0 10px 0 rgba(255, 255, 255, 0.35);
  $fontColor: rgb(250, 250, 250);

  .profile-pic {
    color: transparent;
    transition: all 0.3s ease;
    background-color: $gray-50;
    @include object-center;
    position: relative;
    transition: all 0.3s ease;
    border-radius: $radius;
    height: $circleSize;
    width: $circleSize;
    @media (min-width: $minLarge) {
      height: 150px;
      width: 150px;
    }
    input {
      display: none;
    }

    button.add-img-plus {
      display: contents;
      font-size: 22px;
      color: $gray;
    }
    &.img-replace-square {
      button.add-img-plus {
        display: contents;
        font-size: 22px;
        color: $gray;
        display: flex;
        position: absolute;
        z-index: 10;
      }
    }
  }
}
</style>
