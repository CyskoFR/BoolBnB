<template>
    <section>
        <HeaderComponent/>
        <div class="main_section">
            <div class="container bnb_container p-3" v-for="apartment in apartments" :key="apartment.id">
                <div class="apartment_header row p-3 d-flex align-items-center">
                    <div class="apartment_title_box">
                        <h3 class="apartment_title">{{apartment.name}}</h3>
                        <h6>{{apartment.full_address}}</h6>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="contact_button btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Contatta
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLongTitle">Messaggio privato a @{{apartment.user.first_name}} {{apartment.user.last_name}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Messaggio:</label>
                                            <textarea class="form-control" id="message-text"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="modal_delete_button btn" data-dismiss="modal">Cancella</button>
                                    <button type="button" class="modal_send_button btn">Invia</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mb-3">
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

                <!-- iframe google maps -->
                <iframe class="mb-3" width="100%" height="300" style="border:0" loading="lazy" allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade" :src="`https://www.google.com/maps/embed/v1/view?key=AIzaSyCQ7RWBFjqduEmJrdQxabkp5w1nc0KXZeM&center=${apartment.latitude},${apartment.longitude}&zoom=18&maptype=satellite`">
                </iframe>
                
                <a href="/">
                    <button class="home_button btn mt-2"><b>Home</b></button>
                </a>
            </div>
        </div>
        <FooterComponent/>
    </section>
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

section {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: $bg-primary-dark;

    .main_section {
        flex-grow: 1;
        padding: 0 1.5rem;
    }

    .bnb_container {
        background-color: $bg-secondary-dark;
        margin: 3.125rem auto;
        display: flex;
        flex-direction: column;
        border-radius: .5rem;
        border: 1px solid $bg-primary-light;
        max-width: 120rem;
    }

    .apartment_title_box {
        flex-grow: 1;
    }

    .contact_button {
        width: 6.25rem;
        height: 2.5rem;
        background: $primary-green-dark;
        border-radius: .75rem;
        font-style: italic;
        font-weight: 700;
        &:hover {
            background-color: #fdfb52;
            border: 1px solid $primary-green-light;
            color: $text-blue-dark;
        }
    }

    .modal_delete_button {
        font-size: .875rem;
        background-color: #ff5757;
        border-radius: .75rem;
        border: 1px solid black;
        font-weight: 700;
        &:hover {
            background-color: #ff3333;
            color: white;
        }
    }

    .modal_send_button {
        font-size: .875rem;
        background-color: $primary-green;
        border-radius: .75rem;
        border: 1px solid black;
        font-weight: 700;
        &:hover {
            background-color: $primary-green-dark;
            color: white;
        }
    }

    .apartment_img {
        max-height: 32rem;
        object-fit: cover;
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

    h1, h3, h5, p, li {
        color: $text-gray-light;
    }

    p, h6 {
        font-weight: 400;
        color: $text-gray-dark;
    }

    iframe {
        border-radius: .75rem;
        outline: 1px solid $text-gray-dark;
        outline-offset: 1px;
    }

    .home_button {
        font-size: .875rem;
        background-color: $primary-green-light;
        border-radius: .75rem;
        &:hover {
            color: $text-gray-light;
            background-color: $primary-green-dark;
            border: 1px solid $primary-green-light;
        }
    }
}

</style>