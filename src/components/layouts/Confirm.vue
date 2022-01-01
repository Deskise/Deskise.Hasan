<template>
  <div class="modal fade m-auto text-center p-5" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content pt-3 border-0">
        <div class="modal-body mb-0">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="67.607"
            height="75.129"
            viewBox="0 0 67.607 81.129"
          >
            <g id="fi-rr-shield-check" transform="translate(-2 0)">
              <path
                id="Path_55921"
                data-name="Path 55921"
                d="M58.049,7.235,36.872.173a3.38,3.38,0,0,0-2.136,0L13.557,7.235A16.878,16.878,0,0,0,2,23.267v17.3C2,66.13,33.1,80.25,34.431,80.838a3.38,3.38,0,0,0,2.745,0c1.332-.588,32.431-14.708,32.431-40.273v-17.3A16.878,16.878,0,0,0,58.049,7.235Zm4.8,33.33C62.846,59,41.486,71.1,35.8,73.993,30.114,71.109,8.761,59.052,8.761,40.565v-17.3a10.141,10.141,0,0,1,6.936-9.62L35.8,6.944l20.106,6.7a10.141,10.141,0,0,1,6.936,9.62Z"
                transform="translate(0 0)"
                fill="#3eadb7"
              />
              <path
                id="Path_55922"
                data-name="Path 55922"
                d="M34.747,9,20.59,23.2,13,15.285a3.38,3.38,0,1,0-4.871,4.685l7.8,8.113a6.328,6.328,0,0,0,4.547,2.028h.112A6.331,6.331,0,0,0,25.1,28.242L39.541,13.8A3.393,3.393,0,1,0,34.747,9Z"
                transform="translate(12.211 19.059)"
                fill="#3eadb7"
              />
            </g>
          </svg>
          <h2 class="text-capitalize font-weight-bold mt-2">{{ title }}</h2>
          <p>
            {{ desc }}
          </p>
          <div
            class="align-items-center d-flex flex-column"
            v-if="options !== []"
          >
            <circle-checkbox
              v-for="option in options"
              :key="option.id"
              :value="selectedOpt.includes(option.id) || selected === option.id"
              :text="option.name"
              isReadonly
              @click="selected = option.id"
              class="d-flex justify-content-start w-50"
            ></circle-checkbox>
          </div>
        </div>
        <div
          class="modal-footer d-flex justify-content-center pb-4 border-0 pt-0"
        >
          <div class="col-lg-4 buttons-close p-0">
            <button
              type="button"
              :class="`btn w-100 ${submitClass}`"
              data-bs-dismiss="modal"
              @click="$emit('submit', selected)"
            >
              {{ submit }}
            </button>
          </div>
          <div class="col-lg-4 p-0">
            <button
              type="button"
              :class="`btn w-100 ${closeClass}`"
              data-bs-dismiss="modal"
              @click="$emit('close', $event)"
            >
              {{ close }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    desc: {
      type: String,
      required: true,
    },
    submit: {
      type: String,
      required: true,
    },
    submitClass: {
      type: String,
      default: "btn-primary",
    },
    close: {
      type: String,
      required: true,
    },
    closeClass: {
      type: String,
      default: "btn-outline-secondary",
    },
    options: {
      type: Array,
      default: () => [],
    },
    selectedOpt: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      selected: 0,
    };
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables";
.font-weight-bold {
  font-weight: 700;
}
p {
  width: 70%;
  margin: auto;
  color: #c9c9c9;

  @media (min-width: $minLarge) {
    width: 82%;
  }
}
</style>
