<template>
  <div class="chat-attachment">
    <span id="close-agreements"><i class="fa fa-times"></i></span>
    <div class="chat-product">
      <div class="product-info">
        <div class="product-title-and-price">
          <div class="product-title">Name Product ..........T</div>
          <div class="product-price-discount">
            <span class="product-price">200$</span>
            <span class="product-old-price">350$</span>
          </div>
        </div>
        <div class="product-action-and-order">
          <button class="btn-primary product-btn">Stop Selling</button>
          <span class="product-order">#3123</span>
        </div>
      </div>
      <div class="product-details">
        Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy
        Eirmod Tempor Invidunt Ut Labore
      </div>
    </div>
    <div class="chat-attachment-tabs">
      <ul class="tabs-links">
        <li>
          <a class="link active" href="javascript:void(0)">Agreemnts</a>
        </li>
        <li><a class="link" href="javascript:void(0)">Files</a></li>
        <li><a class="link" href="javascript:void(0)">Rules</a></li>
      </ul>
      <div class="agreemet-tab">
        <div class="dash-agreement">
          <div class="agreement-title">Agreement Details</div>
          <p class="agreement-details">
            Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
            <button class="btn-primary read-agreement-btn">
              Read Agreement
            </button>
          </p>
        </div>
        <div class="dash-agreement">
          <div class="agreement-title">Agreement Details</div>
          <p class="agreement-details">
            Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
            <button class="btn-primary read-agreement-btn">
              Read Agreement
            </button>
          </p>
        </div>
        <div class="dash-agreement">
          <div class="agreement-title">Agreement Details</div>
          <p class="agreement-details">
            Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
            <button class="btn-primary read-agreement-btn">
              Read Agreement
            </button>
          </p>
        </div>
      </div>
    </div>
    <div class="dash-hsitory-calls">
      <div class="history-call missed">
        <div class="image">
          <img src="@/assets/chat-avatar.png" />
        </div>
        <div class="history-call-info">
          <div class="history-call-contact">Hilda Hansen</div>
          <div class="history-call-status">
            <span class="history-call-text">Missed Call From You</span>
            <span class="history-call-time">08:43 Am</span>
          </div>
        </div>
        <div class="history-call-icon">
          <i class="fa fa-phone-slash"></i>
        </div>
      </div>
      <div class="history-call">
        <div class="image">
          <img src="@/assets/chat-avatar.png" />
        </div>
        <div class="history-call-info">
          <div class="history-call-contact">Hilda Hansen</div>
          <div class="history-call-status">
            <span class="history-call-text">Missed Call From You</span>
            <span class="history-call-time">08:43 Am</span>
          </div>
        </div>
        <div class="history-call-icon">
          <i class="fa fa-phone"></i>
        </div>
      </div>
      <div class="history-call">
        <div class="image">
          <img src="@/assets/chat-avatar.png" />
        </div>
        <div class="history-call-info">
          <div class="history-call-contact">Hilda Hansen</div>
          <div class="history-call-status">
            <span class="history-call-text">Missed Call From You</span>
            <span class="history-call-time">08:43 Am</span>
          </div>
        </div>
        <div class="history-call-icon">
          <i class="fa fa-phone"></i>
        </div>
      </div>
    </div>
    <div class="ringing-call">
      <div class="avatar-image lg">
        <img src="@/assets/chat-avatar.png" />
      </div>
      <div class="ringing-info">
        <div class="contact-name">Hilda Hansen</div>
        <div class="call-status">Call you</div>
      </div>
      <div class="ringing-actions">
        <a href="javascript:void(0)" class="action action-close"
          ><i class="fa fa-times"></i
        ></a>
        <a href="javascript:void(0)" class="action action-answer"
          ><i class="fa fa-phone"></i
        ></a>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.chat-attachment {
  max-width: 390px;
  padding: 20px 35px;
  background-color: #fff;
  position: relative;

  .chat-product {
    margin-bottom: 10px;
    padding-bottom: 25px;
    border-bottom: 1px solid rgba(16, 27, 79, 10%);

    .product-info {
      display: flex;
      justify-content: space-between;
    }
    .product-action-and-order {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
    }
    .product-title {
      color: #040506;
      font-size: 20px;
      margin-bottom: 5x;
      font-weight: bold;
    }
    .product-price-discount {
      display: flex;
    }
    .product-price {
      color: #3eadb7;
      font-weight: bold;
      font-size: 20px;
      display: inline-block;
      margin-right: 8px;
    }
    .product-old-price {
      font-size: 16px;
      text-decoration: line-through;
    }
    .product-btn {
      padding: 7px;
      background: none;
      border: 1px solid #3eadb7;
      color: #3eadb7;
      margin-bottom: 5px;
      font-weight: 400;
    }
    .product-order {
      font-size: 20px;
      color: #9b9b9b;
    }
    .product-details {
      font-size: 18px;
      margin-bottom: 15px;
    }
  }

  .chat-attachment-tabs {
    margin-bottom: 20px;
    .tabs-links {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid rgba(16, 27, 79, 10%);
      margin-bottom: 15px;
      .link {
        font-size: 18px;
        color: #040506;
        text-align: center;
        &.active {
          color: #e590b5;
          border-bottom: 1px solid #e590b5;
        }
      }
      .ringing-call {
        position: absolute;
        bottom: 0;
        left: 20px;
        right: 20px;

        .avatar-image.lg {
          width: 78px;
          height: 78px;
          line-height: 78px;
        }
        .ringing-actions {
          display: flex;
          justify-content: space-between;
          align-items: center;
          gap: 18px;
          .action {
            width: 35px;
            height: 35px;
            line-height: 35px;
            text-align: center;
            border-radius: 50%;
            font-size: 18px;
          }
          .action-close {
            background-color: #fb5b5b;
            color: #fff;
          }
          .action-answer {
            background-color: #ffffff;
            color: #3eadb7;
          }
        }
      }
    }
  }
}
</style>
