<template>
    <section class="hero_section container-fluid px-3">
        <div class="hero_row row d-flex">
            <div class="hero_searchbar_container col-12 col-md-5">
                <h1>Le vacanze migliori hanno inizio qui</h1>
                <nav class="navbar navbar-light bg-light">
                    <form class="hero_searchbar_box form-inline d-flex">
                        <input
                            v-model="search"
                            class="hero_searchbar form-control"
                            type="search"
                            placeholder="Cerca il tuo posto preferito"
                            aria-label="Search"
                        />
                        <button
                            class="hero_searchbar_button btn btn-outline-success my-2 my-sm-0"
                            type="submit"
                            @click.stop.prevent="submit()"
                        >
                            Cerca
                        </button>
                    </form>
                </nav>
            </div>

            <div class="hero_img_container d-none d-md-block col-md-7">
                <div
                    class="carousel slide carousel-fade"
                    data-ride="carousel"
                >
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-interval="4000">
                            <img
                                src="../../../img/bnb-hero1.jpg"
                                class="d-block w-100"
                                alt="bnb-hero1"
                            />
                        </div>
                        <div class="carousel-item" data-interval="4000">
                            <img
                                src="../../../img/bnb-hero2.jpg"
                                class="d-block w-100"
                                alt="bnb-hero2"
                            />
                        </div>
                        <div class="carousel-item" data-interval="4000">
                            <img
                                src="../../../img/bnb-hero3.jpg"
                                class="d-block w-100"
                                alt="bnb-hero3"
                            />
                        </div>
                        <div class="carousel-item" data-interval="4000">
                            <img
                                src="../../../img/bnb-hero4.jpg"
                                class="d-block w-100"
                                alt="bnb-hero4"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import observable from "../../observable.js";

export default {
    name: "heroSection",

    components: {},

    data() {
        return {
            observable,
            search: "",
        };
    },

    methods: {
        submit() {
            observable.full_address = this.search;
            this.$router.push("/search-page/data/" + this.search);
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/variables";

.hero_section {
    padding: 0;
}

.carousel.carousel-fade .carousel-item {
    display: block;
    opacity: 0;
    transition: opacity ease-out 1s;
}

.carousel.carousel-fade .carousel-item.active {
    opacity: 1 !important;
}

.hero_row {
    background-color: $bg-secondary-dark;
    margin: 1rem auto;
    padding: 1.25rem;
    max-width: 120rem;
    align-items: center;
    border-radius: 12px;
}

.hero_searchbar_container {
    position: relative;
    padding-left: 1.5rem;
    h1 {
        font-size: 3.5rem;
        text-align: start;
        margin-bottom: 1.25rem;

        //color animation
        background: linear-gradient(224deg, #42b883, #155f3e, #3468a3, #aac8e4);
        background-size: 1200% 1200%;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        -webkit-animation: TextAnimation 8s ease infinite;
        -moz-animation: TextAnimation 8s ease infinite;
        -o-animation: TextAnimation 8s ease infinite;
        animation: TextAnimation 8s ease infinite;

        @-webkit-keyframes TextAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        @-moz-keyframes TextAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        @keyframes TextAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    }

    .navbar {
        position: absolute;
        z-index: 10;
        width: 130%;
        border-radius: 0.5rem;
        background-color: $text-gray-light;
        outline: 1px solid $primary-green-dark;
        outline-offset: 1px;
        transition: 0.2s;
        &:hover {
            scale: 101%;
        }
    }
}

.hero_searchbar_box {
    width: 100%;
}

.hero_searchbar {
    flex-grow: 1;
    border: none;
    background-color: transparent;
}

.hero_searchbar:focus,
.hero_searchbar:active {
    box-shadow: none !important;
}

.hero_searchbar_button {
    background-color: $primary-green;
    color: $text-gray-light;
    font-weight: 600;
    &:hover {
        background-color: $primary-green-dark;
        border: 1px solid $primary-green-light;
    }
}

.hero_img_container {
    padding: 0;
    img {
        height: 30rem;
        max-height: 32rem;
        object-fit: cover;
        border-radius: 0 0.75rem 0.75rem 0;
        border: 1px solid $text-gray-dark;
    }
}

@media screen and (max-width: 767px) {
    .hero_searchbar_container {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
    .navbar {
        position: relative !important;
        width: 100% !important;
        border-radius: 0.5rem;
    }
}
</style>
