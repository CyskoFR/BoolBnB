<template>
    <div>
        <category-section></category-section>
        <filter-section class="py-5"></filter-section>
        <apartment-section></apartment-section>
    </div>
</template>

<script>
import ApartmentSection from "./sections/apartmentSection.vue";
import CategorySection from "./sections/categorySection.vue";
import FilterSection from "./sections/filterSection.vue";

export default {
    name: "SearchPage",
    components: { FilterSection, ApartmentSection, CategorySection },
    data() {
        return {
            apartments: [],
        };
    },

    created() {},
    methods: {},
};
</script>

<style lang="scss" scoped>
@import "../../sass/variables";
</style>
