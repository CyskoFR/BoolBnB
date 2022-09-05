<template>
    <div>
        <filter-section v-on:filter-update="emitHandle"></filter-section>
        <apartment-section :queryInfo="data"></apartment-section>
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
            data: {},
            apartments: [],
        };
    },

    created() {},
    methods: {
        emitHandle(e) {
            this.data = e;
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../sass/variables";
</style>
