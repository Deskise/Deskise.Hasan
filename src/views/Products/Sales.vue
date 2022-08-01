<template>
  <div class="sell-product-welcome ">
    <div class="content-page">
      <div v-if="component === 'First'">
        <div class="main-title">what do you sell!</div>
        <p class="hint">250,000+ buyers are waiting</p>
        <p class="hint mb-4">Choose Categories</p>
        <single-select 
          placeholder="Category"
          :data="Gs"
          @choose="
            (e) => {
              category = e;
            }
          "
        ></single-select>
        <button class="btn btn-primary" @click="nextStep" :disabled="category == 0">Next</button>
      </div>
      <div v-else>
        <div class="main-title">welcome in Deskise</div>
        <p class="hint">Is The License For Life!</p>

        <yn-select
          placeholder="Is The License For Life!"
          @choose="
            (e) => {
              isLifeTime = e;
            }
          "
        ></yn-select>
        <p v-if="isLifeTime == 'n'">
         <Datepicker
             placeholder="Expiration Date"
             v-model="ExpirationDate"
            ></Datepicker> 
        </p>
        <button class="btn btn-primary" @click="Go" :disabled="isLifeTime == '' ||(isLifeTime == 'n' && ExpirationDate==null )">Next</button>
        <button class="btn back-btn" v-if="component === 'Second'" @click="back">
          Back
        </button>
      </div>
    </div>
  </div>
</template>

<script>
 import Datepicker from '@vuepic/vue-datepicker';
 import '@vuepic/vue-datepicker/dist/main.css'
import { mapGetters } from "vuex";
export default {
  // mounted() {
  //   console.log(this.Gs);
  // },
  components: {
    Datepicker
  },
  data() {
    return {
      component: "First",
      category: 0,
      isLifeTime: "",
      ExpirationDate:null
    };
  },
  computed: {
    ...mapGetters("category", ["categories"]),
    Gs() {
      // return this.categories.map((g) => [g.id,JSON.parse(JSON.stringify(g))]);
      return this.categories.map((g) => [g.id, g.name]);
    },
  },
  methods: {
    nextStep() {
      this.component = "Second";
    },
    Go() {
        this.$router.push({
          name: "sales.data",
          params: { cat: this.category },
          query: { isLifeTime: this.isLifeTime },
        });
    },
    back() {
      this.component = "First";
    },
  },
};
</script>

<style lang="scss" scoped>

.sell-product-welcome {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  .content-page {
    padding: 0px;
    text-align: center;
      @media (max-width: 1400px) {
        width: 40%;
      }
      @media (max-width: 992px) {
        width: 60%;
      }
      @media (max-width: 798px) {
        width: 70%;
      }
      @media (max-width: 576px) {
        width: 90%;
      }
    .main-title {
      font-size: 40px;
      color: #040506;
      font-weight: bold;
      margin-bottom: 10px;
      text-transform: uppercase;
      @media (max-width: 1400px) {
        font-size: 35px;
        margin-bottom: 0px;
      }
    }
    .hint {
      font-size: 28px;
      color: #9d9d9d;
      margin-bottom: 10px;
      @media (max-width: 1400px) {
        font-size: 20px;
        margin: 5px 0
      }
      
    }

    button {
      width: 100%;
      color: #fff;
      padding: 16px;
      font-weight: bold;
      font-size: 20px;
      border-radius: 5px;
      &:disabled{
        opacity: .3;
      }
 @media (max-width: 1400px) {
        height: 50px;
         padding: 5px;
      font-size: 15px;
      }
      &.back-btn {
        color: #000;
        background: #fff;
        margin-top: 20px;
        border: none;
      }
    }
  }
}
</style>
<style>
.drop-down-items{
  border: 1px solid #ddd;
  border-radius: 4px;
}
</style>