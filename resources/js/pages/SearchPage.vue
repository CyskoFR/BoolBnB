<template>
    <div>
        <filter-section></filter-section>
        <bnbCard
            :apartment="apartment"
            v-for="apartment in apartments"
            :key="apartment.id"
        />
    </div>
</template>

<script>
import bnbCard from "./microComponents/bnbCard.vue";
import FilterSection from "./sections/filterSection.vue";

export default {
    name: "SearchPage",
    components: { bnbCard, FilterSection },
    data() {
        return {
            apartments: [],
            param: this.$route.params.param,
        };
    },

    created() {
        axios
            .get("/api/apartments/search", {
                params: {
                    full_address: this.param,
                    rooms: null,
                    beds: null,
                    category_id: null,
                    services: null,
                    distance: null,
                },
            })

            .then((response) => {
                this.apartments = response.data;
            });
    },
};
</script>

<style lang="scss" scoped>
@import "../../sass/variables";
</style>
