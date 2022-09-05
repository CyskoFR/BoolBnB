<
<template>
    <section
        class="apartment_section d-flex justify-content-center flex-row p-3"
    >
        <bnbCard
            :apartment="apartment"
            v-for="apartment in apartments"
            :key="apartment.id"
        />
    </section>
</template>

<script>
import bnbCard from "../microComponents/bnbCard.vue";

export default {
    name: "apartmentSection",

    components: {
        bnbCard,
    },
    props: {
        queryInfo: Object,
    },

    data() {
        return {
            apartments: [],
        };
    },
    //on startup
    created() {
        axios
            .get("/api/apartments/search", {
                params: {
                    full_address: this.$route.params.param,
                    rooms: null,
                    beds: null,
                    distance: null,
                },
            })
            .then((response) => {
                this.apartments = response.data;
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    //when data changes
    watch: {
        filteredApartments: function () {
            axios
                .get("/api/apartments/search", {
                    params: {
                        full_address:
                            this.queryInfo.full_address ??
                            this.$route.params.param,
                        rooms: this.queryInfo.rooms,
                        beds: this.queryInfo.beds,
                        distance: this.queryInfo.distance,
                    },
                })
                .then((response) => {
                    console.log(response);
                    return (this.apartments = response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/variables";

.apartment_section {
    flex-wrap: wrap;
}
</style>
