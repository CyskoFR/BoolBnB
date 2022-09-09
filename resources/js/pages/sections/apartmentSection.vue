<
<template>
    <div>
        <section
            v-if="observable.apartments"
            class="apartment_section d-flex justify-content-center flex-row p-3"
        >
            <bnbCard
                :apartment="apartment"
                v-for="apartment in observable.apartments"
                :key="apartment.id"
            />
        </section>
        <section
            v-else
            class="apartment_section d-flex justify-content-center flex-row p-3"
        >
            cerca un indirizzo decente
        </section>
    </div>
</template>

<script>
import bnbCard from "../microComponents/bnbCard.vue";
import observable from "../../observable.js";

export default {
    name: "apartmentSection",
    components: {
        bnbCard,
    },
    data() {
        return {
            observable,
        };
    },
    //on startup
    created() {
        observable.full_address = this.$route.params.param;
        axios
            .get("/api/apartments/search", {
                params: {
                    full_address: observable.full_address,
                    // rooms: observable.rooms,
                    // beds: observable.beds,
                    // distance: observable.distance,
                    // services: observable.selectedServices,
                },
            })
            .then((response) => {
                observable.apartments = response.data;
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    //when data changes
};
</script>

<style lang="scss" scoped>
@import "../../../sass/variables";

.apartment_section {
    flex-wrap: wrap;
    border-top: 1px solid $text-gray-dark;
    min-height: 18.75rem;
}
</style>
