<template>
    <component :is="headerComponent"></component>
    <router-view />
</template>

<script>
import { mapState } from "vuex";

import NoLoginHeader from "./components/template/NoLoginHeader.vue";
import LoggedInHeader from "./components/template/LoggedInHeader.vue";

export default {
    components: {},
    data() {
        return {};
    },
    computed: {
        headerComponent() {
            return this.loggedIn ? LoggedInHeader : NoLoginHeader;
        },
        ...mapState("user", ["loggedIn"]),
    },
};
</script>
