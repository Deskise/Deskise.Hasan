<template>
  <div>
    <div class="col-lg-12 p-1" v-for="(link, index) in links" :key="index">
      <input
        type="text"
        class="form-control"
        :placeholder="`Your ${
          socialMedia.filter((e) => e.id === link.social_id)[0].name
        } Link...`"
        :style="style"
        :id="id(link)"
        :title="socialMedia.filter((e) => e.id === link.social_id)[0].name"
        v-model="link.link"
        @keydown="$event.target.classList.remove('invalid')"
      />
    </div>

    <div class="col-lg-12 p-1">
      <div id="items"></div>
      <div class="add-input">
        <input
          id="textinput"
          type="text"
          class="form-control mb-2"
          :style="style"
        />
        <button
          class="btn add-more bg-transparent"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#add"
        >
          <flat-icon-component icon="plus" type="b"></flat-icon-component>
        </button>
      </div>
    </div>
  </div>
  <confirm
    id="add"
    :title="$t('addSocialMediaAccount')"
    submit="Add"
    close="close"
    desc="lorem"
    :options="socialMedia"
    :selectedOpt="links.map(({ social_id }) => social_id)"
    @submit="(e) => $emit('submit', e)"
  ></confirm>
</template>

<script>
import { mapState } from "vuex";

export default {
  props: {
    links: {
      type: Array,
      default: () => [],
    },
    id_prefix: {
      type: String,
      default: "",
    },
    style: {
      type: String,
      default: "",
    },
  },
  computed: {
    ...mapState("user", ["socialMedia"]),
  },
  methods: {
    id(link) {
      return `${this.id_prefix}_${link.social_id}`;
    },
  },
};
</script>

<style lang="scss" scoped>
.add-input {
  position: relative;
  .add-more {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    @media (max-width: 1400px) {
      max-width: 400px !important;
      width: 400px !important;
    }
    @media (max-width: 992px) {
      max-width: 80% !important;
      width: 80% !important;
    }
    @media (max-width: 576px) {
      max-width: 100% !important;
      width: 100% !important;
    }
  }
}
</style>