<template>
    <main>
        <HeaderComponent/>
            <section class="apartment_section d-flex justify-content-center flex-row p-3 pt-5">
                <bnbCard :apartment="apartment" v-for="apartment in apartments" :key="apartment.id"/>
            </section>
        <FooterComponent/>
    </main>
</template>

<script>

import HeaderComponent from './components/HeaderComponent.vue';
import FooterComponent from './components/FooterComponent.vue';
import bnbCard from './microComponents/bnbCard.vue';

export default {
    name: "SearchPage",
    components: { HeaderComponent, FooterComponent, bnbCard },

    data() {
        return {
            Id: this.$route.params.id,
            apartments: []
        }
    },

    created() {
        axios.get('/api/apartment-category', {
            params: {
                Id: this.Id,
            }
        })
            .then((response) => {
                this.apartments = response.data;
            });
    }
};
</script>

<style lang="scss" scoped>
@import '../../sass/variables';

main {

    background-color: $bg-primary-dark;

    .apartment_section {
        flex-wrap: wrap;
    }
}
    
</style>