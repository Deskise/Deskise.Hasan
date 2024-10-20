<template>
  <section class="contact bg-gray-e">
    <div class="container">
      <div class="row">
        <h2>Contact Us</h2>
        <p class="mb-4">
          Lorem ipsum dolor sit amet, consetetur sadipscing elitr
        </p>
        <form class="d-flex">
          <input
            class="form-control col-12 input-outline-secondary mb-2"
            type="text"
            v-model="name"
            placeholder="Name"
            @keydown="$event.target.classList.remove('invalid')"
          />
          <input
            class="form-control col-12 input-outline-secondary mb-2"
            type="email"
            v-model="email"
            placeholder="Email"
            @keydown="$event.target.classList.remove('invalid')"
          />
          <textarea
            class="form-control col-12 input-outline-secondary mb-2"
            cols="30"
            rows="8"
            v-model="message"
            placeholder="Message text"
            @keydown="$event.target.classList.remove('invalid')"
          ></textarea>
          <input
            class="btn btn-primary"
            type="button"
            value="Send"
            @click="send()"
          />
        </form>
      </div>
    </div>
  </section>
</template>

<script>
import { required, email } from "../../Mixins/Validations";
import Notification from "@/config/Notification";
import ContactService from "../../config/Services/Data/ContactService.js";
export default {
  data() {
    return {
      name: "",
      email: "",
      message: "",
    };
  },
  methods: {
    async send() {
      this.isError = false;
      let inv = document.querySelectorAll(".invalid");
      if (inv) inv.forEach((el) => el.classList.remove("invalid"));

      if (!required(this.email) || !email(this.email)) {
        document.querySelector("input[type=email]").classList.add("invalid");
        this.isError = true;
      }
      if (!required(this.name)) {
        document.querySelector("input[type=text]").classList.add("invalid");
        this.isError = true;
      }
      if (!required(this.message)) {
        document.querySelector("textarea").classList.add("invalid");
        this.isError = true;
      }

      if (this.isError) return;
      await ContactService.send(this.name, this.email, this.message).then(
        ({ data }) => {
          this.name = this.email = this.message = "";
          Notification.addNotification(data.response.message, true);
        },
        (err) => Notification.addNotification(err.error.message, false)
      );
    },
  },
};
</script>

<style lang="scss" scoped>
section {
  justify-content: center;
  align-items: center;
  padding: 70px 0;

  h2 {
    font-size: 40px;
    @media (max-width: 1400px) {
      font-size: 40px;
    }
    @media (max-width: 760px) {
      font-size: 30px;
    }
    font-weight: bold;
  }
  p {
    color: #9d9d9d;
    font-size: 20px;
    @media (max-width: 1400px) {
      font-size: 15px;
    }
    @media (max-width: 776px) {
      font-size: 14px;
    }
  }

  form {
    flex-direction: column;
    padding: 0 30%;
    @media (max-width: 1200px) {
      & {
        padding: 0 20%;
      }
    }
    @media (max-width: 992px) {
      & {
        padding: 0 15%;
      }
    }
    @media (max-width: 776px) {
      & {
        padding: 0 4%;
      }
    }
    input {
      height: 45px;
    }
  }
}
.invalid {
  border: 1px solid red;
  color: red;
  &::placeholder {
    color: red;
  }
}
</style>
