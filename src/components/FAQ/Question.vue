<template>
    <div class="question d-flex mb-3">
        <div class="head d-flex">
            <h5>{{ item.question }}</h5>
            <p class="text-gray" v-date="item.date"></p>
        </div>
        <div class="body">
            {{ item.answer }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style lang="scss" scoped>
.question {
    flex-direction: column;
    text-align: left;
    .head {
        padding-right: 10px;
        text-transform: capitalize;
        justify-content: space-between;
        h5 {
            color: #363636;
            font-size: 18px;
            font-weight: bold;
            position: relative;
            max-width: 75%;
            height: stretch;
            &::after {
                position: absolute;
                left: 10px;
                bottom: -5px;
                width: 35%;
                height: 1px;
                border-bottom: 1px solid #aaa;
                content: "";
            }
        }
        p {
            font-size: 20px;
        }
    }
    .body {
        padding: 0 10px;
    }
}
</style>
