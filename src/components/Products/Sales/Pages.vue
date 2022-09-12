<template>
  <div class="step-content">
    <div class="dash-sell-form">
      <div class="form-feilds" v-for="(field, index) in fields" :key="index">
        <div class="form-step-title">{{ field.title }}</div>
        <div class="form-step-feilds">
          <div v-for="(f, index) in field.fields" :key="index">
            <single-select
              :placeholder="f.placeholder"
              :data="Object.keys(f.data ?? {}).map((e) => [e, f.data[e]])"
              v-if="f.type === 'select'"
            ></single-select>

            <yn-select
              v-else-if="f.type === 'y_n'"
              :placeholder="f.placeholder"
            ></yn-select>

            <input
              type="url"
              :placeholder="f.placeholder"
              v-else-if="f.type === 'url'"
            />
            <input
              type="number"
              :placeholder="f.placeholder"
              v-else-if="f.type === 'number'"
              min="0"
            />

            <textarea
              type="text"
              :placeholder="f.placeholder"
              v-else-if="f.type === 'textarea'"
            ></textarea>

            <button
              class="btn verify-google-btn"
              v-else-if="f.type === 'google_analytics'"
            >
              {{ f.placeholder }}
            </button>

            <Datepicker
              v-else-if="f.type === 'date'"
              :placeholder="f.placeholder"
            ></Datepicker>

            <circle-checkbox
              v-else-if="f.type === 'checkbox'"
              :text="f.placeholder"
            ></circle-checkbox>

            <social-media-link-input
              v-else-if="f.type === 'links'"
              @submit="(e) => addLink(e)"
              :links="product.links"
              id_prefix="slink"
            ></social-media-link-input>

            <div v-else>{{ f }}</div>
          </div>
        </div>
      </div>

      <div class="form-feilds">
        <div class="form-step-title">
          Write a full description of the project
        </div>
        <textarea
          placeholder="Please Make Sure Your Answer Is At Least 250 Characters Long. (Success And Obstacles) "
        ></textarea>
      </div>

      <div class="form-feilds">
        <div class="form-step-title">Briefly Tell Us About Your Business</div>
        <textarea
          placeholder="Please make sure your answer is no longer than 150 characters"
        ></textarea>
      </div>

      <div class="form-feilds">
        <div class="form-step-title">Add Photos And Media</div>
        <div class="upload-images">
          <div class="add-new-image">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 448 512"
              width="18"
            >
              <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
              <path
                d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"
                fill="grey"
              />
            </svg>
          </div>
          <div class="new-image">
            <span class="close-content">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 320 512"
                width="10"
              >
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path
                  d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"
                  fill="#fff"
                /></svg
            ></span>
            <div class="image">
              <img src="@/assets/new-image.png" />
            </div>
          </div>
          <div class="new-image">
            <span class="close-content"
              ><svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 320 512"
                width="10"
              >
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path
                  d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"
                  fill="#fff"
                /></svg
            ></span>
            <div class="image">
              <img src="@/assets/new-image.png" />
            </div>
          </div>
        </div>
      </div>
      <button class="btn next-btn" data-content=".step-content.price-content">
        Next
      </button>
    </div>
  </div>
</template>

<script>
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import SocialMediaLinkInput from "../../../components/Dashboard/SocialMediaLinkInput.vue";

export default {
  props: {
    fields: {
      type: Object,
      required: true,
    },
  },
  components: { SocialMediaLinkInput, Datepicker },
  data() {
    return {
      product: { links: [] },
    };
  },
};
</script>

<style la CircleCheckboxng="scss" scoped></style>
