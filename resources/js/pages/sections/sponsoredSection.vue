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
        <div class="py-4 cta d-flex justify-content-center">
            <button v-if="stopLoad == false" @click="nextPage" class="btn">
                Carica altro
            </button>
            <button v-else disabled @click="nextPage" class="btn">
                Hai esaurito gli annunci
            </button>
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
            currPage: 1,
            stopLoad: false,
        };
    },
    created() {
        axios.get("/api/apartments/sponsored").then((res) => {
            // console.log(res);
            this.sponsoredApartments = res.data;
        });
    },
    methods: {
        nextPage() {
            axios
                .get("/api/apartments/sponsored", {
                    params: {
                        page: ++this.currPage,
                    },
                })
                .then((res) => {
                    if (res.data) {
                        this.stopLoad = true;
                    }

                    console.log(res);
                    this.sponsoredApartments = this.sponsoredApartments.concat(
                        res.data
                    );
                });
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/variables";
button {
    background-color: $primary-green-light;
    color: $text-gray-light;
    font-weight: 600;
    &:hover {
        color: $text-gray-light;
        background-color: $primary-green-dark;
        border: 1px solid $primary-green-light;
    }
}
</style>
