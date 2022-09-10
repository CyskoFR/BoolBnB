<
<template>
    <div>
        <section
            v-if="observable.apartments"
            class="apartment_section row justify-content-center align-items-start container mx-auto"
        >
            <bnbCard
                class="col-4"
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
        <div class="py-4 cta d-flex justify-content-center">
            <button
                v-if="currPage < observable.last_page"
                @click="nextPage"
                class="btn btn-primary"
            >
                Carica altro
            </button>
            <button v-else disabled @click="nextPage" class="btn btn-primary">
                Hai esaurito gli annunci
            </button>
        </div>
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
            currPage: 1,
            // stopLoad: false,
        };
    },
    //on startup
    created() {
        observable.full_address = this.$route.params.param;
        axios
            .get("/api/apartments/search", {
                params: {
                    full_address: observable.full_address,
                    page: 1,
                    // rooms: observable.rooms,
                    // beds: observable.beds,
                    // distance: observable.distance,
                    // services: observable.selectedServices,
                },
            })
            .then((response) => {
                observable.apartments = response.data.data;
                observable.last_page = response.data.last_page;
                observable.curr_page = response.data.current_page;
                console.log(response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    methods: {
        nextPage() {
            if (observable.last_page > observable.curr_page++) {
                if (observable.selectedServices.length == 0) {
                    axios
                        .get("/api/apartments/search?", {
                            params: {
                                full_address: observable.full_address,
                                rooms: observable.rooms,
                                beds: observable.beds,
                                distance: observable.distance,
                                category_id: observable.category_id,
                                page: observable.curr_page,
                            },
                        })
                        .then((response) => {
                            let { ...tempOld } = observable.apartments;
                            let tempAr = [];
                            for (const key in tempOld) {
                                tempAr.push(tempOld[key]);
                            }
                            let { ...tempNew } = response.data.data;
                            for (const key in tempNew) {
                                tempAr.push(tempNew[key]);
                            }
                            console.log(tempAr);
                            observable.apartments = tempAr;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios
                        .get("/api/apartments/search", {
                            params: {
                                full_address: observable.full_address,
                                rooms: observable.rooms,
                                beds: observable.beds,
                                distance: observable.distance,
                                category_id: observable.category_id,
                                services: this.selectedServicesString,
                                page: this.currPage,
                            },
                        })
                        .then((response) => {
                            let { ...tempOld } = observable.apartments;
                            let tempAr = [];
                            for (const key in tempOld) {
                                tempAr.push(tempOld[key]);
                            }
                            let { ...tempNew } = response.data.data;
                            for (const key in tempNew) {
                                tempAr.push(tempNew[key]);
                            }
                            console.log(tempAr);
                            observable.apartments = tempAr;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }
        },
    },
    //when data changes
};
</script>

<style lang="scss" scoped>
@import "../../../sass/variables";

.apartment_section {
    border-top: 1px solid $text-gray-dark;
    min-height: 18.75rem;
}
</style>
