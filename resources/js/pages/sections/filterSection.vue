<template>
    <div>
        <div class="container">
            <form class="mb-2" @submit.prevent="fetchApartments()">
                <div class="input-group d-flex flex-column my-2">
                    <small for="indirizzo">Indirizzo</small>
                    <input
                        required
                        class="py-2 px-3"
                        name="indirizzo"
                        v-model="observable.full_address"
                        type="text"
                        placeholder="indirizzo"
                    />
                </div>
                <div
                    class="input-group row align-items-center justify-content-center mt-2 mb-4 mx-0"
                >
                    <div class="col-6 col-md-4 my-2">
                        <small class="d-block" for="stanze">Stanze</small>
                        <input
                            class="py-1 px-2 w-100"
                            v-model="observable.rooms"
                            type="number"
                            placeholder="stanze"
                            required
                            min="1"
                            step="1"
                        />
                    </div>
                    <div class="col-6 col-md-4 flex justify-tems-center my-2">
                        <small class="d-block" for="stanze">Letti</small>
                        <input
                            required
                            class="py-1 px-2 w-100"
                            v-model="observable.beds"
                            type="number"
                            placeholder="letti"
                            min="1"
                            step="1"
                        />
                    </div>
                    <div class="col-12 col-md-4 my-2">
                        <small class="d-block" for="stanze">Raggio in km</small>
                        <input
                            required
                            class="py-1 px-2 w-100"
                            v-model="observable.distance"
                            type="number"
                            placeholder="raggio di ricerca"
                            min="1"
                            step="1"
                        />
                    </div>
                </div>

                <!-- Riepilogo filtri applicati -->
                <div
                    class="active_filters my-3 d-flex justify-content-around align-items-end"
                >
                    <h3 class="mt-2">Stai cercando:</h3>
                    <p>
                        Indirizzo: <b>{{ observable.full_address }}</b>
                    </p>
                    <p>
                        Numero di letti: <b>{{ observable.beds }}</b>
                    </p>
                    <p>
                        Numero di stanze: <b>{{ observable.rooms }}</b>
                    </p>
                    <p>
                        Distanza dal punto di ricerca:
                        <b>{{ observable.distance }}</b>
                    </p>
                    <p v-show="observable.category_name.length > 0">
                        Categoria: <b>{{ observable.category_name }}</b>
                    </p>
                    <p v-show="observable.selectedServicesNames.length > 0">
                        Servizi extra selezionati:
                        <b>{{ observable.selectedServicesNames }}</b>
                    </p>
                </div>

                <div class="col d-flex justify-content-center py-2 my-2">
                    <button
                        type="button"
                        class="btn extra_button"
                        data-toggle="modal"
                        data-target="#exampleModalCenter"
                    >
                        Servizi extra
                    </button>
                    <button class="btn extra_button mx-2">Cerca</button>
                </div>

                <!-- Modal -->
                <div
                    class="modal fade"
                    id="exampleModalCenter"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true"
                >
                    <div
                        class="modal-dialog modal-dialog-centered"
                        role="document"
                    >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5
                                    class="modal-title"
                                    id="exampleModalLongTitle"
                                >
                                    Seleziona i servizi che ritieni
                                    indispensabili
                                </h5>
                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-label="Close"
                                >
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row align-items-center">
                                    <div
                                        @click="selectService(service.id)"
                                        v-for="service in allServices"
                                        :key="service.id"
                                        class="service col-4"
                                    >
                                        <extraServiceButton
                                            :service="service"
                                        ></extraServiceButton>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal"
                                >
                                    Chiudi
                                </button>
                                <button
                                    @click="save()"
                                    type="button"
                                    class="btn btn-primary save_button"
                                    data-dismiss="modal"
                                >
                                    Salva
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <a href="/">
                <button class="home_button btn mt-2"><b>Home</b></button>
            </a>
        </div>
    </div>
</template>

<script>
import observable from "../../observable";
import extraServiceButton from "../microComponents/extraServiceButton.vue";

export default {
    name: "filterSection",

    components: {
        extraServiceButton,
    },

    data() {
        return {
            observable,
            selectedServicesString: "",
            allServices: {},
            tempServicesArray: new Set(),
        };
    },
    methods: {
        fetchApartments() {
            if (observable.selectedServices.length == 0) {
                observable.ready = false;
                observable.apartments = [];
                for (let i = 1; i <= observable.curr_page; i++) {
                    axios
                        .get("/api/apartments/search?", {
                            params: {
                                full_address: observable.full_address,
                                rooms: observable.rooms,
                                beds: observable.beds,
                                distance: observable.distance,
                                category_id: observable.category_id,
                                page: i,
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
                    i == observable.curr_page
                        ? (observable.ready = true)
                        : (observable.ready = false);
                }
            } else {
                observable.ready = false;
                observable.apartments = [];
                for (let i = 1; i <= observable.curr_page; i++) {
                    axios
                        .get("/api/apartments/search", {
                            params: {
                                full_address: observable.full_address,
                                rooms: observable.rooms,
                                beds: observable.beds,
                                distance: observable.distance,
                                category_id: observable.category_id,
                                services: this.selectedServicesString,
                                page: i,
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
                    i == observable.curr_page
                        ? (observable.ready = true)
                        : (observable.ready = false);
                }
            }
        },
        selectService(id) {
            this.tempServicesArray.has(id)
                ? this.tempServicesArray.delete(id)
                : this.tempServicesArray.add(id);
        },
        save() {
            observable.selectedServices = Array.from(this.tempServicesArray);
            this.selectedServicesString =
                observable.selectedServices.toString();
            this.fetchApartments();
        },
    },
    created() {
        axios
            .get("/api/services")
            .then((response) => {
                // console.log(response);
                this.allServices = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
    },
};
</script>

<style lang="scss" scoped>
@import "~/resources/sass/_variables";

input {
    border: 2px solid $primary-green;
    border-radius: 0.25rem;
}
small {
    color: $text-gray-dark;
}
.modal-body {
    button {
        background-color: $bg-primary-light;
        color: $text-gray-light;
        border-radius: 0.25rem;
        word-wrap: break-word;
        &:hover {
            background-color: $primary-green-dark;
        }
    }
    .active {
        background-color: $primary-green-dark;
    }
}
.modal-footer {
    .save_button {
        background-color: $primary-green-light;
        &:hover {
            color: $text-gray-light;
            background-color: $primary-green-dark;
            border: 1px solid $primary-green-light;
        }
    }
}
.extra_button {
    font-size: 0.875rem;
    background-color: $primary-green-light;
    border-radius: 0.75rem;
    margin-right: 0.625rem;
    &:hover {
        color: $text-gray-light;
        background-color: $primary-green-dark;
        border: 1px solid $primary-green-light;
    }
}
.home_button {
    font-size: 0.875rem;
    background-color: $primary-green-light;
    border-radius: 0.75rem;
    &:hover {
        color: $text-gray-light;
        background-color: $primary-green-dark;
        border: 1px solid $primary-green-light;
    }
}
.active_filters {
    color: $text-gray-light;
    border-top: 1px solid $text-gray-dark;
    b {
        text-transform: uppercase;
    }
}
</style>
