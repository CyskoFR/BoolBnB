<template>
    <div class="container">
        <h2>Page not found</h2>
        <p>
            <router-link :to="{name: '/'}">Torna all'home page</router-link>
        </p>
    </div>
</template>

<script>
export default {
    name: 'Page404'
}
</script>

<style>

</style>