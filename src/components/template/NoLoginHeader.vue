<template>
    <nav class="navbar navbar-expand-lg border-bottom noLogin">
        <div class="container-fluid">
            <router-link class="navbar-brand" to="/">
                <img
                    src="@/assets/logo.png"
                    alt="logo"
                    class="img-fluid border-right"
                />
            </router-link>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">
                            {{ __("header.nologin.home") }}
                        </router-link>
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            {{ __("header.nologin.category") }}
                        </a>
                        <ul
                            class="dropdown-menu"
                            aria-labelledby="navbarDropdown"
                        >
                            <li
                                v-for="(category, index) in categories"
                                :key="index"
                            >
                                <router-link
                                    :to="{
                                        name: 'productsByCategory',
                                        params: { id: category.id },
                                    }"
                                    class="dropdown-item"
                                >
                                    {{ category.name }}
                                    <span></span>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'about' }">
                            {{ __("header.nologin.about") }}
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'action' }">
                            {{ __("header.nologin.mech") }}
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'terms' }">
                            {{ __("header.nologin.terms") }}
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'privacy' }">
                            {{ __("header.nologin.privacy") }}
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'faq' }">
                            {{ __("header.nologin.FAQ") }}
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'blog' }">
                            {{ __("header.nologin.blog") }}
                        </router-link>
                    </li>
                </ul>
                <router-link :to="{ name: 'login' }" v-slot="{ navigate }">
                    <button class="btn btn-primary login" @click="navigate">
                        {{ __("header.nologin.login") }}
                    </button>
                </router-link>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapState } from "vuex";
export default {
    computed: {
        ...mapState("category", ["categories"]),
    },
};
</script>

<style lang="scss" scoped></style>
