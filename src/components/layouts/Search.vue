<template>
  <div class="d-flex search mb-3">
    <h2>
      {{ __("faqs.search") }}
    </h2>
    <div class="search-input d-flex">
      <input
        type="search"
        placeholder="Type Somethng ..."
        v-model="search"
        :class="{ shown: classes }"
      />
      <div class="icon bg-primary">
        <FlatIconComponent icon="search" @click="toggleSearch" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      classes: false,
      search: null,
    };
  },
  methods: {
    toggleSearch() {
      this.classes = !this.classes;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
.search {
  padding: 3px;
  justify-content: space-between;
  border-bottom: 1px solid $gray;
  h2 {
    color: #040506;
    font-size: 28px;
  }
  .search-input {
    justify-content: flex-end;
    width: stretch;
    input {
      transition: all 0.3s ease-in-out;
      width: 0;
      border: 0;
      &.shown {
        width: 30%;
        border-bottom: 1px solid;
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
      border-radius: 50%;
      cursor: pointer;
    }
  }
}
</style>
