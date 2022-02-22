<template>
  <div class="product">
    <div :class="'tag ' + product.status.toLowerCase()">
      {{ product.status }}
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
            class="btn btn-outline-primary w-100"
            v-if="!stopSelling"
          >
            {{ __("see") }}
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
            {{ product.price }}$ <span class="old-price">300$</span>
          </p>
          <p class="id">#{{ product.id }}</p>
        </div>
        <p class="description">{{ product.details.substring(0, 220) }}</p>
      </div>
      <div class="footer border-top">
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
export default {
  props: {
    product: {
      type: Object,
      required: true,
    },
    stopSelling: {
      type: Boolean,
      defualt: false,
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
.product {
  background: white;
  box-shadow: 0 0 20px rgba($color: #c9c9c9, $alpha: 0.16);
  border-radius: 20px;
  padding: 10px !important;
  text-align: left;
  position: relative;
  height: 100%;

  div.tag {
    position: absolute;
    width: 80px;
    height: 30px;
    left: 0;
    top: 30px;
    border-radius: 0 5px 5px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 16px;
    text-transform: capitalize;

    &.sold {
      background: $gray;
    }
    &.available {
      background: $primary;
    }
  }

  img {
    width: 100%;
    height: 400px;
    border-radius: 20px;
  }
  .body {
    padding-left: 10px;
    font-size: 18px;
    color: #9d9d9d;

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
        }
      }
      h5 {
        font-weight: bold;
        font-size: 20px;
        color: #040506;
      }
      .btn {
        font-size: 20px;
        padding: 5px 11px;
      }
      .price {
        color: $primary;
        font-size: 20px;
        font-weight: bold;
        .old-price {
          color: $gray;
          font-size: 16px;
          font-weight: normal;
          text-decoration: line-through;
        }
      }
      .id {
        text-align: right;
        padding-right: 30px;
      }
      .description {
        line-height: 20px;
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
