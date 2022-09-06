<template>
    <div>
        <div class="container">
            <form @submit.prevent="fetchApartments()">
                <div class="input-group d-flex flex-column">
                    <input
                        class="py-2 px-3"
                        name="indirizzo"
                        v-model="observable.full_address"
                        type="text"
                        placeholder="indirizzo"
                    />
                    <small for="indirizzo">Indirizzo</small>
                </div>
                <div
                    class="input-group row align-items-center justify-content-center"
                >
                    <div class="col-6 col-md-4">
                        <input
                            class="py-1 px-2 w-100"
                            v-model="observable.rooms"
                            type="number"
                            placeholder="stanze"
                            min="1"
                            step="1"
                        />
                        <small class="d-block" for="stanze">Stanze</small>
                    </div>
                    <div class="col-6 col-md-4 flex justify-tems-center">
                        <input
                            class="py-1 px-2 w-100"
                            v-model="observable.beds"
                            type="number"
                            placeholder="letti"
                            min="1"
                            step="1"
                        />
                        <small class="d-block" for="stanze">Letti</small>
                    </div>
                    <div class="col-12 col-md-4">
                        <input
                            class="py-1 px-2 w-100"
                            v-model="observable.distance"
                            type="number"
                            placeholder="raggio di ricerca"
                            min="1"
                            step="1"
                        />
                        <small class="d-block" for="stanze">Raggio in km</small>
                    </div>
                </div>
                <div class="col d-flex justify-content-center py-2">
                    <button
                        type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#exampleModalCenter"
                    >
                        servizi extra
                    </button>
                    <button class="btn btn-secondary mx-2">invio</button>
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
                                        <button
                                            type="button"
                                            class="w-100 my-2"
                                        >
                                            {{ service.name }}
                                        </button>
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
                                    class="btn btn-primary"
                                >
                                    Salva
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import observable from "../../observable.js";
export default {
    name: "filterSection",
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
                axios
                    .get("/api/apartments/search", {
                        params: {
                            full_address: observable.full_address,
                            rooms: observable.rooms,
                            beds: observable.beds,
                            distance: observable.distance,
                            category_id: observable.category_id,
                        },
                    })
                    .then((response) => {
                        console.log(response);
                        observable.apartments = response.data;
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
                        },
                    })
                    .then((response) => {
                        console.log(response);
                        observable.apartments = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
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
        },
    },
    created() {
        axios
            .get("/api/services")
            .then((response) => {
                console.log(response);
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
.modal-body {
    button {
        background-color: $bg-primary-light;
        color: $text-gray-light;

        &:hover {
            background-color: $primary-green-dark;
        }
    }
}
</style>
