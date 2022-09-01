<template>
    <main>
        <HeaderComponent/>
        <div>
            <div class="container bnb-container p-3" v-for="apartment in apartments" :key="apartment.id">
                <h3 class="">{{apartment.name}}</h3>
                <h6>{{apartment.full_address}}</h6>
                <div class="row">
                    <div class="col p-3">
                        <img class="apartment_img" :src="`/storage/${apartment.image}`" :alt="apartment.name">
                    </div>
                    
                    <div class="col p-3">
                        <h5>Informazioni su questo spazio:</h5>
                        <p>{{apartment.description}}</p>
                        <div class="d-flex info">
                            <div>
                                <h5>{{apartment.rooms}} camere |</h5>
                            </div>
                            <div>
                                <h5>{{apartment.beds}} letti |</h5>
                            </div>
                            <div>
                                <h5>{{apartment.bathrooms}} bagni |</h5>
                            </div>
                            <div>
                                <h5>{{apartment.size}} metri quadri</h5>
                            </div>
                        </div>

                        <div class="mt-5">
                            <h5>Cosa troverai:</h5>
                            <div class="services d-flex" v-for="service in services" :key="service.id">
                                <h5>{{service.name}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	    </div>
    </main>
</template>

<script>

import HeaderComponent from './components/HeaderComponent.vue';

export default {
    name: "BnbView",
    components: { HeaderComponent },
    data() {
		return {
			Id: this.$route.params.id,
            apartments: [],
            services: [],
		}
	},

    created() {
        axios.get('/api/apartment', {
            params: {
                Id: this.Id,
            }
        })
            .then((response) => {
                this.apartments = response.data;
            });

        axios.get('/api/service', {
            params: {
                Id: this.Id,
            }
        })
            .then((response) => {
                this.services = response.data;
            });
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables';

main {
    height: 100vh;
    background-color: $bg-primary-dark;

    .bnb-container {
        background-color: $bg-secondary-dark;
        margin-top: 50px;
    }

    .apartment_img {
        height: 400px;
        max-width: 532px;
    }

    .info * {
    margin-right: 3px;
    }

    .info * * {
        font-size: 15px;
    }

    h1, h3, h4, h5, p, li {
        color: $text-gray-light;
    }

    h6 {
        color: $text-gray-dark;
    }

    .services * {
        font-size: 15px;
    }
}

</style>