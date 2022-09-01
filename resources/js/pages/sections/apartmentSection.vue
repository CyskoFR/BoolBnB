<<template>
    <section class="apartment_section d-flex flex-row p-3">
        <bnbCard :apartment="apartment" v-for="apartment in apartments" :key="apartment.id"/>
    </section>
</template>

<script>

import bnbCard from '../microComponents/bnbCard.vue';

export default {
    
    name: "apartmentSection",

    components: {
        bnbCard,
    },

    data() {
        return {
            apartments: []
        }
    },

    created() {
        axios.get('http://localhost:8000/api/apartments')
            .then((response) => {
                this.apartments = response.data;
            });
    }
};

</script>

<style lang="scss" scoped>

@import '../../../sass/variables';

    .apartment_section {
        flex-wrap: wrap;
    }

</style>