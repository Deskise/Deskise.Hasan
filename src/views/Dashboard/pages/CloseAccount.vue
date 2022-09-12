<template>
  <div id="Close-Account" class="content">
    <h5 class="font-weight-normal">Close Account</h5>
    <p class="mb-4">
      Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy
      Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed Diam
      Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et Ea Rebum. Stet
      Clita Kasd Gubergren, No Sea Takimata Sanctus Est Lorem Ipsum Dolor Sit
      Amet. Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam
      Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed
      Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et Ea Rebum.
      Stet Clita Kasd Gubergren, No Sea Takimata Sanctus Est Lorem Ipsum Dolor
      Sit Amet. Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed
      Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam
      Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et Ea
      Rebum. Stet Clita Kasd Gubergren, No Sea Takimata Sanctus Est Lorem Ipsum
      Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
      Sed Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam
      Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et Ea
      Rebum. Stet Clita Kasd Gubergren, No Sea Takimata Sanctus Est Lorem Ipsum
      Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
      Sed Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam
      Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et Ea
      Rebum. Stet Clita Kasd Gubergren, No Sea Takimata Sanctus Est Lorem Ipsum
      Dolor Sit Amet. Lorem Ipsum Dolor Sit
    </p>
    <form action="">
      <div class="manage">
        <circle-checkbox
          text="Agree to the terms of the site"
          id="terms"
          @check="(e) => (acceptTerms = e)"
        ></circle-checkbox>
      </div>

      <div class="form-group text-center">
        <div class="col-lg-5 m-auto input-btn buttons-close">
          <button
            type="button"
            class="btn btn-outline w-100 btn-modal mt-2"
            data-bs-toggle="modal"
            data-bs-target="#close-accounts"
          >
            Close Account
          </button>
        </div>
      </div>
    </form>
  </div>
  <Confirm
    id="close-accounts"
    title="Close Account"
    desc="Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod Tempor Invidunt Ut"
    submit="Close Account"
    close="Back"
    submitClass="btn-danger"
    closeClass="btn-primary"
    @submit="submit()"
  ></Confirm>
</template>

<script>
import { required } from "@/Mixins/Validations";
import Notification from "@/config/Notification";
import Dashboard from "@/config/Services/Dashboard";

export default {
  data() {
    return {
      acceptTerms: false,
    };
  },
  watch: {
    acceptTerms() {
      document.querySelector("#terms").classList.remove("invalid");
    },
  },
  methods: {
    async submit() {
      if (!required(this.acceptTerms)) {
        document.querySelector("#terms").classList.add("invalid");
        return;
      }

      await Dashboard.close().then(({ data }) => {
        Notification.addNotification(data.response.message, true);
        this.$store.dispatch("user/logout");
      });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables";
.buttons-close {
  button {
    background-color: #fb5b5b;
    color: white;
    font-size: 15px;

    &:hover {
      background-color: $secondary;
    }
  }
}
h5 {
  font-size: 17px;
}
p {
  font-size: 14px;
  letter-spacing: 1px;
  color: grey;
}
.manage {
  font-size: 14px;
  margin-bottom: 20px;
}
</style>
