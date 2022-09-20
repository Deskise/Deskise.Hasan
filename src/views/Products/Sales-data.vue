<template>
  <div class="container dash-sell-page mb-5">
    <steps-banner :steps="steps" :active="active"></steps-banner>
    <div class="dash-step-contents p-2">
      <div class="row">
        <div class="col-12 col-lg-6 pe-3 pe-lg-5">
          <div class="dash-step-content">
            <Pages :fields="fields"></Pages>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="dash-sell-tips">
            <div class="tips-title">Help and Tips</div>
            <p class="tips-content">
              Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
              nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
              erat, sed diam voluptua. At vero eos et accusam et justo duo
              dolores et ea rebum. Stet clita kasd gubergren, no sea
            </p>
            <p class="tips-content">
              takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor
              sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
              tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
              voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
              Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum
              dolor sit amet.
            </p>
            <p class="tips-content">
              Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
              nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
              erat, sed diam voluptua. At vero eos et accusam et justo duo
              dolores et ea rebum. Stet clita kasd gubergren, no sea takimata
              sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
              amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
              invidunt ut labore et dolore magna aliquyam erat, sed diam
              voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
              Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum
              dolor sit amet.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="dash-dailog publish-product-dailog">
    <div class="dash-dailog-box">
      <div class="icon">
        <img src="@/assets/paper-plane.png" />
      </div>
      <div class="title">Thanks For Posting The Item</div>
      <p class="description">You Can Review Item Updates From Your Profile</p>
      <p class="description content">
        Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy
        Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed Diam
        Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et Ea Rebum
      </p>
      <button class="btn block-btn pelorous">ok</button>
    </div>
  </div>
</template>

<script>
import StepsBanner from "../../components/Products/Sales/StepsBanner.vue";
import Pages from "../../components/Products/Sales/Pages.vue";
export default {
  props: {
    cat: {
      type: String,
      default: "1",
    },
  },
  components: { StepsBanner, Pages },
  data() {
    return {
      is_lifetime: this.$route.query.isLifeTime,
    };
  },
  computed: {
    active() {
      return Number.parseInt(
        this.$router.currentRoute.value.hash.split("#")[1] ?? 1
      );
    },
    fields() {
      return this.$store.getters["category/getFields"](
        this.cat,
        this.active - 1
      );
    },
    steps() {
      return this.$store.getters["category/getPages"](this.cat);
    },
  },
};
</script>

<style lang="scss">
/* Sell Product page */

.dash-sell-page {
  padding: 10px;
  text-align: left;
}
.dash-sell-form .form-feilds {
  border-bottom: 2px solid #eee;
  margin-bottom: 20px;
  padding: 5px 0;
}
.dash-sell-form .form-feilds .drop-down {
  max-width: 400px !important;
  width: 400px !important;
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
.dash-sell-form .form-feilds .form-step-title {
  font-size: 24px;
  margin-bottom: 15px;
  color: #040506;
  @media (max-width: 1400px) {
    font-size: 18px;
    margin-bottom: 10px;
    font-weight: 600;
  }
}

.dash-sell-form .form-feilds .form-step-title span.price {
  color: #3eadb7;
  font-weight: 400;
  margin-left: 40px;
}

.dash-sell-form .form-feilds .form-step-title.with-icon {
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;
  cursor: pointer;
}
.dash-sell-form .form-feilds .form-step-title.with-icon .icon {
  cursor: pointer;
}

.dash-sell-form .form-feilds .form-step-title.with-icon .description-subject {
  padding: 30px;
  position: absolute;
  top: 100%;
  border: 1px solid #9d9d9d;
  border-radius: 5px;
  z-index: 2;
  background: #fff;
  font-size: 20px;
  line-height: 40px;
  color: #9d9d9d;
  display: none;
  @media (max-width: 1400px) {
    font-size: 15px;
    padding: 15px;
    line-height: 30px;
  }
}

.dash-sell-form
  .form-feilds
  .form-step-title.with-icon.active
  .description-subject {
  display: block;
}

.dash-sell-form .form-feilds .form-step-title.with-icon.active .icon i::before {
  content: "\f106";
}
.dash-sell-form .form-feilds input,
.dash-sell-form .form-feilds select,
.dash-sell-form .form-feilds textarea {
  border: 1px solid #9d9d9d;
  border-radius: 5px;
  padding: 15px 30px;
  color: #9d9d9d;
  display: block;
  margin-bottom: 15px;
  font-size: 20px;
  max-width: 400px !important;
  width: 400px !important;
  @media (max-width: 1400px) {
    font-size: 15px;
    margin-bottom: 10px;
    padding: 10px 20px;
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
.dp__input_wrap input {
  @media (max-width: 1400px) {
    padding: 10px 30px !important;
  }
}
.dash-sell-form .form-feilds textarea::placeholder {
  color: #ccc;
}
.dash-sell-form label input[type="radio"] {
  width: auto;
  display: inline-block;
  margin-right: 5px;
}
.dash-sell-form label {
  font-size: 18px;
  display: block;
  @media (max-width: 1400px) {
    font-size: 16px;
  }
}

.dash-sell-form .form-feilds textarea {
  min-height: 150px;
}

.form-feilds button.verify-google-btn {
  width: 100%;
  color: #9d9d9d;
  background-color: rgba(201, 201, 201, 23%);
  font-size: 15px;
  font-weight: 400;
  padding: 15px 20px;
  max-width: 400px !important;
  width: 400px !important;
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

.form-feilds button.add-btn {
  display: block;
  width: 100%;
  background-color: #fff;
  color: #9d9d9d;
  border: 1px solid #9d9d9d;
}
.form-feilds .upload-images {
  display: flex;
  overflow-x: scroll;
}
.form-feilds .upload-images > div {
  position: relative;
  width: 100px;
  height: 100px;
  border-radius: 10px;
  background-color: #eee;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 10px;
  min-width: 100px;
}

.form-feilds .upload-images .add-new-image {
  cursor: pointer;
  min-width: 100px;
}

.form-feilds .upload-images div.image {
  width: 90%;
  height: 90%;
}

.form-feilds .upload-images div.image img {
  display: block;
  margin: auto;
  max-width: 100%;
  border-radius: 5px;
  height: 100%;
}

.form-feilds .close-content {
  width: 26px;
  height: 26px;
  background-color: #fb5b5b;
  color: #fff;
  border-radius: 50%;
  font-size: 15px;
  position: absolute;
  top: -8px;
  right: -8px;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-content: center;
  text-align: center;
}

.dash-step-contents .dash-sell-tips .tips-title {
  font-size: 24px;
  margin-bottom: 20px;
  @media (max-width: 1400px) {
    font-size: 18px;
    margin-bottom: 10px;
    font-weight: 600;
  }
}

.dash-step-contents .dash-sell-tips .tips-content {
  margin-left: 15px;
  margin-bottom: 60px;
  color: #9d9d9d;
  line-height: 40px;
  font-size: 24px;
  @media (max-width: 1400px) {
    font-size: 16px;
    margin-bottom: 30px;
    line-height: 30px;
    margin-left: 10px;
  }
}

.dash-sell-form button.next-btn,
.dash-sell-form button.publish-btn {
  width: 100%;
  background: #3eadb7;
  color: #fff;
}

.dash-sell-form .radio-boxes {
  display: flex;
  flex-wrap: wrap;
  align-items: stretch;
  justify-content: flex-start;
  gap: 10px;
}
.dash-sell-form .radio-boxes label.radio-box {
  display: flex;
  flex-direction: column;
  background-color: rgba(201, 201, 201, 23%);
  border: 1px solid #707070;
  padding: 10px 12px;
  border-radius: 10px;
  cursor: pointer;
  justify-content: space-between;
}

.dash-sell-form .radio-boxes label.radio-box .input-content {
  margin-bottom: 10px;
  color: #9d9d9d;
  font-size: 18px;
  text-transform: uppercase;
}

.dash-sell-form
  .radio-boxes
  label.radio-box
  .input-content
  input[type="radio"] {
  margin-right: 20px;
  @media (max-width: 1400px) {
    font-size: 15px;
    margin-right: 10px;
  }
}

.dash-sell-form .radio-boxes label.radio-box .price {
  font-size: 60px;
  font-weight: bold;
  color: #040506;
  width: 100%;
  text-align: center;
  @media (max-width: 1400px) {
    font-size: 40px;
  }
}
.dash-sell-form .radio-boxes label.radio-box .price sup {
  font-size: 27px;
  @media (max-width: 1400px) {
    font-size: 20px;
  }
}

@media (max-width: 600px) {
  .dash-sell-form .radio-boxes label.radio-box .input-content {
    font-size: 15px;
  }

  .dash-sell-form .radio-boxes label.radio-box .price {
    font-size: 30px;
  }

  .dash-sell-form label {
    font-size: 15px;
  }
  .btn {
    padding: 10px 15px;
  }

  .dash-sell-form .form-feilds input,
  .dash-sell-form .form-feilds select,
  .dash-sell-form .form-feilds textarea {
    font-size: 14px;
  }
}

/* Dailog */

.dash-dailog {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background-color: rgba(201, 201, 201, 20%);
  z-index: 100;
  justify-content: center;
  align-items: center;
  /* display: flex; */
  display: none;
}

.dash-dailog.publish-product-dailog.active {
  display: flex;
}

.dash-dailog .dash-dailog-box {
  background: #fff;
  border-radius: 20px;
  padding: 50px 70px;
  min-width: 750px;
  max-width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
}
.dash-dailog .dash-dailog-box > *:not(:last-child),
.dash-form > *:not(:last-child) {
  margin-bottom: 15px;
}

.dash-dailog .icon {
  max-width: 70px;
}
.dash-dailog .icon img {
  max-width: 100%;
  display: block;
  margin: auto;
}

.dash-dailog .title {
  font-size: 28px;
  color: #040506;
  font-weight: bold;
}
.dash-dailog .description {
  font-size: 24px;
  color: #c9c9c9;
  text-align: center;
}

.dash-dailog .dash-form {
  width: 100%;
}

.dash-form textarea,
.dash-form input,
.dash-form select {
  color: #9d9d9d;
  padding: 14px 30px;
  border: 1px solid rgba(157, 157, 157, 23%);
  border-radius: 5px;
  display: block;
  width: 100%;
  font-size: 20px;
}
.dash-form textarea {
  min-height: 160px;
}

.dash-form button[type="submit"],
.dash-form input[type="submit"] {
  width: 100%;
  padding: 16px;
  border-radius: 5px;
  background-color: #4e1b56;
  color: #fff;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
  border: none;
}

.dash-form button[type="submit"].pelorous,
.dash-form input[type="submit"].pelorous,
button.pelorous {
  background-color: #3eadb7;
  color: #fff;
}

.dash-dailog-box .content {
  max-width: 490px;
}

@media (max-width: 800px) {
  .dash-dailog .dash-dailog-box {
    min-width: calc(100% - 20px);
    padding: 40px 10px;
  }

  .dash-dailog .title {
    font-size: 22px;
  }

  .dash-dailog .description,
  .dash-form textarea,
  .dash-form input,
  .dash-form select {
    font-size: 18px;
  }

  .dash-dailog .icon {
    max-width: 50px;
  }
}

button.block-btn {
  display: block;
  width: 100%;
}
</style>
