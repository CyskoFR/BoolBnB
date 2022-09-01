<template>
    <main>
        <HeaderComponent/>
        <div>
            <div class="container pt-3" v-for="apartment in apartments" :key="apartment.id">
                <h1 class="">{{apartment.name}}</h1>
                <h2>{{apartment.full_address}}</h2>
                <img class="apartment_img pt-3" :src="`/storage/${apartment.image}`" :alt="apartment.name">
                <h4 class="pt-5">Informazioni su questo spazio:</h4>
                <p class="pt-2">{{apartment.description}}</p>
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

                <h5 class="pt-2">Cosa troverai:</h5>
                <ul class="services" v-for="service in services" :key="service.id">
                    <li><h5>{{service.name}}</h5></li>
                </ul>
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
    background-color: $bg-primary-dark;

    .apartment_img {
    height: 500px;
    width: 500px;
    }

    .info * {
    margin-right: 5px;
    }

    h1, h3, h4, h5, p, li {
        color: $text-gray-light;
    }

    h2 {
        color: $text-gray-dark;
    }
}

</style>