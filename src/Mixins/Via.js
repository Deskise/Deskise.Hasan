import LoginService from "../config/Services/Auth/LoginService";
import SignupService from "../config/Services/Auth/SignupService";
import Notification from "../config/Notification";
import store from "../store";
import router from "../router";
export const Via = {
  // mounted() {
  //   this.h.on("auth.login", (auth) => {
  //     console.log(auth.network + ": " + auth.authResponse.access_token);
  //   });
  // },
  methods: {
    async login($service, email, password, remember_me) {
      if ($service.toLowerCase() !== "email")
        return this.h($service)
          .login({
            scope: "email",
          })
          .then(
            (res) => {
              LoginService.via(res.network, res.authResponse.access_token).then(
                ({ data }) => this.loginCallback(data)
              );
            },
            (err) => Notification.addNotification(err.error.message, false)
          );

      return await LoginService.login(email, password, remember_me).then(
        ({ data }) => this.loginCallback(data),
        (err) => Notification.addNotification(err.error.message, false)
      );
    },
    loginCallback(data) {
      store.dispatch("user/setUserData", {
        data: data.response.extra.user,
      });
      store.dispatch("user/setToken", {
        token: data.response.extra.access_token,
        type: data.response.extra.token_type,
        exp: data.response.extra.expires_at,
      });
      Notification.addNotification(data.response.message, true);
      //TODO: CHECK PASSWORD AND OTHER PROFILE DATA AND REDIRECT USER TO COMPLETE PROFILE FIRST
      router.push(this.$route.query.redirect ?? { name: "products" });
    },

    async signup(
      $service,
      newsletter_subscribe,
      terms,
      firstname,
      lastname,
      email,
      password,
      uuid = store.state.user.uuid
    ) {
      if ($service.toLowerCase() !== "email")
        return this.h($service)
          .login({
            scope: "email",
          })
          .then(
            async () => {
              await this.h($service)
                .api("me")
                .then(
                  (res) => {
                    let google_id = $service === "google" ? res.id : null,
                      facebook_id = $service === "facebook" ? res.id : null;

                    return SignupService.signup(
                      res.first_name,
                      res.last_name,
                      res.email,
                      true,
                      true,
                      uuid,
                      null,
                      google_id,
                      facebook_id,
                      res.picture
                    ).then(
                      ({ data }) => this.signupCallback(data),
                      (err) =>
                        Notification.addNotification(err.error.message, false)
                    );
                  },
                  (err) =>
                    Notification.addNotification(err.error.message, false)
                );
            },
            (err) => Notification.addNotification(err.error.message, false)
          );

      return await SignupService.signup(
        firstname,
        lastname,
        email,
        newsletter_subscribe,
        terms,
        uuid,
        password
      ).then(
        ({ data }) => this.signupCallback(data),
        (err) => Notification.addNotification(err.error.message, false)
      );
    },

    signupCallback(data) {
      console.log(data.response.extra[0].email, data);
      Notification.addNotification(data.response.message, true);
      router.push({
        name: "verify",
        query: { email: data.response.extra[0].email },
      });
    },
  },
};
