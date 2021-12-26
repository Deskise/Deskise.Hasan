<template>
  <div>
    <form class="mt-4 mt-lg-2" @submit.prevent="send()">
      <div class="col-lg-12 p-1">
        <input
          type="password"
          class="form-control"
          id="old_password"
          placeholder="old Password"
          name="password"
          style="font-size: 90%"
          required
          v-model="old_password"
        />
      </div>
      <div class="col-lg-12 p-1">
        <input
          type="password"
          class="form-control"
          id="new_password"
          placeholder="New Password"
          name="password"
          style="font-size: 90%"
          required
          v-model="new_password"
        />
      </div>
      <div class="col-lg-12 p-1">
        <input
          type="password"
          class="form-control"
          id="re_new_password"
          placeholder="Confirm Password"
          name="password"
          style="font-size: 90%"
          required
          v-model="re_new_password"
        />
      </div>

      <div class="col-lg-5 m-auto text-center p-1">
        <div class="form-group">
          <div class="input-btn buttons-enroll">
            <button
              type="submit"
              class="btn w-100 btn-primary mt-2"
              value="save"
              name="submit"
            >
              SAVE
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      old_password: "",
      new_password: "",
      re_new_password: "",
    };
  },
  methods: {
    send() {
      //TODO: CONNECT WITH BACKEND
      return true;
    },
  },
};
</script>

<style lang="scss" scoped></style>
