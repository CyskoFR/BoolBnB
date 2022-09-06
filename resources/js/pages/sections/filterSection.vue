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
    },
};
</script>

<style lang="scss" scoped></style>
