<template>
  <div class="hi" @click="getClassNames">Click</div>
  <div class="icons container-fluid">
    <div class="row">
      <div class="col-2" v-for="(item, index) in icons" :key="index">
        <i :class="`fi-rr-` + item"></i>
        {{ item }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  setup() {
    let file = "/css/fonts/uicons-regular-rounded.css";
    if (document.querySelector('head link[href="' + file + '"]') === null) {
      let link = document.createElement("link");
      link.href = file;
      link.rel = "stylesheet";
      document.head.appendChild(link);
    }

    document.onload = function () {
      console.log("clicked");
      document.querySelector(".hi").click();
    };
  },
  data() {
    return {
      icons: [],
    };
  },
  methods: {
    getClassNames() {
      Array.from(document.styleSheets[document.styleSheets.length - 1].cssRules)
        .filter((e) => e.cssText.startsWith("."))
        .forEach((e) => {
          this.icons.push(
            e.cssText
              .substring(1, e.cssText.indexOf("::before"))
              .replace("fi-rr-", "")
          );
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.col-2 {
  background: white;
  padding: 5%;
  display: flex;
  flex-direction: column;
  border: 1px solid #9d9d9d;
  justify-content: center;
  align-items: center;
  i {
    font-size: 35px;
  }
}
</style>
