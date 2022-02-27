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
              style="max-width: 520px"
            ></single-select>

            <yn-select
              style="max-width: 520px"
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

            <div v-else>{{ f }}</div>
          </div>
        </div>
      </div>

      <div class="form-feilds">
        <div class="form-step-title">Business Assets Included</div>
        <div class="form-step-feilds">
          <input type="text" placeholder="Domain" />
          <input type="text" placeholder="Social Media Account" />
          <button class="btn add-btn">
            <i class="fa fa-plus"></i>
          </button>
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
            <i class="fa fa-plus"></i>
          </div>
          <div class="new-image">
            <span class="close-content"><i class="fa fa-times"></i></span>
            <div class="image">
              <img src="@/assets/new-image.png" />
            </div>
          </div>
          <div class="new-image">
            <span class="close-content"><i class="fa fa-times"></i></span>
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
export default {
  props: {
    fields: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped></style>
