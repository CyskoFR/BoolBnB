<template>
    <div class="filter_section py-3">
        <div class="container">
            <form class="row" @submit.prevent="fetchApartments()">
                <div class="col-12 col-md-6">
                    <div class="input-group d-flex flex-column my-2">
                        <small for="indirizzo">Indirizzo</small>
                        <input
                            @keyup="autocomplete"
                            required
                            class="px-2"
                            name="indirizzo"
                            v-model="observable.full_address"
                            type="text"
                            placeholder="Indirizzo"
                        />
                    </div>
                    <datalist
                        :class="{ 'd-none ': !toogleDatalist }"
                        v-if="observable.full_address"
                        id="address_list"
                    >
                        <option
                            @click="select(suggestion)"
                            v-for="suggestion in suggested"
                            :key="suggestion"
                            value="suggestion"
                        >
                            {{ suggestion }}
                        </option>
                    </datalist>
                    <div
                        class="input-group row align-items-end justify-content-center mt-2 mb-4 mx-0"
                    >
                        <div class="col-6 col-md-4 my-2">
                            <small class="d-block" for="stanze">Stanze</small>
                            <input
                                class="px-2 w-100"
                                v-model="observable.rooms"
                                type="number"
                                placeholder="stanze"
                                required
                                min="1"
                                step="1"
                            />
                        </div>
                        <div
                            class="col-6 col-md-4 flex justify-tems-center my-2"
                        >
                            <small class="d-block" for="stanze">Letti</small>
                            <input
                                required
                                class="px-2 w-100"
                                v-model="observable.beds"
                                type="number"
                                placeholder="letti"
                                min="1"
                                step="1"
                            />
                        </div>
                        <div class="col-12 col-md-4 my-2">
                            <small class="d-block" for="stanze"
                                >Raggio in km</small
                            >
                            <input
                                required
                                class="px-2 w-100"
                                v-model="observable.distance"
                                type="number"
                                placeholder="raggio di ricerca"
                                min="1"
                                step="1"
                            />
                        </div>
                    </div>
                </div>

                <!-- Riepilogo filtri applicati -->
                <div class="col-12 col-md-6">
                    <hr class="m-0 d-md-none" />
                    <div
                        class="active_filters container-fluid my-2 p-0 justify-content-around align-items-end"
                    >
                        <h5 class="text-center">Stai cercando:</h5>
                        <div class="row">
                            <div class="col-6">
                                <p>
                                    Indirizzo:
                                    <b>{{ observable.full_address }}</b>
                                </p>
                                <p>
                                    Numero di letti:
                                    <b>{{ observable.beds }}</b>
                                </p>
                                <p>
                                    Numero di stanze:
                                    <b>{{ observable.rooms }}</b>
                                </p>
                                <p>
                                    Distanza dal punto di ricerca:
                                    <b>{{ observable.distance }}</b>
                                </p>
                                <p v-show="observable.category_name.length > 0">
                                    Categoria:
                                    <b>{{ observable.category_name }}</b>
                                </p>
                            </div>
                            <div class="col-6">
                                <p
                                    v-show="
                                        observable.selectedServicesNames
                                            .length > 0
                                    "
                                >
                                    Servizi extra selezionati:
                                    <b>{{
                                        observable.selectedServicesNames.toString()
                                    }}</b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col d-flex justify-content-center mt-2">
                    <button
                        type="button"
                        class="btn extra_button"
                        data-toggle="modal"
                        data-target="#exampleModalCenter"
                    >
                        Servizi extra
                    </button>
                    <button class="btn extra_button search_button">
                        Cerca
                    </button>
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
            <!-- <a href="/">
                <button class="home_button btn mt-2"><b>Home</b></button>
            </a> -->
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
            suggested: [],
            toogleDatalist: false,
            observable,
            selectedServicesString: "",
            allServices: {},
            count: 0,
            tempServicesArray: new Set(),
        };
    },
    methods: {
        autocomplete() {
            this.toogleDatalist = true;
            this.count > 2 ? (this.count = 0) : this.count++;
            if (observable.full_address && this.count >= 2) {
                axios
                    .get(
                        `http://localhost:8000/api/autocomplete?address=${observable.full_address}`
                    )
                    .then((res) => {
                        console.log(res.data);
                        this.suggested = res.data;
                    });
            }
        },
        fetchApartments() {
            if (observable.selectedServices.length == 0) {
                observable.ready = false;
                observable.apartments = [];
                // for (let i = 1; i <= observable.curr_page; i++) {
                axios
                    .get("/api/apartments/search?", {
                        params: {
                            full_address: observable.full_address,
                            rooms: observable.rooms,
                            beds: observable.beds,
                            distance: observable.distance,
                            category_id: observable.category_id,
                            page: 1,
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
                        observable.apartments = tempAr;
                        observable.last_page = response.data.last_page;
                        observable.curr_page = response.data.current_page;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                // observable.curr_page = 1;
                observable.ready = true;
                //     : (observable.ready = false);
                //     }
                // }
            } else {
                observable.ready = false;
                observable.apartments = [];
                // for (let i = 1; i <= observable.curr_page; i++) {
                axios
                    .get("/api/apartments/search", {
                        params: {
                            full_address: observable.full_address,
                            rooms: observable.rooms,
                            beds: observable.beds,
                            distance: observable.distance,
                            category_id: observable.category_id,
                            services: this.selectedServicesString,
                            page: 1,
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
                        observable.last_page = response.data.last_page;
                        observable.curr_page = response.data.current_page;
                        // console.log(tempAr);
                        observable.apartments = tempAr;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                // i == observable.curr_page
                // observable.curr_page = 1;
                observable.ready = true;
                //     : (observable.ready = false);
                // }
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
        select(val) {
            this.toogleDatalist = false;
            this.observable.full_address = val;
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

datalist option {
    cursor: pointer;
    margin: 1px 0;
    padding: 5px 10px;
    width: 100%;
    display: block;
    &:hover {
        filter: brightness(105%);
        background-color: $primary-green-dark;
        color: $text-gray-light;
    }
}
datalist {
    display: block;
    background-color: $bg-primary-light;
    color: $primary-green-light;
    width: 100%;
    border: 1px solid $primary-green-light;
    margin-top: 5px;
    border-radius: 10px;
    overflow: hidden;
}

p {
    margin-bottom: 0.375rem;
}

input {
    border: 2px solid $primary-green;
    border-radius: 0.375rem;
    font-weight: 600;
}

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}

small {
    color: $text-gray-dark;
    margin-bottom: 2px;
    padding-left: 4px;
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
    border-radius: 0.5rem;
    margin-right: 0.625rem;
    padding: 2px 8px;
    font-weight: 600;
    &:hover {
        color: $text-gray-light;
        background-color: $primary-green-dark;
        border: 1px solid $primary-green-light;
    }
}

.search_button {
    background-size: 200% auto;
    background-image: linear-gradient(
        to right,
        $bg-gray-light 0%,
        $primary-green-dark 51%,
        $bg-gray-light 100%
    );
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    &:hover {
        background-position: right center;
        color: black;
        text-shadow: 1px 1px $text-gray-light;
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

hr {
    height: 1px;
    background-color: $text-gray-dark;
    border: none;
}
.active_filters {
    color: $text-gray-dark;
    h5,
    b {
        color: $text-gray-light;
    }
    b {
        text-transform: uppercase;
    }
    .col-6 {
        word-wrap: break-word;
    }
}
</style>
