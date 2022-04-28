<template>
  <nav class="navbar navbar-expand-lg border-bottom noLogin">
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
        <span class="navbar-toggler-icon"></span>
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
nav.noLogin {
  background-color: rgba($color: #fff, $alpha: 1);
  padding: 20px 7%;
  position: fixed;
  width: 100%;

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
    @media (max-width: 1300px) {
      & {
        margin-right: 0;
      }
    }
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
              height: 2px;
              background-color: #3eadb758;
              position: absolute;
              top: 98%;
              left: -100%;
              transition: all 0.5s ease-in-out;
              transition-delay: 0.1s;
            }
          }

          &.dropdown-item:focus,
          &.dropdown-item:hover {
            background-color: inherit;
            border-left: 3px solid $primary;
            span {
              left: 0;
            }
          }
        }
      }

      &.dropdown-menu {
        padding: 0;
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
