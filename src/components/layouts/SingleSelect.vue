<template>
  <div class="drop-down">
    <div class="drop-down-title" @click="toggle">
      <span class="title">{{ placeholder }}</span>
      <span class="icon">
        <flat-icon-component
          icon="angle-down"
          type="b"
          straight
        ></flat-icon-component>
      </span>
    </div>
    <ul class="drop-down-items">
      <li class="active">
        <a href="javascript:void(0)">{{ placeholder }}</a>
      </li>
      <li v-for="(item, key) in NotNullData" :key="key">
        <a href="javascript:void(0)">{{ item[0] + " " + item[1] }}</a>
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
  computed: {
    NotNullData() {
      console.log(this.data);
      return this.data.filter((e) => e !== null && e !== undefined);
    },
  },
  methods: {
    toggle(e) {
      e.preventDefault();
      let th = e.target;
      var container = th.nextSibling;
      while (container && container.nodeType != 1) {
        container = container.nextSibling;
      }
      //span then i
      var icon = th.children[1].children[0];

      if (!container.classList.contains("active")) {
        container.classList.add("active");
        container.style.height = "auto";

        icon.classList.add("fi-bs-angle-up");
        icon.classList.remove("fi-bs-angle-down");

        var height = container.clientHeight + "px";

        container.style.height = "0px";

        setTimeout(function () {
          container.style.height = height;
        }, 0);
      } else {
        container.style.height = "0px";
        container.addEventListener(
          "transitionend",
          function () {
            container.classList.remove("active");
            // toggle arrow icon

            icon.classList.add("fi-bs-angle-down");
            icon.classList.remove("fi-bs-angle-up");
          },
          {
            once: true,
          }
        );
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
  .drop-down-items {
    transition: height 0.35s ease-in-out;
    overflow: hidden;
    display: none;
    text-align: left;
    &.active {
      display: block;
    }
    li {
      &.active {
        background-color: rgba(201, 201, 201, 0.23);
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
  }
}
</style>
