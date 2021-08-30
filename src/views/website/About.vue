<template>
    <div class="about">
        <div class="container">
            <div class="row">
                <h2 class="mb-3">{{ __("header.nologin.about") }}</h2>
            </div>
            <div class="container">
                <p class="text-gray lead">{{ about }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["about"],
};
</script>

<style lang="scss" scoped></style>
