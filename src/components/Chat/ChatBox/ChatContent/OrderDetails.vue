<template>
    <div class="content-order-details">
        <div class="order-details-summary">Saummary</div>
        <div class="order-details">
            <div class="order-details-list">
                <div class="product-with-price">
                    <span class="name">Name Product </span>
                    <span class="price">$200</span>
                </div>
                <div class="product-with-price total">
                    <span class="name">Total:</span>
                    <span class="price">$200</span>
                </div>
            </div>
            <div class="payment-method">
                <span class="key">Payment Mechanism :</span>
                <span class="value">Visa</span>
            </div>
            <div class="notes">Please Send All Project Files Within A Period Not Exceeding  Three Days.</div>
            <div class="status-order">Payment Completed Successfully</div>
        </div>
    </div>
</template>
<style scoped>
.chat-box .content-order-details{
    background: #FFF;
    padding: 25px 20px;
    border-radius: 20px;
    max-width: 575px;
}

.chat-box .chat-box-sender .content-order-details{
    border-top-left-radius: 0px;
}
        .chat-box .content-order-details .order-details-summary{
            font-size: 18px;
            font-weight: bold;
            color: #040506;
            margin-bottom: 20px;
        }
        .chat-box .content-order-details .order-details{
            max-width: 500px;
            margin: auto;
        }

        .chat-box .content-order-details .order-details-list{
            margin-bottom: 30px;
        }
        .chat-box .content-order-details  .product-with-price{
            display: flex;
            border-bottom: 1px solid #EEE;
            align-items: center;
            justify-content: space-between;
            font-size: 20px;
            color: #040506;
            padding: 8px 0px;
        }
        .chat-box .content-order-details .product-with-price.total{
            border-bottom: none;
        }
        .chat-box .content-order-details .payment-method{
            border-bottom: 1px solid rgba(201, 201, 201, 25%);
            border-top:  1px solid rgba(201, 201, 201, 25%);
            padding:12px 0px;
            margin-bottom:10px;
        }
        .chat-box .content-order-details .payment-method .key{
            font-size: 20px;
            color: #040506;
            margin-right: 12px;
        }
        .chat-box .content-order-details .payment-method .value{
            color: #9D9D9D;
        }

        .chat-box .content-order-details .notes{
            font-size: 18px;
            color: #9D9D9D;
            margin-bottom: 62px;
        }

        .chat-box .content-order-details .status-order{
            font-size: 20px;
            color: #040506;
            padding: 10px 0px;
            border-top: 1px solid #C9C9C9;
            border-bottom: 1px solid #C9C9C9;
            text-align: center;
        }
        @media(max-width:750px){
            .chat-box .content-order-details{
                flex-grow: 1;
                width: 100%;
                margin: 10px 0;
                border-radius: 4px;
            }
        }
        
</style>