<template>
  <div v-if="shouldRender" class="product">
    <div :class="'tag ' + product.status.toLowerCase()">
      {{ product.status.split("_").join(" ") }}
    </div>
    <div>
      <div class="image mb-2">
        <img :src="product.img" alt="image" />
      </div>
      <div class="body w-100">
        <div class="flexer">
          <h5 class="name mb-0">{{ product.name }}</h5>
          <router-link
            :to="{
              name: 'singleProduct',
              params: { id: product.id },
            }"
            class="btn btn-outline-primary mb-0"
            v-if="!stopSelling"
          >
            {{ $t("see") }}
          </router-link>
          <router-link
            :to="{
              name: 'Product.stop',
              params: { id: product.id },
            }"
            class="btn btn-outline-primary w-100"
            v-else
          >
            Stop Selling
          </router-link>
        </div>
        <div class="flexer">
          <p class="price">
            {{ product.price }}$
            <span class="old-price">{{ product.old_price }}$</span>
          </p>
          <p class="id">#{{ product.id }}</p>
        </div>
        <p class="description">{{ product.details ? product.details : product.summary  }}...</p>
      </div>
      <div
        :class="{
          footer: true,
          'border-top': product.verified || product.special,
        }"
      >
        <div class="icons">
          <div
            :class="{ verified: true, 'border-end': product.special }"
            v-if="product.verified"
          >
            <flat-icon-component
              icon="crown"
              class="icon"
            ></flat-icon-component>
            <span>Verified Deskise</span>
          </div>
          <div class="special" v-if="product.special">
            <flat-icon-component
              icon="shield-check"
              class="icon"
            ></flat-icon-component>
            <span> Special Item</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  props: {
    id: {
      type: Object,
      required: true,
    },
    best: {
      type: Boolean,
      defualt: false,
    },
    stopSelling: {
      type: Boolean,
      defualt: false,
    },
  },
  data() {
    return {
      shouldRender: false,
    };
  },
  computed: {
    ...mapState("product", ["products"]),
    ...mapState("product", ["similar"]),
    product() {

      if (this.$route.path.startsWith("/product/")) {
        return this.similar[this.id];
      } else {
        return this.products.data[this.id];
      }

      // if (this.$route.path.startsWith("/products/")) {
      //   return this.products.data[this.id];
      // } else if (this.$route.path.startsWith("/product/")) {
      //   return this.similar[this.id];
      // } else {
      //   return null;
      // }
      // return this.similar[this.id]
      // return this.products.data[this.id]
      // return this.products.single[this.id].similar
      // let s = this.$store.state.product;
      // return s.products.data[this.id]
      // return !this.best ? s.products.data[this.id] : s.best.data[this.id];
    },
  },
  // async beforeRouteUpdate(to, from, next) {
  //   try {
  //     await this.$store.dispatch("product/single", { id: to.params.id });
  //     if (this.product) {
  //       next()
  //     } else {
  //       next(false)
  //     }
  //   } catch (err) {
  //     console.log(err);
  //   }
  // },
  //  mounted (){
  //    this.$store.dispatch('product/list', {page:2, category:0})
  // },
  watch: {
    id: {
      immediate: true,
      handler(newVal, oldVal) {
        if (newVal !== oldVal) {
          // Update shouldRender based on product existence
          this.shouldRender = Boolean(this.product);
        }
      },
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
.product {
  background: white;
  box-shadow: 3px 3px 10px #f1f1f1;
  border-radius: 20px;
  padding: 10px !important;
  text-align: left;
  position: relative;
  height: 100% !important;
  border: 1px solid #eee;
  margin: 5px;
  overflow-y: hidden;
  div.tag {
    position: absolute;
    width: 100px;
    height: 30px;
    left: -2px;
    top: 30px;
    border-radius: 0 5px 5px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 15px;
    text-transform: capitalize;

    &.sold {
      background: $gray;
    }
    &.available {
      background: $primary;
    }
    &.expired {
      background: #dc3545;
    }
    &.canceled {
      background: #dc3545;
    }
    &.under_verify {
      background: #ffc107;
    }
  }

  img {
    width: 100%;
    height: 300px;
    border-radius: 20px;
    object-fit: cover;
    @media (max-width: 1410px) {
      height: 300px;
    }
  }
  .body {
    padding-left: 10px;
    font-size: 16px;
    color: #9d9d9d;
    @media (max-width: 1410px) {
      font-size: 15px;
    }
    div {
      &.flexer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        & > *:first-child {
          flex-shrink: 1;
        }
        & > *:last-child {
          flex-shrink: 0;
          flex-basis: 38%;
          @media (max-width: 1410px) {
            flex-basis: 29%;
          }
        }
      }
      h5 {
        font-weight: bold;
        font-size: 18px;
        color: #040506;
        @media (max-width: 1410px) {
          font-size: 15px;
          margin-bottom: 5px;
        }
      }
      .btn {
        font-size: 16px;
        padding: 5px 11px;
        @media (max-width: 1410px) {
          font-size: 13px;
          padding: 3px;
          margin-bottom: 5px;
        }
      }
      .price {
        color: $primary;
        font-size: 16px;
        font-weight: bold;
        @media (max-width: 1410px) {
          font-size: 14px;
          margin-bottom: 0px;
        }
        .old-price {
          color: $gray;
          font-size: 16px;
          font-weight: normal;
          text-decoration: line-through;
          @media (max-width: 1410px) {
            font-size: 12px;
            margin-left: 5px;
          }
        }
      }
      .id {
        text-align: right;
        padding-right: 30px;
        @media (max-width: 1410px) {
          padding-right: 10px;
          margin-bottom: 0px;
          font-size: 14px;
        }
      }
    }
    .description {
      line-height: 18px;
      font-size: 14px !important;
      @media (max-width: 1410px) {
        font-size: 13px !important;
        margin-bottom: 20px;
      }
    }
  }
  .footer {
    display: flex;
    align-items: center;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 92%;
    margin: 0 4%;
    padding-top: 2%;
    background: white;
    box-shadow: 0 0 20px 15px white;

    .icons {
      display: flex;
      justify-content: center;
      width: 100%;

      div {
        padding: 2% 3%;
        font-size: 16px;
        color: #040506;
        text-transform: capitalize;
        border-color: #c9c9c9;
        @media (max-width: 1410px) {
          font-size: 12px;
          font-weight: 700;
          padding-bottom: 5%;
        }
        .icon {
          height: 28px;
          width: 28px;
          border: 1px solid #040506;
          border-radius: 50%;
          display: flex;
          justify-content: center;
          align-items: center;
          float: left;
          margin-right: 5px;
          @media (max-width: 1410px) {
            height: 20px;
            width: 20px;
          }
        }
        span {
          position: relative;
          top: 3px;
        }
      }
    }
  }
}
</style>
