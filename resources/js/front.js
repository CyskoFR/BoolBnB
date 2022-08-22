//richiedi vue nella finestra
window.Vue = require("vue");
//importa il componente App ,speciale , in una cartella a parte chiamata views, il resto delle pagine si trova in pages e i componenti singolo in components
import App from "./views/App";
//import del file routes.js
import router from "./routes.js";
//mount e render dell'app di vue e del router
const app = new Vue({
    el: "#root",
    render: (h) => h(App),
    router,
});
