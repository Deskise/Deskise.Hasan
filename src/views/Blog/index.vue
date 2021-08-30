<template>
    <div class="Blog">
        <div class="container-fluid mb-5">
            <search />
            <div class="blog my-5">
                <div class="categories">
                    <category-list />
                </div>
                <div class="blog-posts">
                    <blog-post></blog-post>
                </div>
            </div>

            <loadMore v-if="isLoading" class="my-5" />
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import { mixin as loadOnBottom } from "@/Mixins/loadOnBottom.js";
import BlogPost from "@/components/Blog/BlogPost.vue";

export default {
    components: { BlogPost },
    mounted() {
        this.scroll(async () => {});
    },
    mixins: [loadOnBottom],
    data() {
        return {
            classes: false,
            search: null,
        };
    },
    methods: {},
    computed: {
        ...mapState("data", ["faq"]),
    },
};
</script>

<style lang="scss" scoped>
.Blog > div.container-fluid {
    padding: 0 8%;
}
</style>
