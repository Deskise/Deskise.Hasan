<template>
  <div class="login d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <h1 class="mb-4 text-left">Signup</h1>
          <div class="row">
            <div class="input-group mx-0 mb-2">
              <input
                type="text"
                class="form-control col-md py-3 me-3 m-auto"
                placeholder="First Name"
                v-model="form.firstname"
                id="firstname"
                @keydown="$event.target.classList.remove('invalid')"
              />
              <input
                type="text"
                class="form-control col-md py-3 m-auto"
                placeholder="Last Name"
                v-model="form.lastname"
                id="lastname"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>

            <div class="input-group mx-0 mb-2">
              <input
                type="email"
                class="form-control col-12 py-3"
                placeholder="Email"
                v-model="form.email"
                id="email"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>

            <div class="input-group mx-0 mb-2">
              <input
                type="password"
                class="form-control col-12 py-3"
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
                class="btn btn-primary form-control col-12 py-3"
                @click="check"
              >
                Signup
              </button>
            </div>

            <div class="input-group mx-0 mb-3">
              <circle-checkbox
                text="Agree To Mail Updates"
                @check="r1"
              ></circle-checkbox>
            </div>

            <div class="input-group mx-0 mb-3">
              <circle-checkbox
                text="Agree To Terms Of Use"
                @check="r2"
                id="terms"
                @click="$event.target.parentElement.classList.remove('invalid')"
              ></circle-checkbox>
            </div>

            <div class="input-group other-login mx-0 mb-2 overflow-hidden">
              <hr class="or col-12 mb-3" />
              <div class="col ps-0 me-2">
                <button
                  class="btn form-control btn-login-facebook w-100 mb-2 py-3"
                  @click.prevent="signup('facebook')"
                >
                  Facebook
                </button>
              </div>
              <div class="col pe-0 ms-2">
                <button
                  class="btn form-control btn-login-google w-100 mb-2 py-3"
                  @click.prevent="signup('google')"
                >
                  Google
                </button>
              </div>

              <div class="col-12 justify-content-center">
                <p class="lead">
                  Already Have An Account?
                  <router-link :to="{ name: 'login' }">Login</router-link>
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
import { required, email, same } from "../../Mixins/Validations";
export default {
  data() {
    return {
      form: {
        firstname: "",
        lastname: "",
        email: "",
        password: "",
        confirmPassword: "",
        newsletter: false,
        terms: false,
      },
      isError: false,
    };
  },
  components: { manimg },
  mixins: [Via],
  methods: {
    r1(e) {
      this.form.newsletter = e;
    },
    r2(e) {
      this.form.terms = e;
    },
    check() {
      this.isError = false;
      let inv = document.querySelectorAll(".invalid");
      if (inv) inv.forEach((el) => el.classList.remove("invalid"));

      if (!required(this.form.firstname)) {
        document.querySelector("#firstname").classList.add("invalid");
        this.isError = true;
      }
      if (!required(this.form.lastname)) {
        document.querySelector("#lastname").classList.add("invalid");
        this.isError = true;
      }
      if (!required(this.form.email) || !email(this.form.email)) {
        document.querySelector("#email").classList.add("invalid");
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
      if (!required(this.form.terms)) {
        document.querySelector("#terms").classList.add("invalid");
        this.isError = true;
      }

      if (this.isError) return;

      this.signup(
        "email",
        this.form.newsletter,
        this.form.terms,
        this.form.firstname,
        this.form.lastname,
        this.form.email,
        this.form.password
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
