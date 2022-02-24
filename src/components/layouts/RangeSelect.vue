<template>
  <div class="price-range">
    <div class="range-title">{{ name }}</div>
    <div :id="`slider-range-${uid}`"></div>
    <div class="min-max-range">
      <div class="caption">
        <span :id="`slider-range-min-${uid}`"></span>
      </div>
      <div class="text-right caption">
        <span :id="`slider-range-max-${uid}`"></span>
      </div>
    </div>
    <input type="hidden" name="min" value="" :id="`min-${uid}`" />
    <input type="hidden" name="max" value="" :id="`max-${uid}`" />
  </div>
</template>

<script>
import { v4 } from "uuid";
import noUiSlider from "@/assets/js/slider";
export default {
  //TODO: Return The Data
  data() {
    return {
      uid: v4(),
    };
  },
  mounted() {
    // console.log(slider);
    let format = wNumb({
      decimals: 0,
      thousand: ",",
      postfix: this.suffex,
    });
    let el = document.getElementById(`slider-range-${this.uid}`);
    noUiSlider.create(el, {
      start: [this.vstart, this.vend !== 0 ? this.vend : this.max],
      step: this.step,
      range: {
        min: [this.min],
        max: [this.max],
      },
      format: format,
      connect: true,
    });
    el.noUiSlider.on("update", (values) => {
      document.getElementById(`slider-range-min-${this.uid}`).innerHTML =
        values[0];
      document.getElementById(`slider-range-max-${this.uid}`).innerHTML =
        values[1];
      document.getElementById(`min-${this.uid}`).value = format.from(values[0]);
      document.getElementById(`max-${this.uid}`).value = format.from(values[1]);
    });
  },
  props: {
    name: {
      type: String,
      default: "",
    },
    min: {
      type: Number,
      default: 0,
    },
    max: {
      type: Number,
      default: 100,
    },
    step: {
      type: Number,
      default: 1,
    },
    vstart: {
      type: Number,
      default: 0,
    },
    vend: {
      type: Number,
      default: 0,
    },
    suffex: {
      type: String,
      default: "",
    },
  },
};
</script>

<style lang="scss">
.noUi-target,
.noUi-target * {
  touch-action: none;
  user-select: none;
  box-sizing: border-box;
}

.noUi-target {
  position: relative;
  direction: ltr;
}

.noUi-base {
  width: 100%;
  height: 100% !important;
  position: relative;
  z-index: 1;
  /* Fix 401 */
}

.noUi-origin {
  position: absolute;
  right: 0;
  top: 0;
  left: 0;
  bottom: 0;
}

.noUi-handle {
  position: relative;
  z-index: 1;
}

.noUi-stacking .noUi-handle {
  z-index: 10;
}

.noUi-state-tap .noUi-origin {
  transition: left 0.3s, top 0.3s;
}

.noUi-state-drag * {
  cursor: inherit !important;
}
.noUi-base,
.noUi-handle {
  transform: translate3d(0, 0, 0);
}

.noUi-horizontal {
  height: 10px;
}

.noUi-horizontal .noUi-handle {
  width: 23px;
  height: 23px;
  border-radius: 50%;
  left: -7px;
  top: -7px;
  background-color: #3eadb7;
}

.noUi-background {
  background: #d6d7d9;
}

.noUi-connect {
  background: #3eadb7;
  transition: background 450ms;
}

.noUi-origin {
  border-radius: 2px;
}

.noUi-target {
  border-radius: 2px;
}

.noUi-draggable {
  cursor: w-resize;
}

.noUi-vertical .noUi-draggable {
  cursor: n-resize;
}

.noUi-handle {
  cursor: default;
  box-sizing: content-box !important;
}

.noUi-handle:active {
  border: 8px solid #3eadb7;
  border: 8px solid rgba(53, 93, 187, 0.38);
  background-clip: padding-box;
  left: -14px;
  top: -14px;
}

/* Disabled state;
        */
[disabled].noUi-connect,
[disabled] .noUi-connect {
  background: #b8b8b8;
}

[disabled].noUi-origin,
[disabled] .noUi-handle {
  cursor: not-allowed;
}

.price-range {
  margin-bottom: 15px;
  .range-title {
    font-size: 20px;
    color: #040506;
    margin-bottom: 15px;
    text-align: left;
  }
  .min-max-range {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 15px;
    font-size: 20px;
  }
}
</style>
