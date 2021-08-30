<template>
    <div class="support container my-5">
        <div class="row justify-content-center align-items-center">
            <div class="bg col-12 bg-gray-e"></div>
            <div class="image col">
                <img src="@/assets/support.png" alt="support" />
            </div>
            <div class="content col">
                <p>
                    {{ __("websiteName") }}<br />
                    {{ __("faqs.support") }}
                </p>
            </div>
            <div class="col button">
                <a :href="`mailto:${email}`" class="btn btn-primary"
                    >Communication</a
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["email"],
};
</script>

<style lang="scss" scoped>
.support {
    text-align: left;
    position: relative;
    .col {
        display: flex;
        align-items: center;
        justify-content: center;
        max-height: 50%;
    }
    .bg {
        position: absolute;
        width: 100%;
        height: 50%;
        z-index: -1;
    }
    .content p {
        font-size: 28px;
        font-weight: bold;
        color: #4e4e4e;
        &::first-line {
            color: #3eadb7;
        }
    }
    .button a {
        padding: 15px 50px;
        font-weight: bold;
        font-size: 20px;
    }
}
</style>
