<template>
  <div class="dash-affiliate">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-4 col-lg-3 pe-lg-3">
          <div class="affiliate-link">
            <div class="affiliate-header">Affiliate Link</div>
          </div>
        </div>
        <div class="col-12 col-md-8 col-lg-9">
          <div class="affiliate-sales">
            <div class="affiliate-header text-left">
              <span>Enable or Disable selling through marketers.</span>
              <Switch :checked="affiliating" @update:checked="updateSwitchValue"></Switch>
            </div>
            <div class="dash-sales">
              <div>
                <div class="my-sales mb-5 mb-lg-2">
                  <div class="sales-title">Your Affiliated Products</div>
                  <div class="sales-table">
                    <div class="sales-header sales-row">
                      <!-- <span class="date">Date Created</span> -->
                      <span class="product">Product</span>
                      <span class="peference"></span>
                      <span class="state">Bought Count</span>
                    </div>
                    <div v-for="affiliate in affiliates" :key="affiliate.id" class="sales-row">
                      <!-- <span class="date">{{ affiliate.created_at.substr(0, 10) }}</span> -->
                      <span class="product">{{ affiliate.product.name }}</span>
                      <span class="peference">{{ affiliate.tracking_code }}</span>
                      <span class="state sold">{{ affiliate.product_count }}</span>
                    </div>
                  </div>
                </div>
                <div class="my-sales mb-5 mb-lg-2">
                    <div class="sales-title">My Affiliate Products</div>
                    <div class="sales-table">
                      <div class="sales-header sales-row">
                        <!-- <span class="date">Date Created</span> -->
                        <span class="product">Product</span>
                        <span class="peference">Tracking Link</span>
                        <span class="date">Bought</span>
                        <span class="date">Share ($)</span>
                      </div>
                      <div v-for="affiliate in myAffiliates" :key="affiliate.id" class="sales-row">
                        <!-- <span class="date">{{ affiliate.created_at.substr(0, 10) }}</span> -->
                        <span class="product">{{ affiliate.product_name }}</span>
                          <span class="peference-link">{{ affiliate.affiliate_link }}</span>
                          <button @click="copyLink(affiliate)" class="copy">Copy</button>
                        <span class="state sold mr-lg-4">{{ affiliate.bought_count }}</span>
                        <span class="state sold">{{ (affiliate.share).toFixed(2) }}</span>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="your-earnings">
                <div class="payments-hisotry">
                  <div class="sales-title">Your Affiliate Share</div>
                  <div class="prices">
                    <div class="balance">
                      <div class="total">
                        <span class="key">Total</span>
                        <span class="value">{{ (total).toFixed(2) }}$</span>
                      </div>
                    </div>
                  </div>
                  
                  <!-- <div class="my-sales mb-5 mb-lg-2">
                    <div class="sales-title">Affiliate List</div>
                    <div class="sales-table">
                      <div class="sales-header sales-row">
                        <span class="date">Date Created</span>
                        <span class="peference">Tracking Code</span>
                        <span class="product">Product</span>
                        <span class="state">Bought Count</span>
                      </div>
                      <div v-for="affiliate in affiliates" :key="affiliate.id" class="sales-row">
                        <span class="date">{{ affiliate.created_at.substr(0, 10) }}</span>
                        <span class="peference">{{ affiliate.tracking_code }}</span>
                        <span class="product">{{ affiliate.product.name }}</span>
                        <span class="state sold">{{ affiliate.product_count }}</span>
                      </div>
                    </div>
                  </div> -->
                </div>
                <div class="payout-request mb-lg-4">
                  <div class="sales-title">Affiliate Payout</div>
                  <p class="text-left">
                    Your Earnings from Affiliating, will be added to your balance automaticly whenever a customer buys the product you are affiliating.
                    The total amount of your affiliating share will be added to the balance You can check it and request a withdraw from Sales Section.
                  </p>
                </div>
                

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Switch from "../../components/Profile/Affiliate/Switch.vue";
import { mapState } from "vuex";

export default {
  components: { Switch },
  data() {
    return {
      affiliating: this.$store.state.affiliate.affiliateData
    }
  },
  methods: {
    updateSwitchValue() {
      this.affiliating = !this.affiliating
      this.$store.dispatch("affiliate/toggle")
    },
    copyLink(affiliate) {
      const affiliateLink = affiliate.affiliate_link;
      console.log(affiliateLink);
      // Create a temporary input element
      const tempInput = document.createElement('input');
      tempInput.value = affiliateLink;
      document.body.appendChild(tempInput);

      // Select and copy the text
      tempInput.select();
      document.execCommand('copy');

      // Remove the temporary input element
      document.body.removeChild(tempInput);
    }
  },
  computed: {
    ...mapState("affiliate", ["affiliateInfo", "earnings", "myAffiliates"]),

    affiliates() {
      return this.affiliateInfo
    },
    total() {
      return this.earnings
    }

  }
};
</script>
<style>
.copy {
  font-size: 10px;
  font-weight: bold;
  border: 1px solid #3eadb7;
  border-radius: 8px;
  background: none;
  padding: 2px 5px;
  margin-right: 8px;
  transition: all 0.2s linear;
}
.copy:hover{
  color: #fff;
  background-color: #4e1b56;
  border: none;
}
.switch {
  width: 55px !important;
  height: 25px !important;
}
.slider:before {
  height: 20px !important;
  width: 20px !important;
  bottom: 3px !important;
}
</style>
<style lang="scss" scoped>
.page {
  margin: unset !important;
}

.dash-affiliate {
  margin: 100px auto 20px !important;
  padding: 10px;
  .flexing {
    display: flex;
    justify-content: space-between;
  }
}

.dash-affiliate .affiliate-header {
  padding: 38px 76px;
  background-color: rgba(201, 201, 201, 0.23);
  color: #040506;
  font-size: 20px;
  margin-bottom: 15px;
  position: relative;
  box-shadow: 1px 1px 5px #ccc;
  @media (max-width: 1400px) {
    padding: 20px 36px;
    font-size: 18px;
  }
  @media (max-width: 992px) {
    padding: 15px 26px;
    font-size: 16px;
  }
  @media (max-width: 576px) {
    padding: 10px 16px;
    font-size: 15px;
  }
}

.dash-affiliate .affiliate-link {
  width: 100%;
}
.dash-affiliate .affiliate-link .affiliate-header::after {
  content: "";
  position: absolute;
  top: 10%;
  right: 7px;
  background: #3eadb7;
  width: 3px;
  border-radius: 1px;
  height: 80%;
}
.dash-affiliate .affiliate-sales {
  flex-grow: 1;
}
.dash-affiliate .affiliate-sales .dash-sales {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  flex-direction: column-reverse;
  border: 1px solid #eee;
  padding: 20px;
  border-radius: 5px;
  @media (max-width: 576px) {
    padding: 20px 10px;
  }
}

.dash-sales .my-sales {
  flex-grow: 1;
  width: 97%;
  margin-right: 2%;
  border: 1px solid #eee;
  padding: 10px;
}
.dash-sales .sales-title {
  font-size: 24px;
  margin-bottom: 25px;
  color: #040506;
  text-align: left;
  @media (max-width: 1400px) {
    font-size: 18px;
    margin-bottom: 10px;
    font-weight: 600;
  }
}

.sales-table .sales-row {
  padding: 24px 17px;
  font-size: 20px;
  color: #040506;
  display: flex;
  text-align: left !important;
  justify-content: space-between;
  @media (max-width: 1400px) {
    padding: 20px 10px;
    font-size: 14px;
  }
  @media (max-width: 576px) {
    font-size: 12px;
  }
}
.sales-table .sales-row:nth-child(odd) {
  background-color: #f1f1f133;
}
.sales-table .sales-row.sales-header {
  padding: 5px 17px;
  font-weight: 600;
  font-size: 14px;
  background-color: #f1f1f1;
  @media (max-width: 576px) {
    font-size: 13px;
    padding: 5px;
  }
}

.sales-table .sales-row:nth-child(event) {
  background-color: #fff;
}
.sales-table .sales-row .date {
  width: 15%;
}

.sales-table .sales-row .peference {
  width: 25%;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.sales-table .sales-row .peference-link {
  width: 25%;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  @media (max-width: 520px) {
    display: none;
  }
}

.sales-table .sales-row .product {
  width: 35%;
  color: #3eadb7;
}
.sales-table .sales-row .state {
  width: 20%;
  // margin-left: 10px;
  text-align: center;
}
.sales-table .sales-row .state.sold {
  color: #3eadb7;
}
.sales-table .sales-row .state.closed {
  color: #fb5b5b;
}
.sales-table .sales-row .state.under-sale {
  color: #4e1b56;
}

.dash-sales .prices {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 20px;
  color: #040506;
  margin-bottom: 45px;
  @media (max-width: 1400px) {
    margin-bottom: 30px;
    margin-top: -5px;
  }
}
.dash-sales .prices .key {
  color: #9d9d9d;
  font-size: 16px;
}
.dash-sales .prices .value {
  color: #000;
  font-size: 16px;
  margin-left: 5px;
}

.dash-sales .payments-hisotry {
  background-color: rgba(241, 241, 241, 0.22);
  padding: 15px 20px;
  margin-bottom: 20px;
  border-radius: 10px;
  @media (max-width: 576px) {
    padding: 10px;
    margin-bottom: 20px;
  }
}

.sales-table .sales-row .payment {
  width: 40%;
}
.sales-table .sales-row .amount {
  width: 20%;
}
.sales-table .sales-row .status {
  width: 25%;
}
.sales-table .sales-row .status.success {
  color: #3eadb7;
}
.sales-table .sales-row .status.failed {
  color: #fb5b5b;
}

.dash-sales .payout-request {
  background: rgba(241, 241, 241, 0.22);
  padding: 15px 20px;
}
.dash-sales .payout-request p {
  font-size: 18px;
  color: #9d9d9d;
  @media (max-width: 1400px) {
    font-size: 15px;
  }
}

.dash-sales > div {
  flex-grow: 1;
  border-radius: 5px;
  width: 100%;
}

@media (max-width: 1200px) {
  .dash-affiliate {
    flex-wrap: wrap;
  }
  .dash-affiliate .affiliate-sales .dash-sales {
    flex-wrap: wrap;
  }
}

@media (max-width: 550px) {
  .sales-table .sales-row {
    flex-wrap: wrap;
  }

  .sales-table .sales-row > span {
    display: block;
    margin-bottom: 15px;
  }
}

/* Switch */

.dash-affiliate .affiliate-sales .affiliate-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
</style>
