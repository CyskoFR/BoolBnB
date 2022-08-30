<template>
    <header>
        <div class="header-component container-fluid">
            <div class="row justify-space-between">
                <img src="../../../img/logo_boolbnb.png" alt="logo">
                <div class="header-user">
                    
                </div>
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
    background-color: black;
}
.fa-address-card {
    color: purple;
}

</style>