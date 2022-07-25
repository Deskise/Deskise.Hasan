<template>
  <div class="bg-gray-e bg-hover-gradiant text-center h-100 w-100 d-flex package">
    <div class="head">
      <p class="text-gray name mb-0">
        {{ pack.name }}
      </p>
      <p class="price text-bold">
        {{ pack.price }}
      </p>
    </div>
    <perfect-scrollbar class="body">
      <div class="my-3 text-gray">
        {{ pack.details }}
      </div>
    </perfect-scrollbar>
    <div class="end text-gray mt-3">
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
  border:1px solid #eee;

  .head {
    position: relative;
    .name{
        @media (max-width: 1400px) {
          font-size: 16px;
    }
    }
    .price {
      font-size: 60px;
      position: relative;
      width: fit-content;
      margin:  0 auto;
       @media (max-width: 1400px) {
          font-size: 33px;
    }
      &::before {
        content: "$";
        font-size: 27px;
        font-weight: 100;
        position: absolute;
        top: 0px;
        left: -15px;
         @media (max-width: 1400px) {
          font-size: 22px;
    }
      }
    }

    &::after {
      content: "";
      height: 1px;
      width: 70%;
      background: #eee;
      position: absolute;
      bottom: 0;
      left: 15%;
    }
  }

  .body {
    height: 400px;
     @media (max-width: 1400px) {
       height: 300px;
       padding:0px 20px;
        font-size: 16px!important;
    }
     @media (max-width: 768px) {
       height: 210px;
       padding:0px 20px;
    }
     @media (max-width: 567px) {
        height: 200px;
    }
  }

  .end {
    position: relative;

    p {
      margin: 0;
       @media (max-width: 1400px) {
        font-size: 18px!important;
        margin-top: 10px;
    }
    }

    &::before {
      content: "";
      height: 1px;
      width: 70%;
      background: #eee;
      position: absolute;
      top: 0;
      left: 15%;
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
