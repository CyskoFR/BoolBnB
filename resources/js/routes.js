//importo i componenti fondamentali
import Vue from "vue";
import VueRouter from "vue-router";
//dico a vue di usare router
Vue.use(VueRouter);
//sezione di import delle View (Vue components)
import Home from "./pages/Home";

//settings delle rotte
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
    ],
});

export default router;
