import apiClient from "@/axios";
import router from "@/router";
import store from "@/store";

export default {
  login,
  logout,
  apiAuthenticate,
};

async function login() {
  // login with facebook then authenticate with the API to get a JWT auth token
  let authResponse;
  await FB.login(
    (response) => {
      authResponse = response;
    },
    { scope: "public_profile,email" }
  );
  if (!authResponse) return;

  await apiAuthenticate(authResponse.accessToken);

  // get return url from query parameters or default to home page
  router.push("/");
}

function logout() {
  // revoke app permissions to logout completely because FB.logout() doesn't remove FB cookie
  FB.api("/me/permissions", "delete", null, () => FB.logout());
  router.push("/login");
}

async function apiAuthenticate(accessToken) {
  apiClient
    .post(`/auth/login/facebook`, {
      token: accessToken,
    })
    .then(({ data }) => {
      store.dispatch(
        "notification/add",
        {
          message: data.response.message,
          status: true,
        },
        { root: true }
      );

      const extra = data.response.extra;
      const user = extra.user;

      store.dispatch("user/setUserData", { data: user }, { root: true });
      store.dispatch(
        "user/setToken",
        {
          token: extra.access_token,
          type: extra.token_type,
        },
        { root: true }
      );
    })
    .catch((error) => {
      console.log(error);
    });
}
