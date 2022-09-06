<template>
    <div>
        <div class="container">
            <form @submit.prevent="fetchApartments()">
                <input
                    v-model="observable.full_address"
                    type="text"
                    placeholder="indirizzo"
                />
                <input
                    v-model="observable.rooms"
                    type="number"
                    placeholder="stanze"
                    min="1"
                    step="1"
                />
                <input
                    v-model="observable.beds"
                    type="number"
                    placeholder="letti"
                    min="1"
                    step="1"
                />
                <input
                    v-model="observable.distance"
                    type="number"
                    placeholder="raggio di ricerca"
                    min="1"
                    step="1"
                />
                <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#exampleModalCenter"
                >
                    servizi
                </button>

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
                                <div class="row">
                                    <div
                                        @click="selectService(service.id)"
                                        v-for="service in allServices"
                                        :key="service.id"
                                        class="service col-3"
                                    >
                                        <input
                                            type="checkbox"
                                            :name="service.id"
                                            :id="service.id"
                                        />
                                        <label :for="service.id">
                                            {{ service.name }}</label
                                        >
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
                <button>submit</button>
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

<style lang="scss" scoped></style>
