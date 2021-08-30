<template>
    <i :class="getClass"></i>
</template>

<script>
export default {
    props: {
        icon: {
            required: true,
            type: String,
        },
        style: {
            type: String,
            default: "regular",
        },
        straight: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        getClass() {
            return `fi-${
                this.style.split("")[0].toLowerCase() +
                (this.straight ? "s" : "r")
            }-${this.icon}`;
        },
    },
};
</script>

<style lang="scss" scoped></style>
