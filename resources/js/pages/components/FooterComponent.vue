<template>
    <footer>
        <div class="container footer_component py-3">
            <div class="row">
                <div class="col-xl-3 col-md-6 col-xs-12">
                    <h5>Assistenza</h5>
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
                <div class="col-xl-3 col-md-6 col-xs-12">
                    <h5>Community</h5>
                    <ul>
                        <li><a href="#">Boolbnb.org: un rifugio sicuro</a></li>
                        <li><a href="#">Supporta i rifugiati ukraini</a></li>
                        <li><a href="#">Contro la discriminazione</a></li>
                    </ul>
                </div>
                <div class="col-xl-3 col-md-6 col-xs-12">
                    <h5>Ospitare</h5>
                    <ul>
                        <li><a href="#">Prova a ospitare</a></li>
                        <li><a href="#">AirCover per gli host</a></li>
                        <li><a href="#">Esplora le risorse per host</a></li>
                        <li><a href="#">Vai al forum della community</a></li>
                        <li><a href="#">Come ospitare responsabilmente</a></li>
                    </ul>
                </div>
                <div class="col-xl-3 col-md-6 col-xs-12">
                    <h5>Boolbnb</h5>
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
            <div class="row d-flex py-3">
                <div class="col-6">
                    <span>© 2022 Boolbnb, Inc.</span>
                    <span>Privacy ·</span>
                    <span>Termini ·</span>
                    <span>Dettagli dell'azienda</span>
                </div>
                <div class="social_media col-xl-6 col-md-6 col-xs-12 d-flex">
                    
                    <a href="https://www.facebook.com/"><img src="../../../img/facebook.jpg" alt="facebook"></a>
                    <a href="https://www.instagram.com/"><img src="../../../img/instagram.jpg" alt="instagram"></a>
                    <a href="https://twitter.com/"><img src="../../../img/twitter.jpg" alt="twitter"></a>
                    <a href="https://www.youtube.com/"><img src="../../../img/youtube.png" alt="youtube"></a>
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
    background-color: $bg-primary-dark;
    color: $text-gray-light;

    ul {
        list-style: none;
        padding: 0;
        
        li {
            cursor: pointer;
            margin-bottom: .25rem;
        }

        a {
            text-decoration: none;
            color: $text-gray-light;
        }
    }
}
.social_media {
    justify-content: end;

    img {
        width: 1.875rem;
        border-radius: .5rem;
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