<template>
  <div class="dash-profile-details">
    <div class="dash-profile-image">
      <img :src="user.img" />
    </div>
    <div class="dash-profile-name">
      {{ user.firstname + " " + user.lastname }}
    </div>
    <div class="dash-profile-bio">
      {{ user.bio ?? "No Bio Provided Yet" }}
    </div>
    <div class="dash-profile-address">
      <flat-icon-component icon="marker" type="s"></flat-icon-component>
      {{ user.location ?? "No Location Yet" }}
    </div>
    <div class="dash-profile-email">
      <flat-icon-component icon="envelope" type="s"></flat-icon-component>
      {{ user.email }}
    </div>
    <router-link :to="{ name: 'dashboard.index' }" v-if="sameUser">
      <div class="dash-btn edit-btn btn-primary">Edit Profile</div>
    </router-link>
    <div class="dash-btn chat-btn btn-primary" v-else>Chat</div>
    <ul class="dash-profile-socails" v-if="user.links.length > 0">
      <li v-for="(link, index) in user.links" :key="index">
        <a :href="link.link" target="_blank">
          <font-awesome-component
            :icon="link.account.icon"
          ></font-awesome-component>
        </a>
      </li>
    </ul>
    <div
      class="dash-profile-details-footer d-flex"
      v-if="user.id_verified_at !== null"
    >
      <flat-icon-component icon="crown" type="s"></flat-icon-component>
      ID Verified
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
//TODO: replace banner image.
export default {
  computed: {
    user() {
      return this.$store.state.user.otherUser;
    },
    ...mapGetters("user", ["sameUser"]),
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables";

.dash-profile-details {
  background: #fff;
  box-shadow: 1px 1px 4px rgb(177, 177, 177);
  padding: 20px 18px;
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  top: -120px;
  border-radius: 20px;
  @media (max-width: 1400px) {
    top: -90px;
  }
  & > * {
    margin-bottom: 15px;
  }

  .dash-profile-image {
    width: 60%;
    border: 2px solid rgba(201, 201, 201, 56/100);
    border-radius: 50%;

    img {
      width: 100%;
      height: 100%;
      border-radius: 50%;
    }
  }

  .dash-profile-name {
    color: #040506;
    font-size: 20px;
    font-weight: bold;
    text-transform: capitalize;
    @media (max-width: 1400px) {
      font-size: 17px;
    }
  }
  .dash-profile-bio,
  .dash-profile-address,
  .dash-profile-email {
    color: #9d9d9d;
    @media (max-width: 1400px) {
      font-size: 14px;
      margin-bottom: 10px;
    }
  }
  .dash-profile-bio {
    font-size: 18px;
    text-align: center;
    @media (max-width: 1400px) {
      font-size: 14px;
      margin-bottom: 10px;
    }
  }
  .dash-profile-address i,
  .dash-profile-email i {
    display: inline-block;
    margin-right: 5px;
  }
  .chat-btn {
    margin-bottom: 25px;
  }

  .dash-profile-socails {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    list-style-type: none;
    margin-bottom: 80px;
    a {
      font-size: 18px;
      color: #c9c9c9;
    }
  }
  .dash-profile-details-footer {
    font-size: 16px;
    color: $primary;
    text-align: center;
    align-items: center;
  }

  .dash-profile-details-footer i {
    border: 1px solid $primary;
    display: flex;
    margin-right: 5px;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    width: 35px;
    height: 35px;
  }
}

@media (min-width: 1px) and (max-width: 1200px) {
  .dash-profile-details {
    top: -50px;
    width: 100%;
    max-width: 100%;
  }
}
</style>
