<template>
  <div class="categories mt-4">
    <div
      :class="{
        'category p-3 px-1 px-xl-5': true,
        active: this.category === 0 && this.cat == 0,
      }"
      @click="doAction(0)"
    >
      <h4>All</h4>
    </div>
    <div
      v-for="(item, index) in categories"
      :key="index"
      :class="{
        'category p-3 px-1': true,
        active: this.category === item.id || this.cat == item.id,
      }"
      @click="doAction(item.id)"
    >
      <h4>{{ item.name }}</h4>
    </div>
  </div>
</template>

<script>
//TODO: Make This As Slider
import { mapGetters } from "vuex";
export default {
  props: {
    link: {
      type: String,
      default: "",
    },
    cat: {
      type: String,
      default: "0",
    },
  },
  computed: {
    ...mapGetters("category", ["categories"]),
  },
  data() {
    return {
      category: 0,
    };
  },
  methods: {
    doAction(id) {
      if (this.link !== "")
        return this.$router.push({ name: this.link, params: { id } });
      else {
        this.category = id;
        this.$emit("category", id);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.categories {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  .category {
    border-radius: 5px;
    background: transparent;
    padding: 10px !important;
    margin: 5px;
    border: 1px solid #eee;
    color: #040506;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    &.active {
      background: #4e1b56;
      color: #fff;
    }
  }
}

h4 {
  font-size: 18px;
  text-transform: capitalize;
  width: 100%;
  margin-bottom: 0px;
  @media (max-width: 1410px) {
    font-size: 13px !important;
  }
}
</style>
