<template>
    <nav class="navbar navbar-expand-lg border-bottom">
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
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Home</router-link>
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
                            Dropdown
                        </a>
                        <ul
                            class="dropdown-menu"
                            aria-labelledby="navbarDropdown"
                        >
                            <li>
                                <a class="dropdown-item" href="#">Action</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    >Another action</a
                                >
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    >Something else here</a
                                >
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/about"
                            >About Us</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/action"
                            >Mechanism Of Action</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/terms"
                            >Terms Of Use</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/privacy"
                            >Privacy Policy</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/common"
                            >Common Questions</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/blog"
                            >Blog</router-link
                        >
                    </li>
                </ul>
                <button class="btn btn-primary" type="submit">
                    Login/Signup
                </button>
            </div>
        </div>
    </nav>
</template>

<script>
export default {};
</script>
