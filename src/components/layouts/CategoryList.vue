<template>
  <div class="categories">
    <div
      :class="{ 'category p-3 px-5': true, active: this.category === 0 }"
      @click="
        this.category = 0;
        $emit('category', 0);
      "
    >
      <h4>All</h4>
    </div>
    <div
      v-for="(item, index) in categories"
      :key="index"
      :class="{ 'category p-3': true, active: this.category === item.id }"
      @click="
        this.category = item.id;
        $emit('category', item.id);
      "
    >
      <h4>{{ item.name }}</h4>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState("category", ["categories"]),
  },
  data() {
    return {
      category: 0,
    };
  },
};
</script>

<style lang="scss" scoped>
.categories {
  display: flex;
  flex-direction: row;

  .category {
    border-radius: 5px;
    background: transparent;
    color: #040506;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    margin-right: 5px;

    &.active {
      background: #4e1b56;
      color: #fff;
    }
  }
}

h4 {
  font-size: 18px;
  text-transform: capitalize;
}
</style>
