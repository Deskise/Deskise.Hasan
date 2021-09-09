<template>
  <div class="single-post container-fluid">
    <div class="w-100 row data">
      <div class="col-md-6 h-100">
        <img src="@/assets/blog1.png" alt="image" class="h-100" />
      </div>
      <div class="ms-5 col-md-5 h-100 text">
        <div class="actions d-flex flex-column align-items-end w-100">
          <div class="exit">
            <flat-icon-component icon="cross" @click="this.$router.back()" />
          </div>
          <div class="like" @click="like">
            <flat-icon-component icon="heart" />
          </div>
        </div>
        <div class="d-flex flex-column justify-content-end">
          <h5>{{ post.title }}</h5>
          <p class="date" v-date="post.date"></p>
          <p class="content">
            {{ post.details }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
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
    like() {
      this.$store.state.blog.SinglePostData[this.id].title = "hi";
    },
  },
};
</script>

<style lang="scss" scoped>
.single-post {
  padding: 20px 7%;
  background: white;

  .data {
    height: calc(100vh - 180px);

    .text {
      height: 100%;
      position: relative;

      .actions {
        position: absolute;

        div {
          width: 40px;
          height: 40px;
          display: flex;
          justify-content: center;
          align-items: center;
          cursor: pointer;
          border-radius: 50%;
          margin: 5px;

          * {
            transform: translateY(12%);
          }
        }
        .exit {
          background: #fb5b5b;
          color: white;
        }
        .like {
          background: transparent;
          color: black;
          border: 1px solid black;
        }
      }

      div:not(.actions, .exit, .like) {
        height: 100%;
        text-align: left;
        max-height: 100%;
        h5 {
          font-weight: bold;
          font-size: 38px;
          color: #040506;
        }
        p.date {
          font-size: 18px;
          color: #9d9d9d;
        }
        .content {
          font-size: 18px;
          color: #9d9d9d;
          height: 70%;
          overflow: scroll;
          margin-bottom: 0;
        }
      }
    }
  }
}
</style>
