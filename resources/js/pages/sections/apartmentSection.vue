<template>
    <div class="apartment_bg">
        <div v-if="observable.ready">
            <section
                v-if="Object.keys(observable.apartments).length > 0"
                class="apartment_section row justify-content-center align-items-start container mx-auto pt-4"
            >
                <bnbCard
                    class="col-12 col-md-6 col-xl-3"
                    :apartment="apartment"
                    v-for="apartment in observable.apartments"
                    :key="apartment.id"
                />
            </section>
            <section
                v-else
                class="apartment_section d-flex justify-content-center flex-row p-3"
            >
                <h2>
                    Nessun risultato trovato, prova modificare i filtri di
                    ricerca
                </h2>
            </section>
            <div class="py-4 cta d-flex justify-content-center">
                <button
                    v-if="observable.curr_page < observable.last_page"
                    @click="nextPage"
                    class="btn btn-primary"
                >
                    Carica altro
                </button>
                <button
                    v-else
                    disabled
                    @click="nextPage"
                    class="btn btn-primary"
                >
                    Hai esaurito gli annunci
                </button>
            </div>
        </div>
        <div v-else>
            <div class="center">
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
            </div>
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
            // currPage: 1,
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
                // console.log(response.data);
                // console.log(observable.curr_page, observable.last_page);
                observable.ready = true;
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
                            // console.log(tempAr);
                            // console.log(
                            //     observable.curr_page,
                            //     observable.last_page
                            // );

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
                            // console.log(tempAr);
                            // console.log(
                            //     observable.curr_page,
                            //     observable.last_page
                            // );

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
h2 {
    opacity: 0;
    text-align: center;
    color: $text-gray-light;
    transition: opacity 1s ease-in-out;
}
h2:hover {
    opacity: 1;
}
.apartment_section {
    border-top: 1px solid $text-gray-dark;
    min-height: 18.75rem;
}
.center {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: $bg-primary-dark;
}
.wave {
    width: 5px;
    height: 100px;
    background: linear-gradient(45deg, cyan, #fff);
    margin: 10px;
    animation: wave 1s linear infinite;
    border-radius: 20px;
}
.wave:nth-child(2) {
    animation-delay: 0.1s;
}
.wave:nth-child(3) {
    animation-delay: 0.2s;
}
.wave:nth-child(4) {
    animation-delay: 0.3s;
}
.wave:nth-child(5) {
    animation-delay: 0.4s;
}
.wave:nth-child(6) {
    animation-delay: 0.5s;
}
.wave:nth-child(7) {
    animation-delay: 0.6s;
}
.wave:nth-child(8) {
    animation-delay: 0.7s;
}
.wave:nth-child(9) {
    animation-delay: 0.8s;
}
.wave:nth-child(10) {
    animation-delay: 0.9s;
}

@keyframes wave {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1);
    }
    100% {
        transform: scale(0);
    }
}
</style>
