<template>
    <main>
        <HeaderComponent/>
            <div class="container bnb_container p-3" v-for="apartment in apartments" :key="apartment.id">
                <h3 class="apartment_title">{{apartment.name}}</h3>
                <h6>{{apartment.full_address}}</h6>
                <div class="row">
                    <div class="col-12 col-md-6 p-3">
                        <img class="apartment_img" :src="`/storage/${apartment.image}`" :alt="apartment.name">
                    </div>
                    
                    <div class="col-12 col-md-6 p-3">
                        <h5>Informazioni su questo spazio</h5>
                        <p>{{apartment.description}}</p>
                        <div class="d-flex info">
                            <div>
                                <h5>{{apartment.rooms}} camere | {{apartment.beds}} letti | {{apartment.bathrooms}} bagni | {{apartment.size}} metri quadri</h5>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h5>Cosa troverai</h5>
                            <div class="services d-flex" v-for="service in apartment.services" :key="service.id">
                                <h6>{{service.name}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="/">
                    <button class="btn mt-2"><b>Home</b></button>
                </a>
            </div>
        <FooterComponent/>
    </main>
</template>

<script>

import HeaderComponent from './components/HeaderComponent.vue';
import FooterComponent from './components/FooterComponent.vue';

export default {
    name: "BnbView",
    components: { 
        HeaderComponent,
        FooterComponent,
    },
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
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables';

main {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: $bg-primary-dark;

    .bnb_container {
        background-color: $bg-secondary-dark;
        margin: 3.125rem auto;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        border-radius: .5rem;
        border: 1px solid $bg-primary-light;
    }

    .apartment_img {
        max-height: 25rem;
        width: 100%;
        border-radius: .5rem;
        outline: 1px solid $primary-green-dark;
        outline-offset: .125rem;
    }

    .info * {
    margin-right: .1875rem;
    }

    .info * * {
        font-size: 1rem;
    }

    h1, h3, h4, h5, p, li {
        color: $text-gray-light;
    }

    p, h6 {
        font-weight: 400;
        color: $text-gray-dark;
    }

    button {
        font-size: .875rem;
        background-color: $primary-green-light;
        border-radius: .75rem;
        &:hover {
            background-color: $text-gray-light;
            border: 1px solid $primary-green-light;
            color: $text-blue-dark;
        }
    }
}

</style>