export const mixin = {
  data() {
    return {
      scrolledToBottom: true, // make sure it's set to true
      isLoading: false,
    };
  },
  methods: {
    async scroll(data, func) {
      document
        .querySelector(".ps")
        .addEventListener("ps-y-reach-end", async () => {
          let next_page_url = this.$store.state;
          data.split(".").forEach((element) => {
            next_page_url = next_page_url[element];
          });
          next_page_url = next_page_url.next_page_url;

          if (next_page_url !== null && this.scrolledToBottom) {
            this.scrolledToBottom = false;
            this.isLoading = true;
            func();
          }
        });
    },
  },
};
