<template>
  <div class="dash-sell-page">
    <steps-banner :steps="steps" :active="active"></steps-banner>

    <div class="dash-step-contents">
      <div class="dash-step-content">
        <Pages :fields="fields"></Pages>

        <!-- <div class="price-content step-content">
          <div class="dash-sell-form">
            <div class="form-feilds">
              <div class="form-step-title">Price</div>
              <div class="form-step-feilds">
                <input type="text" placeholder="Price" />
                <label for="automatic-price">
                  <input type="radio" id="automatic-price" />
                  Automatic Expiration Setting And Automatic Price Determination
                  From The Expiration Date.
                </label>
              </div>
            </div>
            <button
              class="btn next-btn"
              data-content=".step-content.site-service-content"
            >
              Next
            </button>
          </div>
        </div>

        <div class="site-service-content step-content">
          <div class="dash-sell-form">
            <div class="form-feilds">
              <div class="form-step-title">
                Verify the ownership of the item
              </div>
              <div class="form-step-feilds" style="height: 300px"></div>
            </div>
            <div class="form-feilds">
              <div class="form-step-title">
                Take charge of the sales process
                <span class="price">(50$)</span>
              </div>
              <div class="form-step-feilds">
                <select>
                  <option>Yes</option>
                </select>
                <button class="btn verify-google-btn">
                  Add open-source files Or e-mails, passwords and all the
                  details
                </button>
              </div>
            </div>
            <div class="form-feilds">
              <div class="form-step-title">Email Marketing</div>
              <div class="form-step-feilds">
                <div class="radio-boxes">
                  <label class="radio-box" for="email-marketing">
                    <div class="input-content">
                      <input type="radio" id="email-marketing" />
                      Email Marketing
                    </div>
                    <div class="price"><sup>$</sup>10</div>
                  </label>
                </div>
              </div>
            </div>

            <div class="form-feilds">
              <div class="form-step-title">Premium Listing</div>
              <div class="form-step-feilds">
                <div class="radio-boxes">
                  <label class="radio-box" for="category-has-pin">
                    <div class="input-content">
                      <input type="radio" id="category-has-pin" />
                      Pin On The Top Each Category Has Pin On The Top
                    </div>
                    <div class="price"><sup>$</sup>20</div>
                  </label>

                  <label class="radio-box" for="verify-by-deskise">
                    <div class="input-content">
                      <input type="radio" id="verify-by-deskise" />
                      Verified By Deskise
                    </div>
                    <div class="price"><sup>$</sup>15</div>
                  </label>
                </div>
              </div>
            </div>

            <div class="form-feilds">
              <div class="form-step-title with-icon">
                Signing a copyright disclaimer agreement
                <span class="icon"><i class="fa fa-angle-down"></i></span>
                <p class="description-subject">
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed
                  Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna
                  Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et
                  Justo Duo Dolores Et Ea Rebum. Stet Clita Kasd Gubergren, No
                  Sea Takimata Sanctus Est Lorem Ipsum Dolor Sit Amet. Lorem
                  Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam
                  Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna
                  Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et
                  Justo Duo Dolores Et Ea Rebum. Stet Clita Kasd Gubergren, No
                  Sea
                </p>
              </div>
              <div class="form-step-feilds">
                <label for="copyright">
                  <input type="radio" id="copyright" />
                  Signing A Copyright Disclaimer Agreement
                </label>
              </div>
            </div>

            <div class="form-feilds">
              <div class="form-step-title with-icon">
                Confirm the information and agree to the terms
                <span class="icon"><i class="fa fa-angle-down"></i></span>
                <p class="description-subject">
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed
                  Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna
                  Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et
                  Justo Duo Dolores Et Ea Rebum. Stet Clita Kasd Gubergren, No
                  Sea Takimata Sanctus Est Lorem Ipsum Dolor Sit Amet. Lorem
                  Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam
                  Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna
                  Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et
                  Justo Duo Dolores Et Ea Rebum. Stet Clita Kasd Gubergren, No
                  Sea
                </p>
              </div>
              <div class="form-step-feilds">
                <label for="terms-and-agreement">
                  <input type="radio" id="terms-and-agreement" />
                  Confirm The Information And Agree To The Terms
                </label>
              </div>
            </div>

            <button class="btn publish-btn">Publish The Product</button>
          </div>
        </div> -->
      </div>

      <div class="dash-sell-tips">
        <div class="tips-title">Help and Tips</div>
        <p class="tips-content">
          Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
          nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
          sed diam voluptua. At vero eos et accusam et justo duo dolores et ea
          rebum. Stet clita kasd gubergren, no sea
        </p>
        <p class="tips-content">
          takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
          amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
          invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
          At vero eos et accusam et justo duo dolores et ea rebum. Stet clita
          kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit
          amet.
        </p>
        <p class="tips-content">
          Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
          nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
          sed diam voluptua. At vero eos et accusam et justo duo dolores et ea
          rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem
          ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
          sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et
          dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam
          et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
          takimata sanctus est Lorem ipsum dolor sit amet.
        </p>
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
      type: Number,
      default: 1,
    },
  },
  components: { StepsBanner, Pages },
  data() {
    return {};
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
  max-width: 1500px;
  margin: auto;
  padding: 10px;
  text-align: left;
}

.dash-step-contents {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 150px;
}

.dash-sell-form .form-feilds {
  border-bottom: 3px solid rgba(137, 137, 137, 23%);
  margin-bottom: 20px;
  padding: 5px 0;
}

.dash-sell-form .form-feilds .form-step-title {
  font-size: 24px;
  margin-bottom: 15px;
  color: #040506;
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
  font-size: 18px;
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
  max-width: 520px;
  margin-bottom: 15px;
  font-size: 20px;
  width: 100%;
}

.dash-sell-form label input[type="radio"] {
  width: auto;
  display: inline-block;
  margin-right: 5px;
}
.dash-sell-form label {
  font-size: 18px;
  display: block;
  max-width: 520px;
}

.dash-sell-form .form-feilds textarea {
  min-height: 250px;
}

.form-feilds button.verify-google-btn {
  width: 100%;
  color: #9d9d9d;
  background-color: rgba(201, 201, 201, 23%);
  max-width: 520px;
  font-size: 16px;
  font-weight: 400;
  padding: 15px 20px;
}

.form-feilds button.add-btn {
  display: block;
  max-width: 520px;
  width: 100%;
  background-color: #fff;
  color: #9d9d9d;
  border: 1px solid #9d9d9d;
}

.form-feilds .upload-images {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
}
.form-feilds .upload-images > div {
  position: relative;
  width: 137px;
  height: 143px;
  border-radius: 10px;
  background-color: rgba(201, 201, 201, 23%);
  display: flex;
  align-items: center;
  justify-content: center;
}

.form-feilds .upload-images .add-new-image {
  font-size: 24px;
  color: #9d9d9d;
}

.form-feilds .upload-images div.image {
  width: 119px;
  height: 119px;
}

.form-feilds .upload-images div.image img {
  display: block;
  margin: auto;
  max-width: 100%;
  border-radius: 5px;
}

.form-feilds .close-content {
  width: 42px;
  height: 42px;
  line-height: 42px;
  text-align: center;
  background-color: #fb5b5b;
  color: #fff;
  border-radius: 50%;
  font-size: 18px;
  position: absolute;
  top: -12px;
  right: -12px;
  cursor: pointer;
}

.dash-step-contents .dash-step-content {
  flex-grow: 1;
}

.dash-step-contents .dash-sell-tips {
  max-width: 640px;
}

.dash-step-contents .dash-sell-tips .tips-title {
  font-size: 24px;
  margin-bottom: 20px;
}

.dash-step-contents .dash-sell-tips .tips-content {
  margin-left: 15px;
  margin-bottom: 60px;
  color: #9d9d9d;
  line-height: 40px;
  font-size: 24px;
}

.dash-sell-form button.next-btn,
.dash-sell-form button.publish-btn {
  width: 100%;
  background: #3eadb7;
  color: #fff;
  max-width: 520px;
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
  max-width: 280px;
  width: 100%;
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
}

.dash-sell-form .radio-boxes label.radio-box .price {
  font-size: 60px;
  font-weight: bold;
  color: #040506;
  width: 100%;
  text-align: center;
}
.dash-sell-form .radio-boxes label.radio-box .price sup {
  font-size: 27px;
}

@media (max-width: 1300px) {
  .dash-step-contents {
    gap: 40px;
  }
  .dash-step-contents .dash-sell-tips .tips-content {
    font-size: 20px;
    line-height: 30px;
  }
}

@media (max-width: 1200px) {
  .dash-step-contents .dash-sell-tips {
    max-width: 500px;
  }
}

@media (max-width: 1000px) {
  .dash-step-contents {
    flex-wrap: wrap;
  }
  .dash-step-contents .dash-sell-tips,
  .dash-step-contents .dash-step-content {
    max-width: 100%;
    flex-grow: 1;
  }
  .dash-step-contents .dash-sell-tips .tips-content {
    margin-left: 0px;
  }
  .dash-step-contents .dash-sell-tips .tips-content {
    margin-bottom: 40px;
  }
}

@media (max-width: 600px) {
  .dash-sell-form .radio-boxes label.radio-box {
    max-width: 240px;
  }
  .dash-sell-form .radio-boxes label.radio-box .input-content {
    font-size: 16px;
  }

  .dash-sell-form .radio-boxes label.radio-box .price {
    font-size: 40px;
  }

  .dash-sell-form .form-feilds .form-step-title {
    font-size: 20px;
  }
  .dash-sell-form label {
    font-size: 16px;
  }
  .dash-sell-form .form-feilds .form-step-title.with-icon .description-subject {
    font-size: 16px;
    padding: 10px;
    line-height: 30px;
  }
  .btn {
    padding: 15px 20px;
  }

  .dash-sell-form .form-feilds .form-step-title span.price {
    margin-left: 0px;
  }
  .dash-sell-form .form-feilds input,
  .dash-sell-form .form-feilds select,
  .dash-sell-form .form-feilds textarea {
    padding: 15px 10px;
    font-size: 16px;
  }
  .dash-step-contents .dash-sell-tips .tips-content {
    font-size: 18px;
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
