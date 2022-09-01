<template>
    <main>
        <CategorySection/>
        <ApartmentSection/>
        <HeroSection/>
    </main>
</template>

<script>

import CategorySection from '../sections/categorySection.vue';
import ApartmentSection from '../sections/apartmentSection.vue';
import HeroSection from '../sections/heroSection.vue';

export default {

    name: "MainComponent",

    components: { 
        ApartmentSection,
        CategorySection,
        HeroSection,
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