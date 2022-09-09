import Vue from "vue";
export default Vue.observable({
    full_address: "",
    beds: 1,
    rooms: 1,
    distance: 20,
    category_id: null,
    selectedServices: [],
    //tutti, chiamata gener
    services: [],
    apartments: [],
});
