<template>
  <div id="Manage-Email" class="content">
    <h5>Manage Alerts Emails</h5>
    <div>
      <ul class="manage col-lg-8">
        <li>
          <circle-checkbox
            text="Email Alerts"
            :value="alarms.email"
            @check="(e) => (alarms.email = e)"
          ></circle-checkbox>
        </li>
        <li>
          <circle-checkbox
            text="Administration Alerts"
            :value="alarms.admin"
            @check="(e) => (alarms.admin = e)"
          ></circle-checkbox>
        </li>
        <li>
          <circle-checkbox
            text="Message Alerts"
            :value="alarms.message"
            @check="(e) => (alarms.message = e)"
          ></circle-checkbox>
        </li>
        <li>
          <circle-checkbox
            text="Call Alerts"
            :value="alarms.call"
            @check="(e) => (alarms.call = e)"
          ></circle-checkbox>
        </li>
      </ul>
      <div class="col-lg-5 m-auto text-center p-1">
        <div class="form-group">
          <button
            type="button"
            class="btn w-100 btn-primary mt-2"
            @click="send()"
          >
            SAVE
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Notification from "@/config/Notification";
import Dashboard from "@/config/Services/Dashboard";
export default {
  data() {
    return {
      alarms: this.$store.state.user.settings.allowed_alarms,
    };
  },
  methods: {
    async send() {
      await Dashboard.alerts(this.alarms).then(({ data }) => {
        Notification.addNotification(data.response.message, true);
      });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables";
ul.manage {
  li {
    color: $secondary;
    padding: 5px 0;
    list-style-type: none;
    font-size: 15px;
 }

  li:not(:last-child) {
    border-bottom: 3px solid $gray-50;
  }
}
h5{
  font-size: 17px;
}
</style>
