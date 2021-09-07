<template>
  <div class="Blog">
    <div class="container-fluid mb-5">
      <search />
      <div class="blog my-5">
        <div class="categories">
          <category-list class="my-5" />
        </div>
        <div class="blog-posts row">
          <div
            class="col-6 col-md-4 col-lg-3"
            v-for="(item, index) in posts"
            :key="index"
          >
            <blog-post :post="item"></blog-post>
          </div>
        </div>
      </div>

      <loadMore v-if="isLoading" class="my-5" />
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { mixin as loadOnBottom } from "@/Mixins/loadOnBottom.js";
import BlogPost from "@/components/Blog/BlogPost.vue";

export default {
  components: { BlogPost },
  mounted() {
    this.scroll("blog.Posts", async () => {
      await this.$store
        .dispatch("blog/fetch", {
          page: this.$store.state.blog.Posts.current_page + 1,
        })
        .then(() => {
          this.isLoading = false;
          this.scrolledToBottom = true;
        });
    });
  },
  mixins: [loadOnBottom],
  data() {
    return {
      category: 0,
    };
  },
  methods: {},
  computed: {
    ...mapGetters("blog", ["getPostsByCategoryId"]),
    posts() {
      return this.getPostsByCategoryId(this.category);
    },
  },
};
</script>

<style lang="scss" scoped>
.Blog > div.container-fluid {
  padding: 0 8%;
}
</style>
