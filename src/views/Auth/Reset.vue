<template>
  <div class="login d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8 col-xl-5">
          <h1 class="mb-2 text-left">Reset Password</h1>
          <div class="row">
            <div class="input-group mx-0 mb-2">
              <input
                type="text"
                class="form-control col-12 py-1"
                placeholder="Reset Token"
                v-model="form.hash"
                id="hash"
                :readonly="form.hash !== ''"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>
            <div class="input-group mx-0 mb-2">
              <input
                type="password"
                class="form-control col-12 py-1"
                placeholder="Password"
                v-model="form.password"
                id="password"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>

            <div class="input-group mx-0 mb-3">
              <input
                type="password"
                class="form-control col-12 py-3"
                placeholder="Confirm Password"
                v-model="form.confirmPassword"
                id="re_password"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>

            <div class="input-group mx-0 mb-3">
              <button
                class="btn btn-primary form-control col-12 py-1"
                @click="check"
              >
                Reset Password
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <manimg></manimg>
  </div>
</template>

<script>
import manimg from "@/components/template/manImg.vue";
import { required, same } from "../../Mixins/Validations";
import ForgotService from "@/config/Services/Auth/ForgotService";
import Notification from "../../config/Notification";
export default {
  data() {
    return {
      form: {
        hash: this.$route.query.hash ?? "",
        password: "",
        confirmPassword: "",
      },
      isError: false,
    };
  },
  components: { manimg },
  mixins: [],
  methods: {
    async check() {
      this.isError = false;
      let inv = document.querySelectorAll(".invalid");
      if (inv) inv.forEach((el) => el.classList.remove("invalid"));

      if (!required(this.form.hash)) {
        document.querySelector("#hash").classList.add("invalid");
        this.isError = true;
      }
      if (!required(this.form.password)) {
        document.querySelector("#password").classList.add("invalid");
        this.isError = true;
      }
      if (
        !required(this.form.confirmPassword) ||
        !same(this.form.password, this.form.confirmPassword)
      ) {
        document.querySelector("#re_password").classList.add("invalid");
        this.isError = true;
      }

      if (this.isError) return;
      await ForgotService.resend(
        this.form.hash,
        this.form.password,
        this.form.confirmPassword
      ).then(
        ({ data }) => {
          Notification.addNotification(data.response.message, true);
          this.$router.push({
            name: "login",
            query: { email: this.$route.query.email },
          });
        },
        (err) => Notification.addNotification(err.message, false)
      );
    },
  },
};
</script>

<style lang="scss" scoped>
.login {
  min-height: calc(85vh - 70px);
  h1 {
    text-transform: uppercase;
    font-family: Barlow;
    font-weight: bold;
  }
  input,
  button {
    height: 45px;
    @media (max-width: 1410px) {
      height: 45px;
    }
    @media (max-width: 576px) {
      font-size: 14px;
    }
  }

  .invalid {
    &:not(label) {
      border: 1px solid red;
    }
    color: red;
    &::placeholder {
      color: red;
    }
  }
}
</style>
