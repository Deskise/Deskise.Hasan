<template>
    <div class="action">
        <div class="container-fluid">
            <div class="row">
                <h2 class="mb-3">{{ __("header.nologin.mech") }}</h2>
            </div>
            <div class="container-fluid packages-container">
                <p class="text-gray lead mb-4">{{ __("mech.text") }}</p>
                <swiper :slidesPerView="5" :spaceBetween="15" class="packages">
                    <swiper-slide v-for="pack in packages" :key="pack.id">
                        <div
                            class="
                                bg-gray-e bg-hover-gradiant
                                text-center
                                h-100
                                d-flex
                            "
                        >
                            <div class="head">
                                <p class="text-gray mb-0">
                                    {{ pack.name }}
                                </p>
                                <p class="price text-bold">
                                    {{ pack.price }}
                                </p>
                            </div>
                            <div class="body my-3 text-gray">
                                {{ pack.details }}
                            </div>
                            <div class="end text-gray">
                                <p>{{ pack.quantity }} {{ pack.duration }}</p>
                            </div>
                        </div>
                    </swiper-slide>
                </swiper>
            </div>
        </div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import { mapState } from "vuex";
export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    computed: {
        ...mapState("data", ["packages"]),
    },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
.packages-container {
    width: 75%;

    & > p {
        font-size: 24px;
        width: 100%;
        max-width: 478px;
        word-break: break-word;
        margin: auto;
        text-transform: capitalize;
    }
    .packages {
        width: 100%;
        height: 100%;
        align-content: center;

        .swiper-slide {
            text-align: center;
            font-size: 20px !important;
            background: #fff;
            height: unset !important;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;

            div {
                flex-direction: column;
                justify-content: space-between;
                padding: 17px 5px;
                border-radius: 10px;
                text-transform: capitalize;

                .head {
                    position: relative;
                    .price {
                        font-size: 60px;
                        position: relative;
                        width: fit-content;
                        margin: auto;

                        &::before {
                            content: "$";
                            font-size: 27px;
                            font-weight: 100;
                            position: absolute;
                            top: 15px;
                            left: -15px;
                        }
                    }

                    &::after {
                        content: "";
                        height: 1px;
                        width: 50%;
                        background: $gray;
                        position: absolute;
                        bottom: 0;
                        left: 25%;
                    }
                }
                .end {
                    position: relative;

                    p {
                        margin: 0;
                    }

                    &::before {
                        content: "";
                        height: 1px;
                        width: 50%;
                        background: $gray;
                        position: absolute;
                        top: 0;
                        left: 25%;
                    }
                }

                &:hover {
                    p,
                    div {
                        color: white !important;
                    }
                    .head {
                        &::after {
                            background: white;
                        }
                    }
                    .end {
                        &::before {
                            background: white;
                        }
                    }
                }
            }
        }
    }
}
</style>
