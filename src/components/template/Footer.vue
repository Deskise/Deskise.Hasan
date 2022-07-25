<template>
  <footer class="container-fluid">
    <div class="container mb-3">
      <div class="row">
        <div class="col-md deskise">
          <h3>{{ __("websiteName") }}</h3>
          <div class="data">
            <ul>
              <li>
                <router-link :to="{ name: 'home' }">{{
                  __("header.nologin.home")
                }}</router-link>
              </li>
              <li>
                <router-link :to="{ name: 'about' }">{{
                  __("header.nologin.about")
                }}</router-link>
              </li>
              <li>
                <router-link :to="{ name: 'action' }">{{
                  __("header.nologin.mech")
                }}</router-link>
              </li>
              <li>
                <router-link :to="{ name: 'terms' }">{{
                  __("header.nologin.terms")
                }}</router-link>
              </li>
              <li>
                <router-link :to="{ name: 'faq' }">{{
                  __("header.nologin.FAQ")
                }}</router-link>
              </li>
              <li>
                <router-link :to="{ name: 'blog' }">{{
                  __("header.nologin.blog")
                }}</router-link>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md categpries">
          <h3>{{ __("header.nologin.category") }}</h3>
          <div class="data">
            <div class="row">
              <div class="col-4 mb-1 px-1" v-for="(category, index) in categories"
                :key="index">
                <router-link
                class="category w-100 d-flex justify-content-center align-items-center bg-gray-e bg-hover-gradiant"
                :to="{
                  name: 'productsByCategory',
                  params: { id: category.id },
                }"
              >
                {{ category.name }}
              </router-link>
              </div>
              
            </div>
          </div>
        </div>
        <div class="col-md subscripe">
          <h3>{{ __("footer.newsletter") }}</h3>
          <div class="data">
            <form @submit.prevent="subscripeToNewsLetter" class="row">
              <input
                type="text"
                class="form-control col-12 newsletter mb-2 mb-lg-4 px-3 py-2"
                v-model="email"
                :placeholder="__('Forms.email')"
              />
              <button type="submit" class="btn btn-primary col-12 col-lg mb-2 mb-lg-0">
                {{ __("footer.subscripe") }}
              </button>
              <router-link
                :to="{ name: 'requestProduct' }"
                class="btn btn-outline-secondary  col-12 col-lg"
              >
                {{ __("footer.request") }}</router-link
              >
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row last">
      <div
        class="col-12 bg-gray-e d-flex justify-content-center align-items-center"
      >
        <p class="lead my-2">&copy; 2021, Deskise, All Rights Reserved</p>
      </div>
    </div>
  </footer>
</template>

<script>
import { mapGetters } from "vuex";
import NewLetter from "@/config/Services/Data/NewsLetter";
import store from "@/store";
export default {
  data() {
    return {
      email: null,
    };
  },
  methods: {
    async subscripeToNewsLetter() {
      NewLetter.subscribe(this.email).then(({ data }) => {
        let message = data.response.message;
        store.dispatch("notification/add", { message, status: true });
      });
    },
  },
  computed: {
    ...mapGetters("category", ["categories"]),
  },
};
</script>

<style lang="scss" scoped>
footer,.last{
  overflow: hidden;
}
$primary: #3eadb7;
$secondary: #4e1b56;
a {
  text-decoration: none;
}
h3 {
  color: #4e4e4e;
  text-align: left;
  @media (max-width: 1400px) {
    font-size: 20px;
     margin-bottom: 0px;
  }
  @media (max-width: 992px) {
     font-size: 17px;
  }
  @media (max-width: 760px) {
    text-align: center;
  }
  position: relative;
  padding: 10px 0;
  margin-bottom: 20px;

  &::after {
    content: "";
    height: 1px;
    width: 10%;
    background: $primary;
    position: absolute;
    bottom: 0;
    left: 0;
    @media (max-width: 760px) {
       width: 60%;
      left: 20%;
    }
  }
}
.data {
  padding: 15px;
  text-align: left;
 
  @media (max-width: 760px) {
    text-align: center;
    padding-top: 5px;
  }

  ul {
    list-style: none;
    padding: 0;

    li {
      margin: 3px 0;
      a {
        color: #595a5a;
        font-size: 16px;
         @media (max-width: 1400px) {
          font-size: 13px;;
        }
        @media (max-width: 992px) {
         font-size: 12px;
        }
        &:hover,
        &.router-link-active {
          font-weight: bold;
        }
      }
    }
  }

  .category {
    margin:3px;
    padding: 7px;
    border-radius: 3px;
    color: #040506;
    font-size: 16px;
    min-height: 80px;
      @media (max-width: 1400px) {
         font-size: 13px;
         min-height: 50px;
        }
    &.router-link-active {
      color: white !important;
      background: linear-gradient(0.4turn, $primary, $secondary) !important;
    }
  }

  form {
    input {
      border: 1px solid #9d9d9d;
      border-radius: 5px;
      font-size: 18px;
      @media (max-width: 1400px) {
         font-size: 15px;
        }
    }

    .btn {
      padding: 10px 0;
       @media (max-width: 1400px) {
          padding: 5px 0;
        }
      &:is(button) {
        margin-right: 15px;
      }
    }
  }
}
.lead{
  font-size: 17px;
}
</style>
