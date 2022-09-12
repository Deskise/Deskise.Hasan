<template>
  <div class="login d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8 col-xl-5">
          <h1 class="mb-4 mt-0 text-left">Request A Product</h1>
          <div class="row">
            <div class="input-group mx-0 mb-1">
              <select
                class="form-select col-12"
                id="category"
                v-model="category_id"
                @keydown="$event.target.classList.remove('invalid')"
              >
                <option value="" selected disabled>Product category</option>
                <option
                  v-for="category in categories"
                  :key="category.id"
                  :value="category.id"
                >
                  {{ category.name }}
                </option>
              </select>
            </div>

            <div class="input-group mx-0 mb-1">
              <select
                class="form-select col-12"
                id="sub_category"
                v-model="subcategory_id"
                @keydown="$event.target.classList.remove('invalid')"
              >
                <option value="" selected disabled>Product Type</option>
                <option
                  v-for="subCategory in subcategories"
                  :key="subCategory.id"
                  :value="subCategory.id"
                >
                  {{ subCategory.name }}
                </option>
              </select>
            </div>

            <div class="input-group mx-0 mb-1">
              <input
                type="email"
                class="form-control col-12 py-1"
                placeholder="E-MAIL"
                v-model="email"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>

            <div class="input-group mx-0 mb-1">
              <input
                type="number"
                class="form-control col-12 py-1"
                id="price"
                placeholder="Price estimate"
                v-model="price"
                @keydown="$event.target.classList.remove('invalid')"
              />
            </div>

            <div class="input-group mx-0 mb-1">
              <textarea
                class="form-control col-12 mb-2"
                cols="30"
                rows="5"
                v-model="explain"
                placeholder="General explanation of the product"
                @keydown="$event.target.classList.remove('invalid')"
              ></textarea>
            </div>

            <div class="input-group mx-0 mb-3">
              <button
                class="btn btn-primary form-control col-12 py-1"
                @click="check"
              >
                Send
              </button>
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
import { required, email, fromList, number } from "../../Mixins/Validations";
import Notification from "@/config/Notification";
import RequestService from "../../config/Services/Products/RequestService";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      category_id: "",
      subcategory_id: "",
      email: "",
      price: "",
      explain: "",

      subcategories: [],
      isError: false,
    };
  },
  components: { manimg },
  mixins: [],
  computed: {
    ...mapGetters("category", ["categories"]),
  },
  watch: {
    category_id(v) {
      this.subcategory_id = "";
      if (v === "") this.subcategories = [];
      else
        this.subcategories = this.categories.filter(
          (e) => e.id === this.category_id
        )[0].subcategories;
    },
  },
  methods: {
    async check() {
      if (
        !required(this.category_id) ||
        !fromList(this.category_id, this.categories)
      ) {
        document.querySelector("#category").classList.add("invalid");
        this.isError = true;
      }
      if (
        !required(this.subcategory_id) ||
        !fromList(this.subcategory_id, this.subcategories)
      ) {
        document.querySelector("#sub_category").classList.add("invalid");
        this.isError = true;
      }
      if (!required(this.email) || !email(this.email)) {
        document.querySelector("input[type=email]").classList.add("invalid");
        this.isError = true;
      }
      if (!required(this.price) || !number(this.price)) {
        document.querySelector("#price").classList.add("invalid");
        this.isError = true;
      }
      if (!required(this.explain)) {
        document.querySelector("textarea").classList.add("invalid");
        this.isError = true;
      }

      if (this.isError) return;
      await RequestService.send(
        this.category_id,
        this.subcategory_id,
        this.price,
        this.explain,
        this.email
      ).then(
        ({ data }) => {
          this.category_id =
            this.subcategory_id =
            this.email =
            this.explain =
            this.price =
              "";
          Notification.addNotification(data.response.message, true);
        },
        (err) => Notification.addNotification(err.error.message, false)
      );
    },
  },
};
</script>

<style lang="scss" scoped>
.login {
  min-height: calc(85vh - 70px);
  margin-top: 80px !important;
  h1 {
    text-transform: uppercase;
    font-family: Barlow;
    font-weight: bold;
  }
  button {
    height: 50px;
    @media (max-width: 1410px) {
      height: 50px;
    }
    @media (max-width: 576px) {
      font-size: 14px;
    }
  }
  .input-group input,
  select {
    height: 50px;
    margin-bottom: 10px;
    @media (max-width: 1410px) {
      height: 45px;
    }
    @media (max-width: 576px) {
      height: 40px;
      font-size: 14px;
    }
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
