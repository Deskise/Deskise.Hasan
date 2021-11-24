<template>
  <div class="login d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-5">
          <h1 class="mb-4 text-left">Signup</h1>
          <div class="row">
            <input
              type="email"
              class="form-control col-12 mx-2 mb-2 py-3"
              placeholder="Email"
            />
            <input
              type="password"
              class="form-control col-12 mx-2 mb-2 py-3"
              placeholder="Password"
            />
            <button class="btn btn-primary form-control col-12 mx-2 mb-3 py-3">
              Login
            </button>

            <div class="row mx-2 mb-3 px-0">
              <div class="radio text-left col-6 px-0">
                <input type="radio" name="rememeber" /> Remember Password
              </div>
              <div class="col-6 text-right px-0">
                <router-link :to="{ name: 'forget' }"
                  >Forget Password</router-link
                >
              </div>
            </div>
            <div class="row other-login mx-2 mb-2 px-0 overflow-hidden">
              <hr class="or col-12 mb-3" />
              <div class="col-6 ps-0">
                <button
                  class="btn form-control btn-login-facebook w-100 mb-2 py-3"
                >
                  Facebook
                </button>
              </div>
              <div class="col-6 pe-0">
                <button
                  class="btn form-control btn-login-google w-100 mb-2 py-3"
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
  </div>
</template>

<script>
export default {
  components: {},
};
</script>

<style lang="scss" scoped>
.login {
  min-height: calc(85vh - 70px);
}
</style>
