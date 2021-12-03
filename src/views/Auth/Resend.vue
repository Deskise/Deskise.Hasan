<template>
  <div class="login d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <h1 class="mb-4 text-left">Resend Verification Code</h1>

          <div class="input-group mx-0 mb-2">
            <input
              type="email"
              class="form-control col-12 py-3"
              placeholder="E-MAIL"
              v-model="form.email"
              @keydown="$event.target.classList.remove('invalid')"
            />
          </div>
          <div class="input-group mx-0 mb-3">
            <button
              class="btn btn-primary form-control col-12 py-3"
              @click="check"
            >
              Resend
            </button>
          </div>

          <div class="input-group other-login mx-0 mb-2 overflow-hidden">
            <hr class="or col-12 mb-3" />
            <div class="col-12 justify-content-center">
              <p class="lead">
                Recieved Code?
                <router-link
                  :to="{
                    name: 'verify',
                    query: { email: $route.query.email },
                  }"
                  >Verify Code</router-link
                >
              </p>
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
import { required, email } from "../../Mixins/Validations";
import VerifyService from "@/config/Services/Auth/VerifyService";
import Notification from "../../config/Notification";
export default {
  data() {
    return {
      form: {
        email: this.$route.query.email,
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

      await VerifyService.resend(this.form.email).then(
        ({ data }) => {
          Notification.addNotification(data.response.message, true);
          this.$router.push({
            name: "verify",
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

  .invalid {
    border: 1px solid red;
    color: red;
    &::placeholder {
      color: red;
    }
  }
}
</style>
