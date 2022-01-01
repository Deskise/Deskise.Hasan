<template>
  <div>
    <div class="page-top account-settings">
      <section>
        <div class="section-1 cart course-details mb-4">
          <div class="container">
            <div class="mb-5">
              <div class="row">
                <sidebar :selected="getSelected"></sidebar>
                <div class="col-lg pb-2 mb-5">
                  <article
                    class="mb-4 bg-white p-2 p-lg-4 shadow-sm position-relative"
                  >
                    <router-view></router-view>
                  </article>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
import sidebar from "@/components/Dashboard/sidebar.vue";
export default {
  components: { sidebar },
  data() {
    return {};
  },
  computed: {
    getSelected() {
      let dash = this.$router.options.routes.filter(
        (e) => e.name === "dash"
      )[0];
      console.log();
      if (
        this.$route.path.match(
          dash.path +
            "/" +
            dash.children.filter((e) => e.name === "dashboard.sales")[0].path
        )
      )
        return 2;
      else if (
        this.$route.path.match(
          dash.path +
            "/" +
            dash.children.filter((e) => e.name === "dashboard.product")[0].path
        )
      )
        return 3;
      else return 1;
    },
  },
};
</script>

<style lang="scss">
@import "@/sass/_globals/_variables";
.account-settings {
  color: #040506;
  font-weight: 500;
  text-align: left;
  article {
    border-radius: 6px;
    background-color: white;
    border: 1px solid rgba(201, 201, 201, 0.23);
  }

  form input,
  form textarea,
  form select {
    background-color: #ffffff !important;
  }

  a {
    color: #040506;
    text-decoration: none;

    &:hover {
      color: $primary;
    }
  }

  input.invalid {
    border: 1px solid red;
    color: red;
    &::placeholder {
      color: red;
    }
  }
  label.invalid {
    color: red;
    span:first-of-type {
      border-color: red;
    }
  }
}
</style>
