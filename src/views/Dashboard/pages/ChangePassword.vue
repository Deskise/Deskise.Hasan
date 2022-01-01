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
          @keydown="$event.target.classList.remove('invalid')"
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
          @keydown="$event.target.classList.remove('invalid')"
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
          @keydown="$event.target.classList.remove('invalid')"
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
import Notification from "@/config/Notification";
import { required, same } from "@/Mixins/Validations";
import Dashboard from "@/config/Services/Dashboard";
export default {
  data() {
    return {
      old_password: "",
      new_password: "",
      re_new_password: "",
    };
  },
  methods: {
    async send() {
      let isError = false;

      if (!required(this.old_password)) {
        document.querySelector("#old_password").classList.add("invalid");
        isError = true;
      }
      if (
        !required(this.new_password) ||
        same(this.new_password, this.old_password)
      ) {
        document.querySelector("#new_password").classList.add("invalid");
        isError = true;
      }
      if (
        !required(this.re_new_password) ||
        !same(this.re_new_password, this.new_password)
      ) {
        document.querySelector("#re_new_password").classList.add("invalid");
        isError = true;
      }

      if (isError) return;
      await Dashboard.changePassword(
        this.old_password,
        this.new_password,
        this.re_new_password
      ).then(({ data }) => {
        Notification.addNotification(data.response.message, true);
        this.old_password = this.new_password = this.re_new_password = "";
      });
    },
  },
};
</script>

<style lang="scss" scoped></style>
