<template>
  <div class="dash-affiliate">
    <div class="container">
        <div class="col-12">
          <div class="affiliate-sales">
            <div class="dash-sales">
              <div class="payout-request">
                    <div class="sales-title">Payout Request</div>
                    <p>
                      Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed
                      Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna
                      Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et
                      Justo Duo Dolores Et Ea Rebum. Stet Clita Kasd Gubergren, No
                      Sea Takimata Sanctus Est Lorem Ipsum Dolor Sit Amet. Lorem
                      Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam
                      Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna
                      Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et
                      Justo Duo Dolores Et Ea Rebum. Stet Clita Kasd Gubergren, No
                      Sea Takimata Sanctus Est Lorem Ipsum Dolor Sit Amet
                    </p>
                  </div>
              <div class="my-sales mb-5 mb-lg-2">
                <div class="sales-title">My Sales</div>
                <div class="sales-table">
                  <div class="sales-header sales-row">
                    <span class="date">Date</span>
                    <span class="product">product</span>
                    <span class="peference">Price</span>
                    <span class="state">State</span>
                  </div>
                  <div v-for="product in productsSales" :key="product.id" class="sales-row">
                    <span class="date">{{ product.created_at.substr(0, 10) }}</span>
                    <span class="product">{{ product.product.name }}</span>
                    <span class="peference">{{ product.price }}</span>
                    <span class="state sold">{{ product.product.status }}</span>
                  </div>
                </div>
              </div>
              <div class="your-earnings">
                <div class="payments-hisotry">
                  <div class="sales-title">Your Eranings</div>
                  <div class="prices">
                    <div class="balance">
                      <span class="key">Current Blance</span>
                      <span class="value">{{ userBalance }}$</span>
                      <div class="total">
                        <span class="key">Total</span>
                        <span class="value">{{total}}$</span>
                      </div>
                    </div>
                    <div class="total">
                      <button
                        type="submit"
                        class="btn w-100 btn-primary px-5 py-2"
                        name="submit"
                        @click="withdraw"
                      >
                        Withdraw
                      </button>
                    </div>
                  </div>
                </div>

                <div class="payments-hisotry">
                  <div class="sales-title">Last Withdraw</div>
                  <div class="sales-table">
                    <div class="sales-header sales-row">
                      <span class="date">Date</span>
                      <span class="peference">Amount</span>
                      <span class="state">State</span>
                    </div>
                    <div v-if="lastWithdrawRequest" class="sales-row">
                      <span class="date">{{ lastWithdrawRequest.created_at.substr(0, 10) }}</span>
                      <span class="peference">{{ lastWithdrawRequest.amount }}$</span>
                      <span class="state sold">{{ lastWithdrawRequest.status }}</span>
                    </div>
                    <div v-if="!lastWithdrawRequest" class="d-flex justify-content-center align-items-center mt-4">
                      <p>You did not Request Withdraw YET!</p>
                    </div>
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
import { mapState } from "vuex";
export default {
  methods: {
    async withdraw() {
      this.$router.push({ name: "dashboard.wirhdraw" });
    },
    
    formatDate(timestamp) {
      const date = new Date(timestamp);
      return date.toISOString().split('T')[0]; // Extracts only the date part
    }
  },
  computed: {
    ...mapState("user", ["userSales"]),
    total() {
      return this.userSales.total.toFixed(2)
    },
    productsSales() {
      return this.userSales.userSales
    },
    lastWithdrawRequest() {
      return this.userSales.lastWithdrawRequest
    },
    userBalance() {
      return this.userSales.userBalance.toFixed(2)
    }

  }
};
</script>
<style>
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
  margin: 10px auto 20px !important;
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
  flex-direction: column-reverse;
  justify-content: space-between;
  // border: 1px solid #eee;
  // padding: 20px;
  // border-radius: 5px;

  @media (max-width: 576px) {
    padding: 20px 10px;
  }
}

.dash-sales .my-sales {
  flex-grow: 1;
  // width: 97%;
  margin-block: 2%;
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
}

.sales-table .sales-row .product {
  width: 35%;
  color: #3eadb7;
}

.sales-table .sales-row .state {
  width: 25%;
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
  margin-bottom: 10px;

  @media (max-width: 1400px) {
    margin-bottom: 10px;
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
  margin-bottom: 10px;
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

.dash-sales>div {
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

  .sales-table .sales-row>span {
    display: block;
    margin-bottom: 15px;
  }
}

/* Switch */

.dash-affiliate .affiliate-sales .affiliate-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}</style>
