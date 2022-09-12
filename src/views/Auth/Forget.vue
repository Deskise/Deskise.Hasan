<template>
  <div class="login d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8 col-xl-5">
          <h1 class="mb-4 text-left">Forgot password!</h1>
          <div class="input-group mx-0">
            <input
              type="email"
              class="form-control col-12 mb-2 py-1"
              placeholder="E-MAIL"
              v-model="form.email"
              @keydown="$event.target.classList.remove('invalid')"
            />
          </div>
          <div class="input-group mx-0">
            <button
              class="btn btn-primary form-control col-12 mb-3 py-1"
              @click="check"
            >
              Send
            </button>
          </div>
        </div>
      </div>
    </div>
    <manimg></manimg>
  </div>
</template>

<script>
import manimg from "@/components/template/manImg.vue";
import { required, email } from "../../Mixins/Validations";
import ForgotService from "@/config/Services/Auth/ForgotService";
import Notification from "../../config/Notification";
export default {
  data() {
    return {
      form: {
        email: "",
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

      if (!required(this.form.email) || !email(this.form.email)) {
        document.querySelector("input[type=email]").classList.add("invalid");
        this.isError = true;
      }

      if (this.isError) return;

      await ForgotService.verify(this.form.email).then(
        ({ data }) => {
          Notification.addNotification(data.response.message, true);
          this.form.email = "";
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
    height: 50px;
    @media (max-width: 1410px) {
      height: 50px;
    }
    @media (max-width: 576px) {
      font-size: 14px;
    }
  }

  .invalid {
    border: 1px solid red;
    color: red;
    &::placeholder {
      color: red;
    }
  }
}
</style>
