import apiClient from "@/config/axios";

export default {
  signup(
    firstname,
    lastname,
    email,
    newsletter_subscribe,
    terms,
    uuid,
    password = null,
    google_id = null,
    facebook_id = null,
    image = null
  ) {
    return apiClient.post("/auth/signup", {
      firstname,
      lastname,
      email,
      password,
      newsletter_subscribe,
      terms,
      uuid,
      google_id,
      facebook_id,
      image,
    });
  },
};
