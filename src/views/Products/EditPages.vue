<template>
    <div class="step-content">
      <div class="dash-sell-form">
        <div v-if="this.steps.length === this.active" >
          <!-- <div class="form-fields">
            <div class="form-step-title">Take charge of the sales process (50$)</div>
              <div class="form-step-fields">
                  <yn-select
                    type = 'y_n'
                    placeholder="Choose"
                    @choose="(e)=>{}"
                    title="sales process"
                  ></yn-select>
              </div>
          </div> -->
          <!-- <div class="form-feilds">
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
          </div> -->

          <!-- <div class="form-feilds">
          <div class="form-step-title">Selected Packages</div>
            <div class="form-step-fields">
              <div class="packages-container">
                <div v-for="pack in SelectedPacks" :key="pack.id" >
                  <PackageSelect
                    :pack="pack"
                    @select="addPackage"
                    :model-value="true"
                    :selected-packages="SelectedPacks.map((item) => item.id)"
                  ></PackageSelect>
                </div>
              </div>
            </div>
        </div> -->

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
<!-- ========== END OF SITE SERVICES PAGE =============== -->
          <div
            class="form-feilds"
            v-for="(field, index) in fields.divs"
            :key="index"
          >
            <div class="form-step-title">{{ field.title }}</div>
              <div class="form-step-fields">
                <div v-for="(f, index) in field.fields" :key="index">

                  <input
                    type="text"
                    :placeholder="f.placeholder"
                    v-model="details[f.name]"
                    v-if="f.type === 'text'"
                    :title="f.hint"
                  />
                  <input
                    type="url"
                    :placeholder="f.placeholder"
                    v-model="details[f.name]"
                    v-else-if="f.type === 'url'"
                    :title="f.hint"
                  />
                  <input
                    type="number"
                    :placeholder="f.placeholder"
                    v-model="details[f.name]"
                    v-else-if="f.type === 'number'"
                    :min="f.data?.min"
                    :max="f.data?.max"
                    :title="f.hint"
                  />
                  <textarea
                    v-model="details[f.name]"
                    :placeholder="f.placeholder"
                    :maxlength="f.data?.max"
                    :minlength="f.data?.min"
                    v-if="f.name === 'summary'"
                    :title="f.hint"
                  ></textarea>
                  <textarea
                    v-model="details[f.name]"
                    :placeholder="f.placeholder"
                    :maxlength="f.data?.max"
                    :minlength="f.data?.min"
                    v-else-if="f.name === 'description'"
                    :title="f.hint"
                  ></textarea>
                  <Datepicker
                    v-if="f.type === 'date'"
                    v-model="details[f.name]"
                    :placeholder="f.placeholder"
                    :title="f.hint"
                    :min-date="f.data ? f.data.start : null"
                    :max-date="f.data ? f.data.end : null"
                  ></Datepicker>
                  
                  <div v-if="f.name==='links'">
                    <div class="col-lg-12 p-1" v-for="(link, index) in info.social" :key="index">
                      <label for="">{{ link.account.name }}</label>
                      <input
                        type="text"
                        class="form-control"
                        :style="style"
                        v-model="link.link"
                        @change=" () => {
                          const social = JSON.parse(info.data.data.social_media);
                          const index = 0;
                          const social_data = {id: link.account.id , link: link.link, social_id: link.social_id, }
                          social.splice(index, 1, social_data);
                          // info.data.data.social_media = JSON.stringify(social);
                          this.product.social_media = JSON.stringify(social)
                        }"
                      />
                    </div>
                  </div>
                      
                  <yn-select
                    v-if="f.type === 'y_n'"
                    :placeholder="f.placeholder"
                    @choose=" (e) => {
                      const data = JSON.parse(details.data.data.data);
                      const fieldData = {
                        name: f.name,
                        type: f.type,
                        value: e
                      };
                      const existingFieldIndex = data.findIndex(item => item.name === f.name && item.type === f.type);
                      if (existingFieldIndex > -1) {
                        data.splice(existingFieldIndex, 1, fieldData);
                      } else {
                        data.push(fieldData);
                      }
                      details.data.data.data = JSON.stringify(data);
                    } "
                    :title="f.hint"
                    :value="getSavedValue(f.name)"
                  ></yn-select>

                  <single-select
                    :placeholder=" f.placeholder"
                    :data="Object.keys(f.data ?? {}).map((e) => [e, f.data[e]])"
                    v-if="f.type === 'drop_list'"
                    @choose="(e) => { 
                      const data = JSON.parse(details.data.data.data)
                      const fieldData = {
                        name: f.name,
                        type: f.type,
                        value: e
                      };
                      const existingFieldIndex = data.findIndex(item => item.name === f.name && item.type === f.type);
                      if (existingFieldIndex > -1) {
                        data.splice(existingFieldIndex, 1, fieldData);
                      } else {
                        data.push(fieldData);
                      }
                      details.data.data.data = JSON.stringify(data);
                    } "
                    :title="f.hint"
                    :value="getSavedValue(f.name)"
                  ></single-select>

                  <circle-checkbox
                    v-if="f.type === 'checkbox'"
                    :text="f.placeholder"
                    :title="f.hint"
                    :value="getSavedValue(f.name)"
                    @check="(e) => {
                      const data = JSON.parse(details.data.data.data);
                      const fieldData = {
                        name: f.name,
                        type: f.type,
                        value: e
                      };
                      const existingFieldIndex = data.findIndex(item => item.name === f.name && item.type === f.type);
                      if (existingFieldIndex > -1) {
                        data.splice(existingFieldIndex, 1, fieldData);
                      } else {
                        data.push(fieldData);
                      }
                      details.data.data.data = JSON.stringify(data);
                    }"
                  ></circle-checkbox>
                  
                  <div v-if="f.name==='img'" class="upload-images">
                    <div v-if="!images.length > 0"
                      class="add-new-image"
                      @click="() => $el.querySelector('input[type=file]').click()"
                    >
                      <flat-icon-component :style="{ color: 'gray' }" icon="plus" type="bold" />
                      <input type="file" @change="uploadImage" hidden />
                    </div>
                    <multi-picture
                      v-for="(image, i) in images"
                      :key="i"
                      :image="image"
                      :id="i"
                      @remove="removeImages"
                    />
                  </div>
                  
                  <single-select
                    :placeholder="f.placeholder"
                    :data="subCategories.map((e) =>[e, e.name])"
                    v-else-if="f.name === 'subcategory'"
                    @choose="(e) => { product[f.name] = e.id; }"
                    :title="f.hint"
                  ></single-select>
                </div>
            </div>
        </div>
  
          <button v-if="active < steps.length" class="btn next-btn" data-content=".step-content.price-content" @click.prevent="handleNext">
            {{ $t("Next") }}
          </button>
          <button v-if="active === steps.length" class="btn next-btn" data-content=".step-content.price-content" @click.prevent="editProduct">
            {{ $t("Publish") }}
          </button>
      </div>
    </div>
  </template>
  
  <script>
  import Datepicker from "@vuepic/vue-datepicker";
  import "@vuepic/vue-datepicker/dist/main.css";
  // import PackageSelect from "@/components/layouts/PackageSelect";
  import CircleCheckbox from "@/components/layouts/CircleCheckbox.vue";
  import MultiPicture from "@/components/layouts/multi-pic/MultiPicture.vue";
  import { mapState } from "vuex";
  import { mapGetters } from "vuex";
  
  export default {
    props: {
      info: {
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
      fields: {
        type: Object,
        required: true,
      },
      cat: {
        type: String,
        default: "1",
      },
    },
    
    components: {  Datepicker, CircleCheckbox, MultiPicture },
    data() {
      return {
        product: {
        },
        details: {},
        socialMediaAssets: [],
        link:"",
        isLifeTime: this.$route.query.isLifeTime,
        until: this.$route.query.until,
        copyrights: 'Siging A Copyright Disclamer Agrrement',
        arrow: "angle-down",
        images: [],
        files: [],
      };
    },
    methods: {
      uploadImage(e) {
        Array.from(e.target.files).forEach((file) => {
          this.images.push(URL.createObjectURL(file));
          this.files.push(file);
          
        });
        this.$emit("change", this.files);
      },
      removeImages(e) {
        this.images.splice(e, 1);
        this.files.splice(e, 1);
        this.$emit("change", this.files);
      },
      handleNext() {
        this.activeNumber +=1
        this.$router.push({
          name: this.$router.currentRoute.name, hash: `#${this.activeNumber}`,
        })
      },
      addPackage(e) {
        const packages = this.details.packages.map((item) => item.package_id);
        this.product.packages =[]
        this.product.packages = packages
        if (this.product.packages.includes(e)) {
          const index = this.product.packages.indexOf(e);
          if (index > -1) {
            this.product.packages.splice(index, 1);
            const packageIndex = this.details.packages.findIndex(
              (item) => item.package_id === e
            );
            if (packageIndex > -1) {
              this.details.packages.splice(packageIndex, 1);
            }
          }
        } else {
          const newPackage = { "package_id": e };
          this.product.packages.push(e);
          this.details.packages.push(newPackage);
        }

        // this.info.packages = JSON.stringify(packages);
      },

      
      // updateFieldValue(fieldName, value) {
      //   this.$set(this.details, fieldName, value);
      // },

      async editProduct() {
       this.product.name = this.details.name
       this.product.price = this.details.price
       this.product.description = this.details.description
       this.product.summary = this.details.summary
       this.product.category = this.details.category_id
       if (!Object.prototype.hasOwnProperty.call(this.product, 'subcategory')) {
        this.product.subcategory = this.details.data.subcategory_id;
      }
       this.product.data = this.details.data.data.data
       this.product.img = this.files[0]
       this.product.id = this.details.id
       if (!Object.prototype.hasOwnProperty.call(this.product, 'packages')) {
        const packages = this.details.packages.map((item) => item.package_id);
        this.product.packages = JSON.stringify(packages)
      }
       if (!Object.prototype.hasOwnProperty.call(this.product, 'social_media')) {
        this.product.social_media = this.details.data.data.social_media;
      }
      if (!Object.prototype.hasOwnProperty.call(this.product, 'data')) {
          this.product.data = '[]';
        }
      this.product.lifetime = this.details.is_lifetime ? 1 : 0;

      this.product.until = new Date(this.info.until).toLocaleDateString('en-GB');
      // this.product.assets = '{"image":["default.webp", "default3.webp"]}'

       this.prepareToSend(this.product);
      },

      async prepareToSend(data) {
      let formData = new FormData();
      formData.append("id", this.info.id);
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
        await this.$store.dispatch("product/update",{id: this.info.id, product: formData});
        this.$router.push('/profile')

    },
    },
    computed: {
      ...mapState("data", ["packages"]),
      ...mapGetters("category", ["categories"]),

      subCategories() {
        let cat = parseInt(this.info.category_id)
        return this.categories.map((item) => item).map((i) => i.subcategories).flat().filter((e) => e.category_id === cat);
      },

      activeNumber(){
        return this.active +1
      },
      extraInfo() {
        return JSON.parse(this.info.data.data.data)
      },
      socialMedia() {
        return JSON.parse(this.info.data.data.social_media)
      },
      getSavedValue() {
        const data = JSON.parse(this.info.data.data.data);
          return (fieldName) => {
            const field = data.find((f) => f.name === fieldName);
            return field ? field.value : null;
          };
      },
      // productPackages() {
      //   return JSON.parse(this.info.packages)
      // },
      SelectedPacks() {
        const filtered =  this.packages.filter((item) => {
          // const include = this.info.packages.includes(item.package_id)
          const include = this.info.packages.some((packageItem) => packageItem.package_id === item.id)
          return include;
        })
        return filtered
      },
      // packs() {
      //   const notSelected =  this.packages.filter((item) => {
      //     const exclude = !this.info.packages.some((packageItem) => packageItem.package_id === item.id)
      //     return exclude;
      //   })
      //   return notSelected
      // }
    },
    
    mounted() {
      this.details = { ...this.info };
    },
    async created() {
      if (this.$store.state.data.packages.length === 0) {
        await this.$store.dispatch("data/packages");
      }
      let file = this.info.img
      this.images.push(file);
      this.files.push(file);
    }
  };
  </script>
  
  <style lang="scss" scoped>
  @import "@/sass/_globals/_variables.scss";
  .packages-container {
    width: 100%;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); 
    gap: 10px;
  }
  @media only screen and (max-width: $maxMobile) {
    .packages-container {
      grid-template-columns: repeat(auto-fit, minmax(100%, 1fr));
    }
  }
  
  @media only screen and (min-width: $minSmall) and (max-width: $maxMedium) {
    .packages-container {
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
  }
  
  @media only screen and (min-width: $minLarge) {
    .packages-container {
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
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
  