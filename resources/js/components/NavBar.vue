<template>
    <nav class="navbar navbar-expand-sm navbar-dark bg-info mb-2">
        <div class="container">
            <a href="#" class="navbar-brand">To Do List App</a>

            <div v-if="isLoggedIn">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a
                            id="navbarDropdown"
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            {{ username }} <span class="caret"></span>
                        </a>

                        <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="navbarDropdown"
                        >
                            <a
                                class="dropdown-item"
                                href="#"
                                @click.prevent="logout"
                            >
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>

            <div v-else>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./#/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./#/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            user: {
                email: "",
                password: ""
            },
            isLoggedIn: false,
            username: ""
        };
    },

    created() {
        this.checkIfLoggedIn();
    },

    methods: {
        logout() {
            localStorage.clear();
            this.$router.push("./login");

            this.isLoggedIn = false;
        },

        checkIfLoggedIn() {
            if (localStorage.getItem("user")) {
                this.isLoggedIn = true;

                var user = JSON.parse(localStorage.getItem("user"));

                this.username = user.name;
            }
        }
    }
};
</script>
