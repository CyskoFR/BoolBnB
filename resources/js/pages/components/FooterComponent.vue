<template>
    <footer>
        <div class="container footer_component py-3 ">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3 text-center text-sm-left">
                    <h6>Assistenza</h6>
                    <ul>
                        <li><a href="#">Centro Assistenza</a></li>
                        <li><a href="#">Accessibilità per tutti</a></li>
                        <li><a href="#">Segnala problemi nel quartiere</a></li>
                        <li><a href="#">AirCover</a></li>
                        <li><a href="#">Opzioni di cancellazione</a></li>
                        <li><a href="#">Informazioni di sicurezza</a></li>
                        <li><a href="#">La nostra risposta all'emergenza COVID-19</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 text-center text-sm-left">
                    <h6>Community</h6>
                    <ul>
                        <li><a href="#">Boolbnb.org: un rifugio sicuro</a></li>
                        <li><a href="#">Supporta i rifugiati ukraini</a></li>
                        <li><a href="#">Contro la discriminazione</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 text-center text-sm-left">
                    <h6>Ospitare</h6>
                    <ul>
                        <li><a href="#">Prova a ospitare</a></li>
                        <li><a href="#">AirCover per gli host</a></li>
                        <li><a href="#">Esplora le risorse per host</a></li>
                        <li><a href="#">Vai al forum della community</a></li>
                        <li><a href="#">Come ospitare responsabilmente</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 text-center text-sm-left">
                    <h6>Boolbnb</h6>
                    <ul>
                        <li><a href="#">Newsroom</a></li>
                        <li><a href="#">Scopri le nuove funzionalità</a></li>
                        <li><a href="#">Lettera dai nostri fondatori</a></li>
                        <li><a href="#">Opportunità di lavoro</a></li>
                        <li><a href="#">Investitori</a></li>
                        <li><a href="#">Gift card</a></li>
                    </ul>
                </div>
            </div>
            <div class="row text-center text-md-left d-flex align-items-center">
                <div class="col-12 col-md-6 mb-2">
                    <small>© 2022 Boolbnb, Inc. · 
                        <a href="#">Privacy</a> · 
                        <a href="#">Termini</a> · 
                        <a href="#">Dettagli dell'azienda</a>
                    </small>
                </div>
                <div class="social_media col-12 col-md-6 d-flex justify-content-center justify-content-md-end align-middle">
                    Seguici sui social
                    <a target="_blank" href="https://www.facebook.com/"><img src="../../../img/facebook.jpg" alt="facebook"></a>
                    <a target="_blank" href="https://www.instagram.com/"><img src="../../../img/instagram.jpg" alt="instagram"></a>
                    <a target="_blank" href="https://twitter.com/"><img src="../../../img/twitter.jpg" alt="twitter"></a>
                    <a target="_blank" href="https://www.youtube.com/"><img src="../../../img/youtube.png" alt="youtube"></a>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>



export default {

    name: "FooterComponent",

    components: { 

    }
};

</script>

<style lang="scss" scoped>

@import '../../../sass/variables';

footer {
    background-color: $bg-secondary-dark;
    color: $text-gray-light;
    border-top: 1px solid $text-gray-dark;

    ul {
        list-style: none;
        padding: 0;
        
        li {
            cursor: pointer;
            margin-bottom: .25rem;
            font-size: .75rem;
        }

    }

    a {
        text-decoration: none;
        color: $text-gray-dark;;
    }

    a:hover {
        color: $text-gray-light;
    }
}
.social_media {

    img {
        width: 1.25rem;
        border-radius: 4px;
        cursor: pointer;
        margin: 0 .5rem;
        transition: 0.3s;
    }

    img:hover {
        scale: 130%;
        transition: 0.3s;
    }
}

</style>