<template>
    <section class="sponsored">
        <div
            class="apartment_section row justify-content-center align-items-start container mx-auto"
        >
            <bnbCard
                class="sponsored-apartments col-4"
                :apartment="apartment"
                v-for="apartment in sponsoredApartments"
                :key="apartment.id"
            />
        </div>
    </section>
</template>

<script>
import axios from "axios";
import bnbCard from "../microComponents/bnbCard.vue";

export default {
    components: { bnbCard },
    name: "sponsoredSection",
    data() {
        return {
            sponsoredApartments: [],
        };
    },
    created() {
        axios.get("/api/apartments/sponsored").then((res) => {
            //console.log(res.data);
            this.sponsoredApartments = res.data;
        });
    },
};
</script>

<style lang="scss" scoped>
.apartment_section {
}
</style>
