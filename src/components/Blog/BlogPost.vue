<template>
    <div class="post mb-4">
        <div>
            <div class="image mb-2">
                <img :src="getRandImg" alt="image" />
            </div>
            <div class="content w-100">
                <h5 class="name mb-0">{{ post.title }}</h5>
                <p class="date" v-date="post.date"></p>
                <p class="description">{{ post.details.substring(0, 100) }}</p>
            </div>
            <router-link
                :to="{
                    name: 'blogSingle',
                    params: { id: post.id },
                }"
                class="btn btn-outline-primary w-100"
                >{{ __("more") }}</router-link
            >
        </div>
    </div>
</template>

<script>
export default {
    props: {
        post: {
            type: Object,
            required: true,
        },
    },
    computed: {
        getRandImg: () => {
            return require(`@/assets/blog${Math.ceil(Math.random() * 3)}.png`);
        },
    },
};
</script>

<style lang="scss" scoped>
.post {
    background: white;
    box-shadow: 0 0 20px rgba($color: #c9c9c9, $alpha: 0.2);
    border-radius: 20px;
    padding: 10px !important;
    text-align: left;
    img {
        object-fit: none;
        width: 100%;
        height: 400px;
        border-radius: 20px;
    }
    .content {
        padding-left: 10px;
        font-size: 18px;
        color: #9d9d9d;
        h5,
        .date {
            font-weight: bold;
            font-size: 20px;
        }
        h5 {
            color: #040506;
        }
    }
}
</style>
