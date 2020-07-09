<template>
    <main>
        <navbar :key="$route.fullPath"></navbar>

        <div id="content-wrapper">
            <router-view></router-view>
        </div>
    </main>
</template>

<script>
import navbar from './NavBar.vue';

export default {
    components: {
        navbar
    },

    created() {
        if (!sessionStorage.getItem("user")) {
            this.$router.push("./login");
        } else {
            this.$router.push("./to-do-lists");
        }
    },
}
</script>