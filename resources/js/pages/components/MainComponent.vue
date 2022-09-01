<template>
    <main>
        <CategorySection/>
        <ApartmentSection/>
    </main>
</template>

<script>

import CategorySection from '../sections/categorySection.vue';
import ApartmentSection from '../sections/apartmentSection.vue';

export default {

    name: "MainComponent",

    components: { 
        ApartmentSection,
        CategorySection,
    }
};

</script>

<style lang="scss" scoped>

@import '../../../sass/variables';

main {
    background-color: $bg-primary-dark;
    height: 100vh;
}

</style>