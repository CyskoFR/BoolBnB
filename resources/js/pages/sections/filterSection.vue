<template>
    <div>
        <div class="container">
            <form @submit.prevent="checkInput">
                <input
                    v-model="full_address"
                    type="text"
                    placeholder="indirizzo"
                />
                <input
                    v-model="rooms"
                    type="number"
                    placeholder="stanze"
                    min="1"
                    step="1"
                />
                <input
                    v-model="beds"
                    type="number"
                    placeholder="letti"
                    min="1"
                    step="1"
                />
                <input
                    v-model="distance"
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
export default {
    name: "filterSection",
    data() {
        return {
            full_address: this.$route.params.param,
            rooms: null,
            beds: null,
            distance: null,
        };
    },
    methods: {
        checkInput() {
            console.log(
                this.rooms,
                this.beds,
                this.distance,
                this.full_address
            );
        },
    },
};
</script>

<style lang="scss" scoped></style>
