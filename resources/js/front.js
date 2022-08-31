//richiedi vue nella finestra
window.Vue = require("vue");
//importo axios globalmente
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//importa il componente App ,speciale , in una cartella a parte chiamata views, il resto delle pagine si trova in pages e i componenti singolo in components
import App from "./views/App";
//import del file routes.js
import router from "./routes.js";
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
import { faUser } from '@fortawesome/free-regular-svg-icons'

/* add icons to the library */
library.add(faUserSecret, faUser)

/* add font awesome icon component */
Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false
//mount e render dell'app di vue e del router
const app = new Vue({
    el: "#root",
    render: (h) => h(App),
    router,
});
