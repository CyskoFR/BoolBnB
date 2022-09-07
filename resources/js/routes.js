//importo i componenti fondamentali
import Vue from "vue";
import VueRouter from "vue-router";
//dico a vue di usare router
Vue.use(VueRouter);
//sezione di import delle View (Vue components)
import Home from "./pages/Home";
import BnbView from "./pages/BnbView";
import SearchPage from "./pages/SearchPage";
import Page404 from "./pages/Page404";

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
            path: "/search-page/data/:param",
            name: "search-page",
            component: SearchPage,
        },
        {
            path: "/*",
            name: "page404",
            component: Page404,
        },
    ],
});

export default router;
