<template>
    <div>
        <HeaderComponent/>
        <bnbCard :apartment="apartment" v-for="apartment in apartments" :key="apartment.id"/>
        <FooterComponent/>
    </div>
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
            apartments: [],
            param: this.$route.params.param, 
        }
    },

    created() {
        
        axios.get('/api/searchbar', {
            params: {
                param: this.param,
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
    
</style>