<template>
    <main>
        <navbar />

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
    }
}
</script>