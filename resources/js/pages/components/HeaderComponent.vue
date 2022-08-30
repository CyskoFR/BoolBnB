<template>
    <header>
        <div class="header-component container-fluid d-flex justify-content-between align-items-center">
            <img class="logo" src="../../../img/logo_boolbnb.png" alt="logo">
            <div class="header-user d-flex align-items-center justify-content-center">
                <font-awesome-icon icon="fa-regular fa-user" />
            </div>
        </div>
    </header>
</template>

<script>



export default {

    name: "HeaderComponent",

    components: { 

    }
};

</script>

<style lang="scss" scoped>

@import '../../../sass/variables';

.header-component {
    height: 4.375rem;
    background-color: $bg-primary-dark;
    padding: 1rem;
}

.logo {
    height: 100%;
}

.header-user {
    height: 2.5rem;
    width: 2.5rem;
    border: 2px solid $primary-green;
    border-radius: 50%;
}

.fa-user {
    color: $primary-green;
}

</style>