//importo i componenti fondamentali
import Vue from "vue";
import VueRouter from "vue-router";
//dico a vue di usare router
Vue.use(VueRouter);
//sezione di import delle View (Vue components)
import Home from "./pages/Home";
import BnbView from "./pages/BnbView";
import SearchPage from "./pages/SearchPage";

//settings delle rotte
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/bnb-view/data/:id",
            name: "bnb-view",
            component: BnbView,
        },
        {
            path: "/search-page",
            name: "search-page",
            component: SearchPage,
        },
    ],
});

export default router;
