<template>
  <div class="payment-type col-12 col-lg-3 mb-2">
    <div class="categories bg-white" :class="{ shown: selected === 1 }">
      <div
        :class="{
          'item border border-bottom-0': true,
          selected: selected === 1,
        }"
      >
        <router-link :to="{ name: 'dashboard.index' }">
          <h6 class="p-0 m-0">Account Settings</h6>
        </router-link>
      </div>
      <ul class="menu list-unstyled mb-0">
        <li class="menu-item">
          <router-link :to="{ name: 'dashboard.index' }">
            <h6 class="p-2 m-0">Edit Profile</h6>
          </router-link>
        </li>
        <li class="menu-item">
          <router-link :to="{ name: 'dashboard.alerts' }">
            <h6 class="p-2 m-0">Manage Alerts Emails</h6>
          </router-link>
        </li>
        <li class="menu-item">
          <router-link :to="{ name: 'dashboard.password' }">
            <h6 class="p-2 m-0">Change Password</h6></router-link
          >
        </li>
        <li class="menu-item">
          <router-link :to="{ name: 'dashboard.verification' }">
            <h6 class="p-2 m-0">Verification</h6></router-link
          >
        </li>
        <li class="menu-item">
          <router-link :to="{ name: 'dashboard.packages' }">
            <h6 class="p-2 m-0">Subscribed Packages</h6></router-link
          >
        </li>

        <li class="menu-item">
          <router-link :to="{ name: 'dashboard.payment' }">
            <h6 class="p-2 m-0">Payment Cards</h6></router-link
          >
        </li>
        <li class="menu-item">
          <router-link :to="{ name: 'dashboard.close' }">
            <h6 class="p-2 m-0">Close Account</h6></router-link
          >
        </li>
      </ul>
    </div>
    <div class="new-item">
      <div
        :class="{
          'item border border-bottom-0 border-top-0': true,
          selected: selected === 2,
        }"
      >
        <router-link :to="{ name: 'dashboard.sales' }">
          <h6 class="p-0 m-0">My sales</h6>
        </router-link>
      </div>
      <div
        :class="{ 'item border border-top-0': true, selected: selected === 3 }"
      >
        <router-link :to="{ name: 'dashboard.product' }">
          <h6 class="p-0 m-0">Product views</h6>
        </router-link>
      </div>
    </div>

    <div class="offset-lg-3"></div>
  </div>
</template>

<script>
export default {
  props: {
    selected: {
      type: Number,
      required: true,
      default: 1,
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables";
.payment-type {
  .item {
    text-align: left;
    padding: 18px 0 18px 18%;
    h6 {
      font-weight: 500;
    }

    &.selected {
      background-color: $gray-50;
      position: relative;

      &:before {
        content: " ";
        position: absolute;
        background-color: $secondary;
        height: 82%;
        border-radius: 50px;
        right: 5px;
        border: 3px solid $primary;
        top: 9%;
      }
    }
  }
  ul.menu {
    display: none;
  }
  .shown {
    ul.menu {
      display: block;
      border: 1px solid rgba($formColor, 0.5);

      li {
        display: flex;
        padding-left: 15%;

        &:not(:last-child) {
          border-bottom: 1px solid rgba($formColor, 0.5);
        }

        &.menu-item {
          a.router-link-exact-active {
            position: relative;
            width: 100%;
            text-align: left;

            &:before {
              content: " ";
              position: absolute;
              background-color: $secondary;
              height: 82%;
              border-radius: 50px;
              right: 5px;
              border: 3px solid $secondary;
              top: 3px;
            }
          }

          h6 {
            color: #040506;
            font-weight: 500;
          }
        }
      }
    }
  }
}
</style>
