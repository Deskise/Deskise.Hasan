<template>
  <div>
    <div class="row">
      <div class="col-4">
        <div class="dash-slider-images">
          <div class="main-image">
            <img :src="product.img" />
          </div>
        </div>
      </div>
      <div class="col-8">
        <div>
          <div class="title">{{ product.name }}</div>
          <div class="price-category-order">
            <div class="price">
              <span class="new">{{ product.price }}$</span>
              <span class="old">350$</span>
            </div>
            <div class="categroy-order">
              <span class="order">#{{ product.id }}</span>
            </div>
          </div>
          <p>{{ product.description.slice(0, 70) }}...</p>
        </div>
      </div>
    </div>
    <div class="footer-features">
      <div class="feature" v-if="product.verified">
        <flat-icon-component icon="crown" class="icon"></flat-icon-component>
        Verified Deskise
      </div>
      <div class="feature" v-if="product.special">
        <flat-icon-component
          icon="shield-check"
          class="icon"
        ></flat-icon-component>
        Special Item
      </div>
    </div>
    <div class="paymentDiv">
      <p class="grey">SAUMMARY</p>
      <div class="flexing">
        <p>NAME PRODUCT:</p>
        <p>{{ product.price }}$</p>
      </div>
      <div class="flexing">
        <p>TOTAL:</p>
        <p class="color">{{ product.price }}$</p>
      </div>
      <div class="paymentMethod">
        <p class="mb-0">
          <font-awesome-component
            icon="shield-check"
            :bold="false"
          ></font-awesome-component>
        </p>
        <p class="grey">In Invoice Will Be Sent Via Eamil</p>
        <div class="Checkout mt-1">
          <p>CHECKOUT</p>
          
          <!-- <div class="list-group">
            <a
              class="mb-2 list-group-item list-group-item-action active"
              aria-current="true"
            >
              <div class="flexed">
                <div>
                  <div class="img-visa">
                    <img src="@/assets/Visa.png" class="img-fluid" alt="" />
                  </div>
                </div>
                <div>
                  <input readonly type="password" value="1234" />
                </div>
                <div>
                  <input readonly type="password" value="1234" />
                </div>
                <div>
                  <input readonly type="password" value="1234" />
                </div>
                <div>
                  <p>1421</p>
                </div>
                <div>
                  <p>05/32</p>
                </div>
                <div class="checked">
                  <span></span>
                </div>
              </div>
            </a>
            <a class="mb-2 list-group-item list-group-item-action">
              <div class="flexed">
                <div>
                  <div class="img-visa">
                    <img src="@/assets/master.png" class="img-fluid" alt="" />
                  </div>
                </div>
                <div>
                  <input readonly type="password" value="1234" />
                </div>
                <div>
                  <input readonly type="password" value="1234" />
                </div>
                <div>
                  <input readonly type="password" value="1234" />
                </div>
                <div>
                  <p>1421</p>
                </div>
                <div>
                  <p>05/32</p>
                </div>
                <div class="checked">
                  <span></span>
                </div>
              </div>
            </a>
            <a class="mb-2 list-group-item list-group-item-action">
              <p class="mb-1 text-center">Add Card</p>
            </a>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  
  name: "buyOffinsive",
  props: ["product"],
};
</script>
<style scoped>
.offcanvas-body {
  overflow-y: scroll !important;
  padding-bottom: 20px;
  min-width: 400px !important;
}
.offcanvas-body .main-image img {
  width: 100%;
  border-radius: 7px;
}
.offcanvas-body .main-image {
  box-shadow: unset !important;
  padding: 0px !important;
}
.offcanvas-body .dash-slider-images,
.offcanvas-body .dash-slider-images .main-image,
.offcanvas-body .dash-slider-images .main-image img {
  height: 100% !important;
}
.offcanvas-body .title {
  font-size: 17px !important;
  font-weight: 600;
}
.offcanvas-body .price-category-order {
  font-size: 14px !important;
  margin-bottom: 5px !important;
  display: flex;
  justify-content: space-between;
}
.offcanvas-body .price-category-order .new {
  color: #3eadb7;
  font-weight: 600;
  margin-right: 4px;
}
.offcanvas-body .price-category-order .old {
  color: grey;
  text-decoration: line-through;
  font-size: 12px;
}
.offcanvas-body > div:first-of-type p {
  font-size: 13px !important;
  color: grey;
}
.offcanvas-body .footer-features {
  justify-content: center;
  margin: 20px 0;
  display: flex;
  justify-content: center;
  font-size: 13px;
}
.offcanvas-body .footer-features .feature:first-of-type {
  border-right: 1px solid #ccc;
  padding-right: 10px;
  margin-right: 10px;
}
.offcanvas-body .paymentDiv {
  background-color: rgb(247, 247, 247);
  border-top: 2px solid #ddd;
  padding: 10px;
  padding-bottom: 10px;
}
.offcanvas-body .paymentDiv p {
  margin-bottom: 4px;
}
.offcanvas-body .paymentDiv p.grey {
  color: grey;
}
.offcanvas-body .paymentDiv .flexing {
  display: flex;
  justify-content: space-between;
  font-size: 14px;
  margin: 5px 0;
}
.offcanvas-body .paymentDiv .flexing:first-of-type {
  border-bottom: 1px solid #eee;
}
.offcanvas-body .paymentDiv .flexing p {
  font-weight: 500;
  color: #000;
}
.offcanvas-body .paymentDiv .flexing p.color {
  color: #3eadb7;
}
.offcanvas-body .paymentMethod {
  margin-top: 10px;
}
.offcanvas-body .paymentMethod > p {
  text-align: center;
}
.offcanvas-body .paymentMethod i {
  color: #3eadb7;
  font-size: 20px;
}
.offcanvas-body .flexed {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 13px;
}
.offcanvas-body .flexed input {
  background-color: transparent;
  border: none;
  width: 30px;
}
.offcanvas-body .flexed .checked {
  width: 50px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.offcanvas-body .flexed .checked span {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  display: block;
}
.offcanvas-body a.list-group-item-action.active .flexed .checked span {
  background-color: #3eadb7;
}
.offcanvas-body .flexed > div:nth-of-type(1) {
  margin-right: 10px;
}
.offcanvas-body .flexed > div:nth-of-type(4) {
  margin-right: 20px;
}
.offcanvas-body .flexed p {
  font-weight: 600;
  margin: 0 10px;
}
.offcanvas-body .list-group-item {
  border-radius: 7px !important;
  background-color: transparent;
  border: 1px solid rgb(180, 180, 180);
  cursor: pointer;
}
.offcanvas-body .list-group-item.active {
  background-color: transparent;
  border: 1px solid #3eadb7;
  color: #000;
}
</style>
