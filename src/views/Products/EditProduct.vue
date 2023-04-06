<template>
    <div>
        <h1>{{ info.name}}</h1>
        <input type="text" v-model="info.name">
        <p>{{ info.price}}</p>
        <img :src="info.img">
        <p v-for="pack in selectedPackages" :key="pack.id">{{ pack }}</p>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    computed: {
        ...mapGetters('product', ['info', 'selectedPackages'])
  },
}

</script>