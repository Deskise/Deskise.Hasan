<template>
  <div class="dash-affiliate">
    <div class="affiliate-link">
      <div class="affiliate-header">Affiliate Link</div>
    </div>
    <div class="affiliate-sales">
      <div class="affiliate-header">
        <span>Activate or stop selling through marketers.</span>
        <Switch checked></Switch>
      </div>
      <div class="dash-sales">
        <div class="my-sales">
          <div class="sales-title">My Sales</div>
          <div class="sales-table">
            <div class="sales-header sales-row">
              <span class="date">Date</span>
              <span class="peference">Peference</span>
              <span class="product">product</span>
              <span class="state">State</span>
            </div>
            <div class="sales-row">
              <span class="date">13 Juli</span>
              <span class="peference">#328178</span>
              <span class="product">Name product</span>
              <span class="state sold">Sold 200$</span>
            </div>
            <div class="sales-row">
              <span class="date">13 Juli</span>
              <span class="peference">#328178</span>
              <span class="product">Name product</span>
              <span class="state closed">Closed</span>
            </div>
            <div class="sales-row">
              <span class="date">13 Juli</span>
              <span class="peference">#328178</span>
              <span class="product">Name product</span>
              <span class="state under-sale">Under Sale</span>
            </div>
          </div>
        </div>
        <div class="your-earnings">
          <div class="payments-hisotry">
            <div class="sales-title">Your Eranings</div>
            <div class="prices">
              <div class="balance">
                <span class="key">Current Blance</span>
                <span class="value">200$</span>
              </div>
              <div class="total">
                <span class="key">Total</span>
                <span class="value">1050$</span>
              </div>
            </div>
            <div class="sales-title">Payout History</div>
            <div class="sales-table">
              <div class="sales-header sales-row">
                <span class="date">Date</span>
                <span class="payment">Payment Method</span>
                <span class="amount">Amount</span>
                <span class="status">Status</span>
              </div>
              <div class="sales-row">
                <span class="date">13 Juli</span>
                <span class="payment">Visa</span>
                <span class="amount">200$</span>
                <span class="status success">Successfully</span>
              </div>
              <div class="sales-row">
                <span class="date">13 Juli</span>
                <span class="payment">Paypal</span>
                <span class="amount">1200$</span>
                <span class="status failed">Failure</span>
              </div>
              <div class="sales-row">
                <span class="date">13 Juli</span>
                <span class="payment">Visa</span>
                <span class="amount">200$</span>
                <span class="status success">Successfully</span>
              </div>
              <div class="sales-row">
                <span class="date">13 Juli</span>
                <span class="payment">Paypal</span>
                <span class="amount">1200$</span>
                <span class="status failed">Failure</span>
              </div>
            </div>
          </div>

          <div class="payout-request">
            <div class="sales-title">Payout Request</div>
            <p>
              Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam
              Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam
              Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo
              Dolores Et Ea Rebum. Stet Clita Kasd Gubergren, No Sea Takimata
              Sanctus Est Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit
              Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod Tempor
              Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed Diam
              Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et Ea Rebum.
              Stet Clita Kasd Gubergren, No Sea Takimata Sanctus Est Lorem Ipsum
              Dolor Sit Amet
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Switch from "../../components/Profile/Affiliate/Switch.vue";
export default {
  components: { Switch },
};
</script>

<style lang="scss" scoped>
.dash-affiliate {
  max-width: 1640px;
  margin: auto !important;
  gap: 30px;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 10px;
}

.dash-affiliate .affiliate-header {
  padding: 38px 76px;
  background-color: rgba(201, 201, 201, 0.23);
  color: #040506;
  font-size: 20px;
  margin-bottom: 15px;
  position: relative;
}
.dash-affiliate .affiliate-link {
  max-width: 370px;
  width: 100%;
}
.dash-affiliate .affiliate-link .affiliate-header::after {
  content: "";
  position: absolute;
  top: 10px;
  bottom: 10 px;
  right: 10px;
  background: #3eadb7;
  width: 5px;
  border-radius: 2px;
}
.dash-affiliate .affiliate-sales {
  flex-grow: 1;
}
.dash-affiliate .affiliate-sales .dash-sales {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 30px;
}

.dash-sales .my-sales {
  flex-grow: 1;
  max-width: 570px;
  width: 100%;
}
.dash-sales .sales-title {
  font-size: 24px;
  margin-bottom: 25px;
  color: #040506;
  text-align: left;
}

.sales-table .sales-row {
  padding: 24px 17px;
  font-size: 20px;
  color: #040506;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.sales-table .sales-row.sales-header {
  padding: 5px 17px;
}
.sales-table .sales-row:nth-child(odd) {
  background-color: #f1f1f1;
}
.sales-table .sales-row:nth-child(event) {
  background-color: #fff;
}
.sales-table .sales-row .date {
  width: 70px;
}

.sales-table .sales-row .peference {
  width: 90px;
}

.sales-table .sales-row .product {
  width: 130px;
  color: #3eadb7;
}
.sales-table .sales-row .state {
  width: 100px;
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
}
.dash-sales .prices .key {
  color: #9d9d9d;
}

.dash-sales .payments-hisotry {
  background-color: rgba(241, 241, 241, 0.22);
  padding: 15px 20px;
  margin-bottom: 50px;
}

.sales-table .sales-row .payment {
  width: 150px;
}
.sales-table .sales-row .amount {
  width: 70px;
}
.sales-table .sales-row .status {
  width: 120px;
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
}

.dash-sales > div {
  max-width: 50%;
  flex-grow: 1;
  width: 100%;
}

@media (max-width: 1350px) {
  .dash-affiliate .affiliate-header {
    padding: 30px;
  }
}

@media (max-width: 1200px) {
  .dash-affiliate {
    flex-wrap: wrap;
  }
  .dash-affiliate > div {
    max-width: 100%;
    width: 100%;
  }
}

@media (max-width: 1000px) {
  .dash-affiliate .affiliate-sales .dash-sales {
    flex-wrap: wrap;
  }
  .dash-affiliate .affiliate-sales .dash-sales > div {
    width: 100%;
    max-width: 100%;
  }
}

@media (max-width: 550px) {
  .sales-table .sales-row {
    flex-wrap: wrap;
  }

  .sales-table .sales-row > span {
    width: 50% !important;
    max-width: 50%;
    display: block;
    margin-bottom: 15px;
  }

  .sales-table .sales-row > span:nth-child(2n) {
    text-align: right;
  }
  .dash-sales .payments-hisotry,
  .dash-sales .payout-request {
    padding: 10px 0;
  }
  .dash-affiliate .affiliate-header {
    padding: 20px 10px;
    font-size: 20px;
  }
}

/* Switch */

.dash-affiliate .affiliate-sales .affiliate-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
</style>
