<template>
  <div class="bg-gray-e bg-hover-gradiant text-center h-100 d-flex package">
    <div class="head">
      <p class="text-gray mb-0">
        {{ pack.name }}
      </p>
      <p class="price text-bold">
        {{ pack.price }}
      </p>
    </div>
    <div class="body my-3 text-gray">
      {{ pack.details }}
    </div>
    <div class="end text-gray">
      <p>{{ pack.quantity }} {{ pack.duration }}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    pack: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
.package {
  flex-direction: column;
  justify-content: space-between;
  padding: 17px 5px;
  border-radius: 10px;
  text-transform: capitalize;

  .head {
    position: relative;
    .price {
      font-size: 60px;
      position: relative;
      width: fit-content;
      margin: auto;

      &::before {
        content: "$";
        font-size: 27px;
        font-weight: 100;
        position: absolute;
        top: 15px;
        left: -15px;
      }
    }

    &::after {
      content: "";
      height: 1px;
      width: 50%;
      background: $gray;
      position: absolute;
      bottom: 0;
      left: 25%;
    }
  }

  .body {
    height: 400px;
    overflow-y: scroll;
  }

  .end {
    position: relative;

    p {
      margin: 0;
    }

    &::before {
      content: "";
      height: 1px;
      width: 50%;
      background: $gray;
      position: absolute;
      top: 0;
      left: 25%;
    }
  }

  &:hover {
    p,
    div {
      color: white !important;
    }
    .head {
      &::after {
        background: white;
      }
    }
    .end {
      &::before {
        background: white;
      }
    }
  }
}
</style>
