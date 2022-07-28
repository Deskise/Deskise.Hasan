<template>
<!-- ------------------------------new nav -------------------- -->
<nav :class="{
      'navbar navbar-expand-lg border-bottom noLogin': true,
  'bg-white': scrolled,
    }">
  <div class="container">
     <div class="logo navbar-brand">
      <router-link :to="{ name: 'home' }">
        <img src="@/assets/logo.png" />
      </router-link>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="menu-icon">
        <span></span>
        <span></span>
        <span></span>
      </span>
    </button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 dash-menu-links">
        <li class="nav-item">
          <router-link class="nav-link" :to="{ name: 'products' }">
              {{ __("header.nologin.home") }}
            </router-link>
        </li>
         <li class="nav-item dash-has-menu">
            <a href="javascript:void(0)" class="dash-menu-link nav-link">
              {{ __("header.nologin.category") }}
            </a>
            <ul class="dash-sub-menu">
              <li
                class="dash-sub-menu-item"
                v-for="(category, index) in categories"
                :key="index"
              >
                <router-link
                  :to="{
                    name: 'productsByCategory',
                    params: { id: category.id },
                  }"
                >
                  {{ category.name }}
                  <span></span>
                </router-link>
              </li>
            </ul>
          </li>
        <li class="nav-item">
          <router-link
              class="dash-menu-link nav-link"
              :to="{ name: 'requestProduct' }"
            >
              {{ __("footer.request") }}
            </router-link>
        </li>
        <li class="nav-item">
         <router-link class="dash-menu-link nav-link" :to="{ name: 'blog' }">
              {{ __("header.nologin.blog") }}
            </router-link>
        </li>
      </ul>
      <form class="d-block d-lg-flex" role="search">
       <div class="dash-search">
        <input placeholder="Search" />
        <flat-icon-component
          icon="search"
          class="serach-icon"
        ></flat-icon-component>
      </div>
        <ul class="dash-right-menu">
        <li id="dash-notifications-toggle">
          <a
            href="javascript:void(0)"
            class="icon-menu"
            @click="toggleNotification"
          >
            <span class="dash-count">1</span>
            <flat-icon-component icon="bell" type="r"></flat-icon-component>
          </a>
          <ul
            id="dash-notifications-menu"
            :class="{ 'd-block': showNotificationList }"
          >
            <li class="dash-notification-item">
              <a class="" href="javascript:void(0)">
                <span class="order-number">#32123</span>
                <span class="order-status">Correspondence Request</span>
                <span class="order-icon">
                  <flat-icon-component icon="arrow-right"></flat-icon-component>
                </span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <router-link :to="{ name: 'chat' }" class="icon-menu">
            <span class="dash-count">1</span>
            <flat-icon-component icon="envelope" type="r"></flat-icon-component>
          </router-link>
        </li>
        <li class="dash-has-menu">
          <a href="javascript:void(0)" class="avatar-menu">
            <img :src="$store.state.user.data.img" />
          </a>
          <ul class="dash-sub-menu">
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'dashboard.index' }">
                Dashboard
                <span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'profile' }">
                See Profile
                <span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'profile.affiliate' }">
                Affiliate links
                <span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'logout' }">
                Logoff
                <span></span>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="dash-has-menu">
          <a href="javascript:void(0)" class="dash-menu-terms">
            <flat-icon-component icon="menu-burger"></flat-icon-component>
          </a>
          <ul class="dash-sub-menu">
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'terms' }">
                Terms of Use<span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'dashboard.packages' }">
                Subscription Packages<span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'about' }">
                About Us<span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'faq' }">
                Common Questions<span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'privacy' }">
                Privacy Policy<span></span>
              </router-link>
            </li>
          </ul>
        </li>
        <li>
          <router-link :to="{ name: 'sales' }">
            <button class="btn btn-primary login dash-btn btn-sales">
              {{ __("header.login.sales") }}
            </button>
          </router-link>
        </li>
      </ul>
      </form>
    </div>
  </div>
</nav>










<!-- ----------------------------------old nav-------------------------------------------- -->
<!-- ------------------------------------------------------------------------------ -->
 <!-- <nav
    :class="{
      'navbar navbar-expand-lg border-bottom noLogin': true,
      'bg-white': scrolled,
    }"
  >
    <div class="container">
    <div class="logo">
      <router-link :to="{ name: 'home' }">
        <img src="@/assets/logo.png" />
      </router-link>
    </div>
    <div class="nav-content">
      <div class="dash-nav-links">
        <ul class="dash-menu-links">
          <li class="dash-menu-item">
            <router-link class="dash-menu-link" :to="{ name: 'products' }">
              {{ __("header.nologin.home") }}
            </router-link>
          </li>
          <li class="dash-menu-item dash-has-menu">
            <a href="javascript:void(0)" class="dash-menu-link">
              {{ __("header.nologin.category") }}
            </a>
            <ul class="dash-sub-menu">
              <li
                class="dash-sub-menu-item"
                v-for="(category, index) in categories"
                :key="index"
              >
                <router-link
                  :to="{
                    name: 'productsByCategory',
                    params: { id: category.id },
                  }"
                >
                  {{ category.name }}
                  <span></span>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="dash-menu-item">
            <router-link
              class="dash-menu-link"
              :to="{ name: 'requestProduct' }"
            >
              {{ __("footer.request") }}
            </router-link>
          </li>
          <li class="dash-menu-item">
            <router-link class="dash-menu-link" :to="{ name: 'blog' }">
              {{ __("header.nologin.blog") }}
            </router-link>
          </li>
        </ul>
      </div>
      <div class="dash-search">
        <input placeholder="Search" />
        <flat-icon-component
          icon="search"
          class="serach-icon"
        ></flat-icon-component>
      </div>
      <ul class="dash-right-menu">
        <li id="dash-notifications-toggle">
          <a
            href="javascript:void(0)"
            class="icon-menu"
            @click="toggleNotification"
          >
            <span class="dash-count">1</span>
            <flat-icon-component icon="bell" type="s"></flat-icon-component>
          </a>
          <ul
            id="dash-notifications-menu"
            :class="{ 'd-block': showNotificationList }"
          >
            <li class="dash-notification-item">
              <a class="" href="javascript:void(0)">
                <span class="order-number">#32123</span>
                <span class="order-status">Correspondence Request</span>
                <span class="order-icon">
                  <flat-icon-component icon="arrow-right"></flat-icon-component>
                </span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <router-link :to="{ name: 'chat' }" class="icon-menu">
            <span class="dash-count">1</span>
            <flat-icon-component icon="envelope" type="s"></flat-icon-component>
          </router-link>
        </li>
        <li class="dash-has-menu">
          <a href="javascript:void(0)" class="avatar-menu">
            <img :src="$store.state.user.data.img" />
          </a>
          <ul class="dash-sub-menu">
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'dashboard.index' }">
                Dashboard
                <span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'profile' }">
                See Profile
                <span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'profile.affiliate' }">
                Affiliate links
                <span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'logout' }">
                Logoff
                <span></span>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="dash-has-menu">
          <a href="javascript:void(0)" class="dash-menu-terms">
            <flat-icon-component icon="menu-burger"></flat-icon-component>
          </a>
          <ul class="dash-sub-menu">
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'terms' }">
                Terms of Use<span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'dashboard.packages' }">
                Subscription Packages<span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'about' }">
                About Us<span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'faq' }">
                Common Questions<span></span>
              </router-link>
            </li>
            <li class="dash-sub-menu-item">
              <router-link :to="{ name: 'privacy' }">
                Privacy Policy<span></span>
              </router-link>
            </li>
          </ul>
        </li>
        <li>
          <router-link :to="{ name: 'sales' }">
            <button class="btn btn-primary login dash-btn btn-sales">
              {{ __("header.login.sales") }}
            </button>
          </router-link>
        </li>
      </ul>
    </div>

    <button class="menu-icon-btn" @click="show=!show">
      <span class="menu-icon">
        <span></span>
        <span></span>
        <span></span>
      </span>
    </button>
      </div>
    </nav> -->
</template>

<script>
//TODO: notification menu show/hide.
//TODO: notifiaction component.
import { mapGetters } from "vuex";
export default {
  mounted() {
    // Array.from(document.querySelectorAll("#app *")).forEach((e) => {
    //   e.addEventListener("click", this.closeNotification);
    // });
    // console.log(
    //   document.querySelectorAll(
    //     "#dash-notifications-toggle, #dash-notifications-toggle *"
    //   )
    // );
    // Array.from(
    //   document.querySelectorAll(
    //     "#dash-notifications-toggle, #dash-notifications-toggle *"
    //   )
    // ).forEach((e) => {
    //   e.addEventListener("click", () => this.toggleNotification);
    // });
  },
  data() {
    return {
      showNotificationList: false,
      scrolled: false,
      show:false
    };
  },
  
  methods: {
    inLogin: function () {
      return this.$route.path.includes("auth");
    },
    toggleNotification(ev) {
      ev.preventDefault();
      this.showNotificationList = !this.showNotificationList;
    },
    closeNotification() {
      this.showNotificationList = false;
    },
  },
  computed: {
    ...mapGetters("category", ["categories"]),
  },
};
</script>
<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
.navbar-toggler{
  background: white!important;
}
.navbar-brand{
  margin: 0;
}
.navbar>.container div.logo{
   height:90px!important;
  max-height:90px!important;
  display: flex;
  align-items: center;
}
.navbar>.container div.logo a{
  display: block;
}

nav {
  background-color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  position: fixed;
  width: 100%;
  height:90px!important;
  max-height:90px!important;
  z-index: 1111; 
  .logo {
    max-width: 100%;
    img {
      display: block;
      max-width: 180px;
      margin-right: 90px;
    }
  }

  .nav-content {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .nav-item {
    padding: 10px 0;
    @media (max-width: 1400px) {
      padding:  0;
      }
  }
.nav-link{
  color: grey;
}

  .dash-menu-link {
    color: $gray;
    font-size: 18px;
    text-transform: capitalize;
    @media (max-width: 1400px) {
      font-size: 15px;
      }
    &:hover,
    &:focus {
      color: $secondary;
    }
    &.router-link-exact-active,
    &.router-link-active {
      color: $secondary;
      font-weight: bold;
    }
    &.active {
      font-size: 18px;
      color: #4e1b56;
    }
  }

  .dash-search {
    position: relative;
    margin-right: 15px;
     margin-left: 40px;
    @media (max-width: 992px) {
        width: 100%;
        margin-left: 0px;
      } 
    input {
      width: 200px;
      border: 1px solid #9d9d9d;
      border-radius: 4px;
      padding: 10px 15px;
      color: #9d9d9d;
      font-size: 18px;
      @media (max-width: 1400px) {
      padding: 10px 15px;
      font-size: 15px;
      }
       @media (max-width: 992px) {
        width: 100%;
        margin-bottom: 10px;
      } 
    }
    .serach-icon {
      position: absolute;
      right: 25px;
      font-size: 18px;
      top: calc(50% - 9px);
      color: #9d9d9d;
      @media (max-width: 1400px) {
        top:50%;
        transform: translateY(-50%);
        right: 15px;
      font-size: 15px;
      }
    }
  }

  .dash-right-menu {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 28px;
     margin-bottom: 0px;
     padding-left: 10px;
    @media (max-width: 1400px) {
    gap: 20px;
    padding: 0px;
  }
    @media (max-width: 992px) {
      justify-content: space-around;
}
    .icon-menu {
      font-size: 24px;
      color: #040506;
      position: relative;
      @media (max-width: 1400px) {
      font-size: 20px;
      }
      .dash-count {
        position: absolute;
        top: -3px;
        left: -3px;
        /* padding: 2px; */
        border-radius: 50%;
        width: 14px;
        height: 14px;
        line-height: 14px;
        text-align: center;
        font-size: 10px;
        color: #040506;
        background-color: #fff;
        font-weight: bold;
      }
    }

    .avatar-menu {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      overflow: hidden;
      
      img {
        display: block;
        margin: auto;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        @media (max-width: 1400px) {
     width: 35px;
      height: 35px;
      }
      }
    }

    .dash-menu-terms {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      overflow: hidden;
      background-color: #4e1b56;
      color: #fff;
      font-size: 20px;
      text-align: center;
      display: inline-block;
      line-height: 40px;
       @media (max-width: 1400px) {
     width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      }
      i{
        font-size: 17px;
        height: 100%;
      }
    }
  }
}

nav .dash-btn.btn-sales {
  padding: 15px 40px;
  margin-left: 10px;
   @media (max-width: 1400px) {
      padding: 10px 15px;
    width: 120px;
   }
}
.dash-sub-menu{
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 2px 2px 10px #eee;
}

  nav .dash-has-menu:hover .dash-sub-menu {
    display: block !important;
    opacity: 1;
  }
.nav-item{
  display: flex;
  align-items: center;
}
nav .dash-has-menu,
nav #dash-notifications-toggle {
  position: relative;
}

nav .dash-sub-menu {
  position: absolute;
  top: 102%;
  left: 0;
  min-width: 220px;
  background-color: #fff;
  padding: 10px 0;
  display: none;
  transition: all 1s ease;
  z-index: 2220;
  border: 1px solid #eee;
  border-radius: 10px;
  box-shadow: 1px 1px 7px #ccc;
}
nav #dash-notifications-menu {
  position: absolute;
  top: 150%;
  left: 0;
  min-width: 220px;
  background-color: #fff;
  padding: 10px 0;
  display: none;
  transition: all 1s ease;
  z-index: 2220;
  border: 1px solid #eee;
  border-radius: 10px;
  box-shadow: 1px 1px 7px #ccc;
}

nav #dash-notifications-menu {
  min-width: 420px;
  z-index: 30;
}
nav .dash-right-menu .dash-sub-menu {
  @media (max-width: 992px) {
    left: 0%;
    transform: translateX(-50%);
   }
}
nav .dash-sub-menu li a {
  font-size: 18px;
  color: #040506;
  width: 100%;
  display: block;
  padding: 8px 10px;
  transition: all 0.3s ease-in-out;
  overflow: hidden;
  border-left: 0px solid $primary;
  position: relative;
  text-align: left;
   @media (max-width: 1400px) {
    font-size: 15px;
  padding: 8px 10px;
   }
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

nav .dash-sub-menu li a:hover {
  background-color: inherit;
  border-left: 3px solid $primary;
  span {
    left: 0;
  }
}
nav .dash-right-menu{
 @media (max-width: 992px) {
     flex-wrap: wrap;
     gap:5px
      }
}
nav .dash-right-menu > li{
   @media (max-width: 992px) {
      width: 20%;
      text-align: center;
      }
}
nav .dash-right-menu li:last-of-type{
   @media (max-width: 992px) {
      width: 80%;
      }
}
nav .dash-right-menu li a{
   @media (max-width: 992px) {
      display: inline-block!important;
      }
}
nav .dash-notification-item {
  padding: 5px 10px;
}

nav .dash-notification-item a {
  display: block;
  background-color: $primary;
  &:hover {
    background-color: $secondary;
  }
  color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px 10px;
  border-radius: 8px;
}

nav .dash-notification-item a .order-number {
  padding-right: 10px;
  border-right: 1px dashed #fff;
}

nav .dash-notification-item a .order-status {
  flex-grow: 1;
  padding-left: 10px;
}

.menu-icon-btn {
  border: none;
  background: none;
  display: none;
}

span.menu-icon {
  display: block;
  height: 1.25rem;
  width: 2.5rem;
  cursor: pointer;
  position: relative;
}

span.menu-icon span {
  display: block;
  position: absolute;
  height: 3px;
  width: 100%;
  background: #3a3a3a;
  border-radius: 9px;
  opacity: 1;
  left: 0;
  transition: all 0.2s ease-in-out 0s;
  -webkit-transition: all 0.2s ease-in-out 0s;
  -moz-transition: all 0.2s ease-in-out 0s;
  -ms-transition: all 0.2s ease-in-out 0s;
  -o-transition: all 0.2s ease-in-out 0s;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  -ms-border-radius: 9px;
  -o-border-radius: 9px;
}

span.menu-icon span:nth-child(1) {
  top: 0;
}

span.menu-icon span:nth-child(2) {
  top: 9px;
  width: 80%;
}

span.menu-icon span:nth-child(3) {
  top: 1.125rem;
}

span.menu-icon.active span {
  background: #e590b5;
  width: 100% !important;
}
  nav .logo img {
    margin-right: 40px;
  }
  nav .dash-menu-links {
    margin-right: 40px;
    display: flex;
    justify-content: flex-start;
    gap: 30px;
    @media (max-width: 1510px) {
        margin-bottom: 0px;
        padding: 0px;
        gap: 19px;
    }
    @media (max-width: 992px) {
        gap: 0px;
    }
  }
  .navbar-collapse{
    @media (max-width: 992px) {
         background: white;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 20px;
    }
  }

</style>
