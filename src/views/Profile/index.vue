<template>
  <div class="profile">
    <banner></banner>

    <div class="dash-profile-container container">
      <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
          <personal-data></personal-data>
        </div>
        <div class="col-12 col-md-8 col-lg-9">
          <div class="dash-profile-products">
            <div class="text-left mb-4 btnsGroup">
              <!-- <div class="btn-group" role="group">
                <input
                  id="btnRadio1"
                  autocomplete="off"
                  checked
                  class="btn-check"
                  name="btnRadio"
                  type="radio"
                />
                <label
                  class="btn btn-outline-primary"
                  for="btnRadio1"
                  @click="show = 'Draft'"
                  >{{ $t("draft") }}</label
                >
                <input
                  id="btnRadio2"
                  autocomplete="off"
                  class="btn-check"
                  name="btnradio"
                  type="radio"
                />
                <label
                  class="btn btn-outline-primary"
                  for="btnradio2"
                  @click="show = 'projects'"
                  >projects</label
                >
              </div> -->
            </div>
            <!-- Dreaft Featcure not implemented yet - Showing the same source (Published Products) -->
            <div
              v-if="products.length > 0 && show === 'Draft'"
              class="dash-products"
            >
              <div
                v-for="product in products"
                :key="product.id"
                class="dash-product"
              >
                <UserProducts :product="product" :stopSelling="sameUser" :id="id"></UserProducts>
              </div>
            </div>
            <div v-if="!products.length > 0 && show === 'Draft'">
              <h6 class="text-left text-grey">Not Found Draft Product Yet.!</h6>
            </div>
            <div v-if="show === 'projects'" class="dash-products">
              <div
                v-for="product in products"
                :key="product.id"
                class="dash-product"
              >
                <UserProducts :product="product" :stopSelling="sameUser" :id="id"></UserProducts>
              </div>
            </div>
            <div v-if="show === 'projects'">
              <h6 class="text-left text-grey">Not Found projects Yet.!</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Banner from "../../components/Profile/Banner.vue";
import { mixin as loadOnBottom } from "@/Mixins/loadOnBottom.js";
import PersonalData from "../../components/Profile/PersonalData.vue";
import UserProducts from "../../components/Products/UserProducts.vue";
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      show: "Draft",
    };
  },
  components: { Banner, PersonalData, UserProducts },
  props: {
    id: {
      type: Number,
    },
  },
  mounted() {
    this.scroll("user.otherUser.products", async () => {
      await this.$store
        .dispatch("user/getOtherProducts", {
          id: this.id,
          page: this.$store.state.user.otherUser.products.current_page + 1,
        })
        .then(() => {
          this.isLoading = false;
          this.scrolledToBottom = true;
        });
    });
  },
  mixins: [loadOnBottom],
  computed: {
    products() {
      return this.$store.state.user.otherUser.products.data;
    },
    ...mapGetters("user", ["sameUser"]),
  },
  async beforeRouteUpdate(routeTo, from, next) {
    let id = routeTo.query.id ?? this.$store.state.user.data.id;

    await this.$store.dispatch("user/getOtherData", {
      id,
    });
    await this.$store.dispatch("user/getOtherProducts", {
      id,
      page: 1,
    });
    routeTo.params.id = Number.parseInt(id);
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0;
    next();
  },
};
</script>

<style lang="scss">
@import "@/sass/_globals/_variables";

.btnsGroup label {
  border-color: #ddd !important;
  color: #000;
  margin: 0 10px;
  border-radius: 3px !important;
}

.btnsGroup label:hover {
  background-color: #eee;
  color: #000;
}

.btn-check:checked + .btn-outline-primary {
  background-color: #4e1b56;
  border-color: #4e1b56 !important;
  color: #fff;
}

.profile {
  margin: 0 0 70px 0 !important;

  .dash-btn {
    padding: 15px 72px;
    border-radius: 5px;
    border: none;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    @media (max-width: 1400px) {
      padding: 10px 40px;
      font-size: 14px;
      margin-top: 20px;
    }
  }

  .dash-profile-container {
    position: relative;
  }

  .dash-product-order,
  .dash-product-details,
  .dash-product .dash-old-price {
    color: #9d9d9d;
  }
}

.dash-products {
  display: flex;
  justify-content: center;
  gap: 15px;
  flex-wrap: wrap;
  margin-bottom: 15px;
}

.dash-products .dash-product {
  flex-basis: 400px;
  max-width: 400px;
  padding: 15px;
  position: relative;
}

.dash-product .dash-product-image {
  max-width: 100%;
  margin-bottom: 15px;
}

.dash-product .dash-product-image img {
  max-width: 100%;
  display: block;
  justify-content: center;
}

.dash-product .dash-product-image span {
  position: absolute;
  top: 32px;
  left: 0px;
  background-color: #9d9d9d;
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
  padding: 5px 28px;
  color: #fff;
  font-size: 16px;
}

.dash-product .das-product-info {
  display: flex;
  justify-content: space-between;
}

.dash-product .dash-action-and-order {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}

.dash-product .dash-title {
  color: #040506;
  font-size: 20px;
  margin-bottom: 5x;
  font-weight: bold;
}

.dash-product .dash-price-discount {
  display: flex;
}

.dash-product .dash-price {
  color: #3eadb7;
  font-weight: bold;
  font-size: 20px;
  display: inline-block;
  margin-right: 8px;
}

.dash-product .dash-old-price {
  font-size: 16px;
  text-decoration: line-through;
}

.dash-product .dash-btn.product-btn {
  padding: 7px;
  background: none;
  border: 1px solid #3eadb7;
  color: #3eadb7;
  margin-bottom: 5px;
  font-weight: 400;
}

.dash-product .dash-product-order {
  font-size: 20px;
}

.dash-product-details {
  font-size: 18px;
  margin-bottom: 15px;
}

.dash-product-features {
  display: flex;
  align-items: center;
  justify-content: center;
  border-top: 1px solid rgba(201, 201, 201, 23%);
  padding-top: 17.5px;
  gap: 15px;
}

.dash-product-feature {
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: #040506;
  font-size: 16px;
}

.dash-product-feature i {
  border-radius: 50%;
  padding: 7px;
  border: 1px solid #040506;
  margin-right: 5px;
}

@media (min-width: 1520px) and (max-width: 1670px) {
  .dash-products .dash-product {
    flex-basis: 350px;
  }
  .dash-product .dash-btn.product-btn {
    font-size: 15px;
  }
}

@media (min-width: 1340px) and (max-width: 1520px) {
  .dash-product .dash-btn.product-btn {
    font-size: 14px;
  }

  .dash-products .dash-product {
    flex-basis: 300px;
  }
  .dash-product .dash-title {
    font-size: 18px;
  }
}
</style>
