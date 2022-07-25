<template>
  <div class="single-post">
    <div class="container">
    <div class="w-100 row data mb-5">
      <div class="col-12 offset-md-2 offset-lg-0 col-md-8 col-lg-6">
        <img :src="post.img" alt="image" class="h-100 w-100" />
      </div>
      <div class="col-12 col-md-12 col-lg-6 h-100 text px-2 px-md-5 pe-md-2">
        <div class="actions d-flex flex-column align-items-end w-100">
          <div class="exit" @click="$router.push({ name: 'blog' })">
            <flat-icon-component icon="cross" />
          </div>
          <div class="like" @click="like">
            <flat-icon-component
              icon="heart"
              :type="post.liked ? 'solid' : 'rounded'"
            />
            <p>{{ post.likes }}</p>
          </div>
        </div>
        <div class="d-flex flex-column justify-content-end">
          <h5>{{ post.title }}</h5>
          <p class="date" v-date="post.date"></p>
          <perfect-scrollbar class="content">
            {{ post.details }}
          </perfect-scrollbar>
        </div>
      </div>
    </div>
    <div class="blog-posts row pt-5">
      <h2 class="mb-5">Similer</h2>
      <div
        class="col-12 col-md-6 col-lg-4 col-xl-3"
        v-for="(item, index) in posts"
        :key="index"
      >
        <blog-post :post="item"></blog-post>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
import BlogPost from "@/components/Blog/BlogPost.vue";
export default {
  props: {
    id: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      post: this.$store.state.blog.SinglePostData[this.id],
    };
  },
  methods: {
    async like() {
      await this.$store.dispatch("blog/LikePost", this.post);
      if (!this.$store.state.blog.SinglePostData[this.id].liked) {
        this.$store.state.blog.SinglePostData[this.id].liked = true;
        this.$store.state.blog.SinglePostData[this.id].likes++;
      } else {
        this.$store.state.blog.SinglePostData[this.id].liked = false;
        this.$store.state.blog.SinglePostData[this.id].likes--;
      }
    },
  },
  computed: {
    posts() {
      return this.post.similar.data;
    },
  },
  components: {
    BlogPost,
  },

  async beforeRouteUpdate(to, from, next) {
    if (
      this.$store.state.blog.SinglePostData === [] ||
      this.$store.state.blog.SinglePostData[to.params.id] === undefined
    ) {
      await this.$store.dispatch("blog/fetchOne", { id: to.params.id });
    }
    this.post = this.$store.state.blog.SinglePostData[to.params.id];

    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0;
    next();
  },
};
</script>

<style lang="scss" scoped>
.single-post {
  background: white;
  margin: 0!important;
  margin-top: 120px!important;
  height: unset!important;
  .data {
    margin: 0  0 20px 0;
    & > div:first-of-type{
      border-radius: 10px;
      background: #fff;
      padding: 10px;
      box-shadow: 2px 3px 7px #f0f0f0;
      height: 500px;
      img{
        border-radius: 10px!important;
      }
    }
    .text {
      height: 100%;
      position: relative;

      .actions {
        height: auto;
        div {
          width: 40px;
          height: 40px;
          display: flex;
          justify-content: center;
          align-items: center;
          cursor: pointer;
          border-radius: 50%;
          margin: 5px;
          margin-bottom: 10px;
          @media (max-width: 1410px) {
          width: 35px;
          height: 35px;
         }
          * {
            transform: translateY(12%);
            @media (max-width: 1410px) {
          font-size: 14px;
                      transform: translateY(9%);
         }
          }
        }
        .exit {
          background: #fb5b5b;
          color: white;
        }
        .like {
          background: transparent;
          color: #c9c9c9;
          border: 1px solid #c9c9c9;
          position: relative;
          p {
            position: absolute;
            margin: 0;
            bottom: -20px;
          }
        }
      }

      div:not(.actions, .exit, .like) {
        text-align: left;
        h5 {
          font-weight: bold;
          font-size: 38px;
          color: #040506;
          @media (max-width: 1410px) {
          font-size: 27px;
         }
        }
        p.date {
          font-size: 18px;
          color: #9d9d9d;
          @media (max-width: 1410px) {
          font-size: 14px;
         }
        }
        .content {
          font-size: 18px;
          color: #9d9d9d;
          height: 320px;
          overflow: scroll;
          margin-bottom: 0;
          @media (max-width: 1410px) {
          font-size: 16px;
          padding-right: 10px;
         }
        }
      }
    }
  }

  .blog-posts {
    h2 {
      font-size: 60px;
      color: #040506;
       @media (max-width: 1410px) {
      font-size: 50px;
}
    }
  }
}
</style>
