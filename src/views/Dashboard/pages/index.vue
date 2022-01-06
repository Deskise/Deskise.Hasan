<template>
  <div id="Profile">
    <div class="row">
      <div class="col-auto col-lg-2 p-1 replace-img text-center mb-2 mt-lg-5">
        <div class="profile-pic">
          <label class="-label" for="file">
            <span class="glyphicon glyphicon-camera"></span>
            <span>Replace Image</span>
          </label>

          <input id="file" type="file" @change="loadFile($event)" />
          <img :src="img" id="output" />
        </div>

        <span class="replace">Replace Image</span>
      </div>

      <div class="col-12 col-lg-10">
        <form class="mt-4 mt-lg-2" id="contact" @submit.prevent="check">
          <div class="col-lg-12 px-1 pe-1 mx-0 mb-0 row">
            <div class="col-lg-6 ps-lg-0 pe-lg-1 px-0 mb-2 mb-lg-1">
              <input
                type="text"
                class="form-control"
                id="fname"
                placeholder="First Name"
                style="font-size: 90%"
                v-model="user.firstname"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>
            <div class="col-lg-6 pe-lg-0 ps-lg-1 px-0 mb-2 mb-lg-1">
              <input
                type="text"
                class="form-control w-100"
                id="lname"
                placeholder="Last Name"
                style="font-size: 90%"
                v-model="user.lastname"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>
          </div>
          <div class="col-lg-12 p-1">
            <div class="form-group mb-0">
              <textarea
                class="form-control"
                id="bio"
                placeholder="Bio"
                rows="5"
                style="font-size: 94%"
                v-model="user.bio"
                @keydown="$event.target.classList.remove('invalid')"
              ></textarea>
            </div>
          </div>

          <div class="col-lg-12 p-1">
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder="Email"
              style="font-size: 90%"
              v-model="user.email"
              @keydown="$event.target.classList.remove('invalid')"
            />
          </div>
          <div class="col-lg-12 p-1">
            <input
              type="email"
              class="form-control"
              id="bemail"
              placeholder="Backup email"
              style="font-size: 90%"
              v-model="user.backup_email"
              @keydown="$event.target.classList.remove('invalid')"
            />
          </div>

          <div class="col-lg-12 p-1">
            <input
              type="tel"
              class="form-control"
              id="phone"
              placeholder="Phone"
              style="font-size: 90%"
              v-model="user.phone"
              @keydown="$event.target.classList.remove('invalid')"
            />
          </div>
          <div class="col-lg-12 p-1">
            <input
              type="tel"
              class="form-control"
              id="bphone"
              placeholder="Backup Phone"
              style="font-size: 90%"
              v-model="user.backup_phone"
              @keydown="$event.target.classList.remove('invalid')"
            />
          </div>

          <div class="col-lg-12 p-1">
            <input
              type="text"
              class="form-control"
              id="location"
              placeholder="Location"
              style="font-size: 90%"
              v-model="user.location"
              @keydown="$event.target.classList.remove('invalid')"
            />
          </div>

          <div class="col-lg-12 p-1 text-left">
            <label>Social Media</label>
          </div>
          <div
            class="col-lg-12 p-1"
            v-for="(link, index) in user.links"
            :key="index"
          >
            <input
              type="text"
              class="form-control"
              style="font-size: 90%"
              :id="`slink_${link.social_id}`"
              :title="
                socialMedia.filter((e) => e.id === link.social_id)[0].name
              "
              v-model="link.link"
              @keydown="$event.target.classList.remove('invalid')"
            />
          </div>

          <div class="col-lg-12 p-1">
            <div id="items"></div>
            <div class="add-input">
              <input
                id="textinput"
                type="text"
                class="form-control mb-2"
                style="font-size: 90%"
              />
              <button
                class="btn add-more bg-transparent"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#add"
              >
                <flat-icon-component icon="plus" type="b"></flat-icon-component>
              </button>
            </div>
          </div>

          <div class="col-lg-5 m-auto text-center p-1">
            <div class="form-group">
              <button
                type="submit"
                class="btn w-100 btn-primary mt-2"
                value="Send"
                name="submit"
              >
                SAVE
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <Confirm
    id="add"
    title="Add Social Media Account"
    submit="Add"
    close="close"
    desc="lorem"
    :options="socialMedia"
    :selectedOpt="user.links.map(({ social_id }) => social_id)"
    @submit="(e) => addLink(e)"
  ></Confirm>
</template>

<script>
import Dashboard from "@/config/Services/Dashboard";
import { required, email, number, optional, url } from "@/Mixins/Validations";
import { mapState } from "vuex";
import Notification from "@/config/Notification";
import { same } from "../../../Mixins/Validations";
export default {
  computed: {
    ...mapState("user", ["socialMedia"]),
  },
  data() {
    return {
      user: this.$store.getters["user/getUserData"],
      img: this.$store.state.user.data.img,
      showModel: true,
      isError: false,
    };
  },
  methods: {
    loadFile(event) {
      this.user.img = event.target.files[0];
      this.img = URL.createObjectURL(event.target.files[0]);
    },
    async check() {
      this.isError = false;
      if (!required(this.user.firstname)) {
        document.querySelector("#fname").classList.add("invalid");
        this.isError = true;
      }
      if (!required(this.user.lastname)) {
        document.querySelector("#lname").classList.add("invalid");
        this.isError = true;
      }
      if (!required(this.user.email) || !email(this.user.email)) {
        document.querySelector("#email").classList.add("invalid");
        this.isError = true;
      }
      if (!required(this.user.phone) || !number(this.user.phone)) {
        document.querySelector("#phone").classList.add("invalid");
        this.isError = true;
      }
      if (
        !optional(this.user.backup_email, [email]) ||
        same(this.user.backup_email, this.user.email)
      ) {
        document.querySelector("#bemail").classList.add("invalid");
        this.isError = true;
      }
      if (
        !required(this.user.phone) ||
        !optional(this.user.backup_phone, [number]) ||
        same(this.user.backup_phone, this.user.phone)
      ) {
        document.querySelector("#bphone").classList.add("invalid");
        this.isError = true;
      }

      this.user.links.forEach((link) => {
        console.log(url(link.link));
        if (!required(link.link) || !url(link.link)) {
          document
            .querySelector(`#slink_${link.social_id}`)
            .classList.add("invalid");
          this.isError = true;
        }
      });

      if (this.isError) return;

      await Dashboard.userData(this.prepareToSend(this.user)).then(
        ({ data }) => {
          Notification.addNotification(data.response.message, true);
          this.$store.dispatch("user/setUserData", {
            data: data.response.extra[0],
          });
          this.user = this.$store.getters["user/getUserData"];
        }
      );
    },
    addLink(e) {
      this.user.links.push({
        id: null,
        user_id: this.user.id,
        social_id: e,
        link: "",
      });
    },
    prepareToSend(data) {
      let formData = new FormData();
      formData.append("hi", "there");
      Object.keys(data)
        .map((key) => {
          return [key, data[key]];
        })
        .forEach((e) => {
          if (e[1] !== null) {
            if (typeof e[1] === "object" && !(e[1] instanceof File)) {
              Object.keys(e[1]).map((d) =>
                formData.append(e[0] + "[]", JSON.stringify(e[1][d]))
              );
            } else formData.append(e[0], e[1]);
          }
        });
      return formData;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables";
#Profile {
  .replace-img {
    @mixin object-center {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    span.replace {
      color: $primary;
      font-size: 14px;
      @media (min-width: $minLarge) {
        font-size: 20px !important;
      }
    }

    $circleSize: 120px;
    $radius: 50%;
    $shadow: 0 0 10px 0 rgba(255, 255, 255, 0.35);
    $fontColor: rgb(250, 250, 250);

    .profile-pic {
      color: transparent;
      transition: all 0.3s ease;
      @include object-center;
      position: relative;
      transition: all 0.3s ease;
      height: $circleSize;
      width: $circleSize;
      @media (min-width: $minLarge) {
        height: 150px;
        width: 150px;
      }

      input {
        display: none;
      }

      img {
        position: absolute;
        object-fit: cover;
        width: $circleSize;
        height: $circleSize;
        box-shadow: $shadow;
        border-radius: $radius;
        z-index: 0;

        border: 1px solid rgba($formColor, 0.5);
        padding: 10px;
        display: flex;
        @media (min-width: $minLarge) {
          height: 150px;
          width: 150px;
        }
      }

      .-label {
        cursor: pointer;
        height: $circleSize;
        width: $circleSize;
      }

      &:hover {
        .-label {
          @include object-center;
          background-color: rgba($secondary, 0.6);
          z-index: 10000;
          color: $fontColor;
          transition: background-color 0.2s ease-in-out;
          border-radius: $radius;
          margin-bottom: 0;
          @media (min-width: $minLarge) {
            height: 150px;
            width: 150px;
          }
        }
      }
    }

    .profile-pic.img-replace-square {
      img {
        border-radius: 10px;
        border: none;
      }

      .-label {
        cursor: pointer;
        height: $circleSize;
        width: $circleSize;
      }

      &:hover {
        .-label {
          @include object-center;
          background-color: transparent;
          z-index: 10000;
          color: $fontColor;
          transition: background-color 0.2s ease-in-out;
          border-radius: 10px;
          margin-bottom: 0;
          @media (min-width: $minLarge) {
            height: 150px;
            width: 150px;
          }
        }
      }

      button.add-img-plus {
        display: contents;
        font-size: 22px;
        color: $gray;
        display: flex;
        position: absolute;
        z-index: 55555555555555555;
      }
    }

    span {
      display: inline-flex;
      font-size: 13px;

      @media (min-width: $minLarge) {
        font-size: 20px;
      }
    }
  }
  .add-input {
    position: relative;

    .add-more {
      width: 100%;
      position: absolute;
      left: 0;
      top: 0;
    }
  }
}
</style>
