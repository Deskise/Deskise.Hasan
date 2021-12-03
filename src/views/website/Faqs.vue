<template>
  <div class="faqs">
    <div class="container-fluid mb-5">
      <search />
      <div class="row questions mb-5">
        <div>
          <question
            v-for="(item, index) in faq.data"
            :key="index"
            :item="item"
          />
        </div>
      </div>
      <loadMore v-if="isLoading" class="my-5" />
    </div>

    <support />
  </div>
</template>

<script>
import { mapState } from "vuex";
import question from "@/components/FAQ/Question.vue";
import Support from "@/components/FAQ/Support.vue";
import { mixin as loadOnBottom } from "@/Mixins/loadOnBottom.js";
export default {
  components: {
    question,
    Support,
  },
  mounted() {
    this.scroll("data.faq", async () => {
      await this.$store
        .dispatch("data/faqs", {
          page: this.faq.current_page + 1,
        })
        .then(() => {
          this.isLoading = false;
          this.scrolledToBottom = true;
        });
    });
  },
  data() {
    return {};
  },
  mixins: [loadOnBottom],
  methods: {},
  computed: {
    ...mapState("data", ["faq"]),
  },
};
</script>

<style lang="scss" scoped>
.faqs > div.container-fluid {
  padding: 0 8%;
  .questions {
    border: 1.5px solid rgba(#707070, 0.16);
    border-radius: 5px;
    padding: 10px;
    & > div:not(.vue-loaders) {
      border-radius: 5px;
      padding: 20px 10px;
      background-color: #f7f7f7;
    }
  }
}
</style>
