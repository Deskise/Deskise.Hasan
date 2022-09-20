<template>
  <div class="step-content">
    <div class="dash-sell-form">
      {{ isLifeTime + "   " + until }}
      <div
        class="form-feilds"
        v-for="(field, index) in fields.divs"
        :key="index"
      >
        <div class="form-step-title">{{ field.title }}</div>
        <div class="form-step-fields">
          <div v-for="(f, index) in field.fields" :key="index">
            <single-select
              :placeholder="f.placeholder"
              :data="Object.keys(f.data ?? {}).map((e) => [e, f.data[e]])"
              v-if="f.type === 'drop_list'"
              @change="
                (e) => {
                  product[f.name] = e;
                }
              "
              :title="f.hint"
            ></single-select>

            <yn-select
              v-else-if="f.type === 'y_n'"
              :placeholder="f.placeholder"
              @change="
                (e) => {
                  product[f.name] = e;
                }
              "
              :title="f.hint"
            ></yn-select>

            <input
              type="url"
              :placeholder="f.placeholder"
              v-model="product[f.name]"
              v-else-if="f.type === 'url'"
              :title="f.hint"
            />
            <input
              type="number"
              :placeholder="f.placeholder"
              v-model="product[f.name]"
              v-else-if="f.type === 'number'"
              :min="f.data?.min"
              :max="f.data?.max"
              :title="f.hint"
            />

            <textarea
              type="text"
              :placeholder="f.placeholder"
              :maxlength="f.data?.max"
              :minlength="f.data?.min"
              v-else-if="f.type === 'textarea'"
              :title="f.hint"
            ></textarea>

            <button
              class="btn btn-outline-primary"
              v-else-if="f.type === 'button'"
              :title="f.hint"
            >
              {{ f.placeholder }}
            </button>

            <Datepicker
              v-else-if="f.type === 'date'"
              :placeholder="f.placeholder"
              :title="f.hint"
              :min-date="f.data ? f.data.start : null"
              :max-date="f.data ? f.data.end : null"
            ></Datepicker>

            <circle-checkbox
              v-else-if="f.type === 'checkbox'"
              :text="f.placeholder"
              :title="f.hint"
            ></circle-checkbox>

            <social-media-link-input
              v-else-if="f.type === 'links'"
              @submit="(e) => addLink(e)"
              :links="socialMediaAssets"
              id_prefix="slink"
              :title="f.hint"
            ></social-media-link-input>

            <multi-img-picker v-else-if="f.type === 'assets'" />

            <div v-else>{{ f }}</div>
          </div>
        </div>
      </div>
      <button class="btn next-btn" data-content=".step-content.price-content">
        {{ $t("next") }}
      </button>
    </div>
  </div>
</template>

<script>
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import SocialMediaLinkInput from "../../../components/Dashboard/SocialMediaLinkInput.vue";
import MultiImgPicker from "@/components/layouts/MultiImgPicker";

export default {
  props: {
    fields: {
      type: Object,
      required: true,
    },
  },
  components: { MultiImgPicker, SocialMediaLinkInput, Datepicker },
  data() {
    return {
      product: {},
      socialMediaAssets: [],
      isLifeTime: this.$route.query.isLifeTime,
      until: this.$route.query.until,
    };
  },
  methods: {
    addLink(e) {
      this.socialMediaAssets.push({
        id: null,
        social_id: e,
        link: "",
      });
    },
  },
};
</script>

<style lang="scss" scoped></style>
