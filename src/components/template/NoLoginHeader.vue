<template>
  <nav  :class="{ 'bgWhite': this.$store.state.pageY , 'navbar navbar-expand-lg border-bottom noLogin':true }">
    <div class="container-fluid">
      <router-link class="navbar-brand col-lg" to="/">
        <img
          src="@/assets/logo.png"
          alt="logo"
          class="img-fluid border-right"
        />
      </router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z" fill="#fff"/></svg>
      </button>
      <div class="collapse navbar-collapse col-lg" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link class="nav-link" to="/">
              {{ __("header.nologin.home") }}
            </router-link>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              {{ __("header.nologin.category") }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li v-for="(category, index) in categories" :key="index">
                <router-link
                  :to="{
                    name: 'productsByCategory',
                    params: { id: category.id },
                  }"
                  class="dropdown-item"
                >
                  {{ category.name }}
                  <span></span>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'about' }">
              {{ __("header.nologin.about") }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'action' }">
              {{ __("header.nologin.mech") }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'terms' }">
              {{ __("header.nologin.terms") }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'privacy' }">
              {{ __("header.nologin.privacy") }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'faq' }">
              {{ __("header.nologin.FAQ") }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'blog' }">
              {{ __("header.nologin.blog") }}
            </router-link>
          </li>
        </ul>
        <router-link
          v-if="!inLogin()"
          :to="{ name: 'login' }"
          v-slot="{ navigate }"
        >
          <button class="btn btn-primary login" @click="navigate">
            {{ __("header.nologin.login") }}
          </button>
        </router-link>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  methods: {
    inLogin: function () {
      return this.$route.path.includes("auth");
    },
  },
    computed: {
    ...mapGetters("category", ["categories"]),
  },
  
   
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
nav.bgWhite{
  background-color: #fff!important;
}
nav.noLogin {
  background-color: transparent;
  padding: 20px 7%;
  position: fixed;
  width: 100%;
  height:90px!important;
  max-height:90px!important;
   z-index: 1111;
  @media (max-width: 1600px) {
    & {
      padding: 20px 4%;
    }
  }
  @media (max-width: 1220px) {
    & {
      padding: 20px 0%;
    }
  }
  border-color: #898989;
  z-index: 10;
  @media (max-width: 992px) {
    .navbar-collapse {
      background-color: white;
      box-shadow: 0 0 30px 0 #00000015;
      padding: 10px 0;
    }
  }

  a {
    @media (max-width: 1125px) and (min-width: 992px) {
      &.navbar-brand {
        display: none;
      }
    }
    img {
      border-color: $gray;
      width: 100%;
      max-width: 225px;
      min-width: 150px;
    }
  }
  div {
    flex-wrap: wrap;
    justify-content: space-between;
    ul {
      justify-content: space-around;
      align-items: center;
      flex-grow: 1;
      margin-right: 50px;
      @media (max-width: 1420px) {
        & {
          margin-right: 16px;
        }
      }
      @media (max-width: 1300px) {
        & {
          margin-right: 0;
        }
      }

      li {
        a {
          color: $gray;
          font-size: 18px;
          text-transform: capitalize;
          @media (max-width: 1420px) {
            & {
              font-size: 16px;
            }
          }
          @media (max-width: 1300px) {
            & {
              margin-right: 0;
            }
          }

          &:hover,
          &:focus {
            color: $secondary;
          }

          &.dropdown-item {
            position: relative;
            color: black;
            padding: 10px 8px 10px 8px;
            transition: all 0.3s ease-in-out;
            overflow: hidden;
            border-left: 0px solid $primary;
            span {
              width: 100%;
              height: 3px;
              background-color: $primary;
              position: absolute;
              top: 97%;
              left: -100%;
              transition: all 0.5s ease-in-out;
              transition-delay: 0.1s;
            }
            @media (max-width: 1400px) {
              font-size: 14px!important;
              color: grey;
            }
          }
          
          &.dropdown-item:focus,
          &.dropdown-item:hover {
            background-color: inherit;
            border-left: 2px solid $primary;
            color: #000;
            span {
              left: 0;
            }
          }
        }
      }

      &.dropdown-menu {
        padding: 10px 5px;
        width: 250%;
        border: 0;
        box-shadow: 0 0 20px 0 #00000015;
       
      }
      @media (max-width: 992px) {
        &.dropdown-menu {
          width: 100%;
          box-shadow: 0 0 30px 0 #00000015;
        }
      }
    }

    a.router-link-exact-active,
    a.router-link-active {
      color: $secondary;
      font-weight: bold;

      button {
        background-color: $secondary;
        border-color: $secondary;
        color: white;
        box-shadow: 0 0 0 0 ($secondary + a5) !important;

        &:hover,
        &:active {
          background-color: transparent;
          color: $secondary;
          border-color: $secondary;
          box-shadow: 0 0 0 0.25rem ($secondary + a5) !important;
        }
      }
    }

    button.login {
      flex-grow: 1;
      height: 57px;
      width: 100%;
      font-size: 20px;
      @media (max-width: 1420px) {
        & {
          font-size: 16px;
        }
      }
      @media (max-width: 1300px) {
        & {
          margin-right: 12px;
        }
      }
    }
  }
}

</style>
<style>
@media (max-width: 1420px) {
  .nav-link{
    padding-right: 0px!important;
    padding-left: 0px!important;
  }
  nav.noLogin div button.login{
    font-size: 15px!important;
    height: 100%!important;
    padding: 7px 15px;
  }
  nav.noLogin{
    padding: 40px 3%!important;
  }
}
@media (max-width: 1100px) {
nav.noLogin{
  padding: 0px 5%!important;
  height: 120px!important;
}
.navbar-toggler{
  width: 70px!important;
  padding: 7px!important;
  background: linear-gradient(to right,#3EAAB5,#4D215A)!important;
  border:none!important
}
}
</style>