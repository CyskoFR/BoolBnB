<template>
    <header>
        <div class="header_component container-fluid d-flex justify-content-between align-items-center">
            <img class="logo" src="../../../img/logo_boolbnb.png" alt="logo">

            <div class="header_user d-flex align-items-center justify-content-center">
                <div class="dropdown">
                    <button class="user_dropdown btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        nome utente
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
                <div class="header_user_icon d-flex align-items-center justify-content-center">
                    <font-awesome-icon icon="fa-regular fa-user" />
                </div>
            </div>
        </div>
    </header>
</template>

<script>



export default {

    name: "HeaderComponent",

    components: { 

    },

};

</script>

<style lang="scss" scoped>

@import '../../../sass/variables';

.header_component {
    height: 4.375rem;
    background-color: $bg-primary-dark;
    padding: 1rem;
}

.logo {
    height: 100%;
}

.user_dropdown {
    color: $text-gray-light;
}

.user_dropdown {
    color: $text-gray-light;
}

.header_user_icon {
    height: 2.5rem;
    width: 2.5rem;
    border: 2px solid $primary-green;
    border-radius: 50%;
}

.fa-user {
    color: $primary-green;
}

</style>