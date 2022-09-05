<template>
    <div>
        <div class="container">
            <form @submit.prevent="$emit('filter-update', query)">
                <input
                    v-model="query.full_address"
                    type="text"
                    placeholder="indirizzo"
                />
                <input
                    v-model="query.rooms"
                    type="number"
                    placeholder="stanze"
                    min="1"
                    step="1"
                />
                <input
                    v-model="query.beds"
                    type="number"
                    placeholder="letti"
                    min="1"
                    step="1"
                />
                <input
                    v-model="query.distance"
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
            query: {
                full_address: this.$route.params.param,
                rooms: null,
                beds: null,
                distance: null,
            },
        };
    },
    methods: {},
};
</script>

<style lang="scss" scoped></style>
