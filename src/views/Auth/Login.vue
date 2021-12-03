<template>
  <div class="login d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-12">
          <h1 class="mb-4 text-left">Login</h1>
          <div class="row">
            <div class="input-group mx-0 mb-2">
              <input
                type="email"
                class="form-control col-12 py-3"
                placeholder="E-MAIL"
                v-model="form.email"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>

            <div class="input-group mx-0 mb-2">
              <input
                type="password"
                class="form-control col-12 py-3"
                placeholder="PASSWORD"
                v-model="form.password"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>
            <div class="input-group mx-0 mb-3">
              <button
                class="btn btn-primary form-control col-12 py-3"
                @click="check"
              >
                Login
              </button>
            </div>

            <div class="input-group mx-0 mb-3">
              <div class="radio text-left col-6 px-0">
                <circle-checkbox
                  text="Remember Password"
                  @check="r"
                ></circle-checkbox>
              </div>
              <div class="col-6 text-right px-0">
                <router-link :to="{ name: 'forget' }"
                  >Forget Password</router-link
                >
              </div>
            </div>
            <div class="input-group other-login mx-0 mb-2 overflow-hidden">
              <hr class="or col-12 mb-3" />
              <div class="col ps-0 me-2">
                <button
                  class="btn form-control btn-login-facebook w-100 mb-2 py-3"
                  @click.prevent="login('facebook')"
                >
                  Facebook
                </button>
              </div>
              <div class="col pe-0 ms-2">
                <button
                  class="btn form-control btn-login-google w-100 mb-2 py-3"
                  @click.prevent="login('google')"
                >
                  Google
                </button>
              </div>

              <div class="col-12 justify-content-center">
                <p class="lead">
                  Don't Have An Account?
                  <router-link :to="{ name: 'signup' }">Register</router-link>
                </p>
              </div>
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
import { Via } from "@/Mixins/Via";
import { required, email } from "../../Mixins/Validations";
export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
        remember_me: false,
      },
      isError: false,
    };
  },
  components: { manimg },
  mixins: [Via],
  methods: {
    r(e) {
      this.form.remember_me = e;
    },
    check() {
      this.isError = false;
      let inv = document.querySelectorAll(".invalid");
      if (inv) inv.forEach((el) => el.classList.remove("invalid"));

      if (!required(this.form.email) || !email(this.form.email)) {
        document.querySelector("input[type=email]").classList.add("invalid");
        this.isError = true;
      }

      if (!required(this.form.password)) {
        document.querySelector("input[type=password]").classList.add("invalid");
        this.isError = true;
      }

      if (this.isError) return;

      this.login(
        "email",
        this.form.email,
        this.form.password,
        this.form.remember_me
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
