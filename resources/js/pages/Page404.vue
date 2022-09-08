<template>
    <div class="container-fluid">
        <div class="card_404 text-center my-5">
            <h2>Pagina non trovata</h2>
            <p class="mt-3">
                <router-link :to="{name: 'home'}">
                    <button class="home_button btn mt-2"><b>Home</b></button>
                </router-link>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Page404'
}
</script>

<style lang="scss" scoped>

@import "../../sass/variables";
    .container-fluid {
        flex-grow: 1;
        background-color: $bg-secondary-dark;
    }

    h2 {
        color: $text-gray-light;
    }

    a {
        color: $primary-green;
    }
    .home_button {
        font-size: 0.875rem;
        background-color: $primary-green-light;
        border-radius: 0.75rem;
        &:hover {
            color: $text-gray-light;
            background-color: $primary-green-dark;
            border: 1px solid $primary-green-light;
        }
    }

</style>