<template>
  <div class="d-flex search mb-3">
    <div class="search-input d-flex  mt-5">
      <input type="search" :placeholder="__('faqs.search')" v-model="search" @input="toggleSearch" />
      <!-- <div class="icon bg-primary">
        <FlatIconComponent icon="search" />
      </div> -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      search: null,
    };
  },
  methods: {
    toggleSearch() {
      this.$emit("searchHandler",this.search)
      this.$emit("searchposts",this.search)
      this.$emit("searchproducts",this.search)
      document.querySelector("input[type=search]").focus();
    },
    BlogSearch() {
      this.$emit("BlogSearch",this.search)
      document.querySelector("input[type=search]").focus();
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
.search {
  padding: 3px;
  justify-content: space-between;
@media (max-width: 1410px) {
        margin-top: 0px!important;
    }
  .search-input {
    justify-content: flex-end;
    width: stretch;
    position: relative;
    input {
      transition: all 0.3s ease-in-out;
      width: 100%;
      font-size: 28px;
      color: #040506;
      border: none;
      border-bottom: 1px solid rgba(137, 137, 137, 0.23);
      padding: 10px;
      padding-right: 60px;
      @media (max-width: 1410px) {
         font-size: 18px;
          padding:6px 10px;
    }
      &:focus {
        outline: 0;
      }
    }
    .icon {
      color: white;
      width: 40px;
      height: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 10%;
      cursor: pointer;
      position: absolute;
      top: calc(50% - 21px);
      right: 40px;
      @media (max-width: 1410px) {
         width: 35px;
      height: 35px;
    }
    }
  }
}
</style>
