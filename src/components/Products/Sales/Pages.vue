<template>
  <div class="step-content">
    <div class="dash-sell-form">
      <div v-if="this.steps.length === this.active" >
        <div class="form-fields">
          <div class="form-step-title">Take charge of the sales process (50$)</div>
            <div class="form-step-fields">
                <yn-select
                  type = 'y_n'
                  placeholder="Choose"
                  @choose="(e)=>{}"
                  title="sales process"
                  disabled
                ></yn-select>
            </div>
        </div>
        <div class="form-feilds">
          <div class="form-step-title">Packages</div>
            <div class="form-step-fields">
              <div class="packages-container">
                <div v-for="pack in packages" :key="pack.id" >
                  <PackageSelect
                    :pack="pack"
                    @select="addPackage"
                  ></PackageSelect>
                </div>
              </div>
            </div>
        </div>

          <div class="form-feilds">
            <button class="btn drop" type="button" data-bs-toggle="collapse" data-bs-target="#collapsRights" aria-expanded="false" aria-controls="collapsRights">
              Signing a copyright disclamer agreement
              <span class="icon">
                <flat-icon-component
                  :icon="arrow"
                  type="b"
                  straight
                ></flat-icon-component>
              </span>
            </button>
            
            <div class="collapse" id="collapsRights">
              <div class="card card-body">
                Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
              </div>
            </div>
            <CircleCheckbox :text="copyrights" ></CircleCheckbox>
          </div>
          <div class="form-feilds">
            <button class="btn drop" type="button" data-bs-toggle="collapse" data-bs-target="#collapsTerms" aria-expanded="false" aria-controls="collapsTerms">
              Confirm The Information And Agree To The Terms
              <span class="icon">
                <flat-icon-component
                  :icon="arrow"
                  type="b"
                  straight
                ></flat-icon-component>
              </span>
            </button>
            
            <div class="collapse" id="collapsTerms">
              <div class="card card-body">
                Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
              </div>
            </div>
            <CircleCheckbox :text="copyrights" ></CircleCheckbox>
          </div>
          
        </div>

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
              @choose="
                (e) => {
                  if (!Object.prototype.hasOwnProperty.call(product, 'data')) {
                    product.data = '[]';
                  }
                  const data = JSON.parse(product.data);
                  if (data.includes(e)) {
                    const index = data.indexOf(e);
                    if (index > -1) {
                      data.splice(index, 1);
                    }
                  } else {
                    data.push({[f.name] :e});
                  }
                  product.data = JSON.stringify(data);
                }
              "
              :title="f.hint"
            ></single-select>
                

            <single-select
              :placeholder="f.placeholder"
              :data="subCategories.map((e) =>[e, e.name])"
              v-else-if="f.type === 'subcategory'"
              @choose="
              (e) => {
                product[f.name] = e.id;
                
              }
              "
              :title="f.hint"
            ></single-select>

            <yn-select
              v-else-if="f.type === 'y_n'"
              :placeholder="f.placeholder"
              @choose="
                (e) => {
                  if (!Object.prototype.hasOwnProperty.call(product, 'data')) {
                    product.data = '[]';
                  }
                  const data = JSON.parse(product.data);
                  if (data.includes(e)) {
                    const index = data.indexOf(e);
                    if (index > -1) {
                      data.splice(index, 1);
                    }
                  } else {
                    data.push({[f.name] :e});
                  }
                  product.data = JSON.stringify(data);
                }
              "
              :title="f.hint"
            ></yn-select>

            <multi-img-picker
              :placeholder="f.placeholder"
              @change="addImg"
              v-if="f.type === 'file'"
              :title="f.hint"
            />

            <multi-img-picker
              type="assets"
              :placeholder="f.placeholder"
              @change="([e]) => {
                  product[f.name] = e;
                }"
              v-else-if="f.type === 'assets'"
              :title="f.hint"
            />


            <input
              type="text"
              :placeholder="f.placeholder"
              v-model="product[f.name]"
              v-if="f.type === 'text'"
              :title="f.hint"
            />

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
              v-model="product[f.name]"
              :placeholder="f.placeholder"
              :maxlength="f.data?.max"
              :minlength="f.data?.min"
              v-if="f.type === 'textarea'"
              :title="f.hint"
            ></textarea>

            <Datepicker
              v-if="f.type === 'date'"
              v-model="product[f.name]"
              :placeholder="f.placeholder"
              :title="f.hint"
              :min-date="f.data ? f.data.start : null"
              :max-date="f.data ? f.data.end : null"
            ></Datepicker>

            <circle-checkbox
              @check="(e) => {
                  if (!Object.prototype.hasOwnProperty.call(product, 'data')) {
                    product.data = '[]';
                  }
                  const data = JSON.parse(product.data);
                  if (data.includes(e)) {
                    const index = data.indexOf(e);
                    if (index > -1) {
                      data.splice(index, 1);
                    }
                  } else {
                    data.push({[f.name] :e});
                  }
                  product.data = JSON.stringify(data);
                }"
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

            <!-- <multi-img-picker 
              type="assets"
              v-else-if="f.type === 'assets'" 
              v-model="product[f.name]" /> -->

            <!-- <div v-else>{{ f }}</div> -->
          </div>
        </div>
      </div>
        <button v-if="active < steps.length" class="btn next-btn" data-content=".step-content.price-content" @click.prevent="handleNext">
          {{ $t("Next") }}
        </button>
        <button v-if="active === steps.length" class="btn next-btn" data-content=".step-content.price-content" @click.prevent="addProduct">
          {{ $t("Publish") }}
        </button>
        <!-- <p>{{ subCategories.name }}</p> -->
    </div>
  </div>
</template>

<script>
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import SocialMediaLinkInput from "../../../components/Dashboard/SocialMediaLinkInput.vue";
import MultiImgPicker from "@/components/layouts/MultiImgPicker";
import PackageSelect from "@/components/layouts/PackageSelect";
import { mapGetters } from "vuex";
import { mapState } from "vuex";
import CircleCheckbox from "../../layouts/CircleCheckbox.vue";

export default {
  props: {
    fields: {
      type: Object,
      required: true,
    },
    steps: {
      type: Array,
      required: true,
    },
    active: {
      type: Number,
      default: 1,
    },
    cat: {
      type: String,
      default: "1",
    },
  },
  
  components: { MultiImgPicker, SocialMediaLinkInput, Datepicker, PackageSelect, CircleCheckbox },
  data() {
    return {
      product: {
      },
      socialMediaAssets: [],
      link:"",
      isLifeTime: this.$route.query.isLifeTime,
      until: this.$route.query.until,
      copyrights: 'Siging A Copyright Disclamer Agrrement',
      arrow: "angle-down",
    };
  },
  methods: {
    addImg(e) {
      if(this.isLifeTime ==="y") {
        this.product.lifetime = 1
      }else {
        this.product.lifetime = 0
      }

      let file = e.target.files[0]
      this.product.img = file
    },

    addPackage(e) {
      // Create the `packages` array property in the `this.product` object if it doesn't already exist
      if (!Object.prototype.hasOwnProperty.call(this.product, 'packages')) {
        this.product.packages = '[]';
      }

      // Parse the `packages` JSON string into an array
      const packages = JSON.parse(this.product.packages);

      // Check if the `e` value already exists in `packages`
      if (packages.includes(e)) {
        // If `e` already exists, remove it from `packages`
        const index = packages.indexOf(e);
        if (index > -1) {
          packages.splice(index, 1);
        }
      } else {
        // If `e` doesn't exist, add it to `packages`
        packages.push(e);
      }

      // Convert the `packages` array to a JSON string and assign it to the `packages` property
      this.product.packages = JSON.stringify(packages);
    },



    // checkValue(e) {
    //   this.product.data.push({e})
    //   console.log(this.product.data);
    //   console.log(JSON.parse(this.product.data));
    // },
    handleNext() {
      this.activeNumbe +=1
      this.$router.push({
         name: this.$router.currentRoute.name, hash: `#${this.activeNumbe}`,
      })

    },
    addLink(e) {
      console.log(e);
      this.socialMediaAssets.push({
        id: 1,
        social_id: e,
        link: e.link,
      });
      
    },
    async addProduct() {
      console.log('addProduct Clicked');
      
      this.product.social_media = JSON.stringify(this.socialMediaAssets);
      // this.product.packages = "[2,5]"
      // this.product.name="Mountain"
      this.product.category= parseInt(this.cat)
      
      this.product.until = new Date(this.until).toLocaleDateString('en-GB');
      // this.product.until = new Date(this.until).toISOString().substring(0, 10);

      // this.product.img = '{"image": "colorful.png"}', 
      // this.product.img = "colorful.png", 
      this.product.assets = '{"image":["default.webp", "default2.webp"]}'
      // this.product.data = '{"cgtcwbwkpw2xcamc":2,"c4ptlaydqaw9n0co":"https://google.com","95eaxarkoweapytr":400,"dnqsxa0uvgdjuu3s":"15/09/2015","lsy5jvy4y7xxotqn":"15/09/2017","zirhzi4iuoxmpwix":"y","4hswcrdgqtlpkznm":{"1":{"profit":100,"visits":1000},"2":{"profit":100,"visits":1000},"3":{"profit":100,"visits":1000},"4":{"profit":100,"visits":1000},"5":{"profit":100,"visits":1000},"6":{"profit":100,"visits":1000},"7":{"profit":100,"visits":1000},"8":{"profit":100,"visits":1000},"9":{"profit":100,"visits":1000},"10":{"profit":100,"visits":1000},"11":{"profit":100,"visits":1000},"12":{"profit":100,"visits":1000}},"yw9h7mpozga0ddmy":"Something Goes Here, At Least 250 Characters, Something Goes Here, At Least 250 Characters, Something Goes Here, At Least 250 Characters, Something Goes Here, At Least 250 Characters, Something Goes Here, At Least 250 Characters, Something Goes Here, At Least 250 Characters","xelsvczwzj0eerjy":"Something less than 150 Characters Here","bi2jdhndqh4xyjnf":1,"m391epmrj9locffu":1}'
      
      // this.product.social_media = this.socialMediaAssets
      this.prepareToSend(this.product);
    },

     prepareToSend(data) {
      let formData = new FormData();
      formData.append("hi", "there");
      Object.keys(data)
        .map((key) => {
          return [key, data[key]];
        })
        .forEach((e) => {
          if (e[1] !== null) {
            if (typeof e[1] === "object" && !(e[1] instanceof File)) {
              Object.keys(e[1]).map((d) =>
                formData.append(e[0] + "[]", JSON.stringify(e[1][d]))
              );
            } else formData.append(e[0], e[1]);
          }
        });
        for (var pair of formData.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
      }
      this.$emit('publishDialog', true)
         this.$store.dispatch("product/add",{product: formData});

    },

  },
  computed: {
    ...mapGetters("category", ["categories"]),
    ...mapState("data", ["packages"]),
    subCategories() {
      let cat = parseInt(this.cat)
      return this.categories.map((item) => item).map((i) => i.subcategories).flat().filter((e) => e.category_id === cat);
    },

    subCat() {
      return this.$store.state.category.subcategories
    },
    
    activeNumbe(){
      return this.active +1
    },
  },
  async created() {
    if (this.$store.state.data.packages.length === 0) {
        await this.$store.dispatch("data/packages");
      }
  }
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
.packages-container {
  width: 100%;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); // creates grid with minimum item width of 200px
  gap: 10px; // adds spacing between grid items
}
@media only screen and (max-width: $maxMobile) {
  .packages-container {
    grid-template-columns: repeat(auto-fit, minmax(100%, 1fr)); // makes the grid one column for mobile screens
  }
}

@media only screen and (min-width: $minSmall) and (max-width: $maxMedium) {
  .packages-container {
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); // adjusts item width for small to medium screens
  }
}

@media only screen and (min-width: $minLarge) {
  .packages-container {
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); // adjusts item width for large screens
  }
}
.drop {
  display: flex;
  justify-content: space-between;
  width: 100%;
  margin-bottom: 10px
}
.icon {
  font-size: 12px;
}
</style>
