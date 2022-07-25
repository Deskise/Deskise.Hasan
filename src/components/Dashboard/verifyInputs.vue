<template>
  <div class="form-verification mb-3">
    <label for="">{{ text }}</label>
    <div class="row m-0">
      <div class="col-lg-9 p-1">
        <input
          type="text"
          class="form-control"
          placeholder="Write Something Here"
          style="font-size: 90%"
          :value="data"
          @change="$emit('change', $event.target.value)"
          :disabled="!condition"
        />
        <circle-checkbox
          class="checkCondion"
          :value="true"
          :isReadonly="true"
          :text="`${text} Verified`"
          v-if="!condition"
        ></circle-checkbox>
      </div>
      <div class="col-lg-3 m-auto text-center p-1">
        <button
          type="button"
          class="btn w-100 btn-primary"
          v-if="condition"
          @click="$emit('send', $event)"
        >
          Send
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    text: {
      type: String,
      default: "",
    },
    data: {
      type: String,
      default: "",
    },
    condition: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style lang="scss" scoped>
.form-verification label{
  font-size: 14px;
}
.form-verification .checkCondion{
  font-size: 12px;
}
</style>
