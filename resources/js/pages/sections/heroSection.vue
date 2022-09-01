<template>
    <section class="hero_section container-fluid">
        <div class="hero_row row d-flex">

            <div class="hero_searchbar_container col-12 col-md-5">
                <nav class="navbar navbar-light bg-light">
                    <form class="hero_searchbar_box form-inline d-flex">
                        <input class="hero_searchbar form-control mr-sm-2" type="search" placeholder="Cerca il tuo posto preferito" aria-label="Search">
                        <button class="hero_search_button btn btn-outline-success my-2 my-sm-0" type="submit">Cerca</button>
                    </form>
                </nav>
            </div>

            <div class="hero_img_container d-none d-md-block col-md-7">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-interval="3000">
                            <img src="../../../img/bnb-hero1.jpg" class="d-block w-100" alt="bnb-hero1">
                        </div>
                        <div class="carousel-item" data-interval="3000">
                            <img src="../../../img/bnb-hero2.jpg" class="d-block w-100" alt="bnb-hero2">
                        </div>
                        <div class="carousel-item" data-interval="3000">
                            <img src="../../../img/bnb-hero3.jpg" class="d-block w-100" alt="bnb-hero3">
                        </div>
                        <div class="carousel-item" data-interval="3000">
                            <img src="../../../img/bnb-hero4.jpg" class="d-block w-100" alt="bnb-hero4">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</template>

<script>



export default {

    name: "heroSection",

    components: { 

    }
};

</script>

<style lang="scss" scoped>

@import '../../../sass/variables';

.hero_section {
    padding: 0;
}

.hero_row {
    background-color: $bg-secondary-dark;
    margin: auto;
    border: .875rem solid $bg-primary-dark;;
    max-width: 120rem;
    justify-content: center;
    text-align: center;
    align-items: center;

}

.hero_img_container {
    padding: 0;
    img {
        height: 30rem;
        max-height: 32rem;
        object-fit: cover;
    }
}

</style>