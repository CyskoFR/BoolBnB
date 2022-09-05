<template>
    <div>
        <filter-section></filter-section>
        <apartment-section></apartment-section>
    </div>
</template>

<script>
import ApartmentSection from "./sections/apartmentSection.vue";
import FilterSection from "./sections/filterSection.vue";

export default {
    name: "SearchPage",
    components: { FilterSection, ApartmentSection },
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
