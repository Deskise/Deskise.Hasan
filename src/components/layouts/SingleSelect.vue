<template>
  <div class="drop-down">
    <div class="drop-down-title" @click="toggle">
      <span class="title">{{ getName }}</span>
      <span class="icon">
        <flat-icon-component
          :icon="arrow"
          type="b"
          straight
        ></flat-icon-component>
      </span>
    </div>
    <ul class="drop-down-items">
      <li :class="{ disabled: true, active: active === '' }" @click.prevent>
        <a href="javascript:void(0)">{{ placeholder }}</a>
      </li>
      <li
        v-for="(item, key) in NotNullData"
        :key="key"
        :class="{ active: active === item[0] }"
        @click="closeSelect"
      >
        <a href="javascript:void(0)" @click.prevent="choose(item[0])">
          {{ item[1] }}
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    placeholder: {
      type: String,
      default: "",
    },
    data: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      active: "",
      arrow: "angle-down",
      displayed: false,
      itemsMaxHeight: 0,
    };
  },
  computed: {
    NotNullData() {
      return this.data.filter((e) => e !== null && e !== undefined);
    },
    getName() {
      return this.active === ""
        ? this.placeholder
        : this.NotNullData.filter((e) => e[0] === this.active)[0][1];
    },
  },
  methods: {
    maxHeight() {
      if (this.itemsMaxHeight === 0)
        this.itemsMaxHeight =
          this.$el.querySelector(".drop-down-items").clientHeight;
    },
    closeSelect() {
      this.$el.querySelector(".drop-down-title").click();

    },
    toggle() {
      this.$el.classList.toggle("active");
      this.arrow = this.arrow === "angle-down" ? "angle-up" : "angle-down";
      this.displayed = !this.displayed;
    },
    choose(e) {
      this.active = e;
      this.$emit("choose", e);
    },
  },
  watch: {
    displayed(v) {
      let items = this.$el.querySelector(".drop-down-items");
      items.style.display = "block";
      this.maxHeight();
      items.style.height = 0;

      if (v) {
        setTimeout(() => {
          items.style.height = this.itemsMaxHeight + "px";
        }, 10);
      } else {
        setTimeout(() => {
          items.style.display = "none";
        }, 500);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
ul {
  list-style-type: none;
  padding: 0;
}
.drop-down {
  margin-bottom: 15px;
  &.active {
    .drop-down-items {
      border: 1px solid #ddd;
      border-radius: 4px;
    }
  }
  .drop-down-items {
    transition: all 0.35s ease-in-out;
    overflow: scroll;
    text-align: left;
    display: none;
    li {
      &.disabled {
        background-color: rgba(201, 201, 201, 0.23);
        a {
          cursor: not-allowed;
        }
      }
      &.active {
        background-color: rgba(201, 201, 201, 0.45);
      }
      a {
        display: block;
        color: #9d9d9d;
        font-size: 18px;
        padding: 10px 30px;
        text-transform: capitalize;
      }
    }
  }
  .drop-down-title {
    padding: 10px 18px;
    font-size: 20px;
    color: #040506;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 1px solid rgba(157, 157, 157, 0.23);
    border-radius: 5px;
    cursor: pointer;
    @media (max-width: 1410px) {
      font-size: 16px;
    }
  }
}
.drop-down .drop-down-items li a {
  @media (max-width: 1410px) {
    font-size: 15px !important;
  }
}
.icon {
  font-size: 12px;
}
</style>
