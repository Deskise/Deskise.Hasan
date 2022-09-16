<template>
  <div class="login d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8 col-xl-5">
          <h1 class="mb-4 text-left">{{ $t("login") }}</h1>
          <div class="row">
            <div class="input-group mx-0 mb-2">
              <input
                type="email"
                class="form-control col-12 py-1"
                placeholder="E-MAIL"
                v-model="form.email"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>

            <div class="input-group mx-0 mb-2">
              <input
                type="password"
                class="form-control col-12 py-1"
                :placeholder="$t('password')"
                v-model="form.password"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>
            <div class="input-group mx-0 mb-3">
              <button
                class="btn btn-primary form-control col-12 py-1"
                @click="check"
              >
                {{ $t("login") }}
              </button>
            </div>

            <div class="input-group mx-0 mb-3">
              <div class="radio text-left col-6 px-0">
                <circle-checkbox
                  text="Remember Password"
                  @check="r"
                ></circle-checkbox>
              </div>
              <div class="col-6 text-right px-0 forget">
                <router-link :to="{ name: 'forget' }">{{
                  $t("forgetPassword")
                }}</router-link>
              </div>
            </div>
            <div class="input-group other-login mx-0 mb-2 overflow-hidden">
              <hr class="or col-12 mb-4" />
              <div class="col ps-0 me-2">
                <button
                  class="btn form-control btn-login-facebook w-100 mb-2 py-1"
                  @click.prevent="login('facebook')"
                >
                  {{ $t("facebook") }}
                </button>
              </div>
              <div class="col pe-0 ms-2">
                <button
                  class="btn form-control btn-login-google w-100 mb-2 py-1"
                  @click.prevent="login('google')"
                >
                  {{ $t("google") }}
                </button>
              </div>

              <div class="col-12 justify-content-center">
                <p class="lead">
                  {{ $t("dontHaveAnAccount") }}
                  <router-link :to="{ name: 'signup' }">{{
                    $t("register")
                  }}</router-link>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <man-img></man-img>
  </div>
</template>

<script>
import manImg from "@/components/template/manImg.vue";
import { Via } from "@/Mixins/Via";
import { required, email } from "@/Mixins/Validations";
export default {
  data() {
    return {
      form: {
        email: this.$route.query.email || "",
        password: "",
        remember_me: false,
      },
      isError: false,
    };
  },
  components: { manImg },
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
  min-height: calc(105vh - 70px) !important;

  h1 {
    text-transform: uppercase;
    font-family: Barlow;
    font-weight: bold;
    margin-top: 0px;
  }
  .input-group input {
    height: 60px;
    @media (max-width: 1410px) {
      height: 50px;
    }
    @media (max-width: 576px) {
      height: 40px;
      font-size: 14px;
    }
  }
  button {
    height: 60px;
    @media (max-width: 1410px) {
      height: 50px;
    }
    @media (max-width: 576px) {
      font-size: 14px;
    }
  }
  .btn-login-facebook,
  .btn-login-google {
    @media (max-width: 1410px) {
      height: 40px;
    }
    @media (max-width: 576px) {
      height: 35px;
      font-size: 14px;
    }
  }
  .forget {
    @media (max-width: 1410px) {
      font-size: 14px;
    }
  }
  .radio {
    @media (max-width: 1410px) {
      font-size: 14px;
      cursor: pointer;
    }
    @media (max-width: 576px) {
      font-size: 12px;
    }
  }
  .or {
    border-color: #eee;
    position: relative;
    &::before {
      content: "OR";
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 10px 30px;
      color: #000 !important;
      font-weight: 700;
    }
  }
  .lead {
    @media (max-width: 1410px) {
      font-size: 16px;
      color: #ccc;
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
