import { Vue } from "@/init";
import Echo from "laravel-echo";
import store from "@/store";

if (store.getters["user/isLoggedIn"]) {
  window.Pusher = require("pusher-js");
  const echo = new Echo({
    broadcaster: "pusher",
    key: process.env.VUE_APP_ECHO_KEY,
    wsHost: process.env.VUE_APP_ECHO_HOST,
    httpHost: process.env.VUE_APP_ECHO_HOST,
    authEndpoint: process.env.VUE_APP_ECHO_AUTHENDPOINT,
    wsPort: process.env.VUE_APP_ECHO_PORT,
    forceTLS: false,
    disableStats: true,
    auth: {
      headers: {
        Authorization:
          "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNGY5MDMxYmVkNjI0MjI3N2E4NTM1YmZjNjczYmM2NTE1YzM3MmUzM2JmYTA3YTY0MmQ3NTMzZmJhMDFkMTJmYzM1YTg1M2E5YzhlZjVlNzciLCJpYXQiOjE2NDAxNjMzNTQuMTQ0MDEsIm5iZiI6MTY0MDE2MzM1NC4xNDQwMTMsImV4cCI6MTY3MTY5OTM1NC4wOTgxMzIsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.jyn6i99rX_1Cuc9lg0PWBFH_byah9E4fMMIYFyLSa9JVFcZeEPiERhwwUHQboNd-XzinEs-7Dx9cJNCQXgFLn93W1p327fDWGAlzfUuvfUJcDgu8tJPigwUq1K9KGpaPaUtUx37T75lOuIXGGKN5s5fZ5mYOT8tF7W5KR-NInV0JGAxLLq8xkKajgGCkPYgmU7SoylmVP6qDnW94yoXBWFmP8JRGGmk9k817k19-VZNYuwSVgZqkmkm3eUc-4hc6DRwU9y7Nuf6Bw22ky7uka1Yd_UnEYxe62SQDfdS6T04Nslh8E_jjUEmI8Tfso_omrqbmDPYqdI-ZUv4UUihIhOyNQ5bHSjj-Rs_hzAmls-E11Y5yd8GtKSAzxnbieyRHR5YL3YnP088Z327GYRjqzkCAYhcsUy77K9R-BPLC5JCvEYSaHJtEdmjgQa7iPEZr6HdwXE7QDwRoq2WtCShOFQWvoxQ0KR2HIrViBg5ksF2mQZAXtGfZnp30EWLLVlnniiBaObRM7f8tRp98CcxMuH1DfF4CPS0czQ8DZgmq9W_-UHH6DuYBVmvamHSrmNrqupXXT-H6DPJOUOCcb8_A_aZ3uc70roaCKMM2iNKuJdOY-A_ZC_r_KqEW_ijbZp3tTnVicpzfwHDB-MPXZIj7vuDUcCJLkm_1TmGbtZpubuA",
        Accept: "application/json",
      },
    },
  });

  Vue.config.globalProperties.Echo = echo;
  window.Echo = echo;
}
