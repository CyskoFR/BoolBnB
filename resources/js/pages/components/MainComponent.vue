<template>
    <section class="main">
        <!-- <CategorySection /> -->
        <HeroSection />
        <SponsoredSection />
    </section>
</template>

<script>
import CategorySection from "../sections/categorySection.vue";
// import ApartmentSection from "../sections/apartmentSection.vue";
import HeroSection from "../sections/heroSection.vue";
import SponsoredSection from "../sections/sponsoredSection.vue";

export default {
    name: "MainComponent",

    components: {
        CategorySection,
        HeroSection,
        SponsoredSection,
    },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/variables";

.main {
    background-color: $bg-primary-dark;
}
</style>
